<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:74:"D:\wamp64\www\yyy.com\public/../application/index\view\user\soldsheep.html";i:1536892974;s:66:"D:\wamp64\www\yyy.com\public/../application/index\view\header.html";i:1536904258;}*/ ?>
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


<META  NAME="save"  CONTENT="history">
</head>
<body style="position:relative;">
<style>
    .saveHistory  {behavior:url(#default#savehistory);}
    .addaddress-user li input[type="text"]{
        width: 4.2rem;
    }
    .addaddress-user li p{
        width: 1.3rem;
    }
    .addaddress-user li input[type="text"]{
        padding: .25rem 0 .17rem 0;
    }
    #connent p{
        display: inline;
    }
    .addaddress-user li{
        padding: 0;
    }
    .addaddress-user li p{
        padding: .15rem 0;
    }
    .address-footer{
        position: unset;
    }
</style>
    <!--公共头部-->
    <div class="m-head">
        <a href="javascript:;" onclick="javascript:window.history.go(-1);return false;" class="head-goback">
            <i class="fa fa-angle-left"></i>
        </a>
        <p><?php echo $webtitle; ?></p>
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
                <select name="exchange" id="exchange">
                    <option value="0">请选择兑换种类</option>
                    <option value="1">兑换产品</option>
                    <?php if($islamb==true): ?><option value="2">兑换收益</option><?php endif; ?>
                    <option value="3">兑换旅游</option>
                </select>
                <i class="fa fa-caret-down"></i>
            </div>
           
            <div class="money-tips">
                <p class="tipsBox tips-xuanze">
                    请选择兑换类型
                </p>
                <p class="tipsBox tips-product">兑换说明：兑换产品 ——
                    <a href="<?php echo url('/index/discovery/content',array('id'=>15)); ?>">
                        查看详情
                    </a>
                    <div class="m-address tips-product">
                        <ul>
                            <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                <li id='li_<?php echo $vo['id']; ?>'>
                                    <input style="display:inline;float: left;margin: 0.35rem 0.25rem 0.35rem 0.05rem;" type="radio" name="defaults" <?php if($vo['defaults']==1): ?>checked="checked"<?php endif; ?> value="<?php echo $vo['id']; ?>" >
                                    <div style=" width: 80%;display:inline-block">
                                        <div onclick="javascript:window.location.href='<?php echo url('index/user/addaddress1',array('id'=>$vo['id'],'sheep_id'=>$id)); ?>'" class="address-name">
                                            <p><?php echo $vo['name']; ?></p>
                                            <span><?php echo $vo['phone']; ?></span>
                                        </div>
                                        <div class="address-detail">
                                            <i class="fa fa-map-marker"></i><span><?php echo $vo['province']; ?><?php echo $vo['city']; ?><?php echo $vo['area']; ?><?php echo $vo['detailed']; ?></span>
                                        </div>
                                    </div>
                                    <span style="display:inline;float: right;font-size: .25rem;color: #828282;" onclick='del_address(<?php echo $vo['id']; ?>)'>
                                        <i class="fa fa-window-close"></i>
                                    </span>
                                </li>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                    </div>

                    <a href="<?php echo url('/index/user/addaddress1'); ?>?sheep_id=<?php echo $id; ?>" class="address-footer tips-product"><i class="fa fa-plus-circle"></i>添加新地址</a>
                </p>
                <?php if($islamb==true): ?> <p class="tipsBox tips-sold">兑换说明：兑换收益 ——<a href="<?php echo url('/index/discovery/content',array('id'=>17)); ?>">查看详情</a></p><?php endif; ?>
                <p class="tipsBox tips-tourism">
                    兑换说明：兑换旅游 ——<a href="<?php echo url('/index/discovery/content',array('id'=>16)); ?>" id="detail">查看详情</a>
                    <div class="tipsBox tips-tourism">

                <select name="tourtype" id="tourtype" onchange="gradeChange()" style="    padding: .2rem 0;font-size:.25rem;height: 100%;width: 100%"  class="prov">
                    <option value="0">请选择线路</option>
                            <?php if(is_array($tourtype) || $tourtype instanceof \think\Collection || $tourtype instanceof \think\Paginator): $i = 0; $__LIST__ = $tourtype;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <option value="<?php echo $vo['id']; ?>"><?php echo $vo['name']; ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
               <select name="tourlist" id="tourlist"  style="    padding: .2rem 0;font-size:.25rem;height: 100%;width: 100%"  >
                <option value="0">请选择行程</option>
               </select>

                <div id="connent" style="display: inline;font-size: 0.24rem" ></div>
                <ul class="addaddress-user" id="addaddress-user">

                </ul>
                </p>
            </div>
        </div> </div>
        <!--羊卖价结束-->
        <!--提交按钮-->
        <div class="soldsheep-btn">
           <a href="javascript:sellLamb();">确认提交</a>

            <!--<p>未成熟，暂不能出售</p>-->
        </div>
        <!--提交按钮结束-->
    </div>
    <!--内容主体结束-->
    <input id="lambid" value="<?php if($mylamb['id'] != ''): ?><?php echo $mylamb['id']; else: ?> 0 <?php endif; ?>" type="hidden">
    <input name="id" id="id" value="<?php echo $id; ?>" type="hidden">
<script>
//    $(document).ready(function(e) {
//        var counter = 0;
//        if (window.history && window.history.pushState) {
//            $(window).on('popstate', function () {
//                window.history.pushState('forward', null, '#');
//                window.history.forward(1);
//
//                <!-- 此处为监听到浏览器后退按钮的后续事件  例：刷新前一个页面；或者刷新当前页面等-->
//                //window.location.href = window.location.reload();
//                var html= '';
//                $.ajax({
//                    type: 'POST',
//                    url: '<?php echo url("/index/user/getaddress"); ?>',
//                    data:{
//
//                    },
//                    success: function(data) {
//                        for (var i = 0, l = data.length; i < l; i++) {
//
//
////alert(data[i]['id']);alert(data[i]['name'])
////
//
//
//                        }
//                    }
//                });
//
//
//
//            });
//        }
//        window.history.pushState('forward', null, '#'); //在IE中必须得有这两行
//        window.history.forward(1);
//    });
    $(function(){
        var mntips = $("#exchange").val();
        <?php if(!empty($sheep_id)): ?>{
            var mntips = 1;
            $("#exchange").val("1");
        }
        <?php endif; ?>
    if(mntips == 0){
        $(".tips-product").hide();
        $(".tips-sold").hide();
        $(".tips-tourism").hide();
        $(".tips-xuanze").show();
    }
        $.cookie('mntips',mntips);

            if ($.cookie('mntips') ==1) {
                $(".tips-product").show();
                $(".tips-sold").hide();
                $(".tips-tourism").hide();
            }
            else if ($.cookie('mntips') == 2) {
                $(".tips-product").hide();
                $(".tips-sold").show();
                $(".tips-tourism").hide();
            }
            else if ($.cookie('mntips') == 3) {
                $(".tips-product").hide();
                $(".tips-sold").hide();
                $(".tips-tourism").show();
            };
        var objS = document.getElementById("tourtype");
        var grade = objS.options[objS.selectedIndex].value;
        if(grade == 0 || !grade){
            return false;
        }
        $.cookie('id',grade);
            if($.cookie('id')){
                var grade = $.cookie('id');
                $.ajax({
                    type: 'POST',
                    url: '<?php echo url("/index/user/ajaxlvyou"); ?>',
                    data:{
                        id:$.cookie('id'),
                    },
                    success: function(data){
                        if(data.type==1){
                            $("#connent").html("备注："+data.arr.remark);
                            var href = "<?php echo url('index/user/detail'); ?>"+'?id='+grade;
                            $("#detail").attr("href",href);
                            var num = data.arr.num;
                            var html = ' <li><p>姓名：</p><input type="text" name="realname_da"  id="realname" placeholder="请填姓名，与身份证上一致" class="saveHistory"/></li>\n' +
                                '         <li><p>身份证：</p><input type="text" name=\'cardid\' id="cartid" placeholder="请填身份证号，购买保险用" class="saveHistory"/></li>'+
                                '<li><p>手机号：</p><input type="text" name=\'mobile\' id="mobile" placeholder="请填写手机号码" class="saveHistory"/></li>'
                            ;
                            for(var y = 0; y < num; y++) {
                                var name = "realname"+y;
                                var cardid = "cartid"+y;
                                var nameid = "realname"+y;
                                html += "<li><p>儿童姓名：</p><input type=\"text\" name="+name+" id="+nameid+" placeholder=\"请填姓名，与身份证一致\" class=\"saveHistory\"/></li>\n"  +
                                    "  <li><p>身份证：</p><input type=\"text\" name="+cardid+" id="+cardid+" placeholder=\"身份证号，如没有可填出生证明编号\" class=\"saveHistory\"/></li>";
                            }
                            $("#addaddress-user").html(html);
                            var array=data.data;
                            var length = array.length;
                            var result = "<option value=\"0\">请选择行程</option>";
                            for(var i = 0; i < length; i++) {
                                result += "<option value='"+array[i]['num']+"'>"+'抵达：'+array[i]['arrive']+'&nbsp;返程：'+array[i]['back']+'&nbsp;剩余人数：'+array[i]['people']+"</option>";
                            }
                            $("#tourlist").html(result)



                        }else{
                            layer.msg(data.data);
                        }
                    },
                    error: function(xhr){
                        var html = ' <option value="0">请选择行程</option>';
                        $("#tourlist").html(html)

                    }
                });
            }
    })
        $(".money-list select").change(function () {
            var mntips = $(this).val();
            $.cookie('mntips', mntips);
        if ($.cookie('mntips') ==1) {
            layer.msg("美味的羊肉将会寄到您家中,食品类兑换后不可退单");
            $(".tips-product").show();
            $(".tips-sold").hide();
            $(".tips-xuanze").hide();
            $(".tips-tourism").hide();
        }
        else if ($.cookie('mntips') == 2) {
            $(".tips-product").hide();
            $(".tips-sold").show();
            $(".tips-xuanze").hide();
            $(".tips-tourism").hide();
        }
        else if ($.cookie('mntips') == 3) {
            layer.msg("幸福之旅已为您安排妥当，所有服务已就位，兑换旅游后不可退单还望理解")
            $(".tips-product").hide();
            $(".tips-sold").hide();
            $(".tips-xuanze").hide();
            $(".tips-tourism").show();
        }else{
            $(".tips-product").hide();
            $(".tips-sold").hide();
            $(".tips-tourism").hide();
            $(".tips-xuanze").show();
        }
    })
    function gradeChange(){
        var objS = document.getElementById("tourtype");
        var grade = objS.options[objS.selectedIndex].value;
        $.cookie('id', grade);
        $.ajax({
                type: 'POST',
                url: '<?php echo url("/index/user/ajaxlvyou"); ?>',
                data:{
                    id:grade,
            },
            async:false,
            success: function(data){
            if(data.type==1){
                $("#connent").html("备注："+data.arr.remark);
                var href = "<?php echo url('index/user/detail'); ?>"+'?id='+grade;
                $("#detail").attr("href",href);
                var num = data.arr.num;
                var html = ' <li><p>姓名：</p><input type="text" name="realname_da"  id="realname" placeholder="请填姓名，与身份证上一致" class="saveHistory"/></li>\n' +
                    '         <li><p>身份证：</p><input type="text" name=\'cardid\' id="cartid" placeholder="请填身份证号，购买保险用" class="saveHistory"/></li>'+
                '<li><p>手机号：</p><input type="text" name=\'mobile\' id="mobile" placeholder="请填写手机号码" class="saveHistory"/></li>';

                for(var y = 0; y < num; y++) {
                    var name = "realname"+y;
                    var cardid = "cartid"+y;
                    var nameid = "realname"+y;
                    html += "<li><p>儿童姓名：</p><input type=\"text\" name="+name+" id="+nameid+" placeholder=\"请填姓名，与身份证一致\" class=\"saveHistory\"/></li>\n"  +
                        "  <li><p>身份证：</p><input type=\"text\" name="+cardid+" id="+cardid+" placeholder=\"身份证号，如没有可填出生证明编号\" class=\"saveHistory\"/></li>";
                }
                $("#addaddress-user").html(html);
                var array=data.data;
                var length = array.length;
                    var result = "<option value=\"0\">请选择行程</option>";
                for(var index in array){
                    result = result+ "<option value='"+array[index]['num']+"'>"+'抵达：'+array[index]['arrive']+'&nbsp;返程：'+array[index]['back']+'&nbsp;剩余人数：'+array[index]['people']+"</option>";
                    }
                   $("#tourlist").html(result)



            }else{
                layer.msg(data.data);
            }
        },
        // error: function(xhr){
        //     var html = ' <option value="0">请选择行程</option>';
        //     $("#tourlist").html(html)
        //
        // }
    });
    }
        function sellLamb() {
                var exchange = $('#exchange option:selected').val();
                var id =$("#id").val();
                var tourtype = $("#tourtype").val();
                var tourlist = $("#tourlist").val();
                var realname_da = $("#realname").val();
                var cartid = $("#cartid").val();
                var mobile = $("#mobile").val();
                var realname1 =$("#realname1").val();
                var cartid1 = $("#cartid1").val();
                var realname0 =$("#realname0").val();
                var cartid0 = $("#cartid0").val();
                var address_id = $('input[name="defaults"]:checked ').val();
                var lambid = $("#lambid").val();
            if(lambid == 0){
                layer.msg('羊羔不存在，请重新选择');
                return false;
                }
                if(!exchange){
                    layer.msg('请选择兑换种类');
                    return false;
                }
                if(exchange == 1){
                    if(!address_id){
                        layer.msg('请选择收货地址');
                        return false;
                    }

                }

                if(exchange != 1){
                    var address_id = 0;
                }
                if(exchange == 3){
                    if(tourtype == 0){
                        layer.msg('请选择旅游线路');
                        return false;
                    }
                    if(tourlist == 0){
                        layer.msg('请选择旅游行程');
                        return false;
                    }
                }
            <?php if($mylamb['id'] == ''): ?>
                $mylamb['id'] = $_REQUEST['sheep_id'];
            <?php endif; ?>
                $.ajax({
                    type: 'POST',
                    url: '<?php echo url("/index/user/selllamb"); ?>',
                    data:{
                        buyid:0,
                        exchange:exchange,
                        lambid:lambid,
                        lambmoney:0,
                        id:id,
                        tourtype:tourtype,
                        tourlist:tourlist,
                        realname_da:realname_da,
                        cartid:cartid,
                        realname1:realname1,
                        cartid1:cartid1,
                        realname0:realname0,
                        cartid0:cartid0,
                        mobile:mobile,
                        address_id : address_id
                    },
                    async:false,

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
                resetCode(); //倒计时
            }

    function del_address(id){
        var msg = "您真的确定要删除吗？\n\n请确认！";
        if (confirm(msg)==true){
        }else{
            return false;
        }
        $.ajax({
            type: 'POST',
            url: '<?php echo url("/index/user/deladdress"); ?>',
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
