<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:79:"/home/wwwroot/yang.oioos.com/public/../application/index/view/user/myorder.html";i:1524207764;s:73:"/home/wwwroot/yang.oioos.com/public/../application/index/view/header.html";i:1526866272;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title><?php if(!empty($webtitle)): ?><?php echo $webtitle; endif; ?> </title>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" name="viewport">
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta content="black" name="apple-mobile-web-app-status-bar-style">
    <meta content="telephone=no" name="format-detection">
    <meta content="email=no" name="format-detection">
    <link href="/static/home/css/base.css" rel="stylesheet" />
    <link href="/static/home/css/currency.css" rel="stylesheet" />
    <link href="/static/home/css/index.css" rel="stylesheet" />
    <script src="/static/home/js/jquery1.10.2.js"></script>
    <script src="/static/home/js/common.js"></script>
    <script src="/static/home/js/fontSize.js"></script>
    <script src="/static/home/layer/layer.js"></script>
    <script src="/static/js/jquery.cookie.js"></script>
    <link href="/static/home/css/font-awesome.css" rel="stylesheet" />
    <script type="text/javascript">
    	var str = navigator.userAgent;
		$(function(){
			if(str.indexOf("Html5Plus") != -1){
				document.querySelector('.m-head').style.display = 'none';
			}
		})
    </script>
 <link rel="stylesheet" href="/static/home/layui/css/layui.css"  media="all">
</head>
<body style="position:relative;">

    <!--公共头部-->
    <div class="m-head">
        <a href="javascript:;" onclick="javascript:window.history.back();return false;" class="head-goback">
            <i class="fa fa-angle-left"></i>
        </a>
        <p>我的订单</p>
    </div>
    <!--公共头部结束-->
    <!--内容主体-->
    <div class="m-myorder">

        <!--订单分类-->
        <ul class="myorder-class">
            <li class="ahover">
                <a href="javascript:;"  onclick="getMyorder(-1)">全部</a>
            </li>
            <li>
                <a href="javascript:;"  onclick="getMyorder(1)">已付款</a>
            </li>
            <li>
                <a href="javascript:;"  onclick="getMyorder(0)">待付款</a>
            </li>
            <li>
                <a href="javascript:;"  onclick="getMyorder(2)">待收货</a>
            </li>
            <!--<li>-->
                <!--<a href="javascript:;"  onclick="getMyorder(4)">已取消</a>-->
            <!--</li>-->
        </ul>
        <!--订单分类结束-->
        <!--订单列表-->
        <ul class="myorder-list">
            <li class="ahover" id="li_status_-1">
                <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <div class="listBox">
                    <div class="order-numb">
                        <p>订单编号：<span><?php echo $vo['ordersn']; ?></span></p>
                        <p><?php if($vo['status']==1): ?>已付款<?php elseif($vo['status']==0): ?><a href="/index/order/pay/oid/<?php echo $vo['id']; ?>">立即付款</a><?php elseif($vo['status']==4): ?>已取消<?php endif; ?></p>
                    </div>
                    <a href="javascript:;" class="order-info">
                        <img src="<?php if(!empty($vo['img'])) echo imgUrl($vo['img']);else echo '/static/home/images/videobg.jpg'; ?>" class="info-photo" />
                        <div class="info-detail">
                            <p style="padding: .15rem 0  .2rem 0"><?php echo $vo['gname']; ?></p>
                            <?php if($vo['price'] > 0){ ?>
                                <span>预计年化收益率：<?php echo $vo['percentage']; ?>%</span>
                                <span>养殖周期：<?php echo $vo['cycle']; ?>天</span>
                            <?php }else{ ?>
                              <span style="text-overflow: ellipsis;overflow: hidden;white-space: nowrap">送货地址：<?php echo $vo['address']; ?></span>
                            <span style="display: inline">状态：<?php if($vo['status'] == 1): ?>待发货 <?php elseif($vo['status'] == 2): ?><strong style="color: red">待收货</strong><?php elseif($vo['status'] == 3): ?>已收货<?php endif; ?></span>
                            <?php }
                             ?>

                        </div>
                        <div class="info-numb">
                            X<span><?php echo $vo['num']; ?></span>
                        </div>
                    </a>
                    <div class="order-time">
                        <!--<p><span>2017-11-24 15：59</span></p>
                        <p>共计：<i class="fa fa-yen"></i><span>9999999.00</span></p>-->
                        <?php  if($vo['price'] > 0){ ?>
                            <p>实付（元）：<i class="fa fa-yen"></i><span><?php echo $vo['price']; ?></span></p>
                        <?php } else{ ?>
                            <p>实付（积分）：<i class="fa fa-yen"></i><span><?php echo $vo['integral']; ?></span></p>
                        <?php }  if($vo['price'] > 0){ ?>
                        <a href="<?php echo url('/index/user/orderdetail',array('oid'=>$vo['id'])); ?>">查看详情</a>
                        <?php }else{ ?>
                        <a href="<?php echo url('/index/user/orderdetail1',array('oid'=>$vo['id'])); ?>">查看详情</a>
                        <?php } ?>
                    </div>
                    <div class="order-time">
                        <p>下单时间：</p>
                        <p><?php echo date("Y-m-d H:i",$vo['creationtime']); ?></p>
                    </div>
                </div>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </li>
            <li id="li_status_1">
            </li>
            <li id="li_status_0">
            </li>
            <li id="li_status_2">
            </li>
            <li id='li_status_4'>
            </li>
        </ul>
        <!--订单列表结束-->

    </div>
    <!--内容主体结束-->
<ul class="myorder-list"  id="LAY_demo1"></ul>
<input type="hidden" name="status" value="-1" id="status">
<input type="hidden" name="page" value="1"> 
<script src="/static/home/layui/layui.js?t=1515376178709"></script>
<script>
    $(document).ready(function() {
        layui.use('flow', function () {
            var flow = layui.flow;
            var status = $("#status").val();
            flow.load({
                elem: '#LAY_demo1' //流加载容器
                , scrollElem: '#LAY_demo1' //滚动条所在元素，一般不用填，此处只是演示需要。
                , done: function (page, next) { //执行下一页的回调

                    //模拟数据插入
                    setTimeout(function () {
                        var lis = [];
                        $.ajax({
                            type: "post",
                            url: "<?php echo url('index/user/getmoreorder'); ?>" + "&page=" + page,
                            data: {
                                status: status, page: page
                            },
                            success: function (res) {
                                var html = '';
                                layui.each(res.data, function (index, item) {
                                    if (item.status == 1) {
                                        var status = '<p>' + '已付款' + '</p>';
                                    } else if (item.status == 0) {
                                        var status = '<p>' + "<a href=\"/index/order/pay/oid/'+item.id+'\">立即付款</a>" + '</p>';
                                    } else if (item.status == 4) {
                                        var status = '<p>' + '已取消' + '</p>';
                                    }
                                    if (!item.img) {
                                        var img = '/static/home/images/sheep.jpg';
                                    } else {
                                        var img = '/server/' + item.img;
                                    }
                                    html += '<li class="ahover"><div class="listBox">';
                                    html += '<div class="order-numb">';
                                    html += '<p>订单编号：<span>' + item.ordersn + '</span></p>' + status;
                                    html += '    </div>';
                                    html += '    <a href="/index/user/orderdetail/oid/' + item.id + '" class="order-info">';
                                    html += '        <img src="' + img + '" class="info-photo" />';
                                    html += '        <div class="info-detail">';
                                    html += '            <p style="padding: .15rem 0  .2rem 0">' + item.gname + '</p>';
                                    if(item.price > 0) {
                                        html += '            <span>预计年化收益率：' + item.percentage + '%</span>';
                                        html += '            <span>养殖周期：' + item.cycle + '天</span>';
                                    }else{
                                        html+='            <span style="text-overflow: ellipsis;overflow: hidden;white-space: nowrap">送货地址：'+item.address+'</span>';
                                        html+='<span style="display: inline">状态：';
                                        if(item.status == 1){
                                            html+='已付款';
                                        } else if(item.status == 2){
                                            html+='<strong style="color: red">'+'待收货'+'</strong>';
                                        } else if(item.status == 3){
                                            html+='已收货';
                                        }
                                        html+='</span>';
                                    }
                                    html += '        </div>';
                                    html += '        <div class="info-numb">';
                                    html += '            X<span>' + item.num + '</span>';
                                    html += '        </div>';
                                    html += '    </a>';
                                    html += '    <div class="order-time">';
                                    if(item.price > 0){
                                        html += '         <p>实付（元）：<i class="fa fa-yen"></i><span>' + item.price + '</span></p>';
                                    }else{
                                        html += '         <p>实付（积分）：<i class="fa fa-yen"></i><span>' + item.integral + '</span></p>';
                                    }
                                    if(item.price > 0)
                                    html += '         <a href="/index/user/orderdetail/oid/' + item.id + '">查看详情</a>';
                                    else
                                        html += '         <a href="/index/user/orderdetail1/oid/' + item.id + '">查看详情</a>';
                                    //html+='        <p><span>'+formatDateTime(value.paytime)+'</span></p>';
                                    //html+='        <p>共计：<i class="fa fa-yen"></i><span>'+value.money+'</span></p>';
                                    html += '    </div>';
                                    html += '    <div class="order-time">';
                                    html += '         <p>下单时间：</p>';
                                    html += '         <p>' + formatDateTime(item.paytime) + '</p>';
                                    html += '    </div>';

                                    html += '</div></li>';

                                });
                                lis.push(html);
                                //执行下一页渲染，第二参数为：满足“加载更多”的条件，即后面仍有分页
                                //pages为Ajax返回的总页数，只有当前页小于总页数的情况下，才会继续出现加载更多
                                next(lis.join(''), page < res.pages);
                            } //假设总页数为 10
                        }), 500
                    });
                }
            });
        });
    })

</script>
 <script>
        function getMyorder(status){
            var page = 1;
            $("#status").val(status);
            $.ajax({
                type: 'POST',
                url: '<?php echo url("/index/user/getmyorder"); ?>',
                data:{
                    status:status,
                    page:page
                },
                dataType:'json',
                success: function(data){
                    if(data.type==1){
                        var html = '';
                        $.each(data.data,function(index,value){
                            html+='<div class="listBox">';
                            html+='    <div class="order-numb">';
                            html+='        <p>订单编号：<span>'+value.ordersn+'</span></p>';
                            if(status==1){
                                html+='        <p>已付款</p>';
                            }else if(status==0){
                                html+='        <a href="/index/order/pay/oid/'+value.id+'">立即付款</a>';
                            }else if(status==4){
                                html+='        <p>已取消</p>';
                            }
                            if(status == -1){

                                if (value.status == 1) {
                                    html+='<p>已付款</p>';
                                } else if (value.status == 0) {
                                    html+=' <a href="/index/order/pay/oid/'+value.id+'">立即付款</a>';
                                } else if (value.status == 4) {
                                    html+='        <p>已取消</p>';
                                }
                            }

                            if(value.img){
                                var img = '/server/'+value.img;
                            }else{
                                var img ='/static/home/images/sheep.jpg';
                            }
                            
                            html+='    </div>';
                            html+='    <a href="/index/user/orderdetail/oid/'+value.id+'" class="order-info">';
                            html+='        <img src="'+img+'" class="info-photo" />';
                            html+='        <div class="info-detail">';
                            html+='            <p style="padding: .15rem 0  .2rem 0">'+value.gname+'</p>';
                            if(value.price > 0){
                                html+='            <span>预计年化收益率：'+value.percentage+'%</span>';
                                html+='            <span>养殖周期：'+value.cycle+'天</span>';
                            }else{
                                html+='            <span style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis">送货地址：'+value.address+'</span>';
                                html+='<span style="display: inline">状态：';
                                    if(value.status == 1){
                                        html+='已付款';
                                    } else if(value.status == 2){
                                        html+='<strong style="color: red">'+'待收货'+'</strong>';
                                    } else if(value.status == 3){
                                        html+='已收货';
                                    }
                                   html+='</span>';
                            }

                            html+='        </div>';
                            html+='        <div class="info-numb">';
                            html+='            X<span>'+value.num+'</span>';
                            html+='        </div>';
                            html+='    </a>';
                            html+='    <div class="order-time">';
                            if(value.price > 0){
                                html+='         <p>实付（元）：<i class="fa fa-yen"></i><span>'+value.price+'</span></p>';
                            }else {
                                html+='         <p>实付（积分）：<i class="fa fa-yen"></i><span>'+value.integral+'</span></p>';
                            }
                            if(value.price > 0){
                                html+='         <a href="/index/user/orderdetail/oid/'+value.id+'">查看详情</a>';
                            }else {
                                html+='         <a href="/index/user/orderdetail1/oid/'+value.id+'">查看详情</a>';
                            }

                            //html+='        <p><span>'+formatDateTime(value.paytime)+'</span></p>';
                            //html+='        <p>共计：<i class="fa fa-yen"></i><span>'+value.money+'</span></p>';
                            html+='    </div>';
                            html+='    <div class="order-time">';
                            html+='         <p>下单时间：</p>';
                            html+='         <p>'+formatDateTime(value.paytime)+'</p>';
                            html+='    </div>';
                            
                            html+='</div>';
                        });
                        $("#LAY_demo1").html('');
                        $("#li_status_"+status).html(html);
                    }else{
                        layer.msg(data.msg);
                    }
                },
                error: function(xhr){
                    layer.msg('error');
                }
            });
        }
        function formatDateTime(timeStamp) {   
            var date = new Date();  
            date.setTime(timeStamp * 1000);  
            var y = date.getFullYear();      
            var m = date.getMonth() + 1;      
            m = m < 10 ? ('0' + m) : m;      
            var d = date.getDate();      
            d = d < 10 ? ('0' + d) : d;      
            var h = date.getHours();    
            h = h < 10 ? ('0' + h) : h;    
            var minute = date.getMinutes();    
            var second = date.getSeconds();    
            minute = minute < 10 ? ('0' + minute) : minute;      
            second = second < 10 ? ('0' + second) : second;     
            return y + '-' + m + '-' + d+' '+h+':'+minute+':'+second;      
        };   
        </script>
</body>
</html>
