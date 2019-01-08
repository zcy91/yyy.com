<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:76:"E:\phpStudy\WWW\yyy.com\public/../application/index\view\user\xiaoxilog.html";i:1528696979;s:68:"E:\phpStudy\WWW\yyy.com\public/../application/index\view\header.html";i:1528532196;}*/ ?>
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
<body style="position:relative;background:#f2f2f2">

<!--公共头部-->
<div class="m-head">
    <a href="javascript:;" onclick="javascript:window.history.back();return false;" class="head-goback">
        <i class="fa fa-angle-left"></i>
    </a>
    <p>消息列表</p>
</div>
<!--公共头部结束-->
<!--内容主体-->
<div class="m-questions" id="comList">
    <ul>
        <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $k = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?>
        <li >
            <a href="<?php echo url('/index/user/notice_detail',array('id'=>$vo['id'])); ?>" style="white-space: nowrap;display: block;overflow: hidden;text-overflow: ellipsis;"><?php echo $k; ?>、<?php echo $vo['content']; ?></a>
        </li>
        <?php endforeach; endif; else: echo "" ;endif; ?>
</div>
<?php if(($count > $current_count) AND (count($list) == $page_count)): ?>
<div class="getmore" style="font-size:.32rem;text-align:center;color:#888;padding:.25rem .24rem .4rem; clear:both">
    <a href="javascript:void(0)" onClick="ajaxSourchSubmit();">点击加载更多</a>
</div>
<?php elseif(($count <= $current_count AND $count > 0)): ?>
<div class="score enkecor" style="font-size:.32rem;text-align:center;color:#888;padding:.25rem .24rem .4rem; clear:both">已显示完所有内容</div>
<?php else: endif; ?>
<!--内容主体结束-->
<script>
    if(<?php echo $p; ?>){
        var page = <?php echo $p; ?>;
    }else{
        var page = 1 ;
    }

    function ajaxSourchSubmit() {
        page += 1;
        $.ajax({
            type: "GET",
            url: "<?php echo url('index/user/ajaxnotice'); ?>"+"&p=" + page,
            success: function (data) {
                $('.getmore').hide();
                if ($.trim(data) != ''){
                    $("#comList").append(data);
                }
            }
        });
    }
    function  ajax_sourch_submit_hide(){
        $('.getmore').hide();
    }
</script>
</body>
</html>