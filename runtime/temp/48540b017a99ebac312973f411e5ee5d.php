<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:76:"D:\wamp64\www\yyy.com\public/../application/back\view\article\lvkelist1.html";i:1532503845;s:66:"D:\wamp64\www\yyy.com\public/../application/back\view\refresh.html";i:1532503835;}*/ ?>
<!DOCTYPE html>
<html lang="en"><head>
	<meta charset="UTF-8">
	<title>旅客信息</title>
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
<link id="layuicss-skinlayercss" rel="stylesheet" href="http://www.17sucai.com//preview/33522/2017-10-20/LarryCMS-new/common/layui/css/modules/layer/default/layer.css?v=3.0.11110" media="all"></head>
<body>
<section class="layui-larry-box">
	<div class="larry-personal">
                            <header class="larry-personal-tit">
			<span>页面</span>
                        <div class="larry-side-menu" onclick="javascript:location.reload();" style="    position: absolute;    cursor: pointer;    z-index: 19490201;    right:  100px;    color: white;    text-align: center;    width: 30px;    height: 30px;    background-color: #1AA094;    line-height: 30px;    top: 6%;">
                                <i class="fa " aria-hidden="true">刷新</i>
                        </div>
<!--                        <div class="larry-side-menu" onclick="javascript:window.opener=null;window.open('','_self');window.close();" style="    position: absolute;    cursor: pointer;    z-index: 19490201;    right:  50px;    color: white;    text-align: center;    width: 30px;    height: 30px;    background-color: #FF0033;    line-height: 30px;    top: 6%;">
                                <i class="fa " aria-hidden="true">关闭</i>
                        </div>-->

		</header><!-- /header -->
	    <div class="layui-tab">
            <blockquote class="layui-elem-quote news_search">
		<form class="layui-form" action="">
		<div class="layui-inline">
                    <div class="layui-input-inline">
                        <select name="search">
                          <option value="mohu" <?php if(!empty($query['query']['search']) && $query['query']['search']=='mohu'): ?>selected=""<?php endif; ?>>模糊搜索</option>
                          <option value="id" <?php if(!empty($query['query']['search']) && $query['query']['search']=='id'): ?>selected=""<?php endif; ?>>ID</option>
                          <option value="uid" <?php if(!empty($query['query']['search']) && $query['query']['search']=='uid'): ?>selected=""<?php endif; ?>>用户ID</option>
                          <!--<option value="username" <?php if(!empty($query['query']['search']) && $query['query']['search']=='username'): ?>selected=""<?php endif; ?>>用户昵称</option>-->
                          <!--<option value="title" <?php if(!empty($query['query']['search']) && $query['query']['search']=='title'): ?>selected=""<?php endif; ?>>标题</option>-->
                        </select>
                    </div>
		    <div class="layui-input-inline">
                        <input value="<?php if(!empty($query['query']['keyword'])): ?><?php echo $query['query']['keyword']; endif; ?>" placeholder="请输入关键字" name="keyword" class="layui-input search_input" type="text">
		    </div>
                    <div class="layui-input-inline">
                        <label class="layui-form">范围选择</label>
                        <div class="layui-input-inline">
                            <input class="layui-input" placeholder="开始日" value="<?php if(!empty($query['query']['stime'])): ?><?php echo $query['query']['stime']; endif; ?>" name="stime" id="LAY_demorange_s">
                        </div>
                        <div class="layui-input-inline">
                            <input class="layui-input" placeholder="截止日" value="<?php if(!empty($query['query']['etime'])): ?><?php echo $query['query']['etime']; endif; ?>"  name="etime" id="LAY_demorange_e">
                        </div>
                      </div>
                    </div>
                    <br><br>
                    <button type="submit" class="layui-btn ">查询</button>
                    <div class="layui-inline">
			<!--<a class="layui-btn layui-btn-normal"  onclick="article_add()">保险设置</a>-->
		</div>
		
		<div class="layui-inline">
						<a class="layui-btn layui-btn-danger batchDel1">批量设置保险</a>
		</div>
			<input name="id" value="<?php echo $id; ?>" type="hidden">
			<input name="tourtype" value="<?php echo $tourtype; ?>" type="hidden">
                </form>
	</blockquote>
            
		         <!-- 操作日志 -->
                <div class="layui-form news_list">
                    <table class="layui-table">
					    <colgroup>
						<col width="50">
						<col>
						<col width="9%">
						<col width="9%">
						<col width="9%">
						<col width="9%">
						<col width="9%">
						<col width="15%">
					</colgroup>
					<thead>
						<tr>
							<th><input name="" lay-skin="primary" lay-filter="allChoose" id="allChoose" type="checkbox"><div class="layui-unselect layui-form-checkbox"><span>勾选</span><i class="layui-icon"></i></div>
								
							</th>
							<th style="width: 50px">ID</th>
							<th style="width: 200px">订单号</th>
							<th>线路ID</th>
							<th>订购人ID</th>
							<th>大人信息</th>
							<th>陪同儿童信息</th>
							<th>陪同儿童信息</th>
							<th>联系电话</th>
							<th>创建时间</th>
							<th>完成时间</th>
							<th>保险状态</th>
							<th>操作</th>
						</tr>
					</thead>
					<tbody class="news_content">
					<?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
						<tr  id="tr_<?php echo $vo['id']; ?>">
							<td><input name="checked" lay-skin="primary" lay-filter="choose" type="checkbox" value="<?php echo $vo['id']; ?>"><div class="layui-unselect layui-form-checkbox"><span>勾选</span><i class="layui-icon"></i></div>
								
							</td>
							<td><?php echo $vo['id']; ?></td>
							<td align="left"><?php echo $vo['sellsn']; ?></td>
							<td><?php echo $vo['tourtype']; ?></td>
							<td><?php echo $vo['uid']; ?></td>
							<td><div><?php echo $vo['realname_da']; ?></div><?php echo $vo['cartid']; ?></td>
							<td><div><?php if(!empty($vo['realname0'])): ?><?php echo $vo['realname0']; endif; ?></div><?php if(!empty($vo['cartid0'])): ?><?php echo $vo['cartid0']; endif; ?></td>
							<td><div><?php if(!empty($vo['realname1'])): ?><?php echo $vo['realname1']; endif; ?></div><?php if(!empty($vo['cartid1'])): ?><?php echo $vo['cartid1']; endif; ?></td>
							<td><?php echo $vo['mobile']; ?></td>
							<td><?php echo date("Y-m-d H:i",$vo['creationtime']); ?></td>
							<td><?php echo date("Y-m-d H:i",$vo['completetime']); ?></td>
							<td>
								<div id="<?php echo $vo['id']; ?>" class="<?php if($vo['safe'] == 1): ?>layui-unselect layui-form-switch layui-form-onswitch<?php else: ?>layui-unselect layui-form-switch<?php endif; ?>"><i></i></div>
							</td>
							<td>
								<a class="layui-btn layui-btn-mini" onclick="article_edit(<?php echo $vo['id']; ?>)"><i class="iconfont icon-edit"></i> 编辑</a>
                                <a class="layui-btn layui-btn-mini" onclick="comment_add(<?php echo $vo['id']; ?>)"><i class="iconfont icon-edit"></i> 设置保险</a>
								<a class="layui-btn layui-btn-danger layui-btn-mini"   onclick="article_del(<?php echo $vo['id']; ?>)" data-id="1"><i class="layui-icon"></i> 删除</a>
							</td>
						</tr>
                                            <?php endforeach; endif; else: echo "" ;endif; ?>
					</tbody>
					</table>
                     <?php echo $list->render(); ?>
<!--                     <div class="larry-table-page clearfix">
                          <a href="javascript:;" class="layui-btn layui-btn-small"><i class="iconfont icon-shanchu1"></i>删除</a>
				          <div id="page" class="page"><div class="layui-box layui-laypage layui-laypage-default" id="layui-laypage-0"><span class="layui-laypage-curr"><em class="layui-laypage-em"></em><em>1</em></span><a href="javascript:;" data-page="2">2</a><a href="javascript:;" data-page="3">3</a><a href="javascript:;" data-page="4">4</a><a href="javascript:;" data-page="5">5</a><span>…</span><a href="javascript:;" class="layui-laypage-last" title="尾页" data-page="10">末页</a><a href="javascript:;" class="layui-laypage-next" data-page="2">下一页</a></div></div>
			         </div>-->
			    </div>
			     <!-- 登录日志 -->
			    <div class="layui-tab-item layui-field-box">
			          <table class="layui-table table-hover" lay-even="" lay-skin="nob">
                           <thead>
                              <tr>
                                  <th><input type="checkbox" id="selected-all"></th>
                                  <th>ID</th>
                                  <th>管理员账号</th>
                                  <th>状态</th>
                                  <th>最后登录时间</th>
                                  <th>上次登录IP</th>
                                  <th>登录IP</th>
                                  <th>IP所在位置</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td><input type="checkbox"></td>
                                <td>110</td>
                                <td>admin</td>
                                <td>后台登录成功</td>
                                <td>2016-12-19 14:26:03</td>
                                <td>127.0.0.1</td>
                                <td>127.0.0.1</td>
                                <td>Unknown</td>
                              </tr>
                            </tbody>
			          </table>
			          <div class="larry-table-page clearfix">
                          <a href="javascript:;" class="layui-btn layui-btn-small"><i class="iconfont icon-shanchu1"></i>删除</a>
				          <div id="page2" class="page"><div class="layui-box layui-laypage layui-laypage-default" id="layui-laypage-1"><span class="layui-laypage-curr"><em class="layui-laypage-em"></em><em>1</em></span><a href="javascript:;" data-page="2">2</a><a href="javascript:;" data-page="3">3</a><a href="javascript:;" data-page="4">4</a><a href="javascript:;" data-page="5">5</a><span>…</span><a href="javascript:;" class="layui-laypage-last" title="尾页" data-page="10">末页</a><a href="javascript:;" class="layui-laypage-next" data-page="2">下一页</a></div></div>
			         </div>
			    </div>
		    </div>
		</div>
	
</section>
<script type="text/javascript" src="/static/js/jquery.min.js"></script>
<script type="text/javascript" src="/static/common/layui/layui.js"></script>
<script type="text/javascript" src="/static/js/newslist.js"></script>
<script>
    $(".batchDel1").click(function(){
        var $checkbox = $('.news_list tbody input[type="checkbox"][name="checked"]');
        var $checked = $('.news_list tbody input[type="checkbox"][name="checked"]:checked');

       var valArr = new Array;
        if($checkbox.is(":checked")){
            layer.confirm('确定选中的信息已购买了保险？',{icon:3, title:'提示信息'},function(index){
                var index = layer.msg('设置中，请稍候',{icon: 16,time:false,shade:0.8});
                setTimeout(function(){
                   $checked.each(function(i){
                        valArr[i] = $(this).val();
                    });
                   var vals = valArr.join(',');//数组转换以逗号隔开的字符串
                    var data={name:vals};
                    $.ajax({
                        type: "post",
                        url: "<?php echo url('back/article/safes'); ?>",//url为tp方法（控制器/方法）
                        data:data,
                        success: function(data) {

                            if (data.code == 1) {
                                layer.msg('成功！');
                                setTimeout(function(){window.location.reload();},2000);
                            } else {
                                layer.msg('失败！');
                            }
                        },
                        error: function(XMLHttpRequest, textStatus) {
                            alert("页面请求错误，请检查重试或联系管理员！\n" + textStatus);
                        }
                    });
                    //删除数据

                    $('.news_list thead input[type="checkbox"]').prop("checked",false);
                    form.render();
                    layer.close(index);
                    layer.msg("设置成功");
                },2000);
            })
        }else{
            layer.msg("请选择需要设置的内容");
        }
    })

layui.use('laydate', function(){
  var laydate = layui.laydate;

  var start = {
    min: 0
    ,max: '2099-06-16 23:59:59'
    ,istoday: false
    ,choose: function(datas){
      end.min = datas; //开始日选好后，重置结束日的最小日期
      end.start = datas //将结束日的初始值设定为开始日
    }
  };
  
  var end = {
    min: 0
    ,max: '2099-06-16 23:59:59'
    ,istoday: false
    ,choose: function(datas){
      start.max = datas; //结束日选好后，重置开始日的最大日期
    }
  };
  
  document.getElementById('LAY_demorange_s').onclick = function(){
    start.elem = this;
    laydate(start);
  }
  document.getElementById('LAY_demorange_e').onclick = function(){
    end.elem = this
    laydate(end);
  }
  
});
</script>
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
function article_add(id){
    var index = layui.layer.open({
            title : "添加旅游线路",
            type : 2,
            content : "touradd.html",
            success : function(layero, index){
                    setTimeout(function(){
                            layusi.layer.tips('点击此处返回用户列表', '.layui-layer-setwin .layui-layer-close', {
                                    tips: 3
                            });
                    },500)
            }
    })			
    layui.layer.full(index);
}
       //操作
function article_edit(id){
    var index = layui.layer.open({
            title : "修改旅客信息",
            type : 2,
            content : "lvke.html?id="+id,
            success : function(layero, index){
                    setTimeout(function(){
                            layusi.layer.tips('点击此处返回用户列表', '.layui-layer-setwin .layui-layer-close', {
                                    tips: 3
                            });
                    },500)
            }
    })			
    layui.layer.full(index);
}
           //操作
function comment_add(id){
    var _this = $(this);
    layer.confirm('确定？',{icon:3, title:'提示信息'},function(index){
        if(index>0){
            $.ajax({
                type: 'get',
                url: 'safe.html?id='+id,
                success: function(data){
                    if(data>0){
                        layer.msg('成功！');
                        layer.close(index);
                        if(data == 1){
                            $("#"+id).addClass("layui-unselect layui-form-switch layui-form-onswitch");
                            $("#"+id).removeClass("layui-unselect layui-form-switch");
						}else {
                            $("#"+id).addClass("layui-unselect layui-form-switch ");
                            $("#"+id).removeClass("layui-form-onswitch");
						}

                    }else{
                        layer.msg('失败！');
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
//删除
function article_del(id){  //删除
        var _this = $(this);
        layer.confirm('确定删除此信息？',{icon:3, title:'提示信息'},function(index){
                if(index>0){
                    $.ajax({
                    type: 'POST',
                    url: 'lvkedel.html?id='+id,
                    success: function(data){
                        if(data.type ==1){
                            $('#tr_'+id).remove();
                            layer.msg(data.msg);
                            layer.close(index);
                        }else{
                            layer.msg(data.msg);
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
</body></html>