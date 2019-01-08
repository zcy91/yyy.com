<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:80:"D:\wamp64\www\yyy.com\public/../application/index\view\user\zu_photorelease.html";i:1531711453;s:66:"D:\wamp64\www\yyy.com\public/../application/index\view\header.html";i:1531711450;}*/ ?>
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


<style>
    .a-upload {
        float: left;
        padding: 4px 10px;
        height: .5rem;
        line-height: .5rem;
        position: relative;
        cursor: pointer;
        color: white;
        background: #00b7ee;
        border: 1px solid #ddd;
        border-radius: 4px;
        overflow: hidden;
        display: inline-block;
        *display: inline;
        margin: 10px;
        *zoom: 1;
        text-decoration: none;
    }
    .a-upload  input {
        position: absolute;
        font-size: 100px;
        right: 0;
        top: 0;
        opacity: 0;
        filter: alpha(opacity=0);
        cursor: pointer
    }
    .a-upload:hover {
        color: white;
        background: #00b7ee;
        border-color: #ccc;
        text-decoration: none
    }
    body{
        padding-bottom: 1rem;
    }
    #dd {
        overflow: hidden;
    }
</style>
<link href="/static/home/renwucss/awesome.css" rel="stylesheet">
<link href="/static/home/renwucss/base.css" rel="stylesheet">
<link href="/static/home/renwucss/common.css" rel="stylesheet">
<link href="/static/home/renwucss/iSlider.css" rel="stylesheet">
<link href="/static/home/renwucss/index.css" rel="stylesheet">
<script src="/static/home/js/style.js" type="text/javascript" charset="utf-8"></script>

<form id="add_comment" method="post" enctype="multipart/form-data">
    <div class="m-head">
        <a href="javascript:;" onclick="javascript:window.history.back();return false;" class="head-goback">
            <i class="fa fa-angle-left"></i>
        </a>
        <p><?php echo $webtitle; ?></p>
    </div>
    <div class="add-vote">

        <div class="customer-messa comm_text_goods">
            <div class="maleri30" style="position: relative;padding: 5px 20px 10px">
                <textarea class="tapassa" style="margin: unset" onkeyup="checkfilltextarea('.tapassa','200')" id="content_13" name="content" placeholder="分享动态给其他小伙伴吧~"></textarea>
                <span class="xianzd"><em id="zero">200</em>/200</span>
            </div>
        </div>
                <div style="margin :0px auto; width:6.4rem;">
                    <a href="javascript:;" class="a-upload">
                        <input type="file" name="comment_img_file[]" id="doc" multiple="multiple" onchange="setImagePreviews()" accept="image/*" />点击这里上传文件
                    </a>
                    <div id="dd" style=" width:6.4rem;"></div>
                </div>


                <div class="add-vote-submit" >
                    <a class="public-submit" href="javascript:void(0);" onclick="return validate_comment()" >提交</a>
                </div>
            </div>
        </div>
    </div>
</form>
<script type="text/javascript">
    function setImagePreviews(avalue) {
        var docObj = document.getElementById("doc");
        var dd = document.getElementById("dd");
        dd.innerHTML = "";
        var fileList = docObj.files;
        for (var i = 0; i < fileList.length; i++) {
            dd.innerHTML += "<div style='float: left;margin-top: 10px;' > <img id='img" + i + "'  /> </div>";
            var imgObjPreview = document.getElementById("img"+i);
            if (docObj.files && docObj.files[i]) {
                //火狐下，直接设img属性
                // imgObjPreview.style.display = 'block';
                imgObjPreview.style.width = '2.5rem';
                imgObjPreview.style.height = '2.5rem';
                imgObjPreview.style.margin = '.2rem';
                imgObjPreview.style.borderRadius = '.05rem';
                //imgObjPreview.src = docObj.files[0].getAsDataURL();
                //火狐7以上版本不能用上面的getAsDataURL()方式获取，需要一下方式
                imgObjPreview.src = window.URL.createObjectURL(docObj.files[i]);
            }
            else {
                //IE下，使用滤镜
                docObj.select();
                var imgSrc = document.selection.createRange().text;
                var localImagId = document.getElementById("img" + i);
                //必须设置初始大小
                localImagId.style.width = "2.5rem";
                // localImagId.style.height = "1.3rem";
                imgObjPreview.style.margin = '.2rem';
                imgObjPreview.style.borderRadius = '.05rem';
                //图片异常的捕捉，防止用户修改后缀来伪造图片
                try {
                    localImagId.style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale)";
                    localImagId.filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = imgSrc;
                }
                catch (e) {
                    alert("您上传的图片格式不正确，请重新选择!");
                    return false;
                }
                imgObjPreview.style.display = 'none';
                document.selection.empty();
            }
        }
        return true;

    }
    function validate_comment(){

        var error = [];
        var img_num = 0;
        var AllImgExt=".jpg|.jpeg|.gif|.bmp|.png|";//全部图片格式类型
        //var title = document.getElementById("title").value;
//        $("#dd img").each(function(index){
//            alert(this.value)
//            FileExt = this.value.substr(this.value.lastIndexOf(".")).toLowerCase();
//            if(this.value!=''){
//                img_num++;
//                if(AllImgExt.indexOf(FileExt+"|")==-1){
//                    layer.msg("第"+(index+1)+"张图片格式错误");
//                    return false;
//                }
//            }
//        });
        var docObj = document.getElementById("doc");
        var fileList = docObj.files;
        var img_num = (fileList.length)
        if(img_num > 5 ){
            layer.msg('最多上传5张组照，请重新选择');
            // showErrorMsg('请上传10张截图');
            return false;
        }
        if(error.length>0){
            showErrorMsg(error);
            return false;
        }else{
            $('#add_comment').submit();
            // var index = layer.load(1, {
            //    shade: [0.1,'#fff'] //0.1透明度的白色背景
            //});

            return true;
        }
    }

    //显示上传照片
    window.URL = window.URL || window.webkitURL;
    function handleFiles(obj,id) {
        fileList = document.getElementById("fileList"+id);
        var files = obj.files;
        img = new Image();
        if(window.URL){

            img.src = window.URL.createObjectURL(files[0]); //创建一个object URL，并不是你的本地路径
            // img.width = 60;
            // img.height = 60;
            img.onload = function(e) {
                window.URL.revokeObjectURL(this.src); //图片加载后，释放object URL
            }
            if(fileList.firstElementChild){
                fileList.removeChild(fileList.firstElementChild);
            }
            fileList.appendChild(img);
        }else if(window.FileReader){
            //opera不支持createObjectURL/revokeObjectURL方法。我们用FileReader对象来处理
            var reader = new FileReader();
            reader.readAsDataURL(files[0]);
            reader.onload = function(e){
                img.src = this.result;
                // img.width = 60;
                // img.height = 60;
                fileList.appendChild(img);
            }
        }else
        {
            //ie
            obj.select();
            obj.blur();
            var nfile = document.selection.createRange().text;
            document.selection.empty();
            img.src = nfile;
            // img.width = 60;
            // img.height = 60;
            img.onload=function(){

            }
            fileList.appendChild(img);
        }
    }
</script>
</body>
</html>
