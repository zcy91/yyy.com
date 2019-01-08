<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:73:"D:\wamp64\www\yyy.com\public/../application/back\view\goods\goodsadd.html";i:1532921427;}*/ ?>
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
        
        <!--百度编辑器-->
        <link href="/server/umeditor/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
        <script type="text/javascript" src="/server/umeditor/third-party/jquery.min.js"></script>
        <script type="text/javascript" src="/server/umeditor/third-party/template.min.js"></script>
        <script type="text/javascript" charset="utf-8" src="/server/umeditor/umeditor.config.js"></script>
        <script type="text/javascript" charset="utf-8" src="/server/umeditor/umeditor.js"></script>
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
    </style>
    
    <!--百度编辑器-->
</head>
<body>
<section class="layui-larry-box">
	<div class="larry-personal">
		<header class="larry-personal-tit">
			<span>添加商品</span>
		</header><!-- /header -->
		<div class="larry-personal-body clearfix">
			<form class="layui-form col-lg-5">
				<div class="layui-form-item">
					<label class="layui-form-label">商品名称</label>
					<div class="layui-input-block">
						<input type="text" name="gname"  autocomplete="off" class="layui-input" value="<?php if(!empty($mygoods['gname'])): ?><?php echo $mygoods['gname']; endif; ?>"  placeholder="输入商品名称">
						<input type="hidden" name="id" value="<?php if(!empty($mygoods['id'])): ?><?php echo $mygoods['id']; endif; ?>" >
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">商品分类</label>
					<div class="layui-input-block">
                                            <select name="type" id='goodstype' lay-filter="aihao">
                                                            <option value="0" >选择分类</option>
							<?php if(is_array($classify) || $classify instanceof \think\Collection || $classify instanceof \think\Paginator): $i = 0; $__LIST__ = $classify;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                                            <option value="<?php echo $vo['id']; ?>" <?php if(!empty($mygoods['type']) && $vo['id']==$mygoods['type']): ?> selected="selected"<?php endif; ?>><?php echo $vo['name']; ?></option>
                                                        <?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
					</div>
				</div>
                                <div class="layui-form-item">
					<label class="layui-form-label">排序</label>
					<div class="layui-input-block">
						<input type="text" name="sort"  autocomplete="off" class="layui-input" value="<?php if(!empty($mygoods['sort'])): ?><?php echo $mygoods['sort']; else: ?>50<?php endif; ?>">
					</div>
				</div>
                                <div class="layui-form-item">
					<label class="layui-form-label">所属商城</label>
					<div class="layui-input-block">
						<input type="radio"  lay-filter="shoptype" name="shoptype" value="1" title="羊羔商城" <?php if(!empty($mygoods['shoptype'])): if($mygoods['shoptype'] == 1): ?>checked=""<?php endif; else: ?>checked=""<?php endif; ?>><div class="layui-unselect layui-form-radio layui-form-radioed"><i class="layui-anim layui-icon"></i><span>羊羔商城</span></div>
						<input type="radio"  lay-filter="shoptype" name="shoptype" value="2" title="积分商城" <?php if(!empty($mygoods['shoptype'])): if($mygoods['shoptype'] == 2): ?>checked=""<?php endif; endif; ?>><div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i><span>积分商城</span></div>
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">购买方式</label>
					<div class="layui-input-block">
						<span id="money">
						<input type="radio"   lay-filter="buytype" name="buytype" value="1" title="金额购买" <?php if(!empty($mygoods['buytype'])): if($mygoods['buytype'] == 1): ?>checked=""<?php endif; else: ?>checked=""<?php endif; ?>>
							<div class="layui-unselect layui-form-radio layui-form-radioed lsmbshop">
								<i class="layui-anim layui-icon"></i>
								<span>羊羔商城</span>
							</div>
						</span>
						<span id="inte">
						<input type="radio"  lay-filter="buytype" name="buytype" value="2" title="积分购买" <?php if(!empty($mygoods['buytype'])): if($mygoods['buytype'] == 2): ?>checked=""<?php endif; endif; ?>>
						<div class="layui-unselect layui-form-radio integralshop"><i class="layui-anim layui-icon"></i><span>积分商城</span></div>
						</span>
						<!--<input type="radio"  lay-filter="buytype" name="buytype" value="3" title="金额加积分" <?php if(!empty($mygoods['buytype'])): if($mygoods['buytype'] == 3): ?>checked=""<?php endif; endif; ?>><div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i><span>积分商城</span></div>-->
					</div>
				</div>
				<div class="layui-form-item nointegralshop lsmbshop" <?php if((!empty($mygoods['shoptype']) && $mygoods['shoptype']==1) or empty($mygoods['shoptype'])): else: ?>style="display:none;"<?php endif; ?>>
					<label class="layui-form-label">价格</label>
					<div class="layui-input-block">
                                            <input type="text" name="price"  placeholder="请输入价格"  autocomplete="off" class="layui-input" value="<?php if(!empty($mygoods['price'])): ?><?php echo $mygoods['price']; endif; ?>">
                                        </div>
				</div>
				<div class="layui-form-item integralshop ">
					<label class="layui-form-label">积分价</label>
					<div class="layui-input-block">
                                            <input type="text" name="price2"  placeholder="请输入积分价"  autocomplete="off" class="layui-input" value="<?php if(!empty($mygoods['price2'])): ?><?php echo $mygoods['price2']; endif; ?>">
                                        </div>
				</div>
				<div class="layui-form-item lsmbshop" <?php if((!empty($mygoods['shoptype']) && $mygoods['shoptype']==1) or empty($mygoods['shoptype'])): else: ?>style="display:none;"<?php endif; ?>>
					<label class="layui-form-label">年化率</label>
					<div class="layui-input-block">
                                            <input type="text" name="percentage"  placeholder="请输入年化率，不用输百分号"  autocomplete="off" class="layui-input" value="<?php if(!empty($mygoods['percentage'])): ?><?php echo $mygoods['percentage']; endif; ?>">
                                        </div>
				</div>
				<div class="layui-form-item lsmbshop" <?php if((!empty($mygoods['shoptype']) && $mygoods['shoptype']==1) or empty($mygoods['shoptype'])): else: ?>style="display:none;"<?php endif; ?>>
					<label class="layui-form-label">周期</label>
					<div class="layui-input-block">
                                            <input type="text" name="cycle"   placeholder="请输入周期天数"  autocomplete="off" class="layui-input" value="<?php if(!empty($mygoods['cycle'])): ?><?php echo $mygoods['cycle']; endif; ?>">
                                        </div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">限购</label>
					<div class="layui-input-block">
                                            <input type="text" name="limitnum"   placeholder="请输入限购数量，不填或0为不限购"    autocomplete="off" class="layui-input" value="<?php if(!empty($mygoods['limitnum'])): ?><?php echo $mygoods['limitnum']; endif; ?>">
                                        </div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">购买送积分</label>
					<div class="layui-input-block">
                                            <input type="text" name="integral"  placeholder="请输入购买该商品后赠送的积分数量" autocomplete="off" class="layui-input" value="<?php if(!empty($mygoods['integral'])): ?><?php echo $mygoods['integral']; endif; ?>">
                                        </div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">库存</label>
					<div class="layui-input-block">
                                            <input type="text" name="stock" placeholder="请输入商品库存，如果是羊羔，将是对应生成耳标的数量" autocomplete="off" class="layui-input" value="<?php if(!empty($mygoods['stock'])): ?><?php echo $mygoods['stock']; endif; ?>">
                                        </div>
				</div>
                                <div class="layui-form-item">
					<label class="layui-form-label">上架时间</label>
                                        <div class="layui-input-block">
                                            <div class="layui-input-inline">
                                                <input class="layui-input" placeholder="上架时间，不填为即时上架" value="<?php if(!empty($mygoods['shelftime'])): ?><?php echo $mygoods['shelftime']; endif; ?>" name="shelftime" id="LAY_demorange_s">
                                            </div>
                                        </div>
                                </div>
                                <div class="layui-form-item">
					<label class="layui-form-label">开始显示时间</label>
                                        <div class="layui-input-block">
                                            <div class="layui-input-inline">
                                                <input class="layui-input" placeholder="开始显示时间，不填为一直显示" value="<?php if(!empty($mygoods['showtime'])): ?><?php echo $mygoods['showtime']; endif; ?>" name="showtime" id="showtime">
                                            </div>
                                        </div>
                                </div>
                                <div class="layui-form-item">
					<label class="layui-form-label">结束显示时间</label>
                                        <div class="layui-input-block">
                                            <div class="layui-input-inline">
                                                <input class="layui-input" placeholder="结束显示时间，不填为一直显示" value="<?php if(!empty($mygoods['hidetime'])): ?><?php echo $mygoods['hidetime']; endif; ?>" name="hidetime" id="hidetime">
                                            </div>
                                        </div>
                                </div>
				<div class="layui-form-item">
					<label class="layui-form-label">商品图片</label>
					<div class="layui-input-block">
						<input type="file" name="file" class="layui-upload-file">
                                                <img style="width: 36px;height: 36px;" class="myimg" src="<?php if(!empty($mygoods['img'])) echo imgUrl($mygoods['img']);else echo imgUrl('') ?>">
                                                <input type="text"  class="avatar layui-input-block" style="padding-left: 10px;width: 50%;margin-left: 10px;" name="img" value="<?php if(!empty($mygoods['img'])): ?><?php echo $mygoods['img']; endif; ?>" >
                                        </div>
				</div>

<!--				<div class="layui-form-item layui-form-text">
					<label class="layui-form-label">商品详情</label>
					<div class="layui-input-block">
                                            <textarea name="content" id='content' placeholder="" class="layui-textarea"><?php if(!empty($mygoods['content'])): ?><?php echo $mygoods['content']; endif; ?></textarea>
					</div>
				</div>-->
                                <div class="layui-form-item">
					<label class="layui-form-label">商品详情</label>
					<div class="layui-input-block">
                                            <!--<textarea name="content" placeholder="既然选择了远方，便只顾风雨兼程；路漫漫其修远兮，吾将上下而求索" value="" class="layui-textarea"><?php if(!empty($myarticle['content'])): ?><?php echo $myarticle['content']; endif; ?></textarea>-->
                                            <script type="text/plain" name="content"  id="myEditor" style="width:1000px;height:240px;"><?php if(!empty($mygoods['content'])): ?><?php echo $mygoods['content']; else: endif; ?></script>
                                        </div>
				</div>
                                
                                <div class="layui-form-item">
					<label class="layui-form-label">是否上架</label>
					<div class="layui-input-block">
						<input type="radio" name="status" value="1" title="启用" <?php if(!empty($mygoods['status'])): if($mygoods['status'] == 1): ?>checked=""<?php endif; else: ?>checked=""<?php endif; ?>><div class="layui-unselect layui-form-radio layui-form-radioed"><i class="layui-anim layui-icon"></i><span>上架</span></div>
						<input type="radio" name="status" value="0" title="关闭" <?php if(!empty($mygoods)): if($mygoods['status'] == 0): ?>checked=""<?php endif; endif; ?>><div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i><span>下架</span></div>
					</div>
				</div>
                                <div class="layui-form-item <?php if(empty($mygoods)): ?>lsmbshop<?php endif; ?>" <?php if(!empty($mygoods)): ?> style="display:none;"<?php endif; if((!empty($mygoods['shoptype']) && $mygoods['shoptype']==1) or empty($mygoods['shoptype'])): else: ?>style="display:none;"<?php endif; ?>>
					<label class="layui-form-label">是否生成羊羔</label>
					<div class="layui-input-block">
						<input type="radio" name="make" value="1" title="生成" checked=""><div class="layui-unselect layui-form-radio layui-form-radioed"><i class="layui-anim layui-icon"></i><span>生成</span></div>
						<input type="radio" name="make" value="0" title="不生成"  ><div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i><span>不生成</span></div>
					</div>
				</div>
                                <div class="layui-form-item <?php if(empty($mygoods)): ?>lsmbshop<?php endif; ?>"  <?php if(!empty($mygoods)): ?> style="display:none;"<?php endif; if((!empty($mygoods['shoptype']) && $mygoods['shoptype']==1) or empty($mygoods['shoptype'])): else: ?>style="display:none;"<?php endif; ?>>
					<label class="layui-form-label">生成羊羔前缀</label>
					<div class="layui-input-block">
											<input type="text" name="lambprefix"  placeholder="请输入羊标前缀，例如：SN3,如果不填，系统默认前缀"   autocomplete="off" class="layui-input" value="">
					</div>
				</div>
                                
				
				<div class="layui-form-item">
					<div class="layui-input-block">
						<button type="button" class="layui-btn" onclick='goods_add()'>立即提交</button>
						<button type="reset" class="layui-btn layui-btn-primary">重置</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>
	<input type="hidden" value="<?php if(!empty($mygoods)): ?>$mygoods<?php endif; ?>" id='goods'>
<script  type="text/javascript" src="/static/common/layui/layui.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        var mygoods = $("#goods").val();
		if(mygoods){
            if(mygoods.status == 1){
                $(".lsmbshop").show();
                $(".integralshop").hide();
            }else if(mygoods.status == 2){
                $(".lsmbshop").hide();
                $(".integralshop").show();
            }
		}else{
            $(".lsmbshop").show();
            $(".integralshop").hide();
		}

        // $(".lsmbshop").show();
        // $(".integralshop").hide();
	})
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

	});
        //单选商城时显示不同的内容
        
layui.use(['form','upload'],function(){
         var form = layui.form();
//         form.on('select(catid)', function(data){
//            console.log(data.value); //被点击的select的value值
//            if(data.value==1){
//                $("#lambid").show();
//            }else{
//                $("#lambid").hide();
//            }
//        });  
         form.on('radio(shoptype)', function(data){
            console.log(data.value); //被点击的select的value值
            if(data.value==1){
                $(".lsmbshop").show();
            }else{
                $(".lsmbshop").hide();
            }
            if(data.value==2){
                $(".integralshop").show();
                $(".nointegralshop").hide();
            }else{
                $(".integralshop").hide();
            }
            
        });  
        
	});
function goods_add(){  //
    var id=$("input[name='id']").val();
    var gname=$("input[name='gname']").val();
    var type=$("#goodstype").val();
    var sort=$("input[name='sort']").val();
    var price=$("input[name='price']").val();
    var price2=$("input[name='price2']").val();
    var percentage=$("input[name='percentage']").val();
    var cycle=$("input[name='cycle']").val();
    var limitnum=$("input[name='limitnum']").val();
    var stock=$("input[name='stock']").val();
    var img=$("input[name='img']").val();
    var shelftime=$("input[name='shelftime']").val();
    var showtime=$("input[name='showtime']").val();
    var hidetime=$("input[name='hidetime']").val();
    var integral=$("input[name='integral']").val();
    var shoptype=$('input:radio[name="shoptype"]:checked').val();
    var buytype=$('input:radio[name="buytype"]:checked').val();
    var lambprefix=$("input[name='lambprefix']").val();
    var content=$("#myEditor").html();
    var status=$('input:radio[name="status"]:checked').val();
    var make=$('input:radio[name="make"]:checked').val();
  
        $.ajax({
            type: 'POST',
            url: '/back/goods/goodsadd',
            data:{
              id:id,
              gname:gname,
              type:type,
              sort:sort,
              price:price,
              price2:price2,
              percentage:percentage,
              cycle:cycle,
              limitnum:limitnum,
              stock:stock,
              img:img,
              content:content,
              shelftime:shelftime,
              hidetime:hidetime,
              showtime:showtime,
              integral:integral,
              shoptype:shoptype,
              buytype:buytype,
              status:status,
              lambprefix:lambprefix,
              make:make,
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
   var hides =
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
   var shows =
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
  document.getElementById('hidetime').onclick = function(){
    hides.elem = this
    laydate(hides);
  }
  document.getElementById('showtime').onclick = function(){
    shows.elem = this
    laydate(shows);
  }
  
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
</body>
</html>