<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:80:"/home/wwwroot/yang.oioos.com/public/../application/index/view/order/mallpay.html";i:1523236726;s:73:"/home/wwwroot/yang.oioos.com/public/../application/index/view/header.html";i:1526866272;}*/ ?>
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
    <script type="text/javascript">
	
        function mypay(){
            var myaddress = $("#myaddress").html();
            if(myaddress.length == 0){
                 layer.msg('请选择收货地址！');
                 return;
            }
            var paytype = $('input:radio[name="paytype"]:checked').val();
            if(paytype==5){
                var oid = $("input[name='oid']").val();
                $.ajax({
                    type: 'POST',
                    url: '<?php echo url("/index/order/mallpay"); ?>',
                    data:{
                        paytype:paytype,
                        oid:oid
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
                        }
                    },
                    error: function(xhr){
                        layer.msg('error',{anim:6});
                    }
                });
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
                <div class="detail-name">商品名称：<span><?php echo $vo['gname']; ?></span></div>
                <div class="detail-cycle">购买数量：<span><?php echo $vo['num']; ?></span></div>
                <div class="detail-rebate">商品单价：<span style="    font-size: .25rem;    padding-top: .25rem;    color: #808080;"><?php echo $vo['price2']; ?></span></div>
            </div>
        </div>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        <!--羊羔信息结束-->
        <!--寄语-->
        <div class="pay-message">
            
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
                    <u><i class="fa fa-yen"></i><?php echo $myorder['0']['integral']; ?></u>
                </li>
            </ul>
        </div>
        <!--订单详情结束-->
         <div class="pay-order">
            <h1>邮寄地址</h1>
            <ul>
                <li  onclick="javascript:location.href='<?php echo url('/index/user/address'); ?>'">
                    <span>收货地址：</span>
                    <u  style="margin-left:0.5rem;float: left;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;" id="myaddress"><?php if(!empty($isaddress)): ?><?php echo $isaddress['name']; ?>(<?php echo $isaddress['phone']; ?>)<?php echo $isaddress['province']; ?><?php echo $isaddress['city']; ?>...<?php endif; ?></u>
                    <i style="float: right;" class="fa fa-angle-right ftlist-enter"></i>
                </li>
            </ul>
        </div>
        <!--订单详情-->
        <form id="formid" method='post' action="/index/index/alipay">
        <div class="pay-order">
            <h1>支付方式</h1>
            <ul>
                
                <li>
                    <label>
                        <span><i class="fa fa-jpy bankcard"></i>积分支付</span>
                        <input type="radio"  checked="checked"  name="paytype" value="5" />
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
