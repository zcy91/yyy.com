<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:71:"E:\phpStudy\WWW\yyy.com\public/../application/back\view\index\main.html";i:1512525618;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>LarryBlogCMS-Home</title>
  <meta name="renderer" content="webkit"> 
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> 
  <meta name="apple-mobile-web-app-status-bar-style" content="black"> 
  <meta name="apple-mobile-web-app-capable" content="yes">  
  <meta name="format-detection" content="telephone=no"> 
	<link rel="stylesheet" type="text/css" href="/static/common/layui/css/layui.css" media="all">
	<link rel="stylesheet" type="text/css" href="/static/common/bootstrap/css/bootstrap.css" media="all">
	<link rel="stylesheet" type="text/css" href="/static/common/global.css">
	<link rel="stylesheet" type="text/css" href="/static/css/main.css" media="all">
</head>
<body>
<section class="larry-wrapper">
    <!-- overview -->
	<div class="row state-overview">
		<div class="col-lg-3 col-sm-6">
			<section class="panel">
				<div class="symbol userblue"> <i class="iconpx-users"></i>
				</div>
				<div class="value">
					<a href="#">
						<h1 id="count1"><?php echo $usernum; ?></h1>
					</a>
					<p>用户总量</p>
				</div>
			</section>
		</div>
		<div class="col-lg-3 col-sm-6">
			<section class="panel">
				<div class="symbol commred"> <i class="iconpx-user-add"></i>
				</div>
				<div class="value">
					<a href="#">
						<h1 id="count2"><?php echo $onedaynum; ?></h1>
					</a>
					<p>今日注册用户</p>
				</div>
			</section>
		</div>
		<div class="col-lg-3 col-sm-6">
			<section class="panel">
				<div class="symbol articlegreen">
					<i class="iconpx-file-word-o"></i>
				</div>
				<div class="value">
					<a href="#">
						<h1 id="count3"><?php echo $articlenum; ?></h1>
					</a>
					<p>文章总数</p>
				</div>
			</section>
		</div>
		<div class="col-lg-3 col-sm-6">
			<section class="panel">
				<div class="symbol rsswet">
					<i class="iconpx-check-circle"></i>
				</div>
				<div class="value">
					<a href="#">
						<h1 id="count4"><?php echo $statusnum; ?></h1>
					</a>
					<p>待审文章总数</p>
				</div>
			</section>
		</div>
	</div>
	<!-- overview end -->
	<div class="row">
		<div class="col-lg-6">
			<section class="panel">
				<header class="panel-heading bm0">
					<span class='span-title'>系统概览</span>
					<span class="tools pull-right"><a href="javascript:;" class="iconpx-chevron-down"></a></span>
				</header>
				<div class="panel-body" >
					<table class="table table-hover personal-task">
                         <tbody>
                         	<tr>
                         		<td>
                         			<strong>版本信息</strong>： 版本名称：<a href="http://oioos.com">展冠科技</a> 版本号: V01_UTF8_0.10

                         		</td>
                         		<td>

                         		</td>
                         	</tr>
                         	<tr>
                         		<td>
                                <strong>开发作者</strong>： 展冠科技

                                </td>
                                <td></td>
                         	</tr>
                         	<tr>
                         		<td>
                                <strong>网站域名</strong>：<?php echo $server['HTTP_HOST']; ?>
                                </td>
                                <td></td>
                         	</tr>
                         	<tr>
                         		<td>
                                <strong>网站目录</strong>：<?php echo $server['DOCUMENT_ROOT']; ?>
                                </td>
                                <td></td>
                         	</tr>
                         	<tr>
                         		<td>
                                <strong>服务器IP</strong>：<?php echo $server['REMOTE_ADDR']; ?>
                                </td>
                                <td></td>
                         	</tr>
                         	<tr>
                         		<td>
                                <strong>服务器环境</strong>：<?php echo $server['SERVER_SOFTWARE']; ?>
                                </td>
                                <td></td>
                         	</tr>
                         	<tr>
                         		<td>
                                <strong>数据库版本</strong>： MYSQL

                                </td>
                                <td></td>
                         	</tr>
                         	<tr>
                         		<td>
                                <strong>最大上传限制</strong>： 20M

                                </td>
                                <td></td>
                         	</tr>
                         	<tr>
                         		<td>
                                <strong>当前登录用户</strong>： <span class="current_user">admin</span>

                                </td>
                                <td></td>
                         	</tr>
                         </tbody>
					</table>
				</div>
			</section>
      <!-- 网站信息统计｛SEO数据统计｝ -->
      <section class="panel">
                  <header class="panel-heading bm0">
                       <span class='span-title'>网站信息统计｛SEO数据统计｝</span>
                       <span class="tools pull-right"><a href="javascript:;" class="iconpx-chevron-down"></a></span>
                  </header>
                  <div class="panel-body laery-seo-box">
                        <div class="larry-seo-stats" id="larry-seo-stats"></div>
                  </div>
      </section>
		</div>
		<div class="col-lg-6">
		     <!-- 快捷操作 -->
             <section class="panel">
                  <header class="panel-heading bm0">
                        <span class='span-title'>快捷操作</span>
                        <span class="tools pull-right"><a href="javascript:;" class="iconpx-chevron-down"></a></span>
                  </header>
                  <div class="panel-body">
                        <table class="table table-hover personal-task shortcut">
                            <tr>
                            	<td>
                            		<div class="c1">1</div>
                            		<div class="c2">2</div>
                            		<br>
                            	</td>
                            </tr>
                        </table>
                  </div>
             </section>
          <!-- 系统公告 -->
             <section class="panel">
                 <header class="panel-heading bm0">
                        <span class='span-title'>系统公告</span>
                        <span class="tools pull-right"><a href="javascript:;" class="iconpx-chevron-down"></a></span>
                  </header>
                  <div class="panel-body">
                        <table class="table table-hover personal-task shortcut">
                            <tr>
                              <td>
                                <div class="c1">1</div>
                                <div class="c2">2</div>
                                <br>
                              </td>
                            </tr>
                        </table>
                  </div>
             </section>

              <!-- 最新文章 -->
             <section class="panel">
                  <header class="panel-heading bm0">
                        <span class='span-title'>最新文章</span>
                        <span class="badge" style="background-color:#FF3333;"> new </span>
                        <span class="tools pull-right"><a href="javascript:;" class="iconpx-chevron-down"></a></span>
                  </header>
                  <div class="panel-body">
                       <table class="table table-hover personal-task">
                             <tbody>
                              <?php if(is_array($articlenew) || $articlenew instanceof \think\Collection || $articlenew instanceof \think\Paginator): $i = 0; $__LIST__ = $articlenew;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                              <tr>
                                <td>原创</td>
                                <td>
                                  <a href="#" target="_blank"><?php echo $vo['title']; ?></a>
                                </td>
                                <td class="col-md-5">阅读量：<?php echo $vo['hits']; ?> &nbsp;&nbsp;&nbsp;&nbsp; <?php echo date("Y-m-d H:i",$vo['createtime']); ?></td>
                              </tr>
                              <?php endforeach; endif; else: echo "" ;endif; ?>
                             </tbody>
                       </table>
                  </div>
             </section>
		</div>
	</div>

</section>

<script type="text/javascript" src="/static/common/layui/layui.js"></script>
<script type="text/javascript">
	layui.use(['jquery','layer','element'],function(){
		window.jQuery = window.$ = layui.jquery;
		window.layer = layui.layer;
        window.element = layui.element();

       $('.panel .tools .iconpx-chevron-down').click(function(){
       	   var el = $(this).parents(".panel").children(".panel-body");
       	   if($(this).hasClass("iconpx-chevron-down")){
       	   	   $(this).removeClass("iconpx-chevron-down").addClass("iconpx-chevron-up");
       	   	   el.slideUp(200);
       	   }else{
       	   	   $(this).removeClass("iconpx-chevron-up").addClass("iconpx-chevron-down");
       	   	   el.slideDown(200);
       	   }
       })

	});
</script>
<script type="text/javascript" src="/static/jsplug/echarts.min.js"></script>
<script type="text/javascript" src="/static/js/main.js"></script>
</body>
</html>