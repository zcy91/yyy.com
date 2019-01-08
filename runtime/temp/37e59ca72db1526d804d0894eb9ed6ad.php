<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:71:"D:\wamp64\www\yyy.com\public/../application/index\view\user\detail.html";i:1532921438;s:66:"D:\wamp64\www\yyy.com\public/../application/index\view\header.html";i:1532921433;}*/ ?>
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


    <link rel="stylesheet" type="text/css" href="/static/home/css/wx.css" />
    <link rel="stylesheet" type="text/css" href="/static/home/css/page_mp_article_improve_combo322696.css">
    
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
                        <a class="J_ping" report-eventid="MProductdetail_CommentPictureTab" report-pageparam="1725965683" >
                            <ul class="">
                                <?php if(is_array($myarticle['img']) || $myarticle['img'] instanceof \think\Collection || $myarticle['img'] instanceof \think\Paginator): if( count($myarticle['img'])==0 ) : echo "" ;else: foreach($myarticle['img'] as $key=>$v2): ?>
                                <li class="" >
                                    <a href="<?php echo $v2; ?>"><img src="<?php echo $v2; ?>" ></a>
                                </li>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </ul>
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
        <div style="height:2.6em;width:100%;background-color:#fff"></div>

<script type="text/javascript" src="/static/js/jquery.min.js"></script>
<script>
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