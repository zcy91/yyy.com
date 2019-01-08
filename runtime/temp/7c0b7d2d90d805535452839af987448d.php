<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:77:"/home/wwwroot/yang.oioos.com/public/../application/back/view/set/setting.html";i:1519623160;}*/ ?>
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
			<span>网站信息</span>
		</header><!-- /header -->
		<div class="larry-personal-body clearfix">
			<form class="layui-form col-lg-5" action="" method="post">
				<div class="layui-form-item">
					<label class="layui-form-label">网站名称</label>
					<div class="layui-input-block">
						<input type="text" name="name"  autocomplete="off" class="layui-input" value="<?php if(!empty($setting['name'])): ?><?php echo $setting['name']; endif; ?>"  placeholder="输入网站名称">
						<input type="hidden" name="id" value="<?php if(!empty($setting['id'])): ?><?php echo $setting['id']; endif; ?>" >
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">网站域名</label>
					<div class="layui-input-block">
						<input type="text" name="url"  autocomplete="off" class="layui-input" value="<?php if(!empty($setting['url'])): ?><?php echo $setting['url']; endif; ?>"  placeholder="输入网站域名">
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">关键字</label>
					<div class="layui-input-block">
						<input type="text" name="key"  autocomplete="off" class="layui-input" value="<?php if(!empty($setting['key'])): ?><?php echo $setting['key']; endif; ?>"  placeholder="输入关键字">
					</div>
				</div>
                                
                                <div class="layui-form-item layui-form-text">
					<label class="layui-form-label">描述</label>
					<div class="layui-input-block">
						<textarea name="des" placeholder="微信公众平台、APP移动应用设计、HTML5网站API定制开发。大型企业网站、个人博客论坛、手机网站定制开发。更高效、更快捷的进行定制开发。" value="" class="layui-textarea"><?php if(!empty($setting['des'])): ?><?php echo $setting['des']; endif; ?></textarea>
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">备案号</label>
					<div class="layui-input-block">
						<input type="text" name="bah"  autocomplete="off" class="layui-input" value="<?php if(!empty($setting['bah'])): ?><?php echo $setting['bah']; endif; ?>"  placeholder="输入备案号">
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">管理员邮箱</label>
					<div class="layui-input-block">
						<input type="text" name="email"  autocomplete="off" class="layui-input" value="<?php if(!empty($setting['email'])): ?><?php echo $setting['email']; endif; ?>"  placeholder="输入管理员邮箱">
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">管理员手机</label>
					<div class="layui-input-block">
                                            <input type="text" name="tel"  autocomplete="off" class="layui-input" value="<?php if(!empty($setting['tel'])): ?><?php echo $setting['tel']; endif; ?>" placeholder="输入手机号码">
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">注册虚增</label>
					<div class="layui-input-block">
                                            <input type="text" name="reg_num"  autocomplete="off" class="layui-input" value="<?php if(!empty($setting['reg_num'])): ?><?php echo $setting['reg_num']; endif; ?>" placeholder="输入注册虚增">
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">出栏虚增</label>
					<div class="layui-input-block">
                                            <input type="text" name="sold_num"  autocomplete="off" class="layui-input" value="<?php if(!empty($setting['sold_num'])): ?><?php echo $setting['sold_num']; endif; ?>" placeholder="输入存栏虚增">
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">存栏总数</label>
					<div class="layui-input-block">
                                            <input type="text" name="stock_num"  autocomplete="off" class="layui-input" value="<?php if(!empty($setting['stock_num'])): ?><?php echo $setting['stock_num']; endif; ?>" placeholder="输入出栏总数">
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">logo</label>
					<div class="layui-input-block">
						<input type="file" name="file" class="layui-upload-file">
                                                <img style="width: 36px;height: 36px;" class="myimg" src="<?php if(!empty($setting['logo'])) echo imgUrl($setting['logo']);else echo imgUrl('') ?>">
                                                <input type="text"  class="avatar layui-input-block" style="padding-left: 10px;width: 50%;margin-left: 10px;" name="logo" value="<?php if(!empty($setting['logo'])): ?><?php echo $setting['logo']; endif; ?>" >
                                        </div>
				</div>

				
				
				<div class="layui-form-item">
					<div class="layui-input-block">
						<button type="submit" class="layui-btn" lay-submit="" lay-filter="demo1">立即提交</button>
						<button type="reset" class="layui-btn layui-btn-primary">重置</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>
<script type="text/javascript" src="/static/common/layui/layui.js"></script>
<script type="text/javascript" src="/static/js/jquery.min.js"></script>
<script type="text/javascript">
	layui.use(['form','upload'],function(){
         var form = layui.form();
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