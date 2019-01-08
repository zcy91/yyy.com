<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:76:"E:\phpStudy\WWW\yyy.com\public/../application/index\view\order\addorder.html";i:1523512234;s:68:"E:\phpStudy\WWW\yyy.com\public/../application/index\view\header.html";i:1528532196;}*/ ?>
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
<body style="position:relative;">

    <!--公共头部-->
    <div class="m-head">
        <a href="javascript:;" onclick="javascript:window.history.back();return false;" class="head-goback">
            <i class="fa fa-angle-left"></i>
        </a>
        <p>填写申请</p>
    </div>
    <!--公共头部结束-->
    <!--内容主体-->
    <div class="m-applic">
        <!--羊羔照片-->
        <div class="applic-photo">
            <img src="<?php if(!empty($mygoods['img'])) echo imgUrl($mygoods['img']);else echo imgUrl('') ?>" />
        </div>
        <!--羊羔照片结束-->
        <!--羊羔名字-->
        <div class="applic-name">
           <?php $__FOR_START_19757__=0;$__FOR_END_19757__=$num;for($i=$__FOR_START_19757__;$i < $__FOR_END_19757__;$i+=1){ ?>
                <input name="lambname" type="text" placeholder="请为羊羔取名" />
            <?php } ?>
        </div>
        <!--羊羔名字结束-->
        <!--羊羔寄语-->
        <div class="applic-message">
             <textarea name="message" id="message" placeholder="请填写寄语"></textarea>
        </div>
        <!--羊羔寄语结束-->
        <!--申请按钮-->
        <div class="applic-btn">
            <input type="hidden" name='gid' value='<?php echo $mygoods['id']; ?>'/>
            <input type="hidden" name='num' value='<?php echo $num; ?>'/>
            <input type="hidden" name='coupon' value='<?php echo $coupon; ?>'/>
            <input type="hidden" name='autograph' value='<?php echo $autograph; ?>'/>
            <input style="display: block;
    width: 3rem;
    margin: 0 auto;
    padding: .2rem 0;
    text-align: center;
    font-size: .3rem;
    color: #fff;
    border-radius: .1rem;
    background: #83ae3f;" type="button" onclick="addOrderLamb()" value="点击申请" />
        </div>
        <!--申请按钮结束-->
    </div>
    <!--内容主体结束-->
    <script>
        function addOrderLamb() {
                lambname =new Array();
                $('input[name^="lambname"]').each(function(i, el) {
                    lambname[i] = $(this).val();
                  });
                var message = $('#message').val();
                var gid = $('input[name="gid"]').val();
                var num = $('input[name="num"]').val();
                var coupon = $('input[name="coupon"]').val();
                var autograph = $('input[name="autograph"]').val();
               // alert(coupon);return false;
                $.ajax({
                    type: 'POST',
                    url: '<?php echo url("/index/order/addorderlamb"); ?>',
                    data:{
                        message:message,
                        lambname:lambname,
                        gid:gid,
                        num:num,
                        coupon:coupon,
                        autograph:autograph,
                    },
                    dataType:'json',
                    success: function(data){
                        if(data.type==1){
                            layer.msg(data.msg,{anim:0},function(){
                            //关闭后的操作
                            window.location.href='/index/order/pay?oid='+data.oid;
                            });
                            
                        }else{
                            layer.msg(data.msg,{anim:6});
                        }
                    },
                    error: function(xhr){
                        layer.msg('error',{anim:6});
                    }
                });
                resetCode(); //倒计时
            }
    </script>
</body>
</html>
