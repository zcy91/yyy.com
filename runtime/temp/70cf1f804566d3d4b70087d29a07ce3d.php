<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:83:"/home/wwwroot/yang.oioos.com/public/../application/index/view/user/sheepdetail.html";i:1526910208;s:73:"/home/wwwroot/yang.oioos.com/public/../application/index/view/header.html";i:1526866272;}*/ ?>
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

    <link href="/static/home/css/swiper-3.3.1.min.css" rel="stylesheet" />
    <script src="/static/home/js/swiper-3.3.1.jquery.min.js"></script>
    <script src="http://g.alicdn.com/de/prismplayer/1.4.2/prism-min.js" type="text/javascript"></script>
    <link href="http://g.alicdn.com/de/prismplayer/1.4.2/skins/default/index-min.css" rel="stylesheet" />
</head>
<style>
    .prism-big-play-btn{
        display: none !important;
    }
    .prism-controlbar{
        display: unset !important;
    }
</style>
<body style="position:relative;">

    <!--公共头部-->
    <div class="m-head">
        <a href="javascript:;" onclick="javascript:window.history.back();return false;" class="head-goback">
            <i class="fa fa-angle-left"></i>
        </a>
        <p>羊羊详情</p>
    </div>
    <!--公共头部结束-->
    <!--内容主体-->
    <div class="m-sheepdetail">

        <!--视频展示-->
        <div class="sheepdetail-video" id="sheepdetail-video">
            <!--<div id="J_prismPlayer" class="prism-player" style="display:block;"></div>-->
            <?php if(!empty($videolist)): if(substr($videolist['0']['site'],0,4)=='http'): ?>
                    <iframe style=" width: 6rem; height: 4rem" src="<?php echo $videolist[0]['site']; ?>" frameborder=0 'allowfullscreen' class="video-adv" id='video'></iframe>

                <?php else: ?>
                    <img src="/static/home/images/videobg.jpg" class="videoBg" style="display:none;" />
                <div id="J_prismPlayer" class="prism-player" style="display:block;"></div>
                <script>
                    // 初始化播放器


                </script>
                <?php endif; else: ?>
            <img src="/static/home/images/videobg.jpg" class="videoBg" />
            <?php endif; ?>
            
        </div>
        <!--视频展示结束-->
        <!--羊信息-->
        <div class="sheepdetail-info">
            <p><?php echo $mylamb['lambname']; ?>&nbsp;<span>耳标:<b><?php echo $mylamb['lambsn']; ?></b></span></p>
            <span><?php echo $mylamb['message']; ?></span>
            <a href="<?php echo url('/index/user/qrcode'); ?>" class="info-share"><i class="fa fa-share-alt"></i></a>
        </div>
        <!--羊信息结束-->
        <!--养殖周期-->
        <div class="sheepdetail-cycle">
            <ul>
                <li>生长：<span><?php echo $czday; ?></span></li>
                <li>预计<span><?php echo $mylamb['cycle']; ?></span>天成熟</li>
                <li>累计收益：<span><?php echo $yjsy; ?></span>元</li>
            </ul>
        </div>
        <!--养殖周期结束-->
        <!--往期视频-->
        <div class="sheepdetail-videotape">
            <h1>往期视频</h1>
            <div class="swiper-container">
                <div class="swiper-wrapper" >
                    <?php if(!empty($videolist)): if(is_array($videolist) || $videolist instanceof \think\Collection || $videolist instanceof \think\Paginator): $key = 0; $__LIST__ = $videolist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;?>
                    <div class="swiper-slide">
                        <a href="javascript:;">
                            <img src="<?php if(!empty($vo['cover'])) echo imgUrl($vo['cover']);else echo '/static/home/images/videobg.jpg'; ?>" onclick="qiehuan('<?php echo $videolist[$key-1]['site']; ?>',this)" name="<?php echo $videolist[$key-1]['cover']; ?>"/>
                        </a>
                    </div>
                    <?php endforeach; endif; else: echo "" ;endif; endif; ?>
                </div>
                <!-- Add Pagination -->
                <div class="swiper-pagination"></div>
            </div>
        </div>
        <!--往期视频结束-->

    </div>
    <!--内容主体结束-->
    <!--详情公共底部-->
    <div class="sheepdetail-footer">
        <div style="margin: 0 auto;width: 5.5rem">
            <a style="    margin: .1rem .1rem;float: left;" href="<?php echo url('/index/user/soldsheep',array('id'=>$mylamb['id'])); ?>">我要出售</a>
            <a style="    margin: .1rem .1rem;float: left;" href="<?php echo url('/index/user/sheepgive',array('id'=>$mylamb['id'])); ?>">我要赠送</a>
        </div>
    </div>
    <!--详情公共底部结束-->


    <script type="text/javascript">
        $(function () {
            // if($("#J_prismPlayer")){
            //     $("#J_prismPlayer").find("video").attr("webkit-playsinline", "webkit-playsinline");
            //     var player = new prismplayer({
            //         id: "J_prismPlayer", // 容器id
            //         source: "<?php if(!empty($videolist[0]['site'])) echo imgUrl($videolist[0]['site']);else echo imgUrl('') ?>",//视频地址
            //         cover: "<?php if(!empty($videolist[0]['cover'])) echo imgUrl($videolist[0]['cover']);else echo '/static/home/images/videobg.jpg'; ?>",//视频封面图
            //         width: "6rem",         // 播放器宽度
            //         height: "4rem",      // 播放器高度
            //         autoplay: true,
            //     });
            //
            //     var clickDom = document.getElementsByClassName('prism-controlbar');
            //     // clickDom.addEventListener('click', function (e) {
            //     //     // 调用播放器的play方法
            //     //     player.play();
            //     // });
            //
            //     // 监听播放器的pause事件
            //     player.on('pause', function () {
            //         layer.msg('播放器暂停啦！');
            //     });
            // }



        })

        var swiper = new Swiper('.swiper-container', {
            slidesPerView: 3,
            slidesPerColumn: 1,
            spaceBetween: 10,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });
        function qiehuan(src,obj) {
            var parent = document.getElementById('sheepdetail-video');
            var div = document.createElement("div");
           if(src.substr(0, 4) == 'http'){
               $("#J_prismPlayer").remove();
               parent.innerHTML = " <iframe style=\" width: 6rem; height: 4rem\" src=\"src\" frameborder=0 'allowfullscreen' class=\"video-adv\" id='video'></iframe>";
               // parent.appendChild(div)
                $('.prism-player').remove();
                $("#video").attr('src',src)
           }else{
                var picture = obj.name;
               var picture = '/server/'+ picture;
               // $('.video-adv').remove();
               // $(".prism-player").remove();
               parent.innerHTML = " <div id=\"J_prismPlayer\" class=\"prism-player\" style=\"display:block;\"></div>";
                src = '/server/'+src;
               // parent.appendChild(div)
               var player = new prismplayer({
                   id: "J_prismPlayer", // 容器id
                   source: src,//视频地址
                   cover: picture,//视频封面图
                   width: "6rem",         // 播放器宽度
                   height: "4rem",      // 播放器高度
                   autoplay: false,
               });

               var clickDom = document.getElementById('J_clickToPlay');
               clickDom.addEventListener('click', function (e) {
               //     // 调用播放器的play方法
                    player.play();
               });

               // 监听播放器的pause事件
               player.on('pause', function () {
                   layer.msg('播放器暂停啦！');
               });
           }

        }
    </script>

</body>
</html>
