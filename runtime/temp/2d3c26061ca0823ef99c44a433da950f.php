<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:68:"D:\wamp64\www\yyy.com\public/../application/back\view\set\wxset.html";i:1532921423;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>微信设置</title>
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
			<span>微信设置</span>
		</header><!-- /header -->
		<div class="larry-personal-body clearfix">
			<form class="layui-form col-lg-5" action="" method="post">
				<div class="layui-form-item">
					<label class="layui-form-label">公众号名称</label>
					<div class="layui-input-block">
						<input type="text" name="wxname"  autocomplete="off" class="layui-input" value="<?php if(!empty($wxset['wxname'])): ?><?php echo $wxset['wxname']; endif; ?>"  placeholder="输入公众号名称">
						<input type="hidden" name="id" value="<?php if(!empty($wxset['id'])): ?><?php echo $wxset['id']; endif; ?>" >
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">服务器地址</label>
					<div class="layui-input-block">
						<input type="text" disabled  autocomplete="off" class="layui-input" value="http://<?php echo $_SERVER['SERVER_NAME']; ?>/wx">
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">微信号</label>
					<div class="layui-input-block">
						<input type="text" name="weixin"  autocomplete="off" class="layui-input" value="<?php if(!empty($wxset['weixin'])): ?><?php echo $wxset['weixin']; endif; ?>"  placeholder="输入微信号">
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">原始ID</label>
					<div class="layui-input-block">
						<input type="text" name="wxid"  autocomplete="off" class="layui-input" value="<?php if(!empty($wxset['wxid'])): ?><?php echo $wxset['wxid']; endif; ?>"  placeholder="输入原始ID">
					</div>
				</div>
                                
                                <div class="layui-form-item">
                                    <label class="layui-form-label">公众号类型</label>
                                    <div class="layui-input-block">
                                        <select name="type">
                                            <option <?php if(!empty($wxset['type']) && $wxset['type'] == 1): ?>selected=""<?php endif; ?> value="1">订阅号</option>
                                            <option <?php if(!empty($wxset['type']) && $wxset['type'] == 2): ?>selected=""<?php endif; ?> value="2">认证订阅号</option>
                                            <option <?php if(!empty($wxset['type']) && $wxset['type'] == 3): ?>selected=""<?php endif; ?> value="3">服务号</option>
                                            <option <?php if(!empty($wxset['type']) && $wxset['type'] == 4): ?>selected=""<?php endif; ?> value="4">认证服务号</option>
                                        </select><div class="layui-unselect layui-form-select"><div class="layui-select-title"><input type="text" placeholder="请选择" value="订阅号" readonly="" class="layui-input layui-unselect"><i class="layui-edge"></i></div><dl class="layui-anim layui-anim-upbit" style=""><dd lay-value="1" class="layui-this">订阅号</dd><dd lay-value="2" class="">认证订阅号</dd><dd lay-value="3" class="">服务号</dd><dd lay-value="4" class="">认证服务号</dd></dl></div>
                                    </div>
                                </div>
                                <div class="layui-form-item">
					<label class="layui-form-label">token</label>
					<div class="layui-input-block">
                                            <input type="text" name="token"  autocomplete="off" class="layui-input" value="<?php if(!empty($wxset['token'])): ?><?php echo $wxset['token']; endif; ?>" placeholder="输入token">
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">APPID</label>
					<div class="layui-input-block">
						<input type="text" name="appid"  autocomplete="off" class="layui-input" value="<?php if(!empty($wxset['appid'])): ?><?php echo $wxset['appid']; endif; ?>"  placeholder="输入APPID">
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">APPSECRET</label>
					<div class="layui-input-block">
                                            <input type="text" name="appsecret"  autocomplete="off" class="layui-input" value="<?php if(!empty($wxset['appsecret'])): ?><?php echo $wxset['appsecret']; endif; ?>" placeholder="输入APPSECRET">
					</div>
				</div>
                                <div class="layui-form-item">
                                    <label class="layui-form-label">接入状态</label>
                                    <div class="layui-input-block">
                                        <input type="radio" name="wait_access" lay-filter="open" <?php if(!empty($wxset['wait_access']) || $wxset['wait_access'] == 0): ?> checked="checked"<?php endif; ?> value="0" title="等待接入"><div class="layui-unselect layui-form-radio layui-form-radioed"><i class="layui-anim layui-icon"></i><span>等待接入</span></div>
                                        <input type="radio" name="wait_access" lay-filter="open" <?php if(!empty($wxset['wait_access']) && $wxset['wait_access'] == 1): ?> checked="checked"<?php endif; ?> value="1" title="已接入"><div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i><span>已接入</span></div>
                                    </div>
                                </div>
				<div class="layui-form-item">
					<label class="layui-form-label">关注二维码</label>
					<div class="layui-input-block">
						<input type="file" name="file" class="layui-upload-file">
                                                <img style="width: 36px;height: 36px;" class="myimg" src="<?php if(!empty($wxset['qrcord'])) echo imgUrl($wxset['qrcord']);else echo imgUrl('') ?>">
                                                <input type="text"  class="avatar layui-input-block" style="padding-left: 10px;width: 50%;margin-left: 10px;" name="qrcord" value="<?php if(!empty($wxset['qrcord'])): ?><?php echo $wxset['qrcord']; endif; ?>" >
                                        </div>
				</div>
                                <div class="layui-form-item layui-form-text">
                                    <label class="layui-form-label">关注回复</label>
                                    <div class="layui-input-block">
                                        <textarea name="concern" placeholder="请输入关注回复" class="layui-textarea" style="margin-top: 0px; margin-bottom: 0px; height: 101px;"><?php if(!empty($wxset['concern'])): ?><?php echo $wxset['concern']; endif; ?></textarea>
                                    </div>
                                </div>
				<div class="layui-form-item layui-form-text">
                                    <label class="layui-form-label">默认回复</label>
                                    <div class="layui-input-block">
                                        <textarea name="default" placeholder="请输入默认回复" class="layui-textarea"><?php if(!empty($wxset['default'])): ?><?php echo $wxset['default']; endif; ?></textarea>
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