<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:72:"D:\wamp64\www\yyy.com\public/../application/index\view\login\setpwd.html";i:1531810141;s:66:"D:\wamp64\www\yyy.com\public/../application/index\view\header.html";i:1531711450;}*/ ?>
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
    <p>重置登陆密码</p>
</div>
<!--公共头部结束-->
<!--内容主体-->
<div class="m-cgphone">
    <!--信息输入-->
    <div class="cgphone-entry">
        <div class="entry-box">
            <i class="fa fa-mobile box-icon"></i>
            <input type="number" placeholder="请输入手机号" class="writetxt phoneNumb" value="" />
        </div>
        <div class="entry-box">
            <input type="number" placeholder="请输入验证码" class="writenumb" />
            <input type="button" value="点击获取验证码" class="obtainCode" onclick="getSms()" />
        </div>
        <div class="entry-box">
            <i class=" fa fa-lock box-icon "></i>
            <input type="password" placeholder="请输入新的登陆密码" class="writetxt newpassword1" name="paypwd" id="newpassword"/>
        </div>
        <div class="entry-box">
            <i class="fa fa-lock box-icon"></i>
            <input type="password" placeholder="请确认新的登陆密码" class="writetxt newpassword2" />
        </div>
    </div>
    <!--信息输入结束-->
    <!--确认按钮-->
    <a href="javascript:setMobile();" class="cgphone-btn">确认</a>
    <!--确认按钮结束-->
</div>
<!--内容主体结束-->
<script>
    var isPhone = 1;
    function getSms() {
        checkPhone(); //验证手机号
        if (isPhone) {
            var phone = $('.phoneNumb').val();

            $.ajax({
                type: 'POST',
                url: '<?php echo url("/index/login/getsms"); ?>',
                data:{
                    phone:phone,
                },
                dataType:'json',
                success: function(data){
                    if(data.type==1){
                        layer.msg(data.data);
                    }else if(data.type==2){
                        layer.msg(data.data);
                    }else if(data.type==3){
                        layer.msg(data.data);
                    }else{
                        layer.msg(data.data);
                    }


                },
                error: function(xhr){
                    layer.msg('error');
                }
            });
            resetCode(); //倒计时
        }
    }
    function setMobile(){
        var phone = $('.phoneNumb').val();
        var code = $('.writenumb').val();
        var password = $('#newpassword').val();
        var newpassword2 = $('.newpassword2').val();
        if(password!==newpassword2){
            layer.msg('两次密码输入不一致！');
            return;
        }
        if(!password){
            layer.msg('请输入密码！');
            return;
        }
        if(!code){
            layer.msg('请输入验证码！');
            return;
        }
        if(!phone){
            layer.msg('请输入手机号！');
            return;
        }
            $.ajax({
                type: 'POST',
                url: '<?php echo url("/index/login/setpwd"); ?>',
                data:{
                    mobile:phone,
                    code:code,
                    password:password,
                },
            dataType:'json',
                success: function(data){
            if(data.type==1){
                layer.msg(data.msg,function(){
                    //关闭后的操作
                    //window.location.href='<?php echo url("/index/user/user"); ?>';
                    window.history.back();
                });
            }else{
                layer.msg(data.msg);
            }


        },
            error: function(xhr){
                layer.msg('error');
            }
        });
        }
</script>
</body>
</html>
