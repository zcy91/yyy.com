<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:76:"E:\phpStudy\WWW\yyy.com\public/../application/index\view\user\sheepgive.html";i:1525318696;s:68:"E:\phpStudy\WWW\yyy.com\public/../application/index\view\header.html";i:1528532196;}*/ ?>
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
        <p>赠送羔羊</p>
    </div>
    <!--公共头部结束-->
    <!--内容主体-->
    <div class="m-soldsheep">
        <!--羊照片-->
        <div class="soldsheep-photo">
            <div class="photoBox">
                <div class="photoBox-int">
                    <img src="/static/home/images/sheep.jpg" />
                </div>
            </div>
            <div class="photoTips"  <?php if($islamb==true): ?>style=''<?php else: ?> style='background: #808080;'<?php endif; ?>><?php if($islamb==true): ?>已成熟<?php else: ?>未成熟<?php endif; ?></div>
        </div>
        <!--羊照片结束-->
        <!--羊卖价-->
        <div class="soldsheep-money">
            <!--<h1>黑眼羊羊飞天号</h1>
                <input type="text" placeholder="请填写您的意向价格" class="money-numb" />
                <h2>兑换方式</h2>
                <ul class="money-info">
                <li>
                    <label>
                        <span>卖给公司</span>
                        <input type="radio" name="buysheep" checked="checked" />
                    </label>
                </li>
            </ul>-->
            <div class="money-list">
                <select name="member_type" id="member_type" style="padding: .1rem">
                    <option value="3">根据用户手机号查找</option>
                    <option value="1">根据用户ID查找</option>
                    <option value="2">根据用户邀请码查找</option>

                </select>
                <i class="fa fa-caret-down"></i>
            </div>
           
            <div class="money-tips" style="border: 1px solid #e1e1e1;">
                <input type="text" id="member_val" name="member_val" value="" placeholder="请输入用户信息" style="font-size: .25rem;padding: .1rem">
            </div>
            <div class="money-tips" style="border: 1px solid #e1e1e1;margin-top: .2rem">
                <input type="password"  name="paypwd" id="paypwd" placeholder="请输入支付密码" style="font-size: .25rem;padding: 0.1rem">
            </div>
        </div>
        <!--羊卖价结束-->
    <div class="placeOD-protocol">
        <label>
            <i class="fa fa-circle-o btnAgree" numb="0"></i>同意并签名<a href="<?php echo url('/index/shop/protocol1'); ?>">《赠送协议》</a>
        </label>
    </div>
    <input type="hidden" id="autograph" name='autograph'  value=""  />
        <!--提交按钮-->
        <div class="soldsheep-btn">
            <a href="javascript:getMember();">提交</a>
            <!--<p>未成熟，暂不能出售</p>-->
        </div>
        <!--提交按钮结束-->
    </div>
    <!--内容主体结束-->
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
        function dataURLtoBlob(dataURL) {
            var arr = dataURL.split(','), mime = arr[0].match(/:(.*?);/)[1],
                bstr = atob(arr[1]), n = bstr.length, u8arr = new Uint8Array(n);
            while (n--) {
                u8arr[n] = bstr.charCodeAt(n);
            }
            return new Blob([u8arr], {type: mime});
        }
    </script>
<script>
        function getMember() {
                var member_type = $('#member_type').val();
                var member_val = $('#member_val').val();
                var paypwd = $("#paypwd").val();
                var numb =  $(".btnAgree").attr("numb");
                if(member_val==''){
                      layer.msg('用户信息不能为空');
                      return false;
                }
                if(numb != 1){
                    layer.msg('请签名');
                    return false;
                }
                //先查找用户信息
                $.ajax({
                    type: 'POST',
                    url: '<?php echo url("/index/user/getmember"); ?>',
                    data:{
                        member_type:member_type,
                        member_val:member_val,
                        paypwd:paypwd
                    },
                    dataType:'json',
                    success: function(data){
                        if(data.type==1){
                            
                                //示范一个公告层
                                layer.open({
                                  type: 1
                                  ,title: false //不显示标题栏
                                  ,closeBtn: false
                                  ,area: '5.5rem;'
                                  ,shade: 0.8
                                  ,id: 'LAY_layuipro' //设定一个id，防止重复弹出
                                  ,btn: ['确认', '取消']
                                  ,btnAlign: 'c'
                                  ,moveType: 1 //拖拽模式，0或者1
                                  ,content: '<div style="padding: 50px; line-height: 22px; background-color: #393D49; color: #fff; font-weight: 300;">确定要赠送给好友吗？亲！<br><br>用户id:'+data.data.id+'<br>用户昵称:'+data.data.username+'<br>用户手机:'+data.data.mobile+'<br></div>'
                                  ,success: function(layero){
                                    var btn = layero.find('.layui-layer-btn');
                                    btn.find('.layui-layer-btn0').attr({
                                      href: 'JavaScript:giveLamb('+data.data.id+')'
                                      
                                    });
                                  }
                                });
                              
                        }else{
                            layer.msg(data.data);
                        }
                    },
                    error: function(xhr){
                        layer.msg('error');
                    }
                
                
            });
        }

        function giveLamb (id){
            $.ajax({
                    type: 'POST',
                    url: '<?php echo url("/index/user/selllamb"); ?>',
                    data:{
                        buyid:id,
                        exchange:4,
                        lambid:<?php echo $mylamb['id']; ?>,
                        lambmoney:0,
                        autograph:$('#autograph').val()
                    },
                    dataType:'json',
                    success: function(data){
                        if(data.type==1){
                            layer.msg(data.msg,function(){
                            //关闭后的操作
                            window.location.href='<?php echo url("/index/user/user"); ?>'
                            });
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
