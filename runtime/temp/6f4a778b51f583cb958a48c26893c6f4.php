<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:72:"E:\phpStudy\WWW\yyy.com\public/../application/back\view\admin\index.html";i:1519047070;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>个人信息</title>
	<meta name="renderer" content="webkit">	
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">	
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">	
	<meta name="apple-mobile-web-app-status-bar-style" content="black">	
	<meta name="apple-mobile-web-app-capable" content="yes">	
	<meta name="format-detection" content="telephone=no">	
	<link rel="stylesheet" type="text/css" href="/static/common/layui/css/layui.css" media="all">
	<link rel="stylesheet" type="text/css" href="/static/common/bootstrap/css/bootstrap.css" media="all">
	<link rel="stylesheet" type="text/css" href="/static/common/global.css" media="all">
	<link rel="stylesheet" type="text/css" href="/static/css/personal.css" media="all">
</head>
<body>
<section class="layui-larry-box">
	<div class="larry-personal">
		<header class="larry-personal-tit">
			<span>个人信息</span>
                        <div class="larry-side-menu" onclick="javascript:location.reload();" style="    position: absolute;    cursor: pointer;    z-index: 19490201;    right:  100px;    color: white;    text-align: center;    width: 30px;    height: 30px;    background-color: #1AA094;    line-height: 30px;    top: 6%;">
                                <i class="fa " aria-hidden="true">刷新</i>
                        </div>
<!--                        <div class="larry-side-menu" onclick="javascript:window.opener=null;window.open('','_self');window.close();" style="    position: absolute;    cursor: pointer;    z-index: 19490201;    right:  50px;    color: white;    text-align: center;    width: 30px;    height: 30px;    background-color: #FF0033;    line-height: 30px;    top: 6%;">
                                <i class="fa " aria-hidden="true">关闭</i>
                        </div>-->

		</header><!-- /header -->
		<div class="larry-personal-body clearfix">
			<form class="layui-form col-lg-5" action="" method="post">
				<div class="layui-form-item">
					<label class="layui-form-label">用户名</label>
					<div class="layui-input-block">  
						<input type="text" name="username"  autocomplete="off"  class="layui-input layui-disabled" value="<?php if(!empty($admininfo['username'])): ?><?php echo $admininfo['username']; endif; ?>" disabled="disabled" >
					</div>
				</div>
                                <div class="layui-form-item">
					<label class="layui-form-label">所属角色</label>
					<div class="layui-input-block">
						<input type="text" name="level"  autocomplete="off" class="layui-input layui-disabled" value="超级管理员" disabled="disabled">
					</div>
				</div>
                                <div class="layui-form-item">
					<label class="layui-form-label">所属角色</label>
					<div class="layui-input-block">
						<select name="level2" lay-filter="aihao">
							<option value="1">超级管理员</option>
							<option value="2" selected="selected">管理员</option>
							<option value="3">财务</option>
							<option value="4">仓管</option>
						</select>
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">真实姓名</label>
					<div class="layui-input-block">
						<input type="text" name="realname"  autocomplete="off" class="layui-input" value="<?php if(!empty($admininfo['realname'])): ?><?php echo $admininfo['realname']; endif; ?>"  placeholder="输入真实姓名">
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">手机号码</label>
					<div class="layui-input-block">
                                            <input type="text" name="tel"  autocomplete="off" class="layui-input" value="<?php if(!empty($admininfo['tel'])): ?><?php echo $admininfo['tel']; endif; ?>" placeholder="输入手机号码">
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">邮箱</label>
					<div class="layui-input-block">
                                            <input type="text" name="email"  autocomplete="off" class="layui-input" value="<?php if(!empty($admininfo['email'])): ?><?php echo $admininfo['email']; endif; ?>" placeholder="输入邮箱号码">
                                        </div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">修改头像</label>
					<div class="layui-input-block">
						<input type="file" name="file" class="layui-upload-file">
                                                <img style="width: 36px;height: 36px;" class="myimg" src="<?php if(!empty($admininfo['avatar'])) echo imgUrl($admininfo['avatar']);else echo imgUrl('') ?>">
                                                <input type="text"  class="avatar layui-input-block" style="padding-left: 10px;width: 50%;margin-left: 10px;" name="avatar" value="<?php if(!empty($admininfo['avatar'])): ?><?php echo $admininfo['avatar']; endif; ?>" >
                                        </div>
				</div>
				<div class="layui-form-item">
					<div class="layui-input-block">
						<button class="layui-btn" onclick="upadmin()" >立即提交</button>
						<button type="reset" class="layui-btn layui-btn-primary">重置</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>
<script type="text/javascript" src="/static/common/layui/layui.js"></script>
<script type="text/javascript" src="/static/js/jquery.min.js"></script>
<script>
        function upadmin(){
            var realname = $("input[name='realname']").val();
            var tel = $("input[name='tel']").val();
            var email = $("input[name='email']").val();
            var avatar = $("input[name='avatar']").val();
            $.ajax({
                type:'post',
                url:'<?php echo url("/back/admin/upadmin"); ?>',
                data:{
                    realname:realname,
                    tel:tel,
                    email:email,
                    avatar:avatar
                },
                datatype:'json',
                success: function(data){
                    if(data.type==1){
                        layer.msg(data.msg);
                    }else{
                        layer.msg(data.msg);
                    }  
                },
            });
        }
</script>
<script type="text/javascript">
	layui.use(['form','upload'],function(){
         layui.upload({ 
             url: '/server/fileupload.php',//上传接口 
             success: function(res){
                if(res.result){
                    $('.avatar').val(res.result);
                    $('.myimg').attr('src','/server/'+res.result);                    
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