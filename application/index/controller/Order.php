<?php
namespace app\index\controller;
use think\Controller;
use think\Loader;
use think\Session;
use think\Url;
use think\Config;
use think\Page;
use think\Verify;
use think\Image;
use think\Db;
use think\Request;
use wxpay;
use think\Model;
Loader::import('pingpp-php-master/init', EXTEND_PATH);
class Order extends Base
{
    public function index()
    {
        return $this->fetch();
    }
    public function addorder()
    {
        if(Request::instance()->isPost()){
            $gid = input('post.gid');
            $num = input('post.num');
            $coupon = input('post.coupon');
            $autograph = input('post.autograph');
            //dump($gid);die;
            //如果身份证，邮箱，真实姓名没有绑定不能购买|| empty($this->member['cardid'])
//            if(empty($this->member['realname']) || empty($this->member['email'])){
//                $this->success("购买此商品前需完善信息","/index/user/perfectinfo");
//            }
            if(!empty($gid)){
                $mygoods=Db::name('goods')->where("id=$gid")->find();
                //获取该用户已经购买的羔羊数量
                if(!empty($mygoods['limitnum'])){
                    $mylamenum = Db::name('lamb')->where(array('gid'=>$gid,'uid'=>$this->member['id']))->count();
                    if(($mylamenum+$num)>$mygoods['limitnum']){
                        $this->success("您已购买".$mylamenum.",超过购买上限，上限为".$mygoods['limitnum']."只！","/index/shop/glist.html");
                    }
                }
                if($num<=$mygoods['stock']){//购买数量需要小于等于库存
                    $this->assign('num', $num);
                    $this->assign('coupon', $coupon);
                    $this->assign('autograph', $autograph);
                    $this->assign('mygoods', $mygoods);
                    $this->assign('webtitle', '填写申请');
                    return $this->fetch();
                }else{
                    $this->success("库存不足！","/index/shop/glist.html");
                }
            }else{
                header("Location: ".url('index/index'));
                exit();
            }
        }else{
            header("Location: ".url('index/index'));
            exit();
        }

    }
    public function addorderlamb()
    {
        if(Request::instance()->isPost()){
            $gid = input('post.gid');
            $num = input('post.num');
            $coupon = input('post.coupon');
            $autograph = input('post.autograph');
            $message = input('post.message');
            $lambnames = Request::instance()->param()['lambname'];
            $time = time();
            //return array('type'=>0,'msg'=>'lambname'.print_r($lambnames));
            $uid = $this -> member['id'];
            if(!empty($gid)){
                $mygoods=Db::name('goods')->where("id=$gid")->find();
                $price = 0;
                if(!empty($coupon)){
                    //检测优惠券是否可用
                    $iscoupon = db('coupon_data')
                        ->field('cd.*,c.couponname,c.enough,c.deduct,c.backtype,c.islimit,c.stime,c.etime')
                        ->alias('cd')
                        ->join('__COUPON__ c','cd.couponid = c.id','LEFT')
                        ->where(array('cd.uid'=> $this->member['id'],'cd.used'=>0,'c.status'=>1,'c.stime'=>['<=',$time],'c.etime'=>['>',$time],'cd.id'=>$coupon))
                        ->whereOr("`cd`.`uid`= $uid and `cd`.`used` = 0 and `c`.`status`= 1 and `c`.`stime` <= $time and `c`.`etime`= 0 and `cd`.`id`=$coupon")
                        ->where(' (c.islimit=0 or (c.islimit=1 and c.limitid="'.$mygoods['type'].'") or (c.islimit=2 and limitid="'.$gid.'")) ')->find();
                }
                //return array('type'=>0,'msg'=>"$uid");
                //return array('type'=>0,'msg'=>$iscoupon,'xx'=>$num*$mygoods['price']);
                //实付款
                $couponis = FALSE;
                if(!empty($iscoupon)){
                    if($iscoupon['enough'] == 0 or $iscoupon['enough'] <= $num*$mygoods['price']){
                        if($iscoupon['backtype']==1){
                            $price =$num*$mygoods['price']*$iscoupon['deduct']/10;
                        }else if($iscoupon['backtype']==0){
                            $price =$num*$mygoods['price']-$iscoupon['deduct'];
                        }
                        //已使用优惠券
                        $couponis = TRUE;
                    }else{
                        $price =$num*$mygoods['price'];
                        $couponis = FALSE;
                    }
                }else{
                    $price =$num*$mygoods['price'];
                }

                if($num<=$mygoods['stock']){//购买数量需要小于等于库存
                    //生成订单
                    $order_data = array(
                        'ordersn' =>'YY'.date('Ymd') .strtoupper(dechex(date('m'))) . date('d') . substr(time(), -5) . substr(microtime(), 2, 5) . sprintf('%02d', rand(0, 99)),
                        'uid' =>Session::get('user')['user_id'],
                        'money' =>$num*$mygoods['price'],
                        'price' =>$price,
                        'creationtime' =>time(),
                        'status' =>0
                    );
                    db('order')->insert($order_data);//生成订单
                    //修改优惠券使用状态
                    if($couponis){
                        db('coupon_data')->where(array('id'=>$coupon,'uid'=> $this->member['id']))->update(array('used'=>'1','usetime'=>$time,'ordersn'=>$order_data['ordersn']));
                    }
                    //生成购货合同签名
                    if(!empty($autograph)){
                        $iscontract = db('contract')->insert(array('ordersn'=>$order_data['ordersn'],'uid'=> $this->member['id'],'autograph'=>$autograph));
                    }

                    //商品库存减少
                    Db::name('goods')->where('id', $gid)->setDec('stock', $num);
                    //生成订单商品关联表
                    $myorder=Db::name('order')->where(array('ordersn'=>$order_data['ordersn']))->find();
                    $order_goods_data = array(
                        'oid' =>$myorder['id'],
                        'gid' =>$gid,
                        'num' =>$num,
                        'money' =>$num*$mygoods['price'],
                        'time'=>time()
                    );
                    db('order_goods')->insert($order_goods_data);//生成订单商品表
                }
            }else{
                return array('type'=>0,'msg'=>'获取商品信息失败！');
            }
            $oid = $myorder['id'];
            if(!empty($oid)){
                $myorder=Db::name('order')
                    ->field('o.*,og.gid,og.num,g.img ')
                    ->alias('o')
                    ->join('__ORDER_GOODS__ og','o.id = og.oid','LEFT')
                    ->join('__GOODS__ g','og.gid = g.id','LEFT')
                    ->where(array('o.id'=>$oid))
                    ->order('o.id', 'desc')
                    ->find();
                if($myorder['status']==0){
                    //生成羊羔
                    foreach ($lambnames as $v){
                        //这个是生成的写法
//                        $lamb_data = array(
//                            'lambsn' =>'LAMB'.date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8).str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT),
//                            'uid' =>Session::get('user')['user_id'],
//                            'oid' =>$myorder['id'],
//                            'gid' =>$myorder['gid'],
//                            'lambname' =>$v?$v: sjname(),
//                            'message' =>$message?$message:'天空因为你们而更加蓝。',
//                            'creationtime' => time(),
//                            'status'=>0
//                        );
//                        db('lamb')->insert($lamb_data);

                        //这个是分配的写法
                        $lamb_data = array(
                            'uid' =>Session::get('user')['user_id'],
                            'oid' =>$myorder['id'],
                            'lambname' =>$v?$v: sjname(),
                            'message' =>$message?$message:'天空因为你们而更加蓝。',
                            'status'=>0
                        );
                        //获取羊羔id
                        $islamb = db('lamb')->where(array('gid'=>$myorder['gid'],'status'=>0,'uid'=>0,'oid'=>0))->order('id','ASC')->find();
                        $isupdate = db('lamb')->where('id',$islamb['id'])->update($lamb_data);
                        if(empty($isupdate)){
                            return array('type'=>0,'msg'=>'获取羊羔失败，订单取消！');
                        }
                    }
                    Db::name('order')->where('id',$myorder['id'])->setField('status', '0');
                }
                return array('type'=>1,'msg'=>'申请提交成功！','oid'=>$myorder['id']);
            }else{
                return array('type'=>0,'msg'=>'申请提交失败！');
            }
        }else{
            return array('type'=>0,'msg'=>'申请提交失败！');
        }
    }
    public function pay(){
        $oid = input('oid');
        $time=time();
        $paystr = fangwenleixing();

        //如果身份证，邮箱，真实姓名没有绑定不能购买|| empty($this->member['cardid'])


        if(Request::instance()->isPost()){
            if(empty($this->member['realname'])){
                //$this->success("购买此商品前需完善信息","/index/user/perfectinfo");
                return array('type'=>-2,'data'=>'购买此商品前需完善信息','url'=>url('index/user/perfectinfo'));
            }
            $paytype= input('post.paytype');
            $myorder=Db::name('order')->where('id',$oid)->find();
            $member = Db::name('member')->where('id', Session::get('user')['user_id'])->find();
            if($myorder['status']==0){
                if($paytype==1){
                    $error_count = db('member') -> where('id',$member['id']) ->value('error_count');
                    $error_time = db('member') -> where('id',$member['id']) ->value('error_time');
                    if(!empty($error_time)){
                        $time = time() - $error_time;
                        if($time > 3600*24){
                            db('member') -> where('id',$member['id'])->update(array('error_count'=> 0));
                            db('member') -> where('id',$member['id'])->update(array('error_time'=> 0));
                        }else{
                            $hour = 24 - floor($time/(3600*24));
                            return array('type'=>-1,'data'=>'支付密码错误超过5次，请'.$hour.'小时后再试');
                        }
                    }

//                    if($error_count > 6){
//                        return array('type'=>-1,'data'=>'支付密码错误5次，请24小时后再试');
//                    }
                    $paypwd = md5(input('paypwd'));
                    $paypwd1 = db('member')->where('id',$member['id'])->value('paypwd');
                    if(empty($paypwd1)){
                       // $this->success("购买此商品前需设置支付密码","/index/user/paypassword");
                        return array('type'=>0,'data'=>'购买此商品前需设置支付密码','url'=>'/index/user/paypassword');
                    }
                    if($paypwd !== $paypwd1){

                        db('member') -> where('id',$member['id'])->setInc('error_count');
                        $error_count = db('member') -> where('id',$member['id']) ->value('error_count');
                        if($error_count < 6){
                            return array('type'=>0,'data'=>'支付密码错误');
                        }else{
                            db('member') -> where('id',$member['id'])->update(array('error_time'=> time()));
                            return array('type'=>0,'data'=>'支付密码错误超过5次，请24小时再试');
                        }

                    }else{
                        db('member') -> where('id',$member['id'])->update(array('error_count'=> 0));
                    }
                    //用户余额大于等于订单金额时
                    if($member['credit']>=$myorder['price']){
                        Db::name('member')->where('id', $member['id'])->setDec('credit', $myorder['price']);
                        Db::name('order')->where('id', $oid)->update(['status' => '1','paytype'=>1,'paytime'=>$time]);
                        Db::name('lamb')->where('oid', $oid)->update(['status' => '1','paytime'=>$time]);
                        //下单成功生成支付日志
                        $data=array(
                            'rechargesn'=>'',
                            'userid'=>$member['id'],
                            'money'=>$myorder['price'],
                            'vary'=>2,//1表示增加
                            'balance'=>($member['credit']-$myorder['price']),//余额
                            'type'=>5,//2表示微信
                            'time'=>time(),
                            'remark'=>'买羊羔',
                            'status'=>1,//生效
                        );
                        db('recharge_log')->insert($data);
                        //处理分销计算
                       // $commission = $this->setCommission($oid);

                        //支付处理函数，处理积分以及涨幅计算
                        $integral = $this->payhandle($oid,$time);
                        if(!empty($integralstr)){
                            $integralstr = ',并获得了'.$integral.'积分';
                        }else{
                            $integralstr = '';
                        }
                        return array('type'=>1,'data'=>'购买成功！'.$integralstr);
                    }else{
                        return array('type'=>0,'data'=>'余额不足，请预充值后领养或选择其他方式支付');
                    }
                }elseif ($paytype==2) {
                    return array('type'=>0,'data'=>'微信支付不会跳到这里来。');
                } else {
                    return array('type'=>0,'data'=>'未开通该支付方式');
                }
            }else if($myorder['status']==1){
                return array('type'=>0,'data'=>'订单已经支付，无须重新支付！');
            }
        }
        $myorder=Db::name('order')
            ->field('o.*,l.gid,l.lambname,l.message,g.img,g.percentage,g.cycle ')
            ->alias('o')
            ->join('__LAMB__ l','o.id = l.oid','LEFT')
            ->join('__GOODS__ g','l.gid = g.id','LEFT')
            ->where(array('o.id'=>$oid))
            ->order('o.id', 'desc')
            ->select();
        $openid = $this->member['openid'];
        if(!empty($this->member['openid']) && $myorder[0]['status']==0 && $paystr=='wechat'){
            $params['body'] = '支付订单'; //商品简单描 $params['body'] 商品简单描述述
            $params['out_trade_no'] = $myorder[0]['ordersn']; //商户订单号, 要保证唯一性
            $params['total_fee'] = $myorder[0]['price']*100; //标价金额, 请注意, 单位为分!!!!!

            try{
                $jsApiParameters = \wxpay\JsapiPay::getParams($params,$openid);
                $this->assign('jsApiParameters',$jsApiParameters );
            }catch (Exception $e){
                $this->assign('jsApiParameters',array());
            }
        }else{
            $isjsp=1;
            $this->assign('isjsp',$isjsp);
        }

        $this->assign('paystr', $paystr);
        $this->assign('myorder', $myorder);
        $this->assign('webtitle', '支付');
        $this->assign('oid',$oid);
        $this->assign('openid',$openid);
        return $this->fetch();
    }
    public function addmallorder(){
        if(Request::instance()->isPost()){
            $posts = Request::instance()->param();
            if(empty($posts['num'])){
                return array('type'=>0,'msg'=>'未选中商品。');
            }
            $time = time();
            //return array('type'=>0,'msg'=>'lambname'.print_r($posts));
            $mygoods = array();
            $myintegral = array();
            $integral = 0;
            foreach ($posts['num'] as $s=>$v){
                $mygoods[] = $isgoods =Db::name('goods')->field('id,gname,img,price2,creationtime,stock')->where(array('id'=>$s))->find();
                if($v > $isgoods['stock']){
                    return array('type'=>0,'msg'=>$isgoods['gname'].'库存不足');
                }
                if(($isgoods['price2']*$v)<=0){
                    return array('type'=>0,'msg'=>$isgoods['gname'].'商品价格有误');
                }
                $integral +=  $isgoods['price2']*$v;
                $myintegral[$s] = $isgoods['price2']*$v;
            }
            //生成订单
            $order_data = array(
                'ordersn' =>'YY'.date('Ymd') .strtoupper(dechex(date('m'))) . date('d') . substr(time(), -5) . substr(microtime(), 2, 5) . sprintf('%02d', rand(0, 99)),
                'uid' =>Session::get('user')['user_id'],
                'integral' =>$integral,
                'creationtime' =>time(),
                'status' =>0
            );
            db('order')->insert($order_data);//生成订单
            $isorder=Db::name('order')->where(array('ordersn'=>$order_data['ordersn']))->find();
            foreach ($posts['num'] as $s=>$v){
                //商品库存减少
                Db::name('goods')->where('id', $s)->setDec('stock', $v);
                Db::name('goods')->where('id', $s)->setInc('sold', $v);
                //生成订单商品关联表

                $order_goods_data = array(
                    'oid' =>$isorder['id'],
                    'gid' =>$s,
                    'num' =>$v,
                    'integral' =>$myintegral[$s],
                    'time'=>time()
                );
                db('order_goods')->insert($order_goods_data);//生成订单商品表
            }
            if(!empty($isorder)){
                return array('type'=>1,'msg'=>'订单提交成功','oid'=>$isorder['id']);
            }else{
                return array('type'=>0,'msg'=>'订单提交失败');
            }
        } else {
            return array('type'=>0,'msg'=>'请求错误');
        }
    }
    public function mallpay(){
        $oid = input('oid');
        $time=time();
        $paystr = fangwenleixing();
        //如果身份证，邮箱，真实姓名没有绑定不能购买|| empty($this->member['cardid'])
        if(empty($this->member['realname']) ){
            $this->success("购买此商品前需完善信息","/index/user/perfectinfo");
        }
        if(Request::instance()->isPost()){
            $paytype= input('post.paytype');
            $myorder=Db::name('order')->where('id',$oid)->find();
            $member = Db::name('member')->where('id', Session::get('user')['user_id'])->find();
            if($myorder['status']==0){
                if($paytype==5){
                    //用户余额大于等于订单金额时
                    if($member['credit2']>=$myorder['integral']){
                        $isaddress = db('address')->where(array('uid'=> $this->member['id'],'defaults'=>1))->find();
                        if(!empty($isaddress)){
                            $myaddress = $isaddress['name'].'('.$isaddress['phone'].')'.$isaddress['province'].$isaddress['city'].$isaddress['area'].$isaddress['detailed'];
                        } else {
                            $myaddress = '';
                        }
                        Db::name('member')->where('id', $member['id'])->setDec('credit2', $myorder['integral']);
                        Db::name('order')->where('id', $oid)->update(['status' => '1','paytype'=>5,'paytime'=>$time,'address'=>$myaddress]);
                        //下单成功生成支付日志
                        $data=array(
                            'rechargesn'=>'',
                            'userid'=>$member['id'],
                            'money_type'=>2,//2表示积分日志
                            'money'=>$myorder['integral'],
                            'vary'=>2,//1表示增加
                            'balance'=>($member['credit2']-$myorder['integral']),//余额
                            'type'=>5,//2表示微信
                            'time'=>time(),
                            'remark'=>'积分兑换商品',
                            'status'=>1,//生效
                        );
                        db('recharge_log')->insert($data);

                        //支付处理函数，处理积分以及涨幅计算

                        // 初始化
                        cookie(['prefix' => 'shopcart_', 'expire' => 3600*24]);
                        // 删除
                        cookie('mall', null);
                        return array('type'=>1,'data'=>'兑换成功！');
                    }else{
                        return array('type'=>0,'data'=>'积分不足，购买失败。');
                    }
                }elseif ($paytype==2) {
                    return array('type'=>0,'data'=>'微信支付不会跳到这里来。');
                } else {
                    return array('type'=>0,'data'=>'未开通该支付方式');
                }
            }else if($myorder['status']==1){
                return array('type'=>0,'data'=>'订单已经支付，无须重新支付！');
            }
        }
        $myorder=Db::name('order')
            ->field('o.*,og.num,g.gname,g.img,g.price2,g.cycle ')
            ->alias('o')
            ->join('__ORDER_GOODS__ og','og.oid = o.id','LEFT')
            ->join('__GOODS__ g','og.gid = g.id','LEFT')
            ->where(array('o.id'=>$oid))
            ->order('o.id', 'desc')
            ->select();
        //die();
        //获取用户默认地址
        $isaddress = db('address')->where(array('uid'=> $this->member['id'],'defaults'=>1))->find();
        $this->assign('isaddress', $isaddress);
        $this->assign('myorder', $myorder);
        $this->assign('webtitle', '支付');
        return $this->fetch();
    }

    public function paytest(){
        $params['body'] = '测试充值'; //商品简单描 $params['body'] 商品简单描述述
        $params['out_trade_no'] = 'CZ'.date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8). str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT); //商户订单号, 要保证唯一性
        $params['total_fee'] = 1; //标价金额, 请注意, 单位为分!!!!!
        $openid = Session::get('user')['openid'];
        $jsApiParameters = \wxpay\JsapiPay::getParams($params,$openid);
        $this->assign('jsApiParameters',$jsApiParameters );
        return $this->fetch();
    }
    function isWeixin(){
        if ( strpos($_SERVER['HTTP_USER_AGENT'],'MicroMessenger') !== false ) {
            return true;
        }
        return false;
    }

    public function pingpay(){
       // \Pingpp\Pingpp::setApiKey('sk_test_WP4qr5en5yDGPSqXjLPib5S8');
        \Pingpp\Pingpp::setApiKey('sk_live_HaPKyTKmz5eDiXXTyL90O80K');
        \Pingpp\Pingpp::setPrivateKeyPath(__DIR__ . '/rsa_private_key.pem');

        $input_data = json_decode(file_get_contents('php://input'), true);
        if (empty($input_data['channel']) || empty($input_data['amount'])) {
            echo 'channel or amount is empty';
            exit();
        }
        $channel = strtolower($input_data['channel']);
        $amount = $input_data['amount'];
        $oid = input('oid');
        $orderNo = db('order')->where('id',$oid)->value('ordersn');

        /**
         * $extra 在使用某些渠道的时候，需要填入相应的参数，其它渠道则是 array()。
         * 以下 channel 仅为部分示例，未列出的 channel 请查看文档 https://pingxx.com/document/api#api-c-new；
         * 或直接查看开发者中心：https://www.pingxx.com/docs/server；包含了所有渠道的 extra 参数的示例；
         */
        $channel_extra = dirname(__FILE__) . '/channel_extra/'. $channel .'.php';
        $extra = file_exists($channel_extra) ? require_once $channel_extra : [];
        if($channel == 'wx_pub'){
            $open_id = db('member')->where('id',$this->member['id'])->value('openid');
            if($open_id){
                $extra = ['limit_pay'=>'no_credit','open_id'=>$open_id];
            }else{
                return false;
            }

        }

            try {
                $ch = \Pingpp\Charge::create(
                    array(
                        // 请求参数字段规则，请参考 API 文档：https://www.pingxx.com/api#api-c-new
                        'subject'   => 'Your Subject',
                        'body'      => 'Your Body',
                        'amount'    => $amount,                 // 订单总金额, 人民币单位：分（如订单总金额为 1 元，此处请填 100）
                        'order_no'  => $orderNo,                // 推荐使用 8-20 位，要求数字或字母，不允许其他字符
                        'currency'  => 'cny',
                        'extra'     => $extra,
                        'channel'   => $channel,                // 支付使用的第三方支付渠道取值，请参考：https://www.pingxx.com/api#api-c-new
                        'client_ip' => $_SERVER['REMOTE_ADDR'], // 发起支付请求客户端的 IP 地址，格式为 IPV4，如: 127.0.0.1
                        'app'       => array('id' => 'app_TKarPSnPi1i5T4aH'),

                    )
                );
                echo $ch;                                       // 输出 Ping++ 返回的支付凭据 Charge
            } catch (\Pingpp\Error\Base $e) {
                // 捕获报错信息
                if ($e->getHttpStatus() != null) {
                    header('Status: ' . $e->getHttpStatus());
                    echo $e->getHttpBody();
                } else {
                    echo $e->getMessage();
                }
            }

        }

    public function success_alipay(){
        echo 1;
    }
    public function alipay_in_weixin()
    {
        \Pingpp\Pingpp::setApiKey('sk_live_HaPKyTKmz5eDiXXTyL90O80K');
        \Pingpp\Pingpp::setPrivateKeyPath(__DIR__ . '/rsa_private_key.pem');

        $input_data = json_decode(file_get_contents('php://input'), true);
        $input_data['channel'] = 'alipay_wap';
        $input_data['amount'] = 1;
        if (empty($input_data['channel']) || empty($input_data['amount'])) {
            echo 'channel or amount is empty';
            exit();
        }
        $channel = strtolower($input_data['channel']);
        $amount = $input_data['amount'];
        $oid = input('oid');
        $orderNo = db('order')->where('id', $oid)->value('ordersn');
        $orderNo ='YY123';
        /**
         * $extra 在使用某些渠道的时候，需要填入相应的参数，其它渠道则是 array()。
         * 以下 channel 仅为部分示例，未列出的 channel 请查看文档 https://pingxx.com/document/api#api-c-new；
         * 或直接查看开发者中心：https://www.pingxx.com/docs/server；包含了所有渠道的 extra 参数的示例；
         */
        $channel_extra = dirname(__FILE__) . '/channel_extra/' . $channel . '.php';
        $extra = file_exists($channel_extra) ? require_once $channel_extra : [];
        if ($channel == 'wx_pub') {
            $open_id = db('member')->where('id', $this->member['id'])->value('openid');
            if ($open_id) {
                $extra = ['limit_pay' => 'no_credit', 'open_id' => $open_id];
            } else {
                return false;
            }

        }
        if ($channel == 'alipay_wap' && $this->isWeixin()) {
            try {
                $ch = \Pingpp\Charge::create(
                    array(
                        // 请求参数字段规则，请参考 API 文档：https://www.pingxx.com/api#api-c-new
                        'subject' => 'Your Subject',
                        'body' => 'Your Body',
                        'amount' => $amount,                 // 订单总金额, 人民币单位：分（如订单总金额为 1 元，此处请填 100）
                        'order_no' => $orderNo,                // 推荐使用 8-20 位，要求数字或字母，不允许其他字符
                        'currency' => 'cny',
                        'extra' => $extra,
                        'channel' => $channel,                // 支付使用的第三方支付渠道取值，请参考：https://www.pingxx.com/api#api-c-new
                        'client_ip' => $_SERVER['REMOTE_ADDR'], // 发起支付请求客户端的 IP 地址，格式为 IPV4，如: 127.0.0.1
                        'app' => array('id' => 'app_TKarPSnPi1i5T4aH')
                    )
                );
                //echo $ch;                                       // 输出 Ping++ 返回的支付凭据 Charge
            } catch (\Pingpp\Error\Base $e) {
                // 捕获报错信息
                if ($e->getHttpStatus() != null) {
                    header('Status: ' . $e->getHttpStatus());
                    echo $e->getHttpBody();
                } else {
                    echo $e->getMessage();
                }
            }
            //return $this->fetch();
//header("location:".\url('index/order/alipay_in_weixin'));
        } else {
            try {
                $ch = \Pingpp\Charge::create(
                    array(
                        // 请求参数字段规则，请参考 API 文档：https://www.pingxx.com/api#api-c-new
                        'subject' => 'Your Subject',
                        'body' => 'Your Body',
                        'amount' => $amount,                 // 订单总金额, 人民币单位：分（如订单总金额为 1 元，此处请填 100）
                        'order_no' => $orderNo,                // 推荐使用 8-20 位，要求数字或字母，不允许其他字符
                        'currency' => 'cny',
                        'extra' => $extra,
                        'channel' => $channel,                // 支付使用的第三方支付渠道取值，请参考：https://www.pingxx.com/api#api-c-new
                        'client_ip' => $_SERVER['REMOTE_ADDR'], // 发起支付请求客户端的 IP 地址，格式为 IPV4，如: 127.0.0.1
                        'app' => array('id' => 'app_TKarPSnPi1i5T4aH')
                    )
                );
                echo $ch;                                       // 输出 Ping++ 返回的支付凭据 Charge
            } catch (\Pingpp\Error\Base $e) {
                // 捕获报错信息
                if ($e->getHttpStatus() != null) {
                    header('Status: ' . $e->getHttpStatus());
                    echo $e->getHttpBody();
                } else {
                    echo $e->getMessage();
                }
            }
           // return $this->fetch();
        }
    }
}
