<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:78:"E:\phpStudy\WWW\yyy.com\public/../application/index\view\user\rechargepay.html";i:1517538612;s:68:"E:\phpStudy\WWW\yyy.com\public/../application/index\view\header.html";i:1528532196;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title><?php if(!empty($webtitle)): ?><?php echo $webtitle; endif; ?> </title>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" name="viewport">
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta content="black" name="apple-mobile-web-app-status-bar-style">
    <meta content="telephone=no" name="format-detection">
    <meta content="email=no" name="format-detection">
    <link href="/static/home/css/base.css" rel="stylesheet" />
    <link href="/static/home/css/currency.css" rel="stylesheet" />
    <link href="/static/home/css/index.css" rel="stylesheet" />
    <script src="/static/home/js/jquery1.10.2.js"></script>
    <script src="/static/home/js/common.js"></script>
    <script src="/static/home/js/fontSize.js"></script>
    <script src="/static/home/layer/layer.js"></script>
    <script src="/static/js/jquery.cookie.js"></script>
    <link href="/static/home/css/font-awesome.css" rel="stylesheet" />
    <script type="text/javascript">
    	var str = navigator.userAgent;
		$(function(){
			if(str.indexOf("Html5Plus") != -1){
				document.querySelector('.m-head').style.display = 'none';
			}
		})
    </script>
    <style>
        .nav-link {
            position: absolute;
            display: block;
            line-height: 34px;
            font-size: 10px;
            font-weight: bold;
            color: #555;
            text-decoration: none;
            right: .7rem;
            top:.3rem
        }
        .nav-link:hover {
            color: #333;
            text-decoration: underline;
        }

        .nav-counter {
            position: absolute;
            top:0.1rem;
            right: -0.55rem;
            min-width: 8px;
            height: 20px;
            line-height: 20px;
            margin-top: -11px;
            padding: 0 6px;
            font-weight: normal;
            color: white;
            text-align: center;
            text-shadow: 0 1px rgba(0, 0, 0, 0.2);
            background: #e23442;
            border: 1px solid #911f28;
            border-radius: 11px;
            background-image: -webkit-linear-gradient(top, #e8616c, #dd202f);
            background-image: -moz-linear-gradient(top, #e8616c, #dd202f);
            background-image: -o-linear-gradient(top, #e8616c, #dd202f);
            background-image: linear-gradient(to bottom, #e8616c, #dd202f);
            -webkit-box-shadow: inset 0 0 1px 1px rgba(255, 255, 255, 0.1), 0 1px rgba(0, 0, 0, 0.12);
            box-shadow: inset 0 0 1px 1px rgba(255, 255, 255, 0.1), 0 1px rgba(0, 0, 0, 0.12);
        }

        .nav-counter-green {
            background: #75a940;
            border: 1px solid #42582b;
            background-image: -webkit-linear-gradient(top, #8ec15b, #689739);
            background-image: -moz-linear-gradient(top, #8ec15b, #689739);
            background-image: -o-linear-gradient(top, #8ec15b, #689739);
            background-image: linear-gradient(to bottom, #8ec15b, #689739);
        }

        .nav-counter-blue {
            background: #3b8de2;
            border: 1px solid #215a96;
            background-image: -webkit-linear-gradient(top, #67a7e9, #2580df);
            background-image: -moz-linear-gradient(top, #67a7e9, #2580df);
            background-image: -o-linear-gradient(top, #67a7e9, #2580df);
            background-image: linear-gradient(to bottom, #67a7e9, #2580df);
        }
        .xiaoxi{
            color: #fff;
            margin-right: .05rem;
        }
    </style>


    
</head>
<body style="position:relative;">

    <!--公共头部-->
    <div class="m-head">
        <a href="javascript:;" onclick="javascript:window.history.back();return false;" class="head-goback">
            <i class="fa fa-angle-left"></i>
        </a>
        <p>充值</p>
    </div>
    <!--公共头部结束-->
    <!--内容主体-->
    <div class="m-take">
        <!--提现信息-->
        <div class="take-way"><h1></h1></div>
        <div class="take-way">
            <h1>充值详情</h1>
            <ul>
                <li>
                    <span>充值串号：</span>
                    <u><?php echo $params['out_trade_no']; ?></u> 
                </li>
                <li>
                    <span>充值金额：</span>
                    <u><i class="fa fa-yen"></i><?php echo $params['total_fee']/100; ?></u>
                </li>
            </ul>
        </div>
        <!--提现信息结束-->
        <!--提现方式-->
        <div class="take-way">
            <h1>充值</h1>
            <ul>
                <li>
                    <label>
                        <?php if($params['type']==2): ?>
                        <span><i class="fa fa-wechat weixin"></i>微信充值</span>
                        <?php elseif($params['type']==3): ?>
                        <form id="formid" method='post' action="/index/index/alipay">
                            <input type="hidden" id="WIDout_trade_no" name="WIDout_trade_no" value="<?php echo $params['out_trade_no']; ?>" />
                            <span><i style="color: #00A0E8;" class="fa fa-paypal"></i>支付宝充值</span>
                        </form>
                        <?php elseif($params['type']==4): ?>
                        <span><i class="fa fa-credit-card-alt bankcard"></i>银行卡充值</span>
                        <?php elseif($params['type']==5): ?>
                        <span><i class="fa fa-credit-card-alt bankcard"></i>未定义</span>
                        
                        <?php endif; ?>
                    </label>
                </li>
            </ul>
        </div>
        <!--提现方式结束-->
        <!--购买按钮-->
        <div class="take-btn">
            <a href="javascript:;"  onclick="callpay()" >确认充值</a>
        </div>
        <!--购买按钮结束-->
    </div>
    <!--内容主体结束-->
<script type="text/javascript">
	//调用微信JS api 支付
	function jsApiCall()
	{
		WeixinJSBridge.invoke(
			'getBrandWCPayRequest',
                <?php if(!empty($jsApiParameters)): ?><?php echo $jsApiParameters; else: ?>''<?php endif; ?>,
			function(res){
				WeixinJSBridge.log(res.err_msg);
			}
		);
	}

	function callpay()
	{
            <?php if($params['type']==2): ?>
                if (typeof WeixinJSBridge == "undefined"){
		    if( document.addEventListener ){
		        document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
		    }else if (document.attachEvent){
		        document.attachEvent('WeixinJSBridgeReady', jsApiCall); 
		        document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
		    }
		}else{
		    jsApiCall();
		}       
            <?php elseif($params['type']==3): ?>
               document.getElementById("formid").submit();
            <?php elseif($params['type']==4): elseif($params['type']==5): endif; ?>
		
	}
	</script>
</body>
</html>
