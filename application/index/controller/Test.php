<?php
namespace app\index\controller;


use think\Session;
use Hooklife\ThinkphpWechat\Wechat;
use EasyWeChat\Foundation\Application;
use think\Url;
use think\Config;
use think\Page;
use think\Verify;
use think\Image;
use think\Db;
use think\Request;
use wxpay;
use alipay;
class Test extends Base 
{

    public function index()
    {
	$conf= $this->config();
        $app = new Application($conf);
        $oauth=$app->oauth;
        if (empty(Session::get('wechat_user'))){
            Session::set('target_url', '/index');
            $oauth->redirect()->send();
        }
        $user=Session::get('wechat_user');
        print_r($user);
    }
    public function oauth_callback(){
        $conf= $this->config();
        $app = new Application($conf);
        $oauth = $app->oauth;
        $user = $oauth->user();
        Session::set('wechat_user',$user);
        $targetUrl =empty(Session::get('target_url'))?'/index/test/success':Session::get('target_url');
        header('location:'. $targetUrl);
    }
    public function c ()
    {
    	Session::set('wechat_user', '');
    	$options = $this->config();
    	$app = new Application($options);
		$userService = $app->user;
		$users = $userService->lists()->toarray();
		print_r($users);
    }
//    public function success(){
//      $user=Session::get('wechat_user');
//
//      print_r($user);
//    }
    public function config(){
        $config=[
            /**
             * Debug 模式，bool 值：true/false
             *
             * 当值为 false 时，所有的日志都不会记录
             */
            'debug'  => false,
            /**
             * 账号基本信息，请从微信公众平台/开放平台获取
             */
            'app_id'  => 'wx924be37684200b2e',         // AppID
            'secret'  => '7ecedc5473c379f08637fccb44e4d16c',     // AppSecret
            'token'   => 'wex0f3azxf5diqmhpjy0jszadatoswut',          // Token
            'aes_key' => '',                    // EncodingAESKey，安全模式下请一定要填写！！！
            /**
             * 日志配置
             *
             * level: 日志级别, 可选为：
             *         debug/info/notice/warning/error/critical/alert/emergency
             * permission：日志文件权限(可选)，默认为null（若为null值,monolog会取0644）
             * file：日志文件位置(绝对路径!!!)，要求可写权限
             */
            'log' => [
                'level'      => 'debug',
                'permission' => 0777,
                'file'       => '/tmp/easywechat.log',
            ],
            /**
             * OAuth 配置
             *
             * scopes：公众平台（snsapi_userinfo / snsapi_base），开放平台：snsapi_login
             * callback：OAuth授权完成后的回调页地址
             */
            'oauth' => [
                'scopes'   => ['snsapi_userinfo'],
                'callback' => '/index/test/oauth_callback',
            ],
            /**
             * 微信支付
             */
            'payment' => [
                'merchant_id'        => 'your-mch-id',
                'key'                => 'key-for-signature',
                'cert_path'          => 'path/to/your/cert.pem', // XXX: 绝对路径！！！！
                'key_path'           => 'path/to/your/key',      // XXX: 绝对路径！！！！
                // 'device_info'     => '013467007045764',
                // 'sub_app_id'      => '',
                // 'sub_merchant_id' => '',
                // ...
            ],
            /**
             * Guzzle 全局设置
             *
             * 更多请参考： http://docs.guzzlephp.org/en/latest/request-options.html
             */
            'guzzle' => [
                'timeout' => 3.0, // 超时时间（秒）
                //'verify' => false, // 关掉 SSL 认证（强烈不建议！！！）
            ],
        ];
        return $config;
    }
    public function setrose(){
        $islamb = db('lamb')->where(array('status'=>1))->where(' (rose="" or rose is null) ')->select();
        foreach ($islamb as $v){
            $this->payhandle($v['oid'], $v['paytime'], 0);
            echo ''.$v['lambsn'].'收益更新成功<br/>';
        }
        //print_r($islamb);
    }
    public function hongbaotest(){
        $hb = hongbao(200, 66);
        $sizehb = serialize($hb);
        $unhb = unserialize($sizehb);
        print_r($hb);
        print_r($sizehb);
        print_r($unhb);
        print_r(array_sum($unhb));
    }
}
