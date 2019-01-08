<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:78:"/home/wwwroot/yang.oioos.com/public/../application/index/view/user/myinfo.html";i:1524038486;s:73:"/home/wwwroot/yang.oioos.com/public/../application/index/view/header.html";i:1526866272;}*/ ?>
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
    <link rel="stylesheet" type="text/css" href="/static/common/layui/css/layui.css" media="all">
</head>
<style>
    
    .height a{
        height: .28rem;
        line-height: .28rem;
    }
    .height span{
        height: .28rem;
        line-height: .28rem;
    }
    .height u{
        height: .28rem;
        line-height: .28rem;
    }
    .height i{
        height: .28rem;
        line-height: .28rem;
    }
</style>
<body style="position:relative;">

    <!--公共头部-->
    <div class="m-head">
        <a href="javascript:;" onclick="javascript:window.history.back();return false;" class="head-goback">
            <i class="fa fa-angle-left"></i>
        </a>
        <p>个人信息</p>
    </div>
    <!--公共头部结束-->
    <!--内容主体-->
    <div class="m-myinfo">
        <!--信息列表-->
        <ul class="myinfo-list">
            <li>
                <a href="javascript:;">
                    <span  style="margin:0.2rem;">头像</span>
                    <i   style="margin:0.2rem;" class="fa fa-angle-right"></i>
                    <u>
                        <input type="hidden"  class="avatar" value="" >
<!--                        <img src="<?php if(!empty($member['avatar'])) echo imgUrl($member['avatar']);else echo imgUrl('') ?>" />-->
                        <img style="width: 36px;height: 36px;display:inline;" class="myimg" src="<?php if(!empty($member['avatar'])) echo imgUrl($member['avatar']);else echo imgUrl('') ?>">
                        <input type="file" name="file" class="layui-upload-file">
                    </u>
                </a>
            </li>
            <li class="height">
                <a href="<?php echo url('/index/user/perfectinfo'); ?>">
                    <span>昵称</span>
                    <i class="fa fa-angle-right"></i>
                    <u><?php echo $member['username']; ?></u>
                </a>
            </li>
            <li class="height">
                <a href="javascript:;">
                    <span>是否绑定手机号：</span>
                    <u><?php if(!empty($member['mobile'])): ?><span onclick="window.location='/index/user/cgphone/agentid/<?php echo $member['id']; ?>.html'"><?php echo $member['mobile']; ?> <i class="fa fa-angle-right" style="font-size: 0.3rem"></i></span><?php else: ?><span onclick="window.location='/index/user/cgphone/agentid/<?php echo $member['id']; ?>.html'">点击绑定 <i class="fa fa-angle-right" style="font-size: .3rem"></i></span><?php endif; ?></u>
                </a>
            </li>
            <li class="height">
                <a href="javascript:;">
                    <span>是否绑定微信号：</span>
                    <u><?php if(!empty($member['openid'])): ?>已绑定 <?php else: ?> <span onclick="window.location='/index/login/login/state/wxbd/agentid/<?php echo $member['id']; ?>.html'">点击绑定 <i class="fa fa-angle-right" style="font-size: 0.3rem"></i></span><?php endif; ?></u>
                </a>
            </li>
        </ul>
        <!--信息列表结束-->
        <!--退出按钮-->
        <a href="/index/login/login?exit=1" class="myinfo-btn">退出登录</a>
        <!--退出按钮结束-->
    </div>
    <!--内容主体结束-->
    <script type="text/javascript" src="/static/common/layui/layui.js"></script>
<script type="text/javascript" src="/static/js/jquery.min.js"></script>
<script type="text/javascript">
        
	layui.use(['form','upload'],function(){
         layui.upload({ 
             url: '/server/fileupload.php',//上传接口 
             success: function(res){
                if(res.result){
                    $('.avatar').val(res.result);
                    $('.myimg').attr('src','/server/'+res.result);   
                    //如果上次成功的话替换头像
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo url("/index/user/setimg"); ?>',
                        data:{
                            avatar:$('.avatar').val(),
                        },
                        dataType:'json',
                        success: function(data){
                            if(data.type==1){
                                layer.msg(data.msg);
                                window.location.href='<?php echo url("/index/user/user"); ?>'
                            }else{
                                layer.msg(data.msg);
                            }
                        },
                        error: function(xhr){
                            layer.msg('error');
                        }
                    });
                }else{
                    alert('上传失败');
                }
              console.log(res.result) 
            } 
         });

	});
</script>
</body>
</html>
