<?php
namespace app\index\controller;
use think\Controller;
use think\Cookie;
use think\Session;
use think\Url;
use think\Config;
use think\Page;
use think\Verify;
use think\Image;
use think\Db;
use think\Request;
use mywechat;
use alidayu;
class Login  extends Base {
    public function index()
    {
        echo '你好百草羊！！！';
        return $this->fetch();
    }
    public function login()
    {
        //用户退出
        if(!empty(input('exit'))){
            Session::delete('user');
            Cookie::delete('mobile');
            Cookie::delete('password');
            if(!empty(input('ios'))){
                return ['msg'=>'退出成功~'];
            }
        }
        $paystr = fangwenleixing();
        $wx = input('state');
        $autologin = input('autologin');
        $isapp = fangwenleixing();
        //推广ID
        $agentid = input('agentid');
        if(empty($agentid)){
            if(!empty($_COOKIE['mycode'])){
                $agentid = $_COOKIE['mycode'];
            }else{
                $agentid = 0;
            }
        }

        //dump($agentid);die;
        //用户提交登录
        if(Request::instance()->isPost()){
	        //  wechat login 4 app
	        $appdata = input('post.');
	        if($isapp == 'app' && $wx == 'app'){
				$cid = session('cid');
		        $status = Db::name('member')->where("unionid='".$appdata['unionid']."' and status = 0")->find();
		        if($status){
			        Session::set('user',array("user_id"=>$status['id'],'openid'=>$appdata['openid'],'unionid'=>$appdata['unionid']));
			        if($autologin){
			            $password = md5('yyy').$status['password'].'yyy';
                        setcookie('mobile', $status['mobile'], time()+3600*24*7,'/');
                        setcookie('password', $password, time()+3600*24*7,'/');
                    }
                    return json(['code'=>2]);
		        }else{
		        	$data = ['openid' =>$appdata['openid'],
		        			'unionid' =>$appdata['unionid'],
                            'sex' =>$appdata['sex'],
                            'username' =>$appdata['nickname'],
                            'avatar' =>$appdata['headimgurl'],
                            'reg_time' => time(),
                            'client' => 'app',
                            'oauth' => 'wechatapp',
                            'agentid' =>$agentid,
                            'appcid' => $cid['appcid'],
                            'apptoken' => $cid['apptoken']
                            ];
                            $useradd = db('member')->insert($data);
					if($useradd){
						$status=Db::name('member')->where("unionid='".$data['unionid']."'")->find(); 
						Session::set('user',array("user_id"=>$status['id'],'openid'=>$data['openid'],'unionid'=>$appdata['unionid']));
                        if($autologin == 1){
                            $password = md5('yyy').$status['password'].'yyy';
                            setcookie('mobile', $status['mobile'], time()+3600*24*7,'/');
                            setcookie('password', $password, time()+3600*24*7,'/');
                        }
						$this->setRecommend($status['id']);
						return json(['code'=>1]);
					}else{
						return json(['code'=>0]);
					}
		        }
	        }
//            if(!empty($_COOKIE['app_token'])){
//                $userarr = db('member') -> where('unionid',$_COOKIE['app_token'])->find();
//                if(!empty($userarr)){
//                    Session::set('user', array("user_id" => $userarr['id'], 'openid' => $userarr['openid'], 'unionid' => $userarr['unionid']));
//                }
//            }else{
//                $appid = 'wx7f6ac7bccdd29c6a';
//                $appsecret = '384d56fdf965e15fde7ffbc5f939c162';
//                $wxchat_token = new mywechat\wechat();
//                $access_token = $wxchat_token->getWebAccessToken1($appid, $appsecret, $code);
//                return json( array('app_token'=>$access_token['unionid']));
//                if (empty($access_token['openid'])) {
//                    $this->success("Openid获取失败！", url("/index/login/getuserinfo"));
//                }
//                //$accesstoken = mywechat\wechat::getAccessToken($appid, $appsecret);
//                //$user_info = mywechat\wechat::getUserInfo($accesstoken, $access_token['openid'], 2);
//            }
			// wechat login 4 app end
	        
                //账户登录
                $mobile     = input('post.mobile');
                $password   = input('post.password');
                $autologin   = input('post.autologin');
                if(empty($mobile)){
                    return json(array('type'=>0,'msg'=>'手机号不能为空！'));
                }
                if(empty($password)){
                    return json(array('type'=>0,'msg'=>'密码不能为空！'));
                }
                $password = md5($password);
                $status=Db::name('member')->where("mobile='$mobile'")->find(); 
                if($status['password']==$password){
                    $openid = $status['openid'];

                        Session::set('user',array("user_id"=>$status['id']));
                    if($autologin == 1){
                        $password = md5('yyy').$status['password'].'yyy';
                        setcookie('mobile', $status['mobile'], time()+3600*24*7,'/');
                        setcookie('password', $password, time()+3600*24*7,'/');
                    }
                    if(empty($openid)){
                        return json(array('type'=>2,'msg'=>'登录成功,请先绑定微信!','user_id'=>$status['id']));
                    }
                        Session::set('user_openid',$status['openid']);
                        return json(array('type'=>1,'msg'=>'登录成功！','user_id'=>$status['id']));
                }else{
                        return json(array('type'=>0,'msg'=>'登录失败,账户或者密码错！'));
                }
            
        }else if(!empty ($wx) && ($wx=='wx' or $wx=='wxbd')){
	        //	wechat bind  4 APP
			if(Session::has('user') && $wx=='wxbd' && $isapp == 'app'){
		        if(!empty($this->member['unionid'])){
                                    $this->success("微信已绑定，无须重复绑定！",url("/index/user/user"));
                                }else{
                                    $isunionid = db('member')->where('unionid',$appdata['unionid'])->find();
                                    if($isunionid){
                                        $this->success("该微信已注册账号，不能绑定",url("/index/user/user"));
                                    }else{
                                        $ismember = db('member')->where('id', Session::get('user')['user_id'])->update(array('openid'=>$web_access_token['openid'],'unionid'=>$appdata['unionid']));
                                        if($ismember){
                                            $this->success("绑定成功！",url("/index/user/user"),[],1);
                                        }else{
                                            $this->success("绑定失败！",url("/index/user/user"),[],1);
                                        }
                                    }
                                }
                                die();
	        }
	        //	wechat bind  4 APP end
	        
            if(empty($_GET['code'])){
                    $appid = $this->wc['appid'];
                    $redirect_uri='http'.'://'.$_SERVER['HTTP_HOST']. url('/index/login/login');
                    mywechat\wechat::getCode($appid,$redirect_uri,$wx);
                    exit();
                } else {
                    $code = $_GET['code'];
                    $appid = $this->wc['appid'];
                    $appsecret = $this->wc['appsecret'];
                    $web_access_token = mywechat\wechat::getWebAccessToken($appid,$appsecret,$code);
                    if(Session::has('user') && $wx=='wxbd'){
                                if(!empty($this->member['openid'])){
                                    $this->success("微信已绑定，无须重复绑定！",url("/index/user/user"));
                                }else{
                                    $isopenid = db('member')->where('openid',$web_access_token['openid'])->find();
                                    if($isopenid){
                                        $this->success("该微信已注册账号，不能绑定",url("/index/user/user"));
                                    }else{
                                         $accesstoken = mywechat\wechat::getAccessToken($appid,$appsecret);
	                                    $user_info = mywechat\wechat::getUserInfo($accesstoken,$web_access_token['openid'],2);
                                            $user_info['unionid']=!empty($user_info['unionid'])?$user_info['unionid']:'';
                                        $ismember = db('member')->where('id', Session::get('user')['user_id'])->update(array('openid'=>$web_access_token['openid'],'unionid'=>$user_info['unionid']));
                                        if($ismember){
                                            $this->success("绑定成功！",url("/index/user/user"),[],1);
                                        }else{
                                            $this->success("绑定失败！",url("/index/user/user"),[],1);
                                        }
                                    }
                                }
                                die();
                    }
                    //查询这个openid是否已经注册，如果没有注册就获取信息
                        if(empty($web_access_token['openid'])){
                            $this->success("Openid获取失败！",url("/index/login/login"));
                        }
                    $status=Db::name('member')->where("openid='".$web_access_token['openid']."'")->find(); 
                    if(empty($status)){
                        if(!empty($web_access_token['openid'])){
                            $type = 1 ;//获取普通信息，2获取包括的信息
                            $openid = $web_access_token['openid'];
                            if($type==1){
                                $webaccesstoken = $web_access_token['access_token'];
                                $user_info = mywechat\wechat::getUserInfo($webaccesstoken,$openid,$type);
                            }else {
                                $accesstoken = mywechat\wechat::getAccessToken($appid,$appsecret);
                                $user_info = mywechat\wechat::getUserInfo($accesstoken,$openid,$type);
                            }
                            //第二次通过unionid查询
                             if(!empty($user_info['unionid'])){
                                $status=Db::name('member')->where("unionid='".$user_info['unionid']."'")->find(); 
                             }
                            
                             if(empty($status)){
                                $data = array(
                                        'openid' =>!empty($user_info['openid'])?$user_info['openid']:'',
                                        'sex' =>!empty($user_info['sex'])?$user_info['sex']:0,
                                        'username' =>!empty($user_info['nickname'])?$user_info['nickname']:'',
                                        'avatar' =>!empty($user_info['headimgurl'])?$user_info['headimgurl']:'',
                                        'reg_time' => time(),
                                        'client' => 'wechat',
                                        'agentid' =>$agentid
                                    );
                                    if(!empty($user_info['unionid'])){
                                        $data['unionid'] = $user_info['unionid'];
                                    }
                                    $useradd = db('member')->insert($data);

                                if($useradd){
                                    $status=Db::name('member')->where("openid='".$data['openid']."'")->find(); 
                                    Session::set('user',array("user_id"=>$status['id'],'openid'=>$data['openid']));
                                    if(!empty($_REQUEST['autologin']) && $_REQUEST['autologin'] == 1){
                                        $password = md5('yyy').$status['password'].'yyy';
                                        setcookie('mobile', $status['mobile'], time()+3600*24*7,'/');
                                        setcookie('password', $password, time()+3600*24*7,'/');
                                    }
                                    $this->setRecommend($status['id']);
                                    $this->success("注册成功！",url("/index/user/cgphone"));
                                }else{
                                    $this->success("注册失败！",url("/index/login/login"));
                                }
                             } else {
                                Session::set('user',array("user_id"=>$status['id'],'openid'=>$web_access_token['openid'],'unionid'=>$user_info['unionid']));
                                if(empty($status['mobile'])){
	                                $this->redirect(url("/index/user/dengluhoubangding"));
                                }
                                $this->redirect(url("/index/index/index"));
                             }
                        }
                    }else{
                        Session::set('user',array("user_id"=>$status['id'],'openid'=>$web_access_token['openid']));
//                        if($_REQUEST['autologin'] == 1){
//                            $password = md5('yyy').$status['password'].'yyy';
//                            setcookie('mobile', $status['mobile'], time()+3600*24*7,'/');
//                            setcookie('password', $password, time()+3600*24*7,'/');
//                        }
                        if(empty($status['mobile'])){
	                                $this->redirect(url("/index/user/dengluhoubangding"));
                                }
                        $this->redirect(url("/index/index/index"));
                    }
                }
        }else{
            //已经登录了的用户自己进入个人中心
            if(Session::has('user')){
                header("Location: ".url('/index/user/user'));
                exit();
            }
            //进入登录页面
            $this->assign('paystr',$paystr);
            $this->assign('webtitle', '登录');
            return $this->fetch();
        }
    }
    public function getsms(){
        if(Request::instance()->isPost()){
            $smsset=Db::name('sms_set')->find();
            $phone = input('post.phone');
            $code = rand(10000,99999);
            Session::set('code_'.$phone,$code);
            if($smsset['status']==1){//开启了短信接口
                $sms = new \alidayu\SmsApi($smsset['access_key_id'], $smsset['access_key_secret']);
                $response = $sms->sendSms(
                    $smsset['sms_autograph'], // 短信签名
                    $smsset['sms_templet'], // 短信模板编号
                    "$phone", // 短信接收者
                    Array (  // 短信模板中字段的值
                        "code"=>"$code"
                    ),
                    "123"   // 流水号,选填
                );
                if($response['Code']=='OK'){
                    return array('type'=>1,'data'=>'验证码发送成功！');
                }else{
                    return array('type'=>2,'data'=>'发送失败，错误代码：'.$response['Code']);
                }
            }else{//未开启短信接口
                return array('type'=>3,'data'=>'您的验证码是：'.$code);
            }
        }else{
            return array('type'=>0,'data'=>'请求失败！');
        }
        
    }
    function findNum($str=''){
        $str=trim($str);
        if(empty($str)){return '';}
        $result='';
        for($i=0;$i<strlen($str);$i++){
            if(is_numeric($str[$i])){
                $result.=$str[$i];
            }
        }
        return $result;
    }
    public function reg()
    {
        //用户提交注册
        if(Request::instance()->isPost()){
            $mobile = input('post.mobile');
            $password=input('post.password');
            $password2=input('post.password2');
            $code=input('post.code');
            $mycode=input('post.mycode');
            $data = input('post.');
            if(!empty($mycode)) {
                if (substr($mycode, 0,3) == '食') {
                    $data['pasture'] = $this->findNum($mycode);
                    $agentid = 0;
                } else {
                    $agentid = codeToAgentid($mycode);
                    $isagent = db('member')->where(array('id' => $agentid))->find();
                    if (empty($isagent)) {
                        return array('type' => 0, 'msg' => '您输入的邀请码有误！');
                    } else {
                        $agentid = input('agentid');
                    }
                }
            }

            if($code!= Session::get('code_'.$mobile)){
                return array('type'=>0,'msg'=>'验证码有误！');
            }
            if($password!=$password2){
                return array('type'=>0,'msg'=>'两次密码不同！');
            }else{
                $isuser=Db::name('member')->where("mobile=$mobile")->find();
                if(empty($isuser)){
                    $data['password'] = md5($data['password']);
                    $data['reg_time'] = time();
                    $data['agentid'] = $agentid;
                    $data['avatar'] = 'upload/avatar/'.rand(0,100).'.jpg';
                    if(fangwenleixing() == 'app'){
	                    $cid = session('cid');
	                    $data['appcid'] = $cid['appcid'];
	                    $data['apptoken'] = $cid['apptoken'];
                    }
                    db('member')->insert($data);
                    $userId = Db::name('member')->getLastInsID();
                    $this->setRecommend($userId );
                    return array('type'=>1,'msg'=>'注册成功！');
                } else {
                    return array('type'=>0,'msg'=>'手机号重复注册失败！');
                }
            }
        }else{
            //已经登录了的用户自己进入个人中心
//            if(Session::has('user')){
//                header("Location: ".url('/index/user/user'));
//                exit();
//            }
            //进入注册页面
            if(!empty(input('pasture'))){
                $pasture = input('pasture');
                $pasturecode = '食花百草羊'.$pasture.'号牧场';
                $this->assign('pasturecode',$pasturecode);
                $this->assign('pasture',$pasture);
            }else{
                $pasture = '';
            }
            if(!empty(input('agentid'))){
                $agentid = input('agentid');
                if(!empty($agentid)){
                    $mycode = icode($agentid);
                    setcookie('mycode',$agentid,0,'/');
                    $this->assign('mycode', $mycode);
                }

            }

            //判断是否关注公众号
            if(fangwenleixing() == 'wechat'){
                if(empty($_GET['code'])){
                    $appid = $this->wc['appid'];
                    $redirect_uri='http'.'://'.$_SERVER['HTTP_HOST']. url('/index/login/reg')."?pasture=".$pasture;
                    $wxchat = new mywechat\wechat();
                    $wxchat -> getCode1($appid,$redirect_uri,$wx='wx');
                    exit();
                } else {
                    $code = $_GET['code'];
                    $appid = $this->wc['appid'];
                    $appsecret = $this->wc['appsecret'];
                    $wxchat_token = new mywechat\wechat();
                    $access_token = $wxchat_token -> getWebAccessToken1($appid,$appsecret,$code);
                    if(empty($access_token['openid'])){
                        $_GET['code'] = '';
                        $this->success("Openid获取失败！",url("/index/login/reg"));
                    }
                    $accesstoken = mywechat\wechat::getAccessToken($appid,$appsecret);
                    $user_info = mywechat\wechat::getUserInfo($accesstoken,$access_token['openid'],2);


                }
            }


            //进入注册页面
//            $agentid = input('agentid');
//            if(!empty($agentid)){
//                $mycode = icode($agentid);
//                $this->assign('mycode', $mycode);
//            }
            $this->assign('webtitle', '注册');
            return $this->fetch();
        }
    }

    public function wx_subscript(){
        $wx = Db::name('wx_set')->value('qrcord');
        $this->assign('qrcord',$wx);
        return $this->fetch();
    }
    public function cid (){
    	$cid = input('appcid');
    	$token = input('apptoken');
    	Cookie::set('cid',['appcid'=>$cid, 'apptoken'=>$token]);
    	return json(['appcid'=>cookie('cid')['appcid'],'apptoken'=>cookie('cid')['apptoken']]);
    }

    public function getuserinfo()
    {

        if (empty($_REQUEST['code'])) {
            $appid = $this->wc['appid'];
            $redirect_uri = 'http' . '://' . $_SERVER['HTTP_HOST'] . url('/index/login/getuserinfo');
            $wxchat = new mywechat\wechat();
            $wxchat->getCode1($appid, $redirect_uri, $wx = 'wx');
            exit();
        } else {

            $code = $_REQUEST['code'];
            $data = array('code' => $code);
            db('code')->insert($data);
            //return json(array('app_token'=>'111aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa'));
            $appid = 'wx7f6ac7bccdd29c6a';
            $appsecret = '384d56fdf965e15fde7ffbc5f939c162';
            $wxchat_token = new mywechat\wechat();
            $access_token = $wxchat_token->getWebAccessToken1($appid, $appsecret, $code);
            $appdata = mywechat\wechat::getUserInfo($access_token['access_token'], $access_token['openid'], 1);
            $unionid = db('member')->where('unionid', $appdata['unionid'])->find();
            if (!empty($unionid)) {
                return json(array('app_token' => $access_token['unionid']));
            } else {
                $agentid = input('agentid');
                $data = ['openid' => $appdata['openid'],
                    'unionid' => $appdata['unionid'],
                    'sex' => $appdata['sex'],
                    'username' => $appdata['nickname'],
                    'avatar' => $appdata['headimgurl'],
                    'reg_time' => time(),
                    'client' => 'app',
                    'oauth' => 'wechatapp',
                    'agentid'=>$agentid
                ];
                $useradd = db('member')->insert($data);
                if ($useradd) {
                    $status = Db::name('member')->where("unionid='" . $data['unionid'] . "'")->find();
                    Session::set('user', array("user_id" => $status['id'], 'openid' => $data['openid'], 'unionid' => $appdata['unionid']));
                    $this->setRecommend($status['id']);
                    return json(array('app_token' => $status['unionid']));
                }else{
                   return false;
                }
            }
        }
    }

    public function getwxopenid()
    {

        if (empty($_REQUEST['code'])) {
            $appid = 'wxed5e81eb334526fa';
            $redirect_uri = 'http' . '://' . $_SERVER['HTTP_HOST'] . url('/index/login/getwxopenid');
            $wxchat = new mywechat\wechat();
            $wxchat->getCode1($appid, $redirect_uri, $wx = 'wx');
            exit();
        } else {
            $code = $_REQUEST['code'];
            $appid = 'wxed5e81eb334526fa';
            $appsecret = '7bbe363458cfbc8bb2220642a3366be4';
            $wxchat_token = new mywechat\wechat();
            $access_token = $wxchat_token->getWebAccessToken1($appid, $appsecret, $code);
            $appdata = mywechat\wechat::getUserInfo($access_token['access_token'], $access_token['openid'], 1);
            $openid = $appdata['openid'];
        }
    }

    public function setpwd(){
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
            $is = db('member') ->where('mobile',$mobile)->find();
            if(!$is){
                return array('type'=>0,'msg'=>'手机号有误，或未注册');
            }
            if(!empty($password)){
                $data = array('password'=> md5($password));
            }else{
                return array('type'=>0,'msg'=>'登陆密码不能为空');
            }
            $res = db('member')->where(array('mobile'=>$mobile))->update($data);
            if($res){
                return array('type'=>1,'msg'=>'设置成功');
            }else{
                return array('type'=>0,'msg'=>'设置失败，登陆密码不能与原先一样');
            }

        }else{
            return $this->fetch();
        }

    }

}
