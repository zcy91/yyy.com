<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:78:"E:\phpStudy\WWW\yyy.com\public/../application/back\view\goods\classifyadd.html";i:1515143840;}*/ ?>
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
			<form class="layui-form col-lg-5" action="" onsubmit="return false;" method="post">
				<div class="layui-form-item">
					<label class="layui-form-label">名称</label>
					<div class="layui-input-block">
						<input type="text" name="name"  autocomplete="off" class="layui-input" value="<?php if(!empty($myclassify['name'])): ?><?php echo $myclassify['name']; endif; ?>"  placeholder="输入分类名称">
						<input type="hidden" name="id" value="<?php if(!empty($myclassify['id'])): ?><?php echo $myclassify['id']; endif; ?>" >
					</div>
				</div>
                                <div class="layui-form-item">
					<label class="layui-form-label">上级分类</label>
					<div class="layui-input-block">
                                            <select name="pid" id="pid" lay-filter="aihao">
                                                    <option value="0" <?php if(empty($myclassify['pid'])): ?> selected="selected"<?php endif; ?>>顶级</option>
                                                   <?php if(is_array($getclassify) || $getclassify instanceof \think\Collection || $getclassify instanceof \think\Paginator): $i = 0; $__LIST__ = $getclassify;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                                        <option value="<?php echo $vo['id']; ?>" <?php if(!empty($myclassify['pid']) && $vo['id']==$myclassify['pid']): ?> selected="selected"<?php endif; ?>><?php echo str_repeat('&nbsp;┣&nbsp;&nbsp;',$vo['ceng']); ?><?php echo $vo['name']; ?></option>
                                                   <?php endforeach; endif; else: echo "" ;endif; ?>
							
						</select>
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">排序</label>
					<div class="layui-input-block">
                                            <input type="text" name="sort"  autocomplete="off" class="layui-input" value="<?php if(!empty($myclassify['sort'])): ?><?php echo $myclassify['sort']; endif; ?>" placeholder="输入排序">
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">单位</label>
					<div class="layui-input-block">
                                            <input type="text"  class="layui-input" name="measure" value="<?php if(!empty($myclassify['measure'])): ?><?php echo $myclassify['measure']; endif; ?>"  placeholder="输入单位">
					</div>
				</div>

				<div class="layui-form-item layui-form-text">
					<label class="layui-form-label">简介</label>
					<div class="layui-input-block">
                                            <textarea placeholder="既然选择了远方，便只顾风雨兼程；路漫漫其修远兮，吾将上下而求索" name="desc" id='desc' value="" class="layui-textarea"><?php if(!empty($myclassify['desc'])): ?><?php echo $myclassify['desc']; endif; ?></textarea>
					</div>
				</div>
				
				<div class="layui-form-item">
					<div class="layui-input-block">
                                            <button type="submit" class="layui-btn" onclick="classify_add()">立即提交</button>
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
             url: '' ,//上传接口 
             success: function(res){
              //上传成功后的回调 
              console.log(res) 
            } 
         });

	});
function classify_add(){  //
    var name=$("input[name='name']").val();
    var id=$("input[name='id']").val();
    var sort=$("input[name='sort']").val();
    var measure=$("input[name='measure']").val();
    var desc=$("#desc").val();
    var pid=$("#pid").val();
  
        $.ajax({
            type: 'POST',
            url: '/back/goods/classifyadd',
            data:{
              id:id,
              name:name,
              sort:sort,
              measure:measure,
              desc:desc,
              pid:pid,
            },
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