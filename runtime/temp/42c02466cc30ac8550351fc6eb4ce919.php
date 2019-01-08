<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:72:"D:\wamp64\www\yyy.com\public/../application/back\view\user\exchange.html";i:1536391857;}*/ ?>
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
        <header class="larry-personal-tit">
            <span>羊羔列表</span>
            <div class="larry-side-menu" onclick="javascript:location.reload();" style="    position: absolute;    cursor: pointer;    z-index: 19490201;    right:  100px;    color: white;    text-align: center;    width: 30px;    height: 30px;    background-color: #1AA094;    line-height: 30px;    top: 6%;">
                <i class="fa " aria-hidden="true">刷新</i>
            </div>
            <!--                        <div class="larry-side-menu" onclick="javascript:window.opener=null;window.open('','_self');window.close();" style="    position: absolute;    cursor: pointer;    z-index: 19490201;    right:  50px;    color: white;    text-align: center;    width: 30px;    height: 30px;    background-color: #FF0033;    line-height: 30px;    top: 6%;">
                                            <i class="fa " aria-hidden="true">关闭</i>
                                    </div>-->

        </header><!-- /header -->
        <div class="layui-tab">
            <blockquote class="layui-elem-quote news_search">
                <form class="layui-form">
                    <div class="layui-inline">
                        <div class="layui-input-inline">
                            <select name="search">
                                <option value="mohu" <?php if(!empty($query['query']['search']) && $query['query']['search']=='mohu'): ?>selected=""<?php endif; ?>>模糊搜索</option>
                                <option value="id" <?php if(!empty($query['query']['search']) && $query['query']['search']=='id'): ?>selected=""<?php endif; ?>>ID</option>
                                <option value="username" <?php if(!empty($query['query']['search']) && $query['query']['search']=='lambname'): ?>selected=""<?php endif; ?>>昵称</option>
                                <option value="mobile" <?php if(!empty($query['query']['search']) && $query['query']['search']=='lambsn'): ?>selected=""<?php endif; ?>>耳号</option>
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
                    <input type="hidden" value="<?php echo $uid; ?>" name="uid" id="uid">
                    <button type="submit" class="layui-btn ">查询</button>
                    <div class="layui-inline">
                        <a class="layui-btn layui-btn-normal userAdd_btn">添加用户</a>
                    </div>

                    <div class="layui-inline">
                        <a class="layui-btn " href="<?php if(!empty($query['query'])): ?><?php echo url('/back/set/export',array_merge(array('tablename'=>'member'),$query['query'])); else: ?><?php echo url('/back/set/export',array('tablename'=>'member')); endif; ?>" >导出Excel</a>
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
                        <col >
                        <col>
                        <col >
                        <col >
                        <col>
                        <col >
                        <col >


                        <!--<col width="9%">-->
                        <!--<col width="9%">-->
                        <col width="10%">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>
                            <input name="" lay-skin="primary" lay-filter="allChoose" id="allChoose" type="checkbox"><div class="layui-unselect layui-form-checkbox"><span>勾选</span><i class="layui-icon"></i></div>
                        </th>
                        <th width="5%">ID</th>
                        <th>昵称</th>
                        <th>耳号</th>
                        <th>支付时间</th>
                        <th style="width: 180px;">创建时间</th>
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
                        <td><?php echo $vo['lambname']; ?></td>
                        <td><?php echo $vo['lambsn']; ?></td>
                        <td><?php echo date("Y-m-d H:i",$vo['paytime']); ?></td>
                        <td><?php echo date("Y-m-d H:i",$vo['creationtime']); ?></td>
            <td>
                <a class="layui-btn layui-btn-mini" style="margin-left: 10px" onclick="exchangelvyou(<?php echo $vo['id']; ?>)">兑换旅游</a>
                <a class="layui-btn  layui-btn-mini" style="background-color: #0aba07" onclick="exchange(<?php echo $vo['id']; ?>)">兑换产品</a>
                <!--<a class="layui-btn layui-btn-normal layui-btn-mini" onclick="recharge(<?php echo $vo['id']; ?>)"><i class="layui-icon"></i> 充值</a>-->
                <!--<a class="layui-btn layui-btn-danger layui-btn-mini" onclick="user_del(<?php echo $vo['id']; ?>)" data-id="1"><i class="layui-icon"></i> 删除</a>-->
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
<script type="text/javascript" src="/static/common/layui/lay/modules/layer.js"></script>

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
    function exchangelvyou(id){
        var uid = $("#uid").val();
        var index = layui.layer.open({
            title : "兑换旅游",
            type : 2,
            content : "exchangelvyou.html?id="+id+"&uid="+uid,
            success : function(layero, index){
                setTimeout(function(){

                },500)
            }
        })
        layui.layer.full(index);
    }
    //操作
    function exchange(id){
        var uid = $("#uid").val();
        var index = layui.layer.open({
            title : "兑换产品",
            type : 2,
            content : "exchangeproduct.html?id="+id+"&uid="+uid,
            success : function(layero, index){
                setTimeout(function(){

                },500)
            }
        })
        layui.layer.full(index);
    }
    //操作


    //删除
    function user_del(id){  //删除
        var _this = $(this);
        layer.confirm('确定删除此信息？',{icon:3, title:'提示信息'},function(index){
            if(index>0){
                $.ajax({
                    type: 'POST',
                    url: 'userdel.html?id='+id,
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
</body></html>