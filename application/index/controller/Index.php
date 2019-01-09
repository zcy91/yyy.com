<?php
namespace app\index\controller;
use app\mobile\logic\Jssdk;
use mikkle\tp_wechat\src\Message;
use think\AjaxPage;
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
use alipay;

Loader::import('pingpp-php-master/init', EXTEND_PATH);
class Index extends Base
{
    function isWeixin()
    {
        if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false) {
            return true;
        }
        return false;
    }

    public function index()
    {
//        $chang1 =  (36*(6.5+12)*2)/(4*6.5*12);
//            if($chang1 < 3){
//                $a = 10*0.11*36*12*6.5;
//            }else{
//                $chang = (18*(6.5+12)*2)/(4*6.5*12);
//                $a = pow(10*0.11*18*12*6.5,(2/3))*2;
//            }
//            var_dump($chang1);
//            var_dump($chang);
//            var_dump($a);die;
        if (!empty($_GET['push'])) {
            $jssdk = new Jssdk('wx39eef0e1655086aa', '7ba300bf667b52a21d32076f78fc665f');
            $openid = db('member')->where(['mobile' => 18257990958])->value('openid');
            $res = $jssdk->push_msg_news($openid, '食花百草羊推送');
            var_dump($res);
            die;
        }

        if (!empty($this->member)) {
            $lambnum = db('lamb')->where(array('uid' => Session::get('user')['user_id'], 'status' => 1))->count();
            $this->assign('lambnum', $lambnum);
            $this->assign('member', $this->member);
        }
        //搜索最近发布的一期羊圈
        $fabu = db('goods')->where(array('shelftime' => ['<=', time()], 'stock' => ['>', 0], 'status' => 1))->order('shelftime', 'desc')->find();
        $isorder = db('order')
            ->field('o.*,m.username,m.realname,m.mobile')
            ->alias('o')
            ->join('__MEMBER__ m', 'o.uid=m.id', 'LEFT')
            ->where(array('o.status' => 1))
            ->group('o.uid')
            ->order('o.creationtime', 'desc')
            ->limit(10)
            ->select();
        $notice = db('article')->where(array('catid' => 3))->order(array('sort' => 'desc', 'id' => 'desc', 'status' => 1))->limit(10)->select();
        $this->assign("notice", $notice);
        $this->assign("fabu", $fabu);
        //$this->assign("isorder", $isorder);
        //获取首页轮播图
        $time = time();
        $ad = db('ad')->where(array('type' => 1, 'status' => 1, 'stime' => ['<', $time], 'etime' => ['>', $time]))->order('id', 'desc')->select();

        $this->assign("ad", $ad);

        //获取存栏数和注册人数
        $usernum = db('member')->count();
        $islambnum = db('lamb')->where(array('status' => ['>', 0]))->count();
        //今年出栏数
        $yearlambnum = db('lamb')->where(array('status' => ['>', 0]))->whereTime('creationtime', 'year')->count();
        //print_r($yearlambnum);
        if (!empty($this->setting['reg_num'])) {
            $usernum += $this->setting['reg_num'];
        }
        if (!empty($this->setting['sold_num'])) {
            $islambnum += $this->setting['sold_num'];
        }
        if (!empty($this->setting['stock_num'])) {
            $yearlambnum = $this->setting['stock_num'] - $yearlambnum;
        }
        $this->assign('usernum', $usernum);
        $this->assign('islambnum', $islambnum);
        $this->assign('yearlambnum', $yearlambnum);
        $this->assign('webtitle', '我是牧场主');
        return $this->fetch();
    }

    public function mynotify()
    {
        $notify = new \wxpay\Notify();
        $data = $notify->Handle();
        file_put_contents('pay_log.txt', $data . PHP_EOL, FILE_APPEND);
    }

    public function GetWxConfig()
    {
        $askUrl = input('askUrl');//分享URL
        $weixin_config = $this->wc; //获取微信配置
        //var_dump($weixin_config['appid']);var_dump($weixin_config['appsecret']);die;
        $jssdk = new Jssdk($weixin_config['appid'], $weixin_config['appsecret']);
        $signPackage = $jssdk->GetSignPackage(urldecode($askUrl));
        if ($signPackage) {
            return json($signPackage);
        } else {
            return false;
        }
    }

    public function ajaxGetWxConfig()
    {
        $askUrl = Request::instance()->post('askUrl');//分享URL
        $weixin_config = $this->wc; //获取微信配置
        $jssdk = new Jssdk($weixin_config['appid'], $weixin_config['appsecret']);
        $signPackage = $jssdk->GetSignPackage(urldecode($askUrl));
        if ($signPackage) {
            return json($signPackage);
        } else {
            return false;
        }
    }

    public function alipay_app()
    {
        $aop = new alipay\aop\AopClient();
        $aop->gatewayUrl = "https://openapi.alipay.com/gateway.do";
        $aop->appId = "2018010801698079";
        $aop->rsaPrivateKey = 'MIIEvAIBADANBgkqhkiG9w0BAQEFAASCBKYwggSiAgEAAoIBAQCF/RUr3288hBM993ahQTrInmkIgcWxHbInhHCm1pkODZOWyJyn4G++smN2/TbEIwrsCHYRooZ2fgp25Ehfg95jB618c+E9cGaeeot36OCkv7KsJgc8UKRSJdIL/km2UeQBHjby7nm1Bs8reF1+Vj9pyC09qCuhQBQxz8i6ZqH6nvJt4MNqJCNtX6EW2jrA+sIwcOhNClSL1HprxwftGm7fsfiHryCe7AKKbw46fh3X8sIlcMcb2vkK/nqOfnxNzI4wFW0Pb75zxS+Nq09fMfmc9i5YSGTquF+YBUbXCVCEgsTGE5T5BskeMh/g1Bs3IZljOprLw/oaQgXKNixA4PWlAgMBAAECggEAdIbZ9sHm19Z1dZrVzQARw5AhAIj8CUEuQzfnUPGpQpOEG8p0k3uZM1upLT6idomTYhsps8SI9FxBdYyrdIYWzkFLG8UbyncKiCFDUhFx7VXaaeTYvhfUEK1bs5p/ONSXWnGQkE3eAxXc7o1LoigYFkNFNS4gY6h656cxhwrjLDXxudDM6OsS62jmGUfsLMTwvlwE4UIF5qOQZeliYvwBOmChHLlejzyOuB7svHf/X/FEJcDh7/Yomi5o9ydYK5IiloFfY8HYQlddhzC7rjaht7bH0BHFI+pIIG/+APvMMAVDFMmmkTLSuHt+Q7QKrSLgdpZ7+jNL8+LmiQTyH2uMsQKBgQDYr8IuilCrXqyFehfibg1C2aqkP4Sx7cNy9vcU9Tm7C8ganWROsUWYpuHMISzKXxKDGtTi+igJjHAhN8K3wqInYwb7bjCrwP7iBep/zf6Tghp/ELVzocBFkCmBSfUXuWUejTHb2zqzIm+CdWGxULMTN3HagPH8MFKQL+XGKRGGfwKBgQCeTFQN+gC5+2w5evSpZvR6viX+Nmr+w1JgXUAqGtRE1wydoEviHPV976K5UzzBaE7q39OtcFYjQN1ZnoZgFObkmOaatqN3ywxxgUsMMJYWXEnoxskNG2jW18xmTtqij6QqhBEe6vuNiJGy22JAW2cLAZ9PQ5VK3dlsBvU00/+Z2wJ/F7MhifWW3Sd9txujgSCIUsd74nsQCGX4+poIbEJmDg87061jSzgYZJncGHeIbpn3bF+C6VBzEJhLq1Zt9atUEPrDyLxEloSFXDNJcrEVJw0T2NH7BqqqXPFnmLx+Eho09SJ8UY+o2+7oQ1yTUtGAxJlL2po/3VVrslmKyCG1yQKBgQCCxHUvcpZFDVDzDwKsKpPODeSe419yA/K6Dm6iGbW/BJO0ZyYorVmTZnHbfMqUz1FaL/rSrRlLWBtDHHTPTJUMxM7Dghr6K++kmHVhpYVnBWg89nJB9KGf0XdWENAGOHkaci0eiGm0GtyZjyfUGG3AJt/u/9qFlU02M20+7d6ZvwKBgQDTC1UguANHw7Hp790Th/VE7vBcxWVMAfQLt3FzZ8BhtsMEs7aJ3MuZgj5sT1fNaxbUL5hrpn7r6f5mPaGlJtIVC8LqgXsZCxX1EOVls7zlzhB7aq1IsHvhcHDmiTFb5/KAvdOAre1DF9w0stJtQJAH8dwTLWFzmZfq6lVa32Hjdg==';
        $aop->format = "json";
        $aop->charset = "UTF-8";
        $aop->signType = "RSA2";
        $aop->alipayrsaPublicKey = 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAqy0Ia06H/AN/7gooVC59EemUr2YMEADPu+M8oxr+WTGYQAAE12Mz8mHxAv5l3R/4+QcZf9tx3bpYuFiqH8A4uSzKLsnMnGnPOf73g2iXkkSYMy6HerRTVvk4yZSMadg9krK5HrjLuHm1VQvXKNGaXCUDDHv6FsF33/KPgHIIzEA2Wbq9tPIiDA8dBrYiuPPXX9DMRkp1HjzB1TAtzOoaWhrVtabR/hv61oDrGKepnkkQbWDBOnWLhBapH719GogOm5bGJFbaDCwRUlH4WnUefpN4zDtdc/jucr+GQC22q1nhhH28Cfk5Nra2pDK2aSZRWysRnmF4F2b095tZgkFAxwIDAQAB';//
        require('./../extend/alipay/aop/request/AlipayTradeAppPayRequest.php');
//实例化具体API对应的request类,类名称和接口名称对应,当前调用接口名称：alipay.trade.app.pay
        $request = new \AlipayTradeAppPayRequest();
        if (empty($_POST['WIDout_trade_no'])) {
            return json(['code' => 1, 'data' => '订单号不存在']);
        }
        $out_trade_no = $_POST['WIDout_trade_no'];
        //$out_trade_no = '20180000';
        $sntype = substr($out_trade_no, 0, 2);
        if ($sntype == 'CZ') {
            $result = db('recharge_log')->where(array('rechargesn' => $out_trade_no, 'status' => '0'))->find();
            //订单名称，必填
            $subject = '支付宝充值余额';

            //付款金额，必填
            $total_amount = $result['money'];
            //$total_amount = 0.01;
            //商品描述，可空
            $body = '余额充值' . $result['money'] . '元';
        } else {

            $result = db('order')->where(array('ordersn' => $out_trade_no, 'status' => '0'))->find();
            //订单名称，必填
            $subject = '支付订单';

            //付款金额，必填
            $total_amount = $result['price'];
            //$total_amount = 0.01;
            //商品描述，可空
            $body = '支付订单' . $out_trade_no . '';
        }
//SDK已经封装掉了公共参数，这里只需要传入业务参数
        $bizcontent = "{\"body\":\"食花百草羊\","
            . "\"subject\": \"$subject\","
            . "\"out_trade_no\": \"$out_trade_no\","
            . "\"timeout_express\": \"30m\","
            . "\"total_amount\": \"$total_amount\","
            . "\"product_code\":\"QUICK_MSECURITY_PAY\""
            . "}";
        $request->setNotifyUrl("http://yang.oioos.com/index/index/alipay_notify_app_url.html");
        $request->setBizContent($bizcontent);
//这里和普通的接口调用不同，使用的是sdkExecute
        $response = $aop->sdkExecute($request);
//htmlspecialchars是为了输出到页面时防止被浏览器将关键参数html转义，实际打印到日志以及http传输不会有这个问题
        header('Content-type: application/json');
        return json(['code' => 0, 'data' => $response]);//就是orderString 可以直接给客户端请求，无需再做处理。

    }

    public function alipay()
    {
        //require dirname ( __FILE__ ).DIRECTORY_SEPARATOR.'./../config.php';
        $config = Db::name('set_alipay')->order('id', 'desc')->find();

        if (!empty($_POST['WIDout_trade_no']) && trim($_POST['WIDout_trade_no']) != "") {
            //商户订单号，商户网站订单系统中唯一订单号，必填
            $out_trade_no = $_POST['WIDout_trade_no'];
            $sntype = substr($out_trade_no, 0, 2);
            if ($sntype == 'CZ') {
                $result = db('recharge_log')->where(array('rechargesn' => $out_trade_no, 'status' => '0'))->find();
                //订单名称，必填
                $subject = '支付宝充值余额';

                //付款金额，必填
                $total_amount = $result['money'];

                //商品描述，可空
                $body = '余额充值' . $result['money'] . '元';
            } else {

                $result = db('order')->where(array('ordersn' => $out_trade_no, 'status' => '0'))->find();
                //订单名称，必填
                $subject = '支付订单';

                //付款金额，必填
                $total_amount = $result['price'];

                //商品描述，可空
                $body = '支付订单' . $out_trade_no . '';
            }


            //超时时间
            $timeout_express = "1m";
            $payRequestBuilder = new alipay\wappay\buildermodel\AlipayTradeWapPayContentBuilder();
            $payRequestBuilder->setBody($body);
            $payRequestBuilder->setSubject($subject);
            $payRequestBuilder->setOutTradeNo($out_trade_no);
            $payRequestBuilder->setTotalAmount($total_amount);
            $payRequestBuilder->setTimeExpress($timeout_express);

            $payResponse = new alipay\wappay\service\AlipayTradeService($config);
            //var_dump($payResponse);die;
            $result = $payResponse->wapPay($payRequestBuilder, $config['return_url'], $config['notify_url']);

            return;
        }
    }

    public function pay()
    {
        return $this->fetch();
    }

    public function success_alipay()
    {
        $config = Db::name('set_alipay')->order('id', 'desc')->find();
        $arr = $_GET;
        $alipaySevice = new alipay\wappay\service\AlipayTradeService($config);
        // $result = $alipaySevice->check($arr);
        if ($arr['result'] == 'success') {//验证成功
            $out_trade_no = htmlspecialchars($_GET['out_trade_no']);
            //支付宝交易号
            //$trade_no = htmlspecialchars($_GET['trade_no']);
            $sntype = substr($out_trade_no, 0, 2);
            if ($sntype == 'CZ') {
                $issn = db('recharge_log')->where(array('rechargesn' => $out_trade_no))->find();
                $member = db('member')->where('id', $issn['userid'])->find();
                $result = db('recharge_log')->where(array('rechargesn' => $out_trade_no, 'status' => '0'))->update(['status' => 1, 'balance' => ($member['credit'] + $issn['money'])]);
                if ($result) {
                    db('member')->where('id', $member['id'])->setInc('credit', $issn['money']);
                }
                $da = ['first'=>['value'=>"恭喜你充值成功!",'color'=>'#173177'],
                    'keyword1'=>['value'=>'余额充值','color'=>'#173177'],
                    'keyword2'=>['value'=>$issn['money'].'元','color'=>'#173177'],
                    'keyword3'=>['value'=>'支付宝充值','color'=>'#173177'],
                    'keyword4'=>['value'=>date("Y年m月d日 h时i分s秒",$issn['time']),'color'=>'#173177'],
                    'remark'  =>['value'=>'欢迎再次购买','color'=>'#173177']];
                $da = urlencode(json_encode($da));
                $resu = $this->sendTemplateMessage('wx39eef0e1655086aa','7ba300bf667b52a21d32076f78fc665f',$member['openid'],'8hrUrqieJnMAm11xZUtYYgdEwDHk1OnHYux5JATsA4c','http://yang.oioos.com/index/user/walletrecord',$da);
                $this->success("充值成功<br />订单号：" . $out_trade_no, "/index/index");

            } else {
                $time = time();
                $issn = db('order')->where(array('ordersn' => $out_trade_no))->find();
                $member = db('member')->where('id', $issn['uid'])->find();
                $result = db('order')->where(array('ordersn' => $out_trade_no, 'status' => '0'))->update(['status' => 1, 'paytype' => 3, 'paytime' => $time]);
                if ($result) {
                    $data = array(
                        'rechargesn' => '',
                        'userid' => $member['id'],
                        'money' => $issn['money'],
                        'vary' => 2,//1表示增加
                        'balance' => $member['credit'],//余额
                        'type' => 3,//2表示微信
                        'time' => $time,
                        'remark' => '买羊羔',
                        'status' => 1,//生效
                    );
                    db('recharge_log')->insert($data);
                    db('lamb')->where('oid', $issn['id'])->update(['status' => '1', 'paytime' => $time]);
                    //处理分销计算
                    //  $commission = $this->setCommission($oid);
                    $this->payhandle($issn['id'], $time);
                }
                $this->success("支付成功<br />外部订单号：" . $out_trade_no, "/index/index");
            }
            //——请根据您的业务逻辑来编写程序（以上代码仅作参考）——

            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        } else {
            //验证失败
            $this->success("验证失败", "/index/index");
        }
    }

    public function cannel_alipay()
    {
        $this->success("订单已取消", "/index/index");
    }

    public function alipay_notify_app_url()
    {

        $config = Db::name('set_alipay')->order('id', 'desc')->find();


        $arr = $_POST;
        $alipaySevice = new alipay\wappay\service\AlipayTradeService($config);
        $alipaySevice->writeLog(var_export($_POST, true));
        $result = $alipaySevice->check($arr);
        if ($result) {//验证成功
            $out_trade_no = $_POST['out_trade_no'];
            //支付宝交易号
            $trade_no = $_POST['trade_no'];
            //交易状态
            $trade_status = $_POST['trade_status'];
            $out_trade_no = htmlspecialchars($_POST['out_trade_no']);
            //支付宝交易号
            $trade_no = htmlspecialchars($_POST['trade_no']);
            $sntype = substr($out_trade_no, 0, 2);
            if ($sntype == 'CZ') {
                $issn = db('recharge_log')->where(array('rechargesn' => $out_trade_no))->find();
                $member = db('member')->where('id', $issn['userid'])->find();
                $result = db('recharge_log')->where(array('rechargesn' => $out_trade_no, 'status' => '0'))->update(['status' => 1, 'balance' => ($member['credit'] + $issn['money'])]);
                if ($result) {
                    db('member')->where('id', $member['id'])->setInc('credit', $issn['money']);
                }
                //$this->success("充值成功<br />订单号：".$out_trade_no,"/index/index");
            } else {
                $time = time();
                $issn = db('order')->where(array('ordersn' => $out_trade_no))->find();
                $member = db('member')->where('id', $issn['uid'])->find();
                $result = db('order')->where(array('ordersn' => $out_trade_no, 'status' => '0'))->update(['status' => 1, 'paytype' => 3, 'paytime' => $time]);
                if ($result) {
                    $data = array(
                        'rechargesn' => '',
                        'userid' => $member['id'],
                        'money' => $issn['money'],
                        'vary' => 2,//1表示增加
                        'balance' => $member['credit'],//余额
                        'type' => 3,//2表示微信
                        'time' => $time,
                        'remark' => '买羊羔',
                        'status' => 1,//生效
                    );
                    db('recharge_log')->insert($data);
                    db('lamb')->where('oid', $issn['id'])->update(['status' => '1', 'paytime' => $time]);
                    //处理分销计算
                    //   $commission = $this->setCommission($oid);
                    $this->payhandle($issn['id'], $time);
                }
                //$this->success("支付成功<br />外部订单号：".$out_trade_no,"/index/index");
            }

            if ($_POST['trade_status'] == 'TRADE_FINISHED') {

                //判断该笔订单是否在商户网站中已经做过处理
                //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                //请务必判断请求时的total_amount与通知时获取的total_fee为一致的
                //如果有做过处理，不执行商户的业务程序

                //注意：
                //退款日期超过可退款期限后（如三个月可退款），支付宝系统发送该交易状态通知
            } else if ($_POST['trade_status'] == 'TRADE_SUCCESS') {
                //判断该笔订单是否在商户网站中已经做过处理
                //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                //请务必判断请求时的total_amount与通知时获取的total_fee为一致的
                //如果有做过处理，不执行商户的业务程序
                //注意：
                //付款完成后，支付宝系统发送该交易状态通知
            }
            //——请根据您的业务逻辑来编写程序（以上代码仅作参考）——

            echo "success";        //请不要修改或删除

        } else {
            //验证失败
            echo "fail";    //请不要修改或删除

        }
    }

    public function alipay_notify_url()
    {

        $config = Db::name('set_alipay')->order('id', 'desc')->find();


        $arr = $_POST;
        $alipaySevice = new alipay\wappay\service\AlipayTradeService($config);
        $alipaySevice->writeLog(var_export($_POST, true));
        $result = $alipaySevice->check($arr);
        if ($result) {//验证成功
            $out_trade_no = $_POST['out_trade_no'];
            //支付宝交易号
            $trade_no = $_POST['trade_no'];
            //交易状态
            $trade_status = $_POST['trade_status'];
            $out_trade_no = htmlspecialchars($_GET['out_trade_no']);
            //支付宝交易号
            $trade_no = htmlspecialchars($_GET['trade_no']);
            $sntype = substr($out_trade_no, 0, 2);
            if ($sntype == 'CZ') {
                $issn = db('recharge_log')->where(array('rechargesn' => $out_trade_no))->find();
                $member = db('member')->where('id', $issn['userid'])->find();
                $result = db('recharge_log')->where(array('rechargesn' => $out_trade_no, 'status' => '0'))->update(['status' => 1, 'balance' => ($member['credit'] + $issn['money'])]);
                if ($result) {
                    db('member')->where('id', $member['id'])->setInc('credit', $issn['money']);
                }
                $da = ['first'=>['value'=>"恭喜你充值成功!",'color'=>'#173177'],
                    'keyword1'=>['value'=>'余额充值','color'=>'#173177'],
                    'keyword2'=>['value'=>$issn['money'].'元','color'=>'#173177'],
                    'keyword3'=>['value'=>'支付宝充值','color'=>'#173177'],
                    'keyword4'=>['value'=>date("Y年m月d日 h时i分s秒",$issn['time']),'color'=>'#173177'],
                    'remark'  =>['value'=>'欢迎再次购买','color'=>'#173177']];
                $da = urlencode(json_encode($da));
                $resu = $this->sendTemplateMessage('wx39eef0e1655086aa','7ba300bf667b52a21d32076f78fc665f',$member['openid'],'8hrUrqieJnMAm11xZUtYYgdEwDHk1OnHYux5JATsA4c','http://yang.oioos.com/index/user/walletrecord',$da);
                $this->success("充值成功<br />订单号：" . $out_trade_no, "/index/index");
            } else {
                $time = time();
                $issn = db('order')->where(array('ordersn' => $out_trade_no))->find();
                $member = db('member')->where('id', $issn['uid'])->find();
                $result = db('order')->where(array('ordersn' => $out_trade_no, 'status' => '0'))->update(['status' => 1, 'paytype' => 3, 'paytime' => $time]);
                if ($result) {
                    $data = array(
                        'rechargesn' => '',
                        'userid' => $member['id'],
                        'money' => $issn['money'],
                        'vary' => 2,//1表示增加
                        'balance' => $member['credit'],//余额
                        'type' => 3,//2表示微信
                        'time' => $time,
                        'remark' => '买羊羔',
                        'status' => 1,//生效
                    );
                    db('recharge_log')->insert($data);
                    db('lamb')->where('oid', $issn['id'])->update(['status' => '1', 'paytime' => $time]);
                    //处理分销计算
                    //   $commission = $this->setCommission($oid);
                    $this->payhandle($issn['id'], $time);
                }
                $this->success("支付成功<br />外部订单号：" . $out_trade_no, "/index/index");
            }

            if ($_POST['trade_status'] == 'TRADE_FINISHED') {

                //判断该笔订单是否在商户网站中已经做过处理
                //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                //请务必判断请求时的total_amount与通知时获取的total_fee为一致的
                //如果有做过处理，不执行商户的业务程序

                //注意：
                //退款日期超过可退款期限后（如三个月可退款），支付宝系统发送该交易状态通知
            } else if ($_POST['trade_status'] == 'TRADE_SUCCESS') {
                //判断该笔订单是否在商户网站中已经做过处理
                //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
                //请务必判断请求时的total_amount与通知时获取的total_fee为一致的
                //如果有做过处理，不执行商户的业务程序
                //注意：
                //付款完成后，支付宝系统发送该交易状态通知
            }
            //——请根据您的业务逻辑来编写程序（以上代码仅作参考）——

            echo "success";        //请不要修改或删除

        } else {
            //验证失败
            echo "fail";    //请不要修改或删除

        }
    }

    public function alipay_return_url()
    {
        $config = Db::name('set_alipay')->order('id', 'desc')->find();
        $arr = $_GET;
        $alipaySevice = new alipay\wappay\service\AlipayTradeService($config);
        $result = $alipaySevice->check($arr);
        if ($result) {//验证成功
            $out_trade_no = htmlspecialchars($_GET['out_trade_no']);
            //支付宝交易号
            $trade_no = htmlspecialchars($_GET['trade_no']);
            $sntype = substr($out_trade_no, 0, 2);
            if ($sntype == 'CZ') {
                $issn = db('recharge_log')->where(array('rechargesn' => $out_trade_no))->find();
                $member = db('member')->where('id', $issn['userid'])->find();
                $result = db('recharge_log')->where(array('rechargesn' => $out_trade_no, 'status' => '0'))->update(['status' => 1, 'balance' => ($member['credit'] + $issn['money'])]);
                if ($result) {
                    db('member')->where('id', $member['id'])->setInc('credit', $issn['money']);
                }
                $da = ['first'=>['value'=>"恭喜你充值成功!",'color'=>'#173177'],
                    'keyword1'=>['value'=>'余额充值','color'=>'#173177'],
                    'keyword2'=>['value'=>$issn['money'].'元','color'=>'#173177'],
                    'keyword3'=>['value'=>'支付宝充值','color'=>'#173177'],
                    'keyword4'=>['value'=>date("Y年m月d日 h时i分s秒",$issn['time']),'color'=>'#173177'],
                    'remark'  =>['value'=>'欢迎再次购买','color'=>'#173177']];
                $da = urlencode(json_encode($da));
                $resu = $this->sendTemplateMessage('wx39eef0e1655086aa','7ba300bf667b52a21d32076f78fc665f',$member['openid'],'8hrUrqieJnMAm11xZUtYYgdEwDHk1OnHYux5JATsA4c','http://yang.oioos.com/index/user/walletrecord',$da);
                $this->success("充值成功<br />订单号：" . $out_trade_no, "/index/index");
            } else {
                $time = time();
                $issn = db('order')->where(array('ordersn' => $out_trade_no))->find();
                $member = db('member')->where('id', $issn['uid'])->find();
                $result = db('order')->where(array('ordersn' => $out_trade_no, 'status' => '0'))->update(['status' => 1, 'paytype' => 3, 'paytime' => $time]);
                if ($result) {
                    $data = array(
                        'rechargesn' => '',
                        'userid' => $member['id'],
                        'money' => $issn['money'],
                        'vary' => 2,//1表示增加
                        'balance' => $member['credit'],//余额
                        'type' => 3,//2表示微信
                        'time' => $time,
                        'remark' => '买羊羔',
                        'status' => 1,//生效
                    );
                    db('recharge_log')->insert($data);
                    db('lamb')->where('oid', $issn['id'])->update(['status' => '1', 'paytime' => $time]);
                    //处理分销计算
                    //  $commission = $this->setCommission($oid);
                    $this->payhandle($issn['id'], $time);
                }
                $this->success("支付成功<br />外部订单号：" . $out_trade_no, "/index/index");
            }
            //——请根据您的业务逻辑来编写程序（以上代码仅作参考）——

            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        } else {
            //验证失败
            $this->success("验证失败", "/index/index");
        }
    }

    public function notice_detail()
    {
        $id = input('id');
        $myarticle = db('article')->where(array('id' => $id, 'status' => 1))->find();
        $userId = $myarticle['userid'];
        $list = db('comment')->where(array('aid' => $id, 'status' => 1))->select();
        if (!empty($myarticle)) {
            $myarticle['img'] = unserialize($myarticle['img']); // 晒单图片
            $this->assign('myarticle', $myarticle);
        } else {
            exit();
        }
        if (!empty(Session::get('user.user_id'))) {
            $userid = Session::get('user.user_id');
            if ($userid == $userId) {
                $isdelarticle = 1;
            }
            $iszan = db('comment')->where('userid', $userid)->where('aid', $id)->where("comment is null")->value('iszan');
        } elseif (@$_COOKIE['mobile']) {
            $mobile = $_COOKIE['mobile'];
            $userid = db('member')->where('mobile', $mobile)->value('id');
            if ($userid == $userId) {
                $isdelarticle = 1;
            }
            $iszan = db('comment')->where('userid', $userid)->where('aid', $id)->where("comment is null")->value('iszan');
        } else {
            $iszan = 0;
        }
        db('article')->where('id', $id)->setInc('hits'); //增加阅读
        $this->assign('iszan', $iszan);
        $this->assign('webtitle', '公告');
        return $this->fetch();
    }

    public function notice_list()
    {
        $notice_list = db('article')->where(array('catid' => 3))->order(array('sort' => 'desc', 'id' => 'desc', 'status' => 1))->select();
        $count = count($notice_list);
        $page_count = 15;
        $page = new AjaxPage($count, $page_count);
        $list = db('article')->where(array('catid' => 3, 'status' => 1))->order(array('sort' => 'desc', 'id' => 'desc'))->limit($page->firstRow . ',' . $page->listRows)->select();
        foreach ($list as $s => $v) {
            $list[$s]['timestr'] = time_tran($v['createtime']);
            $list[$s]['content'] = strip_tags($v['content']);
            $list[$s]['content'] = filterComment($list[$s]['content']);
            $list[$s]['img'] = unserialize($v['img']); // 晒单图片
        }
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

    public function ajaxnotice()
    {
        $count = count(db('article')->where(array('catid' => 3, 'status' => 1))->order(array('sort' => 'desc', 'id' => 'desc'))->select());
        $page_count = 15;
        $page = new AjaxPage($count, $page_count);
        $list = db('article')->where(array('catid' => 3, 'status' => 1))->order(array('sort' => 'desc', 'id' => 'desc'))->limit($page->firstRow . ',' . $page->listRows)->select();
        foreach ($list as $s => $v) {
            $list[$s]['timestr'] = time_tran($v['createtime']);
            $list[$s]['content'] = strip_tags($v['content']);
            $list[$s]['content'] = filterComment($list[$s]['content']);
            $list[$s]['img'] = unserialize($v['img']); // 晒单图片
        }
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

    public function agent()
    {
        $uid = input('uid');
        $id = input('id');
        $this->assign('id', $id);
        $webtitle = '我的代理证书';
        $this->assign('webtitle', $webtitle);
        $this->assign('uid', $uid);
        return $this->fetch();
    }

    public function getagent()
    {
        $uid = input('uid');
        $id = input('id');
        $isorder = db('agent')
            ->field('o.*,og.lambname,m.username,m.realname,m.mobile,m.cardid')
            ->alias('o')
            ->join('__LAMB__ og', 'o.lambid = og.id', 'LEFT')
            ->join('__MEMBER__ m', 'o.uid=m.id', 'LEFT')
            ->where(array('o.id' => $id))
            ->find();

        //$buyid = db('sell_lamb')->where('id',$oid)->value('buyid');
        $buyer = db('member')->where('id', $uid)->find();
        $islamb = db('lamb')->field('lambsn')->where(array('id' => $isorder['lambid']))->select();
        $lambarr = array();
        foreach ($islamb as $v) {
            $lambarr[] = $v['lambsn'];
        }
        $lambsn = implode(",", $lambarr);
        $safesn = '见详情';
        //$return = $isorder['money'] * $isorder['percentage']/100;
        $dataarr = array(
            'realname' => $isorder['realname'],
            'uid' => $isorder['uid'],
            //'autograph' => $isorder['autograph'],
            'cardid' => $isorder['cardid'],
            'mobile' => $isorder['mobile'],
            'selluid' => $isorder['uid'],
            'gname' => $isorder['lambname'],
            'buyname' => $buyer['realname'],
            'buycardid' => $buyer['cardid'],
            'buymobile' => $buyer['mobile'],
            'buyuid' => $buyer['id'],
            'code' => $isorder['code'],
            'lambsn' => $lambsn,
            'safesn' => $safesn,
            'time' => date('Y年m月d日', $isorder['addtime']) . '至' . date('Y年m月d日', $isorder['endtime'] - 1),

            'city' => $isorder['city'],
            'addtime_y' => date('Y', $isorder['addtime']),
            'addtime_m' => date('m', $isorder['addtime']),
            'addtime_d' => date('d', $isorder['addtime'])
        );
        $iscontract = db('contract_set')->where('id', 3)->find();
//        if(!empty($iscontract['background'])){
//            $image = imagecreatefrompng('server/'.$iscontract['background']);
//        }else{
        $image = imagecreatefromjpeg('./static/home/images/shouquan.jpg');
        //$image = imagecreatefrompng('server/'.$iscontract['background']);
//        }
        $parameter = unserialize($iscontract['parameter']);
        $location = array();
        foreach ($parameter as $k => $v) {
            $location[$k] = explode(',', $v, 2);
        }
        // 证书模版图片文件的路径
        $red = imagecolorallocate($image, 12, 34, 56);                 // 字体颜色

        if (empty($location)) {
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
        } else {
            imageTTFText($image, 15, 0, 420, 368, $red, 'static/font/simhei.ttf', $dataarr['realname']);
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


        /* 直接显示在浏览器 */
        //header('Content-type: image/png;');
        ImagePng($image);
        imagedestroy($image);
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
        $orderNo = time();
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
                echo $ch;
                exit;                                    // 输出 Ping++ 返回的支付凭据 Charge
            } catch (\Pingpp\Error\Base $e) {
                // 捕获报错信息
                if ($e->getHttpStatus() != null) {
                    header('Status: ' . $e->getHttpStatus());
                    echo $e->getHttpBody();
                } else {
                    echo $e->getMessage();
                }
            }
            return $this->fetch();
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
                // echo $ch;                                       // 输出 Ping++ 返回的支付凭据 Charge
            } catch (\Pingpp\Error\Base $e) {
                // 捕获报错信息
                if ($e->getHttpStatus() != null) {
                    header('Status: ' . $e->getHttpStatus());
                    echo $e->getHttpBody();
                } else {
                    echo $e->getMessage();
                }
            }
            return $this->fetch();
        }
    }

    public function love()
    {
        $this->assign('webtitle', '我是牧场主');
        return $this->fetch();
    }

    public function paytemplate()
    {


        $da = ['first' => ['value' => "恭喜你购买成功!", 'color' => '#173177'],
            'keyword1' => ['value' => '余额充值', 'color' => '#173177'],
            'keyword2' => ['value' => '0.05元', 'color' => '#173177'],
            'keyword3' => ['value' => '微信充值', 'color' => '#173177'],
            'keyword4' => ['value' => '2019', 'color' => '#173177'],
            'remark' => ['value' => '欢迎再次购买', 'color' => '#173177']];
        $da = urlencode(json_encode($da));

        $resu = $this->sendTemplateMessage('wx39eef0e1655086aa', '7ba300bf667b52a21d32076f78fc665f', 'otsEpwJ0_RmPkz_sk7BgAmKCOKu4', '8hrUrqieJnMAm11xZUtYYgdEwDHk1OnHYux5JATsA4c', 'http://yang.oioos.com/index/user/walletrecord', $da);
        var_dump($resu);
    }

    public function sendTemplateMessage($appid, $appsecret, $touser, $template_id, $url, $data)
    {
        $sendTemplateMessage = new Message(['appid' => $appid, 'appsecret' => $appsecret]);
        //$data = $sendTemplateMessage->getAllPrivateTemplate();
        $data = urldecode($data);

        $srt = '{
           "touser":"' . $touser . '",
            "template_id":"' . $template_id . '",
            "url":"' . $url . '",
            "data":';
        $srt .= $data;
        $srt .= '}';
        $data = json_decode($srt, true);
        echo $errorinfo = json_last_error();   //输出4 语法错误
        return $sendTemplateMessage->sendTemplateMessage($data);


    }
    public function jiayou(){
        echo '加油';
    }
}
