<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:70:"D:\wamp64\www\yyy.com\public/../application/index\view\user\agent.html";i:1534410887;s:66:"D:\wamp64\www\yyy.com\public/../application/index\view\header.html";i:1534386683;s:68:"D:\wamp64\www\yyy.com\public/../application/index\view\wx_share.html";i:1534409802;}*/ ?>
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


</head>
<style>
    .agent{
        padding: 0 .1rem;
        font-size: .22rem;
        line-height: .3rem;
        color: #999999;
    }
    .invite-share ul li{
        width: 100%;
    }
</style>
<body style="position:relative;">

    <!--公共头部-->
    <div class="m-head">
        <a href="javascript:;" onclick="javascript:window.history.back();return false;" class="head-goback">
            <i class="fa fa-angle-left"></i>
        </a>
        <p>代理证书</p>
        <div class="public-input-wrapper" style="padding-top: 0">
            <a class="public-submit" src="<?php echo $img; ?>"  id="img"  href="<?php echo $img; ?>?mp.wexin.qq.com"  >下载</a>
        </div>
    </div>
    <!--公共头部结束-->
    <!--内容主体-->
    <div class="m-protocol">

        <img src="<?php echo url('/index/user/getagent',array('uid'=>$uid,'id'=>$id)); ?>" />

    </div>
    <div class="agent" style="text-align: center">
        代理说明如下：
    </div>
    <div class="agent">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A代理推荐B代理领养并且兑换成功，A代理会获得350元/只的奖励；B代理推荐C代理领养并且兑换成功 ，B代理会获得350元/只奖励，A代理会获得150元/只奖励，C代理推荐D代理领养并且兑换成功， C代理会获得350元/只奖励，B代理会获得150元/只奖励，A代理不再享有奖励。
    </div>
    <div class="invite-share">
        <ul>
            <li>
                <a href="javascript:shareHref()" class="wechatBtn" style="margin-top: .15rem;text-align: center">
                    <i class="fa fa-wechat"><span>分享到微信</span></i>
                </a>
            </li>
        </ul>
    </div>
    <div id="yjfx" onclick="fxhide()" style="display:none;height:100%;width:100%;position: fixed; left: 0px;top: 0px;z-index: 100;background-image:url(/static/home/images/fx.png);background-size:cover"></div>
    <script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script src="/static/js/global.js"></script>

<script type="text/javascript">

   var ShareLink = "http://yang.oioos.com/index/index/agent/uid/<?php echo $uid; ?>/id/<?php echo $id; ?>/"; //默认分享链接
   var ShareImgUrl = "http://yang.oioos.com/static/home/images/shouquan.jpg"; //分享图标



$(function() {

		
	if(isWeiXin()){
		$.ajax({
			type : "POST",
			url:"<?php echo url('index/index/ajaxGetWxConfig'); ?>"+"?rand="+Math.random(),
			data:{'askUrl':encodeURIComponent(location.href.split('#')[0])},		
			dataType:'JSON',
			success: function(res)
			{

				//微信配置
				wx.config({
				    debug: false, 
				    appId: res.appId,
				    timestamp: res.timestamp, 
				    nonceStr: res.nonceStr, 
				    signature: res.signature,
				    jsApiList: ['onMenuShareTimeline', 'onMenuShareAppMessage','onMenuShareQQ','onMenuShareQZone','hideOptionMenu'] // 功能列表，我们要使用JS-SDK的什么功能
				});
			},
			error:function(){
				return false;
			}
		}); 

		// config信息验证后会执行ready方法，所有接口调用都必须在config接口获得结果之后，config是一个客户端的异步操作，所以如果需要在 页面加载时就调用相关接口，则须把相关接口放在ready函数中调用来确保正确执行。对于用户触发时才调用的接口，则可以直接调用，不需要放在ready 函数中。
		wx.ready(function(){

		    // 获取"分享到朋友圈"按钮点击状态及自定义分享内容接口
		    wx.onMenuShareTimeline({
		        title: "<?php echo $webtitle; ?>", // 分享标题
		        link:ShareLink,
		        imgUrl:ShareImgUrl // 分享图标
		    });

		    // 获取"分享给朋友"按钮点击状态及自定义分享内容接口
		    wx.onMenuShareAppMessage({
		        title: "<?php echo $webtitle; ?>", // 分享标题
		        desc: "食花百草羊——代理证书", // 分享描述
		        link:ShareLink,
		        imgUrl:ShareImgUrl // 分享图标
		    });
			// 分享到QQ
			wx.onMenuShareQQ({
		        title: "<?php echo $webtitle; ?>", // 分享标题
		        desc: "食花百草羊——代理证书", // 分享描述
		        link:ShareLink,
		        imgUrl:ShareImgUrl // 分享图标
			});	
			// 分享到QQ空间
			wx.onMenuShareQZone({
		        title: "<?php echo $webtitle; ?>", // 分享标题
		        desc: "食花百草羊——代理证书", // 分享描述
		        link:ShareLink,
		        imgUrl:ShareImgUrl // 分享图标
			});

		   
		});
	}
});

function isWeiXin(){
    var ua = window.navigator.userAgent.toLowerCase();
    if(ua.match(/MicroMessenger/i) == 'micromessenger'){
        return true;
    }else{
        return false;
    }
}
</script>
<!--微信关注提醒 start-->

<button class="guide" style="display:none;" onclick="follow_wx()">关注公众号</button>
<style type="text/css">
.guide{width:1rem;height:4rem;text-align: center;border-radius: 0.2rem ;font-size:0.5rem;padding:0.2rem 0;border:1px solid #adadab;color:#000000;background-color: #fff;position: fixed;right: 0.1rem;bottom: 10rem;}
#cover{display:none;position:absolute;left:0;top:0;z-index:18888;background-color:#000000;opacity:0.7;}
#guide{display:none;position:absolute;top:0.1rem;z-index:19999;}
#guide img{width: 70%;height: auto;display: block;margin: 0 auto;margin-top: 0.2rem;}
</style>


<!--微信关注提醒  end-->
    <script>
        $('#img').click(function () {
            {
               var img = $("#img").attr('src');
                layer.msg('下载成功');
//                $.ajax({
//                    type: 'POST',
//                    url: '<?php echo url("/index/user/downimg"); ?>',
//                    data:{
//                        img:img,
//                    },
//                    success: function(data){
//                        if(data.type==1){
//                            layer.msg(data.img);
//
//                        }else{
//                            layer.msg(data.img);
//                        }
//                    },
//                    error: function(xhr){
//                        layer.msg('error');
//                    }
//                });
            }
        })

        $(document).ready(function () {
            $("#img").attr("src", "<?php echo $img; ?>");
        })
        function fxhide(){
            $('#yjfx').hide();
        }
        function shareHref() {
            var url = window.location.href;
            var params = JSON.stringify({type: "session", title: "邀请好友", description: "快来一起来食花百草领羊吧", url: url});
            try {
                switch (navigator.userAgent) {
                    case "oioos_webkit_ios":
                        //app ios
                        window.location.href = "ios://share_to_wx?" + params;
                        break;
                        return false;

                    case "Yang_Webview":
                    //兼容第一个版本的羊
                    case "oioos_webkit_android":
                        //app android
                        yangJs.shareUrlToWx(params);
                        break;

                    default:
                        $('#yjfx').show();
                        //其他浏览器：webkit safari wexin(公众号)
                        console.log("pay data is", object2data(pay_data));
                }
            } catch (e) {
                console.log('pay error', e);
            }
        }
    </script>
</body>
</html>
