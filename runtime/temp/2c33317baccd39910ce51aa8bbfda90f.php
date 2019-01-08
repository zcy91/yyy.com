<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:74:"E:\phpStudy\WWW\yyy.com\public/../application/back\view\goods\lambadd.html";i:1516602478;}*/ ?>
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
			<span>羊羔信息</span>
		</header><!-- /header -->
		<div class="larry-personal-body clearfix">
			<form class="layui-form col-lg-5"  id="yourformid">
				<div class="layui-form-item">
					<label class="layui-form-label">羊羔耳标</label>
					<div class="layui-input-block">
						<input type="text" name="lambsn"  autocomplete="off" class="layui-input" value="<?php if(!empty($mylamb['lambsn'])): ?><?php echo $mylamb['lambsn']; endif; ?>"  placeholder="输入耳标">
						<input type="hidden" name="id" value="<?php if(!empty($mylamb['id'])): ?><?php echo $mylamb['id']; endif; ?>" >
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">商品ID</label>
					<div class="layui-input-block">
                                            <input type="text" name="gid"  autocomplete="off" class="layui-input" value="<?php if(!empty($mylamb['gid'])): ?><?php echo $mylamb['gid']; endif; ?>" placeholder="输入商品ID">
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">羊羔图片</label>
					<div class="layui-input-block">
						<input type="file" name="file" class="layui-upload-file">
                                                <img style="width: 36px;height: 36px;" class="myimg" src="<?php if(!empty($mylamb['avatar'])) echo imgUrl($mylamb['avatar']);else echo imgUrl('') ?>">
                                                <input type="text"  class="avatar layui-input-block" style="padding-left: 10px;width: 50%;margin-left: 10px;" name="avatar" value="<?php if(!empty($mylamb['avatar'])): ?><?php echo $mylamb['avatar']; endif; ?>" >
                                        </div>
                                </div>
                                <div class="layui-form-item">
					<label class="layui-form-label">是否可用</label>
					<div class="layui-input-block">
						<input type="radio" name="status" value="0" title="未出售" <?php if(!empty($mylamb)): if($mylamb['status'] == 0): ?>checked=""<?php endif; else: ?>checked=""<?php endif; ?>><div class="layui-unselect layui-form-radio layui-form-radioed"><i class="layui-anim layui-icon"></i><span>未出售</span></div>
						<input type="radio" name="status" value="1" title="已出售" <?php if(!empty($mylamb['status'])): if($mylamb['status'] == 1): ?>checked=""<?php endif; endif; ?>><div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i><span>已出售</span></div>
						<input type="radio" name="status" value="2" title="转让中" <?php if(!empty($mylamb['status'])): if($mylamb['status'] == 2): ?>checked=""<?php endif; endif; ?>><div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i><span>转让中</span></div>
						<input type="radio" name="status" value="3" title="已回购" <?php if(!empty($mylamb['status'])): if($mylamb['status'] == 3): ?>checked=""<?php endif; endif; ?>><div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i><span>已回购</span></div>
					</div>
				</div>
				
				
				<div class="layui-form-item">
					<div class="layui-input-block">
                                            <button type="button" class="layui-btn" lay-submit="" onclick="lamb_add()" lay-filter="demo1">立即提交</button>
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
function lamb_add(){  //
  
        $.ajax({
            type: 'POST',
            url: '/back/goods/lambadd',
            data:$('#yourformid').serialize(),
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