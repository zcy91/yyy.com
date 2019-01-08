<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:75:"E:\phpStudy\WWW\yyy.com\public/../application/back\view\goods\videoadd.html";i:1517456842;}*/ ?>
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
			<form class="layui-form col-lg-5" id='yourformid'>
                                <div class="layui-form-item">
					<label class="layui-form-label">视频类目</label>
					<div class="layui-input-block">
						<input type="radio"  lay-filter="type" name="type" value="1" title="商品视频" <?php if(!empty($myvideo['type'])): if($myvideo['type'] == 1): ?>checked=""<?php endif; else: ?>checked=""<?php endif; ?>><div class="layui-unselect layui-form-radio layui-form-radioed"><i class="layui-anim layui-icon"></i><span>开启</span></div>
						<input type="radio"  lay-filter="type" name="type" value="2" title="羊羔视频" <?php if(!empty($myvideo)): if($myvideo['type'] == 2): ?>checked=""<?php endif; endif; ?>><div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i><span>关闭</span></div>
						<input type="radio"  lay-filter="type" name="type" value="3" title="牧场视频" <?php if(!empty($myvideo)): if($myvideo['type'] == 3): ?>checked=""<?php endif; endif; ?>><div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i><span>关闭</span></div>
						<input type="radio"  lay-filter="type" name="type" value="4" title="往期视频" <?php if(!empty($myvideo)): if($myvideo['type'] == 4): ?>checked=""<?php endif; endif; ?>><div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i><span>关闭</span></div>
					</div>
				</div>
                            <div class="layui-form-item" id="catid"  <?php if(!empty($myvideo['type']) && $myvideo['type']==4): else: ?>style="display:none;"<?php endif; ?>>
					<label class="layui-form-label">往期视频分类</label>
					<div class="layui-input-block">
                                                <select name="catid" id="level" lay-filter="catid">
                                                    <option value="0" >暂无分类</option>
                                                   <?php if(is_array($video_type) || $video_type instanceof \think\Collection || $video_type instanceof \think\Paginator): $i = 0; $__LIST__ = $video_type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                                        <option value="<?php echo $vo['id']; ?>" <?php if(!empty($myvideo['catid']) && $vo['id']==$myvideo['catid']): ?> selected="selected"<?php endif; ?>><?php echo $vo['name']; ?></option>
                                                   <?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
					</div>
				</div>
                                <div class="layui-form-item">
					<label class="layui-form-label">视频名称</label>
					<div class="layui-input-block">
                                            <input type="text" name="name"  autocomplete="off" class="layui-input" value="<?php if(!empty($myvideo['name'])): ?><?php echo $myvideo['name']; endif; ?>" placeholder="输入商品名称">
					</div>
				</div>
                                <div id="lambid" class="layui-form-item" <?php if(!empty($myvideo['type']) && $myvideo['type']==2): else: ?>style="display:none;"<?php endif; ?>>
					<label class="layui-form-label">羊羔ID</label>
					<div class="layui-input-block">
						<input type="text" name="lambid"  autocomplete="off" class="layui-input" value="<?php if(!empty($myvideo['lambid'])): ?><?php echo $myvideo['lambid']; endif; if(!empty($lambid)): ?><?php echo $lambid; endif; ?>"  placeholder="输入羊羔ID">
						<input type="hidden" name="id" value="<?php if(!empty($myvideo['id'])): ?><?php echo $myvideo['id']; endif; ?>" >
                                                <input type="hidden" id='setimg' name="setimg" value="" >
					</div>
				</div>
                                <div id="gid" class="layui-form-item" <?php if((!empty($myvideo['type']) && $myvideo['type']==1) or empty($myvideo['type'])): else: ?>style="display:none;"<?php endif; ?>>
					<label class="layui-form-label">商品ID</label>
					<div class="layui-input-block">
						<input type="text" name="gid"  autocomplete="off" class="layui-input" value="<?php if(!empty($myvideo['gid'])): ?><?php echo $myvideo['gid']; endif; if(!empty($gid)): ?><?php echo $gid; endif; ?>"  placeholder="输入商品ID">
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">视频</label>
					<div class="layui-input-block">
						<input type="file" name="file" lay-type="video"   onclick='setimg(1)' class="layui-upload-file"> 
<!--                                                <img style="width: 36px;height: 36px;" class="myimg" src="<?php if(!empty($myvideo['site'])) echo imgUrl($myvideo['site']);else echo imgUrl('') ?>">-->
                                                <input type="text"  class="avatar layui-input-block" style="padding-left: 10px;width: 50%;margin-left: 10px;" name="site"   placeholder="输入视频地址或上传视频" value="<?php if(!empty($myvideo['site'])): ?><?php echo $myvideo['site']; endif; ?>" >
                                        </div>
                                </div>
                                <div class="layui-form-item">
					<label class="layui-form-label">封面图</label>
					<div class="layui-input-block">
						<input type="file" name="file"   onclick='setimg(2)' class="layui-upload-file">
                                                <img style="width: 36px;height: 36px;" class="mycover" src="<?php if(!empty($myvideo['cover'])) echo imgUrl($myvideo['cover']);else echo imgUrl('') ?>">
                                                <input type="text"  class="cover layui-input-block" style="padding-left: 10px;width: 50%;margin-left: 10px;" name="cover" value="<?php if(!empty($myvideo['cover'])): ?><?php echo $myvideo['cover']; endif; ?>" >
                                        </div>
                                </div>
                                <div class="layui-form-item">
					<label class="layui-form-label">是否可用</label>
					<div class="layui-input-block">
						<input type="radio" name="status" value="1" title="可用" <?php if(!empty($myvideo['status'])): if($myvideo['status'] == 1): ?>checked=""<?php endif; else: ?>checked=""<?php endif; ?>><div class="layui-unselect layui-form-radio layui-form-radioed"><i class="layui-anim layui-icon"></i><span>开启</span></div>
						<input type="radio" name="status" value="0" title="不可以" <?php if(!empty($myvideo)): if($myvideo['status'] == 0): ?>checked=""<?php endif; endif; ?>><div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i><span>关闭</span></div>
					</div>
				</div>
				
				
				<div class="layui-form-item">
					<div class="layui-input-block">
                                            <button type="button" class="layui-btn" lay-submit="" onclick="video_add()" lay-filter="demo1">立即提交</button>
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
    function setimg(num){
        $('#setimg').val(num);
    }    
	layui.use(['form','upload'],function(){
         layui.upload({ 
             url: '/server/fileupload3.php',//上传接口 
             success: function(res){
                if(res.result){
                    var imgnum = $('#setimg').val();
                    if(imgnum==1){
                        $('.avatar').val(res.result);
                        $('.myimg').attr('src','/server/'+res.result);    
                    }else{
                        $('.cover').val(res.result);
                        $('.mycover').attr('src','/server/'+res.result);    
                    }        
                }else{
                    alert('上传失败');
                }
              console.log(res) 
            } 
         });

	});
function video_add(){  //
        $.ajax({
            type: 'POST',
            url: '/back/goods/videoadd',
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

layui.use(['form','upload'],function(){
         var form = layui.form();
//         form.on('select(catid)', function(data){
//            console.log(data.value); //被点击的select的value值
//            if(data.value==1){
//                $("#lambid").show();
//            }else{
//                $("#lambid").hide();
//            }
//        });  
         form.on('radio(type)', function(data){
            console.log(data.value); //被点击的select的value值
            if(data.value==1){
                $("#gid").show();
            }else{
                $("#gid").hide();
            }
            if(data.value==2){
                $("#lambid").show();
            }else{
                $("#lambid").hide();
            }
            if(data.value==4){
                $("#catid").show();
            }else{
                $("#catid").hide();
            }
        });  
        
	});
</script>
</body>
</html>