<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:81:"/home/wwwroot/yang.oioos.com/public/../application/index/view/user/recommend.html";i:1517713386;s:73:"/home/wwwroot/yang.oioos.com/public/../application/index/view/header.html";i:1526866272;}*/ ?>
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
        <p>推荐记录</p>
    </div>
    <!--公共头部结束-->
    <!--内容主体-->
    <div class="m-recommend">
        <ul class="coupon-title">
            <li style="width: 49.5%;" onclick="window.location.href='<?php echo url('/index/user/invite'); ?>'">邀请好友</li>
            <li style="width: 49.5%;" class="ahover"  onclick="window.location.href='<?php echo url('/index/user/recommend'); ?>'">推荐记录</li>
        </ul>
        <!--记录总和-->
        <div class="recommend-sum">
            <ul>
                <li>
                    <p><?php echo $num; ?></p>
                    <span>已邀请人数</span>
                </li>
                <li>
                    <p><?php echo $mycredit2; ?></p>
                    <span>推荐总奖金</span>
                </li>
            </ul>
        </div>
        
        <!--记录总和结束-->

         <!--记录列表-->
        <div class="recommend-list">
            <!--<div class="list-tips">所有推荐类奖金可于邀请人认购期满后单独提现</div>-->
            <ul>
                <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <li>
                    <img src="<?php if(!empty($vo['avatar'])) echo imgUrl($vo['avatar']);else echo imgUrl('') ?>" class="list-photo" />
                    <div class="list-info">
                        <p><?php echo $vo['username']; ?></p>
                        <span>注册时间：<?php echo date("Y-m-d H:i",$vo['reg_time']); ?></span>
                    </div>
<!--                    <div class="list-money">
                        <i class="fa fa-plus"></i><span>0.00</span>
                    </div>-->
                </li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
        <!--记录列表结束-->

    </div>
    <!--内容主体结束-->

</body>
</html>
