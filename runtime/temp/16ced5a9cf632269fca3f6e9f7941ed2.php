<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:79:"D:\wamp64\www\yyy.com\public/../application/back\view\user\exchangeproduct.html";i:1536894602;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>兑换产品</title>
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
</head>
<style>
    .layui-form-checkbox, .layui-form-checkbox *, .layui-form-radio, .layui-form-radio *, .layui-form-switch{
        display: -webkit-box;
    }
</style>
<section class="layui-larry-box">
    <div class="larry-personal">
        <header class="larry-personal-tit">
            <span>兑换产品</span>
        </header><!-- /header -->
        <div class="larry-personal-body clearfix">
            <form class="layui-form" action="">
                <div class="layui-form-item">
                    <label class="layui-form-label">选择地址</label>
                    <div class="layui-input-block">
                        <input  type="radio" name="defaults" value="0" title="请选择">
                            <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                <input  type="radio" name="defaults" <?php if($vo['defaults']==1): ?>checked="checked"<?php endif; ?> value="<?php echo $vo['id']; ?>" title="<?php echo $vo['name']; ?>-<?php echo $vo['phone']; ?>-<?php echo $vo['province']; ?><?php echo $vo['city']; ?><?php echo $vo['area']; ?><?php echo $vo['detailed']; ?>">
                            <?php endforeach; endif; else: echo "" ;endif; ?>
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
<script type="text/javascript" src="/static/common/layui/layui.js"></script>
<script type="text/javascript" src="/static/js/newslist.js"></script>
<script>
    function exchange_add() {
        var exchange = 1;
        var id =$("#id").val();
        var tourtype = $("#tourtype").val();
        var tourlist = $("#tourlist").val();
        var address_id = $('input[name="defaults"]:checked ').val();
        var uid = <?php echo $uid; ?>;
        if(exchange == 1){
            if(address_id == 0){
                layer.msg('请选择收货地址');
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
                        exchange:exchange,
                        lambid:<?php echo $mylamb['id']; ?>,
                    lambmoney:0,
                    id:id,
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