<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:82:"/home/wwwroot/yang.oioos.com/public/../application/index/view/mall/malldetail.html";i:1519783102;s:73:"/home/wwwroot/yang.oioos.com/public/../application/index/view/header.html";i:1526866272;}*/ ?>
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
</head>
<body style="position:relative;">

    <!--公共头部-->
    <div class="m-head">
        <a href="javascript:;" onclick="javascript:window.history.back();return false;" class="head-goback">
            <i class="fa fa-angle-left"></i>
        </a>
        <p>商品详情</p>
        <a href="<?php echo url('/index/mall/shopcart'); ?>" class="head-info">
            <i class="fa fa-shopping-cart "></i>
        </a>
    </div>
    <!--公共头部结束-->
    <!--内容主体-->
    <div class="m-spdetail">
        <!--轮播广告-->
        <div class="spdetail-advimg">
            <!-- Swiper -->
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img style='width: 100%;height: 4rem;' src="<?php if(!empty($details['img'])) echo imgUrl($details['img']);else echo imgUrl('') ?>" />
                    </div>
                </div>
                <!-- Add Pagination -->
                <div class="swiper-pagination"></div>
            </div>
        </div>
        <!--轮播广告结束-->
        <form class="layui-form col-lg-5" id="yourformid">
        <!--产品名字-->
        <div class="spdetail-name">
            <p><?php echo $details['gname']; ?></p>
            <span>羊肉很好吃，又健康，肥而不腻，保健养生。</span>
        </div>
        <!--产品名字结束-->
        <!--产品信息-->
        <div class="spdetail-info">
            <p>积分：<u id='price'><?php echo $details['price2']; ?></u></p>
            <div class="info-numb">
                <span>包邮</span>
                <i>积分：<?php echo $details['price2']; ?></i>
                <b><?php echo $details['sold']; ?>人已兑换</b>
            </div>
        </div>
        <!--产品信息结束-->
        <!--产品购买-->
        <div class="spdetail-buy">
            <div class="buy-numb">
                <span>购买数量</span>
                <div class="numb-btn">
                    <input type="button"  onclick="setnum(2)"  value="+" class="add" />
                    <input type="text" id='numb' name='num[<?php echo $details['id']; ?>]' placeholder="0" value="1" class="text" />
                    <input type="button"  onclick="setnum(1)" value="-" class="min" />
                </div>
            </div>
            <div class="buy-info">
                总计积分：<span id="prices"><?php echo $details['price2']; ?></span>
            </div>
        </div>
        <!--产品购买结束-->
        <!--产品详情-->
        <div class="spdetail-detail">
            <?php echo $details['content']; ?>
        </div>
        <!--产品详情结束-->
        </form> 
    </div>
    <!--内容主体结束-->
    <!--购买底部-->
    <div class="shop-footer">
        <a href="javascript:shopCart();">
            <i class="fa fa-shopping-cart"></i>加入购物车
        </a>
        <a href="javascript:addmallorder();">
            <i class="fa fa-dollar"></i>立即购买
        </a>
    </div>
    <!--购买底部结束-->
    <script>
        function setnum(id){
            var price=$('#price').html();
            var num =$('#numb').val();
            if(id==1){
                var nums=parseInt(num)-1;
                if(nums<=0){nums=1};
                var prices=nums*price;
                $('#numb').val(nums);
                $('#prices').html(prices.toFixed(2));
            }else{
                var nums=parseInt(num)+1;
                if(nums<=0){nums=1};
                var prices=nums*price;
                $('#numb').val(nums);
                $('#prices').html(prices.toFixed(2));
            }
        }
    </script>
    <script>
         //提交订单
        function addmallorder(){
            <?php if(!empty($memberid)): ?>
            $.ajax({
                type: 'POST',
                url: '/index/order/addmallorder',
                data:$('#yourformid').serialize(),
                success: function(data){
                     if(data.type==1){
                        layer.msg(data.msg,{anim:0},function(){
                            //关闭后的操作
                            window.location.href='/index/order/mallpay/oid/'+data.oid;
                            });
                    }else{
                        layer.msg(data.msg);
                    }

                },
                error: function(xhr){
                    layer.msg('error');
                }
            });
            <?php else: ?>
                layer.msg('尚未登录，请先登录',{anim:0},function(){
                    //关闭后的操作
                    window.location.href='/index/login/login';
                });
            <?php endif; ?>
        }
        function shopCart(){
             var gid = <?php echo $details['id']; ?>;
             var num = $('#numb').val();
                $.ajax({
                    type: 'POST',
                    url: '<?php echo url("/index/mall/setshopcart"); ?>',
                    data:{
                        gid:gid,
                        num:num,
                    },
                    dataType:'json',
                    success: function(data){
                        if(data.type==1){
                            layer.msg(data.msg);
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
