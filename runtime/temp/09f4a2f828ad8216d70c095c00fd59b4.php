<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:79:"E:\phpStudy\WWW\yyy.com\public/../application/back\view\article\articleadd.html";i:1522657620;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>个人信息</title>
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
		.item-pic-list ul {
			overflow: hidden;
		}
		.item-pic-list ul li {
			float: left;
			width: 150px;
			box-sizing: border-box;
			padding: .02rem;
			text-align: center;
			margin-top: .08rem;
		}
		.item-pic-list ul li img {
			width: 100px;
			height: 100px;
		}

    </style>
    
    <!--百度编辑器-->

</head>
<body>
<section class="layui-larry-box">
	<div class="larry-personal">
		<header class="larry-personal-tit">
			<span>个人信息</span>
		</header><!-- /header -->
		<div class="larry-personal-body clearfix">
			<form class="layui-form col-lg-5" enctype="multipart/form-data" id="add_comment" method="post">
				<div class="layui-form-item">
					<label class="layui-form-label">标题</label>
					<div class="layui-input-block">
						<input type="text" name="title"  autocomplete="off" class="layui-input" value="<?php if(!empty($myarticle['title'])): ?><?php echo $myarticle['title']; endif; ?>"  placeholder="输入标题">
						<input type="hidden" name="id" value="<?php if(!empty($myarticle['id'])): ?><?php echo $myarticle['id']; endif; ?>" >
					</div>
				</div>
                                <div class="layui-form-item">
					<label class="layui-form-label">文章分类</label>
					<div class="layui-input-block">
                                            <select name="catid" id="catid" lay-filter="aihao">
                                                    <option value="0" >暂无分类</option>
                                                   <?php if(is_array($article_type) || $article_type instanceof \think\Collection || $article_type instanceof \think\Paginator): $i = 0; $__LIST__ = $article_type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                                        <option value="<?php echo $vo['id']; ?>" <?php if(!empty($myarticle['catid']) && $vo['id']==$myarticle['catid']): ?> selected="selected"<?php endif; ?>><?php echo $vo['name']; ?></option>
                                                   <?php endforeach; endif; else: echo "" ;endif; ?>
							
						</select>
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">发布人id</label>
					<div class="layui-input-block">
                                            <input type="text" name="userid"  autocomplete="off" class="layui-input" value="<?php if(!empty($myarticle['userid'])): ?><?php echo $myarticle['userid']; endif; ?>" placeholder="输入发布人id">
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">发布人姓名</label>
					<div class="layui-input-block">
                                            <input type="text" name="username"  autocomplete="off" class="layui-input" value="<?php if(!empty($myarticle['username'])): ?><?php echo $myarticle['username']; endif; ?>" placeholder="输入发布人姓名">
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">头像</label>
					<div class="layui-input-block">
						<input type="file" name="file" class="layui-upload-file">
                                                <img style="width: 36px;height: 36px;" class="myimg" src="<?php if(!empty($myarticle['avatar'])) echo imgUrl($myarticle['avatar']);else echo imgUrl('') ?>">
                                                <input type="text"  class="avatar layui-input-block" style="padding-left: 10px;width: 50%;margin-left: 10px;" name="avatar" value="<?php if(!empty($myarticle['avatar'])): ?><?php echo $myarticle['avatar']; endif; ?>" >
                                        </div>
                                </div>   
                                <div class="layui-form-item">
					<label class="layui-form-label">排序</label>
					<div class="layui-input-block">
						<input type="text" name="sort"  autocomplete="off" class="layui-input" value="<?php if(!empty($myarticle['sort'])): ?><?php echo $myarticle['sort']; else: ?>50<?php endif; ?>">
					</div>
				</div>
                                <div class="layui-form-item">
					<label class="layui-form-label">浏览量</label>
					<div class="layui-input-block">
                                            <input type="text" name="hits"  autocomplete="off" class="layui-input" value="<?php if(!empty($myarticle['hits'])): ?><?php echo $myarticle['hits']; endif; ?>" placeholder="输入浏览量">
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">点赞数</label>
					<div class="layui-input-block">
                                            <input type="text" name="zan"  autocomplete="off" class="layui-input" value="<?php if(!empty($myarticle['zan'])): ?><?php echo $myarticle['zan']; endif; ?>" placeholder="输入点赞数">
					</div>
				</div> 
				<div class="layui-form-item">
					<label class="layui-form-label">内容</label>
					<div class="layui-input-block">
						<script type="text/plain" name="content"  id="myEditor" style="width:1000px;height:240px;"><?php if(!empty($myarticle['content'])): ?><?php echo $myarticle['content']; else: endif; ?></script>
						</div>
				</div>
						<div class="layui-form-item">
                            <label class="layui-form-label">图集</label>
                            <div class="layui-input-block">
								<div  class="item-pic-list">
								<ul id="imglen" style="width:1000px">
                            <?php if(!(empty($myarticle['img']) || (($myarticle['img'] instanceof \think\Collection || $myarticle['img'] instanceof \think\Paginator ) && $myarticle['img']->isEmpty()))): if(is_array($myarticle["img"]) || $myarticle["img"] instanceof \think\Collection || $myarticle["img"] instanceof \think\Paginator): $k = 0; $__LIST__ = $myarticle["img"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?>
										<li class="file">
											<label style="display:block;margin-bottom: 15px;">
														<div class="shcph" id="fileList<?php echo $k; ?>">
															<?php if($vo != ''): ?>
																	<img src="<?php echo $vo; ?>" >
																	<?php else: ?>
																	<img src="__STATIC__/images/camera.png">
															<?php endif; ?>
														</div>
														<input  type="file"   name="comment_img_file[]"  onchange="handleFiles(this,<?php echo $k; ?>)" style="display:none">
											</label>
											<a class="pimg"  src=<?php echo $vo; ?>>查看大图</a>
										</li>
									<?php endforeach; endif; else: echo "" ;endif; endif; if(empty($myarticle['img']) || (($myarticle['img'] instanceof \think\Collection || $myarticle['img'] instanceof \think\Paginator ) && $myarticle['img']->isEmpty())): ?>
                                        <label>
                                        <li class="file">
                                            <div class="shcph" id="fileList0">
                                            <img src="__STATIC__/images/camera.png">
                                            </div>
                                            <input  type="file"  name="comment_img_file[]"  onchange="handleFiles(this,0)" style="display:none">
                                            </li>
                                            </label>
                                            <label>
                                            <li class="file">
                                            <div class="shcph" id="fileList1">
                                            <img src="__STATIC__/images/camera.png" >
                                            </div>
                                            <input  type="file"  name="comment_img_file[]"  onchange="handleFiles(this,1)" style="display:none">
                                            </li>
                                            </label>
                                            <label>
                                            <li class="file">
                                            <div class="shcph" id="fileList2">
                                            <img src="__STATIC__/images/camera.png" >
                                            </div>
                                            <input  type="file"  name="comment_img_file[]"  onchange="handleFiles(this,2)" style="display:none">
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
											<?php endif; ?>
								</ul>
								</div>
                          	</div>
						</div>
						<div class="layui-form-item">
					<label class="layui-form-label">是否发布</label>
					<div class="layui-input-block">
						<input type="radio" name="status" value="1" title="发布" <?php if(!empty($myarticle['status'])): if($myarticle['status'] == 1): ?>checked=""<?php endif; else: ?>checked=""<?php endif; ?>><div class="layui-unselect layui-form-radio layui-form-radioed"><i class="layui-anim layui-icon"></i><span>发布</span></div>
						<input type="radio" name="status" value="0" title="下架" <?php if(!empty($myarticle)): if($myarticle['status'] == 0): ?>checked=""<?php endif; endif; ?>><div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i><span>下架</span></div>
					</div>
				</div>
											<div id="outerdiv" style="position:fixed;top:0;left:0;background:rgba(0,0,0,0.7);z-index:9999;width:100%;height:100%;display:none;"><div id="innerdiv" style="position:absolute;"><img id="bigimg" style="border:5px solid #fff;" src="" /></div></div>

                                            <div class="layui-form-item">
					<div class="layui-input-block">
							<button type="button" class="layui-btn" onclick="validate_comment()">立即提交</button>
						<button type="reset" class="layui-btn layui-btn-primary">重置</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>
<script type="text/javascript" src="/static/common/layui/layui.js"></script>
<script type="text/javascript">

    $(function(){
        $(".pimg").click(function(){
            var _this = $(this);//将当前的pimg元素作为_this传入函数
            imgShow("#outerdiv", "#innerdiv", "#bigimg", _this);
        });
    });
    function imgShow(outerdiv, innerdiv, bigimg, _this){
        var src = _this.attr("src");//获取当前点击的pimg元素中的src属性
        $(bigimg).attr("src", src);//设置#bigimg元素的src属性

        /*获取当前点击图片的真实大小，并显示弹出层及大图*/
        $("<img/>").attr("src", src).load(function(){
            var windowW = $(window).width();//获取当前窗口宽度
            var windowH = $(window).height();//获取当前窗口高度
            var realWidth = this.width;//获取图片真实宽度
            var realHeight = this.height;//获取图片真实高度
            var imgWidth, imgHeight;
            var scale = 0.8;//缩放尺寸，当图片真实宽度和高度大于窗口宽度和高度时进行缩放

            if(realHeight>windowH*scale) {
                //判断图片高度
                imgHeight = windowH*scale;//如大于窗口高度，图片高度进行缩放
                imgWidth = imgHeight/realHeight*realWidth;//等比例缩放宽度
                if(imgWidth>windowW*scale) {
                    //如宽度扔大于窗口宽度
                    imgWidth = windowW*scale;//再对宽度进行缩放
                }
            } else if(realWidth>windowW*scale) {
                //如图片高度合适，判断图片宽度
                imgWidth = windowW*scale;//如大于窗口宽度，图片宽度进行缩放
                imgHeight = imgWidth/realWidth*realHeight;//等比例缩放高度
            } else {
                //如果图片真实高度和宽度都符合要求，高宽不变
                imgWidth = realWidth;
                imgHeight = realHeight;
            }

            $(bigimg).css("width",imgWidth);//以最终的宽度对图片缩放
            var w = (windowW-imgWidth)/2;//计算图片与窗口左边距
            var h = (windowH-imgHeight)/2;//计算图片与窗口上边距
            $(innerdiv).css({"top":h, "left":w ,'z-index':9999});//设置#innerdiv的top和left属性
            $(outerdiv).fadeIn("fast");//淡入显示#outerdiv及.pimg
        });

        $(outerdiv).click(function(){
            //再次点击淡出消失弹出层
            $(this).fadeOut("fast");
        });
    }

    function validate_comment(){
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

	layui.use(['form','upload'],function(){
         layui.upload({ 
             url: '/server/fileupload.php',//上传接口 
             success: function(res){
                if(res.result){
                    $('.avatar').val(res.result);
                    $('.myimg').attr('src','/server/'+res.result);                    
                }else{
                    alert('上传失败');
                }
              console.log(res.result) 
            } 
         });

	});
</script>
<script type="text/javascript">
    //实例化编辑器
    var um = UM.getEditor('myEditor');
    um.addListener('blur',function(){
        $('#focush2').html('编辑器失去焦点了')
    });
    um.addListener('focus',function(){
        $('#focush2').html('')
    });
    //按钮的操作
    function insertHtml() {
        var value = prompt('插入html代码', '');
        um.execCommand('insertHtml', value)
    }
    function isFocus(){
        alert(um.isFocus())
    }
    function doBlur(){
        um.blur()
    }
    function createEditor() {
        enableBtn();
        um = UM.getEditor('myEditor');
    }
    function getAllHtml() {
        alert(UM.getEditor('myEditor').getAllHtml())
    }
    function getContent() {
        var arr = [];
        arr.push("使用editor.getContent()方法可以获得编辑器的内容");
        arr.push("内容为：");
        arr.push(UM.getEditor('myEditor').getContent());
        alert(arr.join("\n"));
    }
    function getPlainTxt() {
        var arr = [];
        arr.push("使用editor.getPlainTxt()方法可以获得编辑器的带格式的纯文本内容");
        arr.push("内容为：");
        arr.push(UM.getEditor('myEditor').getPlainTxt());
        alert(arr.join('\n'))
    }
    function setContent(isAppendTo) {
        var arr = [];
        arr.push("使用editor.setContent('欢迎使用umeditor')方法可以设置编辑器的内容");
        UM.getEditor('myEditor').setContent('欢迎使用umeditor', isAppendTo);
        alert(arr.join("\n"));
    }
    function setDisabled() {
        UM.getEditor('myEditor').setDisabled('fullscreen');
        disableBtn("enable");
    }

    function setEnabled() {
        UM.getEditor('myEditor').setEnabled();
        enableBtn();
    }

    function getText() {
        //当你点击按钮时编辑区域已经失去了焦点，如果直接用getText将不会得到内容，所以要在选回来，然后取得内容
        var range = UM.getEditor('myEditor').selection.getRange();
        range.select();
        var txt = UM.getEditor('myEditor').selection.getText();
        alert(txt)
    }

    function getContentTxt() {
        var arr = [];
        arr.push("使用editor.getContentTxt()方法可以获得编辑器的纯文本内容");
        arr.push("编辑器的纯文本内容为：");
        arr.push(UM.getEditor('myEditor').getContentTxt());
        alert(arr.join("\n"));
    }
    function hasContent() {
        var arr = [];
        arr.push("使用editor.hasContents()方法判断编辑器里是否有内容");
        arr.push("判断结果为：");
        arr.push(UM.getEditor('myEditor').hasContents());
        alert(arr.join("\n"));
    }
    function setFocus() {
        UM.getEditor('myEditor').focus();
    }
    function deleteEditor() {
        disableBtn();
        UM.getEditor('myEditor').destroy();
    }
    function disableBtn(str) {
        var div = document.getElementById('btns');
        var btns = domUtils.getElementsByTagName(div, "button");
        for (var i = 0, btn; btn = btns[i++];) {
            if (btn.id == str) {
                domUtils.removeAttributes(btn, ["disabled"]);
            } else {
                btn.setAttribute("disabled", "true");
            }
        }
    }
    function enableBtn() {
        var div = document.getElementById('btns');
        var btns = domUtils.getElementsByTagName(div, "button");
        for (var i = 0, btn; btn = btns[i++];) {
            domUtils.removeAttributes(btn, ["disabled"]);
        }
    }
</script>
<script>
function article_add(){  //
    var title=$("input[name='title']").val();
    var id=$("input[name='id']").val();
    var userid=$("input[name='userid']").val();
    var username=$("input[name='username']").val();
    var hits=$("input[name='hits']").val();
    var sort=$("input[name='sort']").val();
    var zan=$("input[name='zan']").val();
    var avatar=$("input[name='avatar']").val();
    var content=$("#myEditor").html();
    var status=$('input:radio[name="status"]:checked').val();
    var catid=$('#catid').val();
        $.ajax({ 
            type: 'POST',
            url: '/back/article/articleadd',
            data:{
              title:title,
              id:id,
              userid:userid,
              username:username,
              hits:hits,
              zan:zan,
              avatar:avatar,
              content:content,
              status:status,
              catid:catid,
              sort:sort
            },
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
</script>
</body>
</html>