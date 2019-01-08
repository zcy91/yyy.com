<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:81:"/home/wwwroot/yang.oioos.com/public/../application/index/view/user/sheepfold.html";i:1517538640;s:73:"/home/wwwroot/yang.oioos.com/public/../application/index/view/header.html";i:1526866272;}*/ ?>
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
        <p>我的羊圈</p>
    </div>
    <!--公共头部结束-->
    <!--内容主体-->
    <div class="m-sheepfold">

        <!--收益总和-->
        <div class="sheepfold-sum">
            <ul class="sum-list">
                <li>
                    <p><?php echo $zongnum; ?></p>
                    <span>羊只总数</span>
                </li>
                <li>
                    <p><?php echo $shunum; ?></p>
                    <span>已成熟</span>
                </li>
                <li class="buyBtn">
                    <a href="<?php echo url('/index/shop/glist'); ?>">
                        <i class="fa fa-rmb"><u>再养一只</u></i>
                    </a>
                </li>
            </ul>
        </div>
        <!--记录总和结束-->

        <!--羊只列表-->
        <ul class="sheepfold-list">
            <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <li>
                <img src="<?php if(!empty($vo['img'])) echo imgUrl($vo['img']);else echo imgUrl('') ?>" class="sheepfold-photo" />
                <div class="sheepfold-name">
                    <p><?php echo $vo['lambname']; ?></p>
                    <span>生长天数：<u><?php echo $vo['czday']; ?></u>天</span>
                </div>
                <a href="<?php echo url('/index/user/sheepdetail',array('id'=>$vo['id'])); ?>" class="sheepfold-btn">查看详情</a>
            </li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            <!--<li class="sheepfold-plus">
            <a href="buysheep.html" class="plus-link"><i class="fa fa-plus"></i></a>
            <div class="plus-text">
                点击添加
            </div>
        </li>-->
        </ul>
        <!--羊只列表结束-->

    </div>
    <!--内容主体结束-->

</body>
</html>
