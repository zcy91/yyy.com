<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:89:"/home/wwwroot/yang.oioos.com/public/../application/index/view/user/dengluhoubangding.html";i:1521688422;s:73:"/home/wwwroot/yang.oioos.com/public/../application/index/view/header.html";i:1526866272;}*/ ?>
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
        <p>绑定手机号</p>
    </div>
    <!--公共头部结束-->
    <!--内容主体-->
    <div class="m-cgphone">
        <!--信息输入-->
        <div class="cgphone-entry">
            <div class="entry-box">
                <i class="fa fa-mobile box-icon"></i>
                <input type="text" placeholder="请输入手机号" class="writetxt phoneNumb" />
            </div>
            <?php if(empty($member['password'])): ?>
                <div class="entry-box">
                    <i class="fa fa-lock box-icon"></i>
                    <input type="password" placeholder="请输入登录密码" class="writetxt newpassword" />
                </div>
                <div class="entry-box">
                    <i class="fa fa-lock box-icon"></i>
                    <input type="password" placeholder="请确认登录密码" class="writetxt newpassword2" />
                </div>
            <?php endif; ?>
            <div class="entry-box">
                <i class="fa fa-user box-icon"></i>
                <input type="text" placeholder="请输入真实姓名" class="writetxt realname" />
            </div>
            <div class="entry-box">
                <input type="text" placeholder="请输入验证码" class="writenumb" />
                <input type="button" value="点击获取验证码" class="obtainCode" onclick="getSms()" />
            </div>
        </div>
        <!--信息输入结束-->
        <!--确认按钮-->
        <a href="javascript:setMobile();" class="cgphone-btn">确认修改</a>
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
            var realname = $('.realname').val();
            <?php if(empty($member['password'])): ?>
                var password = $('.newpassword').val();
                var password2 = $('.newpassword2').val();
                if(password!=password2){
                    layer.msg('两次密码输入不一致！');
                    return;
                }
                <?php endif; ?>
            $.ajax({
                type: 'POST',
                url: '<?php echo url("/index/user/setmobile"); ?>',
                data:{
	                realname:realname,
                    mobile:phone,
                    code:code,
                    
                        <?php if(empty($member['password'])): ?>
                        password:password,
                        <?php endif; ?>
                },
                dataType:'json',
                success: function(data){
                    if(data.type==1){
                        layer.msg(data.msg,function(){
                            //关闭后的操作
                            window.location.href='<?php echo url("/index/user/user"); ?>';
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
