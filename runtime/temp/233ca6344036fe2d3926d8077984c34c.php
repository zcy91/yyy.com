<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:78:"/home/wwwroot/yang.oioos.com/public/../application/index/view/user/qrcode.html";i:1517538592;s:73:"/home/wwwroot/yang.oioos.com/public/../application/index/view/header.html";i:1526866272;}*/ ?>
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
        <p>我的二维码</p>
    </div>
    <!--公共头部结束-->
    <!--内容主体-->
    <div class="m-qrcode">

        <div class="qrcode-img">
            <img style="position: absolute ;left: 0px;top: 0px;" src="/static/home/images/qrcode.gif" />
            <img style="position: absolute ;left: 0px;top: 0px;"  src="<?php echo url('/index/user/getqrcode'); ?>" />
        </div>
        <div class="qrcode-txt">
            我在食花百草羊认领<br />
            <span><?php echo $lambnum; ?></span>只羊<br />
            已经超越了<span><?php echo $exceed; ?>%</span>牧场主
        </div>

    </div>
    <!--内容主体结束-->

</body>
</html>
