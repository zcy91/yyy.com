<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:81:"/home/wwwroot/yang.oioos.com/public/../application/index/view/user/soldsheep.html";i:1527225396;s:73:"/home/wwwroot/yang.oioos.com/public/../application/index/view/header.html";i:1526866272;}*/ ?>
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
</style>
    <!--公共头部-->
    <div class="m-head">
        <a href="javascript:;" onclick="javascript:window.history.back();return false;" class="head-goback">
            <i class="fa fa-angle-left"></i>
        </a>
        <p>出售羔羊</p>
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
                    <option value="1">兑换产品</option>
                    <option value="2">兑换收益</option>
                    <option value="3">兑换旅游</option>
                </select>
                <i class="fa fa-caret-down"></i>
            </div>
           
            <div class="money-tips">
                <p class="tipsBox tips-product">兑换说明：兑换产品 ——<a href="<?php echo url('/index/discovery/content',array('id'=>15)); ?>">查看详情</a></p>
                <p class="tipsBox tips-sold">兑换说明：兑换收益 ——<a href="<?php echo url('/index/discovery/content',array('id'=>17)); ?>">查看详情</a></p>
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
    <input name="id" id="id" value="<?php echo $id; ?>" type="hidden">
<script>
    $(function(){
    var mntips = $("#exchange").val();
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
                            var html = ' <li><p>姓名：</p><input type="text" name="realname"  id="realname" placeholder="请填姓名，与身份证上一致" class="saveHistory"/></li>\n' +
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
                var html = ' <li><p>姓名：</p><input type="text" name="realname"  id="realname" placeholder="请填姓名，与身份证上一致" class="saveHistory"/></li>\n' +
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
                var exchange = $('#exchange').val();
                var id =$("#id").val();
                var tourtype = $("#tourtype").val();
                var tourlist = $("#tourlist").val();
                var realname = $("#realname").val();
                var cartid = $("#cartid").val();
                var mobile = $("#mobile").val();
                var realname1 =$("#realname1").val();
                var cartid1 = $("#cartid1").val();
                var realname0 =$("#realname0").val();
                var cartid0 = $("#cartid0").val();
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
                $.ajax({
                    type: 'POST',
                    url: '<?php echo url("/index/user/selllamb"); ?>',
                    data:{
                        buyid:0,
                        exchange:exchange,
                        lambid:<?php echo $mylamb['id']; ?>,
                        lambmoney:0,
                        id:id,
                        tourtype:tourtype,
                        tourlist:tourlist,
                        realname:realname,
                        cartid:cartid,
                        realname1:realname1,
                        cartid1:cartid1,
                        realname0:realname0,
                        cartid0:cartid0,
                        mobile:mobile

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
        
    </script>
</body>
</html>
