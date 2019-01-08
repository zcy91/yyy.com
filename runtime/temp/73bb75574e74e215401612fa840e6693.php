<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:73:"E:\phpStudy\WWW\yyy.com\public/../application/back\view\user\useradd.html";i:1514525012;}*/ ?>
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
			<form class="layui-form col-lg-5">
				<div class="layui-form-item">
					<label class="layui-form-label">昵称</label>
					<div class="layui-input-block">
						<input type="text" name="username"  autocomplete="off" class="layui-input" value="<?php if(!empty($myuser['username'])): ?><?php echo $myuser['username']; endif; ?>"  placeholder="输入昵称">
						<input type="hidden" name="id" value="<?php if(!empty($myuser['id'])): ?><?php echo $myuser['id']; endif; ?>" >
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">手机号码</label>
					<div class="layui-input-block">
                                            <input type="text" name="mobile"  autocomplete="off" class="layui-input" value="<?php if(!empty($myuser['mobile'])): ?><?php echo $myuser['mobile']; endif; ?>" placeholder="输入手机号码">
					</div>
				</div>
                                <div class="layui-form-item">
					<label class="layui-form-label">密码</label>
					<div class="layui-input-block">
						<input type="password" name="password"  autocomplete="off" class="layui-input" placeholder="<?php if(!empty($myuser['password'])): ?>密码留空为不修改密码<?php else: ?>输入密码<?php endif; ?>">
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">性别</label>
					<div class="layui-input-block">
						<input type="radio" name="sex" value="1" title="男" <?php if(!empty($myuser['sex'])): if($myuser['sex'] == 1): ?>checked=""<?php endif; else: ?>checked=""<?php endif; ?>><div class="layui-unselect layui-form-radio layui-form-radioed"><i class="layui-anim layui-icon"></i><span>男</span></div>
						<input type="radio" name="sex" value="2" title="女" <?php if(!empty($myuser['sex'])): if($myuser['sex'] == 2): ?>checked=""<?php endif; endif; ?>><div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i><span>女</span></div>
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">头像</label>
					<div class="layui-input-block">
						<input type="file" name="file" class="layui-upload-file">
                                                <img style="width: 36px;height: 36px;" class="myimg" src="<?php if(!empty($myuser['avatar'])) echo imgUrl($myuser['avatar']);else echo imgUrl('') ?>">
                                                <input type="text"  class="avatar layui-input-block" style="padding-left: 10px;width: 50%;margin-left: 10px;" name="avatar" value="<?php if(!empty($myuser['avatar'])): ?><?php echo $myuser['avatar']; endif; ?>" >
                                        </div>
                                </div>
				<div class="layui-form-item">
					<label class="layui-form-label">等级</label>
					<div class="layui-input-block">
                                            <select name="level" id="level" lay-filter="aihao">
                                                   <?php if(is_array($mymember_level) || $mymember_level instanceof \think\Collection || $mymember_level instanceof \think\Paginator): $i = 0; $__LIST__ = $mymember_level;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                                        <option value="<?php echo $vo['level']; ?>" <?php if(!empty($myuser['level']) && $vo['level']==$myuser['level']): ?> selected="selected"<?php endif; ?>><?php echo $vo['name']; ?></option>
                                                   <?php endforeach; endif; else: echo "" ;endif; ?>
							
						</select>
					</div>
				</div>
                                <div class="layui-form-item">
					<label class="layui-form-label">是否可用</label>
					<div class="layui-input-block">
						<input type="radio" name="status" value="0" title="可用" <?php if(!empty($myuser['status'])): if($myuser['sex'] == 0): ?>checked=""<?php endif; else: ?>checked=""<?php endif; ?>><div class="layui-unselect layui-form-radio layui-form-radioed"><i class="layui-anim layui-icon"></i><span>开启</span></div>
						<input type="radio" name="status" value="1" title="不可以" <?php if(!empty($myuser['status'])): if($myuser['sex'] == 1): ?>checked=""<?php endif; endif; ?>><div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i><span>关闭</span></div>
					</div>
				</div>
				
				
				<div class="layui-form-item">
					<div class="layui-input-block">
                                            <button type="button" class="layui-btn" lay-submit="" onclick="user_add()" lay-filter="demo1">立即提交</button>
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
function user_add(){  //
    var username=$("input[name='username']").val();
    var id=$("input[name='id']").val();
    var mobile=$("input[name='mobile']").val();
    var password=$("input[name='password']").val();
    var sex=$('input:radio[name="sex"]:checked').val();
    var avatar=$("input[name='avatar']").val();
    var level=$("#level").val();
    var status=$('input:radio[name="status"]:checked').val();
  
        $.ajax({
            type: 'POST',
            url: '/back/user/useradd',
            data:{
              id:id,
              username:username,
              mobile:mobile,
              password:password,
              sex:sex,
              avatar:avatar,
              level:level,
              status:status,
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