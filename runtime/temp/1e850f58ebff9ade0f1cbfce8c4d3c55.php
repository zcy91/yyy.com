<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:82:"/home/wwwroot/yang.oioos.com/public/../application/back/view/app/banbenguanli.html";i:1522228186;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>APP设置</title>
	<meta name="renderer" content="webkit">	
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">	
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">	
	<meta name="apple-mobile-web-app-status-bar-style" content="black">	
	<meta name="apple-mobile-web-app-capable" content="yes">	
	<meta name="format-detection" content="telephone=no">	
	<link rel="stylesheet" type="text/css" href="/static/common/layui2.2.5/css/layui.css" media="all">
	<link rel="stylesheet" type="text/css" href="/static/common/bootstrap/css/bootstrap.css" media="all">
	<link rel="stylesheet" type="text/css" href="/static/common/global.css" media="all">
	<link rel="stylesheet" type="text/css" href="/static/css/personal.css" media="all">
</head>
<body>
<section class="layui-larry-box">
	<div class="larry-personal">
		<header class="larry-personal-tit">
			<span>Android设置</span>
		</header>
		<div class="larry-personal-body clearfix">
			<form class="layui-form col-lg-5" action="" method="post">
				<div class="layui-form-item">
					<label class="layui-form-label">当前版本</label>
					<div class="layui-input-block">
						<input type="text" name="androidVer"  autocomplete="off" class="layui-input" value="<?php if(!empty($data['androidVer'])): ?><?php echo $data['androidVer']; endif; ?>"  placeholder="输入当前最新版本号">
					</div>
				</div>
                    
				<div class="layui-form-item">
					<label class="layui-form-label">安装包</label>
					<div class="layui-input-block">
						<!--<input type="file" name="file" class="layui-upload-file">-->
						<button type="button" id="apk" class="layui-btn updatebao" lay-data="<?php echo url("","",true,false);?>"><i class="layui-icon"></i>上传文件</button>
						<input type="text"  class="avatar layui-input-block" style="padding-left: 10px;width: 50%;margin-left: 10px;" name="androidApk" value="<?php if(!empty($data['androidApk'])): ?><?php echo $data['androidApk']; endif; ?>" >
                                        </div>
				</div>
		<header class="larry-personal-tit">
			<span>IOS设置</span>
		</header>
		<div class="layui-form-item">
					<label class="layui-form-label">当前版本</label>
					<div class="layui-input-block">
						<input type="text" name="IOSVer"  autocomplete="off" class="layui-input" value="<?php if(!empty($data['IOSVer'])): ?><?php echo $data['IOSVer']; endif; ?>"  placeholder="输入当前最新版本号">
					</div>
				</div>
                    
				<!--<div class="layui-form-item">
					<label class="layui-form-label">安装包</label>
					<div class="layui-input-block">
						<input type="file" name="file" class="layui-upload-file">
                        <input type="text"  class="avatar layui-input-block" style="padding-left: 10px;width: 50%;margin-left: 10px;" name="IOSApk" value="<?php if(!empty($data['IOSApk'])): ?><?php echo $data['IOSApk']; endif; ?>" >
                                        </div>
				</div>-->
		<header class="larry-personal-tit">
			<span>Android & IOS资源更新包</span>
		</header>
				<div class="layui-form-item">
					<label class="layui-form-label">更新资源</label>
					<div class="layui-input-block">
						<!--<input type="file" name="file" class="layui-upload-file">-->
						<button type="button" class="layui-btn updatebao" lay-data="<?php echo url("","",true,false);?>"><i class="layui-icon"></i>上传文件</button>
						<input type="text"  class="avatar layui-input-block" style="padding-left: 10px;width: 50%;margin-left: 10px;" name="Update" value="<?php if(!empty($data['Update'])): ?><?php echo $data['Update']; endif; ?>" >
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
<script type="text/javascript" src="/static/common/layui2.2.5/layui.js"></script>
<script type="text/javascript" src="/static/js/jquery.min.js"></script>
<script type="text/javascript">
	/*layui.use(['form','upload'],function(){
         var form = layui.form();
         layui.upload({ 
            url: '/server/fileupload.php',//上传接口
            accept: 'file',
            exts:'wgt|apk|ipa',
             success: function(res){
                if(res.result){
                    $('.avatar').val(res.result);
                }else{
                    alert('上传失败');
                }
              console.log(res.result) 
            } 
         });

	});*/

	layui.use(['form','upload'], function(){
	  var $ = layui.jquery,
	  form = layui.form
	  ,upload = layui.upload;

/*	   upload.render({
	    elem: '.updatebao'
	    ,before: function(){
	      layer.tips('接口地址：'+ this.url, this.item, {tips: 1});
	    }
	    ,done: function(res, index, upload){
	      var item = this.item;
	      console.log(item);
	      if(res.code > 0){
				alert('上传失败');
			}else{
				$('.avatar').val(res.result);
          }
	    }
	  })
	  

	  upload.render({
	    elem: '#apk'
	    ,url: '/upload/'
	    ,accept: 'file'
	    ,exts: 'apk|wgt|ipa'
	    ,done: function(res){
	      console.log(res)
	    }
	  });
*/
	});
</script>
</body>
</html>