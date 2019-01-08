<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:76:"/home/wwwroot/yang.oioos.com/public/../application/index/view/login/reg.html";i:1522218048;s:73:"/home/wwwroot/yang.oioos.com/public/../application/index/view/header.html";i:1526866272;}*/ ?>
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
        <p>注册</p>
    </div>
    <!--公共头部结束-->
    <!--内容主体-->
    <div class="m-register">
        <!--公司logo-->
        <img src="/static/home/images/logo.jpg" class="register-logo" />
        <!--公司logo结束-->
        
        <!--昵称-->
        <div class="register-name">
            <input name="username" class="usernameval" required="required" type="text" placeholder="您的昵称" />
        </div>
        <!--昵称结束-->
        <!--信息输入-->
        <div class="register-entry">
            <div class="entry-box">
                <i class="fa fa-mobile box-icon"></i>
                <input name="mobile"  type="text" required="required" placeholder="请输入手机号" class="writetxt phoneNumb" />
            </div>
            <div class="entry-box">
                <i class="fa fa-lock box-icon"></i>
                <input name="password" type="password" required="required" placeholder="请输入登录密码" class="writepswd passwordval" />
            </div>
            <div class="entry-box">
                <i class="fa fa-lock box-icon"></i>
                <input name="password2" type="password" required="required" placeholder="请再次输入密码" class="writepswd password2val" />
            </div>
            <div class="entry-box">
                <input type="text" placeholder="请输入验证码" required="required" class="writenumb codeval" />
                <input type="button" value="点击获取验证码" class="obtainCode" onclick="getSms()" />
            </div>
            <div class="entry-box">
                <i class="fa fa-envira box-icon" style="color: #f66c48;"></i>
                <input type="text" name="mycode" placeholder="请输入邀请码" value="<?php if(!empty($mycode)): ?><?php echo $mycode; elseif(!empty($_COOKIE['mycode'])): ?><?php echo $_COOKIE['mycode']; endif; ?>" class="writetxt" />
            </div>
        </div>
        <!--信息输入结束-->
        <!--登录按钮-->
        <input type="button"  onclick="setReg()" class="register-btn" value="确认注册" />
        <!--登录按钮结束-->
      
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
                        phone:phone
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
                        //layer.msg('error');
                    }
                });
                resetCode(); //倒计时
            }
        }
        function setReg() {
            checkPhone(); //验证手机号
            if (isPhone) {
                var phone = $('.phoneNumb').val();
                var username = $('.usernameval').val();
                var password = $('.passwordval').val();
                var password2 = $('.password2val').val();
                var code = $('.codeval').val();
                var mycode = $("input[name='mycode']").val();
                if(username=='' || username==null){
                    layer.msg('昵称不能为空！');
                    return ;
                }
                $.ajax({
                    type: 'POST',
                    url: '<?php echo url("/index/login/reg"); ?>',
                    data:{
                        mobile:phone,
                        username:username,
                        password:password,
                        password2:password2,
                        code:code,
                        mycode:mycode,
                    },
                    dataType:'json',
                    success: function(data){
                        if(data.type==1){
                            layer.msg(data.msg,function(){
                            //关闭后的操作
                            window.location.href='/index/login/login';
                            });
                        }else{
                            layer.msg(data.msg);
                        }
                    },
                    error: function(xhr){
                        layer.msg('error');
                    }
                });
                resetCode(); //倒计时
            }
        }
    </script>
</body>
</html>
