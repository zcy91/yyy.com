<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:69:"E:\phpStudy\WWW\yyy.com\public/../application/back\view\set\menu.html";i:1511253300;}*/ ?>
<html><head>
        <meta charset="utf-8">
        <title>1024kb.com后台管理</title>
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="format-detection" content="telephone=no">
        <link rel="stylesheet" href="/static/css/layui.css" media="all">
        <link rel="stylesheet" href="/static/css/global.css" media="all">
        <link rel="stylesheet" href="/static/css/font.css" media="all">
        <link id="layuicss-layer" rel="stylesheet" href="http://1024kb.com/public/static/plugins/layui/css/modules/layer/default/layer.css?v=3.1.0" media="all"></head>
    <body class="skin-0">
        <div class="admin-main layui-anim layui-anim-upbit">
            <fieldset class="layui-elem-field layui-field-title">
                <legend>菜单管理</legend>
            </fieldset>
            <blockquote class="layui-elem-quote">
                <a href="/back/set/addmenu.html" class="layui-btn layui-btn-small">添加菜单</a>
                <a href="javascript:;" onclick="createMenu();" class="layui-btn layui-btn-small">生成菜单</a>
            </blockquote>
            <table class="layui-table" id="list" lay-filter="list">

            </table>
            <div class="layui-form layui-border-box layui-table-view" lay-filter="LAY-table-1" style=" ">
                <div class="layui-table-header"><table cellspacing="0" cellpadding="0" border="0" class="layui-table">
                        <thead>
                            <tr>
                                <th data-field="id">
                                    <div class="layui-table-cell laytable-cell-1-id">
                                        <span>编号</span>
                                    </div>
                                </th>
                                <th data-field="name">
                                    <div class="layui-table-cell laytable-cell-1-name">
                                        <span>主菜单名称</span>
                                    </div>
                                </th>
                                <th data-field="type">
                                    <div class="layui-table-cell laytable-cell-1-type">
                                        <span>菜单类型</span>
                                    </div>
                                </th>
                                <th data-field="open">
                                    <div class="layui-table-cell laytable-cell-1-open" align="center">
                                        <span>状态</span>
                                    </div></th>
                                    <th data-field="listorder">
                                        <div class="layui-table-cell laytable-cell-1-listorder" align="center">
                                            <span>排序</span>
                                        </div>
                                    </th>
                                    <th data-field="value">
                                        <div class="layui-table-cell laytable-cell-1-value">
                                            <span>菜单操作值</span>
                                        </div>
                                    </th>
                                    <th data-field="6">
                                        <div class="layui-table-cell laytable-cell-1-6" align="center">
                                            <span>操作</span>
                                        </div>
                                    </th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="layui-table-body layui-table-main">
                    <table cellspacing="0" cellpadding="0" border="0" class="layui-table">
                        <tbody>
                            <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <tr data-index="0" id="tr_<?php echo $vo['id']; ?>">
                                <td data-field="id">
                                    <div class="layui-table-cell laytable-cell-1-id"></div>
                                </td>
                                <td data-field="name" data-content="<?php echo $vo['name']; ?>">
                                    <div class="layui-table-cell laytable-cell-1-name"><?php echo $vo['ltitle']; ?> </div>
                                </td>
                                <td data-field="type">
                                    <div class="layui-table-cell laytable-cell-1-type"><?php echo $vo['type']; ?></div>
                                </td>
                                <td data-field="open" align="center" data-off="true">
                                    <div class="layui-table-cell laytable-cell-1-open">
                                        <a class="layui-btn layui-btn-mini layui-btn-warm" lay-event="open">开启</a>  
                                    </div>
                                </td>
                                <td data-field="listorder" align="center" data-off="true">
                                    <div class="layui-table-cell laytable-cell-1-listorder">
                                        <input name="1" data-id="1" class="list_order layui-input" value=" 1" size="10">
                                    </div>
                                </td>
                                <td data-field="value">
                                    <div class="layui-table-cell laytable-cell-1-value"><?php echo $vo['value']; ?></div>
                                </td>
                                <td data-field="6" align="center" data-off="true">
                                    <div class="layui-table-cell laytable-cell-1-6">
                                        <a href="/back/set/addmenu.html?id=<?php echo $vo['id']; ?>" class="layui-btn layui-btn-mini">编辑</a> 
                                        <a class="layui-btn layui-btn-danger layui-btn-mini"  onclick="menu_del(<?php echo $vo['id']; ?>)" lay-event="del">删除</a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </tbody>
                    </table>
                </div><div class="layui-table-fixed layui-table-fixed-l"><div class="layui-table-header"><table cellspacing="0" cellpadding="0" border="0" class="layui-table"><thead><tr><th data-field="id"><div class="layui-table-cell laytable-cell-1-id"><span>编号</span></div></th></tr></thead></table></div><div class="layui-table-body" style="height: auto;"><table cellspacing="0" cellpadding="0" border="0" class="layui-table"><tbody><tr data-index="0" class=""><td data-field="id"><div class="layui-table-cell laytable-cell-1-id">1</div></td></tr><tr data-index="1" class=""><td data-field="id"><div class="layui-table-cell laytable-cell-1-id">44</div></td></tr><tr data-index="2" class=""><td data-field="id"><div class="layui-table-cell laytable-cell-1-id">45</div></td></tr><tr data-index="3" class=""><td data-field="id"><div class="layui-table-cell laytable-cell-1-id">46</div></td></tr><tr data-index="4" class=""><td data-field="id"><div class="layui-table-cell laytable-cell-1-id">41</div></td></tr><tr data-index="5" class=""><td data-field="id"><div class="layui-table-cell laytable-cell-1-id">42</div></td></tr><tr data-index="6" class=""><td data-field="id"><div class="layui-table-cell laytable-cell-1-id">47</div></td></tr><tr data-index="7" class=""><td data-field="id"><div class="layui-table-cell laytable-cell-1-id">48</div></td></tr><tr data-index="8" class=""><td data-field="id"><div class="layui-table-cell laytable-cell-1-id">49</div></td></tr><tr data-index="9" class=""><td data-field="id"><div class="layui-table-cell laytable-cell-1-id">43</div></td></tr><tr data-index="10" class=""><td data-field="id"><div class="layui-table-cell laytable-cell-1-id">50</div></td></tr><tr data-index="11" class=""><td data-field="id"><div class="layui-table-cell laytable-cell-1-id">51</div></td></tr><tr data-index="12" class=""><td data-field="id"><div class="layui-table-cell laytable-cell-1-id">52</div></td></tr><tr data-index="13" class=""><td data-field="id"><div class="layui-table-cell laytable-cell-1-id">53</div></td></tr><tr data-index="14" class=""><td data-field="id"><div class="layui-table-cell laytable-cell-1-id">54</div></td></tr></tbody></table></div></div><style>.laytable-cell-1-id{ width:80px }.laytable-cell-1-name{ width:120px }.laytable-cell-1-type{ width:100px }.laytable-cell-1-open{ width:100px }.laytable-cell-1-listorder{ width:100px }.laytable-cell-1-value{ width:320px }.laytable-cell-1-6{ width:160px }</style></div>
        </div>
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
        //删除
function menu_del(id){  //删除
        var _this = $(this);
        layer.confirm('确定删除此信息？',{icon:3, title:'提示信息'},function(index){
                if(index>0){
                    $.ajax({
                    type: 'POST',
                    url: 'menudel.html?id='+id,
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
        <script>
            function createMenu(){
                    var _this = $(this);
                    layer.confirm('确定重新生成菜单？',{icon:3, title:'提示信息'},function(index){
                            if(index>0){
                                $.ajax({
                                type: 'POST',
                                url: 'createmenu.html',
                                dataType : "json",
                                success: function(data){
                                    if(data.code>0){
                                        layer.msg(data.info);
                                        layer.close(index);
                                    }else{
                                        layer.msg(data.info);
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
        
        <div class="layui-layer-move"></div></body></html>