<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:78:"E:\phpStudy\WWW\yyy.com\public/../application/index\view\user\perfectinfo.html";i:1525317256;s:68:"E:\phpStudy\WWW\yyy.com\public/../application/index\view\header.html";i:1528532196;}*/ ?>
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


<script type="text/javascript" src="/static/home/cityselect/js/jquery.cityselect.js"></script>
    <script type="text/javascript">
            $(function(){
                <?php if(!empty($myuser['province'])): ?>
                $("#city").citySelect({prov:"<?php echo $myuser['province']; ?>", city:"<?php echo $myuser['city']; ?>", dist:"<?php echo $myuser['area']; ?>"});
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
        <p>完善信息</p>
    </div>
    <!--公共头部结束-->
    <!--内容主体-->
    <div class="m-addaddress">
        <h1>联系人</h1>
        <!--联系人信息-->
        <ul class="addaddress-user">
            <li><p>昵称：</p><input type="text" name="username" value="<?php if(!empty($myuser['username'])): ?><?php echo $myuser['username']; endif; ?>" placeholder="请填写您的昵称" /></li>
            
            <li><p>姓名：</p><input type="text" name="realname" value="<?php if(!empty($myuser['realname'])): ?><?php echo $myuser['realname']; endif; ?>" placeholder="请填写您的姓名" /></li>
            <li>
                <p></p>
                <div class="user-gender">
                    <label>
                        <input type="radio" name="sex" value="1"  <?php if(!empty($myuser['sex'])): if($myuser['sex'] == 1): ?>checked=""<?php endif; else: ?>checked=""<?php endif; ?> /><span>男</span>
                    </label>
                    <label>
                        <input type="radio" name="sex" value="2" <?php if(!empty($myuser['sex'])): if($myuser['sex'] == 2): ?>checked=""<?php endif; endif; ?> /><span>女</span>
                    </label>
                </div>
            </li>
            <li><p>年龄：</p><input type="text" name="age" value="<?php if(!empty($myuser['age'])): ?><?php echo $myuser['age']; endif; ?>" placeholder="请填写您的年龄" /></li>
            <li><p>身份证：</p><input type="text" name='cardid' value="<?php if(!empty($myuser['cardid'])): ?><?php echo $myuser['cardid']; endif; ?>" placeholder="请填写您的身份证（选填）" /></li>
            <li><p>邮箱：</p><input type="text" name='email' value="<?php if(!empty($myuser['email'])): ?><?php echo $myuser['email']; endif; ?>" placeholder="请填写您的邮箱（选填）" /></li>
        </ul>
        <h1>所在城市</h1>
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
                <p>从事行业：</p>
                <select name="industry" id='industry'  class="input" style="padding: .2rem 0;font-size:.25rem;height: 100%;width: 75%">
                    <option value="计算机">计算机</option>
                    <option value="互联网·电子商务">互联网·电子商务</option> 
                    <option value="电子·微电子技术">电子·微电子技术</option>
                    <option value="通讯·电信业">通讯·电信业</option>
                    <option value="快速消费品(食品·饮料·日化·烟酒等)">快速消费品(食品·饮料·日化·烟酒等)</option>
                    <option value="纺织品业(服饰鞋帽·家纺用品·皮具等)">纺织品业(服饰鞋帽·家纺用品·皮具等)</option>
                    <option value="家电业">家电业</option>
                    <option value="家具·工艺品">家具·工艺品</option>
                    <option value="木材加工及木、竹、藤、棕、草制品业">木材加工及木、竹、藤、棕、草制品业</option>
                    <option value="橡胶·塑料·非金属矿物制品业">橡胶·塑料·非金属矿物制品业</option>
                    <option value="金属制品业">金属制品业</option>
                    <option value="家居·室内设计·装潢">家居·室内设计·装潢</option>
                    <option value="批发·零售(商场·专卖店·百货·超市)">批发·零售(商场·专卖店·百货·超市)</option>
                    <option value="贸易·进出口">贸易·进出口</option>
                    <option value="运输·物流·快递">运输·物流·快递</option>
                    <option value="旅游·酒店·餐饮服务">旅游·酒店·餐饮服务</option>
                    <option value="物业管理·商业中心">物业管理·商业中心</option>
                    <option value="建筑·房地产">建筑·房地产</option>
                    <option value="市场·广告·公关">市场·广告·公关</option>
                    <option value="专业服务·咨询·财会·法律">专业服务·咨询·财会·法律</option>
                    <option value="中介服务(人才·房地产·商标专利·技术等)">中介服务(人才·房地产·商标专利·技术等)</option>
                    <option value="金融业(投资·保险·证券·银行·基金)">金融业(投资·保险·证券·银行·基金)</option>
                    <option value="娱乐·运动·休闲">娱乐·运动·休闲</option>
                    <option value="媒体·影视制作·新闻出版">媒体·影视制作·新闻出版</option>
                    <option value="艺术·文化传播">艺术·文化传播</option>
                    <option value="医疗设备">医疗设备</option>
                    <option value="制药·生物工程">制药·生物工程</option>
                    <option value="医疗·保健·卫生服务">医疗·保健·卫生服务</option>
                    <option value="办公设备·用品">办公设备·用品</option>
                    <option value="汽车·摩托车(制造与维护·配件·用品)">汽车·摩托车(制造与维护·配件·用品)</option>
                    <option value="石油·化工·采掘·冶炼·原材料">石油·化工·采掘·冶炼·原材料</option>
                    <option value=">电力·电气·能源">电力·电气·能源</option>
                    <option value="仪器·仪表·工业自动化">仪器·仪表·工业自动化</option>
                    <option value="机械制造·机电设备·重工业">机械制造·机电设备·重工业</option>
                    <option value="印刷·包装·造纸">印刷·包装·造纸</option>
                    <option value="生产·制造·加工">生产·制造·加工</option>
                    <option value="环保服务·设备">环保服务·设备</option>
                    <option value="航空/航天研究与制造">航空/航天研究与制造</option>
                    <option value="服务业">服务业</option>
                    <option value="农·林·牧·渔业">农·林·牧·渔业</option>
                    <option value="培训机构·教育·科研院所">培训机构·教育·科研院所</option>
                    <option value="政府·公共事业">政府·公共事业</option>
                    <option value="协会·学会·社团·非营利机构">协会·学会·社团·非营利机构</option>
                    <option value="其他">其他</option>

            </select>
<!--                <input type="text" name="industry" value="<?php if(!empty($myuser['industry'])): ?><?php echo $myuser['industry']; endif; ?>" placeholder="" />-->
            </li>
        </ul>
        <!--联系人信息结束-->

        <!--保存按钮-->
        <div class="addaddress-btn">
            <a href="javascript:;" onclick="update_member()">确认保存</a>
        </div>
        <!--保存按钮结束-->
    </div>
    <!--内容主体结束-->
    <script>
        function update_member(){
            var username = $('input[name="username"]').val();
            var realname = $('input[name="realname"]').val();
            var sex = $('input:radio[name="sex"]:checked').val();
            var age = $('input[name="age"]').val();
            var email = $('input[name="email"]').val();
            var cardid = $('input[name="cardid"]').val();
            var province = $('#myprovince').val();
            var city = $('#mycity').val();
            var area = $('#myarea').val();
            var industry = $('#industry').val();
            if(realname ==''){
                layer.msg('请输入真实姓名');
                return;
            }
            if(province ==''){
                layer.msg('请输入真实省份');
                return;
            }
            if(city ==''){
                layer.msg('请输入真实城市');
                return;
            }
            if(area ==''){
                layer.msg('请输入真实市县');
                return;
            }
            //身份证选填
//            if(cardid ==''){
//                layer.msg('请输入身份证信息');
//                return;
//            }
            if(cardid){
                var reg = /(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/;
                if(reg.test(cardid) === false)
                {
                    alert("身份证输入不合法");
                    return  false;
                }
            }



//             if(email ==''){
//                 layer.msg('请输入邮箱信息');
//                 return;
//             }
            $.ajax({
                type: 'POST',
                url: '<?php echo url("/index/user/perfectinfo"); ?>',
                data:{
                    username:username,
                    realname:realname,
                    sex:sex,
                    age:age,
                    email:email,
                    cardid:cardid,
                    province:province,
                    city:city,
                    area:area,
                    industry:industry,
                },
                dataType:'json',
                success: function(data){
                    if(data.type==1){
                        layer.msg(data.msg,{anim:0},function(){
                            //关闭后的操作
                            window.history.back();
                            });
                    }else{
                        layer.msg(data.msg);
                    }
                },
                error: function(xhr){
                    //layer.msg('error');
                }
            });
        }
    </script>
</body>
</html>
