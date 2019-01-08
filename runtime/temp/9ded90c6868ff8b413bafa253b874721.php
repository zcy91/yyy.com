<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:82:"/home/wwwroot/yang.oioos.com/public/../application/back/view/addons/couponadd.html";i:1523415484;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>添加商品</title>
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
</head>
<body>
<section class="layui-larry-box">
	<div class="larry-personal">
		<header class="larry-personal-tit">
			<span>添加商品</span>
		</header><!-- /header -->
		<div class="larry-personal-body clearfix">
			<form class="layui-form col-lg-5" id="yourformid">
				<div class="layui-form-item">
					<label class="layui-form-label">名称</label>
					<div class="layui-input-block">
						<input type="text" name="couponname"  autocomplete="off" class="layui-input" value="<?php if(!empty($mycoupon['couponname'])): ?><?php echo $mycoupon['couponname']; endif; ?>"  placeholder="输入优惠券名称">
						<input type="hidden" name="id" value="<?php if(!empty($mycoupon['id'])): ?><?php echo $mycoupon['id']; endif; ?>" >
					</div>
				</div>
                                <div class="layui-form-item">
					<label class="layui-form-label">排序</label>
					<div class="layui-input-block">
						<input type="text" name="sort"  autocomplete="off" class="layui-input" value="<?php if(!empty($mycoupon['sort'])): ?><?php echo $mycoupon['sort']; else: ?>50<?php endif; ?>">
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">返利方式</label>
					<div class="layui-input-block">
                                            <input type="radio" name="backtype" value="0" title="立减" <?php if(!empty($mycoupon['backtype'])): if($mycoupon['backtype'] === 0): ?>checked=""<?php endif; else: ?>checked=""<?php endif; ?>><div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i><span>立减</span></div>
                                            <input type="radio" name="backtype" value="1" title="打折" <?php if(!empty($mycoupon['backtype'])): if($mycoupon['backtype'] === 1): ?>checked=""<?php endif; endif; ?>><div class="layui-unselect layui-form-radio layui-form-radioed"><i class="layui-anim layui-icon"></i><span>打折</span></div>
                                            <input type="text" name="deduct"  autocomplete="off" class="layui-input" value="<?php if(!empty($mycoupon['deduct'])): ?><?php echo $mycoupon['deduct']; endif; ?>">
                                        </div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">使用条件</label>
					<div class="layui-input-block">
                                            <input type="text" name="enough"  autocomplete="off" class="layui-input" placeholder="消费满多少可用, 空或0 不限制" value="<?php if(!empty($mycoupon['enough'])): ?><?php echo $mycoupon['enough']; endif; ?>">
                                        </div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">加入领券中心</label>
					<div class="layui-input-block">
						<input type="radio" name="gettype" value="0" lay-filter="gettype" title="不加入" <?php if(!empty($mycoupon['gettype'])): if($mycoupon['gettype'] == 0): ?>checked=""<?php endif; endif; ?>><div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i><span>立减</span></div>
						<input type="radio" name="gettype" value="1" lay-filter="gettype" title="加入" <?php if(!empty($mycoupon['gettype'])): if($mycoupon['gettype'] == 1): ?>checked=""<?php endif; else: ?>checked=""<?php endif; ?>><div class="layui-unselect layui-form-radio layui-form-radioed"><i class="layui-anim layui-icon"></i><span>打折</span></div>
					</div>

				</div>
				<div class="layui-form-item" ID="uid" class="uid" <?php if(!empty($mycoupon['uid'])): ?>style="display:inline;"<?php else: ?>style="display:none;"<?php endif; ?>>
				<label class="layui-form-label">用户的ID</label>
					<div class="layui-input-block">
						<input type="text" name="uid" id="uid_input"  autocomplete="off" class="layui-input"  placeholder="请输入用户的ID" value="<?php if(!empty($mycoupon['uid'])): ?><?php echo $mycoupon['uid']; endif; ?>">
					</div>
				</div>
<!--				<div class="layui-form-item">
					<label class="layui-form-label">使用限制</label>
					<div class="layui-input-block">
                                            <input type="text" name="limitgoodids"  autocomplete="off" class="layui-input" value="<?php if(!empty($mycoupon['limitgoodids'])): ?><?php echo $mycoupon['limitgoodids']; endif; ?>">
                                        </div>
				</div>-->
				<div class="layui-form-item">
					<label class="layui-form-label">发放总数</label>
					<div class="layui-input-block">
                                            <input type="text" name="total"  autocomplete="off" class="layui-input" value="<?php if(!empty($mycoupon['total'])): ?><?php echo $mycoupon['total']; endif; ?>">
                                        </div>
				</div>
                                <div class="layui-form-item">
					<label class="layui-form-label">开始时间</label>
                                        <div class="layui-input-block">
                                            <div class="layui-input-inline">
                                                <input class="layui-input" placeholder="开始显示时间，不填为一直显示" value="<?php if(!empty($mycoupon['stime'])): ?><?php echo $mycoupon['stime']; endif; ?>" name="stime" id="LAY_demorange_s">
                                            </div>
                                        </div>
                                </div>
                                <div class="layui-form-item">
					<label class="layui-form-label">结束时间</label>
                                        <div class="layui-input-block">
                                            <div class="layui-input-inline">
                                                <input class="layui-input" placeholder="结束显示时间，不填为一直显示" value="<?php if(!empty($mycoupon['etime'])): ?><?php echo $mycoupon['etime']; endif; ?>" name="etime" id="LAY_demorange_e">
                                            </div>
                                        </div>
                                </div>
				<div class="layui-form-item">
					<label class="layui-form-label">缩略图</label>
					<div class="layui-input-block">
						<input type="file" name="file" class="layui-upload-file">
                                                <img style="width: 36px;height: 36px;" class="myimg" src="<?php if(!empty($mycoupon['thumb'])) echo imgUrl($mycoupon['thumb']);else echo imgUrl('') ?>">
                                                <input type="text"  class="avatar layui-input-block" style="padding-left: 10px;width: 50%;margin-left: 10px;" name="thumb" value="<?php if(!empty($mycoupon['thumb'])): ?><?php echo $mycoupon['thumb']; endif; ?>" >
                                        </div>
				</div>

				<div class="layui-form-item layui-form-text">
					<label class="layui-form-label">使用说明</label>
					<div class="layui-input-block">
                                            <textarea name="desc" id='content' placeholder="" class="layui-textarea"><?php if(!empty($mycoupon['desc'])): ?><?php echo $mycoupon['desc']; endif; ?></textarea>
					</div>
				</div>
                                <div class="layui-form-item">
					<label class="layui-form-label">状态</label>
					<div class="layui-input-block">
						<input type="radio" name="status" value="1" title="启用" <?php if(!empty($mycoupon['status'])): if($mycoupon['status'] == 1): ?>checked=""<?php endif; else: ?>checked=""<?php endif; ?>><div class="layui-unselect layui-form-radio layui-form-radioed"><i class="layui-anim layui-icon"></i><span>上架</span></div>
						<input type="radio" name="status" value="0" title="关闭" <?php if(!empty($mycoupon['status'])): if($mycoupon['status'] == 0): ?>checked=""<?php endif; endif; ?>><div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i><span>下架</span></div>
					</div>
				</div>
                                <div class="layui-form-item">
					<label class="layui-form-label">使用限制</label>
					<div class="layui-input-block">
						<input type="radio" name="islimit" lay-filter="islimit" value="0" title="不限制" <?php if(!empty($mycoupon['islimit'])): if($mycoupon['islimit'] == 0): ?>checked=""<?php endif; else: ?>checked=""<?php endif; ?>><div class="layui-unselect layui-form-radio layui-form-radioed"><i class="layui-anim layui-icon"></i><span>不限制</span></div>
						<input type="radio" name="islimit" lay-filter="islimit" value="1" title="限商品分类" <?php if(!empty($mycoupon['islimit'])): if($mycoupon['islimit'] == 1): ?>checked=""<?php endif; endif; ?>><div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i><span>限商品分类</span></div>
						<input type="radio" name="islimit" lay-filter="islimit" value="2" title="限商品ID" <?php if(!empty($mycoupon['islimit'])): if($mycoupon['islimit'] == 2): ?>checked=""<?php endif; endif; ?>><div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i><span>限商品ID</span></div>
					</div>
				</div>
				<div class="layui-form-item" ID="limitid" <?php if(!empty($mycoupon['islimit'])): if($mycoupon['islimit'] == 0): ?>style="display:none;"<?php endif; else: ?>style="display:none;"<?php endif; ?>>
					<label class="layui-form-label">允许的ID</label>
					<div class="layui-input-block">
						<input type="text" name="limitid" id="limitid_input"  autocomplete="off" class="layui-input"  placeholder="请输入限制使用的ID" value="<?php if(!empty($mycoupon['limitid'])): ?><?php echo $mycoupon['limitid']; endif; ?>">
					</div>
				</div>
				<div class="layui-form-item">
					<div class="layui-input-block">
						<button type="button" class="layui-btn" onclick='coupon_add()'>立即提交</button>
						<button type="reset" class="layui-btn layui-btn-primary">重置</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>
<script type="text/javascript" src="/static/common/layui/layui.js"></script>
<script type="text/javascript" src="/static/js/jquery.min.js"></script>
<script type="text/javascript">
	layui.use(['form','upload'],function(){
         var form = layui.form();
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
         form.on('radio(islimit)', function(data){

            //console.log(data.value); //被点击的radio的value值
            if(data.value==0){
                $("#limitid").hide();
            }else if(data.value==1){
                $("#limitid").show();
                $("#limitid_input").attr("placeholder","请输入只限使用的商品分类ID");
            }else if(data.value==2){
                $("#limitid").show();
                $("#limitid_input").attr("placeholder","请输入只限使用的商品ID");
            }
        });
        form.on('radio(gettype)', function(res){
           //console.log(data.value); //被点击的select的value值
            if(res.value==1){
                $("#uid").show();
            }else{
                $("#uid").hide();
            }
            if(res.value==0){
                $("#uid").show();
            }else{
                $("#uid").hide();
            }

        });
	});




function coupon_add(){  //
        $.ajax({
            type: 'POST',
            url: '/back/addons/couponadd',
            data:$('#yourformid').serialize(),
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

<script>
layui.use('laydate', function(){
  var laydate = layui.laydate;

  var start = {
    min: 0
    ,max: '2099-06-16 23:59:59'
    ,istoday: true
    ,istime: true
    ,choose: function(datas){
      end.min = datas; //开始日选好后，重置结束日的最小日期
      end.start = datas //将结束日的初始值设定为开始日
    }
  };
  
  var end = {
    min: 0
    ,max: '2099-06-16 23:59:59'
    ,istoday: true
    ,istime: true
    ,choose: function(datas){
      start.max = datas; //结束日选好后，重置开始日的最大日期
    }
  };
   var options =
    {
      elem: '#id', //需显示日期的元素选择器
      event: 'click', //触发事件
      format: 'YYYY-MM-DD hh:mm:ss', //日期格式
      istime: true, //是否开启时间选择
      isclear: true, //是否显示清空
      istoday: true, //是否显示今天
      issure: true, //是否显示确认
      festival: true, //是否显示节日
      min: '1900-01-01 00:00:00', //最小日期
      max: '2099-12-31 23:59:59', //最大日期
      start: '2014-6-15 23:00:00',  //开始日期
      fixed: false, //是否固定在可视区域
      zIndex: 99999999, //css z-index
      choose: function(dates){ //选择好日期的回调

      }
    }
  document.getElementById('LAY_demorange_s').onclick = function(){
    options.elem = this;
    laydate(options);
  }
  document.getElementById('LAY_demorange_e').onclick = function(){
    options.elem = this;
    laydate(options);
  }
  
});
</script>
<script>
    
      
    
</script>
</body>
</html>