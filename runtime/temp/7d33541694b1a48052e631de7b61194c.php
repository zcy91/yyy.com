<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:73:"D:\wamp64\www\yyy.com\public/../application/index\view\mall\shopcart.html";i:1519781944;s:66:"D:\wamp64\www\yyy.com\public/../application/index\view\header.html";i:1528532196;}*/ ?>
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


    <link href="/static/home/css/swiper-3.3.1.min.css" rel="stylesheet" />
    <script src="/static/home/js/swiper-3.3.1.jquery.min.js"></script>
</head>
<body style="position:relative;">

    <!--公共头部-->
    <div class="m-head">
        <a href="javascript:;" onclick="javascript:window.history.back();return false;" class="head-goback">
            <i class="fa fa-angle-left"></i>
        </a>
        <p>积分商城</p>
    </div>
    <!--公共头部结束-->
    <!--内容主体-->
    <div class="m-spcart">
        <div class="spcart-tips">已加购商品<a href="javascript:;">编辑</a></div>
        <form class="layui-form col-lg-5" id="yourformid">
        <ul class="spcart-list">
            <?php if(!empty($list)): if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <li id="li_<?php echo $vo['id']; ?>">
                <i class="fa fa-dot-circle-o"></i>
                <a href="shop-detail.html" class="list-photo"><img src="<?php if(!empty($vo['img'])) echo imgUrl($vo['img']);else echo imgUrl('') ?>" /></a>
                <div class="list-info" style="position: relative;">
                    <p><?php echo $vo['gname']; ?></p>
                    <span style=" position: absolute;  top: -0.6rem; right: 0;float: right;font-size: .25rem;color: #828282;" onclick='del_cookie(<?php echo $vo['id']; ?>)'>
                        <i class="fa fa-window-close"></i>
                    </span>
                    <span>羊肉很好吃，又健康，肥而不腻，保健养生。</span>
                    <input type="hidden" id='price_<?php echo $vo['id']; ?>' value="<?php echo $vo['price2']; ?>"> 
                    <b>积分：<u id='prices_<?php echo $vo['id']; ?>' class="pricesarr"><?php echo $vo['price2s']; ?></u></b>
                    <div class="info-btn">
                        <input type="button" value="+"  onclick="setnum(2,<?php echo $vo['id']; ?>)" class="add" />
                        <input type="text" id="numb_<?php echo $vo['id']; ?>" name='num[<?php echo $vo['id']; ?>]' value="<?php echo $vo['num']; ?>" class="text" />
                        <input type="button" value="-"  onclick="setnum(1,<?php echo $vo['id']; ?>)" class="min" />
                    </div>
                </div>
            </li>
            <?php endforeach; endif; else: echo "" ;endif; else: endif; ?>
        </ul>
        </form>
    </div>
    <!--内容主体结束-->
    <!--购买底部-->
    <div class="spcart-footer">
        <i class="fa fa-circle-o"></i>
        <span>总计积分：<u id="totalprice"><?php echo $total; ?></u></span>
        <a href="javascript:addmallorder();">去结算</a>
    </div>
    <!--购买底部结束-->
<script>
        function setnum(id,gid){
            var price=$('#price_'+gid).val();
            var num =$('#numb_'+gid).val();
            var pricesarr=0;
            if(id==1){
                var nums=parseInt(num)-1;
                if(nums<=0){nums=1};
                var prices=nums*price;
                $('#numb_'+gid).val(nums);
                $('#prices_'+gid).html(prices.toFixed(2));
            }else{
                var nums=parseInt(num)+1;
                if(nums<=0){nums=1};
                var prices=nums*price;
                $('#numb_'+gid).val(nums);
                $('#prices_'+gid).html(prices.toFixed(2));
            }
            $(".pricesarr").each(function() {
                   pricesarr+= parseInt($(this).html());
            });
            $('#totalprice').html(toDecimal2(pricesarr));
        }
        
        //制保留2位小数，如：2，会在2后面补上00.即2.00 
        function toDecimal2(x) { 
         var f = parseFloat(x); 
         if (isNaN(f)) { 
         return false; 
         } 
         var f = Math.round(x*100)/100; 
         var s = f.toString(); 
         var rs = s.indexOf('.'); 
         if (rs < 0) { 
         rs = s.length; 
         s += '.'; 
         } 
         while (s.length <= rs + 2) { 
         s += '0'; 
         } 
         return s; 
        } 
        //提交购物车
        function addmallorder(){
            //判断用户是否已经登录
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
        
        function del_cookie(id){
            var msg = "您真的确定要删除吗？\n\n请确认！";
                if (confirm(msg)==true){
                }else{
                return false;
                }
                $.ajax({
                    type: 'POST',
                    url: '<?php echo url("/index/mall/delcookie"); ?>',
                    data:{
                        id:id
                    },
                    dataType:'json',
                    success: function(data){
                        if(data.type==1){
                            $('#li_'+id).remove();
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
