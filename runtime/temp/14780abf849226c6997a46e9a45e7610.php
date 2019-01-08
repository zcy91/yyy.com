<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:84:"/home/wwwroot/yang.oioos.com/public/../application/back/view/goods/classifylist.html";i:1511405512;}*/ ?>
 
 
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<title>表格操作 - layui</title>

<link rel="stylesheet" href="/static/css/layui.css">

<style>
body{padding: 20px;}
</style>
</head>
<body>

<div class="layui-btn-group">
    <button class="layui-btn" onclick="classify_add()" >添加分类</button>
</div>








<table class="layui-table" lay-filter="parse-table-demo">
  <thead>
    <tr>
     <td>ID</td>
     <td>名称</td>
     <td>简介</td>
     <td>单位</td>
     <td>操作</td>
    </tr>
   
   </thead>
   <tbody>
    <?php if(is_array($classifylist) || $classifylist instanceof \think\Collection || $classifylist instanceof \think\Paginator): $i = 0; $__LIST__ = $classifylist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>   
    <tr id="tr_<?php echo $vo['id']; ?>">
     <td><?php echo $vo['id']; ?></td>
     <td><?php echo $vo['name']; ?></td>
     <td><?php echo $vo['desc']; ?></td>
     <td><?php echo $vo['measure']; ?></td>
     <td>
            <a class="layui-btn layui-btn-mini" onclick="classify_edit(<?php echo $vo['id']; ?>)"><i class="iconfont icon-edit"></i> 编辑</a>
            <a class="layui-btn layui-btn-danger layui-btn-mini"  onclick="classify_del(<?php echo $vo['id']; ?>)" data-id="1"><i class="layui-icon"></i> 删除</a>
     </td>
    </tr>
    <?php endforeach; endif; else: echo "" ;endif; ?>
  </tbody>
</table>

<script type="text/javascript" src="/static/common/layui/layui.js"></script>
<script type="text/javascript" src="/static/js/newslist.js"></script>
<script type="text/javascript">
	layui.use(['jquery','layer','element','laypage'],function(){
	      window.jQuery = window.$ = layui.jquery;
	      window.layer = layui.layer;
          var element = layui.element(),
              laypage = layui.laypage;

            
          laypage({
					cont: 'page',
					pages: 10 //总页数
						,
					groups: 5 //连续显示分页数
						,
					jump: function(obj, first) {
						//得到了当前页，用于向服务端请求对应数据
						var curr = obj.curr;
						if(!first) {
							//layer.msg('第 '+ obj.curr +' 页');
						}
					}
				});

          laypage({
					cont: 'page2',
					pages: 10 //总页数
						,
					groups: 5 //连续显示分页数
						,
					jump: function(obj, first) {
						//得到了当前页，用于向服务端请求对应数据
						var curr = obj.curr;
						if(!first) {
							//layer.msg('第 '+ obj.curr +' 页');
						}
					}
				});
    });
</script>
<script>

                   //操作
function classify_add(){
    var index = layui.layer.open({
                title : "添加分类",
                type : 2,
                content : "classifyadd.html",
                success : function(layero, index){
                        setTimeout(function(){
                                layusi.layer.tips('点击此处返回分类列表', '.layui-layer-setwin .layui-layer-close', {
                                        tips: 3
                                });
                        },500)
                }
        })			
        layui.layer.full(index);
    }
 function classify_edit(id){
    var index = layui.layer.open({
                title : "添加分类",
                type : 2,
                content : "classifyadd.html?id="+id,
                success : function(layero, index){
                        setTimeout(function(){
                                layusi.layer.tips('点击此处返回分类列表', '.layui-layer-setwin .layui-layer-close', {
                                        tips: 3
                                });
                        },500)
                }
        })			
        layui.layer.full(index);
    }   
    //删除
function classify_del(id){  //删除
        var _this = $(this);
        layer.confirm('确定删除此信息？',{icon:3, title:'提示信息'},function(index){
                if(index>0){
                    $.ajax({
                    type: 'POST',
                    url: 'classifydel.html?id='+id,
                    success: function(data){
                        if(data>0){
                            $('#tr_'+id).remove();
                            layer.msg('删除成功！');
                            layer.close(index);
                        }else{
                            layer.msg('删除失败！');
                            layer.close(index);
                        }
                        
                    },
                    error: function(xhr){
                        layer.msg('error');
                    }
                });
                }
                layer.close(index);
        });
	}
</script>
</body>
</html>
