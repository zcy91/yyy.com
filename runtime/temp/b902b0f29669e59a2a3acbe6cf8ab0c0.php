<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:83:"D:\wamp64\www\yyy.com\public/../application/index\view\discovery\ajaxcommunity.html";i:1522822852;s:66:"D:\wamp64\www\yyy.com\public/../application/index\view\header.html";i:1528532196;}*/ ?>
<!--<!DOCTYPE html>
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

--><!-- 公共头部 --><!-- 公共头部结束 --><!-- 评论区 --><div class='community-comment' id="comList" style="padding-bottom: 0rem">    <ul>        <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;        if(@$_SESSION['think']['user']['user_id']){        $userid = $_SESSION['think']['user']['user_id'];        $iszan = db('comment') -> where('userid',$userid)->where('aid',$vo['id'])->where('comment',Null)-> where("mid",0)->value('iszan');        }elseif(@$_COOKIE['mobile']){        $mobile = $_COOKIE['mobile'];        $userid = db('member') -> where('mobile',$mobile) -> value('id');        $iszan = db('comment') -> where('userid',$userid)->where('aid',$vo['id'])->where('comment',Null)-> where("mid",0)->value('iszan');        }else{        $iszan = 0;        }         ?>        <li class="comment_border" style="border-bottom:0.08rem solid #ececec;">            <div class='comment-wrapper'>                <img class='comment-user-profile' src="<?php if(!empty($vo['avatar'])) echo imgUrl($vo['avatar']);else echo '/static/home/images/logo.jpg' ?>">                <span class="comment-username"><?php echo $vo['username']; ?></span>                <a href="<?php echo url('index/discovery/content',array('id'=> $vo['id'])); ?>">                    <p class="comment-content comment"><?php echo $vo['content']; ?></p>                    <div class="product-img-module item-pic-list">                        <a class="J_ping" report-eventid="MProductdetail_CommentPictureTab" report-pageparam="1725965683" >                            <ul class=" video_list">                                <?php if(is_array($vo['img']) || $vo['img'] instanceof \think\Collection || $vo['img'] instanceof \think\Paginator): if( count($vo['img'])==0 ) : echo "" ;else: foreach($vo['img'] as $key=>$v2): ?>                                <li class="" >                                    <a href="<?php echo $v2; ?>"><img src="<?php echo $v2; ?>" ></a>                                </li>                                <?php endforeach; endif; else: echo "" ;endif; ?>                            </ul>                        </a>                    </div>                    <div class="comment-image-wrapper">                    </div></a>                <div class="comment-date">                    <span><?php echo $vo['timestr']; ?></span>                    <i class="fa fa-commenting fa-lg message-icon" value="<?php echo $vo['id']; ?>" ><?php echo $vo['comment']; ?></i>                    <i class="fa fa-heart fa-lg love-icon <?php if($iszan == 1): ?> love_red <?php endif; ?>" value="<?php echo $vo['id']; ?>"><?php echo $vo['zan']; ?></i>                </div>            </div>        </li>        <?php endforeach; endif; else: echo "" ;endif; ?>    </ul>    <?php if(($count > $current_count) AND (count($commentlist) == $page_count)): ?>    <div class="getmore" style="font-size:.32rem;text-align:center;color:#888;padding:.25rem .24rem .4rem; clear:both">        <a href="javascript:void(0)" onClick="ajaxSourchSubmit();">点击加载更多</a>    </div>    <?php elseif(($count <= $current_count AND $count > 0)): ?>    <div class="score enkecor" style="font-size:.32rem;text-align:center;color:#888;padding:.25rem .24rem .4rem; clear:both">已显示完所有内容</div>    <?php else: endif; ?></div><!-- 评论区结束 --><!--公共底部--><!--公共底部结束--><script src="/static/home/js/klass.min.js"></script><script>    if(<?php echo $p; ?>){        var page = <?php echo $p; ?>;    }else{        var page = 1 ;    }    function ajaxSourchSubmit() {        page += 1;        $.ajax({            type: "GET",            url: "<?php echo url('index/discovery/ajaxcommunity'); ?>"+"&p=" + page,            success: function (data) {                $('.getmore').hide();                if ($.trim(data) != ''){                    $("#comList").append(data);                }            }        });    }    function  ajax_sourch_submit_hide(){        $('.getmore').hide();    }    $(".message-icon").click(function () {        var id = ($(this).attr('value'));        $.ajax({            type: 'post',            url: "<?php echo url('index/discovery/iscomment_login'); ?>&mid=0&aid="+id,            async:false,            dataType:'json',            success: function(data){                if(data.status==1){                    layer.open({                        type: 1,                        area: ['5.5rem', '4.2rem'],                        title: '评论',                        shadeClose: true, //点击遮罩关闭                        content: '\<\div style="padding:.1rem;" class="comment-window-wrapper"><textarea class="comment-alert" name="comment">\<\/textarea>\<input class="comment-alert-submit" type="button" id="comment_sub" value="提交评论">\<\/div>',                        end: function () {                            location.reload();                        }                    });                    //layer.msg(data.msg,{anim:0});                    // <form action="<?php echo url('index/discovery/comment'); ?>&mid=0&aid='+id+'" enctype="multipart/form-data" method="post">                    var index = parent.layer.getFrameIndex(window.name);                    $('#comment_sub').on('click', function(){                        $.ajax({                            type: 'post',                            url: "<?php echo url('index/discovery/comment'); ?>&mid=0&aid=" + id,                            async: false,                            dataType: 'json',                            success:function (res) {                                if(res.status==2){                                    layer.msg(res.msg,{anim:0});                                    setTimeout("layer.closeAll()",1500)                                }else{                                    layer.msg(data.msg,{anim:6})                                    setTimeout("layer.closeAll()",1500)                                }                            }                        })                    });                }else{                    layer.msg(data.msg,{anim:6});                    return false;                }            }        })    })    $(".love-icon").click(function () {        var id = ($(this).attr('value'));        var num=parseInt($(this).text());        var a = $(this);        // ($(this).text(2))        $.ajax({            type: 'get',            url: "<?php echo url('index/discovery/comment'); ?>&mid=0&aid="+id,            data:{            },            async:false,            dataType:'json',            success: function(data){                if(data.status==1){                    a.addClass("love_red");                    num +=1;                    a.text(num)                    layer.msg(data.msg,{anim:0});                }else{                    layer.msg(data.msg,{anim:6});                }            },            error: function(xhr){                layer.msg('error');            }        });    })</script></body></html>