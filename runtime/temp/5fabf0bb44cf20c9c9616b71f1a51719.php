<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:82:"E:\phpStudy\WWW\yyy.com\public/../application/index\view\user\exchange_detail.html";i:1528527279;s:68:"E:\phpStudy\WWW\yyy.com\public/../application/index\view\header.html";i:1528532196;}*/ ?>
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


</head>
<body style="position:relative;">
<style>
    #anniu1 { display: block; float: right;  right: .2rem; background: #f66c48; color: #fff; padding: .1rem .2rem; font-size: .25rem; border-radius: .1rem; overflow: hidden; }
    #anniu { display: block; float: right;  right: .2rem; background: #f66c48; color: #fff; padding: .1rem .2rem; font-size: .25rem; border-radius: .1rem; overflow: hidden; }
</style>
    <!--公共头部-->
    <div class="m-head">
        <a href="javascript:;" onclick="javascript:window.history.back();return false;" class="head-goback">
            <i class="fa fa-angle-left"></i>
        </a>
        <p>兑换详情</p>
    </div>
    <!--公共头部结束-->
    <!--内容主体-->
    <div class="m-orderdetail">
        <!--订单编号-->
        <div class="orderdetail-numb">
            <p>兑换编号：<span><?php echo $myorder['0']['sellsn']; ?></span></p>
        </div>
        <!--订单编号结束-->
        <!--羊羔信息-->
        <div class="orderdetail-sheep">
            <?php if(is_array($myorder) || $myorder instanceof \think\Collection || $myorder instanceof \think\Paginator): $i = 0; $__LIST__ = $myorder;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <div class="infoBox">
                <div class="info-photo">
                    <img src="<?php if(!empty($vo['avatar'])) echo imgUrl($vo['avatar']);else echo '/static/home/images/videobg.jpg'; ?>" style="position: unset;width: 100%"/>
                </div>
                <div class="info-detail">
                    <?php 
                    if($vo['money']>0){ ?>
                    <div class="detail-name">羊羔名字：<span><?php echo $vo['lambname']; ?></span></div>
                    <div class="detail-cycle" style="padding-top: 0">羊羔价格：<span><?php echo $vo['price']; ?>元</span></div>
                    <div class="detail-cycle" style="padding-top: 0">养殖周期：<span><?php echo floor(($myorder[0]['creationtime'] - $myorder[0]['paytime'])/(60*60*24)) ?></span><u>天</u></div>
                    <div class="detail-rebate"><span><?php echo $vo['percentage']; ?>%</span><u>预计年化收益率</u></div>
                    <div class="detail-numb"></div>
                    <?php } elseif($vo['exchange']==1){  ?>
                    <div class="detail-name">羊羔名字：<span><?php echo $vo['lambname']; ?></span></div>
                    <div class="detail-cycle" style="padding-top: 0">羊羔价格：<span><?php echo $vo['price']; ?>元</span></div>
                    <div class="detail-cycle" style="padding-top: 0">养殖周期：<span><?php echo floor(($myorder[0]['creationtime'] - $myorder[0]['paytime'])/(60*60*24)) ?></span><u>天</u></div>
                    <div class="detail-cycle" style="padding-top: 0"  onclick="goods_detail()">产品详情：<strong style="color:blue">查看详情</strong></div>
                    <?php }elseif($vo['exchange']==3){ ?>
                    <div class="detail-name">羊羔名字：<span><?php echo $vo['lambname']; ?></span></div>
                    <div class="detail-cycle" style="padding-top: 0">羊羔价格：<span><?php echo $vo['price']; ?>元</span></div>
                    <div class="detail-cycle" style="padding-top: 0">养殖周期：<span><?php echo floor(($myorder[0]['creationtime'] - $myorder[0]['paytime'])/(60*60*24)) ?></span><u>天</u></div>
                    <div class="detail-cycle"  style="padding-top: 0" onclick="detail()">旅游计划：<strong style="color:blue">查看详情</strong></div>
                    <?php }elseif($vo['exchange']==4){ ?>
                    <div class="detail-name">羊羔名字：<span><?php echo $vo['lambname']; ?></span></div>
                    <div class="detail-cycle" style="padding-top: 0">羊羔价格：<span><?php echo $vo['price']; ?>元</span></div>
                    <div class="detail-cycle" style="padding-top: 0">养殖周期：<span><?php echo floor(($myorder[0]['creationtime'] - $myorder[0]['paytime'])/(60*60*24)) ?></span><u>天</u></div>
                    <div class="detail-cycle"  style="padding-top: 0" onclick="friend_detail(<?php echo $myorder[0]['buyid']; ?>)">好友ID：<strong style="color:blue"><?php echo $myorder[0]['buyid']; ?></strong></div>
                    <?php } ?>
                </div>
            </div>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <!--羊羔信息结束-->
        <!--资金信息-->
        <?php if($myorder['0']['money'] > 0): ?>
        <div class="orderdetail-money">
            <div class="moneyBox">
                <span>兑换金额</span>
                <p><i class="fa fa-yen"></i><u><?php echo $myorder['0']['money']; ?></u></p>
            </div>
        </div>
        <?php endif; if($myorder['0']['status'] ==3): ?>
        <div class="orderdetail-money" style="padding: 0">
            <div class="moneyBox moneySum">
                <a style="" onclick="complete()" id="anniu"> 确认收货</a>
            </div>
        </div>
        <?php endif; if($del ==1): ?>
        <div class="orderdetail-money" style="padding: 0">
            <div class="moneyBox moneySum">
                <a style="" onclick="complete1()" id="anniu1"> 取消行程</a>
            </div>
        </div>
        <?php endif; ?>
        <!--资金信息结束-->
        <!--订单信息-->
        <div class="orderdetail-info">
            <p>兑换类型：<?php if($myorder[0]['exchange']==1): ?>产品 <?php elseif($myorder[0]['exchange']==2): ?>收益<?php elseif($myorder[0]['exchange']==3): ?>旅游<?php elseif($myorder[0]['exchange']==4): ?>赠送<?php endif; ?></p>
            <p>兑换状态：<?php if($myorder[0]['status']==1): ?>待审核 <?php elseif($myorder[0]['status']==2 || $myorder[0]['status']==4): ?>完成<?php elseif($myorder[0]['status']==3): ?>已发货<?php elseif($myorder[0]['status']==-1): ?>驳回<?php elseif($myorder[0]['status']==-2): ?>已申请取消行程<?php endif; if($myorder[0]['isdelete'] ==1): ?>——<span style="color: red">已取消行程</span><?php endif; ?></p>
            <p>兑换时间：<?php if(!empty($myorder[0]['creationtime'])){ echo date("Y-m-d H:i",$myorder[0]['creationtime']);}else{ echo '未兑换';} ?></p>
            <?php if(!empty($myorder[0]['shipping_time'])): ?><p>配送方式：<?php echo $myorder[0]['shipping_type']; ?></p>
            <p>物流单号：<?php echo $myorder[0]['shipping_no']; ?></p>
            <?php endif; if(!empty($arrive)): ?>
            <p>抵达日期：<?php echo $arrive; ?></p>
            <p>游玩日期：<?php echo $play; ?></p>
            <p>返程日期：<?php echo $back; ?></p>
            <?php endif; ?>
        </div>
        <!--订单信息结束-->
    </div>

    <!--内容主体结束-->
<input type="hidden" id="sellsn" value="<?php echo $myorder[0]['sellsn']; ?>">
    <script>
        function goods_detail() {
            var url = "/index/discovery/content/id/15/agentid/"+<?php echo $uid; ?>+".html";

            window.location.href=url;
        }
        function detail() {

            var url = "/index/user/detail/id/"+<?php echo $tourtype; ?>+"/agentid/"+<?php echo $uid; ?>+".html";

            window.location.href=url;
        }
        function complete1() {

            layer.open({
                content: '确定取消行程吗？'
                ,btn: ['确定', '关闭']
                ,yes: function(index){
                    $.post("<?php echo url('index/user/exchange_complete1'); ?>", { sellsn: $("#sellsn").val() }, function (data) {
                        layer.msg(data.msg)
                    })
                    setTimeout("window.location.href=document.referrer",1500);
                    layer.close(index);
                }
            });
        }
        function complete() {

            layer.open({
                content: '确定收货吗？'
                ,btn: ['确定', '关闭']
                ,yes: function(index){
                    $.post("<?php echo url('index/user/exchange_complete'); ?>", { sellsn: $("#sellsn").val() }, function (data) {
                        layer.msg(data.msg)
                    })
                    setTimeout("location.reload()",1000);
                    layer.close(index);
                }
            });
        }
        function friend_detail(id) {
            $.ajax({
                type: 'POST',
                url: '<?php echo url("/index/user/getmember"); ?>',
                data:{
                    member_type:1,
                    member_val:id
                },
                dataType:'json',
                success: function(data){
                    if(data.type==1){

                        //示范一个公告层
                        layer.open({
                            type: 1
                            ,title: false //不显示标题栏
                            ,closeBtn: false
                            ,area: '5.5rem;'
                            ,shade: 0.8
                            ,btn: ['确认', '取消']
                            ,id: 'LAY_layuipro' //设定一个id，防止重复弹出
                            ,btnAlign: 'c'
                            ,moveType: 1 //拖拽模式，0或者1
                            ,content: '<div style="padding: 50px; line-height: 22px; background-color: #393D49; color: #fff; font-weight: 300;">好友信息<br><br>用户id:'+data.data.id+'<br>用户昵称:'+data.data.username+'<br>用户手机:'+data.data.mobile+'<br></div>'
                            ,success: function(layero){
                                var btn = layero.find('.layui-layer-btn');
                                btn.find('.layui-layer-btn0').attr({


                                });
                            }
                        });

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
