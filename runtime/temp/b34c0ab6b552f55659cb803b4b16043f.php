<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:82:"/home/wwwroot/yang.oioos.com/public/../application/index/view/user/cgpassword.html";i:1517538520;s:73:"/home/wwwroot/yang.oioos.com/public/../application/index/view/header.html";i:1526866272;}*/ ?>
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
        <p><?php if(empty($member['password'])): ?>添加<?php else: ?>修改<?php endif; ?>密码</p>
    </div>
    <!--公共头部结束-->
    <!--内容主体-->
    <div class="m-cgphone">
        <!--信息输入-->
        <div class="cgphone-entry">
            <?php if(!empty($member['password'])): ?>
            <div class="entry-box">
                <i class="fa fa-lock box-icon"></i>
                <input type="password" placeholder="请输入旧密码" class="writetxt olbpassword" />
            </div>
            <?php endif; ?>
            <div class="entry-box">
                <i class="fa fa-lock box-icon"></i>
                <input type="password" placeholder="请输入新密码" class="writetxt newpassword" />
            </div>
            <div class="entry-box">
                <i class="fa fa-lock box-icon"></i>
                <input type="password" placeholder="请确认新密码" class="writetxt newpassword2" />
            </div>
        </div>
        <!--信息输入结束-->
        <!--确认按钮-->
        <a href="javascript:setPassword();" class="cgphone-btn">确认修改</a>
        <!--确认按钮结束-->
    </div>
    <!--内容主体结束-->
    <script>
        
        function setPassword(){
            var olbpassword = $('.olbpassword').val();
            var newpassword = $('.newpassword').val();
            var newpassword2 = $('.newpassword2').val();
            if(newpassword==olbpassword){
                layer.msg('旧密码与新密码相同，无须修改！');
                return;
            }
            if(newpassword!=newpassword2){
                layer.msg('两次密码输入不一致！');
                return;
            }
            $.ajax({
                type: 'POST',
                url: '<?php echo url("/index/user/setpassword"); ?>',
                data:{
                    olbpassword:olbpassword,
                    newpassword:newpassword
                },
                dataType:'json',
                success: function(data){
                    if(data.type==1){
                        layer.msg(data.msg);
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