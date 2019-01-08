<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:73:"E:\phpStudy\WWW\yyy.com\public/../application/index\view\user\wallet.html";i:1530945002;s:68:"E:\phpStudy\WWW\yyy.com\public/../application/index\view\header.html";i:1528532196;}*/ ?>
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


    <script src="/static/home/js/echarts.min.js"></script>
    <!--<script src="/static/home/js/echarts-data.js"></script>-->
<style>
    .wallet-sum ul li:nth-child(1) {
        border-right: 1px solid #7be664;
    }
    .wallet-sum ul li:nth-child(3) {
        border-right: 1px solid #7be664;
    }
    .wallet-record ul li:nth-child(1){
        border-bottom: 1px solid #9F9F9F;
        padding: .2rem;
        display: block;
        width: 100%;
    }
    .wallet-record ul li:nth-child(2){
        border-bottom: 1px solid #9F9F9F;
        padding: .2rem;
        display: block;
        width: 100%;
    }
    .wallet-record ul li{

        padding: .2rem;
        display: block;
        width: 100%;
    }
    .wallet-record p{
        display: inline;
    }
</style>
</head>
<body style="position:relative; background:#f2f2f2">

    <!--公共头部-->
    <div class="m-head">
        <a href="javascript:;" onclick="javascript:window.history.back();return false;" class="head-goback">
            <i class="fa fa-angle-left"></i>
        </a>
        <p>我的钱包</p>
    </div>
    <!--公共头部结束-->
    <!--内容主体-->
    <div class="m-wallet">

        <!--收益总和-->
        <div class="wallet-sum">
            <ul>
                <li class="sumTitle" style="width: 50%">

                    <p><?php echo $member['credit']; ?></p>
                    <span>账户余额（元）</span>
                </li>
                <li class="sumTitle" style="width: 50%">
                    <p><?php echo $member['credit2']; ?></p>
                    <span>账户积分（积分）</span>
                </li>
                <!--<li style=" border-right: 1px solid #7be664;">-->
                    <!--<p><?php echo $lambprofit; ?></p>-->
                    <!--<span>领养收益（元）</span>-->
                <!--</li>-->
                <!--<li>-->
                    <!--<p><?php echo $year['erdayprice']; ?></p>-->
                    <!--<span>昨日收益（元）</span>-->
                <!--</li>-->
            </ul>
        </div>
        <!--记录总和结束-->

        <!--收益记录-->
        <div class="wallet-record">
           <ul>
               <li>
                   <a href="<?php echo url('/index/user/walletrecord'); ?>">
                       <i class="fa fa-list"></i>
                       <p>历史记录</p>
                   </a>
               </li>
               <li>
                   <a href="<?php echo url('/index/shop/glist'); ?>">
                       <i class="fa fa-shopping-cart"></i>
                       <p>我要养羊</p>
                   </a>
               </li>
               <li>
                   <a href="<?php echo url('/index/user/sheepfold'); ?>">
                       <i class="fa fa-rmb"></i>
                       <p>我要卖羊</p>
                   </a>
               </li>
           </ul>
        </div>
        <!--收益记录结束-->

        <!--收益报表-->
        <!--<div class="wallet-income">-->
            <!--<div id="main" class="income-chart"></div>-->
        <!--</div>-->
        <!--收益报表结束-->

        <!--客服信息-->
        <div class="index-service" style="margin-top: .5rem">
            <p>遇到问题可于工作日9:30-17:30</p>
            <p>联系客服</p>
            <p>400-833-6836</p>
        </div>
        <!--客服信息结束-->

    </div>

    <!--内容主体结束-->
    <!--钱包底部-->
    <div class="m-walletFT">
       <a href="<?php echo url('/index/user/take'); ?>">提现</a>
        <a href="<?php echo url('/index/user/recharge'); ?>" id="recharge">充值</a>
    </div>
    <!--钱包底部结束-->

    <script>
        //曲线图js
$(function () {
    var u = navigator.userAgent;
    if(u == 'oioos_webkit_ios'){
        $(".m-walletFT").hide();
    }
    // 基于准备好的dom，初始化echarts实例
    var myChart = echarts.init(document.getElementById('main'));

    var colors = ['#fb541c'];

    option = {
        color: colors,
        title: {
            text: '近七日收益曲线（元）',
            textStyle:
                {
                    color: '#757575',
                    //fontStyle: '微软雅黑',
                    fontSize:18,
                    fontWeight:'normal',
                }
        },
        tooltip: {
            trigger: 'axis',
        },
        grid: {
            top: '17%',
            left: '12%',
            right: '5%',
            bottom: '10%',
        },
        xAxis: {
            type: 'category',
            boundaryGap: false,
            data: ['<?php echo $year['qidayname']; ?>', '<?php echo $year['liudayname']; ?>', '<?php echo $year['wudayname']; ?>', '<?php echo $year['sidayname']; ?>', '<?php echo $year['sandayname']; ?>', '<?php echo $year['erdayname']; ?>', '<?php echo $year['yidayname']; ?>']
        },
        yAxis: {
            type: 'value',
        },
        series: [
            {
                type: 'line',
                data: ['<?php echo $year['qidayprice']; ?>', '<?php echo $year['liudayprice']; ?>', '<?php echo $year['wudayprice']; ?>', '<?php echo $year['sidayprice']; ?>', '<?php echo $year['sandayprice']; ?>', '<?php echo $year['erdayprice']; ?>', '<?php echo $year['yidayprice']; ?>'],
            },

        ]
    };

    // 使用刚指定的配置项和数据显示图表。
    myChart.setOption(option);

});

    </script>

</body>
</html>
