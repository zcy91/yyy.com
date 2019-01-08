<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:77:"D:\wamp64\www\yyy.com\public/../application/index\view\discovery\content.html";i:1533704770;s:66:"D:\wamp64\www\yyy.com\public/../application/index\view\header.html";i:1536904258;}*/ ?>
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
    <!--<script src="/static/pingpp-js/dist/pingpp.js"></script>-->
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


    <link rel="stylesheet" type="text/css" href="/static/home/css/wx.css" />
    <link rel="stylesheet" type="text/css" href="/static/home/css/page_mp_article_improve_combo322696.css">
<link rel="stylesheet" href="/static/dist/photoswipe.css">
<link rel="stylesheet" href="/static/dist/default-skin/default-skin.css">
<script src="/static/dist/photoswipe.js"></script>
<script src="/static/dist/photoswipe-ui-default.min.js"></script>
    <style>
        /*img{display:block;width:100%}*/
        .item-pic-list ul {
            overflow: hidden;
        }
        .item-pic-list ul li {
            float: left;
            width: 2.9rem;
            box-sizing: border-box;
            padding: .02rem;
            text-align: center;
            margin-top: .08rem;
        }
        .item-pic-list ul li img {
            width: 2.5rem;
            height: 2.5rem !important;
        }
        .goods-pic {
            width: 2.5rem;
            height: 2.5rem;
            display: inline-block;
            background-color: #ddd;
            background-size: cover;
            background-position: center;
    </style>
</head>
<body id="activity-detail" class="zh_CN mm_appmsg not_in_mm">
    <div id="js_article" class="rich_media">
        <div id="js_top_ad_area" class="top_banner" style="display: none;">
 
        </div>
         <div class="m-head">
        <a href="javascript:;" onclick="javascript:window.history.back();return false;" class="head-goback">
            <i class="fa fa-angle-left"></i>
        </a>
        <p><?php echo $myarticle['title']; ?></p>
    </div>
        <div class="rich_media_inner">
                        <div id="page-content">
                <div id="img-content" class="rich_media_area_primary">
                    <h2 class="rich_media_title" id="activity-name"  style="display:block;">
                        <?php echo $myarticle['title']; ?>
                    </h2>
                    <div class="rich_media_meta_list"  style="display:unset;font-size: 0.3rem">
                        <em id="post-date" class="rich_media_meta rich_media_meta_text"><?php echo date("Y-m-d",$myarticle['createtime']) ?></em>
                        <a class="rich_media_meta rich_media_meta_link rich_media_meta_nickname" href="<?php echo $myarticle['hits']; ?>" id="post-user"><?php echo $myarticle['username']; ?></a>
                        <?php if($isdelarticle == 1): ?> <a class="del_article" style="float: right" value="<?php echo $myarticle['id']; ?>"> 删除</a> <?php endif; ?>
                        <span class="rich_media_meta rich_media_meta_text rich_media_meta_nickname"><?php echo $myarticle['username']; ?></span>

                        <div id="js_profile_qrcode" class="profile_container">
                            <span class="profile_arrow_wrp" id="js_profile_arrow_wrp">
                                <i class="profile_arrow arrow_out"></i>
                                <i class="profile_arrow arrow_in"></i>
                            </span>
                        </div>

                    </div>

                    <div class="rich_media_content " id="js_content">
                        <?php echo $myarticle['content']; ?>
                    </div>
                    <div class="ct_mpda_wrp" id="js_sponsor_ad_area" style=" ;">
                    </div>
                    <div class="product-img-module item-pic-list">
                        <!--<a class="J_ping" report-eventid="MProductdetail_CommentPictureTab" report-pageparam="1725965683" >-->
                            <ul class="">
                                <?php if(is_array($myarticle['img']) || $myarticle['img'] instanceof \think\Collection || $myarticle['img'] instanceof \think\Paginator): if( count($myarticle['img'])==0 ) : echo "" ;else: foreach($myarticle['img'] as $key=>$v2): ?>
                                <li class="" >
                                    <div class="my-gallery" data-pswp-uid="<?php echo $key; ?>">
                                        　　<figure>
                                    <a href="<?php echo $v2; ?>" data-size = <?php echo $myarticle['size'][$key][0]; ?>x<?php echo $myarticle['size'][$key][1]; ?>><div class="goods-pic" style="background-image: url(<?php echo $v2; ?>)"></div> <img src="<?php echo $v2; ?>" style="display: none"></a>
                                    </figure>
                                    </div>
                                </li>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </ul>
                        <!--</a>-->
                    </div>
                    <div class="rich_media_tool" id="js_toobar3" style="display:block;">
                        <div id="js_read_area3" class="media_tool_meta tips_global meta_primary" style=" ;">阅读 <?php echo $myarticle['hits']; ?><span id="readNum3"></span> </div>
                        <span style=" ;" class="media_tool_meta meta_primary tips_global meta_praise" id="like3" onclick="dianzan();">
                            <i class="icon_praise_gray" style="<?php if($iszan == 1){ echo'background-position:0 -18px';}?>" ></i><span class="praise_num" id="likeNum3"></span>
                            <span class="tips_global" id="dianzannum" style="margin-left: 0 ;"><?php echo $myarticle['zan']; ?></span>
                        </span>
                    </div>
                </div>
            </div>

        </div>
    </div>
        <div style="height:2.6em;width:100%;background-color:#fff"></div>
    <div class='community-comment' id="comList">
        <ul>
            <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;
            $isdel = 0;
            if(@$_SESSION['think']['user']['user_id']){
            $userid = $_SESSION['think']['user']['user_id'];
            if($vo['userid'] == $userid){
                $isdel = 1;
            }
            $iszan = db('comment') -> where('userid',$userid)->where('mid',$vo['id'])->where('comment',Null)->value('iszan');
            }elseif(@$_COOKIE['mobile']){
            $mobile = $_COOKIE['mobile'];
            $userid = db('member') -> where('mobile',$mobile) -> value('id');
            if($vo['userid'] == $userid){
                $isdel = 1;
            }
            $iszan = db('comment') -> where('userid',$userid)->where('mid',$vo['id'])->where('comment',Null)->value('iszan');
            }else{
            $iszan = 0;
            }
             ?>

            <li class="comment_border" style="border-bottom:0.08rem solid #ececec;">
                <div class='comment-wrapper'>
                    <img class='comment-user-profile' src="<?php if(!empty($vo['avatar'])) echo imgUrl($vo['avatar']);else echo '/static/home/images/logo.jpg' ?>">
                    <span class="comment-username" style="display: inline"><?php echo $vo['username']; ?></span>
                    <?php if($isdel == 1): ?> <a class="del" style="float: right" value="<?php echo $vo['id']; ?>"> 删除</a> <?php endif; ?>
                    <a href="<?php echo url('index/discovery/comment_list',array('id'=> $vo['id'])); ?>">
                        <p class="comment-content comment"><?php echo $vo['comment']; ?></p>
                        <div class="comment-image-wrapper">
                        </div>
                    </a>
                    <div class="comment-date">
                        <span><?php echo $vo['timestr']; ?></span>
                        <i class="fa fa-commenting fa-lg message-icon" value="<?php echo $vo['id']; ?>" ><?php echo $vo['comment_count']; ?></i>
                        <i class="fa fa-heart fa-lg love-icon <?php if($iszan == 1): ?> love_red <?php endif; ?>" value="<?php echo $vo['id']; ?>"><?php echo $vo['zan']; ?></i>
                    </div>
                </div>
            </li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
        <?php if(($count > $current_count) AND (count($commentlist) == $page_count)): ?>
        <div class="getmore" style="font-size:.32rem;text-align:center;color:#888;padding:.25rem .24rem .4rem; clear:both">
            <a href="javascript:void(0)" onClick="ajaxSourchSubmit();">点击加载更多</a>
        </div>
        <?php elseif(($count <= $current_count AND $count > 0)): ?>
        <div class="score enkecor" style="font-size:.32rem;text-align:center;color:#888;padding:.25rem .24rem .4rem; clear:both">已显示完所有内容</div>
        <?php else: endif; ?>
    </div>

    <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

        <!-- Background of PhotoSwipe.
             It's a separate element as animating opacity is faster than rgba(). -->
        <div class="pswp__bg"></div>

        <!-- Slides wrapper with overflow:hidden. -->
        <div class="pswp__scroll-wrap">

            <!-- Container that holds slides.
                PhotoSwipe keeps only 3 of them in the DOM to save memory.
                Don't modify these 3 pswp__item elements, data is added later on. -->
            <div class="pswp__container">
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
            </div>

            <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
            <div class="pswp__ui pswp__ui--hidden">

                <div class="pswp__top-bar">

                    <!--  Controls are self-explanatory. Order can be changed. -->

                    <div class="pswp__counter"></div>

                    <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>

                    <!--<button class="pswp__button pswp__button&#45;&#45;share" title="Share"></button>-->

                    <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>

                    <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

                    <!-- element will get class pswp__preloader--active when preloader is running -->
                    <div class="pswp__preloader">
                        <div class="pswp__preloader__icn">
                            <div class="pswp__preloader__cut">
                                <div class="pswp__preloader__donut"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                    <div class="pswp__share-tooltip"></div>
                </div>

                <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
                </button>

                <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
                </button>

                <div class="pswp__caption">
                    <div class="pswp__caption__center"></div>
                </div>

            </div>

        </div>

    </div>

<script type="text/javascript" src="/static/js/jquery.min.js"></script>
<script>

    var initPhotoSwipeFromDOM = function(gallerySelector) {

        // 解析来自DOM元素幻灯片数据（URL，标题，大小...）
        // (children of gallerySelector)
        var parseThumbnailElements = function(el) {
            var thumbElements = el.childNodes,
                numNodes = thumbElements.length,
                items = [],
                figureEl,
                linkEl,
                size,
                item;

            for(var i = 0; i < numNodes; i++) {

                figureEl = thumbElements[i]; // <figure> element

                // 仅包括元素节点
                if(figureEl.nodeType !== 1) {
                    continue;
                }
                linkEl = figureEl.children[0]; // <a> element

                size = linkEl.getAttribute('data-size').split('x');

                // 创建幻灯片对象
                item = {
                    src: linkEl.getAttribute('href'),
                    w: parseInt(size[0], 10),
                    h: parseInt(size[1], 10)
                };



                if(figureEl.children.length > 1) {
                    // <figcaption> content
                    item.title = figureEl.children[1].innerHTML;
                }

                if(linkEl.children.length > 0) {
                    // <img> 缩略图节点, 检索缩略图网址
                    item.msrc = linkEl.children[0].getAttribute('src');
                }

                item.el = figureEl; // 保存链接元素 for getThumbBoundsFn
                items.push(item);
            }

            return items;
        };

        // 查找最近的父节点
        var closest = function closest(el, fn) {
            return el && ( fn(el) ? el : closest(el.parentNode, fn) );
        };

        // 当用户点击缩略图触发
        var onThumbnailsClick = function(e) {
            e = e || window.event;
            e.preventDefault ? e.preventDefault() : e.returnValue = false;

            var eTarget = e.target || e.srcElement;

            // find root element of slide
            var clickedListItem = closest(eTarget, function(el) {
                return (el.tagName && el.tagName.toUpperCase() === 'FIGURE');
            });

            if(!clickedListItem) {
                return;
            }

            // find index of clicked item by looping through all child nodes
            // alternatively, you may define index via data- attribute
            var clickedGallery = clickedListItem.parentNode,
                childNodes = clickedListItem.parentNode.childNodes,
                numChildNodes = childNodes.length,
                nodeIndex = 0,
                index;

            for (var i = 0; i < numChildNodes; i++) {
                if(childNodes[i].nodeType !== 1) {
                    continue;
                }

                if(childNodes[i] === clickedListItem) {
                    index = nodeIndex;
                    break;
                }
                nodeIndex++;
            }



            if(index >= 0) {
                // open PhotoSwipe if valid index found
                openPhotoSwipe( index, clickedGallery );
            }
            return false;
        };

        // parse picture index and gallery index from URL (#&pid=1&gid=2)
        var photoswipeParseHash = function() {
            var hash = window.location.hash.substring(1),
                params = {};

            if(hash.length < 5) {
                return params;
            }

            var vars = hash.split('&');
            for (var i = 0; i < vars.length; i++) {
                if(!vars[i]) {
                    continue;
                }
                var pair = vars[i].split('=');
                if(pair.length < 2) {
                    continue;
                }
                params[pair[0]] = pair[1];
            }

            if(params.gid) {
                params.gid = parseInt(params.gid, 10);
            }

            return params;
        };

        var openPhotoSwipe = function(index, galleryElement, disableAnimation, fromURL) {
            var pswpElement = document.querySelectorAll('.pswp')[0],
                gallery,
                options,
                items;

            items = parseThumbnailElements(galleryElement);

            // 这里可以定义参数
            options = {
                barsSize: {
                    top: 100,
                    bottom: 100
                },
                fullscreenEl : false, // 是否支持全屏按钮
                shareButtons: [
                    {id:'wechat', label:'分享微信', url:'#'},
                    {id:'weibo', label:'新浪微博', url:'#'},
                    {id:'download', label:'保存图片', url:'{{raw_image_url}}', download:true}
                ], // 分享按钮

                // define gallery index (for URL)
                galleryUID: galleryElement.getAttribute('data-pswp-uid'),

                getThumbBoundsFn: function(index) {
                    // See Options -> getThumbBoundsFn section of documentation for more info
                    var thumbnail = items[index].el.getElementsByTagName('img')[0], // find thumbnail
                        pageYScroll = window.pageYOffset || document.documentElement.scrollTop,
                        rect = thumbnail.getBoundingClientRect();

                    return {x:rect.left, y:rect.top + pageYScroll, w:rect.width};
                }

            };

            // PhotoSwipe opened from URL
            if(fromURL) {
                if(options.galleryPIDs) {
                    // parse real index when custom PIDs are used
                    for(var j = 0; j < items.length; j++) {
                        if(items[j].pid == index) {
                            options.index = j;
                            break;
                        }
                    }
                } else {
                    // in URL indexes start from 1
                    options.index = parseInt(index, 10) - 1;
                }
            } else {
                options.index = parseInt(index, 10);
            }

            // exit if index not found
            if( isNaN(options.index) ) {
                return;
            }

            if(disableAnimation) {
                options.showAnimationDuration = 0;
            }

            // Pass data to PhotoSwipe and initialize it
            gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options);
            gallery.init();
        };

        // loop through all gallery elements and bind events
        var galleryElements = document.querySelectorAll( gallerySelector );

        for(var i = 0, l = galleryElements.length; i < l; i++) {
            galleryElements[i].setAttribute('data-pswp-uid', i+1);
            galleryElements[i].onclick = onThumbnailsClick;
        }

        // Parse URL and open gallery if it contains #&pid=3&gid=1
        var hashData = photoswipeParseHash();
        if(hashData.pid && hashData.gid) {
            openPhotoSwipe( hashData.pid ,  galleryElements[ hashData.gid - 1 ], true, true );
        }
    };

    // execute above function
    initPhotoSwipeFromDOM('.my-gallery');

    if(<?php echo $p; ?>){
        var page = <?php echo $p; ?>;
    }else{
        var page = 1 ;
    }

    $(".del_article").click(function () {
        var id = ($(this).attr('value'));
        layer.confirm('您确定要删除吗？', {
            btn: ['确定','取消'] //按钮
        }, function()
        {
            $.ajax({
                    type: "post",
                    url: "<?php echo url('index/discovery/del_article'); ?>",
                data: {
            "id":id
        },
            success : function(data){
                if(data.status == 0){
                    layer.msg(data.msg,{ time: 2000});
                }
                setTimeout("layer.closeAll()",1500)
                window.location.href="<?php echo url('index/discovery/community'); ?>";
            }
        });
        });

    })
    $(".del").click(function () {
        var id = ($(this).attr('value'));
        layer.confirm('您确定要删除吗？', {
            btn: ['确定','取消'] //按钮
        }, function()
        {
            $.ajax({
                type: "post",
                url: "<?php echo url('index/discovery/del_comment'); ?>"+"&aid="+<?php echo $myarticle['id']; ?>,
                data: {
                    "id":id
                },
                success : function(data){
                    if(data.status == 0){
                        layer.msg(data.msg,{ time: 2000});
                    }
                    setTimeout("layer.closeAll()",1500)
                    location.reload();
                }
            });
        });

    })
    $(".message-icon").click(function () {
        var id = ($(this).attr('value'));
        $.ajax({
            type: 'post',
            url: "<?php echo url('index/discovery/iscomment_login'); ?>&mid="+id+"&aid="+<?php echo $myarticle['id']; ?>,
            async:false,
            dataType:'json',
            success: function(data){
                if(data.status==1){
                    layer.open({
                        type: 1,
                        area: ['5.5rem', '4.2rem'],
                        title: '评论',
                        shadeClose: true, //点击遮罩关闭
                        content: '\<\div style="padding:.1rem;" class="comment-window-wrapper"><textarea class="comment-alert" name="comment" id="comment">\<\/textarea>\<input class="comment-alert-submit" type="button" id="comment_sub" value="提交评论">\<\/div>',
                        end: function () {
                            location.reload();
                        }
                    });
                    $('#comment_sub').on('click', function(){
                        $.ajax({
                            type: 'post',
                            url: "<?php echo url('index/discovery/comment'); ?>&mid="+id+"&aid=" + <?php echo $myarticle['id']; ?> + "&cid=0",
                            async: false,
                            dataType: 'json',
                            data:{comment:$('#comment').val()},
                            success:function (res) {
                                if(res.status==2){
                                    layer.msg(res.msg,{anim:0});
                                    setTimeout("layer.closeAll()",1500)
                                }else if(res.status==0){
                                    layer.msg(res.msg,{anim:6})
                                    setTimeout("layer.closeAll()",1500)
                                }
                            }
                        })

                    });
                }else{
                    layer.msg(data.msg,{anim:6});
                    return false;
                }
            }
        })
    })
 function   dianzan(){
        var url="<?php echo url('index/discovery/comment'); ?>";

        var id = <?php echo input('id'); ?>;

        if(id<0){
            return;
        }
        $.ajax({
            type:'get',
            url:url, 
            data:{    
                 aid:id,
                mid:0
            }, 
            success: function(ok){
                if(ok.status==1){
                    var dianzannum=$("#dianzannum").text();
                    dianzannum=parseInt(dianzannum)+1;
                    //alert(dianzannum);
                    $("#dianzannum").text(dianzannum);
                    $(".icon_praise_gray").attr("style","background-position:0 -18px");
                    //alert('成功');
                }else{
                    alert(ok.msg);
                }

            }
        });
}

function GetQueryString(name)
{
     var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
     var r = window.location.search.substr(1).match(reg);
     if(r!=null)return  unescape(r[2]); return null;
}
function fxshow(){
    $('#yjfx').show();
}
function fxhide(){
    $('#yjfx').hide();
}

    $(".love-icon").click(function () {
        var id = ($(this).attr('value'));
        var num=parseInt($(this).text());
        var a = $(this);
        // ($(this).text(2))
        $.ajax({
            type: 'get',
            url: "<?php echo url('index/discovery/comment_love'); ?>&mid="+id+"&aid="+<?php echo $myarticle['id']; ?>,
            data:{

            },
            async:false,
            dataType:'json',
            success: function(data){
                if(data.status==1){
                    a.addClass("love_red");
                    num +=1;
                    a.text(num)
                    layer.msg(data.msg,{anim:0});

                }else{
                    layer.msg(data.msg,{anim:6});
                }
            },
            error: function(xhr){
                layer.msg('网络错误，请稍后再试');
            }
        });
    })
        
</script>




      


 
</body>

</html>