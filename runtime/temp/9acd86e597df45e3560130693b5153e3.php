<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:76:"D:\wamp64\www\yyy.com\public/../application/index\view\user\addaddress1.html";i:1533959063;s:66:"D:\wamp64\www\yyy.com\public/../application/index\view\header.html";i:1534577442;}*/ ?>
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
    <script src="/static/pingpp-js/dist/pingpp.js"></script>
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


    <script type="text/javascript" src="/static/home/cityselect/js/jquery.cityselect.js"></script>
    <script type="text/javascript">
            $(function(){
                <?php if(!empty($myaddress['province'])): ?>
                $("#city").citySelect({prov:"<?php echo $myaddress['province']; ?>", city:"<?php echo $myaddress['city']; ?>", dist:"<?php echo $myaddress['area']; ?>"});
                <?php else: ?>
                $("#city").citySelect();
                <?php endif; ?>
                
                
                
            });
    </script>
</head>
<body style="position:relative;">

    <!--公共头部-->
    <div class="m-head">
        <a href="javascript:;" onclick="javascript:window.history.back();return false;" class="head-goback">
            <i class="fa fa-angle-left"></i>
        </a>
        <p>新增地址</p>
    </div>
    <!--公共头部结束-->
    <!--内容主体-->
    <div class="m-addaddress">
        <h1>联系人</h1>
        <!--联系人信息-->
        <ul class="addaddress-user">
            <li><p>姓名：</p>
                <input type="text" name='name'  value="<?php if(!empty($myaddress['name'])): ?><?php echo $myaddress['name']; endif; ?>" placeholder="请填写联系人姓名" />
                <input type="hidden" name='id' value="<?php if(!empty($myaddress['id'])): ?><?php echo $myaddress['id']; endif; ?>" />
            </li>
            <li>
                <p></p>
                <div class="user-gender">
                    <label>
                        <input type="radio" name="sex" value='1' <?php if(!empty($myaddress['sex']) && $myaddress['sex']==1): ?> checked="checked"<?php endif; ?> /><span>先生</span>
                    </label>
                    <label>
                        <input type="radio" name="sex" value='2' <?php if(!empty($myaddress['sex']) && $myaddress['sex']==2): ?> checked="checked"<?php endif; ?> /><span>女士</span>
                    </label>
                </div>
            </li>
            <li><p>电话：</p><input type="text" name="phone"  onkeyup="this.value=this.value.replace(/[^\d]/g,'') " onafterpaste="this.value=this.value.replace(/[^\d]/g,'') " value="<?php if(!empty($myaddress['phone'])): ?><?php echo $myaddress['phone']; endif; ?>" placeholder="请填写联系人手机号" /></li>
        </ul>
        <!--联系人信息结束-->
        <h1>联系人地址</h1>
        <!--联系人地址-->
        <ul class="addaddress-user"  id="city">
            <li>
                <p>所在省份：</p>
                <select style="    padding: .2rem 0;font-size:.25rem;height: 100%;width: 75%" id='myprovince' name="province" class="prov"></select>  
	    </li>
            <li>
                <p>所在城市：</p>
                <select  style="    padding: .2rem 0;font-size:.25rem;height: 100%;width: 75%" id='mycity' name="city" class="city" disabled="disabled"></select> 
            </li>
            <li>
                <p>所在市县：</p>
                <select  style="    padding: .2rem 0;font-size:.25rem;height: 100%;width: 75%" id='myarea' name="area" class="dist" disabled="disabled"></select> 
            </li>
            <li>
                <p>详细地址：</p>
                <input type="text" name="detailed" value="<?php if(!empty($myaddress['detailed'])): ?><?php echo $myaddress['detailed']; endif; ?>" placeholder="请填写详细地址" />
            </li>
        </ul>
        <!--联系人地址结束-->
        <!--保存按钮-->
        <div class="addaddress-btn">
            <a href="javascript:setAddress();">确认保存</a>
        </div>
        <!--保存按钮结束-->
    </div>
    <input type="hidden" value="<?php echo $sheep_id; ?>" id="sheep_id">
    <!--内容主体结束-->
    <script>
        function setAddress(){
            var sex = $('input:radio[name="sex"]:checked').val();
            var id = $('input[name="id"]').val();
            var name = $('input[name="name"]').val();
            var phone = $('input[name="phone"]').val();
            var province = $('#myprovince').val();
            var city = $('#mycity').val();
            var area = $('#myarea').val();
            var detailed = $('input[name="detailed"]').val();
            var sheep_id = $('#sheep_id').val();
            if(name.length==0){
                layer.msg('姓名不能为空');
                return;
            }else if(phone.length==0){
                layer.msg('手机不能为空');
                return;
            }else if(detailed.length==0){
                layer.msg('详细地址不能为空');
                return;
            }
            else if (phone.length > 15){
                layer.msg('请填写正确手机号码');
                return false;
            }
                $.ajax({
                    type: 'POST',
                    url: '<?php echo url("/index/user/addaddress"); ?>',
                    data:{
                        id:id,
                        sex:sex,
                        name:name,
                        phone:phone,
                        province:province,
                        city:city,
                        area:area,
                        detailed:detailed,
                    },
                    dataType:'json',
                    success: function(data){
                        if(data.type==1){
                            layer.msg(data.msg,function(){
                            //关闭后的操作
                            window.location.href='<?php echo url("/index/user/soldsheep"); ?>'+"?id="+sheep_id+"&sheep_id="+sheep_id;
                                //window.history.back();
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
