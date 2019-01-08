<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:84:"/home/wwwroot/yang.oioos.com/public/../application/index/view/discovery/pasture.html";i:1517478762;s:73:"/home/wwwroot/yang.oioos.com/public/../application/index/view/header.html";i:1526866272;}*/ ?>
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
    <link rel="stylesheet" type="text/css" href="/static/home/css/wx.css" />
    <style>
        img{display:block;width:100%}
    </style>
</head>
<body style="position:relative;background:#f2f2f2">

    <!--公共头部-->
    <div class="m-head">
        <a href="javascript:;" onclick="javascript:window.history.back();return false;" class="head-goback">
            <i class="fa fa-angle-left"></i>
        </a>
        <p>牧场介绍</p>
    </div>
    <!--公共头部结束-->
    <!--内容主体-->
    <div class="m-sheepvideo">
        <!--视频标题-->
        <ul class="sheepvideo-title">
            <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $k = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?>
            <li style="width:33%" <?php if($k==1): ?> class="ahover" <?php endif; ?>><?php echo $vo['title']; ?></li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
        <!--视频标题结束-->
        <!--视频内容-->
        <ul class="sheepvideo-list">
            <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $k = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?>
            <li <?php if($k==1): ?> class="ahover" <?php endif; ?>>
                <div class="rich_media_inner">
                    <div id="page-content">
                        <div id="img-content" class="rich_media_area_primary">
                            <div class="rich_media_content " id="js_content">
                                    <?php echo $vo['content']; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
        <!--视频内容结束-->


    </div>
    <!--内容主体结束-->

</body>
</html>
