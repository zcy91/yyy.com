<?php
namespace app\index\controller;
use app\extra\Compress;
use think\AjaxPage;
use think\Controller;
use think\Session;
use think\Url;
use think\Config;
use think\Page;
use think\Verify;
use think\Image;
use think\Db;
use think\Request;
use think\Loader;
use PHPMailer\PHPMailer;
use mywechat;
class User  extends Base  {
    private  $members;//保存二级分享所有团队人员
    public function user()
    {

        $ip = $this->getIP();
       // $data = $this->getCity($ip);

        $member = $this->member;
		$cid = cookie('cid');
		if(is_array($cid) && !empty($cid['appcid']) && !empty($cid['apptoken']) && fangwenleixing() == 'app'){
			Db::name('member')->where("id",$member['id'])->update($cid);
		}
        $protocolcount = db('sell_lamb')
            ->field('o.*,g.lambname')
            ->alias('o')
            ->join('__LAMB__ g','o.lambid=g.id','LEFT')
            ->where(array('o.buyid'=> $this->member['id']))
            ->where('toautograph','eq',0)
            ->where('o.status',1)
            ->count();
        //获取羊的头数
        $lambnum = db('lamb')->where(array('uid'=>Session::get('user')['user_id'],'status'=>1) )->count();
        $count = db('commission_log') -> where(['prizeid'=>$member['id'],'is_read'=>0])->count();
        $paystr = fangwenleixing();
        $this->assign('paystr',$paystr);
        $this->assign('count',$count);
        $this->assign('member', $member);
        $this->assign('lambnum', $lambnum);
        $this->assign('protocolcount', $protocolcount);
       // $this->assign('city',$data['city']);
        $this->assign('webtitle', '牧场主');
        return $this->fetch();
    }
    public function myinfo()
    {
        $member = $this->member;
        $this->assign('member', $member);
        $this->assign('webtitle', '个人信息');
        return $this->fetch();
    }
    public function wallet()
    {
        $member = $this->member;
        $mylamb = db('lamb')
                ->field('l.*,g.price,g.gname,g.percentage ')
                ->alias('l')
                ->join('__GOODS__ g','l.gid = g.id','LEFT')
                ->where(array('l.uid'=>Session::get('user')['user_id'],'l.status'=>1) )
                ->select();
        $lambprofit = 0;
        $lambcost = 0;
        $time = time();
        //获取零点时间戳
        $lingtime = strtotime(date("Y-m-d ", $time));
//        $yitime = strtotime(date("Y-1", $time));//一月
//        $ertime = strtotime(date("Y-2", $time));//二月
//        $santime = strtotime(date("Y-3", $time));
//        $sitime = strtotime(date("Y-4", $time));
//        $wutime = strtotime(date("Y-5", $time));
//        $liutime = strtotime(date("Y-6", $time));
//        $qitime = strtotime(date("Y-7", $time));
//        $batime = strtotime(date("Y-8", $time));
//        $jiutime = strtotime(date("Y-9", $time));
//        $shitime = strtotime(date("Y-10", $time));
//        $shiyitime = strtotime(date("Y-11", $time));
//        $shiertime = strtotime(date("Y-12", $time));
//        $shisantime = strtotime(date("Y-12", $time))+2678400;
//        $year['yiprice'] = 0;
//        $year['erprice'] = 0;
//        $year['sanprice'] = 0;
//        $year['siprice'] = 0;
//        $year['wuprice'] = 0;
//        $year['liuprice'] = 0;
//        $year['qiprice'] = 0;
//        $year['baprice'] = 0;
//        $year['jiuprice'] = 0;
//        $year['shiprice'] = 0;
//        $year['shiyiprice'] = 0;
//        $year['shierprice'] = 0; 
        $yiday = $lingtime;//今天
        $erday = $lingtime-(86400*1);//昨天
        $sanday = $lingtime-(86400*2);//前天
        $siday = $lingtime-(86400*3);//大前天
        $wuday = $lingtime-(86400*4);//大大前天
        $liuday = $lingtime-(86400*5);//大大大前天
        $qiday = $lingtime-(86400*6);//大大大大前天
        $year['yidayprice'] = 0;
        $year['erdayprice'] = 0;
        $year['sandayprice'] = 0;
        $year['sidayprice'] = 0;
        $year['wudayprice'] = 0;
        $year['liudayprice'] = 0;
        $year['qidayprice'] = 0;
        $year['yidayname'] = date("m-d", $yiday);
        $year['erdayname'] = date("m-d", $erday);
        $year['sandayname'] = date("m-d", $sanday);
        $year['sidayname'] = date("m-d", $siday);
        $year['wudayname'] = date("m-d", $wuday);
        $year['liudayname'] = date("m-d", $liuday);
        $year['qidayname'] = date("m-d", $qiday);
        foreach ($mylamb as $v){
            $rose = unserialize($v['rose']);
            if(!empty($rose)){
                foreach ($rose as $ss=>$vv){
                    if($ss<=$lingtime){
                        $lambprofit+=$vv;
//                        if($ss<$ertime and $ss>=$yitime){//1
//                            $year['yiprice'] +=$vv;
//                        }else if ($ss<$santime and $ss>=$ertime) {//2
//                            $year['erprice'] +=$vv;
//                        }else if ($ss<$sitime and $ss>=$santime) {//3
//                            $year['sanprice'] +=$vv;
//                        }else if ($ss<$wutime and $ss>=$sitime) {//4
//                            $year['siprice'] +=$vv;
//                        }else if ($ss<$liutime and $ss>=$wutime) {//5
//                            $year['wuprice'] +=$vv;
//                        }else if ($ss<$qitime and $ss>=$liutime) {//6
//                            $year['liuprice'] +=$vv;
//                        }else if ($ss<$batime and $ss>=$qitime) {
//                            $year['qiprice'] +=$vv;
//                        }else if ($ss<$jiutime and $ss>=$batime) {
//                            $year['baprice'] +=$vv;
//                        }else if ($ss<$shitime and $ss>=$jiutime) {
//                            $year['jiuprice'] +=$vv;
//                        }else if ($ss<$shiyitime and $ss>=$shitime) {
//                            $year['shiprice'] +=$vv;
//                        }else if ($ss<$shiertime and $ss>=$shiyitime) {
//                            $year['shiyiprice'] +=$vv;
//                        }else if ($ss<$shisantime and $ss>=$shiertime) {
//                            $year['shierprice'] +=$vv;
//                        }
                        if($ss==$yiday){
                            $year['yidayprice']+=$vv;
                        }
                        if($ss==$erday){
                            $year['erdayprice']+=$vv;
                        }
                        if($ss==$sanday){
                            $year['sandayprice']+=$vv;
                        }
                        if($ss==$siday){
                            $year['sidayprice']+=$vv;
                        }
                        if($ss==$wuday){
                            $year['wudayprice']+=$vv;
                        }
                        if($ss==$liuday){
                            $year['liudayprice']+=$vv;
                        }
                        if($ss==$qiday){
                            $year['qidayprice']+=$vv;
                        }
                        
                        
                    }
                }
            }
            
            
            $lambcost+=$v['price'];
        }
//        $maxprize = max($year)/100;
//        $year['max'] = ceil($maxprize)*100;
        $this->assign('year', $year);
        $this->assign('lambprofit', $lambprofit);
        $this->assign('lambcost', $lambcost);
        $this->assign('member', $member);
        $this->assign('webtitle', '我的钱包');
        return $this->fetch();
    }
    public function take()
    {
        $member = $this->member;
        $this->assign('member', $member);
        $this->assign('webtitle', '提现');
        return $this->fetch();
    }
    public function recharge()
    {
        $member = $this->member;
        $paystr = fangwenleixing();
        $this->assign('paystr', $paystr);
        $this->assign('member', $member);
        $this->assign('webtitle', '充值');
        return $this->fetch();
    }
    public function rechargepay(){
        //var_dump(S('template'));die;
        if(Request::instance()->isPost()){
            $pay_type = input('post.paytype'); 
            $params['out_trade_no'] = 'CZ'.date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8). str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
            $params['total_fee'] = input('post.money')*100; 
            $data=array(
                'rechargesn'=>$params['out_trade_no'],
                'userid'=>Session::get('user')['user_id'],
                'money'=>input('post.money'),
                'vary'=>1,//1表示增加
                //'type'=>2,//2表示微信
                'time'=>time(),
                'status'=>0,//未充值
            );
            if($pay_type == 2){
                if(empty(Session::get('user')['openid'])){
                    $this->success("需绑定微信，才能微信充值！","/index/user/setup");
                }else{
                    $openid = Session::get('user')['openid'];
                } 
                $params['body'] = '微信充值余额'; 
                $params['type'] = '2'; 
                $data['remark']=$params['body'];
                $data['type'] = 2;
                $jsApiParameters = \wxpay\JsapiPay::getParams($params,$openid);
                $this->assign('jsApiParameters',$jsApiParameters );
            }elseif ($pay_type == 3) {
                $params['type'] = '3'; 
                $params['body'] = '支付宝充值余额'; 
                $data['remark']=$params['body'];
                $data['type'] = 3;
            }else if($pay_type == 4){
                $params['type'] = '4'; 
                $params['body'] = '银行卡充值余额'; 
                $data['remark']=$params['body'];
                $data['type'] = 4;
            } else {
                $params['type'] = '5'; 
                $params['body'] = '未定义的支付方式'; 
                $data['remark']=$params['body'];
                $data['type'] = 5;
            }
            db('recharge_log')->insert($data);
            $this->assign('params',$params );
        }
        $this->assign('webtitle', '充值');
        return $this->fetch();
    }
    public function sheepfold(){
        $list = db('lamb')
                ->field('l.id,l.lambname,g.price,l.paytime,g.gname,g.img,g.cycle ')
                ->alias('l')
                ->join('__GOODS__ g','l.gid = g.id','LEFT')
                ->order('id','desc')
                ->where(array('l.uid'=>Session::get('user')['user_id'],'l.status'=>1) )
                ->select();
        $shunum = 0;
        $zongnum = 0;
        foreach ($list as $s=>$v){
            $list[$s]['czday'] = differday($v['paytime'], time());
            if($list[$s]['czday']>=$list[$s]['cycle']){
                $shunum++;
            }
            $zongnum++;
        }
        //dump($list);die;
        $this->assign('list', $list);
        $this->assign('shunum', $shunum);
        $this->assign('zongnum', $zongnum);
        $this->assign('webtitle', '我的羊圈');
        return $this->fetch();
    }

    public function sheepdetail(){
        $id = input('id');
        $mylamb = db('lamb')
                ->field('l.id,l.gid,l.lambname,l.lambsn,l.message,l.paytime,g.price,g.gname,g.img,g.cycle,g.percentage ')
                ->alias('l')
                ->join('__GOODS__ g','l.gid = g.id','LEFT')
                ->where(array('l.id'=>$id,'l.status'=>1) )
                ->find();
        //成长天数
        $czday = differday($mylamb['paytime'], time());
        //预计收益
        $yjsy = reckonProfit($mylamb['price'], $mylamb['cycle'], $mylamb['percentage']);
        //查找羊羔的视频
        if(!empty($id)){
            $videolist = db('lamb_video')->where(array('lambid'=>$id))->whereOr(array('gid'=>$mylamb['gid']))->order('id',' desc')->select();
            $videolistjs = json($videolist);

            if(!empty($videolist)){
                $this->assign('videolist', $videolist);
                $this->assign('videolistjs', $videolistjs);
            }
        }
        
        $this->assign('czday', $czday);
        $this->assign('yjsy', $yjsy);
        $this->assign('mylamb', $mylamb);
        $this->assign('webtitle', '羊羊详情');
        return $this->fetch();
    }
    public function soldsheep(){
        $id = input('id');
        $sheep_id = input('sheep_id');
        if(!empty($sheep_id)){
            $this->assign('sheep_id',$sheep_id);
        }
        $mylamb = db('lamb')
                ->field('l.id,l.lambname,l.message,l.paytime,g.price,g.gname,g.img,g.cycle,g.percentage ')
                ->alias('l')
                ->join('__GOODS__ g','l.gid = g.id','LEFT')
                ->where(array('l.id'=>$id,'l.status'=>1) )
                ->find();
        //成长天数
        $czday = differday($mylamb['paytime'], time());
        //计算羊羔是否成熟
        if($czday>=$mylamb['cycle']){
            $islamb = TRUE;
        }else{
            $islamb = FALSE;
        }
        //取消兑换收益模块
        $islamb = false;
        $tourtype = db('tour_type') -> select();
        if((input('back')==1)){
            $this->assign('selllamb',1);
        }else{
            $this->assign('back',0);
        }
        $list=Db::name('address')->where('uid',Session::get('user')['user_id'])->order('defaults','desc')->select();
        $this->assign('list',$list);
        $this -> assign('tourtype',$tourtype);
        $this->assign('id',$id);
        $this->assign('islamb', $islamb);
        $this->assign('mylamb', $mylamb);
        $this->assign('webtitle', '我要兑换');
        return $this->fetch();
    }
    public function sheepgive(){
        $id = input('id');
        $mylamb = db('lamb')
                ->field('l.id,l.lambname,l.message,l.paytime,g.price,g.gname,g.img,g.cycle,g.percentage ')
                ->alias('l')
                ->join('__GOODS__ g','l.gid = g.id','LEFT')
                ->where(array('l.id'=>$id,'l.status'=>1) )
                ->find();
        //成长天数
        $czday = differday($mylamb['paytime'], time());
        //计算羊羔是否成熟
        if($czday>=$mylamb['cycle']){
            $islamb = TRUE;
        }else{
            $islamb = FALSE;
        }
        $this->assign('islamb', $islamb);
        $this->assign('mylamb', $mylamb);
        $this->assign('webtitle', '出售羔羊');
        return $this->fetch();
    }
    public function getmember(){
        if(Request::instance()->isPost()){
            $member_type = input('post.member_type');
            $member_val = input('post.member_val');
            $paypwd = input('post.paypwd');
            if($member_type==1 or $member_type==2){
                $member_val = codeToAgentid($member_val);
                $where = array('id'=>$member_val);
                if($member_val== $this->member['id']){
                    return array('type'=>0,'data'=>'不能对自己进行该操作！');
                }
            }else{
                $where = array('mobile'=>$member_val);
            }
            
            $getmember = db('member')->field('id,username,avatar,mobile')->where($where)->find();
            if(!empty($getmember)){
                if($getmember['id']== $this->member['id']){
                    return array('type'=>0,'data'=>'不能对自己进行该操作！');
                }
                $member = Db::name('member')->where('id', Session::get('user')['user_id'])->find();
                $error_count = db('member') -> where('id',$member['id']) ->value('error_count');
                $error_time = db('member') -> where('id',$member['id']) ->value('error_time');
                if(!empty($error_time)){
                    $time = time() - $error_time;
                    if($time > 3600*24){
                        db('member') -> where('id',$member['id'])->update(array('error_count'=> 0));
                        db('member') -> where('id',$member['id'])->update(array('error_time'=> 0));
                    }else{
                        $hour = 24 - floor($time/(3600*24));
                        return array('type'=>0,'data'=>'支付密码错误超过5次，请'.$hour.'小时后再试');
                    }
                }
                $paypwd = md5(input('paypwd'));
                $paypwd1 = db('member')->where('id',$member['id'])->value('paypwd');
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
                $getmember['mobile'] = substr_replace($getmember['mobile'],'****',3,4);
                return array('type'=>1,'data'=>$getmember,'msg'=>'数据返回成功');
            } else {
                return array('type'=>0,'data'=>'未找到指定的用户信息');
            }
            
            
        }
        return $this->fetch();
    }
    public function getmoreorder(){
        $uid = Session::get('user')['user_id'];
        $where =array();
        $where['o.uid'] = $uid;
//        $where['g.shoptype'] = 1;
        $status = input('post.status');
        if($status==1){
            $where['o.status'] = 1;
        }elseif ($status===0) {
            $where['o.status'] = 0;
        }elseif($status==4){
            $where['o.status'] = 4;
        }else{

        }
        $page = input('page');
        //print_r($where);
        $list=Db::name('order')
            ->field('o.*,og.num,g.gname,g.img,g.percentage,g.cycle ')
            ->alias('o')
            ->join('__ORDER_GOODS__ og','o.id = og.oid','LEFT')
            ->join('__GOODS__ g','og.gid = g.id','LEFT')
            ->where($where)
            ->where('o.status','<>',4)
            ->order('o.id', 'desc')
            ->limit(($page)*5,5)
            ->select();
        $lists = Db::name('order')
            ->field('o.*,og.num,g.gname,g.img,g.percentage,g.cycle ')
            ->alias('o')
            ->join('__ORDER_GOODS__ og','o.id = og.oid','LEFT')
            ->join('__GOODS__ g','og.gid = g.id','LEFT')
            ->where($where)
            ->where('o.status','<>',4)
            ->order('o.id', 'desc')
            ->select();
        $pages = ceil(count($lists)/5);
        if(!empty($list))
        return array('type'=>1,'data'=>$list,'pages'=>$pages);
        else{
            return array('type'=>0,'data'=>Null,'msg'=>'没有更多了~~~');
        }
    }
    public function myorder(){
        $uid = Session::get('user')['user_id'];
        $where =array();
        $where['o.uid'] = $uid;
        //$where['g.shoptype'] = 1;
        $status = input('post.status');
        if($status==1){
            $where['o.status'] = 1; 
        }elseif ($status===0) {
            $where['o.status'] = 0; 
        }elseif($status==4){
            $where['o.status'] = 4; 
        }elseif($status==2){
            $where['o.status'] = 2;
        }elseif ($status == 3){
            $where['o.status'] = 3;
        }else{

        }

        //print_r($where);
        $list=Db::name('order')
                ->field('o.*,og.num,g.gname,g.img,g.percentage,g.cycle ')
                ->alias('o')
                ->join('__ORDER_GOODS__ og','o.id = og.oid','LEFT')
                ->join('__GOODS__ g','og.gid = g.id','LEFT')
                ->where($where)
                ->where('o.status','<>',4)
                ->order('o.id', 'desc')
                ->limit(5)
                ->select();
        $this->assign('list', $list);
        $this->assign('webtitle', '我的订单');
        return $this->fetch();
    }
    public function getmyorder(){
        $uid = Session::get('user')['user_id'];
        $where =array();
        $where['o.uid'] = $uid;
//        $where['g.shoptype'] = 1;
        $status = input('post.status');
        if($status==1){
            $where['o.status'] = 1; 
        }elseif ($status==0) {
            $where['o.status'] = 0; 
        }elseif($status==4){
            $where['o.status'] = 4; 
        }elseif($status ==2){
            $where['o.status'] = 2;
        }
        $list=Db::name('order')
                ->field('o.*,og.num,g.gname,g.img,g.percentage,g.cycle ')
                ->alias('o')
                ->join('__ORDER_GOODS__ og','o.id = og.oid','LEFT')
                ->join('__GOODS__ g','og.gid = g.id','LEFT')
                ->where($where)
                ->order('o.id', 'desc')
                ->select();

        if(!empty($list)){
            return array('type'=>1,'data'=>$list);
        }else{
            return array('type'=>0,'msg'=>'没有更多了~~');
        }
    }
    public function orderdetail1(){
        $oid = input('oid');
        $myorder=Db::name('order')
            ->field('o.*,og.num,g.gname,g.img,g.percentage,g.cycle,g.price2 ')
            ->alias('o')
            ->join('__LAMB__ l','o.id = l.oid','LEFT')
            ->join('__ORDER_GOODS__ og','o.id = og.oid','LEFT')
            ->join('__GOODS__ g','og.gid = g.id','LEFT')
            ->where(array('o.id'=>$oid))
            ->order('o.id', 'desc')
            ->select();

//        $myorder=Db::name('order')
//            ->field('o.*,l.gid,l.lambname,l.message,g.img,g.percentage,g.cycle ')
//            ->alias('o')
//            ->join('__LAMB__ l','o.id = l.oid','LEFT')
//            ->join('__GOODS__ g','l.gid = g.id','LEFT')
//            ->where(array('o.id'=>$oid))
//            ->order('o.id', 'desc')
//            ->select();
        $lambnum = count($myorder);
        $this->assign('myorder', $myorder);
        $this->assign('lambnum', $lambnum);
        $this->assign('webtitle', '订单详情');
        return $this->fetch();
    }

    public function orderdetail(){
        $oid = input('oid');
        $myorder=Db::name('order')
                ->field('o.*,l.gid,l.lambname,l.message,g.price,g.img,g.percentage,g.cycle ')
                ->alias('o')
                ->join('__LAMB__ l','o.id = l.oid','LEFT')
                ->join('__GOODS__ g','l.gid = g.id','LEFT')
                ->where(array('o.id'=>$oid))
                ->order('o.id', 'desc')
                ->select();
//        $myorder=Db::name('order')
//            ->field('o.*,og.num,g.gname,g.img,g.percentage,g.cycle,g.price2 ,l.gid,l.lambname,l.message,g.price,g.img,g.percentage,g.cycle')
//            ->alias('o')
//            ->join('__LAMB__ l','o.id = l.oid','LEFT')
//            ->join('__ORDER_GOODS__ og','o.id = og.oid','LEFT')
//            ->join('__GOODS__ g','og.gid = g.id','LEFT')
//            ->where(array('o.id'=>$oid))
//            ->order('o.id', 'desc')
//            ->select();
        $myorder1=Db::name('order')
            ->field('o.*,l.gid,l.lambname,l.message,g.img,g.percentage,g.cycle,og.num,g.gname,g.img,g.percentage,g.cycle,g.price2 ')
            ->alias('o')
            ->join('__LAMB__ l','o.id = l.oid','LEFT')
            ->join('__ORDER_GOODS__ og','o.id = og.oid','LEFT')
            ->join('__GOODS__ g','l.gid = g.id','LEFT')
            ->where(array('o.id'=>$oid))
            ->order('o.id', 'desc')
            ->select();
        //dump($myorder);die;
        $lambnum = count($myorder);
        $this->assign('myorder', $myorder);
        $this->assign('myorder1', $myorder1);
        $this->assign('lambnum', $lambnum);
        $this->assign('webtitle', '订单详情');
        return $this->fetch();
    }
    public function getaddress(){
        $list=Db::name('address')->where('uid',Session::get('user')['user_id'])->order('defaults','desc')->select();
        return json($list);
    }
    public function address(){
        $list=Db::name('address')->where('uid',Session::get('user')['user_id'])->order('defaults','desc')->select();
        $this->assign('list',$list);
        $this->assign('webtitle', '收货地址');
        return $this->fetch();
    }
    public function addaddress(){
        if(Request::instance()->isPost()){
            $id= input('post.id');
            if(empty($id)){
                $data = input('post.');
                $data['uid'] = Session::get('user')['user_id'];
                $data['time'] = time();
                //查找是否查找地址，如果不存在折设置改地址为莫仍
                $isaddress = db('address')->where('uid',$data['uid'])->find();
                if(!$isaddress){
                    $data['defaults'] = 1;
                }
                db('address')->insert($data);
                return array('type'=>1,'msg'=>'添加成功'); 
            }else{
                $data = input('post.');
                $data['uid'] = Session::get('user')['user_id'];
                db('address')->where('id', $id)->update($data);
                return array('type'=>1,'msg'=>'修改成功'); 
            }
        }
        if(Request::instance()->isGet()){
            $id= input('id');
            if(!empty($id)){
                $myaddress = Db::name('address')->where("id=$id")->find();
                $this->assign('myaddress', $myaddress);
            }
        }
        $this->assign('webtitle', '新增地址');
        return $this->fetch();
    }
    public function addaddress1(){
        if(Request::instance()->isPost()){
            $id= input('post.id');
            if(empty($id)){
                $data = input('post.');
                $data['uid'] = Session::get('user')['user_id'];
                $data['time'] = time();
                //查找是否查找地址，如果不存在折设置改地址为莫仍
                $isaddress = db('address')->where('uid',$data['uid'])->find();
                if(!$isaddress){
                    $data['defaults'] = 1;
                }
                db('address')->insert($data);
                return array('type'=>1,'msg'=>'添加成功');
            }else{
                $data = input('post.');
                $data['uid'] = Session::get('user')['user_id'];
                db('address')->where('id', $id)->update($data);
                return array('type'=>1,'msg'=>'修改成功');
            }
        }
        if(Request::instance()->isGet()){
            $id= input('id');
            $sheep_id = input('sheep_id');
            if(!empty($id)){
                $myaddress = Db::name('address')->where("id=$id")->find();
                $this->assign('myaddress', $myaddress);
            }
            if(!empty($sheep_id)){
                $this->assign('sheep_id',$sheep_id);
            }
        }
        if(!empty($sheep_id)){
            $this->assign('sheep_id',$sheep_id);
        }
        $this->assign('webtitle', '新增地址');
        return $this->fetch();
    }
    public function setdefaults(){
        if(Request::instance()->isPost()){
            $id = input('post.id');
            $uid = Session::get('user')['user_id'];
            db('address')->where(array('uid'=>$uid))->update(array('defaults'=>0));
            $isdefaults = db('address')->where(array('uid'=>$uid,'id'=>$id))->update(array('defaults'=>1));
            if($isdefaults){
                return array('type'=>1,'msg'=>'设置默认地址成功');
            }else{
                return array('type'=>1,'msg'=>'设置默认地址失败');
            }
        }else{
            return array('type'=>0,'msg'=>'请求失败...');
        }
    }

    public function setup(){
        $member = $this->member;
        $this->assign('member', $member);
        $this->assign('webtitle', '设置');
        return $this->fetch();
    }
    public function cgphone(){
        $member = $this->member;
        $this->assign('member', $member);
        $this->assign('webtitle', '绑定手机号');
        return $this->fetch();
    }
    public function dengluhoubangding(){
        $member = $this->member;
        $this->assign('member', $member);
        $this->assign('webtitle', '绑定手机号');
        return $this->fetch();
    }
    public function cgpassword(){
        $member = $this->member;
        $this->assign('member', $member);
        $this->assign('webtitle', '修改登录密码');
        return $this->fetch();
    }
    public function setmobile(){
        if(Request::instance()->isPost()){
            $mobile = input('post.mobile');
            $password = input('post.password');
            $realname = input('post.realname');
            $uid = $this->member['id'];
            $code=input('post.code');
            if($code!= Session::get('code_'.$mobile)){
                return array('type'=>0,'msg'=>'验证码有误！');
            }
            if(!empty($password)){
                $data = array('mobile'=>$mobile,'password'=> md5($password),'realname'=>$realname);
            }else{
                $data = array('mobile'=>$mobile,'realname'=>$realname);
            }
            $ismobile = db('member')->where(array('mobile'=>$mobile))->find();
            if($ismobile){
                return array('type'=>0,'msg'=>'该手机号已经存在不能绑定！');
            }else{
                $ismember = db('member')->where('id',$uid)->update($data);
                if($ismember){
                    return array('type'=>1,'msg'=>'绑定成功');
                }else{
                    return array('type'=>0,'msg'=>'绑定失败');
                }
                
            }
        }else{
            return array('type'=>0,'msg'=>'请求失败...');
        }
    }
    public function setopdenid(){
        if(Request::instance()->isPost()){
            $uid = $this->member['id'];
            
            $ismobile = db('member')->where(array('mobile'=>$mobile))->find();
            if($ismobile){
                return array('type'=>0,'msg'=>'该手机号已经存在不能绑定！');
            }else{
                $ismember = db('member')->where('id',$uid)->update(array('mobile'=>$mobile));
                if($ismember){
                    return array('type'=>1,'msg'=>'绑定成功');
                }else{
                    return array('type'=>0,'msg'=>'绑定失败');
                }
            }
        }else{
            return array('type'=>0,'msg'=>'请求失败...');
        }
    }
    public function setpassword(){
        if(Request::instance()->isPost()){
            $olbpassword = input('post.olbpassword');
            $newpassword = input('post.newpassword');
            $uid = $this->member['id'];
            if(empty($this->member['password'])){
                $ispassword = TRUE;
            }else{
                $olbpassword = md5($olbpassword);
                $ispassword = db('member')->where(array('id'=>$uid,'password'=>$olbpassword))->find();
            }
            
            if(!$ispassword){
                return array('type'=>0,'msg'=>'旧密码输入有误，不能修改！');
            }else{
                $newpassword = md5($newpassword);
                $ismember = db('member')->where('id',$uid)->update(array('password'=>$newpassword));
                if($ismember){
                    return array('type'=>1,'msg'=>'修改密码成功');
                }else{
                    return array('type'=>0,'msg'=>'修改密码失败');
                }
                
            }
        }else{
            return array('type'=>0,'msg'=>'请求失败...');
        }
    }
    public function paypassword(){

        $member = $this->member;
        if(empty($member['mobile'])){
            $this -> success('请先绑定手机号码',url('index/user/cgphone'));
        }
       // var_dump($member);die;
        $this->assign('member', $member);
        $this->assign('webtitle', '修改支付密码');
        return $this->fetch();
    }
    public function setpaypwd(){
        if(Request::instance()->isPost()){
            $mobile = input('post.mobile');
            $password = input('post.password');
            $uid = $this->member['id'];
            $code=input('post.code');
            if(empty($code) || $code==''){
                return array('type'=>0,'msg'=>'验证码有误！');
            }
            if($code!= Session::get('code_'.$mobile)){
                return array('type'=>0,'msg'=>'验证码有误！');
            }
            if(!empty($password)){
                $data = array('paypwd'=> md5($password));
            }else{
                return array('type'=>0,'msg'=>'支付密码不能为空');
            }
            $res = db('member')->where(array('mobile'=>$mobile))->update($data);
            if($res){
                return array('type'=>1,'msg'=>'设置成功');
            }else{
                return array('type'=>0,'msg'=>'设置失败，支付密码不能与原先一样');
            }

        }else{
            return array('type'=>0,'msg'=>'请求失败...');
        }
    }
    public function settake(){
        if(Request::instance()->isPost()){
            $type = input('post.type');
            //如果是微信红包提现申请要判断用户是否绑定微信
            if($type == 1){
                if(empty(Session::get('user')['openid'])){
                    return array('type'=>0,'msg'=>'申请失败，需绑定微信，才能微信提现','code'=>'bdwx');
                }
                if($this->member['client']=='app'){
                    return array('type'=>0,'msg'=>'申请失败，只有微信客户端用户才能微信提现');
                }
            }
            $realname = input('post.realname');
            $alipay = input('post.alipay');
            $bankname = input('post.bankname');
            $bankcard = input('post.bankcard');
            $money = input('post.money');
            $uid = $this->member['id'];
            $ismoney = db('member')->where(array('id'=>$uid))->find();
            if($money>$ismoney['credit']){
                return array('type'=>0,'msg'=>'提现金额大于可用余额，提现失败！');
            }else{
                $ismember = db('member')->where('id',$uid)->setDec('credit', $money);
                $data = input('post.');
                $data['applysn'] ='TX'.date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
                $data['applytime'] = time(); 
                $data['uid'] = $uid; 
                $data['status'] = 1; 
                $istx = db('withdrawals')->insert($data);
                $recharge_data=array(
                    'userid'=>$this->member['id'],
                    'money'=>$money,
                    'vary'=>2,
                    'type'=>1,
                    'time'=>time(),
                    'remark'=>'提现申请',
                    'balance'=>($this->member['credit']-$money),
                    'status'=>'1',
                );
                $isrecharge=db('recharge_log')->insert($recharge_data);
                if($istx){
                    return array('type'=>1,'msg'=>'提现申请已提交，预计1到3个工作日到账！');
                }else{
                    return array('type'=>0,'msg'=>'对不起,申请失败,请稍后再试！');
                }
            }
        }else{
            return array('type'=>0,'msg'=>'请求失败...');
        }
    }
    //出售羊羔
    public function selllamb(){
        if(Request::instance()->isPost()){
            $buyid = input('post.buyid');
            $lambid = input('post.lambid');
            $exchange = input('post.exchange');
            $lambmoney = input('post.lambmoney');
            $autograph = input('post.autograph');
            $uid = input('post.uid');
            if(!$uid){
                $uid = $this->member['id'];
            }
            $tourtype = input('post.tourtype');
            $tourlist = input('post.tourlist');
            $islamb = db('lamb')->where(array('id'=>$lambid,'uid'=> $uid))->find();
            if(empty($islamb)){
                return array('type'=>0,'msg'=>'这只羊好像不是你的哦！');
            }else if($islamb['status']!=1){
                return array('type'=>0,'msg'=>'羊圈中未找到该羊，或已出售！');
            }else{
                $data['sellsn'] = 'BUY'.date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
                $data['creationtime'] = time(); 
                $data['buyid'] = $buyid; 
                $data['uid'] = $uid;
                $data['lambid'] = $lambid;
                $data['autograph'] = $autograph;
                if($exchange == 2){
                    $id = input('id');
                    $mylamb = db('lamb')
                        ->field('l.id,l.gid,l.lambname,l.lambsn,l.message,l.paytime,g.price,g.gname,g.img,g.cycle,g.percentage ')
                        ->alias('l')
                        ->join('__GOODS__ g','l.gid = g.id','LEFT')
                        ->where(array('l.id'=>$id,'l.status'=>1) )
                        ->find();
                    //成长天数
                    $czday = differday($mylamb['paytime'], time());
                    //计算羊羔是否成熟
                    if($czday>=$mylamb['cycle']){
                        $islamb = TRUE;
                    }else{
                        return array('type'=>0,'msg'=>'该羊羔未成熟，请耐心等待~~');
                    }
                    //预计收益
                    $yjsy = reckonProfit($mylamb['price'], $mylamb['cycle'], $mylamb['percentage']);
                    $lambmoney = $yjsy + $mylamb['price'];
                }
                $data['money'] = $lambmoney; 
                $data['exchange'] = $exchange; 
                if($buyid>0){
                    $data['status'] = 1;
                    //$data['completetime'] = time();
                    $istx = db('sell_lamb')->insert($data);
                    if($istx){
                        db('lamb')->where(array('id'=>$lambid))->update(array('status'=>3));
                        return array('type'=>1,'msg'=>'赠送申请成功');
                    }else{
                        return array('type'=>0,'msg'=>'赠送申请失败');
                    }
                }elseif($exchange == 1){
                    $data['status'] = 1;
                    $data['address_id'] = input('post.address_id');
                    //$data['completetime'] = time();
                    $istx = db('sell_lamb')->insert($data);
                    if($istx){

                        db('lamb')->where(array('id'=>$lambid))->update(array('status'=>3));
                        $oid = db('lamb')->where('id',$lambid)->value('oid');
                        $this->setCommissionOne($oid,$lambid);
                        return array('type'=>1,'msg'=>'兑换成功,您已成为我是牧场主尊贵的代理,享受代理权利');
                    }else{
                        return array('type'=>0,'msg'=>'申请失败');
                    }
                }else{
                    $data['status'] = 1;
                    if(!empty($tourtype)){
                        $tour = db('tour') -> where('catid',$tourtype) -> value('price_ladder');
                        $tour = unserialize($tour);
                        if(empty($tourlist)){
                            return array('type'=>0,'msg'=>'请选择行程');
                        }
                        foreach($tour as $k=>$v){
                            if($v['num'] == $tourlist){
                                $key = $k;
                                $people = $v['people'];
                                $stime = $v['arrive'];
                            }
                        }
                        if($people>0){
                            $people = $people - 1;
                            $tour[$key]['people'] = $people;
                            $tour = serialize($tour);
                             db('tour') -> where('catid',$tourtype) -> update(array('price_ladder'=>$tour));
                        }else{
                            return array('type'=>0,'msg'=>'上限人数已满');
                        }
                        $data['tourtype'] =  $tourtype;
                        $data['tourlist'] = $tourlist;
                        $data['mobile'] = input('post.mobile');
                        $data['realname_da'] = input('post.realname_da');
                        $data['cartid'] = input('post.cartid');
                        $data['realname1'] = input('post.realname1');
                        $data['cartid1'] = input('post.cartid1');
                        $data['realname0'] = input('post.realname0');
                        $data['cartid0'] = input('post.cartid0');
                        $data['stime'] = strtotime($stime);
                        if(!($data['mobile'] && $data['realname_da'] && $data['cartid'])){
                            return array('type'=>0,'msg'=>'请完整填写大人信息');
                        }
                        if($data['realname0']){
                            if(!$data['cartid0']){
                                return array('type'=>0,'msg'=>'请完整填写儿童身份证信息');
                            }
                        }
                        if($data['realname1']){
                            if(!$data['cartid1']){
                                return array('type'=>0,'msg'=>'请完整填写儿童身份证信息');
                            }
                        }
                    }else{
                        return array('type'=>0,'msg'=>'请选择线路');
                    }

                    $istx = db('sell_lamb')->insert($data);
                    if($istx){
                        db('lamb')->where(array('id'=>$lambid))->update(array('status'=>2));
                        $oid = db('lamb')->where('id',$lambid)->value('oid');
                        $this->setCommissionOne($oid,$lambid);
                        return array('type'=>1,'msg'=>'兑换成功,您已成为我是牧场主尊贵的代理,享受代理权利');
                    }else{
                        return array('type'=>0,'msg'=>'申请失败');
                    }
                }
                
            }
        }else{
            return array('type'=>0,'msg'=>'请求失败...');
        }
    }

    public function test(){
        $wxset = Db::name('wx_set')->find();
        $jssdk = new mywechat\jssdk($wxset['appid'], $wxset['appsecret']);//()($wxset['appid'], $wxset['appsecret'])
        $signPackage = $jssdk->GetSignPackage();
        $this->assign('signPackage', $signPackage);
        $this->assign('webtitle', '个人中心');
        return $this->fetch();
    }
    //设置头像
    public function setimg(){
        if(Request::instance()->isPost()){
            $avatar = input('post.avatar');
            $isavatar = db('member')->where(array('id'=> $this->member['id']))->update(array('avatar'=>$avatar));
           if(!empty($isavatar)){
               return array('type'=>1,'msg'=>'修改头像成功！');
           }else{
               return array('type'=>0,'msg'=>'修改头像失败！');
           }
        }else{
            return array('type'=>0,'msg'=>'请求失败...');
        }
    }
    
    public function deladdress(){
        if(Request::instance()->isPost()){
            $id = input('post.id');
            if(!empty($id)){
                $isadd = Db::name('address')->where(array('id'=>$id,'uid'=> $this->member['id']))->delete();
                if(!empty($isadd)){
                    return array('type'=>1,'msg'=>'删除成功！');
                }else{
                    return array('type'=>0,'msg'=>'删除失败！');
                }
            }else{
                return array('type'=>0,'msg'=>'删除失败！');
            }
            
        }else{
             return array('type'=>0,'msg'=>'请求失败！');
        }
    }
    //完善信息
    public function  perfectinfo(){
        $id= $this->member['id'];
        if(Request::instance()->isPost()){
            $data = input('post.');
            $ismember = db('member')->where('id', $id)->update($data);
            if(!empty($ismember)){
                return array('type'=>1,'msg'=>'修改成功');
            }else{
                return array('type'=>0,'msg'=>'修改失败');
            }
        }
        if(!empty($id)){
            $myuser = Db::name('member')->where("id=$id")->find();
            $this->assign('myuser', $myuser);
        }
        $this->assign('webtitle', '完善信息');
        return $this->fetch();
    }
    //邀请
    public function invite(){
        $mycode = icode($this->member['id']);
        $num = db('member')->where(array('agentid'=> $this->member['id']))->count();
        $sitehttp = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'];
        //计算推广的积分
        $mycredit2 = db('commission_log')->where(array('money_type'=>2,'statue'=>3,'prizeid'=> $this->member['id']))->sum('money');
       
        $this->assign('num', $num);
        $this->assign('mycode', $mycode);
        $this->assign('member', $this->member);
        $this->assign('sitehttp', $sitehttp);
        $this->assign('mycredit2', $mycredit2);
        $this->assign('webtitle', '邀请好友');
        return $this->fetch();
    }
    public function walletrecord(){
        $money_type = input('money_type');
        if($money_type==2){
            $where = array('userid'=> $this->member['id'],'status'=>1,'money_type'=>2);
        }else{
            $where = array('userid'=> $this->member['id'],'status'=>1,'money_type'=>1);
        }
        $this->assign('money_type', $money_type);
        $list = db('recharge_log')->where($where)->order('id','desc')->select();
        $this->assign('list', $list);
        $this->assign('webtitle', '历史记录');
        return $this->fetch();
    }
    public function coupon(){
        $list = db('coupon_data')
                ->field('cd.*,c.couponname,c.enough,c.stime,c.etime,c.deduct,c.backtype,c.islimit ')
                ->alias('cd')
                ->join('__COUPON__ c','cd.couponid = c.id','LEFT')
                ->where(array('cd.uid'=> $this->member['id']))
                ->select();
        $this->assign('list', $list);
        $time =time();
//        $couponid = db('coupon_data') -> where('uid',$this->member['id']) -> column('couponid', 'id');
//        $couponid =implode(',',$couponid);
//        if($couponid){
//            $where = "`cd`.`id` NOT IN ( $couponid) and";
//        }else{
//            $where = '';
//        }
        $where = '';
        //dump($couponid);die;
        $sql = "SELECT `cd`.* FROM `yyy_coupon` `cd`  WHERE  $where `cd`.`gettype` = 1 AND `cd`.`status` = 1 AND `cd`.`stime` <= $time AND `cd`.`etime` = 0 OR (  $where `cd`.`gettype` = 1 and `cd`.`status` = 1 and `cd`.`stime` <= $time and `cd`.`etime` >$time )";
        $couponlist = Db::query($sql);
        //dump($couponlist);die;
        //echo Db::name('coupon') -> getLastSql();

        $this->assign('webtitle', '我的优惠券');
        $this -> assign('couponlsit',$couponlist);
        return $this->fetch();
    }
    
    public function contactus(){
        $this->assign('webtitle', '联系我们');
        return $this->fetch();
    }
    public function addmember(){
        $this->assign('webtitle', '添加好友');
        if(Request::instance()->isPost()){
            $result = input('post.result');
            preg_match('/agentid\/(.*?).html.*?'
                . ''
                . '/s', $result, $matches);
            if(!empty($matches[1]) && $matches[1]>0){
                $ismember = db('member')->field('id,username,avatar,mobile')->where('id', $matches[1])->find();
                if(!empty($ismember)){
                    return array('type'=>1,'msg'=>'获取数据成功','data'=>$ismember);
                }else{
                    return array('type'=>0,'msg'=>'获取数据失败');
                }
            }else{
                return array('type'=>0,'msg'=>'查找失败'.$matches[1]);
            }
            
            
        }
        return $this->fetch();
    }
    public function friendapply(){
        if(Request::instance()->isPost()){
            $uid2 = input('post.uid');
            $uid1 = $this->member['id'];
            if($uid2==$uid1){
                 return array('type'=>0,'msg'=>'发送申请失败,不能添加自己为好友！');
            }
            $isfriend = db('member_friend')->where(array('uid'=>$uid1,'fid'=>$uid2,'status'=>1))->find();
            if(!empty($isapply)){
                return array('type'=>0,'msg'=>'对方已经是您的好友了,不能重复申请！');
            }
            $isapply = db('member_friend_apply')->where(array('uid1'=>$uid1,'uid2'=>$uid2,'status'=>1))->find();
            if(!empty($isapply)){
                return array('type'=>0,'msg'=>'已发送申请,不能重复申请！');
            }
            $data = array(
                'uid1' => $this->member['id'],
                'uid2' => input('post.uid'),
                'applytime' => time(),
                'status' => 1,
            );
            $applyinsert = db('member_friend_apply')->insert($data);
            if($applyinsert){
                return array('type'=>1,'msg'=>'发送申请成功！');
            }else{
                return array('type'=>0,'msg'=>'发送申请失败！');
            }
        }
    }
    public function friendapply2(){
        if(Request::instance()->isPost()){
            $uid2 = input('post.uid');
            $uid1 = $this->member['id'];
            if($uid2==$uid1){
                 return array('type'=>0,'msg'=>'发送申请失败,不能添加自己为好友！');
            }
            $isfriend = db('member_friend')->where(array('uid'=>$uid1,'fid'=>$uid2,'status'=>1))->find();
            if(!empty($isapply)){
                return array('type'=>0,'msg'=>'对方已经是您的好友了,不能重复申请！');
            }
            $isapply = db('member_friend_apply')->where(array('uid1'=>$uid1,'uid2'=>$uid2,'status'=>1))->find();
            if(!empty($isapply)){
                return array('type'=>0,'msg'=>'已发送申请,不能重复申请！');
            }
            $data = array(
                'uid1' => $this->member['id'],
                'uid2' => input('post.uid'),
                'applytime' => time(),
                'status' => 1,
            );
            $applyinsert = db('member_friend_apply')->insert($data);
            if($applyinsert){
                return array('type'=>1,'msg'=>'发送申请成功！');
            }else{
                return array('type'=>0,'msg'=>'发送申请失败！');
            }
        }
    }
//团队
    public function GetTeamMember($id){

        $Tempmerbers = db('member')->where(array('agentid'=> $id))->select();
        $this->members=array_merge((array)$this->members,$Tempmerbers);//查询结果保存到私有属性members中
        if(count($Tempmerbers)>0){//再将上面查询到的直接下级递归查询下级
            foreach ($Tempmerbers as $value) {
                $this->GetTeamMember($value['id']);
            }
        }

    }

    public function recommend(){
        $list = db('member')->where(array('agentid'=> $this->member['id']))->order('id','desc')->select();
//        $num = db('member')->where(array('agentid'=> $this->member['id']))->count();
//        $this->GetTeamMember($this->member['id']);
//        $num = (count($this->members));
         //计算推广的积分
        $list2 = array();
        $mycredit2 = db('commission_log')->where(array('money_type'=>2,'statue'=>3,'prizeid'=> $this->member['id']))->sum('money');
        foreach ($list as $k=>$v){
            $num1 = db('lamb')->where('uid',$v['id'])->where('status',1)->count();
            $sell_num = db('sell_lamb')->where('uid',$v['id'])->where('status',2)->count();
            $list[$k]['num'] = $num1;
            $list[$k]['sell_num'] = $sell_num;
            foreach ($v as $ko=>$vo){
                $list[$k]['agent'] = db('member')->where(['agentid'=>$v['id']])->select();
                $list[$k]['agentnum']= db('member')->where(['agentid'=>$v['id']])->count();
                foreach ( $list[$k]['agent'] as $kk=>$vv){
                    $num1 = db('lamb')->where('uid',$vv['id'])->where('status',1)->count();
                    $sell_num = db('sell_lamb')->where('uid',$vv['id'])->where('status',2)->count();
                    $list[$k]['agent'][$kk]['num']=$num1;
                    $list[$k]['agent'][$kk]['sell_num']=$sell_num;
                }


            }
        }
        //print_r($list);die;
//
        foreach ($list as $ko=>$vo){
            $list2[] = db('member')->where(['agentid'=>$vo['id']])->select();
        }
        $newArr = array();
        foreach($list2 as $key=>$val){
            foreach($val as $k=>$v){
                $newArr[] = $v;
            }
        }
//
//        foreach ($newArr as $k2=>$v2){
//            $num1 = db('lamb')->where('uid',$v2['id'])->where('status',1)->count();
//            $sell_num = db('sell_lamb')->where('uid',$v2['id'])->where('status',2)->count();
//            $newArr[$k2]['num'] = $num1;
//            $newArr[$k2]['sell_num'] = $sell_num;
//        }
        $num = count($list) + count($newArr);
        //var_dump($newArr);die;
        $this->assign('list', $list);
//        $this->assign('list2', $newArr);
        $this->assign('num', $num);
        $this->assign('mycredit2', $mycredit2);
        $this->assign('webtitle', '推荐记录');
        return $this->fetch();
    }
    public function getselllamb(){
        $uid = Request::instance()->post('uid');
        if($uid){
            $data['shouyi'] = db('sell_lamb')->where(['uid'=>$uid,'exchange'=>2,'status'=>2])->count();
            $data['lvyou'] = db('sell_lamb')->where(['uid'=>$uid,'exchange'=>3,'status'=>2])->count();
            $data['changpin'] = db('sell_lamb')->where(['uid'=>$uid,'exchange'=>1,'status'=>2])->count();
            return json(['type'=>1,'data'=>$data]);
        }else{
            return json(['type'=>0,'data'=>'无信息']);
        }



    }

    public function protocollist(){
        $id = $this -> member['id'];
        $list = db('order')
                ->field('o.*,g.gname')
                ->alias('o')
                ->join('__ORDER_GOODS__ og','o.id=og.oid','LEFT')
                ->join('__GOODS__ g','og.gid=g.id','LEFT')
                ->where(' o.status >=1 AND o.status<4 AND g.shoptype=1 ')
                ->where(array('o.uid'=> $this->member['id']))
                ->order('o.creationtime','desc')->select();
        //$data = db('sell_lamb')->where('uid',$this->member['id'])->where('autograph','neq',0)->order('id desc')->select();
//        $data = db('sell_lamb')
//            ->field('o.*,g.lambname')
//            ->alias('o')
//            ->join('__LAMB__ g','o.lambid=g.id','LEFT')
//            ->where(array('o.uid'=> $this->member['id']))
//            ->whereOr("`buyid` = $id  and `autograph` != 0 and `toautograph` != 0")
//            ->where('autograph','neq',0)
//            ->where('toautograph','neq',0)
//            ->order('o.creationtime','desc')->select();
       $sql = "SELECT `o`.*,`g`.`lambname` FROM `yyy_sell_lamb` `o` LEFT JOIN `yyy_lamb` `g` ON `o`.`lambid`=`g`.`id` WHERE `o`.`uid` = $id AND `buyid` <> '0'  OR (`buyid`=$id )ORDER BY `o`.`creationtime` desc";
       $data = Db::query($sql);
        $arr = db('sell_lamb')
            ->field('o.*,g.lambname')
            ->alias('o')
            ->join('__LAMB__ g','o.lambid=g.id','LEFT')
            ->where(array('o.buyid'=> $this->member['id']))
            ->where('toautograph','eq',0)
            ->where('o.status',1)
            ->order('o.creationtime','desc')->select();
        //SELECT `o`.*,`g`.`lambname` FROM `yyy_sell_lamb` `o` LEFT JOIN `yyy_lamb` `g` ON `o`.`lambid`=`g`.`id` WHERE `o`.`uid` = 3 AND `autograph` <> '0' AND `toautograph` <> '0' OR ( `buyid` = 3 and `g`.`id` = `o`.`lambid` and `autograph` != 0 and `toautograph` != 0 ) ORDER BY `o`.`creationtime` desc"

        $this->assign('arr',$arr);
        $this->assign('data',$data);
        $this->assign('list', $list);
        $this->assign('webtitle', '我的合同');
        return $this->fetch();
    }
    public function protocoldetail(){
//        $iscontract = db('contract_set')->find();
//        if(!empty($iscontract['background'])){
//            $image = imagecreatefrompng('server/'.$iscontract['background']);
//        }else{
//            $image = imagecreatefrompng('static/home/images/contract.png');
//        }
//        $parameter =  unserialize($iscontract['parameter']);
//        $location =array();
//        foreach ($parameter as $k=>$v){
//            $location[$k] = explode(',',$v,2);
//        }
//        var_dump($location);die;
        $oid = input('oid'); 
        $isorder = db('order')
                ->field('o.*,c.autograph')
                ->alias('o')
                ->join('__CONTRACT__ c','o.ordersn=c.ordersn','LEFT')
                ->where(array('o.id'=>$oid,'o.uid'=> $this->member['id']))
                ->find();
        //var_dump($isorder);die;
        $this->assign('oid', $oid);
        $this->assign('isorder', $isorder);
        $this->assign('webtitle', '购买认购合同');
        return $this->fetch();
    }
    public function sell_lamb_zengsong(){
       $id = input('id');
       $toautograph = input('toautograph');
        $result = db("sell_lamb")->where('id',$id)->update(array('status'=>2,'toautograph'=>$toautograph,'completetime'=>time()));
        $res = db('sell_lamb')->where('id',$id)->find();
        $lambid = $res['lambid'];
        $buyid = $res['buyid'];
        $data = db('lamb')->where(array('id'=>$lambid))->update(array('uid'=>$buyid,'status'=>1));
        if($data && $result){
            return array('type'=>1,'msg'=>"赠送成功");
        }else{
            return array('type'=>0,'msg'=>"赠送失败，请稍后再试");
        }

    }
    public function getprotocol(){
        $oid = input('oid'); 
        $isorder = db('order')
                ->field('o.*,og.num,g.gname,g.percentage,m.username,m.realname,m.mobile,m.cardid,c.autograph')
                ->alias('o')
                ->join('__ORDER_GOODS__ og','o.id=og.oid','LEFT')
                ->join('__GOODS__ g','og.gid=g.id','LEFT')
                ->join('__MEMBER__ m','o.uid=m.id','LEFT')
                ->join('__CONTRACT__ c','o.ordersn=c.ordersn','LEFT')
                ->where(array('o.id'=>$oid,'o.uid'=> $this->member['id']))
                ->find();
        $islamb = db('lamb')->field('lambsn')->where(array('oid'=>$oid))->select();
        $lambarr =array();
        foreach ($islamb as $v){
            $lambarr[] = $v['lambsn'];
        }
        $lambsn = implode(",",$lambarr);
        $safesn = '见详情';
        $return = $isorder['money'] * $isorder['percentage']/100;
        $dataarr = array(
            'realname' => $isorder['realname'],
            'autograph' => $isorder['autograph'],
            'cardid'=>$isorder['cardid'],
            'mobile' => $isorder['mobile'],
            'gname' => $isorder['gname'],
            'num' => $isorder['num'],
            'money' => $isorder['money'],
            'return' => $return,
            'ordersn' => $isorder['ordersn'],
            'lambsn' => $lambsn,
            'safesn' => $safesn,
        );

        //print_r($dataarr);die();
        $iscontract = db('contract_set')->where('id',2)->find();
        if(!empty($iscontract['background'])){
            $image = imagecreatefromjpeg('server/'.$iscontract['background']);
        }else{
            $image = imagecreatefrompng('static/home/images/contract.png');
        }
        $parameter =  unserialize($iscontract['parameter']);
        $location =array();
        foreach ($parameter as $k=>$v){
            $location[$k] = explode(',',$v,2);
        }
                   // 证书模版图片文件的路径 
        $red = imagecolorallocate($image,12,34,56);                 // 字体颜色
//        $autograph = imgUrl($dataarr['autograph']);//需要显示在二维码中的Logo图像
//        if(substr($autograph,0,4)=='http'){
//            $autograph = $autograph;
//        }else{
//            $autograph = ltrim($autograph, "/");
//        }
//        if ($autograph !== FALSE) {
//            $autograph = imagecreatefrompng ( file_get_contents ( $autograph));
//            $image_width = imagesx ( $image );
//            $image_height = imagesy ( $image );
//            $autograph_width = imagesx ( $autograph );
//            $autograph_height = imagesy ( $autograph );
//            $autograph_qr_width = $image_width / 5;
//            $scale = $autograph_width / $autograph_qr_width;
//            $autograph_qr_height = $autograph_height / $scale;
//            $from_width = ($image_width - $autograph_qr_width) / 2;
//            imagecopyresampled ( $image, $autograph, $from_width, $from_width, 0, 0, $autograph_qr_width, $autograph_qr_height, $autograph_width, $autograph_height );
//        }

        // imageTTFText("Image", "Font Size", "Rotate Text", "Left Position","Top Position", "Font Color", "Font Name", "Text To Print");
        if(!empty($location)){
            imageTTFText($image, 28, 0, $location[0][0], $location[0][1], $red, 'static/font/simhei.ttf',$dataarr['realname']);
            imageTTFText($image, 28, 0, $location[1][0], $location[1][1], $red, 'static/font/simhei.ttf', $dataarr['cardid']);
            imageTTFText($image, 28, 0, $location[2][0], $location[2][1], $red, 'static/font/simhei.ttf', $dataarr['mobile']);
            imageTTFText($image, 28, 0, $location[3][0], $location[3][1], $red, 'static/font/simhei.ttf', $dataarr['gname']);
            imageTTFText($image, 28, 0, $location[4][0], $location[4][1], $red, 'static/font/simhei.ttf', $dataarr['num']);
            imageTTFText($image, 28, 0, $location[5][0], $location[5][1], $red, 'static/font/simhei.ttf', $isorder['money']);
            imageTTFText($image, 28, 0, $location[6][0], $location[6][1], $red, 'static/font/simhei.ttf', $isorder['ordersn']);
            imageTTFText($image, 28, 0, $location[7][0], $location[7][1], $red, 'static/font/simhei.ttf', $lambsn);
            imageTTFText($image, 28, 0, $location[8][0], $location[8][1], $red, 'static/font/simhei.ttf', $safesn);
        }else{
            imageTTFText($image, 16, 0, 180, 135, $red, 'static/font/simhei.ttf',$dataarr['realname']);
            imageTTFText($image, 16, 0, 250, 170, $red, 'static/font/simhei.ttf', $dataarr['cardid']);
            imageTTFText($image, 16, 0, 230, 206, $red, 'static/font/simhei.ttf', $dataarr['mobile']);
            imageTTFText($image, 16, 0, 230, 242, $red, 'static/font/simhei.ttf', $dataarr['gname']);
            imageTTFText($image, 16, 0, 230, 278, $red, 'static/font/simhei.ttf', $dataarr['num']);
            imageTTFText($image, 16, 0, 250, 314, $red, 'static/font/simhei.ttf', $isorder['money']);
            imageTTFText($image, 16, 0, 210, 350, $red, 'static/font/simhei.ttf', $return);
            imageTTFText($image, 16, 0, 305, 386, $red, 'static/font/simhei.ttf', $isorder['ordersn']);
            imageTTFText($image, 16, 0, 180, 422, $red, 'static/font/simhei.ttf', $lambsn);
            imageTTFText($image, 16, 0, 180, 458, $red, 'static/font/simhei.ttf', $safesn);
        }
            
        
        

         /* 直接显示在浏览器 */
        //header('Content-type: image/png;');
        ImagePng($image);
        imagedestroy($image);
    }
    //转让合同
    public function protocoldetail1(){
        $oid = input('id');
        $isorder = db('sell_lamb')
            ->field('o.*')
            ->alias('o')
            ->where(array('o.id'=>$oid))
            ->find();
        $this->assign('oid', $oid);
        $this->assign('isorder', $isorder);
        $this->assign('webtitle', '转让认购合同');
        return $this->fetch();
    }

    public function getprotocol1(){
        $oid = input('oid');
        $isorder = db('sell_lamb')
            ->field('o.*,og.lambname,m.username,m.realname,m.mobile,m.cardid')
            ->alias('o')
            ->join('__LAMB__ og','o.lambid = og.id','LEFT')
            ->join('__MEMBER__ m','o.uid=m.id','LEFT')
            ->where(array('o.id'=>$oid))
            ->find();
        $buyid = db('sell_lamb')->where('id',$oid)->value('buyid');
        $buyer = db('member') -> where('id',$buyid)->find();
        $islamb = db('lamb')->field('lambsn')->where(array('id'=>$isorder['lambid']))->select();
        $lambarr =array();
        foreach ($islamb as $v){
            $lambarr[] = $v['lambsn'];
        }
        $lambsn = implode(",",$lambarr);
        $safesn = '见详情';
        //$return = $isorder['money'] * $isorder['percentage']/100;
        $dataarr = array(
            'realname' => $isorder['realname'],
            'uid' => $isorder['uid'],
            'autograph' => $isorder['autograph'],
            'cardid'=>$isorder['cardid'],
            'mobile' => $isorder['mobile'],
            'selluid'=>$isorder['uid'],
            'gname' => $isorder['lambname'],
            'buyname' =>$buyer['realname'],
            'buycardid' => $buyer['cardid'],
            'buymobile' =>$buyer['mobile'],
            'buyuid' =>$buyer['id'],
            'sellsn' => $isorder['sellsn'],
            'lambsn' =>$lambsn,
            'safesn' => $safesn,
        );
        $iscontract = db('contract_set')->where('id',3)->find();
        if(!empty($iscontract['background'])){
            $image = imagecreatefrompng('server/'.$iscontract['background']);
        }else{
            $image = imagecreatefrompng('static/home/images/contract.png');
        }
        $parameter =  unserialize($iscontract['parameter']);
        $location =array();
        foreach ($parameter as $k=>$v){
            $location[$k] = explode(',',$v,2);
        }
        // 证书模版图片文件的路径
        $red = imagecolorallocate($image,12,34,56);                 // 字体颜色
//        $autograph = imgUrl($dataarr['autograph']);//需要显示在二维码中的Logo图像
//        if(substr($autograph,0,4)=='http'){
//            $autograph = $autograph;
//        }else{
//            $autograph = ltrim($autograph, "/");
//        }
//        if ($autograph !== FALSE) {
//            $autograph = imagecreatefrompng ( file_get_contents ( $autograph));
//            $image_width = imagesx ( $image );
//            $image_height = imagesy ( $image );
//            $autograph_width = imagesx ( $autograph );
//            $autograph_height = imagesy ( $autograph );
//            $autograph_qr_width = $image_width / 5;
//            $scale = $autograph_width / $autograph_qr_width;
//            $autograph_qr_height = $autograph_height / $scale;
//            $from_width = ($image_width - $autograph_qr_width) / 2;
//            imagecopyresampled ( $image, $autograph, $from_width, $from_width, 0, 0, $autograph_qr_width, $autograph_qr_height, $autograph_width, $autograph_height );
//        }

        // imageTTFText("Image", "Font Size", "Rotate Text", "Left Position","Top Position", "Font Color", "Font Name", "Text To Print");
        if(!empty($location)){
            imageTTFText($image, 16, 0, $location[0][0], $location[0][1], $red, 'static/font/simhei.ttf',$dataarr['realname']);
            imageTTFText($image, 16, 0, $location[1][0], $location[1][1], $red, 'static/font/simhei.ttf',$dataarr['uid']);
            imageTTFText($image, 16, 0, $location[2][0], $location[2][1], $red, 'static/font/simhei.ttf', $dataarr['cardid']);
            imageTTFText($image, 16, 0, $location[3][0], $location[3][1], $red, 'static/font/simhei.ttf', $dataarr['mobile']);
            imageTTFText($image, 16, 0, $location[4][0], $location[4][1], $red, 'static/font/simhei.ttf', $dataarr['buyname']);
            imageTTFText($image, 16, 0, $location[5][0], $location[5][1], $red, 'static/font/simhei.ttf', $dataarr['buyuid']);
            imageTTFText($image, 16, 0, $location[6][0], $location[6][1], $red, 'static/font/simhei.ttf', $dataarr['buycardid']);
            imageTTFText($image, 16, 0, $location[7][0], $location[7][1], $red, 'static/font/simhei.ttf', $dataarr['buymobile']);
            imageTTFText($image, 16, 0, $location[8][0], $location[8][1], $red, 'static/font/simhei.ttf', $dataarr['sellsn']);
            imageTTFText($image, 16, 0, $location[9][0], $location[9][1], $red, 'static/font/simhei.ttf', $lambsn);
        }else{
//            imageTTFText($image, 16, 0, 180, 135, $red, 'static/font/simhei.ttf',$dataarr['realname']);
//            imageTTFText($image, 16, 0, 250, 170, $red, 'static/font/simhei.ttf', $dataarr['cardid']);
//            imageTTFText($image, 16, 0, 230, 206, $red, 'static/font/simhei.ttf', $dataarr['mobile']);
//            imageTTFText($image, 16, 0, 230, 242, $red, 'static/font/simhei.ttf', $dataarr['gname']);
//            imageTTFText($image, 16, 0, 230, 278, $red, 'static/font/simhei.ttf', $dataarr['num']);
//            imageTTFText($image, 16, 0, 250, 314, $red, 'static/font/simhei.ttf', $isorder['money']);
//            imageTTFText($image, 16, 0, 210, 350, $red, 'static/font/simhei.ttf', $return);
//            imageTTFText($image, 16, 0, 305, 386, $red, 'static/font/simhei.ttf', $isorder['sellsn']);
//            imageTTFText($image, 16, 0, 180, 422, $red, 'static/font/simhei.ttf', $lambsn);
//            imageTTFText($image, 16, 0, 180, 458, $red, 'static/font/simhei.ttf', $safesn);
        }




        /* 直接显示在浏览器 */
        //header('Content-type: image/png;');
        ImagePng($image);
        imagedestroy($image);
    }
    public function qrcode(){
        $lambnum = db('lamb')->where(array('uid'=>Session::get('user')['user_id'],'status'=>1) )->count();
        //计算该用户的羊羔排行
        //$sql = "SELECT lamb.uid, @rank := @rank + 1 AS rank   FROM (SELECT *,COUNT(*) lambnum FROM `".Config::get('database.prefix')."lamb` WHERE `status`=1 GROUP BY uid ORDER BY lambnum DESC,uid=10 DESC) as lamb,(SELECT @rank := 0) r";
        //$sql = "SELECT uid,COUNT(*) lambnum FROM `yyy_lamb`  WHERE `status`=1 GROUP BY uid ORDER BY lambnum DESC,uid=10 DESC";
        $lambrank = db('lamb')->field('uid,COUNT(*) lambnum ')->where(array('status'=>1))->group('uid')->order(array('lambnum'=>'desc'))->order('uid='.$this->member['id'] .' desc')->select();
        $usernum = db('member')->count();
        $myrank= $usernum;
        foreach ($lambrank  as $s=>$v){
            if($v['uid']== $this->member['id']){
                $myrank = $s + 1 ;
                break;
            }
        }
        //超越比率
        $exceed = round(($usernum-$myrank)/$usernum*100,2);
        $this->assign('lambnum', $lambnum);
        $this->assign('exceed', $exceed);
        $this->assign('webtitle', '我的二维码');
        return $this->fetch();
    }
    public function getqrcode(){
        $this->setqrcode();
        $logo = imgUrl($this->member['avatar']);//需要显示在二维码中的Logo图像
        if(substr($logo,0,4)=='http'){
            $logo = $logo;
        }else{
            $logo = ltrim($logo, "/");
        }
        if(!is_file($logo)){
            $logo = 'server/upload/moren.jpg';
        }
        $QR = "server/qrcode/".$this->member['id'].'.png';
        if ($logo !== FALSE ) {
            $QR = imagecreatefromstring ( file_get_contents ( $QR ) );
            $logo = imagecreatefromstring ( file_get_contents ( $logo));
            $QR_width = imagesx ( $QR );
            $QR_height = imagesy ( $QR );
            $logo_width = imagesx ( $logo );
            $logo_height = imagesy ( $logo );
            $logo_qr_width = $QR_width / 5;
            $scale = $logo_width / $logo_qr_width;
            $logo_qr_height = $logo_height / $scale;
            $from_width = ($QR_width - $logo_qr_width) / 2;
            imagecopyresampled ( $QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height );
        }
        imagepng ( $QR);//带Logo二维码的文件名
        imagedestroy($QR);
    }
    public function setqrcode($data=''){
        if(empty($data)){
            $data = $sitehttp = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME']. url('/index/login/reg');
        }
        // 纠错级别：L、M、Q、H
        $level = 'M';
        // 点的大小：1到10,用于手机端4就可以了
        $size = 5;
        // 下面注释了把二维码图片保存到本地的代码,如果要保存图片,用$fileName替换第二个参数false
        $path = "server/qrcode/".$this->member['id'].'.png';
        // 生成的文件名
        //$fileName = $path.$size.'.png';
        //QRcode::png($data, false, $level, $size);
        if(!is_file($path)){
             Loader::import('phpqrcode.phpqrcode');
            $qr = new \QRcode(); 
            $qr->png($data, $path, $level, $size);
        }
       
    }
    public function setagent(){
        if(Request::instance()->isPost()){
            $agentid = input('post.agentid');
            $agentid = codeToAgentid($agentid);
            $shangid = db('member') -> where('agentid',$this->member['id'])->field('id')->select();
            if(!empty($shangid)){
                $shangid = array_map('current', $shangid);
                $res = in_array($agentid,$shangid);
                if(!empty($res)){
                    return array('type'=>0,'msg'=>'修改失败，他是您的下级');
                }
            }
            if($agentid==$this->member['id']){
                return array('type'=>0,'msg'=>'修改失败,邀请人不能是自己。');
            }
            $isagent = db('member')->where('id', $agentid)->find();
            if(empty($isagent)){
                return array('type'=>0,'msg'=>'修改失败,邀请人不存在。');
            }
            $ismember = db('member')->where('id', $this->member['id'])->find();
            if(!empty($ismember['agentid'])){
                return array('type'=>0,'msg'=>'修改失败,邀请人已填写。');
            }
            if(!empty($agentid)){
                $isset = db('member')->where('id', $this->member['id'])->update(array('agentid'=>$agentid));
                $this->setRecommend($this->member['id'] );
                return array('type'=>1,'msg'=>'修改成功');
            }else{
                return array('type'=>0,'msg'=>'修改失败');
            }
        } else {
            return array('type'=>0,'msg'=>'请求错误');
        }
    }
    
    //发布动态
    public function release(){
        ini_set ('memory_limit', '-1');
        if(Request::instance()->isPost()){
            $files = request()->file('comment_img_file');
            $save_url = 'public/upload/comment/' . date('Y', time()) . '/' . date('m-d', time());
            foreach ($files as $file) {
                // 移动到框架应用根目录/public/uploads/ 目录下
                $info = $file->rule('uniqid')->validate(['size' => 1024 * 1024 * 15, 'ext' => 'jpg,png,gif,jpeg'])->move($save_url);

                if ($info) {
                    // 成功上传后 获取上传信息
                    // 输出 jpg
                    $comment_img[] = '/'.$save_url . '/' . $info->getFilename();
                    $source = './'.$save_url . '/' . $info->getFilename();
                    if(filesize($source) > 1024*1024*2){
                        $dst_img = './'.$save_url . '/' . $info->getFilename();
                        $percent = 0.9;  #原图压缩，不缩放
                        $image = (new Compress($source,$percent))->compressImg($dst_img);
                    }

                } else {
                    // 上传失败获取错误信息
                    $this->error($file->getError());
                }
            }
            $add = array(
                'content' => input('post.content'),
                'catid' => 7,
                'userid' => $this->member['id'],
                'username' => $this->member['username'],
                'avatar' => $this->member['avatar'],
                'title' => '发布动态',
                'status' => 1,
                'createtime' => time(),
            );
            if (!empty($comment_img)) {
                $add['img'] = serialize($comment_img);
            }
            //添加评论
            if(!empty($add['content'])){
                $isset = db('article')->insert($add);
                if(!empty($isset)){
//                    return array('type'=>1,'msg'=>'发布成功，等待管理员审核。');
                    $this -> success('发布成功','index/discovery/community');
                }else{
                    $this->error('发布失败');
//                    return array('type'=>0,'msg'=>'发布失败');
                }
            }else{
                $this->error('发布失败');
            }
//            $row = $logic->add_comment($add);
//            if ($row['status'] == 1) {
//                $this->success('评论成功', U('/Mobile/User/comment', array('status'=>1)));
//                exit();
//            } else {
//                $this->error($row['msg']);
//            }
//        }
//        $rec_id = I('rec_id/d');
//        $order_goods = M('order_goods')->where("rec_id", $rec_id)->find();
//        $this->assign('order_goods', $order_goods);
//        return $this->fetch();
//
//
//            $data = array(
//                'content' => input('post.content'),
//                'catid' => 7,
//                'userid' => $this->member['id'],
//                'username' => $this->member['username'],
//                'avatar' => $this->member['avatar'],
//                'title' => '发布动态',
//                'status' => '0',
//                'createtime' => time(),
//            );
//            if(!empty($data['content'])){
//                $isset = db('article')->insert($data);
//                if(!empty($isset)){
//                    return array('type'=>1,'msg'=>'发布成功，等待管理员审核。');
//                }else{
//                    return array('type'=>0,'msg'=>'发布失败');
//                }
//            }else{
//                return array('type'=>0,'msg'=>'发布失败');
//            }
        }
        $this->assign('webtitle', '发布动态');
        return $this->fetch();
    }

    public function order_complete(){
        if(Request::instance()->isPost()){
            $ordersn = input('post.ordersn');
            $data = array();
            $data['status'] = 3;
            $res = db('order') -> where('ordersn',$ordersn) -> update($data);
            if($res){
                return array('type' => 1 ,'data'=>'收货成功');
            }else{
                return array('type' => 1 ,'data'=>'收货失败，请稍后再试~');
            }
        }
    }

    //领券中心抢购
    public function coupon_insert(){
        $id = input('id');
        $res = db('coupon') -> where('id',$id) -> find();
        $uid = $this -> member['id'];
//        $is = db('coupon_data') -> where('couponid',$id) -> where('uid',$uid)->find();
//        if(!empty($is)){
//            return array('type'=>0,'msg'=>'您已经拥有了该优惠卷，快去使用吧！');
//        }
        $time = time();
        $iscoupon = db('coupon_data')
            ->field('cd.id')
            ->alias('cd')
            ->join('__COUPON__ c','cd.couponid = c.id','LEFT')
            ->where(array('cd.uid'=> $uid,'cd.used'=>0,'c.status'=>1,'c.stime'=>['<=',$time],'c.etime'=>['=',0],))
            ->whereOr("`cd`.`uid` = $uid  and `cd`.`used` = 0  and `c`.`status` = 1  and `c`.`stime` <=$time   and `c`.`etime` >$time" )
            ->select();
        $count = count($iscoupon);
        if($count> 9){
            return array('type'=>0,'msg'=>'有效优惠卷大于10张，快去使用吧！');
        }
        if($res['total'] > 0 || $res['total'] == -1){
            $uid = $this -> member['id'];
            $data =array();
            $data['uid'] = $uid;
            $data['couponid'] = $id;
            $data['gettype'] = 1;
            $data['used'] = 0;
            $data['gettime'] = time();
            $result = db('coupon_data') -> insert($data);
            if($result){
                if($res['total'] > 0){
                    db('coupon') -> where('id',$id) -> setDec('total');
                    return array('type'=>1,'msg'=>'获取成功，快去使用吧！');
                }else{
                    return array('type'=>1,'msg'=>'获取成功，快去使用吧！');
                }
            }else{
                return array('type'=>0,'msg'=>'获取失败，请稍后再试！');
            }
        }else{
            return array('type'=>0,'msg'=>'对不起，该优惠卷已抢完！');
        }
    }
    public function exchange(){
        $uid = Session::get('user')['user_id'];
        $where =array();
        $where['o.uid'] = $uid;
        //$where['g.shoptype'] = 1;
        $status = input('post.status');
        if($status==1){
            $where['o.status'] = 1;
        }elseif ($status===0) {
            $where['o.status'] = 0;
        }elseif($status==4){
            $where['o.status'] = 4;
        }elseif($status==2){
            $where['o.status'] = 2;
        }elseif ($status == 3){
            $where['o.status'] = 3;
        }else{

        }

        //print_r($where);
        $list=Db::name('sell_lamb')
            ->field('o.*,og.lambname,og.avatar,og.message,og.paytime')
            ->alias('o')
            ->join('__LAMB__ og','o.lambid = og.id','LEFT')
            ->where($where)
            ->order('o.id', 'desc')
            ->select();
        //$address = db('address') -> where('uid',$uid) -> where('defaults',1)->find();

       // dump($list);die;
        $this->assign('list', $list);
        $this->assign('uid', $uid);
        //$this->assign('address', $address);
        $this->assign('webtitle', '羊羔兑换记录');
        return $this->fetch();
    }
    public function get_exchange(){
        $uid = Session::get('user')['user_id'];
        $where =array();
        $where['o.uid'] = $uid;
        //$where['g.shoptype'] = 1;
        $status = input('post.status');
        if($status==1){
            $where['o.status'] = 1;
        }elseif ($status===0) {
            $where['o.status'] = 0;
        }elseif($status==-1){
            $where['o.status'] = -1;
        }elseif($status==2){
            $where['o.status'] = 2;
        }elseif ($status == 3){
            $where['o.status'] = 3;
        }else{

        }
        //print_r($where);
        $list=Db::name('sell_lamb')
            ->field('o.*,og.lambname,og.avatar,og.message,og.paytime')
            ->alias('o')
            ->join('__LAMB__ og','o.lambid = og.id','LEFT')
            ->where($where)
            ->order('o.id', 'desc')
            ->select();
        $address = db('address') -> where('uid',$uid) -> where('defaults',1)->find();

        if(!empty($list)){
            return array('type'=>1,'data'=>$list,'address'=>$address);
        }else{
            return array('type'=>0,'data'=>'没有更多了~~');
        }

    }

    public function exchange_detail(){
        $uid = Session::get('user')['user_id'];
        $id = input('id');
        $where =array();
        $where['o.uid'] = $uid;
        $where['o.id'] = $id;
//        $where['o.isdelete'] = 0;
        $list=Db::name('sell_lamb')
            ->field('o.*,og.lambname,og.avatar,og.message,og.paytime,g.price,og.paytime,g.percentage')
            ->alias('o')
            ->join('__LAMB__ og','o.lambid = og.id','LEFT')
            ->join('__GOODS__ g','og.gid = g.id','LEFT')
            ->where($where)
            ->order('o.id', 'desc')
            ->select();
        $address = db('address') -> where('uid',$uid) -> where('defaults',1)->find();

        $lvke = db("sell_lamb") -> where('id',$id)->find();
        $uid = $lvke['uid'];
        $tourtype = $lvke['tourtype'];
        $tourlist = $lvke['tourlist'];
        $lambid = $lvke['lambid'];
        if(!empty($tourtype)){
            $tour = db('tour') -> where('catid',$tourtype) -> value('price_ladder');
            $tour = unserialize($tour);
            foreach($tour as $k=>$v){
                if($v['num'] == $tourlist){
                   $play = $v['play'];
                   $back = $v['back'];
                    $people = $v['people'];
                    $arrive = $v['arrive'];
                }
            }
            if(( strtotime($arrive) - time()) > 3*24*3600){
                $del = 1;
            }else{
                $del = 0;
            }
            $this -> assign('arrive',$arrive);
            $this -> assign('play',$play);
            $this -> assign('back',$back);

        }else{
            $tourtype = 0;
            $del = -1;
        }
        $this -> assign('tourtype',$tourtype);
        $this->assign('del',$del);
        $this->assign('myorder', $list);
        $this->assign('uid', $uid);
        $this->assign('address', $address);
        $this->assign('webtitle', '兑换详情');
        return $this->fetch();
    }
    //取消行程
    public function exchange_complete1(){
        $sellsn = input('sellsn');
        if(Request::instance()->isPost()){
            $uid = Session::get('user')['user_id'];
            $lvke = db('sell_lamb') -> where('sellsn',$sellsn) ->find();
            $tourlist = $lvke['tourlist'];
            $lambid = $lvke['lambid'];
            $tourtype = $lvke['tourtype'];
            if(!empty($tourtype)){
                $tour = db('tour') -> where('catid',$tourtype) -> value('price_ladder');
                $tour = unserialize($tour);
                foreach($tour as $k=>$v){
                    if($v['num'] == $tourlist){
                        $key = $k;
                        $people = $v['people'];
                        $arrive = $v['arrive'];
                    }
                }
                if(( strtotime($arrive) - time()) < 5*24*3600){
                    return array('type'=> 0 ,'msg'=>'对不起，因与抵达时间差距小于5天，不能取消');
                }
                $status = db('sell_lamb') -> where('sellsn',$sellsn) -> value('status');
                if($status == 2 || $status== -1 || $status == -3){
                    $result = db('sell_lamb') -> where('sellsn',$sellsn) -> update(array('status'=>-2));
                    if(!empty($result)){
                        return array('type' => 1,'msg'=>'申请取消成功，待系统审核');
                    }else{
                        return array('type' => 0,'msg'=>'取消失败,请联系客服');
                    }
                }elseif ($status == -2){
                    return array('type' => 2,'msg'=>'请勿重复取消');
                }else{
                    if($people>0){
                        $people = $people + 1;
                        $tour[$key]['people'] = $people;
                        $tour = serialize($tour);
                        $res = db('tour') -> where('catid',$tourtype) -> update(array('price_ladder'=>$tour));
                        $result = db('lamb') -> where('id',$lambid) -> update(array('status'=>1));
                        $result2 = db('sell_lamb') -> where('sellsn',$sellsn) -> update(array('isdelete'=>1));
                        $result1 = db('sell_lamb') -> where('sellsn',$sellsn) -> update(array('status'=>4));
                        if(( $result && $result1 && $result2 && $res)){
                            return array('type' => 1,'msg'=>'取消成功，羊只重新归还');
                        }else{
                            return array('type' => 0,'msg'=>'取消失败,请联系客服');
                        }
                    }else{
                        return array('type'=>0,'msg'=>'上限人数已满');
                    }
                }

            }

        }
    }
    public function exchange_complete(){
        $sellsn = input('sellsn');
        if(Request::instance()->isPost()){
            $uid = Session::get('user')['user_id'];
            $res = db('sell_lamb')->where('sellsn',$sellsn)->where('uid',$uid)->update(array('status'=>2,'completetime'=>time()));
            if($res){
                $lambid = db('sell_lamb')->where('sellsn',$sellsn)->where('uid',$uid)->value('lambid');

               $oid= db('lamb')->where('id',$lambid)->value('oid');
                $this->setCommissionOne($oid,$lambid);
                return array('type'=>1,'msg'=>'收货成功~~');
            }else{
                return array('type'=>0,'msg'=>'收货失败，请稍后再试~~');
            }
        }
    }
    public function ajaxlvyou(){
        if(Request::instance()->isPost()) {
            $id = input('id');
            $arr = db('tour') -> where('catid',$id) ->where('status',1)-> find();

            if (!empty($arr)) {
                $data = unserialize($arr['price_ladder']);
            }
            if(!empty($data)){
                foreach ($data as $k=>$v){
                    if(strtotime($v['arrive'])<=(time()+3600*24)){
                        unset($data["$k"]);
                    }
                }
                return array('type'=>1,'data'=>$data,'arr'=>$arr);
            }else
                return array('type'=> 0,'data'=>'未找到相关行程');
        }
    }

    public function detail(){
        $id= input('id');
        $myarticle = db('tour')->where(array('catid'=>$id,'status'=>1))->find();

        $userId = $myarticle['userid'];

        if(!empty($myarticle)){
            $myarticle['img'] = unserialize($myarticle['img']); // 晒单图片
            $this->assign('myarticle', $myarticle);
        }else{
            exit();
        }
        $isdelarticle = 0;
        if(!empty(Session::get('user.user_id'))){
            $userid = Session::get('user.user_id');
            if($userid == $userId){
                $isdelarticle = 1;
            }
        }elseif(@$_COOKIE['mobile']){
            $mobile = $_COOKIE['mobile'];
            $userid = db('member') -> where('mobile',$mobile) -> value('id');
            if($userid == $userId){
                $isdelarticle = 1;
            }

        }else{
            $iszan = 0;
        }
        //dump($iszan);die;

        db('tour') -> where('id',$id)->setInc('hits'); //增加阅读
        //dump($list);die;
        $this -> assign('isdelarticle',$isdelarticle);

        $this->assign('webtitle', $myarticle['title']);
        return $this->fetch();
    }

    public function detail1(){
        $id= input('id');
        $myarticle = db('tour')->where(array('catid'=>$id,'status'=>1))->find();

        $userId = $myarticle['userid'];

        if(!empty($myarticle)){
            $myarticle['img'] = unserialize($myarticle['img']); // 晒单图片
            $this->assign('myarticle', $myarticle);
        }else{
            exit();
        }
        $isdelarticle = 0;
        if(!empty(Session::get('user.user_id'))){
            $userid = Session::get('user.user_id');
            if($userid == $userId){
                $isdelarticle = 1;
            }
        }elseif(@$_COOKIE['mobile']){
            $mobile = $_COOKIE['mobile'];
            $userid = db('member') -> where('mobile',$mobile) -> value('id');
            if($userid == $userId){
                $isdelarticle = 1;
            }

        }else{
            $iszan = 0;
        }
        //dump($iszan);die;

        db('tour') -> where('id',$id)->setInc('hits'); //增加阅读
        //dump($list);die;
        $this -> assign('isdelarticle',$isdelarticle);
        $this->assign('webtitle', $myarticle['title']);
        return $this->fetch();
    }

    public  function ajaxxiaoxi(){
        if(Request::instance()->isPost()) {
            if (!empty(Session::get('user.user_id'))) {
                $userid = Session::get('user.user_id');
            } elseif (@$_COOKIE['mobile']) {
                $mobile = $_COOKIE['mobile'];
                $userid = db('member')->where('mobile', $mobile)->value('id');
            }
            if($userid){
                $count = db('commission_log') -> where(['prizeid'=>$userid,'is_read'=>0])->count();
                return $count;
            }

        }
    }
    public function xiaoxilog(){
        if (!empty(Session::get('user.user_id'))) {
            $userid = Session::get('user.user_id');
        } elseif (@$_COOKIE['mobile']) {
            $mobile = $_COOKIE['mobile'];
            $userid = db('member')->where('mobile', $mobile)->value('id');
        }
        if($userid){
            $notice_list = db('commission_log')->where(array('prizeid'=>$userid))->order(array('id'=>'desc'))->select();
            $count = count($notice_list);
            $page_count = 15;
            $page = new AjaxPage($count, $page_count);
            $list = db('commission_log')->where(array('prizeid'=>$userid))->order(array('is_read'=>'asc','id'=>'desc'))->limit($page->firstRow . ',' . $page->listRows) ->select();
           // $list2 = db('commission_log')->where(array('prizeid'=>4,'is_read'=>1))->order(array('id'=>'desc'))->limit($page->firstRow . ',' . $page->listRows) ->select();
//            foreach ($list as $s=>$v){
//                $list[$s]['timestr'] = time_tran($v['createtime']);
//                $list[$s]['content'] = strip_tags($v['content']);
//                $list[$s]['content'] = filterComment($list[$s]['content']);
//                $list[$s]['img'] = unserialize($v['img']); // 晒单图片
//            }



            //var_dump($list);die;
            if(empty(input('get.p'))){
                $p = 0;
            }else{
                $p = input('get.p');
            }
            $this->assign('list', $list);
            $this->assign('commentlist', $list);
            $this->assign('count', $count);//总条数
            $this->assign('page_count', $page_count);//页数
            $this->assign('current_count', $page_count * input('get.p'));//当前条
            $this->assign('p', $p);//页数
            return $this->fetch();

        }

    }
    public function ajaxnotice()
    {
        if (!empty(Session::get('user.user_id'))) {
            $userid = Session::get('user.user_id');
        } elseif (@$_COOKIE['mobile']) {
            $mobile = $_COOKIE['mobile'];
            $userid = db('member')->where('mobile', $mobile)->value('id');
        }
        if ($userid) {
            $notice_list = db('commission_log')->where(array('prizeid' => $userid))->order(array('id' => 'desc'))->select();
            $count = count($notice_list);
            $page_count = 15;
            $page = new AjaxPage($count, $page_count);
            $list = db('commission_log')->where(array('prizeid' => $userid))->order(array('is_read'=>'asc','id' => 'desc'))->limit($page->firstRow . ',' . $page->listRows)->select();
           // $list2 = db('commission_log')->where(array('prizeid' => 4,'is_read'=>1))->order(array('id' => 'desc'))->limit($page->firstRow . ',' . $page->listRows)->select();
//            foreach ($list as $s=>$v){
//                $list[$s]['timestr'] = time_tran($v['createtime']);
//                $list[$s]['content'] = strip_tags($v['content']);
//                $list[$s]['content'] = filterComment($list[$s]['content']);
//                $list[$s]['img'] = unserialize($v['img']); // 晒单图片
//            }

            if (empty(input('get.p'))) {
                $p = 0;
            } else {
                $p = input('get.p');
            }
            $this->assign('list', $list);
            $this->assign('commentlist', $list);
            $this->assign('count', $count);//总条数
            $this->assign('page_count', $page_count);//页数
            $this->assign('current_count', $page_count * input('get.p'));//当前条
            $this->assign('p', $p);//页数
            return $this->fetch();
        }
    }

    public  function notice_detail(){
        $id = input('id');
       if($id){
           $data = db('commission_log')->where('id',$id)->find();
           db('commission_log')->where('id',$id)->update(array('is_read'=>1));
           $lambid = $data['lambid'];
           $ordersn = $data['ordersn'];
           $uid = db('order')->where('ordersn',$ordersn)->value('uid');
           $username = db('member')->where('id',$uid)->value('username');
           $this->assign('username',$username);
           $this->assign('data',$data);
           $this->assign('ordersn',$ordersn);
           return $this->fetch();

       }
    }
    public function photograph(){
        $count = count(db('article')->where(array('catid'=>8,'status'=>1))->select());
        $page_count = 6;
        $page = new AjaxPage($count, $page_count);
        $order_bay = input('order');
        if(!empty('order') && $order_bay == 1){
            $order_sort = array('id'=>'desc');
        }else if(!empty('order') && $order_bay == 2){
            $order_sort = array('vote'=>'asc');
        }else if(!empty('order') && $order_bay == 3){
            $order_sort = array('vote'=>'desc');
        } else {
            $order_sort = array('id'=>'desc');
        }
        $mobile = input('mobile');
        if(!empty($mobile)){
            $userid = \db('member') -> where("mobile" , $mobile) -> value('id');
            if(!empty($userid)){
                $where = "userid =". $userid;
            }else{
                $where = " 1 != 1";
            }
        }else{
            $where = true;
        }
       // var_dump($where);die;
        $list = db('article')->where(array('catid'=>8,'status'=>1))->where($where)->order($order_sort)->limit($page->firstRow . ',' . $page->listRows) ->select();
        foreach ($list as $s=>$v){
            $list[$s]['timestr'] = time_tran($v['createtime']);
            $list[$s]['content'] = strip_tags($v['content']);
            $list[$s]['content'] = filterComment($list[$s]['content']);
            $list[$s]['img'] = unserialize($v['img']); // 晒单图片
            $image = unserialize($v['img']);
            if($image){
                foreach ($image as $k=>$v){
                    $list[$s]['size'][$k] = getimagesize('http://'.$_SERVER['HTTP_HOST'].$v);
                }
            }

        }
        //var_dump($list);die;
        if(empty(input('get.p'))){
            $p = 0;
        }else{
            $p = input('get.p');
        }
        $this->assign('list', $list);
        $this->assign('commentlist', $list);
        $this->assign('webtitle', '摄影大赛');
        $this->assign('count', $count);//总条数
        $this->assign('page_count', $page_count);//页数
        $this->assign('current_count', $page_count * input('get.p'));//当前条
        $this->assign('p', $p);//页数
        $this->assign('order_bay', $order_bay);
        return $this->fetch();
    }
    public function ajaxphotograph(){
        $count = count(db('article')->where(array('catid'=>8,'status'=>1))->select());
        $page_count = 6;
        $page = new AjaxPage($count, $page_count);
        $order_bay = input('order_bay');
        if(!empty('order') && $order_bay == 1){
            $order_sort = array('id'=>'desc');
        }else if(!empty('order') && $order_bay == 2){
            $order_sort = array('vote'=>'asc');
        }else if(!empty('order') && $order_bay == 3){
            $order_sort = array('vote'=>'desc');
        } else {
            $order_sort = array('id'=>'desc');
        }
        $list = db('article')->where(array('catid'=>8,'status'=>1))->order($order_sort)->limit($page->firstRow . ',' . $page->listRows) ->select();
        foreach ($list as $s=>$v){
            $list[$s]['timestr'] = time_tran($v['createtime']);
            $list[$s]['content'] = strip_tags($v['content']);
            $list[$s]['content'] = filterComment($list[$s]['content']);
            $list[$s]['img'] = unserialize($v['img']); // 晒单图片
            $image = unserialize($v['img']);
            if($image){
                foreach ($image as $k=>$v){
                    $list[$s]['size'][$k] = getimagesize('.'.$v);
                }
            }
        }
        if(empty(input('get.p'))){
            $p = 0;
        }else{
            $p = input('get.p');
        }
        $this->assign('list', $list);
        $this->assign('commentlist', $list);
        $this->assign('count', $count);//总条数
        $this->assign('page_count', $page_count);//页数
        $this->assign('current_count', $page_count * input('get.p'));//当前条
        $this->assign('p', $p);//页数
        $this->assign('order_bay',$order_bay);
        return $this->fetch();
    }

    public function dan_photorelease(){
        $start = strtotime('18-08-02');
        if($start<time()){
           $this->error('对不起，现已截稿，无法上传');
        }
        ini_set ('memory_limit', '-1');
        $userid = $this->member['id'];
        $data = \db('article') -> where('userid',$userid)->where('dan_zu',1)->select();
        $count = 0;
        $img = 0;
        if($data){
            foreach ($data as $v){
                $img = count(unserialize($v['img']));
            }
            if(count($data)>1){
                $this->error('你已上传2次单照，如重新上传，请先删除之前单照');
            }
        }
        $res = db('article')->where('dan_zu',2)->where('userid',$userid)->count();
        if($res){
            $this->error('您已经上传组照，如重新上传，请先删除之前所有组照');
        }
        if(Request::instance()->isPost()){
            $files = request()->file('comment_img_file');
           $img_num = count($files);
           if(($img + $img_num)>2){
               $this->error('你上传数大于2张单照，如重新上传，请先删除之前单照');
           }
            $save_url = 'public/upload/comment/' . date('Y', time()) . '/' . date('m-d', time());
            foreach ($files as $file) {
                // 移动到框架应用根目录/public/uploads/ 目录下
                $info = $file->rule('uniqid')->validate(['size' => 1024 * 1024 * 15, 'ext' => 'jpg,png,gif,jpeg'])->move($save_url);

                if ($info) {
                    // 成功上传后 获取上传信息
                    // 输出 jpg
                    $comment_img[] = '/'.$save_url . '/' . $info->getFilename();
                    $source = './'.$save_url . '/' . $info->getFilename();
                    if(filesize($source) > 1024*1024*2){
                        $dst_img = './'.$save_url . '/' . $info->getFilename();
                        $percent = 0.9;  #原图压缩，不缩放
                        $image = (new Compress($source,$percent))->compressImg($dst_img);
                    }

                } else {
                    // 上传失败获取错误信息
                    $this->error($file->getError());
                }
            }
            $add = array(
                'content' => input('post.content'),
                'catid' => 8,
                'userid' => $this->member['id'],
                'username' => $this->member['username'],
                'avatar' => $this->member['avatar'],
                'title' => '摄影大赛',
                'status' => 1,
                'createtime' => time(),
                'dan_zu' => 1
            );
            if (!empty($comment_img)) {
                $add['img'] = serialize($comment_img);
            }
            //添加评论
            if(!empty($add['content'])){
                $isset = db('article')->insert($add);
                if(!empty($isset)){
//                    return array('type'=>1,'msg'=>'发布成功，等待管理员审核。');
                    $this -> success('发布成功','index/user/photograph');
                }else{
                    $this->error('发布失败');
//                    return array('type'=>0,'msg'=>'发布失败');
                }
            }else{
                $this->error('发布失败');
            }

        }
        $this->assign('webtitle', '摄影发布');
        return $this->fetch();
    }
    public function zu_photorelease(){
        $start = strtotime('18-08-02');
        if($start<time()){
            $this->error('对不起，现已截稿，无法上传');
        }
        ini_set ('memory_limit', '-1');
        $userid =  $this->member['id'];
        $res = db('article')->where('dan_zu',1)->where('userid',$userid)->count();
        if($res){
            $this->error('您已经上传单照，如重新上传，请先删除之前所有单照');
        }
        $count = \db('article') ->where('dan_zu',2)->where('userid',$userid)->count();
        if($count>1){
            $this->error('您已经上传2次组照，如重新上传，请先删除之前组照');
        }
        if(Request::instance()->isPost()){
            $files = request()->file('comment_img_file');
            $save_url = 'public/upload/comment/' . date('Y', time()) . '/' . date('m-d', time());
            foreach ($files as $file) {
                // 移动到框架应用根目录/public/uploads/ 目录下
                $info = $file->rule('uniqid')->validate(['size' => 1024 * 1024 * 15, 'ext' => 'jpg,png,gif,jpeg'])->move($save_url);

                if ($info) {
                    // 成功上传后 获取上传信息
                    // 输出 jpg
                    $comment_img[] = '/'.$save_url . '/' . $info->getFilename();
                    $source = './'.$save_url . '/' . $info->getFilename();
                    if(filesize($source) > 1024*1024*2){
                        $dst_img = './'.$save_url . '/' . $info->getFilename();
                        $percent = 0.9;  #原图压缩，不缩放
                        $image = (new Compress($source,$percent))->compressImg($dst_img);
                    }

                } else {
                    // 上传失败获取错误信息
                    $this->error($file->getError());
                }
            }
            $add = array(
                'content' => input('post.content'),
                'catid' => 8,
                'userid' => $this->member['id'],
                'username' => $this->member['username'],
                'avatar' => $this->member['avatar'],
                'title' => '摄影大赛',
                'status' => 1,
                'createtime' => time(),
                'dan_zu' => 2
            );
            if (!empty($comment_img)) {
                $add['img'] = serialize($comment_img);
            }
            //添加评论
            if(!empty($add['content'])){
                $isset = db('article')->insert($add);
                if(!empty($isset)){
//                    return array('type'=>1,'msg'=>'发布成功，等待管理员审核。');
                    $this -> success('发布成功','index/user/photograph');
                }else{
                    $this->error('发布失败');
//                    return array('type'=>0,'msg'=>'发布失败');
                }
            }else{
                $this->error('发布失败');
            }

        }
        $this->assign('webtitle', '摄影发布');
        return $this->fetch();
    }
    public function content(){
        //通过文章id获取文章
        $id= input('id');
        $myarticle = db('article')->where(array('id'=>$id,'status'=>1))->find();
        $userId = $myarticle['userid'];
        $list = db('comment') -> where(array('aid'=>$id,'status'=>1))-> select();
        if(!empty($myarticle)){
            $myarticle['img'] = unserialize($myarticle['img']); // 晒单图片

            if( $myarticle['img']){
                foreach ( $myarticle['img'] as $k=>$v){
                    $myarticle['size'][$k] = getimagesize('http://'.$_SERVER['HTTP_HOST'].$v);
                }
            }
            $this->assign('myarticle', $myarticle);
        }else{
            exit();
        }
        $isdelarticle = 0;
        if(!empty(Session::get('user.user_id'))){
            $userid = Session::get('user.user_id');
            if($userid == $userId){
                $isdelarticle = 1;
            }
            $iszan = db('comment') -> where('userid',$userid)->where('aid',$id)->where("comment is null")->value('iszan');
        }elseif(@$_COOKIE['mobile']){
            $mobile = $_COOKIE['mobile'];
            $userid = db('member') -> where('mobile',$mobile) -> value('id');
            if($userid == $userId){
                $isdelarticle = 1;
            }
            $iszan = db('comment') -> where('userid',$userid)->where('aid',$id)->where("comment is null")->value('iszan');
        }else{
            $iszan = 0;
        }
        //dump($iszan);die;
        $count = count(db('comment')->where(array('aid'=>$id,'status'=>1))->select());
        $page_count = 8;
        $page = new AjaxPage($count, $page_count);
        $list = db('comment')->where(array('aid'=>$id,'status'=>1,'mid'=>0))->order(array('id'=>'desc'))->limit($page->firstRow . ',' . $page->listRows) ->select();
        // dump($list);die;
        if(empty(input('get.p'))){
            $p = 0;
        }else{
            $p = input('get.p');
        }
        foreach ($list as $s=>$v){
            $list[$s]['timestr'] = time_tran($v['time']);
            $list[$s]['comment'] = strip_tags($v['comment']);
            $list[$s]['comment'] =  filterComment($list[$s]['comment']);
            $list[$s]['comment_count'] = count(db('comment') -> where(array('mid'=>$v['id'],'status'=>1))->select());
        }
        db('article') -> where('id',$id)->setInc('hits'); //增加阅读
        //dump($list);die;
        $this -> assign('isdelarticle',$isdelarticle);
        $this -> assign('list',$list);
        $this -> assign('iszan',$iszan);
        $this->assign('webtitle', $myarticle['title']);
        $this->assign('count', $count);//总条数
        $this->assign('page_count', $page_count);//页数
        $this->assign('current_count', $page_count * input('get.p'));//当前条
        $this->assign('p', $p);//页数
        $this->assign('commentlist', $list);
        return $this->fetch();
    }

    public function del_article(){
        if (Request::instance()->isPost()) {
            $id = Request::instance()->post();
            $res = db('article') -> where('id',$id['id']) -> delete();
            if($res){
                db('comment') -> where('aid',$id['id']) -> delete();
                return array('status'=> 1 , 'msg'=> '删除成功');
            }else{
                return array('status'=> 0 , 'msg'=> '删除失败');
            }
        }
    }

    public function toupiao(){
        $start = strtotime('18-07-21');
        if($start>time()){
            return array('status'=>0,'msg'=>'投票将于7月21日开始');
        }
        $end = strtotime('18-08-02');
        if($end<time()){
            return array('status'=>0,'msg'=>'投票已结束');
        }
        if (Request::instance()->isPost()) {
            $userid = $this->member['id'];
            $time = \db('vote_log')->where('uid',$userid)->order("addtime desc")->value('addtime');
            if(!empty($time)){
                $t1 = strtotime(date('y-m-d',$time));
//取出当前日期
                $t2 = strtotime(date('y-m-d'));
//计算当前相差天数
                $t = $t2 - $t1;
                $t =  (int)($t / 86400);
                if($t>=1){
                    $data['aid'] = input('id');
                    $data['uid'] = $userid;
                    $data['vote'] = 1;
                    $data['addtime'] = time();
                    $res = db('vote_log')->insert($data);
                    if($res){
                        db('article')->where('id',input('id'))->setInc('vote',1);
                    }
                    return array('status'=> 1 , 'msg'=> '投票成功');
                }else{
                    return array('status'=> 0 , 'msg'=> '今日已投票');
                }
            }else{
                $data['aid'] = input('id');
                $data['uid'] = $userid;
                $data['vote'] = 1;
                $data['addtime'] = time();
                $res = db('vote_log')->insert($data);
                if($res){
                    db('article')->where('id',input('id'))->setInc('vote',1);
                }
                return array('status'=> 1 , 'msg'=> '投票成功');
            }
        }
    }

    public function photodetail(){
        $this->assign('webtitle','大赛详情');
        return $this->fetch();
    }
    public function agentlist(){
        $member = $this->member;
        $uid = $member['id'];

        $list = db('agent') ->field('o.*,og.lambname')
            ->alias('o')->join('__LAMB__ og','lambid = og.id','LEFT')->where(['o.uid'=>$uid])->order("addtime desc")->select();

        $time = time();
        $data = \db('agent') ->field('o.*,og.lambname')
            ->alias('o')-> join('__LAMB__ og','lambid = og.id','LEFT')->where("o.uid = $uid and endtime > $time") -> order("addtime desc") -> select();
        $arr = \db('agent') ->field('o.*,og.lambname')
            ->alias('o')-> join('__LAMB__ og','lambid = og.id','LEFT')->where("o.uid = $uid and endtime <= $time") -> order("addtime desc") -> select();
        $this->assign('data',$data);
        $this->assign('arr',$arr);
        $this->assign('webtitle','代理证书');
        $this->assign('list',$list);

        return $this->fetch();
    }
    public function agent(){
        $member = $this->member;
        $id = input('id');
        $img = \db('agent')->where('id',$id)->value('img');
        if(!empty($img)){
            $this->assign('img',$img);
        }else{
            $uid = $member['id'];
            $img = $this->getagent1($uid,$id);
            $this->assign('img',$img);
        }

        $this->assign('id',$id);
        $webtitle = '我的代理证书';
        $this->assign('webtitle',$webtitle);
        $this->assign('uid',$member['id']);
        return $this->fetch();
    }

    public function getagent(){
        $uid = input('uid');
        $id = input('id');
        $isorder = db('agent')
            ->field('o.*,og.lambname,m.username,m.realname,m.mobile,m.cardid')
            ->alias('o')
            ->join('__LAMB__ og','o.lambid = og.id','LEFT')
            ->join('__MEMBER__ m','o.uid=m.id','LEFT')
            ->where(array('o.id'=>$id))
            ->find();

        //$buyid = db('sell_lamb')->where('id',$oid)->value('buyid');
        $buyer = db('member') -> where('id',$uid)->find();
        $islamb = db('lamb')->field('lambsn')->where(array('id'=>$isorder['lambid']))->select();
        $lambarr =array();
        foreach ($islamb as $v){
            $lambarr[] = $v['lambsn'];
        }
        $lambsn = implode(",",$lambarr);
        $safesn = '见详情';
        //$return = $isorder['money'] * $isorder['percentage']/100;
        $dataarr = array(
            'realname' => $isorder['realname'],
            'uid' => $isorder['uid'],
            //'autograph' => $isorder['autograph'],
            'cardid'=>$isorder['cardid'],
            'mobile' => $isorder['mobile'],
            'selluid'=>$isorder['uid'],
            'gname' => $isorder['lambname'],
            'buyname' =>$buyer['realname'],
            'buycardid' => $buyer['cardid'],
            'buymobile' =>$buyer['mobile'],
            'buyuid' =>$buyer['id'],
            'code' => $isorder['code'],
            'lambsn' =>$lambsn,
            'safesn' => $safesn,
            'time' =>date('Y年m月d日',$isorder['addtime']).'至'.date('Y年m月d日',$isorder['endtime']-1),

            //'city' =>$isorder['city'],
            'addtime_y'=>date('Y',$isorder['addtime']),
            'addtime_m'=>date('m',$isorder['addtime']),
             'addtime_d'=>date('d',$isorder['addtime'])
        );
        $iscontract = db('contract_set')->where('id',3)->find();
//        if(!empty($iscontract['background'])){
//            $image = imagecreatefrompng('server/'.$iscontract['background']);
//        }else{
            $image = imagecreatefromjpeg('./static/home/images/shouquan.jpg');
        //$image = imagecreatefrompng('server/'.$iscontract['background']);
//        }
        $parameter =  unserialize($iscontract['parameter']);
        $location =array();
        foreach ($parameter as $k=>$v){
            $location[$k] = explode(',',$v,2);
        }
        // 证书模版图片文件的路径
        $red = imagecolorallocate($image,12,34,56);                 // 字体颜色

        if(empty($location)){
//            imageTTFText($image, 16, 0, $location[0][0], $location[0][1], $red, 'static/font/simhei.ttf',$dataarr['realname']);
//            imageTTFText($image, 16, 0, $location[1][0], $location[1][1], $red, 'static/font/simhei.ttf',$dataarr['uid']);
//            imageTTFText($image, 16, 0, $location[2][0], $location[2][1], $red, 'static/font/simhei.ttf', $dataarr['cardid']);
//            imageTTFText($image, 16, 0, $location[3][0], $location[3][1], $red, 'static/font/simhei.ttf', $dataarr['mobile']);
//            imageTTFText($image, 16, 0, $location[4][0], $location[4][1], $red, 'static/font/simhei.ttf', $dataarr['buyname']);
//            imageTTFText($image, 16, 0, $location[5][0], $location[5][1], $red, 'static/font/simhei.ttf', $dataarr['buyuid']);
//            imageTTFText($image, 16, 0, $location[6][0], $location[6][1], $red, 'static/font/simhei.ttf', $dataarr['buycardid']);
//            imageTTFText($image, 16, 0, $location[7][0], $location[7][1], $red, 'static/font/simhei.ttf', $dataarr['buymobile']);
//
//            imageTTFText($image, 16, 0, $location[9][0], $location[9][1], $red, 'static/font/simhei.ttf', $lambsn);
        }else{
            imageTTFText($image, 15, 0, 420, 368, $red, 'static/font/simhei.ttf',$dataarr['realname']);
           // imageTTFText($image, 16, 0, 250, 170, $red, 'static/font/simhei.ttf', $dataarr['cardid']);
           // imageTTFText($image, 16, 0, 230, 206, $red, 'static/font/simhei.ttf', $dataarr['mobile']);
           // imageTTFText($image, 16, 0, 230, 242, $red, 'static/font/simhei.ttf', $dataarr['gname']);
            imageTTFText($image, 12, 0, 240, 448, $red, 'static/font/simhei.ttf', $dataarr['time']);
            imageTTFText($image, 15, 0, 240, 478, $red, 'static/font/simhei.ttf', $dataarr['code']);
            imageTTFText($image, 16, 0, 325, 708, $red, 'static/font/simhei.ttf', $dataarr['addtime_y']);
            imageTTFText($image, 16, 0, 390, 708, $red, 'static/font/simhei.ttf', $dataarr['addtime_m']);
            imageTTFText($image, 16, 0, 432, 708, $red, 'static/font/simhei.ttf', $dataarr['addtime_d']);
            //imageTTFText($image, 16, 0, 180, 422, $red, 'static/font/simhei.ttf', $lambsn);
            //imageTTFText($image, 16, 0, 180, 458, $red, 'static/font/simhei.ttf', $safesn);
        }



        $img = db('agent') ->where('id',$id)->value('img');
        if(empty($img)){
            $res = $this->base64ToImgFile($image);
            if($res){
                db('agent')->where('id',$id)->update(['img'=>$res]);
            }
        }
        $this->assign('img',$img);
        /* 直接显示在浏览器 */
        //header('Content-type: image/png;');
        ImagePng($image);
        imagedestroy($image);
    }

    public function getagent1($uid,$id){
//        $uid = input('uid');
//        $id = input('id');
        $isorder = db('agent')
            ->field('o.*,og.lambname,m.username,m.realname,m.mobile,m.cardid')
            ->alias('o')
            ->join('__LAMB__ og','o.lambid = og.id','LEFT')
            ->join('__MEMBER__ m','o.uid=m.id','LEFT')
            ->where(array('o.id'=>$id))
            ->find();

        //$buyid = db('sell_lamb')->where('id',$oid)->value('buyid');
        $buyer = db('member') -> where('id',$uid)->find();
        $islamb = db('lamb')->field('lambsn')->where(array('id'=>$isorder['lambid']))->select();
        $lambarr =array();
        foreach ($islamb as $v){
            $lambarr[] = $v['lambsn'];
        }
        $lambsn = implode(",",$lambarr);
        $safesn = '见详情';
        //$return = $isorder['money'] * $isorder['percentage']/100;
        $dataarr = array(
            'realname' => $isorder['realname'],
            'uid' => $isorder['uid'],
            //'autograph' => $isorder['autograph'],
            'cardid'=>$isorder['cardid'],
            'mobile' => $isorder['mobile'],
            'selluid'=>$isorder['uid'],
            'gname' => $isorder['lambname'],
            'buyname' =>$buyer['realname'],
            'buycardid' => $buyer['cardid'],
            'buymobile' =>$buyer['mobile'],
            'buyuid' =>$buyer['id'],
            'code' => $isorder['code'],
            'lambsn' =>$lambsn,
            'safesn' => $safesn,
            'time' =>date('Y年m月d日',$isorder['addtime']).'至'.date('Y年m月d日',$isorder['endtime']-1),

            //'city' =>$isorder['city'],
            'addtime_y'=>date('Y',$isorder['addtime']),
            'addtime_m'=>date('m',$isorder['addtime']),
            'addtime_d'=>date('d',$isorder['addtime'])
        );
        $iscontract = db('contract_set')->where('id',3)->find();
//        if(!empty($iscontract['background'])){
//            $image = imagecreatefrompng('server/'.$iscontract['background']);
//        }else{
        $image = imagecreatefromjpeg('./static/home/images/shouquan.jpg');
        //$image = imagecreatefrompng('server/'.$iscontract['background']);
//        }
        $parameter =  unserialize($iscontract['parameter']);
        $location =array();
        foreach ($parameter as $k=>$v){
            $location[$k] = explode(',',$v,2);
        }
        // 证书模版图片文件的路径
        $red = imagecolorallocate($image,12,34,56);                 // 字体颜色

        if(empty($location)){
//            imageTTFText($image, 16, 0, $location[0][0], $location[0][1], $red, 'static/font/simhei.ttf',$dataarr['realname']);
//            imageTTFText($image, 16, 0, $location[1][0], $location[1][1], $red, 'static/font/simhei.ttf',$dataarr['uid']);
//            imageTTFText($image, 16, 0, $location[2][0], $location[2][1], $red, 'static/font/simhei.ttf', $dataarr['cardid']);
//            imageTTFText($image, 16, 0, $location[3][0], $location[3][1], $red, 'static/font/simhei.ttf', $dataarr['mobile']);
//            imageTTFText($image, 16, 0, $location[4][0], $location[4][1], $red, 'static/font/simhei.ttf', $dataarr['buyname']);
//            imageTTFText($image, 16, 0, $location[5][0], $location[5][1], $red, 'static/font/simhei.ttf', $dataarr['buyuid']);
//            imageTTFText($image, 16, 0, $location[6][0], $location[6][1], $red, 'static/font/simhei.ttf', $dataarr['buycardid']);
//            imageTTFText($image, 16, 0, $location[7][0], $location[7][1], $red, 'static/font/simhei.ttf', $dataarr['buymobile']);
//
//            imageTTFText($image, 16, 0, $location[9][0], $location[9][1], $red, 'static/font/simhei.ttf', $lambsn);
        }else{
            imageTTFText($image, 15, 0, 420, 368, $red, 'static/font/simhei.ttf',$dataarr['realname']);
            // imageTTFText($image, 16, 0, 250, 170, $red, 'static/font/simhei.ttf', $dataarr['cardid']);
            // imageTTFText($image, 16, 0, 230, 206, $red, 'static/font/simhei.ttf', $dataarr['mobile']);
            // imageTTFText($image, 16, 0, 230, 242, $red, 'static/font/simhei.ttf', $dataarr['gname']);
            imageTTFText($image, 12, 0, 240, 448, $red, 'static/font/simhei.ttf', $dataarr['time']);
            imageTTFText($image, 15, 0, 240, 478, $red, 'static/font/simhei.ttf', $dataarr['code']);
            imageTTFText($image, 16, 0, 325, 708, $red, 'static/font/simhei.ttf', $dataarr['addtime_y']);
            imageTTFText($image, 16, 0, 390, 708, $red, 'static/font/simhei.ttf', $dataarr['addtime_m']);
            imageTTFText($image, 16, 0, 432, 708, $red, 'static/font/simhei.ttf', $dataarr['addtime_d']);
            //imageTTFText($image, 16, 0, 180, 422, $red, 'static/font/simhei.ttf', $lambsn);
            //imageTTFText($image, 16, 0, 180, 458, $red, 'static/font/simhei.ttf', $safesn);
        }



        $img = db('agent') ->where('id',$id)->value('img');
        if(empty($img)){
            $res = $this->base64ToImgFile($image);
            if($res){
                db('agent')->where('id',$id)->update(['img'=>$res]);
            }
        }
       return $res;
        /* 直接显示在浏览器 */
        //header('Content-type: image/png;');
//        ImagePng($image);
//        imagedestroy($image);
    }


    /**
     * 将base64图片数据保存成图片
     * @param $image        base64字符串
     * @param string $path  保存路径
     * @return bool|string  保存成功返回路径否则返回flase
     */
    function base64ToImgFile($image,$path='/static/home/shouquan/'){
        $imageName = "b64_".date("His",time())."_".rand(1111,9999).'.jpg';
//        if (strstr($image,",")){
//            $image = explode(',',$image);
//            $image = $image[1];
//        }
        $path = $path.date("Ym",time());
        //var_dump($_SERVER['DOCUMENT_ROOT']);die;
        if (!is_dir($_SERVER['DOCUMENT_ROOT'].$path)){ //判断目录是否存在 不存在就创建
            mkdir($_SERVER['DOCUMENT_ROOT'].$path,0777,true);
        }
        $imageSrc=  $_SERVER['DOCUMENT_ROOT'].$path."/". $imageName;  //图片名字
        //$r = file_put_contents($imageSrc, base64_decode($image));//返回的是字节数
        $r = imagejpeg($image,$imageSrc);
        if (!$r) {
            return false;
        }else{
            //return true;
            return $path."/". $imageName;
        }
    }

    public function downimg(){
        $img = input('img');
        $url = $img;
        $file_name = $_SERVER['DOCUMENT_ROOT'].$img;

        $url = "http://yang.oioos.com".$img;
       // $a = $this->curl_file_get_contents($url);
       // file_put_contents($url, $a);
        //$this->download($url);
//        $url = "http://qlogo2.store.qq.com/qzone/393183837/393183837/50";
//        $curl = curl_init($url);
//        $filename = date("Ymdhis").".jpg";
//        curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
//        $imageData = curl_exec($curl);
//        curl_close($curl);
//        $tp = @fopen($filename, 'a');
//        fwrite($tp, $imageData);
//        fclose($tp);
        $filename=$url;
        $file  =  fopen($filename, "rb");
        $filesize = filesize(trim($file_name));
        $mime = 'application/force-download';
//        header('Pragma: public'); // required
        header('Expires: 0'); // no cache
        header('Content-Description: File Transfer');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Cache-Control: private',false);
        header("Accept-Length:$filesize");
//        Header( "Content-type:  image/jpeg");
//        Header( "Accept-Ranges:  bytes ");
//        Header( "Content-Disposition:  attachment;  filename= image.jpg");
        header('Content-Transfer-Encoding: binary');
        header('Pragma: cache');
        header('Cache-Control: public, must-revalidate, max-age=0');
        header('Connection: close');
//        $contents = "";
//        while (!feof($file)) {
//            $contents .= fread($file, 8192);
//        }
//        readfile($filename);
//        fclose($file);
        // return json(['type'=>1,'img'=>$url]);
        $contenttype = 'image/jpeg';
       // $dir_path = '../public/static/versionChannel/';
        //$fileName = $provider.'.png';
        //$fileurl = $dir_path.$fileName;
        header ("Content-type: octet/stream");
        header("Cache-control: private");
        header('Content-type: image/jpeg');
       // header("Content-type: $contenttype"); //设置要下载的文件类型
        header("Content-Length:" . $filesize); //设置要下载文件的文件大小
        header("Content-Disposition: attachment; filename=" . urldecode('image.jpg')); //设置要下载文件的文件名
        header('Content-Description: PHP3 Generated Data');
        ini_set('user_agent','Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 2.0.50727;http://www.baidu.com)');
        echo file_get_contents($filename);
       exit;
        readfile($filename);
    }
    function download($url, $path = '/')
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        $file = curl_exec($ch);
        curl_close($ch);
        $filename = pathinfo($url, PATHINFO_BASENAME);
        $resource = fopen($path . $filename, 'a');
        fwrite($resource, $file);
        fclose($resource);
}
    function curl_file_get_contents($durl){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $durl);
        curl_setopt($ch, CURLOPT_TIMEOUT, 2);
//        curl_setopt($ch, CURLOPT_USERAGENT, _USERAGENT_);
//        curl_setopt($ch, CURLOPT_REFERER,_REFERER_);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $r = curl_exec($ch);
        curl_close($ch);
        return $r;
    }
    public function getImage($url,$save_dir='',$filename='',$type=1){
        if(trim($url)==''){
            return array('file_name'=>'','save_path'=>'','error'=>1);
        }
        if(trim($save_dir)==''){
            $save_dir='./';
        }
        if(trim($filename)==''){//保存文件名
            $ext=strrchr($url,'.');
            if($ext!='.gif'&&$ext!='.jpg'){
                return array('file_name'=>'','save_path'=>'','error'=>3);
            }
            $filename=time().$ext;
        }
        if(0!==strrpos($save_dir,'/')){
            $save_dir.='/';
        }
        //创建保存目录
        if(!file_exists($save_dir)&&!mkdir($save_dir,0777,true)){
            return array('file_name'=>'','save_path'=>'','error'=>5);
        }
        //获取远程文件所采用的方法
        if($type){
            $ch=curl_init();
            $timeout=5;
            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
            curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
            $img=curl_exec($ch);
            curl_close($ch);
        }else{
            ob_start();
            readfile($url);
            $img=ob_get_contents();
            ob_end_clean();
        }
        //$size=strlen($img);
        //文件大小
        $fp2=@fopen($save_dir.$filename,'a');
        fwrite($fp2,$img);
        fclose($fp2);
        unset($img,$url);
        return array('file_name'=>$filename,'save_path'=>$save_dir.$filename,'error'=>0);
    }
}
