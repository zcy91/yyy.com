<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:80:"E:\phpStudy\WWW\yyy.com\public/../application/back\view\capital\withdrawals.html";i:1521603894;}*/ ?>
<!DOCTYPE html>
<html lang="en"><head>
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
<link id="layuicss-skinlayercss" rel="stylesheet" href="http://www.17sucai.com//preview/33522/2017-10-20/LarryCMS-new/common/layui/css/modules/layer/default/layer.css?v=3.0.11110" media="all"></head>
<body>
<section class="layui-larry-box">
	<div class="larry-personal">
	    <div class="layui-tab">
            <blockquote class="layui-elem-quote news_search">
		<form class="layui-form" action="">
		<div class="layui-inline">
                    <div class="layui-input-inline">
                        <select name="search">
                          <option value="mohu" <?php if(!empty($query['query']['search']) && $query['query']['search']=='mohu'): ?>selected=""<?php endif; ?>>模糊搜索</option>
                          <option value="id" <?php if(!empty($query['query']['search']) && $query['query']['search']=='id'): ?>selected=""<?php endif; ?>>ID</option>
                          <option value="uid" <?php if(!empty($query['query']['search']) && $query['query']['search']=='uid'): ?>selected=""<?php endif; ?>>用户ID</option>
                          <option value="applysn" <?php if(!empty($query['query']['search']) && $query['query']['search']=='applysn'): ?>selected=""<?php endif; ?>>提现单号</option>
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
		</div>
		<div class="layui-inline">
                    <a class="layui-btn " href="<?php if(!empty($query['query'])): ?><?php echo url('/back/set/export',array_merge(array('tablename'=>'tixianshenqing'),$query['query'])); else: ?><?php echo url('/back/set/export',array('tablename'=>'tixianshenqing')); endif; ?>" >导出Excel</a>
		</div>
		<div class="layui-inline">
			<!--			<a class="layui-btn layui-btn-danger batchDel">批量删除</a>-->
		</div>
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
							<th>
                                                            <input name="" lay-skin="primary" lay-filter="allChoose" id="allChoose" type="checkbox"><div class="layui-unselect layui-form-checkbox"><span>勾选</span><i class="layui-icon"></i></div>
							</th>
							<th  width="5%">ID</th>
							<th>提现串号</th>
                                                        <th>申请人</th> 
                                                        <th>申请人ID</th> 
							<th>申请金额</th>							
							<th>到款金额</th>
                                                        <th>提现类型</th>
							<th>支付宝或银行账号</th>   
                                                        <th>申请时间</th>
							<th>审核时间</th>
                                                        <th>状态</th>
							<th>操作</th>
						</tr>
					</thead>
					<tbody class="news_content">
                                            <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                                <tr id="tr_<?php echo $vo['id']; ?>">
							<td>
                                                            <input name="checked" lay-skin="primary" lay-filter="choose" type="checkbox"><div class="layui-unselect layui-form-checkbox"><span>勾选</span><i class="layui-icon"></i></div>
							</td>
							<td align="left"><?php echo $vo['id']; ?></td>
							<td><?php echo $vo['applysn']; ?></td>
							<td><?php echo $vo['username']; ?></td>
							<td><?php echo $vo['uid']; ?></td>
							<td><?php echo $vo['money']; ?></td>
							<td><?php echo $vo['money_pay']; ?></td>
							<td><?php if($vo['type']==0): ?>余额<?php elseif($vo['type']==1): ?>微信<?php elseif($vo['type']==2): ?>支付宝<?php elseif($vo['type']==3): ?>银行卡<?php endif; ?></td>
							<td><?php echo $vo['alipay']; ?><?php echo $vo['realname']; ?>#<?php echo $vo['bankname']; ?>#<?php echo $vo['bankcard']; ?></td>
                                                        <td><?php echo date("Y-m-d H:i",$vo['applytime']); ?></td>
                                                        <td><?php if(!empty($vo['handletime']))echo date("Y-m-d H:i",$vo['handletime']); ?></td>
                                                        <td>
                                                            <?php if($vo['status']==-1): ?>
                                                            <button class="layui-btn layui-btn-danger layui-btn-mini">驳回申请</button>
                                                            <?php elseif($vo['status']==0): ?>
                                                            未处理
                                                            <?php elseif($vo['status']==1): ?>
                                                            <button class="layui-btn  layui-btn-mini">正在申请</button>
                                                            <?php elseif($vo['status']==2): ?>
                                                            <button class="layui-btn layui-btn-normal layui-btn-mini">审核通过</button>
                                                            <?php endif; ?>
                                                        </td>
							<td>
                                                                <button class="layui-btn layui-btn-radius layui-btn-mini" onclick="paymoney(<?php echo $vo['id']; ?>,1)">微信红包</button>
                                                                <button class="layui-btn layui-btn-radius layui-btn-normal layui-btn-mini" onclick="paymoney(<?php echo $vo['id']; ?>,2)">线下打款</button>
                                                                <button class="layui-btn layui-btn-radius layui-btn-danger layui-btn-mini" onclick="paymoney(<?php echo $vo['id']; ?>,0)">驳回申请</button>
								
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
<script type="text/javascript" src="/static/common/layui/layui.js"></script>
<script type="text/javascript" src="/static/js/newslist.js"></script>
<script>
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
 

function paymoney(id,type){  
        if(type==1){
            var paystr = '你确定使用微信打款吗？';
        }else if(type==2){
            var paystr = '你确定线下已打款吗？';
        }else if(type==0){
            var paystr = '你确定打款到余额吗？';
        }
        var _this = $(this);
        layer.confirm(paystr,{icon:3, title:'提示信息'},function(index){
                if(index>0){
                    $.ajax({
                    type: 'POST',
                    url: '<?php echo url('/back/capital/paymoney'); ?>',
                    data:{
                      id:id,
                      type:type
                    },
                    dataType:'json',
                    success: function(data){
                        if(data.type==1){
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