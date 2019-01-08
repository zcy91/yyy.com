<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:77:"D:\wamp64\www\yyy.com\public/../application/index\view\user\protocollist.html";i:1534221431;s:66:"D:\wamp64\www\yyy.com\public/../application/index\view\header.html";i:1534577442;}*/ ?>
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
    <script src="/static/pingpp-js/dist/pingpp.js"></script>
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
   .myorder-class li{
        width: 33.33%;
    }
</style>
<body style="position:relative;">

    <!--公共头部-->
    <div class="m-head">
        <a href="javascript:;" onclick="javascript:window.history.back();return false;" class="head-goback">
            <i class="fa fa-angle-left"></i>
        </a>
        <p>我的合同</p>
    </div>
    <!--公共头部结束-->
    <div class="m-myorder">
    <ul class="myorder-class">
        <li class="ahover">
            <a href="javascript:;"  onclick="getMyorder(1)">购买合同</a>
        </li>
        <li>
            <a href="javascript:;"  onclick="getMyorder(2)">转让合同</a>
        </li>
        <li>
            <a href="javascript:;"  onclick="getMyorder(3)">待签合同</a>
        </li>
    </ul>
    </div>
    <!--内容主体-->
    <div class="m-protocollist">
        <ul id="order">
            
            <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <li>
                <a href="<?php echo url('/index/user/protocoldetail',array('oid'=>$vo['id'])); ?>"><p><?php echo $vo['gname']; ?>购买认购合同</p><span><?php echo date("Y-m-d H:i",$vo['paytime']); ?></span></a>
            </li>
            <?php endforeach; endif; else: echo "" ;endif; if(empty($list)): ?>
            <li>
                <a href="javascript:"><p>您还没有认领专属于您的食花百草羊，暂无合同生成</p><span></span></a>
            </li>
            <?php endif; ?>
        </ul>
        <ul id="zengsong">

            <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
            <li>
                <a href="<?php echo url('/index/user/protocoldetail1',array('id'=>$v['id'])); ?>"><p style="width: 50%;overflow: hidden;white-space: nowrap;text-overflow: ellipsis"><?php echo $v['lambname']; ?>转让合同</p><span><?php echo date("Y-m-d H:i",$v['creationtime']); ?></span></a>
            </li>
            <?php endforeach; endif; else: echo "" ;endif; if(empty($data)): ?>
            <li>
                <a href="javascript:"><p>您还没有转让专属于您的食花百草羊，暂无合同生成</p><span></span></a>
            </li>
            <?php endif; ?>
        </ul>
        <ul id="daiqian">

            <?php if(is_array($arr) || $arr instanceof \think\Collection || $arr instanceof \think\Paginator): $i = 0; $__LIST__ = $arr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v1): $mod = ($i % 2 );++$i;?>
            <li class="<?php echo $v1['id']; ?>" style="padding: .2rem">
                <a style="display: inline" href="<?php echo url('/index/user/protocoldetail1',array('id'=>$v1['id'])); ?>"><p style="width: 50%;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;display: inline"><?php echo $v1['lambname']; ?>转让认购合同</p></a>
                <div class="placeOD-protocol" style="display: inline">
                    <label style="width: 35%">
                     <i class="fa fa-circle-o " numb="0" id="<?php echo $v1['id']; ?>" onclick="qianming(<?php echo $v1['id']; ?>)"></i>同意并签名
                    </label>
                </div>
                <input type="hidden" id="autograph<?php echo $v1['id']; ?>" name='autograph'  value=""  />
                <div id="autograph_div<?php echo $v1['id']; ?>" style=" overflow:auto;display:none;height:70%;width:100%;position: fixed; left: 0px;top: 30%;z-index: 100;background-color:#fff;background-size:cover">
                    <div id="signature" class="signature" style="background-color: #fff;width: 97%;height: 300px;border: 1px solid #ccc;"></div>
                    <button type="button" style="    width: 1.5rem;
    margin: 0 auto;
    padding: .1rem 0;
    text-align: center;
    background: #5fbd78;
    color: #fff;
    font-size: .25rem;
    border-radius: .1rem;"  onclick="jSignatureTest(<?php echo $v1['id']; ?>)">生成签名</button>
                    <button type="button" style="    width: 1.5rem;
    margin: 0 auto;
    padding: .1rem 0;
    text-align: center;
    background: #5fbd78;
    color: #fff;
    font-size: .25rem;
    border-radius: .1rem;" onclick="reset()">清除签名</button>
                </div>
            </li>

            <?php endforeach; endif; else: echo "" ;endif; if(empty($arr)): ?>
            <li>
                <a href="javascript:"><p style="text-align: center;float: unset">您还没有待签的合同</p><span></span></a>
            </li>
            <?php endif; ?>
        </ul>
    </div>
    <!--内容主体结束-->
    <script>
        $(function(){
            $("#order").show();
            $("#zengsong").hide();
            $("#daiqian").hide();
        })
        function getMyorder(id) {
            if(id == 1){
                $("#order").show();
                $("#zengsong").hide();
                $("#daiqian").hide();
            }else if(id == 2){
                $("#order").hide();
                $("#zengsong").show();
                $("#daiqian").hide();
            }else{
                $("#zengsong").hide();
                $("#order").hide();
                $("#daiqian").show();
            }
        }
    </script>
    <script type="text/javascript" src="/static/home/js/flashcanvas.js"></script>
    <script src="/static/home/js/jSignature.min.js"></script>
    <script type="text/javascript">
        $(function(){
            //初始化插件
            var dHeight = "300px";
            var dWidth = document.body.scrollWidth ;

            $(".signature").jSignature({height:dHeight,width:dWidth, signatureLine:false});//初始化调整手写屏大小

        })

        //输出签名图片
        function jSignatureTest(id){

            var $sigdiv = $(".signature");
//        $sigdiv.jSignature() // inits the jSignature widget.
            // after some doodling...
//        $sigdiv.jSignature("reset") // clears the canvas and rerenders the decor on it.
            var datapair = $sigdiv.jSignature("getData", "svgbase64")
            //console.log(datapair);
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
                        $('#autograph'+id).val(res.result);
                        //签名成功
                        $('#autograph_div'+id).hide();
                        layer.msg('签名成功');
                        $.ajax({
                            type: 'POST',
                            url:"<?php echo url('index/user/sell_lamb_zengsong'); ?>",
                            data:{id:id, toautograph:$('#autograph'+id).val()},

                            success:function (data) {
                                if(data.type == 1){
                                    layer.msg(data.msg);
                                    $("."+id).remove()
                                }else{
                                    layer.msg(data.msg);
                                }
                            }
                        })
                        $("#"+id).removeClass("fa-circle-o").addClass("fa-check-circle").css("color", "#5fbd78");
                        $(".btn-buy").css("background", "#5fbd78").prop('href', "javascript:document.getElementById('searchForm').submit();");
                        $("#"+id).attr("numb", "1");
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
            var $sigdiv = $(".signature");
            $sigdiv.jSignature("reset");
            $("#image img").remove();
        }
    </script>

    <!--签名开始-->

    <script type="text/javascript">


             function qianming(id) {
                 var id = id;
                 var agree = $("#"+id).attr("numb");
                 if (agree == 0) {
                     $('#autograph_div'+id).show();
                     //这段代码写到签名完成里面
//                    $(".btnAgree").removeClass("fa-circle-o").addClass("fa-check-circle").css("color", "#5fbd78");
//                    $(".btn-buy").css("background", "#5fbd78").prop('href', "javascript:document.getElementById('searchForm').submit();");
//                    $(".btnAgree").attr("numb", "1");
                 } else {
                     $("#id").removeClass("fa-check-circle").addClass("fa-circle-o").css("color", "#999999");
                     $(".btn-buy").css("background", "#999999").prop('href', '#');
                     $("#id").attr("numb", "0");
                 }
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
