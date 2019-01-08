<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:80:"/home/wwwroot/yang.oioos.com/public/../application/index/view/user/recharge.html";i:1517538596;s:73:"/home/wwwroot/yang.oioos.com/public/../application/index/view/header.html";i:1526866272;}*/ ?>
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
<form id="formid"  action="/index/user/rechargepay/" method="post">   
    <!--内容主体-->
    <div class="m-take">
        <!--提现信息-->
        <div class="take-info">
            <div class="info-numb">
                <span>金额</span>
                <input type="text" id="money" name="money" maxlength="11" placeholder="输入充值金额" />
            </div>
        </div>
        <!--提现信息结束-->
        <!--提现方式-->
        <div class="take-way">
            <h1>充值</h1>
            <ul>
                <?php if($paystr == 'wechat'): ?>
                <li>
                    <label>
                        <span><i class="fa fa-wechat weixin"></i>微信充值</span>
                        <input type="radio" name="paytype" value="2" checked="checked" />
                    </label>
                </li>
                <?php elseif($paystr == 'other' || $paystr == 'app'): ?>
                <li>
                    <label>
                        <span><i style="color: #00A0E8;" class="fa fa-paypal"></i>支付宝充值</span>
                        <input type="radio" name="paytype" value="3" checked="checked" />
                    </label>
                </li>
                <?php endif; ?>
<!--                <li>
                    <label>
                        <span><i class="fa fa-credit-card-alt bankcard"></i>银行卡充值</span>
                        <input type="radio" name="paytype" value="4" />
                    </label>
                </li>-->
            </ul>
        </div>
        <!--提现方式结束-->
        <!--购买按钮-->
        <div class="take-btn">
            <input style="  display: block;width: 3rem; margin: 0 auto; padding: .2rem 0;text-align: center;font-size: .3rem;color: #fff;border-radius: .1rem;background: #81D741;" 
                            type="button" onclick="checkUser();"  value="确认充值" />
        </div>
        <!--购买按钮结束-->
    </div>
    <!--内容主体结束-->
</form>
    <script>
        function checkUser(){
        var money = document.getElementById("money").value;
        
            if(isNaN(money) || money<=0){
            alert("金额必须大于0");
                return false;
            }
            if(money>10000000){
                alert("金额超出限额");
                return false;
            }
            document.getElementById("formid").submit();
        }
    </script>
</body>
</html>
