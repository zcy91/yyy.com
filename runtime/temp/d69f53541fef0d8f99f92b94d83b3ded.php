<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:71:"D:\wamp64\www\yyy.com\public/../application/index\view\user\invite.html";i:1534127511;s:66:"D:\wamp64\www\yyy.com\public/../application/index\view\header.html";i:1536904258;s:65:"D:\wamp64\www\yyy.com\public/../application/index\view\share.html";i:1534127867;}*/ ?>
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


</head>
<body style="position:relative;">

    <!--公共头部-->
    <div class="m-head" style="">
        <a href="javascript:;" onclick="javascript:window.history.back();return false;" class="head-goback">
            <i class="fa fa-angle-left"></i>
        </a>
        <p>邀请好友</p>
    </div>
    <!--公共头部结束-->
    <!--内容主体-->
    <div class="m-invite">
        <ul class="coupon-title">
            <li style="width: 49.5%;" class="ahover" onclick="window.location.href='<?php echo url('/index/user/invite'); ?>'">邀请好友</li>
            <li style="width: 49.5%;" onclick="window.location.href='<?php echo url('/index/user/recommend'); ?>'">推荐记录</li>
        </ul>
       
        <!--我的邀请码-->
        <div class="invite-top">
            <img src="/static/home/images/invtop.jpg" class="top-bg" />
            <div class="top-numb">
               <div class="numb-mynumb">
                   <p><?php echo $mycode; ?></p>
                   <span>我的邀请码</span>
               </div>
               
                <ul class="numb-mypeople">
                    <li>
                        <p onclick="window.location='<?php echo url('/index/user/recommend'); ?>'"><?php echo $num; ?></p>
                        <span>已邀请人数</span>
                    </li>
                    <li>
                        <p><?php echo $mycredit2; ?></p>
                        <span>累计积分</span>
                    </li>
                </ul>
                <ul class="setup-ftlist" >
                    <li>
                            <p style="margin-left: 0.1rem;font-size: .25rem;color: #5fbd78;margin-bottom: .1rem;">我的推荐人</p>
                            <?php if(!empty($member['agentid'])): ?>
                                <span><?php echo icode($member['agentid']); ?></span>
                            <?php else: ?>
                            <input style="margin:0.2rem; width: 50%" type="text" id="agentid" name="agentid" value="" placeholder="请填写我的推荐人">
                                <span style=' float: right;    text-align: center;    border: 1px solid #d9d9d9;    padding: .1rem 0;    color: #808080;' onclick="setagent()">提交</span>
                            <?php endif; ?>
                            
                    </li>
                </ul>
            </div>
        </div>
        <!--我的邀请码结束-->

        <!--邀请奖励-->
        <div class="invite-prize">
            <div class="prize-title">
                邀请奖励
            </div>
            <ul>
                <li>
<!--                    <i class="fa fa-user"></i>-->
<p>&nbsp;</p>
                </li>
                <li>
                    <i class="fa fa-gift"></i>
                    <p>推荐好友养羊成功，即可获得与被推荐人养羊金额等同的积分奖励，可在积分商城购物时使用。</p>
                </li>
                <li>
<!--                    <i class="fa fa-credit-card"></i>
                    <p>所有推荐类奖金可于邀请人认购期满后单独提现</p>-->
                </li>
            </ul>
        </div>
        <!--邀请奖励结束-->

        <!--分享-->
        <div class="invite-share">
            <ul>
                <li>
                    <a href="javascript:shareHref()" class="wechatBtn">
                        <i class="fa fa-wechat"><span>分享到微信</span></i>
                    </a>
                </li>
                <li>
                    <a href="<?php echo url('/index/user/qrcode'); ?>" class="friendBtn">
                        <i class="fa fa-spinner"><span>分享我的二维码</span></i>
                    </a>
                </li>
            </ul>
        </div>
        <!--分享结束-->

    </div>
    <!--内容主体结束-->
    <!-- 主页面标题 -->
    <div style='display:none;'>
            <p>链接地址：</p>
            <input id="sharehref"  type="url" value="<?php echo $sitehttp; ?><?php echo url('/index/login/reg'); ?>" />
            <p>链接标题：</p>
            <input id="sharehrefTitle"  type="text" value="<?php echo $member['username']; ?>邀请你加入【我是牧场主】" />
            <p>链接描述：</p>
            <input id="sharehrefDes"  type="text" value="<?php echo $member['username']; ?>邀请你加入【我是牧场主】"/>
    </div>    
<div id="yjfx" onclick="fxhide()" style="display:none;height:100%;width:100%;position: fixed; left: 0px;top: 0px;z-index: 100;background-image:url(/static/home/images/fx.png);background-size:cover"></div>
       
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
 
  wx.config({
    debug: false,
    appId: '<?php if(!empty($signPackage['appId'])): ?><?php echo $signPackage['appId']; endif; ?>',
    timestamp: <?php if(!empty($signPackage['timestamp'])): ?><?php echo $signPackage['timestamp']; else: ?>''<?php endif; ?>,
    nonceStr: '<?php if(!empty($signPackage['nonceStr'])): ?><?php echo $signPackage['nonceStr']; endif; ?>',
    signature: '<?php if(!empty($signPackage['signature'])): ?><?php echo $signPackage['signature']; endif; ?>',
    jsApiList: [
      // 所有要调用的 API 都要加到这个列表中
      'getLocation',
                 'onMenuShareTimeline', 
                 'onMenuShareAppMessage', 
                 'onMenuShareQQ',
                 'scanQRCode'
    ]
  });
  wx.ready(function () {
    // 在这里调用 API
    wx.onMenuShareAppMessage({

    title: '', // 分享标题

    desc: '食花百草羊，来自世界地质公园克什克腾旗，珍稀的内蒙古大草原珍品，隐然有花草清香，四季常食，有益健康。', // 分享描述

    link: '', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致

    imgUrl: '/static/home/images/sheepphoto.jpg', // 分享图标

    type: '', // 分享类型,music、video或link，不填默认为link

    dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空

    success: function () { 

        // 用户确认分享后执行的回调函数

    },

    cancel: function () { 

        // 用户取消分享后执行的回调函数

    }
  });
  

});

</script>
<script type="text/javascript" charset="utf-8">
      
        var shares=null;
        var Intent=null,File=null,Uri=null,main=null;
        // H5 plus事件处理
        function plusReady(){
            updateSerivces();
            if(plus.os.name=="Android"){
                main = plus.android.runtimeMainActivity();
                Intent = plus.android.importClass("android.content.Intent");
                File = plus.android.importClass("java.io.File");
                Uri = plus.android.importClass("android.net.Uri");
            }
        }
        if(window.plus){
            plusReady();
        }else{
            document.addEventListener("plusready",plusReady,false);
        }
        
        /**
         * 
         * 更新分享服务
         */
        function updateSerivces(){
            plus.share.getServices( function(s){
                shares={};
                for(var i in s){
                    var t=s[i];
                    shares[t.id]=t;
                }
            }, function(e){
                //alert("获取分享服务列表失败："+e.message );
            } );
        }
        
        
        
        /**
           * 分享操作
           * @param {JSON} sb 分享操作对象s.s为分享通道对象(plus.share.ShareService)
           * @param {Boolean} bh 是否分享链接
           */
        function shareAction(sb,bh) {
            if(!sb||!sb.s){
                //alert("无效的分享服务！");
                return;
            }
            
            var msg={content:sharehrefDes.value,extra:{scene:sb.x}};
            if(bh){
                msg.href=sharehref.value;
                if(sharehrefTitle&&sharehrefTitle.value!=""){
                    msg.title=sharehrefTitle.value;
                }
                if(sharehrefDes&&sharehrefDes.value!=""){
                    msg.content=sharehrefDes.value;
                }
                msg.thumbs=["_www/logo.png"];
                msg.pictures=["_www/logo.png"];
            }else{
                if(pic&&pic.realUrl){
                    msg.pictures=[pic.realUrl];
                }
            }
            // 发送分享
            if ( sb.s.authenticated ) {
                //alert("---已授权---");
                shareMessage(msg,sb.s);
            } else {
                //alert("---未授权---");
                sb.s.authorize( function(){
                        shareMessage(msg,sb.s);
                    },function(e){
                        //alert("认证授权失败："+e.code+" - "+e.message );
                    
                });
            }
        }
        /**
           * 发送分享消息
           * @param {JSON} msg
           * @param {plus.share.ShareService} s
           */
        function shareMessage(msg,s){
            
            //alert(JSON.stringify(msg));
            s.send( msg, function(){
                alert("分享到\""+s.description+"\"成功！ " );
                
            }, function(e){
                alert( "分享到\""+s.description+"\"失败: "+JSON.stringify(e) );
            
            } );
        }
        // 分析链接
        function shareHref(){
            var url = window.location.href;
            var params = JSON.stringify({type:"session", title:"邀请好友", description:"快来一起来食花百草领羊吧",url:url});
            try{
                switch(navigator.userAgent){
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
            }catch(e){
                console.log('pay error', e);
            }

//            <?php if($clientType=='app'): ?>
//                var shareBts=[];
//                // 更新分享列表
//                var ss=shares['weixin'];
//                ss&&ss.nativeClient&&(shareBts.push({title:'微信朋友圈',s:ss,x:'WXSceneTimeline'}),
//                shareBts.push({title:'微信好友',s:ss,x:'WXSceneSession'}));
//                ss=shares['qq'];
//                ss&&ss.nativeClient&&shareBts.push({title:'QQ',s:ss});
//                // 弹出分享列表
//                shareBts.length>0?plus.nativeUI.actionSheet({title:'分享链接',cancel:'取消',buttons:shareBts},function(e){
//                    (e.index>0)&&shareAction(shareBts[e.index-1],true);
//                }):plus.nativeUI.alert('当前环境无法支持分享链接操作!');
//
//            <?php else: ?>
//                 $('#yjfx').show();
//            <?php endif; ?>
            
            
        }
        function fxhide(){
                    $('#yjfx').hide();
                }
        
        </script>

<script src="/static/home/mui/mui.min.js"></script>
<!--<script src="/static/home/main-1.0.js"></script>-->
<!--<script src="https://static.mlinks.cc/scripts/dist/mlink.min.js"></script>-->
<script type="text/javascript">
var str = navigator.userAgent;
    
		
		$(function(){
			if(str.indexOf("Html5Plus") == -1111){
			var html = '<div class="jsRunApi_appbar" style="background: rgba(0, 0, 0, 0.6); position: fixed; left: 0px; bottom: 0px; transform-origin: left bottom 0px; z-index: 10000000; transform: scale(0.5625);"><div style="width: 640px;padding:30px;overflow: hidden;box-sizing: border-box;line-height:0;"><img src="data:image/png;base64,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" alt="" style="vertical-align: middle;width:60px;height:60px;"><div style="position: absolute;top:23px;left: 106px;line-height:38px;"><div style="font-size:28px;color: #ffffff;letter-spacing: 1px;vertical-align: middle;">我是牧场主</div><div style="font-size: 20px;color: #ffffff;opacity:0.6;letter-spacing: 1px;vertical-align: middle;">绿色赚钱新时代</div></div></div><div style="position:absolute;top:33px;right:30px;width:57.4%;box-sizing:border-box;overflow: hidden;"><a id="btnOpenApp" class="jsRunApi_appbar_bottom" style="text-decoration:none;float: right;background:#DB414A;height:56px;line-height:56px;text-align:center;border-radius: 8px;font-size: 28px;color: #ffffff;width: 44.7%;">打开APP</a></div></div>';
		    $('body').append(html);
		}
		
  /*
new Mlink({
    mlink:'https://avsnmx.mlinks.cc/Abre',//短链地址
    button:document.querySelector('a#btnOpenApp')
});
*/
});



/* 
------ 或 --------
var link='https://a.mlinks.cc/ABCD';//短链地址
var btn_1=document.querySelector('a#btnOpenApp1');
var btn_2=document.querySelector('a#btnOpenApp2');
var btn_3=document.querySelector('a#btnOpenApp3');
 
var options = [
    {
        mlink: link+'?name=1',
        button: btn_1
    }, {
        mlink:link+'?name=2',
        button: btn_2
    }, {
        mlink: link+'?name=3',
        button: btn_3
    }
];

new Mlink(options);

*/
</script>


<!--<script type="text/javascript" src="//js.users.51.la/19421681.js"></script>-->

<script>
//    if(typeof(yangJs) != 'undefined'){
//       $('.wechatBtn').hide();
//    }
    function setagent(){
        var agentid = $('#agentid').val();
        $.ajax({
                    type: 'POST',
                    url: '<?php echo url("/index/user/setagent"); ?>',
                    data:{
                        agentid:agentid,
                    },
                    dataType:'json',
                    success: function(data){
                        if(data.type==1){
                            layer.msg(data.msg);
                            setTimeout(" location.reload()",1500)
                        }else{
                            layer.msg(data.msg);
                        }
                    },
                    error: function(xhr){
                        layer.msg('error');
                    }
                });
    }
    
</script>
</body>
</html>
