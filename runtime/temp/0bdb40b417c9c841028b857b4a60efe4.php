<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:72:"E:\phpStudy\WWW\yyy.com\public/../application/index\view\user\setup.html";i:1525139890;s:68:"E:\phpStudy\WWW\yyy.com\public/../application/index\view\header.html";i:1528532196;}*/ ?>
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
        <p>设置</p>
    </div>
    <!--公共头部结束-->
    <!--内容主体-->
    <div class="m-setup">
        <h1>帐号绑定</h1>
        <!--功能列表-->
        <ul class="setup-ftlist">
            <li>
                <a href="<?php echo url('/index/user/cgphone'); ?>">
                    <p>手机号</p>
                    <i class="fa fa-angle-right"></i>
                    <span><?php if(!empty($member['mobile'])): ?><?php echo $member['mobile']; else: ?>未绑定<?php endif; ?></span>
                </a>
            </li>
            <li>
                <a href="javascript:;">
                    <p>微信号</p>
                    <i class="fa fa-angle-right"></i>
                    <?php if(!empty($member['openid'])): ?>
                        <span>已绑定</span>
                    <?php else: ?>
                        <span onclick="window.location='<?php echo url('/index/login/login',array('state'=>'wxbd')); ?>'">点击绑定</span>
                    <?php endif; ?>
                </a>
            </li>
        </ul>
        <!--功能列表结束-->
        <h1>安全问题</h1>
        <!--功能列表-->
        <ul class="setup-ftlist">
            <li>
                <a href="<?php echo url('/index/user/cgpassword'); ?>">
                    <p>登录密码</p>
                    <i class="fa fa-angle-right"></i>
                </a>
            </li>
            <li>
                <a href="<?php echo url('/index/user/paypassword'); ?>">
                    <p>支付密码</p>
                    <i class="fa fa-angle-right"></i>
                </a>
            </li>
            <li>
                <a href="<?php echo url('/index/user/perfectinfo'); ?>">
                    <p>完善信息</p>
                    <i class="fa fa-angle-right"></i>
                </a>
            </li>

        </ul>
        <!--密码问题结束-->
        <!--退出按钮-->
        <div class="setup-btn">
            <a href="<?php echo url('/index/login/login',array('exit'=>1)); ?>">退出登录</a>
        </div>
        <!--退出按钮结束-->
    </div>
    <!--内容主体结束-->

</body>
</html>
