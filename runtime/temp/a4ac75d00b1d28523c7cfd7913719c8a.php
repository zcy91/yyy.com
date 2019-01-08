<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:73:"D:\wamp64\www\yyy.com\public/../application/index\view\user\exchange.html";i:1533028254;s:66:"D:\wamp64\www\yyy.com\public/../application/index\view\header.html";i:1532921433;}*/ ?>
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
    <style>
        .nav-link {
            position: absolute;
            display: block;
            line-height: 34px;
            font-size: 10px;
            font-weight: bold;
            color: #555;
            text-decoration: none;
            right: .7rem;
            top:.3rem
        }
        .nav-link:hover {
            color: #333;
            text-decoration: underline;
        }

        .nav-counter {
            position: absolute;
            top:0.1rem;
            right: -0.55rem;
            min-width: 8px;
            height: 20px;
            line-height: 20px;
            margin-top: -11px;
            padding: 0 6px;
            font-weight: normal;
            color: white;
            text-align: center;
            text-shadow: 0 1px rgba(0, 0, 0, 0.2);
            background: #e23442;
            border: 1px solid #911f28;
            border-radius: 11px;
            background-image: -webkit-linear-gradient(top, #e8616c, #dd202f);
            background-image: -moz-linear-gradient(top, #e8616c, #dd202f);
            background-image: -o-linear-gradient(top, #e8616c, #dd202f);
            background-image: linear-gradient(to bottom, #e8616c, #dd202f);
            -webkit-box-shadow: inset 0 0 1px 1px rgba(255, 255, 255, 0.1), 0 1px rgba(0, 0, 0, 0.12);
            box-shadow: inset 0 0 1px 1px rgba(255, 255, 255, 0.1), 0 1px rgba(0, 0, 0, 0.12);
        }

        .nav-counter-green {
            background: #75a940;
            border: 1px solid #42582b;
            background-image: -webkit-linear-gradient(top, #8ec15b, #689739);
            background-image: -moz-linear-gradient(top, #8ec15b, #689739);
            background-image: -o-linear-gradient(top, #8ec15b, #689739);
            background-image: linear-gradient(to bottom, #8ec15b, #689739);
        }

        .nav-counter-blue {
            background: #3b8de2;
            border: 1px solid #215a96;
            background-image: -webkit-linear-gradient(top, #67a7e9, #2580df);
            background-image: -moz-linear-gradient(top, #67a7e9, #2580df);
            background-image: -o-linear-gradient(top, #67a7e9, #2580df);
            background-image: linear-gradient(to bottom, #67a7e9, #2580df);
        }
        .xiaoxi{
            color: #fff;
            margin-right: .05rem;
        }
    </style>


 <link rel="stylesheet" href="/static/home/layui/css/layui.css"  media="all">
</head>
<body style="position:relative;">
<style>
    .myorder-class li{
        width: 20%;
    }
</style>
    <!--公共头部-->
    <div class="m-head">
        <a href="javascript:;" onclick="javascript:window.history.back();return false;" class="head-goback">
            <i class="fa fa-angle-left"></i>
        </a>
        <p>羊羔兑换记录</p>
    </div>
    <!--公共头部结束-->
    <!--内容主体-->
    <div class="m-myorder">

        <!--订单分类-->
        <ul class="myorder-class">
            <li class="ahover">
                <a href="javascript:;"  onclick="getMyorder(4)">全部</a>
            </li>
            <li>
                <a href="javascript:;"  onclick="getMyorder(1)">待审核</a>
            </li>
            <li>
                <a href="javascript:;"  onclick="getMyorder(3)">待收货</a>
            </li>
            <li>
                <a href="javascript:;"  onclick="getMyorder(2)">已完成</a>
            </li>
            <li>
                <a href="javascript:;"  onclick="getMyorder(-1)">已驳回</a>
            </li>
            <!--<li>-->
                <!--<a href="javascript:;"  onclick="getMyorder(4)">已取消</a>-->
            <!--</li>-->
        </ul>
        <!--订单分类结束-->
        <!--订单列表-->
        <ul class="myorder-list">
            <li class="ahover" id="li_status_-1" >
                <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <div class="listBox">
                    <div class="order-numb">
                        <p>兑换编号：<span><?php echo $vo['sellsn']; ?></span></p>
                        <p><?php if($vo['status']==1): ?>待审核<?php elseif($vo['status']==2): ?>已完成<?php elseif($vo['status']==-1): ?>已驳回<?php endif; ?></p>
                    </div>
                    <a href="javascript:;" class="order-info">
                        <img src="<?php if(!empty($vo['avatar'])) echo imgUrl($vo['avatar']);else echo '/static/home/images/videobg.jpg'; ?>" class="info-photo" />
                        <div class="info-detail">
                            <p style="padding: 0"><?php echo $vo['lambname']; ?></p>
                            <?php if($vo['money'] > 0){ ?>
                            <span style="margin-top: .1rem">兑换类型：收益</span>
                            <span style="margin-top: .1rem">收益金额：<?php echo $vo['money']; ?>元</span>
                            <span style="display: inline">状态：<?php if($vo['status'] == 1): ?>待审核 <?php elseif($vo['status'] == 2): ?><strong style="color: red">已完成</strong> <?php elseif($vo['status'] == -1): ?><strong style="color: red">已驳回</strong><?php endif; ?></span>
                            <?php }elseif($vo['exchange'] == 1){ ?>
                            <span style="margin-top: .1rem">兑换类型：产品</span>
                              <span style="text-overflow: ellipsis;overflow: hidden;white-space: nowrap">送货地址：<?php $address = db('address')->where('id',$vo['address_id'])->find(); ?><?php echo $address['province']; ?>-<?php echo $address['city']; ?>-<?php echo $address['area']; ?>-<?php echo $address['detailed']; ?></span>
                            <span style="display: inline">状态：<?php if($vo['status'] == 1): ?>待审核 <?php elseif($vo['status'] == 2): ?><strong style="color: red">已完成</strong><?php elseif($vo['status'] == 3): ?>待收货 <?php elseif($vo['status'] == -1): ?><strong style="color: red">已驳回</strong><?php endif; ?></span>

                            <?php }elseif($vo['exchange'] == 3){  ?>
                            <span style="margin-top: .1rem">兑换类型：旅游</span>
                            <span  style="margin-top: .1rem" onclick="detail(this)">旅游计划：<strong style="color:blue">查看详情</strong></span>
                            <span style="display: inline">状态：<?php if($vo['status'] == 1): ?>待审核 <?php elseif($vo['status'] == 2 || $vo['status'] ==4): ?><strong style="color: red">已完成</strong> <?php elseif($vo['status'] == -1): ?><strong style="color: red">已驳回</strong><?php elseif($vo['status'] == -2): ?><strong style="color: red">已申请取消行程</strong><?php endif; if($vo['isdelete'] == 1): ?><strong style="color: red">&nbsp;取消行程</strong><?php endif; ?></span>
                            <?php }elseif($vo['exchange']==4){ ?>
                            <span style="margin-top: .1rem">兑换类型：赠送</span>
                            <span>好友ID：<?php echo $vo['buyid']; ?></span>
                            <span style="display: inline">状态：<?php if($vo['status'] == 1): ?>待审核 <?php elseif($vo['status'] == 2): ?><strong style="color: red">已完成</strong><?php endif; ?></span>
                            <?php } ?>
                        </div>
                        <div class="order-time" style="height: .35rem">
                            <a href="<?php echo url('index/user/exchange_detail',array('id'=>$vo['id'])); ?>">查看详情</a>
                        </div>
                    </a>
                    <div class="order-time">
                        <p>兑换时间：</p>
                        <p><?php echo date("Y-m-d H:i",$vo['creationtime']); ?></p>
                    </div>
                </div>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </li>
            <li id="li_status_1">
            </li>
            <li id="li_status_3">
            </li>
            <li id="li_status_2">
            </li>
            <li id='li_status_10'>
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
</script>
 <script>
     function detail(obj) {
         var url = "/index/discovery/content/id/16/agentid/"+<?php echo $uid; ?>+".html";

         window.location.href=url;
     }
        function getMyorder(status){
            var page = 1;
            $("#status").val(status);
            $.ajax({
                type: 'POST',
                url: '<?php echo url("/index/user/get_exchange"); ?>',
                data:{
                    status:status,
                    page:page
                },
                dataType:'json',
                success: function(date){
                    if(date.type==1){
                        var html = '';
                        $.each(date.data,function(index,value){
                            html+='<div class="listBox">';
                            html+='    <div class="order-numb">';
                            html+='        <p>兑换编号：<span>'+value.sellsn+'</span></p>';
                            if(status==1){
                                html+='        <p>待审核</p>';
                            }else if(status==2){
                                html+='      <p>已完成</p>';
                            }else if(status==-1){
                                html+='        <p>已驳回</p>';
                            }
                            if(status == 4){

                                if (value.status == 1) {
                                    html+='<p>待审核</p>';
                                } else if (value.status == 2) {
                                    html+=' <p>已完成</p>';
                                } else if (value.status == -1) {
                                    html+='        <p>已驳回</p>';
                                }
                            }

                            if(value.avatar){
                                var img = '/server/'+value.avatar;
                            }else{
                                var img ='/static/home/images/sheep.jpg';
                            }
                            
                            html+='    </div>';
                            html+='    <a href="javascript:;" class="order-info">';
                            html+='        <img src="'+img+'" class="info-photo" />';
                            html+='        <div class="info-detail">';
                            html+='            <p style="padding:0">'+value.lambname+'</p>';
                            if(value.money > 0){
                                html+='             <span style="margin-top: .1rem">兑换类型：收益</span>';
                                html+='   <span style="margin-top: .1rem">收益金额：'+value.money+'元</span>';
                                html+='<span style="display: inline">状态：';
                                if (value.status == 1) {
                                    html += '待审核';
                                }else if (value.status == 2){
                                    html +='已完成';
                                } else if (value.status == -1){
                                    html +='<strong style="color: red">已驳回</strong>';
                                }
                                html+='</span>';
                            }else if(value.exchange == 1){
                               html+=' <span style="margin-top: .1rem">兑换类型：产品</span>';
                                html+= '<span style="text-overflow: ellipsis;overflow: hidden;white-space: nowrap">送货地址：'
                                html+=date.address.province+" -"+ date.address.city +'-'+ date.address.area +'-'+ date.address.detailed+"</span>";
                                html+='<span style="display: inline">状态：';
                                    if(value.status == 1){
                                        html+='待审核';
                                    } else if(value.status == 2){
                                        html+='<strong style="color: red">'+'已完成'+'</strong>';
                                    } else if(value.status == 3){
                                        html+='待收货';
                                    } else if (value.status == -1){
                                        html+='<strong style="color: red">'+'已驳回'+'</strong>';
                                    }
                                   html+='</span>';
                            }else if(value.exchange == 3){
                                html+='<span style="margin-top: .1rem">兑换类型：旅游</span>';
                                html+='<span  style="margin-top: .1rem" onclick="detail(this)">旅游计划：<strong style="color:blue">查看详情</strong></span>';
                                html+='<span style="display: inline">状态：';
                                if (value.status == 1) {
                                    html += '待审核';
                                }else if (value.status == 2){
                                    html +='<strong style="color: red">已完成</strong>';
                                } else if( value.status == -1){
                                    html +='<strong style="color: red">已驳回</strong>';
                                }
                            }else if(value.exchange == 4){
                                    html +=' <span style="margin-top: .1rem">兑换类型：赠送好友</span>' +
                                        ' <span>好友ID：'+value.buyid+'</span>'
                                    html +='<strong style="color: red">已完成</strong>';
                            }

                            html+='        </div>';
                            html+='        <div class="info-numb">';
                            html+='        </div>';
                            html+='    </a>';
                            html+='    <div class="order-time" style="height: .35rem">';
                            if(value.price > 0){
                                html+='         <a href="/index/user/exchange_detail/id/'+value.id+'">查看详情</a>';
                            }else {
                                html+='         <a href="/index/user/exchange_detail/id/'+value.id+'">查看详情</a>';
                            }

                            //html+='        <p><span>'+formatDateTime(value.paytime)+'</span></p>';
                            //html+='        <p>共计：<i class="fa fa-yen"></i><span>'+value.money+'</span></p>';
                            html+='    </div>';
                            html+='    <div class="order-time">';
                            html+='         <p>兑换时间：</p>';
                            html+='         <p>'+formatDateTime(value.creationtime)+'</p>';
                            html+='    </div>';
                            
                            html+='</div>';
                        });
                        $("#LAY_demo1").html('');
                        if(status == -1 ){
                            $("#li_status_10").html(html);
                        }else{
                            $("#li_status_"+status).html(html);
                        }

                    }else{
                        layer.msg(date.data);
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
