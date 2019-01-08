<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:77:"E:\phpStudy\WWW\yyy.com\public/../application/back\view\tuisong\touchuan.html";i:1522216590;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>推送通知</title>
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
			<span>透传消息 - 	(必填) [ 2小时内在前台运行的所有APP会立即收到通知]</span>
		</header>
		<div class="larry-personal-body clearfix">
			<form class="layui-form col-lg-5" action="" method="post">
				<div class="layui-form-item">
					<label class="layui-form-label">消息标题</label>
					<div class="layui-input-block">
						<input type="text" name="touchuan_title"  autocomplete="off" class="layui-input" value="<?php if(!empty($tuisong['touchuan_title'])): ?><?php echo $tuisong['touchuan_title']; endif; ?>"  placeholder="输入消息标题">
					</div>
				</div>
                                
                <div class="layui-form-item layui-form-text">
					<label class="layui-form-label">消息内容</label>
					<div class="layui-input-block">
						<textarea name="touchuan_content" placeholder="输入消息内容" value="" class="layui-textarea"><?php if(!empty($tuisong['touchuan_content'])): ?><?php echo $tuisong['touchuan_content']; endif; ?></textarea>
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">透传数据</label>
					<div class="layui-input-block">
						<input type="text" name="playload"  autocomplete="off" class="layui-input" value="<?php if(!empty($tuisong['touchuan_playload'])): ?><?php echo $tuisong['touchuan_playload']; endif; ?>"  placeholder="输入透传数据的URL，如：http://yang.oioos.com/index/shop/glist.html">
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
<!--<script type="text/javascript" src="/static/common/layui/layui.js"></script>-->
<!--<script type="text/javascript" src="/static/js/jquery.min.js"></script>-->
<script type="text/javascript">
	
</script>
</body>
</html>