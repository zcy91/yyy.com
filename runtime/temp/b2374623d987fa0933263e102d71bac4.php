<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:77:"D:\wamp64\www\yyy.com\public/../application/index\view\user\photorelease.html";i:1522906778;s:66:"D:\wamp64\www\yyy.com\public/../application/index\view\header.html";i:1528532196;}*/ ?>
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

    .item-pic-list ul {
        overflow: hidden;
    }
    .item-pic-list ul li {
        float: left;
        width: 2.133rem;
        box-sizing: border-box;
        padding: .02rem;
        text-align: center;
        margin-top: .08rem;
    }
    .item-pic-list ul li img {
        width: 2rem;
        height: 2rem;
    }
     .tapassa {
         width: 100%;
        height: 3.84rem;
        background: inherit;
        outline: none;
        border: 0;
        line-height: .5333rem;
         font-size:.36rem;
         padding: 0.2rem 0;
    }
    .xianzd{
        position: absolute;
        color: #999;
        right: .21333rem;
        font-size: .367rem;
        /*bottom: 7rem;*/
    }
</style>
<script src="/static/home/js/style.js" type="text/javascript" charset="utf-8"></script>
<form id="add_comment" method="post" enctype="multipart/form-data">
    <div class="m-head">
        <a href="javascript:;" onclick="javascript:window.history.back();return false;" class="head-goback">
            <i class="fa fa-angle-left"></i>
        </a>
        <p>&nbsp;</p>
    </div>
    <div class="public-input-wrapper" style="padding-top: 0">
        <a class="public-submit" href="javascript:void(0);" onclick="return validate_comment()">提交</a>
    </div>
    <div class="customer-messa comm_text_goods">
        <div class="maleri30" style="position: relative;padding: 5px 20px 10px">
            <textarea class="tapassa" style="margin: unset" onkeyup="checkfilltextarea('.tapassa','200')" id="content_13" name="content" placeholder="分享动态给其他小伙伴吧~"></textarea>
            <span class="xianzd"><em id="zero">200</em>/200</span>
        </div>
    </div>
    <!--评论-e-->
    <!--上传图片-s-->
    <div class="seravetype">
        <div class=" item-pic-list">
            <ul id="imglen">
                <label>
                    <li class="file">
                        <div class="shcph" id="fileList0">
                            <img src="__STATIC__/images/camera.png">
                        </div>
                        <input  type="file"   name="comment_img_file[]"  onchange="handleFiles(this,0)" style="display:none">
                    </li>
                </label>
                <label>
                    <li class="file">
                        <div class="shcph" id="fileList1">
                            <img src="__STATIC__/images/camera.png" >
                        </div>
                        <input  type="file"   name="comment_img_file[]"  onchange="handleFiles(this,1)" style="display:none">
                    </li>
                </label>
                <label>
                    <li class="file">
                        <div class="shcph" id="fileList2">
                            <img src="__STATIC__/images/camera.png" >
                        </div>
                        <input  type="file"   name="comment_img_file[]"  onchange="handleFiles(this,2)" style="display:none">
                    </li>
                </label>
                <label>
                    <li class="file">
                        <div class="shcph" id="fileList3">
                            <img src="__STATIC__/images/camera.png" >
                        </div>
                        <input  type="file"   name="comment_img_file[]"  onchange="handleFiles(this,3)" style="display:none">
                    </li>
                </label>
                <label>
                    <li class="file">
                        <div class="shcph" id="fileList4">
                            <img src="__STATIC__/images/camera.png" >
                        </div>
                        <input  type="file"   name="comment_img_file[]"  onchange="handleFiles(this,4)" style="display:none">
                    </li>
                </label>
                <label>
                    <li class="file">
                        <div class="shcph" id="fileList5">
                            <img src="__STATIC__/images/camera.png" >
                        </div>
                        <input  type="file"   name="comment_img_file[]"  onchange="handleFiles(this,5)" style="display:none">
                    </li>
                </label>
            </ul>
        </div>
    </div>

</form>
<script type="text/javascript">
    function validate_comment(){
        var content = $("#content_13").val();
        var error = [];
        var img_num = 0;
        var AllImgExt=".jpg|.jpeg|.gif|.bmp|.png|";//全部图片格式类型
        //var title = document.getElementById("title").value;
        $(".file input").each(function(index){
            FileExt = this.value.substr(this.value.lastIndexOf(".")).toLowerCase();
            if(this.value!=''){
                img_num++;
                if(AllImgExt.indexOf(FileExt+"|")==-1){
                    layer.msg("第"+(index+1)+"张图片格式错误");
                    return false;
                }
            }
        });
        if(content == ''){
            layer.msg('请写下动态内容吧！');
            return false
        }

        if(error.length>0){
            showErrorMsg(error);
            return false;
        }else{
            $('#add_comment').submit();
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
