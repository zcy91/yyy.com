<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:76:"D:\wamp64\www\yyy.com\public/../application/index\view\user\orderdetail.html";i:1533704760;s:66:"D:\wamp64\www\yyy.com\public/../application/index\view\header.html";i:1534577442;}*/ ?>
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
    <script src="/static/pingpp-js/dist/pingpp.js"></script>
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

    <!--公共头部-->
    <div class="m-head">
        <a href="javascript:;" onclick="javascript:window.history.back();return false;" class="head-goback">
            <i class="fa fa-angle-left"></i>
        </a>
        <p>订单详情</p>
    </div>
    <!--公共头部结束-->
    <!--内容主体-->
    <div class="m-orderdetail">
        <!--订单编号-->
        <div class="orderdetail-numb">
            <p>订单编号：<span><?php echo $myorder['0']['ordersn']; ?></span></p>
        </div>
        <!--订单编号结束-->
        <!--羊羔信息-->
        <div class="orderdetail-sheep">
            <?php if(is_array($myorder) || $myorder instanceof \think\Collection || $myorder instanceof \think\Paginator): $i = 0; $__LIST__ = $myorder;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <div class="infoBox">
                <div class="info-photo">
                    <img src="<?php if(!empty($vo['img'])) echo imgUrl($vo['img']);else echo imgUrl('') ?>" style="position: unset"/>
                </div>
                <div class="info-detail">
                    <?php 
                    if($vo['price']){ ?>
                    <div class="detail-name">羊羔名字：<span><?php echo $vo['lambname']; ?></span></div>
                    <div class="detail-cycle">养殖周期：<span><?php echo $vo['cycle']; ?></span><u>天</u></div>
                    <div class="detail-rebate"><span><?php echo $vo['percentage']; ?>%</span><u>预计年化收益率</u></div>
                    <div class="detail-numb"></div>
                    <?php } else{  ?>
                    <div class="detail-name">商品名字：<span><?php echo $vo['lambname']; ?></span></div>
                    <?php } ?>

                </div>
            </div>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <!--羊羔信息结束-->
        <!--资金信息-->
        <div class="orderdetail-money">
            <div class="moneyBox">
                <span>羔羊单价</span>
                <p><i class="fa fa-yen"></i><u><?php echo $myorder['0']['price']; ?></u></p>
            </div>
<!--            <div class="moneyBox">
                <span>羔羊数量</span>
                <p><u></u></p>
            </div>-->
            <div class="moneyBox">
                <span>订单总价</span>
                <p><i class="fa fa-yen"></i><u><?php echo $myorder['0']['money']; ?></u></p>
            </div>
            <div class="moneyBox moneySum">
                <span>实付款</span>
                <p><i class="fa fa-yen"></i><u><?php echo $myorder1['0']['price']; ?></u></p>
            </div>
        </div>
        <!--资金信息结束-->
        <!--订单信息-->
        <div class="orderdetail-info">
            <p>创建时间：<?php echo date("Y-m-d H:i",$myorder[0]['creationtime']); ?></p>
            <p>付款时间：<?php if(!empty($myorder[0]['paytime'])){ echo date("Y-m-d H:i",$myorder[0]['paytime']);}else{ echo '未支付';} ?></p>
            <p>支付方式：<?php if($myorder['0']['paytype']==1): ?>余额支付<?php elseif($myorder['0']['paytype'] == 2): ?>微信支付<?php elseif($myorder['0']['paytype'] == 0): ?>未支付<?php else: ?>其他支付<?php endif; ?></p>
           
        </div>
        <!--订单信息结束-->
    </div>
            <?php if($myorder['0']['status']==0): ?>
            <a style="display: block;width: 3rem;margin: .2rem auto;padding: .2rem 0;text-align: center;font-size: .3rem;color: #fff;border-radius: .1rem;background: #f66c48" href="<?php echo url('/index/order/pay',array('oid'=>$myorder['0']['id'])); ?> " >支付订单</a>
            <?php endif; ?>
    <!--内容主体结束-->

</body>
</html>
