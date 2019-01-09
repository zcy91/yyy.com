<?php

namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Session;
use think\Input;
use clt\Leftnav;
use think\Request;
use PHPMailer\PHPMailer;

use mywechat;
use alidayu;

class Base extends Controller  {
    public $member;
    public $setting;
    public $wc;
    function _initialize()
    {
//        exit('<h1 style="margin: auto;text-align: center; position: absolute;left: 35%; top: 50%;
//    margin: -50px 0 0 -50px; margin-left: auto; margin-right: auto;">维护中...请耐心等待！</h1>');
        $this->setting = Db::name('setting')->find();
        //旅游返利
 //       $data = db('sell_lamb')->where(['exchange'=>3,'status'=>2,'issend'=>0])->where("stime <= ".time())->limit(5)->select();
        //var_dump($data);die;
//        foreach ($data as $v){
//            $oid = db('lamb')->where('id',$v['lambid'])->value('oid');
//            $this->setCommissionOne($oid,$v['lambid']);
//        }
        //检测代理过期
        $sql = "select *, max(endtime) as max_endtime from yyy_agent group by uid";
       $agent =  db::query($sql);
       //$agent = db('agent') ->group('uid')->select();
        //var_dump($agent);die;
        if(!empty($agent)){
            foreach ($agent as $v){
                if($v['max_endtime'] < time()){
                    db('member') -> where("id = ".$v['uid'])->update(['is_agent'=>0]);
                }
            }
        }

        //自动收货
        $delivery_time = time() - ($this->setting['delivery_time'] * 86400);

        $order_confirm = db('sell_lamb')->where([
            'isdelete' => 0, 'exchange' => 1, 'issend' => 0, 'completetime' => 0,'status'=>3
        ])->where( "shipping_time <= $delivery_time")->limit(5)->select();



        foreach ($order_confirm as $k => $v) {
            db('sell_lamb')->where(['id' => $v['id']])->update(['completetime' => time(), 'status'=>2]);
//            $lambid = db('sell_lamb')->where('sellsn',$v['sellsn'])->value('lambid');
//
//            $oid= db('lamb')->where('id',$v['lambid'])->value('oid');
//            $this->setCommissionOne($oid,$lambid);

        }

        $request = Request::instance();
        $action = $request->action();
        $controller = $request->controller();
        $this->assign('controller', strtolower($controller));
        define('MODULE_NAME', strtolower($controller));
        if (MODULE_NAME == 'user' || MODULE_NAME == 'order'|| MODULE_NAME == 'mall'|| MODULE_NAME == 'shop') {
            if (!Session::has('user')) {
            if (strstr($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger')) {  //判断微信浏览器
                $this->wc = Db::name('wx_set')->find();

                if (empty($_GET['code'])) {
                    $appid = $this->wc['appid'];
                    $redirect_uri = urlencode($this->get_url());
                    $wxchat = new mywechat\wechat();
                    $wxchat->getCode1($appid, $redirect_uri, $wx = 'wx');
                    exit();
                } else {

                    $code = $_GET['code'];
                    $appid = $this->wc['appid'];
                    $appsecret = $this->wc['appsecret'];
                    $wxchat_token = new mywechat\wechat();
                    $access_token = $wxchat_token->getWebAccessToken($appid, $appsecret, $code);
                    //dump($access_token);die;
                    if (empty($access_token['openid'])) {
                        $this->success("Openid获取失败！", url("/index/index/index"));
                    }
                    $accesstoken = mywechat\wechat::getAccessToken($appid, $appsecret);
                    $user_info = mywechat\wechat::getUserInfo($accesstoken, $access_token['openid'], 2);
                }
                //var_dump($user_info);die;
//                if (!empty($user_info['subscribe']) && $user_info['subscribe'] == 1) {
                    $status = Db::name('member')->where('openid', $user_info['openid'])->where('unionid', $user_info['unionid'])->find();
                    if (!empty($status)) {
                        Session::set('user', array("user_id" => $status['id'], 'openid' => $status['openid'], 'unionid' => $status['unionid']));
                        $this->member = db('member')->where('id', Session::get('user')['user_id'])->find();
                        $agentid = $this->member['id'];
                    }
//
//                }
            }
                if(!empty($_COOKIE['app_token'])){
                $userarr = db('member') -> where('unionid',$_COOKIE['app_token'])->find();
                    if(!empty($userarr)){
                        Session::set('user', array("user_id" => $userarr['id'], 'openid' => $userarr['openid'], 'unionid' => $userarr['unionid']));
                    }
                }
                else if (empty($_COOKIE['mobile']) || empty($_COOKIE['password'])) {
                    header("Location: " . url('/index/login/login'));
                    exit();
                } else {
                    $password = $_COOKIE['password'];
                    $mobile = $_COOKIE['mobile'];
                    $where = ['mobile' => $mobile, 'status' => 0];
                    $pass = db('member')->where($where)->value('password');
                    $pass = md5('yyy') . $pass . 'yyy';
                    if ($password == $pass) {
                        $status = db('member')->where($where)->find();
                        Session::set('user', array("user_id" => $status['id'], 'openid' => $status['openid'], 'unionid' => $status['unionid']));
                        $this->member = db('member')->where('id', Session::get('user')['user_id'])->find();
                        $agentid = $this->member['id'];
                    } else {
                        header("Location: " . url('/index/login/login'));
                        exit();
                    }

                }
            }

            if (Session::has('user')) {
                $this->member = db('member')->where('id', Session::get('user')['user_id'])->find();
                $agentid = $this->member['id'];
            }
        }
            $this->setting = Db::name('setting')->find();
            $this->wc = Db::name('wx_set')->find();
            $wxset = Db::name('wx_set')->find();
            $jssdk = new mywechat\jssdk($wxset['appid'], $wxset['appsecret']);//()($wxset['appid'], $wxset['appsecret'])
            try {
                $signPackage = $jssdk->GetSignPackage();
            } catch (\Exception $e) {
                $signPackage = array();
            }
            //获取客户端
            $clientType = fangwenleixing();
            $this->assign('clientType', $clientType);
            $this->assign('signPackage', $signPackage);
            $this->assign('setting', $this->setting);

    }
    public function getAccessToken($appid,$appsecret) {
        // access_token 应该全局存储与更新，以下代码以写入到文件中做示例
        ////**************use think\Cache;
        $access_token = Cache::get('access_token');
        if (empty($access_token)) {
            // 如果是企业号用以下URL获取access_token
            // $url = "https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid=$this->appId&corpsecret=$this->appSecret";
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
            $res = json_decode($this->httpGet($url));
            $access_token = $res->access_token;
            if ($access_token) {
                $expire = $res->expires_in -100;
                Cache::set('access_token',$access_token,$expire);
            }else{
                return $res;
            }
        } else {
            return ($access_token);
        }

    }
    private function httpGet($url) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 500);
        // 为保证第三方服务器与微信服务器之间数据传输的安全性，所有微信接口采用https方式调用，必须使用下面2行代码打开ssl安全校验。
        // 如果在部署过程中代码在此处验证失败，请到 http://curl.haxx.se/ca/cacert.pem 下载新的证书判别文件。
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($curl, CURLOPT_URL, $url);

        $res = curl_exec($curl);
        curl_close($curl);

        return $res;
    }
    /**
     * 获取当前的url 地址
     * @return type
     */
    private function get_url() {
        $sys_protocal = isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
        $php_self = $_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];
        $path_info = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '';
        $relate_url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $php_self.(isset($_SERVER['QUERY_STRING']) ? '?'.$_SERVER['QUERY_STRING'] : $path_info);
        return $sys_protocal.(isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '').$relate_url;
    }

    function sendmail($title,$content,$address=''){
        $emailset = Db::name('email_set')->order('id', 'desc')->find();
         //实例化
        $mail=new PHPMailer\PHPMailer;
        try{
            //邮件调试模式
            $mail->SMTPDebug = 0;  
            //设置邮件使用SMTP
            $mail->isSMTP();
            // 设置邮件程序以使用SMTP
            $mail->Host = $emailset['host'];
            // 设置邮件内容的编码
            $mail->CharSet='UTF-8';
            // 设置中文提示
            // 
            // 启用SMTP验证
            $mail->SMTPAuth = true;
            // SMTP username
            $mail->Username = $emailset['username'];
            // SMTP password
            $mail->Password = $emailset['password'];
            // 启用TLS加密，`ssl`也被接受
            if(!empty($emailset['secure'])){
                $mail->SMTPSecure = 'tls';
            }
            // 连接的TCP端口
            $mail->Port = $emailset['port'];
            //设置发件人
            $mail->setFrom($emailset['from']);
           //  添加收件人
            if(empty($address)){
                $mail->addAddress($emailset['address']);
            } else {
                $mail->addAddress($address);
            }
            

            $mail->isHTML(true);
            $mail->Subject = $title;
            $mail->Body    = $content;
//            $mail->AltBody = '这是非HTML邮件客户端的纯文本';
            $issend = $mail->send();
            
            $mail->isSMTP();
            if($issend){
                return array('status'=>1,'msg'=>'发送成功！');
            }else{
                return array('status'=>0,'msg'=>$mail->ErrorInfo);
            }
        }catch (Exception $e){
            return array('status'=>0,'msg'=>$mail->ErrorInfo);
        }
    }
    
    function payhandle($oid,$time,$issms=true){
        $mygoods = Db::name('order_goods')
                    ->field('g.*,o.ordersn')
                    ->alias('og')
                    ->join('__GOODS__ g','og.gid = g.id','LEFT')
                    ->join('__ORDER__ o','og.oid = o.id','LEFT')
                    ->where(array('og.oid'=>$oid))
                    ->select();
        if($issms){
            //短信提示购买成功
            //SMS_122282350:尊敬的${name}，恭喜您认领${goods}成功，成为食花百草羊尊贵牧场主！
            $smsset=Db::name('sms_set')->find();
            $phone = $this->member['mobile'];
            $smsname = $this->member['username'];
            $smsgoods = $mygoods[0]['gname'];
            $smsorder = $mygoods[0]['ordersn'];
            if($smsset['status']==1 && !empty($phone)){//开启了短信接口
                $sms = new \alidayu\SmsApi($smsset['access_key_id'], $smsset['access_key_secret']);
                $response = $sms->sendSms(
                    $smsset['sms_autograph'], // 短信签名
                    'SMS_122282350', // 短信模板编号
                    "$phone", // 短信接收者
                    Array (  // 短信模板中字段的值
                        "name"=>"$smsname",
                        "goods"=>"$smsgoods",
                        "order"=>"$oid"
                    ),
                    "123"   // 流水号,选填
                );
                if($response['Code']=='OK'){
                    //print_r( array('type'=>1,'data'=>'验证码发送成功！'));
                }else{
                    //print_r( array('type'=>2,'data'=>'发送失败，错误代码：'.$response['Code']));
                }
            }
        }
        
        
        //如果该商品有积分的话送积分。
        
        $integral=0;
        foreach ($mygoods as $v){
            if(!empty($v['integral'])){
                if($v['integral']>0){
                    Db::name('member')->where('id', $this->member['id'])->setInc('credit2', $v['integral']);
                    //积分做记录
                    $iscredit2 = Db::name('member')->where('id', $this->member['id'])->find();
                    $recharge_data=array(
                        'userid'=>$this->member['id'],
                        'money_type'=>2,
                        'money'=>$v['integral'],
                        'vary'=>1,
                        'type'=>1,
                        'time'=>time(),
                        'remark'=>'购买送积分',
                        'balance'=>$iscredit2['credit2']+$v['integral'],
                        'status'=>'1',
                    );
                    $isrecharge=db('recharge_log')->insert($recharge_data);
                }
                
            }
            $integral+=$v['integral'];
            //生成涨幅
            if(!empty($v['percentage'])){
                $total = round($v['price'] * $v['percentage']/100, 2);
                $num = 365 ; 
                if($total>=10){
                    $hongbaoarr = hongbao($total, $num);
                    $mylamb = Db::name('lamb')->where(array('oid'=>$oid,'status'=>1))->select();
                    //获取零点时间戳
                    $lingtime = strtotime(date("Y-m-d ", $time));
                    foreach ($mylamb as $v){
                        //存序列化中。
                        $rose = array();
                        foreach ($hongbaoarr as $ss=>$vv){
                             $rose[$lingtime+($ss*86400)]=$vv;
                        }
                        $serrose = serialize($rose);
                        Db::name('lamb')->where('id', $v['id'])->update(['rose' => $serrose]);
                    }
                }
            }
        }
        if(!empty($integral)){
            return $integral;
        }else{
            return 0;
        }
    }
    /**
     * 
     * @param type $uid 设置推荐奖励
     */
    public function setRecommend($uid){
        if(!empty($uid)){
            $member = db('member')->where(array('id'=>$uid))->find();
            if(!empty($member)){
                $agentid = $member['agentid'];
            }
            if(!empty($agentid)){
                $agentmember = db('member')
                                ->field('m.id,m.credit,m.credit2,ml.isrecommend,ml.recommend_type,ml.recommend_prize')
                                ->alias('m')
                                ->join('__MEMBER_LEVEL__ ml','m.level = ml.level','LEFT')
                                ->where(array('m.id'=>$agentid))
                                ->find();
                        //print_r($agentmember);
                if(!empty($agentmember['isrecommend'])){
                    if($agentmember['recommend_type']==1){
                        $data = array(
                            'ordersn'=>0,
                            'og_id'=>0,
                            'prizeid'=>$agentid,
                            'money_type'=>1,
                            'money'=>$agentmember['recommend_prize'],
                            'type'=>4,
                            'content'=>'邀请好友送'.$agentmember['recommend_prize'].'余额',
                            'stime'=>time(),
                            'etime'=>time(),
                            'statue'=>3,
                        );
                        db('commission_log')->insert($data);
                        db('member')->where('id',$agentmember['id'] )->setInc('credit', $agentmember['recommend_prize']);
                        $recharge_data=array(
                            'userid'=>$agentmember['id'],
                            'money'=>$agentmember['recommend_prize'],
                            'vary'=>1,
                            'type'=>1,
                            'time'=>time(),
                            'remark'=>'邀请送',
                            'balance'=>$agentmember['credit']+$agentmember['recommend_prize'],
                            'status'=>'1',
                        );
                        $isrecharge=db('recharge_log')->insert($recharge_data);
                    }elseif($agentmember['recommend_type']==2){
                        $data = array(
                            'ordersn'=>0,
                            'og_id'=>0,
                            'prizeid'=>$agentid,
                            'money_type'=>2,
                            'money'=>$agentmember['recommend_prize'],
                            'type'=>4,
                            'content'=>'邀请好友送'.$agentmember['recommend_prize'].'积分',
                            'stime'=>time(),
                            'etime'=>time(),
                            'statue'=>3,
                        );
                        db('commission_log')->insert($data);
                        db('member')->where('id',$agentmember['id'] )->setInc('credit2', $agentmember['recommend_prize']);
                        $recharge_data=array(
                            'userid'=>$agentmember['id'],
                            'money_type'=>2,
                            'money'=>$agentmember['recommend_prize'],
                            'vary'=>1,
                            'type'=>1,
                            'time'=>time(),
                            'remark'=>'邀请送',
                            'balance'=>$agentmember['credit2']+$agentmember['recommend_prize'],
                            'status'=>'1',
                        );
                        $isrecharge=db('recharge_log')->insert($recharge_data);
                    }elseif($agentmember['recommend_type']==3) {
                        $data = array(
                            'uid'=>$agentid,
                            'couponid'=>$agentmember['recommend_prize'],
                            'gettype'=>3,
                            'gettime'=> time(),
                        );
                        db('coupon_data')->insert($data);
                    }
                }
            }
        }
    }
    
    /**
     * 
     * @param type $uid 设置分销奖励
     */
    public function setCommission($oid){
        //获取订单信息
        $isorder = db('order')->where(array('id'=>$oid,'status'=>['>=',1],'status'=>['<',4]))->find();
        if(!empty($isorder['uid'])){
            //获取买家信息
            $buy = db('member')->where(array('id'=>$isorder['uid']))->find();
            //获取买家上级
            if(!empty($buy['agentid'])){
                $onemember = db('member')->where(array('id'=>$buy['agentid']))->find();
                //获取一级上级的权限
                $onelelver = db('member_level')->where(array('level'=>$onemember['level']))->find();
                if(!empty($onemember['agentid'])){
                    $twomember = db('member')->where(array('id'=>$onemember['agentid']))->find();
                    //获取一级上级的权限
                    $twolelver = db('member_level')->where(array('level'=>$twomember['level']))->find();
                    if(!empty($twomember['agentid'])){
                        $threemember = db('member')->where(array('id'=>$twomember['agentid']))->find();
                        //获取一级上级的权限
                        $threelelver = db('member_level')->where(array('level'=>$threemember['level']))->find();
                    }
                }
            }
            //获取订单对应的商品订单表
            $order_goods = db('order_goods')->where(array('oid'=>$oid))->select();
            foreach ($order_goods as $v){
                //1级
                if(!empty($onelelver['iscommission'])){
                    $onemoney = 0;
                    if($onelelver['commission_way']==1){
                        $onemoney = $onelelver['commission1'] *$v['num'];
                    }else{
                        $onemoney = $onelelver['commission1']*$v['money']/100;
                    }
                    if($onelelver['commission_type']==1 && $onemoney>0){
                        $data = array(
                            'ordersn'=>$isorder['ordersn'],
                            'og_id'=>$v['id'],
                            'prizeid'=>$onemember['id'],
                            'money_type'=>1,
                            'money'=>$onemoney,
                            'type'=>1,
                            'content'=>'一级分销奖送'.$onemoney.'余额',
                            'stime'=>time(),
                            'etime'=>time(),
                            'statue'=>3,
                        );
                        db('commission_log')->insert($data);
                        db('member')->where('id',$onemember['id'] )->setInc('credit', $onemoney);
                        $recharge_data=array(
                            'userid'=>$onemember['id'],
                            'money'=>$onemoney,
                            'vary'=>1,
                            'type'=>1,
                            'time'=>time(),
                            'remark'=>'一级分销送',
                            'balance'=>$onemember['credit']+$onemoney,
                            'status'=>'1',
                        );
                        $isrecharge=db('recharge_log')->insert($recharge_data);
                    }elseif($onelelver['commission_type']==2 && $onemoney>0){
                        $data = array(
                            'ordersn'=>$isorder['ordersn'],
                            'og_id'=>$v['id'],
                            'prizeid'=>$onemember['id'],
                            'money_type'=>2,
                            'money'=>$onemoney,
                            'type'=>1,
                            'content'=>'一级分销奖送'.$onemoney.'积分',
                            'stime'=>time(),
                            'etime'=>time(),
                            'statue'=>3,
                        );
                        db('commission_log')->insert($data);
                        db('member')->where('id',$onemember['id'] )->setInc('credit2', $onemoney);
                        $recharge_data=array(
                            'userid'=>$onemember['id'],
                            'money_type'=>2,
                            'money'=>$onemoney,
                            'vary'=>1,
                            'type'=>1,
                            'time'=>time(),
                            'remark'=>'一级分销送',
                            'balance'=>$onemember['credit2']+$onemoney,
                            'status'=>'1',
                        );
                        $isrecharge=db('recharge_log')->insert($recharge_data);
                    }
                }
                //2级
                if(!empty($twolelver['iscommission'])){
                    $twomoney = 0;
                    if($twolelver['commission_way']==1){
                        $twomoney = $twolelver['commission2'];
                    }else{
                        $twomoney = $twolelver['commission2']*$v['money']/100;
                    }
                    if($twolelver['commission_type']==1 && $twomoney>0){
                        $data = array(
                            'ordersn'=>$isorder['ordersn'],
                            'og_id'=>$v['id'],
                            'prizeid'=>$twomember['id'],
                            'money_type'=>1,
                            'money'=>$twomoney,
                            'type'=>2,
                            'content'=>'二级分销奖送'.$twomoney.'余额',
                            'stime'=>time(),
                            'etime'=>time(),
                            'statue'=>3,
                        );
                        db('commission_log')->insert($data);
                        db('member')->where('id',$twomember['id'] )->setInc('credit', $twomoney);
                        $recharge_data=array(
                            'userid'=>$twomember['id'],
                            'money'=>$twomoney,
                            'vary'=>1,
                            'type'=>1,
                            'time'=>time(),
                            'remark'=>'二级分销送',
                            'balance'=>$twomember['credit']+$twomoney,
                            'status'=>'1',
                        );
                        $isrecharge=db('recharge_log')->insert($recharge_data);
                    }elseif($twolelver['commission_type']==2 && $twomoney>0){
                        $data = array(
                            'ordersn'=>$isorder['ordersn'],
                            'og_id'=>$v['id'],
                            'prizeid'=>$twomember['id'],
                            'money_type'=>2,
                            'money'=>$twomoney,
                            'type'=>2,
                            'content'=>'二级分销奖送'.$twomoney.'积分',
                            'stime'=>time(),
                            'etime'=>time(),
                            'statue'=>3,
                        );
                        db('commission_log')->insert($data);
                        db('member')->where('id',$twomember['id'] )->setInc('credit2', $twomoney);
                        $recharge_data=array(
                            'userid'=>$twomember['id'],
                            'money_type'=>2,
                            'money'=>$twomoney,
                            'vary'=>1,
                            'type'=>1,
                            'time'=>time(),
                            'remark'=>'二级分销送',
                            'balance'=>$twomember['credit2']+$twomoney,
                            'status'=>'1',
                        );
                        $isrecharge=db('recharge_log')->insert($recharge_data);
                    }
                }//3级
                if(!empty($threelelver['iscommission'])){
                    $threemoney = 0;
                    if($threelelver['commission_way']==1){
                        $threemoney = $threelelver['commission3'];
                    }else{
                        $threemoney = $threelelver['commission3']*$v['money']/100;
                    }
                    if($threelelver['commission_type']==1 && $threemoney>0){
                        $data = array(
                            'ordersn'=>$isorder['ordersn'],
                            'og_id'=>$v['id'],
                            'prizeid'=>$threemember['id'],
                            'money_type'=>1,
                            'money'=>$threemoney,
                            'type'=>3,
                            'content'=>'三级分销奖送'.$threemoney.'余额',
                            'stime'=>time(),
                            'etime'=>time(),
                            'statue'=>3,
                        );
                        db('commission_log')->insert($data);
                        db('member')->where('id',$threemember['id'] )->setInc('credit', $threemoney);
                        $recharge_data=array(
                            'userid'=>$threemember['id'],
                            'money'=>$threemoney,
                            'vary'=>1,
                            'type'=>1,
                            'time'=>time(),
                            'remark'=>'三级分销送',
                            'balance'=>$threemember['credit']+$threemoney,
                            'status'=>'1',
                        );
                        $isrecharge=db('recharge_log')->insert($recharge_data);
                    }elseif($threelelver['commission_type']==2 && $threemoney>0){
                        $data = array(
                            'ordersn'=>$isorder['ordersn'],
                            'og_id'=>$v['id'],
                            'prizeid'=>$threemember['id'],
                            'money_type'=>2,
                            'money'=>$threemoney,
                            'type'=>3,
                            'content'=>'三级分销奖送'.$threemoney.'积分',
                            'stime'=>time(),
                            'etime'=>time(),
                            'statue'=>3,
                        );
                        db('commission_log')->insert($data);
                        db('member')->where('id',$threemember['id'] )->setInc('credit2', $threemoney);
                        $recharge_data=array(
                            'userid'=>$threemember['id'],
                            'money_type'=>2,
                            'money'=>$threemoney,
                            'vary'=>1,
                            'type'=>1,
                            'time'=>time(),
                            'remark'=>'三级分销送',
                            'balance'=>$threemember['credit2']+$threemoney,
                            'status'=>'1',
                        );
                        $isrecharge=db('recharge_log')->insert($recharge_data);
                    }
                }

                
            }
            
            
        }
    }
    /**
     * 获取用户真实 IP
     */
    function getIP()
    {
        static $realip;
        if (isset($_SERVER)){
            if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
                $realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
            } else if (isset($_SERVER["HTTP_CLIENT_IP"])) {
                $realip = $_SERVER["HTTP_CLIENT_IP"];
            } else {
                $realip = $_SERVER["REMOTE_ADDR"];
            }
        } else {
            if (getenv("HTTP_X_FORWARDED_FOR")){
                $realip = getenv("HTTP_X_FORWARDED_FOR");
            } else if (getenv("HTTP_CLIENT_IP")) {
                $realip = getenv("HTTP_CLIENT_IP");
            } else {
                $realip = getenv("REMOTE_ADDR");
            }
        }
        return $realip;
    }

    /**
     * 获取 IP  地理位置
     * 淘宝IP接口
     * @Return: array
     */
    public function getCity($ip = '')
    {
        if($ip == ''){
            $url = "http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json";
            $ip=json_decode(file_get_contents($url),true);
            $data = $ip;
        }else{
            $url="http://ip.taobao.com/service/getIpInfo.php?ip=".$ip;
            $ip=json_decode(file_get_contents($url));
            if((string)$ip->code=='1'){
                return false;
            }
            $data = (array)$ip->data;
        }

        return $data;
    }
    public function setCommissionOne($oid,$lambid){
        //获取订单信息

            $isorder = db('order')->where(array('id'=>$oid,'status'=>['>=',1],'status'=>['<',4]))->find();
            if(!empty($isorder['uid'])){
                //获取买家信息
                $ip = $this->getIP();
                //$city = $this ->getCity($ip)['city'];
                $starttime = strtotime(date('Y-m-d'));
                $endtime =  $starttime +24*3600;
                $count = db('agent')->where("addtime >= $starttime and addtime <= $endtime")->count();
                $num = $count + 1;
                $temp_num = 10000;
                $new_num = $num + $temp_num;
                $real_num = substr($new_num,1,4); //即截取掉最前面的“1”
                $code = "SHBCY".date('Ymd').$real_num;
                $time = strtotime("+1 year",time());
                $time = date('Y-m-d',$time);
                $endtime = strtotime($time);
                $buy = db('member')->where(array('id'=>$isorder['uid']))->find();
                \db('member') ->where(['id'=>$isorder['uid']])->update(['is_agent'=>1]);
                db('agent')->insert(['uid'=>$isorder['uid'],'addtime'=>time(),'ip'=>$ip,'code'=>$code,'lambid'=>$lambid,'oid'=>$oid,'endtime'=>$endtime]);
                //获取买家上级
                if(!empty($buy['agentid'])){
                    $onemember = db('member')->where(array('id'=>$buy['agentid'],'is_agent'=>1))->find();
                    //获取一级上级的权限
                    $one = db('member')->where(array('id'=>$buy['agentid']))->find();
                    $onelelver = db('member_level')->where(array('level'=>$one['level']))->find();

                    $twomember = db('member')->where(array('id'=>$one['agentid'],'is_agent'=>1))->find();
                    //获取一级上级的权限
                    $two = db('member')->where(array('id'=>$one['agentid']))->find();
                    $twolelver = db('member_level')->where(array('level'=>$two['level']))->find();

                    $threemember = db('member')->where(array('id'=>$two['agentid'],'is_agent'=>1))->find();
                    //获取一级上级的权限
                    $threelelver = db('member_level')->where(array('level'=>$threemember['level']))->find();

                }
                $result = db('sell_lamb')->where('lambid',$lambid)->where('status',1)->where('exchange',1)->update(array('issend'=>1));
                $res = db('sell_lamb')->where('lambid',$lambid)->where('status',1)->where('exchange',3)->update(array('issend'=>1));
                //获取订单对应的商品订单表
                $order_goods = db('order_goods')->where(array('oid'=>$oid))->select();
//                $count = db('commission_log')->where('ordersn',$isorder['ordersn'])->count();
//                if($order_goods[0]['num']<=$count){
//                    return false;
//                }
                $res1 = db('commission_log')->where(array('statue'=>3,'lambid'=>$lambid))->find();
                if($res1){
                    return false;
                }
                //2000单价不返利
                $order = db('order_goods') ->where('oid',$oid)->find();
                $price = $order['money']/$order['num'];
                if($price == 2000){
                    return false;
                }
                if(empty($onelelver)){
                    return false;
                }
                if($res || $result){
                    foreach ($order_goods as $v){
                        //1级
                        if(!empty($onelelver['iscommission'] && !empty($onemember))){
                            $onemoney = 0;
                            if($onelelver['commission_way']==1){
                                $onemoney = $onelelver['commission1'] ;
                            }else{
                                $onemoney = $onelelver['commission1']*$v['money']/100;
                            }
                            if($onelelver['commission_type']==1 && $onemoney>0){
                                $data = array(
                                    'ordersn'=>$isorder['ordersn'],
                                    'og_id'=>$v['id'],
                                    'prizeid'=>$onemember['id'],
                                    'money_type'=>1,
                                    'money'=>$onemoney,
                                    'type'=>1,
                                    'content'=>'一级分销奖送'.$onemoney.'余额',
                                    'stime'=>time(),
                                    'etime'=>time(),
                                    'statue'=>3,
                                    'lambid'=>$lambid
                                );
                                db('commission_log')->insert($data);
                                db('member')->where('id',$onemember['id'] )->setInc('credit', $onemoney);
                                $recharge_data=array(
                                    'userid'=>$onemember['id'],
                                    'money'=>$onemoney,
                                    'vary'=>1,
                                    'type'=>1,
                                    'time'=>time(),
                                    'remark'=>'一级分销送',
                                    'balance'=>$onemember['credit']+$onemoney,
                                    'status'=>'1',
                                    'lambid'=>$lambid
                                );
                                $isrecharge=db('recharge_log')->insert($recharge_data);
                            }elseif($onelelver['commission_type']==2 && $onemoney>0){
                                $data = array(
                                    'ordersn'=>$isorder['ordersn'],
                                    'og_id'=>$v['id'],
                                    'prizeid'=>$onemember['id'],
                                    'money_type'=>2,
                                    'money'=>$onemoney,
                                    'type'=>1,
                                    'content'=>'一级分销奖送'.$onemoney.'积分',
                                    'stime'=>time(),
                                    'etime'=>time(),
                                    'statue'=>3,
                                    'lambid'=>$lambid
                                );
                                db('commission_log')->insert($data);
                                db('member')->where('id',$onemember['id'] )->setInc('credit2', $onemoney);
                                $recharge_data=array(
                                    'userid'=>$onemember['id'],
                                    'money_type'=>2,
                                    'money'=>$onemoney,
                                    'vary'=>1,
                                    'type'=>1,
                                    'time'=>time(),
                                    'remark'=>'一级分销送',
                                    'balance'=>$onemember['credit2']+$onemoney,
                                    'status'=>'1',
                                    'lambid'=>$lambid
                                );
                                $isrecharge=db('recharge_log')->insert($recharge_data);
                            }
                        }
                        if(empty($twolelver)){
                            return false;
                        }
                        //2级
                        if(!empty($twolelver['iscommission'] && !empty($twomember))){
                            $twomoney = 0;
                            if($twolelver['commission_way']==1){
                                $twomoney = $twolelver['commission2'];
                            }else{
                                $twomoney = $twolelver['commission2']*$v['money']/100;
                            }
                            if($twolelver['commission_type']==1 && $twomoney>0){
                                $data = array(
                                    'ordersn'=>$isorder['ordersn'],
                                    'og_id'=>$v['id'],
                                    'prizeid'=>$twomember['id'],
                                    'money_type'=>1,
                                    'money'=>$twomoney,
                                    'type'=>2,
                                    'content'=>'二级分销奖送'.$twomoney.'余额',
                                    'stime'=>time(),
                                    'etime'=>time(),
                                    'statue'=>3,
                                    'lambid'=>$lambid
                                );
                                db('commission_log')->insert($data);
                                db('member')->where('id',$twomember['id'] )->setInc('credit', $twomoney);
                                $recharge_data=array(
                                    'userid'=>$twomember['id'],
                                    'money'=>$twomoney,
                                    'vary'=>1,
                                    'type'=>1,
                                    'time'=>time(),
                                    'remark'=>'二级分销送',
                                    'balance'=>$twomember['credit']+$twomoney,
                                    'status'=>'1',
                                    'lambid'=>$lambid
                                );
                                $isrecharge=db('recharge_log')->insert($recharge_data);
                            }elseif($twolelver['commission_type']==2 && $twomoney>0){
                                $data = array(
                                    'ordersn'=>$isorder['ordersn'],
                                    'og_id'=>$v['id'],
                                    'prizeid'=>$twomember['id'],
                                    'money_type'=>2,
                                    'money'=>$twomoney,
                                    'type'=>2,
                                    'content'=>'二级分销奖送'.$twomoney.'积分',
                                    'stime'=>time(),
                                    'etime'=>time(),
                                    'statue'=>3,
                                    'lambid'=>$lambid
                                );
                                db('commission_log')->insert($data);
                                db('member')->where('id',$twomember['id'] )->setInc('credit2', $twomoney);
                                $recharge_data=array(
                                    'userid'=>$twomember['id'],
                                    'money_type'=>2,
                                    'money'=>$twomoney,
                                    'vary'=>1,
                                    'type'=>1,
                                    'time'=>time(),
                                    'remark'=>'二级分销送',
                                    'balance'=>$twomember['credit2']+$twomoney,
                                    'status'=>'1',
                                    'lambid'=>$lambid
                                );
                                $isrecharge=db('recharge_log')->insert($recharge_data);
                            }
                        }//3级
                        if(empty($threelelver)){
                            return false;
                        }
                        if(!empty($threelelver['iscommission'] && !empty($threemember))){
                            $threemoney = 0;
                            if($threelelver['commission_way']==1){
                                $threemoney = $threelelver['commission3'];
                            }else{
                                $threemoney = $threelelver['commission3']*$v['money']/100;
                            }
                            if($threelelver['commission_type']==1 && $threemoney>0){
                                $data = array(
                                    'ordersn'=>$isorder['ordersn'],
                                    'og_id'=>$v['id'],
                                    'prizeid'=>$threemember['id'],
                                    'money_type'=>1,
                                    'money'=>$threemoney,
                                    'type'=>3,
                                    'content'=>'三级分销奖送'.$threemoney.'余额',
                                    'stime'=>time(),
                                    'etime'=>time(),
                                    'statue'=>3,
                                    'lambid'=>$lambid
                                );
                                db('commission_log')->insert($data);
                                db('member')->where('id',$threemember['id'] )->setInc('credit', $threemoney);
                                $recharge_data=array(
                                    'userid'=>$threemember['id'],
                                    'money'=>$threemoney,
                                    'vary'=>1,
                                    'type'=>1,
                                    'time'=>time(),
                                    'remark'=>'三级分销送',
                                    'balance'=>$threemember['credit']+$threemoney,
                                    'status'=>'1',
                                    'lambid'=>$lambid
                                );
                                $isrecharge=db('recharge_log')->insert($recharge_data);
                            }elseif($threelelver['commission_type']==2 && $threemoney>0){
                                $data = array(
                                    'ordersn'=>$isorder['ordersn'],
                                    'og_id'=>$v['id'],
                                    'prizeid'=>$threemember['id'],
                                    'money_type'=>2,
                                    'money'=>$threemoney,
                                    'type'=>3,
                                    'content'=>'三级分销奖送'.$threemoney.'积分',
                                    'stime'=>time(),
                                    'etime'=>time(),
                                    'statue'=>3,
                                    'lambid'=>$lambid
                                );
                                db('commission_log')->insert($data);
                                db('member')->where('id',$threemember['id'] )->setInc('credit2', $threemoney);
                                $recharge_data=array(
                                    'userid'=>$threemember['id'],
                                    'money_type'=>2,
                                    'money'=>$threemoney,
                                    'vary'=>1,
                                    'type'=>1,
                                    'time'=>time(),
                                    'remark'=>'三级分销送',
                                    'balance'=>$threemember['credit2']+$threemoney,
                                    'status'=>'1',
                                    'lambid'=>$lambid
                                );
                                $isrecharge=db('recharge_log')->insert($recharge_data);
                            }
                        }
                        db('sell_lamb')->where('lambid',$lambid)->update(array('issend'=>1));
                    }
                }
            }

    }
    
    public function fengpei($ordersn,$ogid,$prize){
        
    }
}