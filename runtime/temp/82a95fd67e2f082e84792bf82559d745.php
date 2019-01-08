<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:84:"/home/wwwroot/yang.oioos.com/public/../application/index/view/user/walletrecord.html";i:1517538668;s:73:"/home/wwwroot/yang.oioos.com/public/../application/index/view/header.html";i:1526866272;}*/ ?>
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
</head>
<body style="position:relative;">

    <!--公共头部-->
    <div class="m-head">
        <a href="javascript:;" onclick="javascript:window.history.back();return false;" class="head-goback">
            <i class="fa fa-angle-left"></i>
        </a>
        <p>历史记录</p>
    </div>
    <!--公共头部结束-->
    <!--内容主体-->
    <div class="m-walletrecord">
        <ul class="coupon-title">
            <li style="width: 49.5%;" <?php if(empty($money_type) or $money_type==1): ?> class="ahover" <?php endif; ?> onclick="window.location.href='<?php echo url('/index/user/walletrecord'); ?>'">余额记录</li>
            <li style="width: 49.5%;" <?php if(!empty($money_type) or $money_type==2): ?> class="ahover" <?php endif; ?>  onclick="window.location.href='<?php echo url('/index/user/walletrecord',array('money_type'=>2)); ?>'">积分记录</li>
        </ul>
        <div class="walletrecord-list">
            <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <div class="listBox">
                    <h1><?php echo $vo['remark']; if($vo['vary'] == 1): ?><span class="add">+<?php echo $vo['money']; ?>元</span><?php else: ?><span class="min">-<?php echo $vo['money']; ?>元</span><?php endif; ?></h1>
                    <h2><?php echo date("Y-m-d H:i",$vo['time']); ?><span>余额：<?php echo $vo['balance']; ?>元</span></h2>
                </div>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
    </div>
    <!--内容主体结束-->

</body>
</html>
