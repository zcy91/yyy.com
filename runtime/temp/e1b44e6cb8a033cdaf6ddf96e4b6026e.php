<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:80:"/home/wwwroot/yang.oioos.com/public/../application/back/view/user/agentlist.html";i:1517126832;}*/ ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>layui</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link rel="stylesheet" href="/static/common/layui-v1.0.9/layui/css/layui.css"  media="all">
  <!-- 注意：如果你直接复制所有代码到本地，上述css路径需要改成你本地的 -->
</head>
<body>
              

<fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;">
  <legend>分销管理</legend>
</fieldset>
<div class="layui-collapse"  lay-filter="demo">
    <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
    <div class="layui-colla-item">
        <h2 class="layui-colla-title"><?php if(!empty($vo['realname'])): ?><?php echo $vo['realname']; elseif(!empty($vo['username'])): ?><?php echo $vo['username']; endif; ?>/<?php echo $vo['mobile']; ?>/ID:<?php echo $vo['id']; ?></h2>
        <div class="layui-colla-content" id='<?php echo $vo['id']; ?>'>
            
        </div>
    </div>
    <?php endforeach; endif; else: echo "" ;endif; ?>


          
<script type="text/javascript" src="/static/common/layui-v1.0.9/layui/layui.js"></script>
<script type="text/javascript" src="/static/js/jquery.min.js"></script>
<!-- 注意：如果你直接复制所有代码到本地，上述js路径需要改成你本地的 -->
<script>
layui.use(['element', 'layer'], function(){
  var element = layui.element();
  var layer = layui.layer;
  
  //监听折叠
  element.on('collapse(demo)', function(data){
    var agentid = data.content[0].id;
        $.ajax({
            type: 'POST',
            url: '/back/user/getagent',
            data:{
              agentid:agentid,
            },
            dataType:'json',
            success: function(data){
                 if(data.type==1){
                    var html='';
                    html+='<div class="layui-collapse"  lay-filter="demo">';
                    for(var i=0;i<data.data.length;i++){
                        html+='<div class="layui-colla-item">';
                        html+='<h2 class="layui-colla-title" onclick ="show_agent('+data.data[i]['id']+')"><span id="span_'+data.data[i]['id']+'"><i class="layui-icon" >&#xe602;</i>  </span>'+data.data[i]['username']+',ID:('+data.data[i]['id']+')</h2>';
                        html+='<div class="layui-colla-content" id="'+data.data[i]['id']+'" >';
                        html+='</div></div>';
                    }
                    html+='</div>';
                    $("#"+agentid+"").html(html);
                }else{
                     html=data.msg;
                     $("#"+agentid+"").html(html);
                }

            },
            error: function(xhr){
                layer.msg('error');
            }
        });
    });
});
</script>
<script>
    function show_agent(id){
        var agentid = id;
        $.ajax({
            type: 'POST',
            url: '/back/user/getagent',
            data:{
              agentid:agentid,
            },
            dataType:'json',
            success: function(data){
                 if(data.type==1){
                    layer.msg(data.msg);
                    var html='';
                    html+='<div class="layui-collapse"  lay-filter="demo">';
                    for(var i=0;i<data.data.length;i++){
                        html+='<div class="layui-colla-item">';
                        html+='<h2 class="layui-colla-title" onclick ="show_agent('+data.data[i]['id']+')"><span id="span_'+data.data[i]['id']+'"><i class="layui-icon" >&#xe602;</i>  </span>'+data.data[i]['username']+',ID:('+data.data[i]['id']+')</h2>';
                        html+='<div class="layui-colla-content" id="'+data.data[i]['id']+'" >';
                        html+='</div></div>';
                    }
                    html+='</div>';
                    $("#"+agentid+"").html(html);
                    if(!$("#"+agentid+"").hasClass("layui-show")){
                        $("#"+agentid+"").addClass("layui-show");
                        $("#span_"+agentid+"").html('<i class="layui-icon" >&#xe61a;</i>');
                    }else{
                        $("#"+agentid+"").removeClass("layui-show");
                        $("#span_"+agentid+"").html('<i class="layui-icon" >&#xe602;</i>');
                    }
                }else{
                     html=data.msg;
                     $("#"+agentid+"").html(html);
                     if(!$("#"+agentid+"").hasClass("layui-show")){
                        $("#"+agentid+"").addClass("layui-show");
                        $("#span_"+agentid+"").html('<i class="layui-icon" >&#xe61a;</i>');
                    }else{
                        $("#"+agentid+"").removeClass("layui-show");
                        $("#span_"+agentid+"").html('<i class="layui-icon" >&#xe602;</i>');
                    }
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