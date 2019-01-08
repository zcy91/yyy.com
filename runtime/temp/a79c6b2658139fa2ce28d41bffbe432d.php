<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:71:"D:\wamp64\www\yyy.com\public/../application/index\view\user\coupon.html";i:1533704761;s:66:"D:\wamp64\www\yyy.com\public/../application/index\view\header.html";i:1533704758;}*/ ?>
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
<style>
    .coupon-title li{
        width: 25%;
    }
</style>
<body style="position:relative; background:#f2f2f2">

    <!--公共头部-->
    <div class="m-head">
        <a href="javascript:;" onclick="javascript:window.history.back();return false;" class="head-goback">
            <i class="fa fa-angle-left"></i>
        </a>
        <p>我的优惠券</p>
    </div>
    <!--公共头部结束-->
    <!--内容主体-->
    <div class="m-coupon">
        <!--优惠券标题-->
        <ul class="coupon-title">
            <li class="ahover">未使用</li>
            <li>已使用</li>
            <li>已过期</li>
            <li>领券中心</li>
        </ul>
        <!--优惠券标题结束-->
        <!---优惠券内容-->
        <ul class="coupon-list">
            <li class="ahover">
                <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if($vo['used']==0 && ($vo['etime'] >= time() || $vo['etime'] == 0)): ?>
                    <div class="couponBox">
                        <a href="<?php echo url('index/shop/glist'); ?>">
                            <?php if($vo['islimit']==0): ?>
                                <h1><span class="currencyTitle">通用券</span><?php echo $vo['couponname']; ?></h1>
                                <div class="couponCondition">全场通用券，满<?php echo $vo['enough']; ?>元可用</div>
                            <?php else: ?>
                                <h1><span class="destineTitle">指定券</span><?php echo $vo['couponname']; ?></h1>
                                <div class="couponCondition">指定商品，满<?php echo $vo['enough']; ?>元可用</div>
                            <?php endif; ?>
                            <div class="couponTime"><?php echo date("Y.m.d",$vo['stime']); ?>-<?php if($vo['etime'] == 0){echo '长期有效';}else echo date("Y.m.d",$vo['etime']); ?></div>
                            <div class="couponMoney <?php if($vo['islimit']==0): ?>currencyCP<?php else: ?>destineCP<?php endif; ?> ">
                                <?php if($vo['backtype']==0): ?>
                                    <p><i class="fa fa-rmb"></i><u><?php echo floatval($vo['deduct']) ?></u></p>
                                <?php else: ?>
                                    <p><u><?php echo floatval($vo['deduct']) ?></u>折</p>
                                <?php endif; ?>
                                <span>立即使用<i class="fa fa-angle-right"></i></span>
                            </div>
                        </a>
                    </div>
                    <?php endif; endforeach; endif; else: echo "" ;endif; ?>
            </li>
            <li>
                <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if($vo['used']==1): ?>
                    <div class="couponBox">
                        <a href="javascript:;">
                            <?php if($vo['islimit']==0): ?>
                                <h1><span class="useTitle">通用券</span><?php echo $vo['couponname']; ?></h1>
                                <div class="couponCondition">全场通用券，满<?php echo $vo['enough']; ?>元可用</div>
                            <?php else: ?>
                                <h1><span class="useTitle">指定券</span><?php echo $vo['couponname']; ?></h1>
                                <div class="couponCondition">指定商品，满<?php echo $vo['enough']; ?>元可用</div>
                            <?php endif; ?>
                            <div class="couponTime"><?php echo date("Y.m.d",$vo['stime']); ?>-<?php if($vo['etime'] == 0){echo '长期有效';}else echo date("Y.m.d",$vo['etime']); ?></div>
                            <div class="couponMoney useCP ">
                                <?php if($vo['backtype']==0): ?>
                                    <p><i class="fa fa-rmb"></i><u><?php echo floatval($vo['deduct']) ?></u></p>
                                <?php else: ?>
                                    <p><u><?php echo floatval($vo['deduct']) ?></u>折</p>
                                <?php endif; ?>
                                <span>已使用<i class="fa fa-exclamation"></i></span>
                            </div>
                        </a>
                    </div>
                    <?php endif; endforeach; endif; else: echo "" ;endif; ?>
            </li>
            <li>
                <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if($vo['etime'] < time() && $vo['etime'] != 0): ?>
                    <div class="couponBox">
                        <a href="javascript:">
                            <?php if($vo['islimit']==0): ?>
                                <h1><span class="useTitle">通用券</span><?php echo $vo['couponname']; ?></h1>
                                <div class="couponCondition">全场通用券，满<?php echo $vo['enough']; ?>元可用</div>
                            <?php else: ?>
                                <h1><span class="useTitle">指定券</span><?php echo $vo['couponname']; ?></h1>
                                <div class="couponCondition">指定商品，满<?php echo $vo['enough']; ?>元可用</div>
                            <?php endif; ?>
                            <div class="couponTime"><?php echo date("Y.m.d",$vo['stime']); ?>-<?php echo date("Y.m.d",$vo['etime']); ?></div>
                            <div class="couponMoney useCP ">
                                <?php if($vo['backtype']==0): ?>
                                    <p><i class="fa fa-rmb"></i><u><?php echo floatval($vo['deduct']) ?></u></p>
                                <?php else: ?>
                                    <p><u><?php echo floatval($vo['deduct']) ?></u>折</p>
                                <?php endif; ?>
                                <span>已过期<i class="fa fa-exclamation"></i></span>
                            </div>
                        </a>
                    </div>
                    <?php endif; endforeach; endif; else: echo "" ;endif; ?>
            </li>
            <li>
                <?php if(is_array($couponlsit) || $couponlsit instanceof \think\Collection || $couponlsit instanceof \think\Paginator): $i = 0; $__LIST__ = $couponlsit;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if($vo['total'] > 0 || $vo['total'] == -1): ?>
                <div class="couponBox">
                    <a onclick=" coupon_insert(<?php echo $vo['id']; ?>,this);">
                        <?php if($vo['islimit']==0): ?>
                        <h1><span class="currencyTitle">通用券</span><?php echo $vo['couponname']; ?></h1>
                        <div class="couponCondition">全场通用券，满<?php echo $vo['enough']; ?>元可用</div>
                        <?php else: ?>
                        <h1><span class="currencyTitle">指定券</span><?php echo $vo['couponname']; ?></h1>
                        <div class="couponCondition">指定商品，满<?php echo $vo['enough']; ?>元可用</div>
                        <?php endif; if($vo['total'] != -1): ?><div class="couponCondition"> 剩余：<strong class="total"><?php echo $vo['total']; ?> </strong>张！</div><?php endif; ?>
                        <div class="couponTime"><?php echo date("Y.m.d",$vo['stime']); ?>-<?php if($vo['etime'] == 0)echo '长期有效';else echo date("Y.m.d",$vo['etime']); ?></div>
                        <div class="couponMoney <?php if($vo['islimit']==0): ?>currencyCP<?php else: ?>destineCP<?php endif; ?> ">
                            <?php if($vo['backtype']==0): ?>
                            <p><i class="fa fa-rmb"></i><u><?php echo floatval($vo['deduct']) ?></u></p>
                            <?php else: ?>
                            <p><u><?php echo floatval($vo['deduct']) ?></u>折</p>
                            <?php endif; ?>
                            <span>快来抢啦~<i class="fa fa-exclamation"></i></span>
                        </div>
                    </a>
                </div>
                <?php endif; endforeach; endif; else: echo "" ;endif; ?>
            </li>
        </ul>
        <!---优惠券内容结束-->
    </div>
    <script>
        function coupon_insert(id,obj){
            var total = $(obj).find('strong').text();
            var id = id;
            $.ajax({
                type: 'get',
                url: '/index/user/coupon_insert'+'&id='+id,
               async:false,
                success: function(data){
                    if(data.type==1){
                        layer.msg(data.msg);
                        total = total -1 ;
                        $(obj).find('strong').text(total)
                        // setTimeout('location.reload()', 2000);
                    }else{
                        layer.msg(data.msg);
                        setTimeout('location.reload()', 2000);
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
