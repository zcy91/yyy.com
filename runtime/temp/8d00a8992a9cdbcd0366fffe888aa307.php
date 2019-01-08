<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:77:"D:\wamp64\www\yyy.com\public/../application/back\view\user\exchangelvyou.html";i:1536896804;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>兑换旅游</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" type="text/css" href="/static/common/layui/css/layui.css" media="all">
    <link rel="stylesheet" type="text/css" href="/static/common/bootstrap/css/bootstrap.css" media="all">
    <link rel="stylesheet" type="text/css" href="/static/common/global.css" media="all">
    <link rel="stylesheet" type="text/css" href="/static/css/personal.css" media="all">
    <script type="text/javascript" src="/static/js/jquery.min.js"></script>
    <script type="text/javascript" src="/static/js/layer.js"></script>
    <script type="text/javascript" src="/static/common/layui/layui.js"></script>
    <script type="text/javascript" src="/static/common/layui/lay/modules/layer.js"></script>

    <script type="text/javascript" src="/static/js/jquery.cookie.js"></script>
    <!--<script type="text/javascript" src="/static/common/layui/layui.js"></script>-->
    <!--<script type="text/javascript" src="/static/js/jquery.min.js"></script>-->
    <!--<script type="text/javascript" src="/static/js/newslist.js"></script>-->
</head>
<style>
    .layui-form input[type="checkbox"], .layui-form input[type="radio"], .layui-form select {
        display: inline-block;
    }
    .shortselect{
        background:#fafdfe;
        height:28px;
        width:180px;
        line-height:28px;
        border:1px solid #9bc0dd;
        -moz-border-radius:2px;
        -webkit-border-radius:2px;
        border-radius:2px;
    }

</style>
<body style="position:relative;">
<section class="layui-larry-box">
    <div class="larry-personal">
        <header class="larry-personal-tit">
            <span>兑换旅游</span>
        </header><!-- /header -->
        <div class="larry-personal-body clearfix">
            <form class="layui-form col-lg-5">
                <div class="layui-form-item">
                    <label class="layui-form-label">请选择线路</label>
                    <div class="layui-input-block">
                        <select name="tourtype" id="tourtype" onchange="gradeChange()" lay-filter="aihao" class="layui-input">
                            <option value="0"  class="layui-input">请选择线路</option>
                            <?php if(is_array($tourtype) || $tourtype instanceof \think\Collection || $tourtype instanceof \think\Paginator): $i = 0; $__LIST__ = $tourtype;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <option value="<?php echo $vo['id']; ?>"  class="layui-input"><?php echo $vo['name']; ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">请选择行程</label>
                        <div class="layui-input-block">
                            <select name="tourlist" id="tourlist"  class="layui-input">
                                <option value="0"  class="layui-input">请选择行程</option>
                            </select>
                            <div id="connent" style="display: inline;font-size: 0.24rem" ></div>
                            <ul class="addaddress-user" id="addaddress-user">
                            </ul>
                        </div>
                    </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button type="button" class="layui-btn" lay-submit="" onclick="exchange_add()" lay-filter="demo1">立即提交</button>
                        <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

</body>
<script type="text/javascript" src="/static/common/layui/layui.js"></script>

<script>
    function gradeChange(){
        var objS = document.getElementById("tourtype");
        var grade = objS.options[objS.selectedIndex].value;
        $.cookie('id', grade);
        $.ajax({
            type: 'POST',
            url: '<?php echo url("/back/user/ajaxlvyou"); ?>',
            data:{
                id:grade,
            },
            async:false,
            success: function(data){
                if(data.type==1){
                    $("#connent").html("备注："+data.arr.remark);

                    var num = data.arr.num;
                    var html = ' <li><label>姓名：</label><input type="text" name="realname_da"  id="realname" placeholder="请填姓名，与身份证上一致" class="layui-input"/></li>\n' +
                        '         <li><label>身份证：</label><input type="text" name=\'cardid\' id="cartid" placeholder="请填身份证号，购买保险用" class="layui-input"/></li>'+
                        '<li><label>手机号：</label><input type="text" name=\'mobile\' id="mobile" placeholder="请填写手机号码" class="layui-input"/></li>';

                    for(var y = 0; y < num; y++) {
                        var name = "realname"+y;
                        var cardid = "cartid"+y;
                        var nameid = "realname"+y;
                        html += "<li><label>儿童姓名：</label><input type=\"text\" name="+name+" id="+nameid+" placeholder=\"请填姓名，与身份证一致\" class=\"layui-input\"/></li>\n"  +
                            "  <li><label>身份证：</label><input type=\"text\" name="+cardid+" id="+cardid+" placeholder=\"身份证号，如没有可填出生证明编号\" autocomplete=\"off\" class=\"layui-input\"/></li>";
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
    function exchange_add() {
        var exchange = 3;
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
        var uid = <?php echo $uid; ?>;

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
                    url: '<?php echo url("/back/user/selllamb"); ?>',
                    data:{
                        buyid:0,
                        exchange:exchange,
                        lambid:<?php echo $mylamb['id']; ?>,
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
                    address_id : address_id,
                    uid:uid
                },
                async:false,

            success: function(data){
            if(data.type==1){
                layer.msg(data.msg,function(){
                    //关闭后的操作
//                    window.location.href='<?php echo url("/index/user/user"); ?>'
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