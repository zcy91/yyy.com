<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:78:"/home/wwwroot/yang.oioos.com/public/../application/index/view/login/login.html";i:1526116768;s:73:"/home/wwwroot/yang.oioos.com/public/../application/index/view/header.html";i:1526866272;}*/ ?>
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
    <script src="/static/home/mui/mui.min.js"></script>
</head>
<script src="/static/js/modernizr.js"></script>
<link href="/static/css/checkbox/default.css" rel="stylesheet" />
<link href="/static/css/checkbox/ie8.css" rel="stylesheet" />
<link href="/static/css/checkbox/inserthtml.com.radios.css" rel="stylesheet" />
<link href="/static/css/checkbox/normalize.css" rel="stylesheet" />
<link href="/static/css/checkbox/styles.css" rel="stylesheet" />
<body style="position:relative;">

    <!--公共头部-->
    <div class="m-head">
        <a href="javascript:;" onclick="back123()" class="head-goback">

            <i class="fa fa-angle-left"></i>
        </a>
        <p>登录</p>
    </div>
    <!--公共头部结束-->
    <!--内容主体-->
    <div class="m-login">
        <!--公司logo-->
        <img src="/static/home/images/logo.jpg" class="login-logo" />
        <!--公司logo结束-->
        <!--信息输入-->
        <div class="login-entry">
            <div class="entry-box">
                <i class="fa fa-user box-icon"></i>
                <input name="mobile" type="text" placeholder="请输入手机号" />
            </div>
            <div class="entry-box">
                <i class="fa fa-lock box-icon"></i>
                <input name="password" type="password" placeholder="请输入登录密码" />
            </div>
            <!--<input type="checkbox" name="autologin"  value="1">-->

            <div class="holder" style="background: white;">
                <div class="center">
                    <label>
                    <label style="font-size: 0.25rem;color: #808080;">一周内自动登录</label>
                   <input type="checkbox" id="checkbox-10-1" name="autologin" value="1" style="display: none!important;"/>
                    <label for="checkbox-10-1"></label>
                    </label>
                </div>
            </div>
            <div class="entry-link" style="width: 35%">
                <a href="<?php echo url('/index/login/reg'); ?>?agentid=<?php if(!empty($_COOKIE['mycode'])): ?><?php echo $_COOKIE['mycode']; elseif(!empty($mycode)): ?><?php echo $mycode; endif; ?>" class="link-left" style="margin-bottom: 1px"><i class="fa fa-pencil-square"></i> 快速注册</a>
                <span id="loginbtn"></span>
            </div>
            
        </div>
        <!--信息输入结束-->
        <!--登录按钮-->
        <a href="javascript:;"  onclick="gologin()" class="login-btn">确认登录</a>
        <!--登录按钮结束-->
    </div>
    <!--内容主体结束-->
     <script>
         window.onload=function(){
             // layer.msg('1',{anim:0});
         }
         /*function weixinlogin() {
             var autologin = $("input[name='autologin']:checked").val();
             if(!autologin){
                 var autologin = 0;
             }
             $.ajax({
                 type: 'POST',
                 url: '<?php echo url("/index/login/login"); ?>',
                 data:{
                     autologin:autologin,
                     state:'wx'
                 },
                 dataType:'json',

             });
             resetCode(); //倒计时
         }*/

        function gologin() {
                var mobile = $('input[name="mobile"]').val();
                var password = $('input[name="password"]').val();
                var autologin = $("input[name='autologin']:checked").val();
                if(!autologin){
                    var autologin = 0;
                }
                $.ajax({
                    type: 'POST',
                    url: '<?php echo url("/index/login/login"); ?>',
                    data:{
                        mobile:mobile,
                        password:password,
                        autologin:autologin
                    },
                    dataType:'json',
                    success: function(data){
                        if(data.type==1) {
                            layer.msg(data.msg, {anim: 0}, function () {
                                //关闭后的操作
                                window.location.href = '/index/index/index/agentid/' + data.user_id + '.html';
                            });
                        }else if(data.type == 2){
                                layer.msg(data.msg,{anim:0},function(){
                                    //关闭后的操作
                                    window.location.href='/index/user/setup/agentid/'+data.user_id+'.html';
                                });

                        }else{
                            layer.msg(data.msg,{anim:6});
                        }
                    },
                    error: function(xhr){
                        layer.msg('error');
                    }
                });
                resetCode(); //倒计时
            }
    </script>
<script type="text/javascript" charset="utf-8">
	var str = navigator.userAgent;
    var autologin = $("input[name='autologin']:checked").val();
    if(!autologin){
        var autologin = 0;
    }
    if(typeof(yangJs) != 'undefined'){
        yangJs.logout();
        document.getElementById("loginbtn").innerHTML = '<a href="javascript:yangJs.loginByWx();" class="link-right"  id="weixin"><i class="fa fa-wechat"></i>微信登录</a>'

    }
    else if(str.indexOf("Html5Plus") == -1){
	    document.getElementById("loginbtn").innerHTML = '<a href="<?php echo url('/index/login/login',array('state'=>'wx')); ?>" class="link-right"><i class="fa fa-wechat"></i>微信登录</a>'
    }else{
	    document.getElementById("loginbtn").innerHTML = '<a href="javascript:;" class="link-right"  id="weixin"><i class="fa fa-wechat"></i>微信登录</a>'
		
		        // 获取用户头像标签 
        //var headImage = document.getElementById('headImage'); 
 var auths='';
        mui.init({ 
            swipeBack:true //启用右滑关闭功能 
        }); 
 
        mui.plusReady(function() {
	        //var info = plus.push.getClientInfo();
			
            plus.oauth.getServices(function(services) { 
                auths = services; 
            }, function(e) { 
                mui.alert("获取登录服务列表失败：" + e.message + " - " + e.code); 
            }); 
        })
        
		var wxbtn = document.getElementById('weixin');
        wxbtn.addEventListener('tap',function() {
	        wxbtn.id='';
            authLogin('weixin');
            wxbtn.id='weixin';
		})
 
        // 登录操作 
        function authLogin(type) { 
            var s; 
            for (var i = 0; i < auths.length; i++) { 
                if (auths[i].id == type) { 
                    s = auths[i]; 
                    break; 
                } 
            } 
            if (!s.authResult) {
                s.login(function(e) { 
                    mui.toast("登录认证成功！"); 
                    authUserInfo(type); 
                }, function(e) { 
                    mui.toast(JSON.stringify(e)+"登录认证失败！"); 
                }); 
            } else { 
                mui.toast("已经登录认证！"); 
            } 
        } 
        //注销 
        function authLogout() { 
            for (var i in auths) { 
                var s = auths[i]; 
                if (s.authResult) { 
                    s.logout(function(e) { 
                        console.log("注销登录认证成功！"); 
                    }, function(e) { 
                        console.log("注销登录认证失败！"); 
                    }); 
                } 
            } 
        } 
        // 微信登录认证信息 
        function authUserInfo(type) {
            var autologin = $("input[name='autologin']:checked").val();
            if(autologin){
	            var url = "<?php echo url('/index/login/login',array('state'=>'app','autologin'=>'1')); ?>";
            }else{
	             var url = "<?php echo url('/index/login/login',array('state'=>'app','autologin'=>'0')); ?>";
            }
            var s; 
            for (var i = 0; i < auths.length; i++) { 
                if (auths[i].id == type) { 
                    s = auths[i]; 
                    break; 
                } 
            } 
            if (!s.authResult) { 
                mui.toast("未授权登录！"); 
            } else { 
                s.getUserInfo(function(e) {
                    var josnStr = JSON.stringify(s.userInfo); 
                    console.log("获取用户信息成功：" + josnStr); 
                    mui.ajax(url,{
							data:s.userInfo,
							dataType:'json',
							type:'post',
							timeout:6000,
							success:function(data){
								console.log(JSON.stringify(data));
								if(data.code){
                                                                    if(data.code==1){
                                                                        window.location.href = '/index/user/cgphone';
                                                                    }else{
                                                                        window.location.href = '/index/index/index';
                                                                    }
								}else{
									mui.alert('注册失败，请联系管理员');
								}
							},
							error:function(xhr,type,errorThrown){
								mui.alert(type);
							}
						});
                    //showData(type,s.userInfo); 
                    authLogout();
                }, function(e) { 
                    mui.alert("获取用户信息失败：" + e.message + " - " + e.code); 
                }); 
            } 
        } 
        // 显示用户头像信息 
        function showData(type,data) { 
            /*switch (type){
                case 'weixin': 
                    headImage.src = data.headimgurl; 
                    break; 
                case 'qq': 
                    headImage.src = data.figureurl_qq_2; 
                    break; 
                default: 
                    break; 
            } */
        } 
	}
        
	function back123() {
        var url = "<?php echo url('index/index/index'); ?>";
        window.location.href=url;
    }

    </script> 
</body>
</html>