<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:76:"E:\phpStudy\WWW\yyy.com\public/../application/index\view\user\recommend.html";i:1528948254;s:68:"E:\phpStudy\WWW\yyy.com\public/../application/index\view\header.html";i:1528532196;}*/ ?>
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
        <p>推荐记录</p>
    </div>
    <!--公共头部结束-->
    <!--内容主体-->
    <div class="m-recommend">
        <ul class="coupon-title">
            <li style="width: 49.5%;" onclick="window.location.href='<?php echo url('/index/user/invite'); ?>'">邀请好友</li>
            <li style="width: 49.5%;" class="ahover"  onclick="window.location.href='<?php echo url('/index/user/recommend'); ?>'">推荐记录</li>
        </ul>
        <!--记录总和-->
        <div class="recommend-sum">
            <ul>
                <li>
                    <p><?php echo $num; ?></p>
                    <span>已邀请人数</span>
                </li>
                <li>
                    <p><?php echo $mycredit2; ?></p>
                    <span>推荐总奖金</span>
                </li>
            </ul>
        </div>
        
        <!--记录总和结束-->

         <!--记录列表-->
        <div class="recommend-list" >
            <!--<div class="list-tips">所有推荐类奖金可于邀请人认购期满后单独提现</div>-->
            <ul>
                <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <li>
                    <img src="<?php if(!empty($vo['avatar'])) echo imgUrl($vo['avatar']);else echo imgUrl('') ?>" class="list-photo" />
                    <div class="list-info" style="float: unset;margin-left: 1.1rem">
                        <p><?php echo $vo['username']; ?><span style="display: inline;float: right"> 现拥有羊羔数：<?php echo $vo['num']; ?></span></p>
                        <span>注册时间：<?php echo date("Y-m-d ",$vo['reg_time']); ?>
                            <a style="display: inline;float: right;color: #1155CC" onclick="getMember(<?php echo $vo['id']; ?>)">已兑换羊羔数：<?php echo $vo['sell_num']; ?></a>
                        </span>

                    </div>
<!--                    <div class="list-money">
                        <i class="fa fa-plus"></i><span>0.00</span>
                    </div>-->
                </li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
        <!--记录列表结束-->

    </div>
    <!--内容主体结束-->
    <script>
        function getMember(id) {
            var uid =  id;

            //先查找用户信息
            $.ajax({
                type: 'POST',
                url: '<?php echo url("/index/user/getselllamb"); ?>',
                data:{
                    uid:id,
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
                            ,content: '<div style="padding: 50px; line-height: 22px; background-color: #393D49; color: #fff; font-weight: 300;">' +
                            '兑换明细：<br><br>兑换旅游：'+data.data.lvyou+'<br>兑换收益：'+data.data.shouyi+'<br>兑换产品：'+data.data.changpin+'<br>' +
                            '</div>'
                            ,success: function(layero){
                                var btn = layero.find('.layui-layer-btn');
                                btn.find('.layui-layer-btn0').attr({


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
    </script>
</body>
</html>
