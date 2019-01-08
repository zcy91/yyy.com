<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:71:"E:\phpStudy\WWW\yyy.com\public/../application/index\view\order\pay.html";i:1530933776;s:68:"E:\phpStudy\WWW\yyy.com\public/../application/index\view\header.html";i:1528532196;}*/ ?>
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


    <script type="text/javascript">
	//调用微信JS api 支付
	function jsApiCall()
	{
		WeixinJSBridge.invoke(
			'getBrandWCPayRequest',
                        <?php if(!empty($jsApiParameters)): ?><?php echo $jsApiParameters; else: ?>''<?php endif; ?>,
			function(res){
				WeixinJSBridge.log(res.err_msg);
				//alert(res.err_code+res.err_desc+res.err_msg);
			}
		);
	}

	function callpay()
	{
		if (typeof WeixinJSBridge == "undefined"){
		    if( document.addEventListener ){
		        document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
		    }else if (document.attachEvent){
		        document.attachEvent('WeixinJSBridgeReady', jsApiCall); 
		        document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
		    }
		}else{
		    jsApiCall();
		}
	}
    $(function(){
        $(":radio").click(function(){
            var paytype = $('input:radio[name="paytype"]:checked').val();
            if(paytype!=1){
                $("#paypwd").hide();
            }else{
                $("#paypwd").show();
            }
        })
        })

        function url() {
            window.location.href="<?php echo url('/index/user/paypassword'); ?>";
        }
        function mypay(){
            var paytype = $('input:radio[name="paytype"]:checked').val();
            if(paytype==2){

                <?php if(!empty($isjsp)): ?>
                layer.msg('微信支付需要先绑定微信',{anim:6},function(){
                    window.location.href='/index/user/setup';
                });
                <?php else: ?>
                callpay(); 
                 window.location.href='<?php echo url("/index/user/user"); ?>'
                <?php endif; ?>
               
            }else if(paytype==1){
                var oid = $("input[name='oid']").val();
                var paypwd = $("#paypassword").val();
                $.ajax({
                    type: 'POST',
                    url: '<?php echo url("/index/order/pay"); ?>',
                    data:{
                        paytype:paytype,
                        oid:oid,
                        paypwd:paypwd
                    },
                    dataType:'json',
                    success: function(data){
                        if(data.type==1){
                            layer.msg(data.data,{anim:0},function(){
                            //关闭后的操作
                            window.location.href='<?php echo url("/index/user/user"); ?>'
                            });
                        }else{
                            layer.msg(data.data,{anim:6});
                            if(data.url){
                                setTimeout('url()',1500);
                            }
                        }

                    },
                    error: function(xhr){
                        layer.msg('error',{anim:6});
                    }
                });
            }else if(paytype==3){
                    $("#paypwd").hide();
                     document.getElementById("formid").submit();
            }
        }
	</script>
</head>
<body style="position:relative;">

    <!--公共头部-->
    <div class="m-head">
        <a href="javascript:window.location.href = '<?php echo url('/index/user/user'); ?>';" class="head-goback">
            <i class="fa fa-angle-left"></i>
        </a>
        <p>支付</p>
    </div>
    <!--公共头部结束-->
    <!--内容主体-->
    <div class="m-pay">
        <!--羊羔信息-->
        <?php if(is_array($myorder) || $myorder instanceof \think\Collection || $myorder instanceof \think\Paginator): $i = 0; $__LIST__ = $myorder;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <div class="pay-info">
            <div class="info-photo">
                <img src="<?php if(!empty($vo['img'])) echo imgUrl($vo['img']);else echo imgUrl('') ?>" style="position: unset"/>
            </div>
            <div class="info-detail">
                <div class="detail-name" style="margin-top: .25rem">羊羔名字：<span><?php echo $vo['lambname']; ?></span></div>
                <div class="detail-cycle">养殖周期：<span><?php echo $vo['cycle']; ?></span><u>天</u></div>
            </div>
        </div>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        <!--羊羔信息结束-->
        <!--寄语-->
        <div class="pay-message">
            <?php echo $myorder['0']['message']; ?>
        </div>
        <!--寄语结束-->
        <!--订单详情-->
        <div class="pay-order">
            <h1>订单详情</h1>
            <ul>
                <li>
                    <span>订单编号：</span>
                    <u><?php echo $myorder['0']['ordersn']; ?></u>
                </li>
                <li>
                    <span>订单金额：</span>
                    <u><i class="fa fa-yen"></i><?php echo $myorder['0']['money']; ?></u>
                </li>
                <li>
                    <span>实付款：</span>
                    <u><i class="fa fa-yen"></i><?php echo $myorder['0']['price']; ?></u>
                </li>
            </ul>
        </div>
        <!--订单详情结束-->
        <!--订单详情-->
        <form id="formid" method='post' action="/index/index/alipay">
        <div class="pay-order">
            <h1>支付方式</h1>
            <ul>
                <?php if($paystr == 'wechat'): ?>
                <li>
                    <label>
                        <span><i class="fa fa-wechat weixin"></i>微信支付</span>
                        <input type="radio" name="paytype" value="2" />
                    </label>
                </li>
                <?php elseif($paystr == 'other' || $paystr == 'app'): ?>
                <li>
                    <label>
                        
                            <input type="hidden" id="WIDout_trade_no" name="WIDout_trade_no" value="<?php echo $myorder['0']['ordersn']; ?>" />
                            <span><i class="fa fa-jpy bankcard"></i>支付宝支付</span>
                            <input type="radio"  name="paytype" value="3" />
                        
                    </label>
                </li>
                <?php endif; ?>
                <li>
                    <label>
                        <span><i class="fa fa-jpy bankcard"></i>余额支付</span>
                        <input type="radio"  checked="checked"  name="paytype" value="1" />
                    </label>
                </li>
                <li id="paypwd">
                    <label>
                        <span><i class="fa fa-lock bankcard"></i>支付密码</span>
                        <input type="password"  name="paypwd" id="paypassword" style="width: 4rem;line-height: .25rem;font-size: .25rem" placeholder="请输入支付密码"/>
                    </label>
                </li>
                
            </ul>
        </div>
            </form>
        <!--订单详情结束-->
        <!--支付按钮-->
        <div class="pay-btn">
            <span>提示：一小时内未支付 订单将自动取消</span>
            <input type="hidden" name="oid" value="<?php echo $myorder['0']['id']; ?>" />
            <input type="button"  style="display: block;width: 3rem;margin: 0 auto;padding: .2rem 0;text-align: center;font-size: .3rem;color: #fff;border-radius: .1rem;background: #f66c48"  onclick="mypay()" value="点击支付"/>
        </div>
        <!--支付按钮结束-->
    </div>
    <!--内容主体结束-->
</body>
</html>
