<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:78:"E:\phpStudy\WWW\yyy.com\public/../application/back\view\user\userleveladd.html";i:1517981690;}*/ ?>
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
		</header><!-- /header -->
		<div class="larry-personal-body clearfix">
			<form class="layui-form col-lg-5" action="" method="post">
				<div class="layui-form-item">
					<label class="layui-form-label">名称</label>
					<div class="layui-input-block">
						<input type="text" name="name"  autocomplete="off" class="layui-input" value="<?php if(!empty($mymember_level['name'])): ?><?php echo $mymember_level['name']; endif; ?>"  placeholder="输入分类名称">
						<input type="hidden" name="id" value="<?php if(!empty($mymember_level['id'])): ?><?php echo $mymember_level['id']; endif; ?>" >
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">等级</label>
					<div class="layui-input-block">
                                            <input type="text" name="level"  autocomplete="off" class="layui-input" value="<?php if(!empty($mymember_level['level'])): ?><?php echo $mymember_level['level']; endif; ?>" placeholder="输入等级">
					</div>
				</div>
                                <div class="layui-form-item">
					<label class="layui-form-label">推荐奖</label>
					<div class="layui-input-block">
						<input type="radio" name="isrecommend" value="1" title="开启" <?php if(!empty($mymember_level['isrecommend'])): if($mymember_level['isrecommend'] == 1): ?>checked=""<?php endif; else: ?>checked=""<?php endif; ?>><div class="layui-unselect layui-form-radio layui-form-radioed"><i class="layui-anim layui-icon"></i><span>男</span></div>
						<input type="radio" name="isrecommend" value="0" title="关闭" <?php if(!empty($mymember_level)): if($mymember_level['isrecommend'] == 0): ?>checked=""<?php endif; endif; ?>><div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i><span>女</span></div>
					</div>
				</div>
                                <div class="layui-form-item">
					<label class="layui-form-label">推荐奖类型</label>
					<div class="layui-input-block">
						<input type="radio" name="recommend_type" value="1" title="送余额" <?php if(!empty($mymember_level['recommend_type'])): if($mymember_level['recommend_type'] == 1): ?>checked=""<?php endif; else: ?>checked=""<?php endif; ?>><div class="layui-unselect layui-form-radio layui-form-radioed"><i class="layui-anim layui-icon"></i><span>男</span></div>
						<input type="radio" name="recommend_type" value="2" title="送积分" <?php if(!empty($mymember_level['recommend_type'])): if($mymember_level['recommend_type'] == 2): ?>checked=""<?php endif; endif; ?>><div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i><span>女</span></div>
						<input type="radio" name="recommend_type" value="3" title="送优惠券" <?php if(!empty($mymember_level['recommend_type'])): if($mymember_level['recommend_type'] == 3): ?>checked=""<?php endif; endif; ?>><div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i><span>女</span></div>
					</div>
				</div>
                                <div class="layui-form-item">
					<label class="layui-form-label">推荐奖奖励</label>
					<div class="layui-input-block">
                                            <input type="text" name="recommend_prize"  autocomplete="off" class="layui-input" value="<?php if(!empty($mymember_level['recommend_prize'])): ?><?php echo $mymember_level['recommend_prize']; endif; ?>" placeholder="输入奖励的金额;若是优惠券,输入优惠券ID">
					</div>
				</div>
                                <div class="layui-form-item">
					<label class="layui-form-label">分销奖</label>
					<div class="layui-input-block">
						<input type="radio" name="iscommission" value="1" title="开启" <?php if(!empty($mymember_level['iscommission'])): if($mymember_level['iscommission'] == 1): ?>checked=""<?php endif; else: ?>checked=""<?php endif; ?>><div class="layui-unselect layui-form-radio layui-form-radioed"><i class="layui-anim layui-icon"></i><span>男</span></div>
						<input type="radio" name="iscommission" value="0" title="关闭" <?php if(!empty($mymember_level)): if($mymember_level['iscommission'] == 0): ?>checked=""<?php endif; endif; ?>><div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i><span>女</span></div>
					</div>
				</div>
                                <div class="layui-form-item">
					<label class="layui-form-label">分销奖类型</label>
					<div class="layui-input-block">
						<input type="radio" name="commission_type" value="1" title="送余额" <?php if(!empty($mymember_level['commission_type'])): if($mymember_level['commission_type'] == 1): ?>checked=""<?php endif; else: ?>checked=""<?php endif; ?>><div class="layui-unselect layui-form-radio layui-form-radioed"><i class="layui-anim layui-icon"></i><span>男</span></div>
						<input type="radio" name="commission_type" value="2" title="送积分" <?php if(!empty($mymember_level['commission_type'])): if($mymember_level['commission_type'] == 2): ?>checked=""<?php endif; endif; ?>><div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i><span>女</span></div>
					</div>
				</div>
                                <div class="layui-form-item">
					<label class="layui-form-label">分销计算方式</label>
					<div class="layui-input-block">
						<input type="radio" name="commission_way" value="1" title="固定金额" <?php if(!empty($mymember_level['commission_way'])): if($mymember_level['commission_way'] == 1): ?>checked=""<?php endif; else: ?>checked=""<?php endif; ?>><div class="layui-unselect layui-form-radio layui-form-radioed"><i class="layui-anim layui-icon"></i><span>男</span></div>
						<input type="radio" name="commission_way" value="2" title="按%算" <?php if(!empty($mymember_level['commission_way'])): if($mymember_level['commission_way'] == 2): ?>checked=""<?php endif; endif; ?>><div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i><span>女</span></div>
					</div>
				</div>
                                <div class="layui-form-item">
					<label class="layui-form-label">分销一级奖励</label>
					<div class="layui-input-block">
                                            <input type="text" name="commission1"  autocomplete="off" class="layui-input" value="<?php if(!empty($mymember_level['commission1'])): ?><?php echo $mymember_level['commission1']; endif; ?>" placeholder="输入奖励的金额;若是百分比,无须输入百分号">
					</div>
				</div>
                                <div class="layui-form-item">
					<label class="layui-form-label">分销二级奖励</label>
					<div class="layui-input-block">
                                            <input type="text" name="commission2"  autocomplete="off" class="layui-input" value="<?php if(!empty($mymember_level['commission2'])): ?><?php echo $mymember_level['commission2']; endif; ?>" placeholder="输入奖励的金额;若是百分比,无须输入百分号">
					</div>
				</div>
                                <div class="layui-form-item">
					<label class="layui-form-label">分销三级奖励</label>
					<div class="layui-input-block">
                                            <input type="text" name="commission3"  autocomplete="off" class="layui-input" value="<?php if(!empty($mymember_level['commission3'])): ?><?php echo $mymember_level['commission3']; endif; ?>" placeholder="输入奖励的金额;若是百分比,无须输入百分号">
					</div>
				</div>
<!--				<div class="layui-form-item">
					<label class="layui-form-label">权限</label>
					<div class="layui-input-block">
                                            <input type="text"  class="layui-input" name="power" value="<?php if(!empty($mymember_level['power'])): ?><?php echo $mymember_level['power']; endif; ?>"  placeholder="输入权限">
					</div>
				</div>-->

				
				
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
<script type="text/javascript">
	layui.use(['form','upload'],function(){
         var form = layui.form();
         layui.upload({ 
             url: '' ,//上传接口 
             success: function(res){
              //上传成功后的回调 
              console.log(res) 
            } 
         });

	});
</script>
</body>
</html>