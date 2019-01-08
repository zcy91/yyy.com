<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:87:"/home/wwwroot/yang.oioos.com/public/../application/index/view/discovery/sheepvideo.html";i:1527211566;s:73:"/home/wwwroot/yang.oioos.com/public/../application/index/view/header.html";i:1526866272;}*/ ?>
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
<body style="position:relative;background:#f2f2f2">

    <!--公共头部-->
    <div class="m-head">
        <a href="javascript:;" onclick="javascript:window.history.back();return false;" class="head-goback">
            <i class="fa fa-angle-left"></i>
        </a>
        <p>牧场视频</p>
    </div>
    <!--公共头部结束-->
    <!--内容主体-->
    <div class="m-sheepvideo">
        <!--视频标题-->
        <ul class="sheepvideo-title">
            <li class="ahover">视频介绍</li>
            <li>往期视频</li>
        </ul>
        <!--视频标题结束-->
        <!--视频内容-->
        <ul class="sheepvideo-list">
            <li class="ahover">
                <h1>食花百草羊原生态牧场</h1>
                <p class="videoTips">食花百草羊自有三大牧场，共计10万亩草场，花草遍地，素有“仙境牧场”的美誉。这里牛羊成群，牧声阵阵，更有原汁原味的牧户生活体验，快来观看吧。</p>
                <video controls class="video-adv" poster="" webkit-playsinline="true" preload="auto">
                    <source src="/server/upvideo/20180122/CD0A4539.mp4" type="video/mp4">
                    您的浏览器不支持 video 标签。
                </video>
                <p class="videoTips">想要看到更多的羊，就到<a href="javascript:;">往期视频</a>来看看吧</p>
                <img src="/static/home/images/maps.jpg" class="video-maps" />
            </li>
            <li>
                <div class="videoClass">
                    <?php if(is_array($video_type) || $video_type instanceof \think\Collection || $video_type instanceof \think\Paginator): $k = 0; $__LIST__ = $video_type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?>
                    <span style="width: 1.8rem" onclick="show_video(<?php echo $vo['id']; ?>)" <?php if($k==1): ?>class="classAhover"<?php endif; ?>><?php echo $vo['name']; ?></span>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
                <div class="videoList">
                    <?php if(is_array($video_list) || $video_list instanceof \think\Collection || $video_list instanceof \think\Paginator): $i = 0; $__LIST__ = $video_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <div class="show_video_<?php echo $vo['catid']; ?> video_hide" <?php if($video_type['0']['id']==$vo['catid']): else: ?> style="display:none;"<?php endif; ?>>
                             
                            <div class="listBox">
                        <?php if(substr($vo['site'],0,4)=='http'): ?>
                            <iframe src='<?php echo $vo['site']; ?>' frameborder=0 'allowfullscreen' class="video-adv"></iframe>
                        <?php else: ?>
                            <video controls poster="<?php if(!empty($vo['cover'])) echo imgUrl($vo['cover']);else echo imgUrl('') ?>" webkit-playsinline="true" preload="auto">
                                <source src="<?php if(!empty($vo['site'])) echo imgUrl($vo['site']);else echo imgUrl('') ?>" type="video/mp4">
                                您的浏览器不支持 video 标签。
                            </video>
                        <?php endif; ?>
                         <p><?php echo $vo['name']; ?></p>
                            </div>
                        </div>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                    
                </div>
            </li>
        </ul>
        <!--视频内容结束-->


    </div>
    <!--内容主体结束-->
    <script>
        function show_video(id){
             $('.video_hide').hide();
             $(".show_video_"+id).toggle();  
        }
    </script>

</body>
</html>
