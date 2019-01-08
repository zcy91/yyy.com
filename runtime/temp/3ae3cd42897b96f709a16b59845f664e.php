<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:75:"E:\phpStudy\WWW\yyy.com\public/../application/index\view\shop\gdetails.html";i:1529465984;s:68:"E:\phpStudy\WWW\yyy.com\public/../application/index\view\header.html";i:1528532196;}*/ ?>
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
        <p>提交领养</p>
    </div>
    <!--公共头部结束-->
    <!--内容主体-->
    <div class="m-placeOD">
        <!--羊羔名字-->
        <div class="placeOD-name">
            <p><?php echo $details['gname']; ?></p>
            <span><i class="fa fa-map-marker"></i>内蒙古</span>
        </div>
        <!--羊羔名字结束-->
        <!--羊羔信息-->
        <div class="placeOD-info">
            <div class="info-photo">
                <img src="<?php if(!empty($details['img'])) echo imgUrl($details['img']);else echo imgUrl('') ?>" style="position: unset"/>
            </div>
            <div class="info-detail">
                <div class="detail-money"><i class="fa fa-yen"></i><span  class="price"><?php echo $details['price']; ?></span><u>/ 只</u></div>
                <div class="detail-cycle">养殖周期：<span><?php echo $details['cycle']; ?></span><u>天</u></div>
                <div class="detail-rebate" style="display: none"><span><?php echo $details['percentage']; ?>%</span><u>预计年化收益率</u></div>
            </div>
        </div>
        <!--羊羔信息结束-->
        <form name="input" id="searchForm" action="<?php echo url('/index/order/addorder'); ?>" method="post">
        <!--购买数量-->
        <div class="placeOD-buy">
            <div class="buy-sum">
                <p>总价</p>
                <span><i class="fa fa-yen"></i><u class="prices"><?php echo $details['price']; ?></u></span>
            </div>
            <div class="buy-numb">
                <p>购买数量</p>
                <div class="numb-ob">
                    <input type="button" onclick="setnum(1)"  value="-" class="min" />
                    <input type="text"  name='num' class="numb"  value="1"  />
                    <input type="button" onclick="setnum(2)"  value="+" class="add" />
                </div>
                <span>剩余数量：<u><?php echo $details['stock']; ?></u>只</span>
            </div>
        </div>
        <!--购买数量结束-->
        <!--信息介绍-->
        <div class="placeOD-infolist">
            <ul>
                <li>
                    <a href="<?php echo url('/index/discovery/pasture'); ?>">
                        牧场介绍<i class="fa fa-angle-right"></i>
                    </a>
                </li>
                <li>
                    <a href="<?php echo url('/index/shop/lambsn',array('gid'=>$details['id'])); ?>">
                        耳标查询<i class="fa fa-angle-right"></i>
                    </a>
                </li>
                <li>
                    <a href="<?php echo url('/index/shop/income'); ?>">
                        收益说明<i class="fa fa-angle-right"></i>
                    </a>
                </li>
                <li>
                    <a href="javascript:choice_coupon()">
                        优惠券<i class="fa fa-angle-right"></i>
                        <span style="float: right;position: relative; margin-right:0.25rem;display: inline-block;    padding: 0 6px;    font-size: 12px;    text-align: center;
                        background-color: #FF5722;    color: #fff;    border-radius: 2px;"><?php echo $couponnum; ?></span>
                        <span id="coupon_name" style=" float: right; margin-right:0.25rem;"></span>
                        <input type="hidden" id="coupon" name='coupon'  value="0"  />
                    </a>
                </li>
            </ul>
        </div>
        <!--信息介绍结束-->
        <!--认领协议-->
        <div class="placeOD-protocol">
            <span>认领协议</span>
            <label>
                <i class="fa fa-circle-o btnAgree" numb="0"></i>同意并签名<a href="<?php echo url('/index/shop/protocol'); ?>">《认领协议》</a>
            </label>
        </div>
        <!--认领协议结束-->
        <!--提示语-->
        <div class="placeOD-tips">
            <p><span>温馨提示：</span>当您认领食花百草羊（数量≥1只）后，将成为尊贵牧场主，获得专属于您的牧场，与我们共享那片草原的使用权。具体包括：</p>
            <p>1.草原深度游高级折扣（服务包括：使用蒙古包、住宿、餐饮、出行、私家旅行路线规划、资深导游陪同讲解等）；</p>
            <p>2.购买食花百草羊品牌下产品享受优惠折扣。</p>

            <h1>
                认领羊只数量不同，所享受的折扣会有所差别，但服务质量等同。<span>详询可致电：400-833-6836</span>
            </h1>
        </div>
        <!--提示语结束-->
    </div>
    <!--内容主体结束-->
    <!--优惠券-->
    <ul id="coupon_list" class="coupon-list" onclick="coupon_hide()"  style=" overflow:auto;display:none;height:50%;width:100%;position: fixed; left: 0px;top: 50%;z-index: 100;background-image:url(/static/home/images/zz.png);background-size:cover">
        <li  class="ahover" style="border-top: 0px solid #f2f2f2;">
                    <a href="javascript:">
                        
                        <span style="float: right;position: relative; margin-right:0.25rem;display: inline-block;    padding: 0 6px;    font-size: 12px;    text-align: center;
                        background-color: #FF5722;    color: #fff;    border-radius: 2px;">X</span>
                        
                    </a>
                </li>
            <li class="ahover" style="border-top: 0px solid #f2f2f2;">
                <?php if(is_array($iscoupon) || $iscoupon instanceof \think\Collection || $iscoupon instanceof \think\Paginator): $i = 0; $__LIST__ = $iscoupon;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if($vo['used']==0): ?>
                    <div class="couponBox">
                        <a href="javascript:set_coupon(<?php echo $vo['id']; ?>);">
                            <?php if($vo['islimit']==0): ?>
                            <h1><span class="currencyTitle">通用券</span><span class="coupon_name_<?php echo $vo['id']; ?>"><?php echo $vo['couponname']; ?></span></h1>
                                <div class="couponCondition">全场通用券，满<span class="enough"><?php echo $vo['enough']; ?></span>元可用</div>
                            <?php else: ?>
                                <h1><span class="destineTitle">指定券</span><span class="coupon_name_<?php echo $vo['id']; ?>"><?php echo $vo['couponname']; ?></span></h1>
                                <div class="couponCondition">指定商品，满<span class="enough"><?php echo $vo['enough']; ?></span>元可用</div>
                            <?php endif; ?>
                            <div class="couponTime"><?php echo date("Y.m.d",$vo['stime']); ?>-<?php if($vo['etime'] == 0)echo '长期有效';else echo date("Y.m.d",$vo['etime']); ?></div>
                            <div class="couponMoney <?php if($vo['islimit']==0): ?>currencyCP<?php else: ?>destineCP<?php endif; ?> ">
                                <?php if($vo['backtype']==0): ?>
                                    <p><i class="fa fa-rmb"></i><u><?php echo floatval($vo['deduct']) ?></u></p>
                                <?php else: ?>
                                    <p><u><?php echo floatval($vo['deduct']) ?></u>折</p>
                                <?php endif; ?>
                                <span>立即使用<i class="fa fa-angle-right"></i></span>
                            </div>
                        </a>
                    </div>
                    <?php endif; endforeach; endif; else: echo "" ;endif; ?>
            </li>
        </ul>
        <!---优惠券内容结束-->
    
    
    <!--购买按钮-->
    <div class="placeOD-btn">
        <input type="hidden" name='gid' value='<?php echo $details['id']; ?>'/>
        <input type="hidden" id="autograph" name='autograph'  value=""  />
        <a href="javascript:;" class="btn-buy">点击购买</a>
    </div>
    <!--购买按钮结束-->
    </form>
<!--签名开始-->        
<script src="/static/home/js/jquery1.10.2.js"></script>  
<script type="text/javascript" src="/static/home/js/flashcanvas.js"></script>  
<script src="/static/home/js/jSignature.min.js"></script>  
<script type="text/javascript">  
    $(function(){  
        //初始化插件  
        var dHeight = "300px";  
        var dWidth = document.body.scrollWidth ;   
  
        $("#signature").jSignature({height:dHeight,width:dWidth, signatureLine:false});//初始化调整手写屏大小  
  
    })  
  
    //输出签名图片  
    function jSignatureTest(){   
        var $sigdiv = $("#signature");  
//        $sigdiv.jSignature() // inits the jSignature widget.  
        // after some doodling...  
//        $sigdiv.jSignature("reset") // clears the canvas and rerenders the decor on it.  
        var datapair = $sigdiv.jSignature("getData", "svgbase64")   
        console.log(datapair);  
//          datapair = ["image/svg+xml;base64","PD94bWwgdmVyc2lvbj0iMS4wIi  
//          BlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9Im5vIj8+PCFET0NUWVBFIHN2Zy  
//          BQVUJMSUMgIi0vL1czQy8vRFREIFNWRyAxLjEvL0VOIiAiaHR0cDovL3d3dy53My  
//          5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkIj48c3ZnIHhtbG5zPS  
//          JodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgdmVyc2lvbj0iMS4xIiB3aWR0aD  
//          0iMzEiIGhlaWdodD0iMzQiPjxwYXRoIGZpbGw9Im5vbmUiIHN0cm9rZT0iIzAwMD  
//          AwMCIgc3Ryb2tlLXdpZHRoPSIyIiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm  
//          9rZS1saW5lam9pbj0icm91bmQiIGQ9Ik0gMSAxIGMgMC4xMiAwLjExIDUuMDEgMy  
//          43NiA3IDYgYyAzLjI1IDMuNjUgNS43MSA4LjM1IDkgMTIgYyAyLjY0IDIuOTMgNi  
//          4zNyA1LjE2IDkgOCBjIDEuNTggMS43IDQgNiA0IDYiLz48L3N2Zz4="]  
        var i = new Image();  
        i.src = "data:" + datapair[0] + "," + datapair[1]   
       
        // 假设一个dataURL

        var file = dataURLtoBlob(i.src);
        // new a formData

        const formData = new FormData();
        formData.append('file', file);
        formData.append('name', '1.svg');
        $.ajax({
                    type: 'POST',
                    url: '/server/fileupload.php',
                    data:formData,
                    processData: false, // 不会将 data 参数序列化字符串
                    contentType: false, // 根据表单 input 提交的数据使用其默认的 contentType
                    dataType:'json',
                    success: function(res){
                        if(res.result){
                            $('#autograph').val(res.result);   
                            //签名成功
                            $('#autograph_div').hide();   
                            layer.msg('签名成功');
                            $(".btnAgree").removeClass("fa-circle-o").addClass("fa-check-circle").css("color", "#5fbd78");
                            $(".btn-buy").css("background", "#5fbd78").prop('href', "javascript:document.getElementById('searchForm').submit();");
                            $(".btnAgree").attr("numb", "1");   
                            //如果上次成功的话替换头像
//                            $.ajax({
//                                type: 'POST',
//                                url: '<?php echo url("/index/shop/autograph"); ?>',
//                                data:{
//                                    autograph:'/server/'+res.result,
//                                },
//                                dataType:'json',
//                                success: function(data){
//                                    if(data.type==1){
//                                        
//                                    }else if(data.type==2){
//                                        //未登录状态
//                                        layer.msg(data.msg);
//                                        
//                                    }else{
//                                        //签名失败
//                                        layer.msg(data.msg);
//                                    }
//                                },
//                                error: function(xhr){
//                                    
//                                }
//                            });
                        }else{
                            
                        }
                    },
                    error: function(xhr){
                        layer.msg('error');
                    }
                });
        $(i).appendTo($("#image")) // append the image (SVG) to DOM.  
    }  
  
    function reset(){  
        var $sigdiv = $("#signature");  
        $sigdiv.jSignature("reset");  
        $("#image img").remove();  
    }  
</script>  
<div id="autograph_div" style=" overflow:auto;display:none;height:70%;width:100%;position: fixed; left: 0px;top: 30%;z-index: 100;background-color:#fff;background-size:cover">
<div id="signature" style="background-color: #fff;width: 97%;height: 300px;border: 1px solid #ccc;"></div>  
<button type="button" style="    width: 1.5rem;
    margin: 0 auto;
    padding: .1rem 0;
    text-align: center;
    background: #5fbd78;
    color: #fff;
    font-size: .25rem;
    border-radius: .1rem;"  onclick="jSignatureTest()">生成签名</button>  
<button type="button" style="    width: 1.5rem;
    margin: 0 auto;
    padding: .1rem 0;
    text-align: center;
    background: #5fbd78;
    color: #fff;
    font-size: .25rem;
    border-radius: .1rem;" onclick="reset()">清除签名</button>  
</div>
<!--签名开始-->      

    <script type="text/javascript">

        $(function () {
            $(".placeOD-protocol").on("click", function () {
                var agree = $(".btnAgree").attr("numb");
                if (agree == 0) {
                    $('#autograph_div').show();
                    //这段代码写到签名完成里面
//                    $(".btnAgree").removeClass("fa-circle-o").addClass("fa-check-circle").css("color", "#5fbd78");
//                    $(".btn-buy").css("background", "#5fbd78").prop('href', "javascript:document.getElementById('searchForm').submit();");
//                    $(".btnAgree").attr("numb", "1");
                } else {
                    $(".btnAgree").removeClass("fa-check-circle").addClass("fa-circle-o").css("color", "#999999");
                    $(".btn-buy").css("background", "#999999").prop('href', '#');
                    $(".btnAgree").attr("numb", "0");
                }

            });
        });
    </script>
<script>
        function setnum(id){
            var price=$('.price').html();
            var num =$('.numb').val();
            if(id==1){
                var nums=parseInt(num)-1;
                if(nums<=0){nums=1};
                var prices=nums*price;
                $('.numb').val(nums);
                $('.prices').html(prices.toFixed(2));
            }else{
                var nums=parseInt(num)+1;
                if(nums<=0){nums=1};
                var prices=nums*price;
                $('.numb').val(nums);
                $('.prices').html(prices.toFixed(2));
            }
        }
    </script>
    <script>
        function choice_coupon(){
            $('#coupon_list').show();
        }
        function coupon_hide(){
            $('#coupon_list').hide();
        }
        function set_coupon(cdid){
            var prices = $(".prices").text();
            $.ajax({
                type: 'post',
                url: "<?php echo url('index/shop/coupon_enough'); ?>"+"&id="+cdid+"&prices="+prices,
                data:{id:cdid,prices:prices},
                processData: false, // 不会将 data 参数序列化字符串
                contentType: false, // 根据表单 input 提交的数据使用其默认的 contentType
                dataType:'json',
                async:false,
                success: function(res){
                    if(res.type == 0){
                        layer.msg('优惠要求不满足');
                        $('#coupon').val('');
                        $('#coupon_name').html('');
                    }else{
                        $('#coupon').val(cdid);
                        $('#coupon_name').html($('.coupon_name_'+cdid).html());
                    }
                }
            })
        }
        function dataURLtoBlob(dataURL) {
            var arr = dataURL.split(','), mime = arr[0].match(/:(.*?);/)[1],
                bstr = atob(arr[1]), n = bstr.length, u8arr = new Uint8Array(n);
            while (n--) {
                u8arr[n] = bstr.charCodeAt(n);
            }
            return new Blob([u8arr], {type: mime});
        }

    </script>

</body>
</html>
