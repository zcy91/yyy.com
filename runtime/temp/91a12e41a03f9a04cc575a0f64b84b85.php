<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:79:"/home/wwwroot/yang.oioos.com/public/../application/index/view/user/address.html";i:1517538514;s:73:"/home/wwwroot/yang.oioos.com/public/../application/index/view/header.html";i:1526866272;}*/ ?>
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
</head>
<body style="position:relative;">

    <!--公共头部-->
    <div class="m-head">
        <a href="javascript:;" onclick="javascript:window.history.back();return false;" class="head-goback">
            <i class="fa fa-angle-left"></i>
        </a>
        <p>收货地址</p>
    </div>
    <!--公共头部结束-->
    <!--内容主体-->
    <div class="m-address">
       <ul>
           <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
           <li id='li_<?php echo $vo['id']; ?>'>
               <input style="display:inline;float: left;margin: 0.35rem 0.25rem 0.35rem 0.05rem;" type="radio" name="defaults" <?php if($vo['defaults']==1): ?>checked="checked"<?php endif; ?> onclick="setDefaults(<?php echo $vo['id']; ?>)" >
                <div style=" width: 80%;display:inline-block">
                    <div  onclick="javascript:window.location.href='<?php echo url('/index/user/addaddress',array('id'=>$vo['id'])); ?>'" class="address-name">
                        <p><?php echo $vo['name']; ?></p>
                        <span><?php echo $vo['phone']; ?></span>
                    </div>
                    <div class="address-detail">
                        <i class="fa fa-map-marker"></i><span><?php echo $vo['province']; ?><?php echo $vo['city']; ?><?php echo $vo['area']; ?><?php echo $vo['detailed']; ?></span>
                    </div>
               </div>
                <span style="display:inline;float: right;margin: 0.35rem 0.05rem 0.35rem 0.25rem;font-size: .25rem;color: #828282;" onclick='del_address(<?php echo $vo['id']; ?>)'>
                    <i class="fa fa-window-close"></i>
                </span>
           </li>
           <?php endforeach; endif; else: echo "" ;endif; ?>
       </ul>
    </div>
    <!--内容主体结束-->
    <!--地址底部-->
        <a href="<?php echo url("/index/user/addaddress"); ?>" class="address-footer"><i class="fa fa-plus-circle"></i>添加新地址</a>
    <!--地址底部结束-->
    <script>
        function setDefaults(id){
                $.ajax({
                    type: 'POST',
                    url: '<?php echo url("/index/user/setdefaults"); ?>',
                    data:{
                        id:id
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
