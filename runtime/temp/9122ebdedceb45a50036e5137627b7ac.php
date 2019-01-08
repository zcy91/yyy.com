<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:73:"E:\phpStudy\WWW\yyy.com\public/../application/back\view\set\adminlog.html";i:1512716550;}*/ ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>layui</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link rel="stylesheet" type="text/css" href="/static/common/bootstrap/css/bootstrap.css" media="all">
  <link rel="stylesheet" href="/static/css/layui.css"  media="all">
  <!-- 注意：如果你直接复制所有代码到本地，上述css路径需要改成你本地的 -->
</head>
<body>
<fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
  <legend>系统日志</legend>
</fieldset>
<ul class="layui-timeline">
  <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>  
  <li class="layui-timeline-item">
    <i class="layui-icon layui-timeline-axis"></i>
    <div class="layui-timeline-content layui-text">
      <h3 class="layui-timeline-title"><?php echo date("Y-m-d H:i",$vo['time']) ?></h3>
      <p>
        账号：<?php echo $vo['username']; ?>
        <br>
        状态：<?php echo $vo['oper']; ?>
        <br>登录ip:<?php echo $vo['ip']; ?>
      </p>
    </div>
  </li>
  <?php endforeach; endif; else: echo "" ;endif; ?>
</ul>  
 <?php echo $list->render(); ?>

               
          
<script type="text/javascript" src="/static/common/layui/layui.js"></script> 
<!-- 注意：如果你直接复制所有代码到本地，上述js路径需要改成你本地的 -->
<script>
</script>

</body>
</html>