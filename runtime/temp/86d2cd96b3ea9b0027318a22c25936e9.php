<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:77:"E:\phpStudy\WWW\yyy.com\public/../application/back\view\set\contractset1.html";i:1525316614;}*/ ?>
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
			<span>合同设置</span>
		</header><!-- /header -->
		<div class="larry-personal-body clearfix">
			<form class="layui-form col-lg-5" action="" method="post">
				<div class="layui-form-item">
					<label class="layui-form-label">甲方姓名</label>
					<div class="layui-input-block">
						<input type="text" name="parameter[]"  autocomplete="off" class="layui-input" value="<?php if(!empty($contractset['parameter']['0'])): ?><?php echo $contractset['parameter']['0']; endif; ?>"  placeholder="输入坐标，举个栗子：123,321">
						<input type="hidden" name="id" value="<?php if(!empty($contractset['id'])): ?><?php echo $contractset['id']; endif; ?>" >
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">甲方ID号码</label>
					<div class="layui-input-block">
						<input type="text" name="parameter[]"  autocomplete="off" class="layui-input" value="<?php if(!empty($contractset['parameter']['1'])): ?><?php echo $contractset['parameter']['1']; endif; ?>"  placeholder="输入坐标，举个栗子：123,321">

					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">身份证号码</label>
					<div class="layui-input-block">
						<input type="text" name="parameter[]"  autocomplete="off" class="layui-input" value="<?php if(!empty($contractset['parameter']['2'])): ?><?php echo $contractset['parameter']['2']; endif; ?>"  placeholder="输入坐标，举个栗子：123,321">
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">手机号码</label>
					<div class="layui-input-block">
						<input type="text" name="parameter[]"  autocomplete="off" class="layui-input" value="<?php if(!empty($contractset['parameter']['3'])): ?><?php echo $contractset['parameter']['3']; endif; ?>"  placeholder="输入坐标，举个栗子：123,321">
					</div>
				</div>
                                
				<div class="layui-form-item">
					<label class="layui-form-label">乙方姓名</label>
					<div class="layui-input-block">
						<input type="text" name="parameter[]"  autocomplete="off" class="layui-input" value="<?php if(!empty($contractset['parameter']['4'])): ?><?php echo $contractset['parameter']['4']; endif; ?>"  placeholder="输入坐标，举个栗子：123,321">
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">乙方ID号码</label>
					<div class="layui-input-block">
						<input type="text" name="parameter[]"  autocomplete="off" class="layui-input" value="<?php if(!empty($contractset['parameter']['5'])): ?><?php echo $contractset['parameter']['5']; endif; ?>"  placeholder="输入坐标，举个栗子：123,321">
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">乙方身份证号码</label>
					<div class="layui-input-block">
                                            <input type="text" name="parameter[]"  autocomplete="off" class="layui-input" value="<?php if(!empty($contractset['parameter']['6'])): ?><?php echo $contractset['parameter']['6']; endif; ?>" placeholder="输入坐标，举个栗子：123,321">
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">乙方手机号码</label>
					<div class="layui-input-block">
						<input type="text" name="parameter[]"  autocomplete="off" class="layui-input" value="<?php if(!empty($contractset['parameter']['7'])): ?><?php echo $contractset['parameter']['7']; endif; ?>" placeholder="输入坐标，举个栗子：123,321">
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">羊只耳号</label>
					<div class="layui-input-block">
						<input type="text" name="parameter[]"  autocomplete="off" class="layui-input" value="<?php if(!empty($contractset['parameter']['8'])): ?><?php echo $contractset['parameter']['8']; endif; ?>" placeholder="输入坐标，举个栗子：123,321">
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">协议单号</label>
					<div class="layui-input-block">
						<input type="text" name="parameter[]"  autocomplete="off" class="layui-input" value="<?php if(!empty($contractset['parameter']['9'])): ?><?php echo $contractset['parameter']['9']; endif; ?>" placeholder="输入坐标，举个栗子：123,321">
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">合同背景</label>
					<div class="layui-input-block">
						<input type="file" name="file" class="layui-upload-file">
                                                <img style="width: 36px;height: 36px;" class="myimg" src="<?php if(!empty($contractset['background'])) echo imgUrl($contractset['background']);else echo imgUrl('') ?>">
                                                <input type="text"  placeholder="背景必须是png格式"  class="avatar layui-input-block" style="padding-left: 10px;width: 50%;margin-left: 10px;" name="background" value="<?php if(!empty($contractset['background'])): ?><?php echo $contractset['background']; endif; ?>" >
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