<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:76:"/home/wwwroot/yang.oioos.com/public/../application/index/view/user/take.html";i:1524194606;s:73:"/home/wwwroot/yang.oioos.com/public/../application/index/view/header.html";i:1526866272;}*/ ?>
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
        <p>提现</p>
    </div>
    <!--公共头部结束-->
    <!--内容主体-->
    <div class="m-take">
        <!--提现信息-->
        <div class="take-info">
            <div class="info-money">
                可提现金额<span id='ktxje'><?php echo $member['credit']; ?></span>元
            </div>
            <div class="info-numb">
                <span>金额</span>
                <input type="text" name="money" placeholder="输入提现金额" />
            </div>
        </div>
        <!--提现信息结束-->
        <!--提现方式-->
        <div class="take-way">
           <h1>提现方式</h1>
            <ul>
                <li>
                    <label onclick="taketype(1)">
                        <span><i class="fa fa-wechat weixin"></i>微信提现</span>
                        <input type="radio" name="type" value='1' checked="checked" />
                    </label>
                </li>
                <li>
                    <label onclick="taketype(2)">
                        <span><i class="fa fa-jpy bankcard"></i>支付宝提现</span>
                        <input type="radio" name="type" value='2' />
                    </label>
                </li>
                <li>
                    <label onclick="taketype(3)">
                        <span><i class="fa fa-credit-card-alt bankcard"></i>银行卡提现</span>
                        <input type="radio" name="type" value='3' />
                    </label>
                </li>
            </ul>
            
        </div>
        <div class="m-addaddress" style='background: #F7F7F7;display:none;'>
            <h1>支付宝信息</h1>
            <!--联系人信息-->
            <ul class="addaddress-user">
                <li>
                    <p>真实姓名：</p>
                    <input type="text" name="realname" value="" placeholder="请填写联系人姓名">
                </li>
                <li class="alixx">
                    <p>支付宝号：</p>
                    <input type="text" name="alipay" value="" placeholder="请填写支付宝账号">
                </li>
                <li class="bankxx">
                    <p>银行名称：</p>
                    <select style="padding: .2rem 0;font-size:.25rem;height: 100%;width: 75%" id="bankname" name="bankname" class="prov">
                        <option value="" selected="selected">选择银行</option>
                        <option value="中国工商银行">中国工商银行</option>
                        <option value="中国农业银行">中国农业银行</option>
                        <option value="中国建设银行">中国建设银行</option>
                        <option value="中国银行">中国银行</option>
                        <option value="交通银行">交通银行</option>
                        <option value="中国邮政储蓄银行">中国邮政储蓄银行</option>
                        <option value="招商银行">招商银行</option>
                        <option value="农村商业银行">农村商业银行</option>
                    </select>
                </li>
                <li  class="bankxx">
                    <p>银行卡号：</p>
                    <input type="text" name="bankcard" value="" placeholder="请填写银行卡号">
                </li>
            </ul>


        </div>
        <!--提现方式结束-->
        <!--购买按钮-->
        <div class="take-btn">
            <a href="javascript:setTake();">确认提现</a>
        </div>
        <!--购买按钮结束-->
    </div>
    <!--内容主体结束-->
    <script>
        function taketype(num){
            if(num==2 || num==3){
                $(".m-addaddress").show();
                if(num==2){
                    $(".alixx").show();
                    $(".bankxx").hide();
                }else{
                    $(".bankxx").show();
                    $(".alixx").hide();
                }
            }else{
                $(".m-addaddress").hide();
            }
        }
        function setTake(){
            var type = $('input:radio[name="type"]:checked').val();
            var realname = $('input[name="realname"]').val();
            var alipay = $('input[name="alipay"]').val();
            var bankname = $('#bankname').val();
            var bankcard = $('input[name="bankcard"]').val();
            var money = $('input[name="money"]').val();
            var ktxje = $('#ktxje').html();
            if(type==2){
                if(realname.length==0){
                    layer.msg('姓名不能为空！');
                    return;
                }else if(alipay.length==0){
                    layer.msg('支付宝账户不能为空！');
                    return;
                }
            }
            if(type==3){
                if(realname.length==0){
                    layer.msg('姓名不能为空！');
                    return;
                }else if(bankname.length==0){
                    layer.msg('银行名称不能为空！');
                    return;
                }else if(bankcard.length==0){
                    layer.msg('银行卡号不能为空！');
                    return;
                }
            }
            if(isNaN(money)){
                 layer.msg('提现金额格式不正确！');
                 return;
            }else if(money<1){
                 layer.msg('提现金额不能少于1元！');
                 return;
            }
            money = parseFloat(money);
            ktxje = parseFloat(ktxje);
            if( money > ktxje ){
                layer.msg('可提现金额不足！'+money+'大于'+ktxje+'');
                 return;
            }
            
            $.ajax({
                type: 'POST',
                url: '<?php echo url("/index/user/settake"); ?>',
                data:{
                    type:type,
                    realname:realname,
                    alipay:alipay,
                    bankname:bankname,
                    bankcard:bankcard,
                    money:money
                },
                dataType:'json',
                success: function(data){
                    if(data.type==1){
                        layer.msg(data.msg);
                        setTimeout(function(){  //使用  setTimeout（）方法设定定时2000毫秒
                            window.location.reload();//页面刷新
                        },2000);
                    }else{
                        layer.msg(data.msg);
                        setTimeout(function(){  //使用  setTimeout（）方法设定定时2000毫秒
                            window.location.reload();//页面刷新
                        },2000);
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
