<?php
/**
 * Created by PhpStorm.
 * User: fbi
 * Date: 2018/12/3 0003
 * Time: 9:50
 */

namespace app\index\controller;

use mikkle\tp_wechat\src\Custom;
use mikkle\tp_wechat\src\Extend;
use mikkle\tp_wechat\src\Menu;
use mikkle\tp_wechat\src\Message;
use mikkle\tp_wechat\src\Receive;
use think\Cache;
use think\Debug;


	define("TOKEN","yueyue"); //TOKEN值
	define("AppSecret",'02ef5d36315369789c164a051b7a3cef');
	define("AppID",'wx98f8e2fff7e4fa45');
	//验证开发环境
//	$wechatObj = new Wechat();
//	$wechatObj->valid();
//	class Wechat {
//	    public function valid() {
//	        $echoStr = $_GET["echostr"];
//	        if($this->checkSignature()){
//	            echo $echoStr;
//	            exit;
//	        }
//	    }
//
//	    private function checkSignature() {
//	        $signature= $_GET["signature"];
//	        $timestamp= $_GET["timestamp"];
//	        $nonce= $_GET["nonce"];
//	        $token= TOKEN;
//	        $tmpArr= array($token,$timestamp, $nonce);
//	        sort($tmpArr);
//	        $tmpStr= implode( $tmpArr );
//	        $tmpStr= sha1( $tmpStr );
//	        if($tmpStr == $signature) {
//	            return true;
//	        } else {
//	            return false;
//	        }
//	    }
//	}

	//获得access_token
	class Wechat extends Base{
        public $appId = 'wx98f8e2fff7e4fa45';
        public $appSecret = '02ef5d36315369789c164a051b7a3cef';

//		public function __construct($options = [])
//		{
//            parent::__construct($option = []);
//			$this->appId = 'wx98f8e2fff7e4fa45';
//			$this->appSecret = '02ef5d36315369789c164a051b7a3cef';
//
//		}
		//验证
		public function valid() {
	        $echoStr = $_GET["echostr"];
	        if($this->checkSignature()){
	            echo $echoStr;
	            exit;
	        }
	    }

	    private function checkSignature() {
	        $signature= $_GET["signature"];
	        $timestamp= $_GET["timestamp"];
	        $nonce= $_GET["nonce"];
	        $token= TOKEN;
	        $tmpArr= array($token,$timestamp, $nonce);
	        sort($tmpArr);
	        $tmpStr= implode( $tmpArr );
	        $tmpStr= sha1( $tmpStr );
	        if($tmpStr == $signature) {
	            return true;
	        } else {
	            return false;
	        }
	    }
		public function index(){
			$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".AppID."&secret=".AppSecret;
			$result = file_get_contents($url);
            $wechatObj = new Wechat();
			$wechatObj->valid();
			$receive = new Receive(['appid'=>'wx3ee104f17f6c8633','appsecret'=>'364fe50d0622f85e36b76923cb379ef8']);
			$type = $receive->getRevType();

			return $receive->reply(['你好'],true);
			return $this->responseMsg();



		}
    	public function responseMsg() {
  	        //---------- 接 收 数 据 ---------- //
           $postStr= file_get_contents('php://input');//获取POST数据
			if(!empty($postStr)){
                $postObj= simplexml_load_string($postStr,'SimpleXMLElement',LIBXML_NOCDATA);
                $fromUsername= $postObj->FromUserName;//获取发送方帐号（OpenID）
				 //db('openid')->insert(['openid'=>$fromUsername]);
                $toUsername= $postObj->ToUserName;//获取接收方账号
                $keyword= trim($postObj->Content);//获取消息内容
                $EventKey = trim((string)$postObj->EventKey);
                $keyArray = explode("_", $EventKey);

                $time= time(); //获取当前时间戳
                //---------- 返 回 数 据 ---------- //
                //返回消息模板
                $textTpl= '<xml><ToUserName><![CDATA[%s]]></ToUserName><FromUserName><![CDATA[%s]]></FromUserName><CreateTime>%s</CreateTime><MsgType><![CDATA[%s]]></MsgType><Content><![CDATA[%s]]></Content><FuncFlag>0</FuncFlag></xml>';
                $msgType= "text";//消息类型
                if(!empty($EventKey)){
                    $src = $postObj->Ticket;
//                    $receive = new Receive(['appid'=>'wx3ee104f17f6c8633','appsecret'=>'364fe50d0622f85e36b76923cb379ef8']);
//                    $receive->news(['title'=>'测试二维码','description'=>'二维码描述','url'=>'https://www.baidu.com','picurl'=>$src])->r
                    $picTpl = "<xml>
                                   <ToUserName><![CDATA[%s]]></ToUserName>
                                   <FromUserName><![CDATA[%s]]></FromUserName>
                                   <CreateTime>%s</CreateTime>
                                   <MsgType><![CDATA[%s]]></MsgType>
                                   <ArticleCount>1</ArticleCount>
                                   <Articles>
                                   <item>
                                   <Title><![CDATA[%s]]></Title>
                                   <Description><![CDATA[%s]]></Description>
                                   <PicUrl><![CDATA[%s]]></PicUrl>
                                   <Url><![CDATA[%s]]></Url>
                                   </item>
                                   </Articles>
                                   <FuncFlag>1</FuncFlag>
                                   </xml> ";
                    $msgType = "news";
                    $title = "标题"; //标题
                    $data  = date('Y-m-d'); //时间
                    $desription = "简介"; //简介
                    $image = 'http://yang.oioos.com/server/'.db('member')->where(['mobile'=>18257990958])->value('avatar'); //图片地址
                    $turl = "http://yang.oioos.com"; //链接地址
                    $resultStr = sprintf($picTpl, $fromUsername, $toUsername, $time, $msgType, $title,$desription,$image,$turl);
                    return $resultStr;

                }else{

                    $contentStr= $keyword; //返回消息内容
                }

                //格式化消息模板
                $resultStr= sprintf($textTpl,$fromUsername,$toUsername,
                    $time,$msgType,$contentStr);
                return $resultStr; //输出结果
			}
    	        //用SimpleXML解析POST过来的XML数据

        }
        //增加/删除客服
        public function addKFAccount(){
			$addKFAccount = new Custom(['appid'=>'wx39eef0e1655086aa','appsecret'=>'7ba300bf667b52a21d32076f78fc665f']);
			$res = $addKFAccount->addKFAccount('zcy@gh_c76526093dab','客服1','123123');
			$res = $addKFAccount->deleteKFAccount('zcy@gh_c76526093dab');
			$res = $addKFAccount->getCustomServiceKFlist();
			var_dump($res);
		}
		//群发消息
		public function sendGroupMassMessage(){
        	$sendGroupMassMessage = new Message(['appid'=>'wx3ee104f17f6c8633','appsecret'=>'364fe50d0622f85e36b76923cb379ef8']);
        	$str = '{
						"filter":{
						"is_to_all":true
						},
						"text":{
						"content":"群发消息"
						},
						"msgtype":"text"
					}';

        	var_dump($sendGroupMassMessage->sendGroupMassMessage($data));
		}
		//发送模板消息
		public function sendTemplateMessage($appid,$appsecret,$touser,$template_id,$url,$data){
			$sendTemplateMessage = new Message(['appid'=>$appid,'appsecret'=>$appsecret]);
			//$data = $sendTemplateMessage->getAllPrivateTemplate();
            $data = urldecode($data);

			$srt = '{
           "touser":"'.$touser.'",
            "template_id":"'.$template_id.'",
            "url":"'.$url.'",
            "data":';
			$srt .=$data;
			$srt.='}';
			$data = json_decode($srt,true);
            //echo $errorinfo = json_last_error();   //输出4 语法错误
			return $sendTemplateMessage ->sendTemplateMessage($data);
		}
        public function getAccessToken() {
            // access_token 应该全局存储与更新，以下代码以写入到文件中做示例
            ////**************use think\Cache;
            $access_token = Cache::get('access_token');
            if (empty($access_token)) {
                // 如果是企业号用以下URL获取access_token
                // $url = "https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid=$this->appId&corpsecret=$this->appSecret";
                $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$this->appId&secret=$this->appSecret";
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
        public function createMenu(){
			$createMenu = new Menu(['appid'=>'wx3ee104f17f6c8633','appsecret'=>'364fe50d0622f85e36b76923cb379ef8']);
           // $createMenu = new Menu(['appid'=>'wx98f8e2fff7e4fa45','appsecret'=>'02ef5d36315369789c164a051b7a3cef']);
			$str = '{
						 "button":
						 [
							 {    
								  "type":"click",
								  "name":"今日歌曲",
								  "key":"V1001_TODAY_MUSIC"
							  },
							  {
								   "name":"菜单",
								   "sub_button":[
								   {    
									   "type":"view",
									   "name":"搜索",
									   "url":"http://www.soso.com/"
									},
									{
									   "type":"view",
									   "name":"艾尼",
									   "url":"http://a.oioos.com:8081/"
									}]
							 }
						 ]
						
					 }';
			$data = json_decode($str,true);
			$createMenu ->createMenu($data);
			//$createMenu->deleteMenu();

		}
		public function getWebAccessToken($appid,$appsecret,$code){
			$jsondata=file_get_contents("https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$appid."&secret=".$appsecret."&code=".$code."&grant_type=authorization_code");
			$web_access_token=json_decode($jsondata,true);
			return $web_access_token;
		}
		public function getCode($appid,$redirect_uri,$wx){
			header("Location: https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$appid."&redirect_uri=".$redirect_uri."&response_type=code&scope=snsapi_userinfo&state=$wx#wechat_redirect ");
			exit();
		}
        public function getCode1($appid,$redirect_uri){
            header("Location: https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$appid."&redirect_uri=".$redirect_uri."&response_type=code&scope=snsapi_base&state=1#wechat_redirect ");
            exit();
        }
		public function getWebAccessToken1()
        {
            if (empty($_GET['code'])) {
                $appid = 'wx3ee104f17f6c8633';
                $redirect_uri = 'http' . '://' . $_SERVER['HTTP_HOST'] . url('/index/Wechat/getWebAccessToken1');
                $wx = 'code';
                $this->getCode($appid, $redirect_uri, $wx);
                exit();
            } else {
                $code = $_GET['code'];
                $appid = 'wx3ee104f17f6c8633';
                $appsecret = '364fe50d0622f85e36b76923cb379ef8';
                $web_access_token = $this->getWebAccessToken($appid, $appsecret, $code);
                var_dump($web_access_token);
            }
        }

        public function getUserInfo($accesstoken,$openid,$type){
            if($type==1){
                $user_info_join=file_get_contents("https://api.weixin.qq.com/sns/userinfo?access_token=".$accesstoken."&openid=".$openid."&lang=zh_CN");
            }else{
                $user_info_join=file_get_contents("https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$accesstoken."&openid=".$openid."&lang=zh_CN");
            }
            $user_info=json_decode($user_info_join,true);
            return $user_info;
        }

        public function getuserinfo1(){

                if (empty($_GET['code'])) {
                    $appid = 'wx3ee104f17f6c8633';
                    $redirect_uri = 'http' . '://' . $_SERVER['HTTP_HOST'] . url('/index/Wechat/getuserinfo1');
                    $wx = 'code';
                    $this->getCode($appid, $redirect_uri, $wx);
                    exit();
                } else {
                    $code = $_GET['code'];
                    $appid = 'wx3ee104f17f6c8633';
                    $appsecret = '364fe50d0622f85e36b76923cb379ef8';
                    $res = $this->getWebAccessToken($appid, $appsecret, $code);
                    $openid = $res['openid'];
                    $web_access_token = $res['access_token'];
                }

			$userinfo = $this->getUserInfo($web_access_token,$openid,1);
            var_dump( $userinfo);

		}

		public function getuserinfo2()
        {
            $appid = 'wx98f8e2fff7e4fa45';
            $appsecret = '02ef5d36315369789c164a051b7a3cef';
            $appid = 'wx3ee104f17f6c8633';
            $appsecret = '364fe50d0622f85e36b76923cb379ef8';
            if (empty($_GET['code'])) {
//                $appid = 'wx3ee104f17f6c8633';
                $redirect_uri = 'http' . '://' . $_SERVER['HTTP_HOST'] . url('/index/Wechat/getuserinfo2');
                $wx = 'code';
                $this->getCode($appid, $redirect_uri, $wx);
                exit();
            } else {
                $code = $_GET['code'];
                //$appid = 'wx3ee104f17f6c8633';
                //$appsecret = '364fe50d0622f85e36b76923cb379ef8';
                $res = $this->getWebAccessToken($appid, $appsecret, $code);
                $openid = $res['openid'];
            }
            //$appid = 'wx3ee104f17f6c8633';
            //$appsecret = '364fe50d0622f85e36b76923cb379ef8';
            $access_token = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=" . $appid . "&secret=" . $appsecret;
            $access_msg = json_decode(file_get_contents($access_token));
            $token = $access_msg->access_token;
            $subscribe_msg = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=$token&openid=" . $openid;
            $subscribe = json_decode(file_get_contents($subscribe_msg),true);
            var_dump($subscribe);
            //


        }
		public function getQRUrl(){
			$getQRUrl = new Extend(['appid'=>'wx3ee104f17f6c8633','appsecret'=>'364fe50d0622f85e36b76923cb379ef8']);
			$ticket = $getQRUrl->getQRCode(123123);
			$ticket = urlencode(json_decode($ticket,true)['ticket']);
			$url = $getQRUrl->getQRUrl($ticket);
			$this->assign('src',$url);
            return $this->fetch();
		}

        public function createCondMenu(){
            $createMenu = new Menu(['appid'=>'wx3ee104f17f6c8633','appsecret'=>'364fe50d0622f85e36b76923cb379ef8']);
            // $createMenu = new Menu(['appid'=>'wx98f8e2fff7e4fa45','appsecret'=>'02ef5d36315369789c164a051b7a3cef']);
            $str = '{
						 "button":
						 [
							 {    
								  "type":"click",
								  "name":"今日歌曲",
								  "key":"V1001_TODAY_MUSIC"
							  },
							  {
								   "name":"菜单",
								   "sub_button":[
								   {    
									   "type":"view",
									   "name":"搜索",
									   "url":"http://www.soso.com/"
									},
									{
									   "type":"click",
									   "name":"赞一下我们",
									   "key":"V1001_GOOD"
									}]
							 }
						 ],
						 "matchrule":{
						  "tag_id":"",
						  "sex":"1",
						  "country":"",
						  "province":"",
						  "city":"",
						  "client_platform_type":"1",
						  "language":"zh_CN"
						  }
					 }';
            $data = json_decode($str,true);
            var_dump($createMenu ->createCondMenu($data));

        }
        public function getUserList(){
        	$user = new \mikkle\tp_wechat\src\User(['appid'=>'wx3ee104f17f6c8633','appsecret'=>'364fe50d0622f85e36b76923cb379ef8']);
        	return json($user->getUserList());
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

        /*
 * Appid在开放平台创建应用后获取的
 * redirect_uri是用户在微信端扫码确认登录之后的回调地址
 */
        public function wxLogin(){
            $appid = 'wx7f6ac7bccdd29c6a';
            $redirect_uri = urlencode( 'http' . '://' . $_SERVER['HTTP_HOST'] . url('/index/Wechat/weixin'));
            $scope = "snsapi_login";
            $state = "wxLogin";
            $url = "https://open.weixin.qq.com/connect/qrconnect?appid=".$appid."&redirect_uri=".$redirect_uri."&response_type=code&scope=".$scope."&state=".$state."#wechat_redirect";

            return redirect($url);
        }
        public function weixin(){
            $appid="RSTu6xWT5A9xEPq9Wkbwm4";     //在开放平台创建应用后获取的
            $appkey="eRJgWV0Glk7d8SrFLoKqJ4";  //应用签名
            $code=$_GET['code'];//触发微信登录请求接口后返回的code参数
            $url='https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$appkey.'&code='.$code.'&grant_type=authorization_code';

            $data=file_get_contents($url);
            $data=json_decode($data);

            $access_token=$data->access_token;
            $openid=$data->openid;


            $url1='https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token.'&openid='.$openid;
            $call=file_get_contents($url1);
            $call=json_decode($call);
            //openid存在，直接登录，openid不存在，先注册再登录
          	var_dump($call);die;


            return redirect('/user/index');
        }

        public function paytemplate(){
            $data = ['first'   =>['value'=>"恭喜你购买成功!",'color'=>'#173177'],'keyword1'=>['value'=>'余额充值','color'=>'#173177'],'keyword2'=>['value'=>'0.01元','color'=>'#173177'],'keyword3'=>['value'=>'微信充值','color'=>'#173177'],'keyword4'=>['value'=>'2019年','color'=>'#173177'],'remark'  =>['value'=>'再次购买','color'=>'#173177']];

            $data = urlencode(json_encode($data));
//            $data = '{
//                "first": {
//                    "value":"恭喜你购买成功！",
//                       "color":"#173177"
//                   },
//                   "keyword1":{
//                    "value":"余额充值",
//                       "color":"#173177"
//                   },
//                   "keyword2": {
//                    "value":"0.01元",
//                       "color":"#173177"
//                   },
//                   "keyword3": {
//                    "value":"微信充值",
//                       "color":"#173177"
//                   },
//                   "keyword4": {
//                    "value":"'.date("Y年m月d日 h时i分s秒",time()).'",
//                       "color":"#173177"
//                   },
//                   "remark":{
//                    "value":"欢迎再次购买！",
//                       "color":"#173177"
//                   }
//           }';
            $res = $this->sendTemplateMessage('wx39eef0e1655086aa','7ba300bf667b52a21d32076f78fc665f','otsEpwJ0_RmPkz_sk7BgAmKCOKu4','8hrUrqieJnMAm11xZUtYYgdEwDHk1OnHYux5JATsA4c','http://yang.oioos.com/index/user/walletrecord',$data);
            var_dump($res);
        }



	}

	?>
