<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:74:"D:\wamp64\www\yyy.com\public/../application/back\view\goods\selllvyou.html";i:1532921427;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>编辑订单</title>
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

    <!--百度编辑器-->
    <link href="/server/umeditor/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
    <script type="text/javascript" src="/server/umeditor/third-party/jquery.min.js"></script>
    <script type="text/javascript" src="/server/umeditor/third-party/template.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="/server/umeditor/umeditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/server/umeditor/umeditor.min.js"></script>
    <script type="text/javascript" src="/server/umeditor/lang/zh-cn/zh-cn.js"></script>
    <style type="text/css">
        h1{
            font-family: "微软雅黑";
            font-weight: normal;
        }
        .btn {
            display: inline-block;
            *display: inline;
            padding: 4px 12px;
            margin-bottom: 0;
            *margin-left: .3em;
            font-size: 14px;
            line-height: 20px;
            color: #333333;
            text-align: center;
            text-shadow: 0 1px 1px rgba(255, 255, 255, 0.75);
            vertical-align: middle;
            cursor: pointer;
            background-color: #f5f5f5;
            *background-color: #e6e6e6;
            background-image: -moz-linear-gradient(top, #ffffff, #e6e6e6);
            background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#ffffff), to(#e6e6e6));
            background-image: -webkit-linear-gradient(top, #ffffff, #e6e6e6);
            background-image: -o-linear-gradient(top, #ffffff, #e6e6e6);
            background-image: linear-gradient(to bottom, #ffffff, #e6e6e6);
            background-repeat: repeat-x;
            border: 1px solid #cccccc;
            *border: 0;
            border-color: #e6e6e6 #e6e6e6 #bfbfbf;
            border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
            border-bottom-color: #b3b3b3;
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            border-radius: 4px;
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffffff', endColorstr='#ffe6e6e6', GradientType=0);
            filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
            *zoom: 1;
            -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
            -moz-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .btn:hover,
        .btn:focus,
        .btn:active,
        .btn.active,
        .btn.disabled,
        .btn[disabled] {
            color: #333333;
            background-color: #e6e6e6;
            *background-color: #d9d9d9;
        }

        .btn:active,
        .btn.active {
            background-color: #cccccc \9;
        }

        .btn:first-child {
            *margin-left: 0;
        }

        .btn:hover,
        .btn:focus {
            color: #333333;
            text-decoration: none;
            background-position: 0 -15px;
            -webkit-transition: background-position 0.1s linear;
            -moz-transition: background-position 0.1s linear;
            -o-transition: background-position 0.1s linear;
            transition: background-position 0.1s linear;
        }

        .btn:focus {
            outline: thin dotted #333;
            outline: 5px auto -webkit-focus-ring-color;
            outline-offset: -2px;
        }

        .btn.active,
        .btn:active {
            background-image: none;
            outline: 0;
            -webkit-box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.15), 0 1px 2px rgba(0, 0, 0, 0.05);
            -moz-box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.15), 0 1px 2px rgba(0, 0, 0, 0.05);
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.15), 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .btn.disabled,
        .btn[disabled] {
            cursor: default;
            background-image: none;
            opacity: 0.65;
            filter: alpha(opacity=65);
            -webkit-box-shadow: none;
            -moz-box-shadow: none;
            box-shadow: none;
        }
        .layui-table td, .layui-table th{
            padding: 0;
        }

    </style>

    <!--百度编辑器-->
</head>
<body>
<section class="layui-larry-box">
    <div class="larry-personal">
        <header class="larry-personal-tit">
            <span>兑换产品</span>
        </header><!-- /header -->
        <div class="larry-personal-body clearfix">
            <form class="layui-form col-lg-5" style="width: 1300px" method="post" onsubmit="return checkAll()">
                <div class="layui-form-item">
                    <label class="layui-form-label">信息核对</label>
                    <table class="layui-table" style="text-align: center;display: block;margin-left: 160px">
                        <colgroup>

                            <col width="100">
                            <col width="50">
                            <col width="50">
                            <col width="100">
                            <col width="100">
                            <col width="200">
                        </colgroup>
                        <thead>
                        <tr>

                            <th style="text-align:center;height: 40px;line-height: 40px">订单号</th>
                            <th style="text-align: center" width="200px">羊羔 ID</th>
                            <th style="text-align: center" width="100px">购买用户</th>
                            <th style="text-align: center" width="100px">用户手机</th>
                            <th style="text-align: center" width="300px">寄送地址</th>
                            <th style="text-align: center"  width="200px">下单时间</th>
                        </tr>
                        </thead>
                        <tbody class="news_content">
                        <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <tr>
                            <td align="left"><?php echo $vo['sellsn']; ?></td>
                            <td><?php echo $vo['lambid']; ?></td>
                            <td>ID:<?php echo $vo['uid']; ?>&nbsp&nbsp姓名:<?php echo $vo['address']['name']; ?></td>
                            <td><?php echo $vo['address']['phone']; ?></td>
                            <td><?php echo $vo['address']['province']; ?>-<?php echo $vo['address']['city']; ?>-<?php echo $vo['address']['area']; ?>-<?php echo $vo['address']['detailed']; ?></td>
                            <td><?php echo date("Y-m-d H:i",$vo['creationtime']); ?></td>
                        </tr>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                        </tbody>
                    </table>


                </div>

                <div class="layui-form-item  ">
                    <label class="layui-form-label" style="display: inline">配送方式</label>
                    <div class="layui-input-block">
                        <input type="text" name="shipping_type"  style="width: 200px;display: inline" placeholder="例如：顺丰物流"  autocomplete="off" class="layui-input" value="<?php if(!empty($list[0]['shipping_type'])): ?><?php echo $list[0]['shipping_type']; endif; ?>">
                        <label class="layui-form-label" style="display: inline;float: none">物流单号</label>
                        <input type="text" id="shipping_no" style="width: 300px;display: inline" name="shipping_no" placeholder="请输入物流单号" autocomplete="off" class="layui-input" value="<?php if(!empty($list[0]['shipping_no'])): ?><?php echo $list[0]['shipping_no']; endif; ?>">
                        <input type="hidden" name="sellsn" value="<?php echo $list[0]['sellsn']; ?>">
                        <label class="layui-form-label" style="display: inline;float: none">发货时间</label>
                        <?php echo date("Y-m-d H:i",$list[0]['shipping_time']); ?>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button type="submit" class="layui-btn" >确认编辑</button>
                        <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                        <a class="layui-btn layui-btn-primary" style="float: right" onclick="comfir()">确认收货</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<script  type="text/javascript" src="/static/common/layui/layui.js"></script>
<script type="text/javascript" src="/static/js/jquery.min.js"></script>

<script type="text/javascript">
function comfir() {
    $.ajax({
        type: 'POST',
        url: '/back/goods/comfir',
        data:{
            id:<?php echo $id; ?>
        },
        dataType:'json',
        success: function(data){
            alert(data.msg);
        }
    })
}
    function checkAll() {
        if($("#shipping_no").val() ==''){
            alert('请填写物流单号');
            return false;
        }else {
            return true;
        }
    }
</script>
</body>
</html>