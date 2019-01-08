<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:77:"/home/wwwroot/yang.oioos.com/public/../application/back/view/index/index.html";i:1525941828;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>展冠后台管理系统</title>
	<meta name="renderer" content="webkit">	
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">	
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">	
	<meta name="apple-mobile-web-app-status-bar-style" content="black">	
	<meta name="apple-mobile-web-app-capable" content="yes">	
	<meta name="format-detection" content="telephone=no">	
	<!-- load css -->
	<link rel="stylesheet" type="text/css" href="/static/common/layui/css/layui.css" media="all">
	<link rel="stylesheet" type="text/css" href="/static/common/global.css" media="all">
	<link rel="stylesheet" type="text/css" href="/static/css/adminstyle.css" media="all">
</head>
<body>
<div class="layui-layout layui-layout-admin" id="layui_layout">
	<!-- 顶部区域 -->
	<div class="layui-header header header-demo">
		<div class="layui-main">
		    <!-- logo区域 -->
			<div class="admin-logo-box">
				<a class="logo" href="/" title="logo"><img src="/static/common/images/logo.png" alt=""></a>
				<div class="larry-side-menu">
					<i class="fa fa-bars" aria-hidden="true"></i>
				</div>
			</div>
            <!-- 顶级菜单区域 -->
            <div class="layui-larry-menu">
                 <ul class="layui-nav clearfix">
                       <li class="layui-nav-item layui-this">
                 	   	   <a href="javascirpt:;"><i class="iconfont icon-wangzhanguanli"></i>内容管理</a>
                 	   </li>
<!--                 	   <li class="layui-nav-item">
                 	   	   <a href="javascirpt:;"><i class="iconfont icon-weixin3"></i>微信公众</a>
                 	   </li>
                 	   <li class="layui-nav-item">
                 	   	   <a href="javascirpt:;"><i class="iconfont icon-ht_expand"></i>扩展模块</a>
                 	   </li>-->
                 </ul>
            </div>
            <!-- 右侧导航 -->
            <ul class="layui-nav larry-header-item">
            		<li class="layui-nav-item first">
						<a href="javascript:;">
							<img src="/static/images/userimg.jpg" class="userimg">			
							<cite>默认站点</cite>
							<span class="layui-nav-more"></span>
						</a>
						<dl class="layui-nav-child">
							<dd>
								<a href="/">访问前台</a>
							</dd>
							
						</dl>
					</li>
					<li class="layui-nav-item">
						<a href="javascript:;" id="lock">
                        <i class="iconfont icon-diannao1"></i>
						锁屏</a>
					</li>
					<li class="layui-nav-item">
						<a href="/back/login/login?exit=1">
                        <i class="iconfont icon-exit"></i>
						退出</a>
					</li>
            </ul>
		</div>
	</div>
	<!-- 左侧侧边导航开始 -->
	<div class="layui-side layui-side-bg layui-larry-side" id="larry-side">
        <div class="layui-side-scroll" id="larry-nav-side" lay-filter="side">
		<div class="user-photo">
			<a class="img" title="我的头像" >
				<img src="/static/images/user.jpg" class="userimg1"></a>
			<p>你好！admin, 欢迎登录</p>
		</div>
		<!-- 左侧菜单 -->
		<ul class="layui-nav layui-nav-tree">
			<li class="layui-nav-item layui-this">
				<a href="javascript:;" data-url="index/main.html">
				    <i class="iconfont icon-home1" data-icon='icon-home1'></i>
					<span>后台首页</span>
				</a>
			</li>
			<!-- 个人信息 -->
			<li class="layui-nav-item" <?php echo module_display('admin',$power,$admininfo['level_id']); ?>>
				<a href="javascript:;">
					<i class="iconfont icon-jiaoseguanli" ></i>
					<span>我的面板</span>
					<em class="layui-nav-more"></em>
				</a>
				<dl class="layui-nav-child">
                                <dd  <?php echo module_display('admin&index',$power,$admininfo['level_id']); ?>>
                                    <a href="javascript:;" data-url="admin/index.html">
                                        <i class="iconfont icon-geren1" data-icon='icon-geren1'></i>
                                        <span>个人信息</span>
                                    </a>
                                </dd>
                                <dd  <?php echo module_display('admin&changepwd',$power,$admininfo['level_id']); ?>>
                                    <a href="javascript:;" data-url="admin/changepwd.html">
                                        <i class="iconfont icon-iconfuzhi01" data-icon='icon-iconfuzhi01'></i>
                                        <span>修改密码</span>
                                    </a>
                                </dd>
                                <dd  <?php echo module_display('admin&adminlist',$power,$admininfo['level_id']); ?>>
                                        <a href="javascript:;" data-url="admin/adminlist.html">
                                           <i class="iconfont icon-yonghu1" data-icon='icon-yonghu1'></i>
                                           <span>管理员列表</span>
                                        </a>
                                </dd>
                                <dd  <?php echo module_display('admin&adminlevel',$power,$admininfo['level_id']); ?>>
                                    <a href="javascript:;" data-url="admin/adminlevel.html">
                                        <i class="iconfont icon-piliangicon" data-icon='icon-piliangicon'></i>
                                        <span>权限管理</span>
                                    </a>
                                </dd>
                            </dl>
			</li>
			<!-- 用户管理 -->
			<li class="layui-nav-item" <?php echo module_display('user',$power,$admininfo['level_id']); ?>>
					<a href="javascript:;">
					   <i class="iconfont icon-jiaoseguanli2" ></i>
					   <span>用户管理</span>
					   <em class="layui-nav-more"></em>
					</a>
					    <dl class="layui-nav-child">
					    	<dd  <?php echo module_display('user&userlist',$power,$admininfo['level_id']); ?>>
					    		<a href="javascript:;" data-url="user/userlist.html">
					    		   <i class="iconfont icon-yonghu1" data-icon='icon-yonghu1'></i>
					    		   <span>用户列表</span>
					    		</a>
					    	</dd>
					    	<dd  <?php echo module_display('user&userlevel',$power,$admininfo['level_id']); ?>>
					    		<a href="javascript:;" data-url="user/userlevel">
					    		   <i class="iconfont icon-jiaoseguanli4" data-icon='icon-jiaoseguanli4'></i>
					    		   <span>等级列表</span>
					    		</a>
					    	</dd>
					    	<dd  <?php echo module_display('user&addresslist',$power,$admininfo['level_id']); ?>>
					    		<a href="javascript:;" data-url="user/addresslist">
					    		   <i class="iconfont icon-diannao1" data-icon='icon-diannao1'></i>
					    		   <span>地址管理</span>
					    		</a>
					    	</dd>
					    	<dd  <?php echo module_display('user&agentlist',$power,$admininfo['level_id']); ?>>
					    		<a href="javascript:;" data-url="user/agentlist">
					    		   <i class="iconfont icon-diannao1" data-icon='icon-diannao1'></i>
					    		   <span>分销管理</span>
					    		</a>
					    	</dd>
					    </dl>
			    </li>
			<!-- 内容管理 -->
			<li class="layui-nav-item"  <?php echo module_display('article',$power,$admininfo['level_id']); ?>>
					<a href="javascript:;">
					   <i class="iconfont icon-wenzhang1" ></i>
					   <span>内容管理</span>
					   <em class="layui-nav-more"></em>
					</a>
					   <dl class="layui-nav-child">
						   <dd <?php echo module_display('article&tourlist',$power,$admininfo['level_id']); ?>>
						   <a href="javascript:;"   data-url="article/tourlist.html">
							   <i class="iconfont icon-wenzhang2" data-icon='icon-wenzhang2'></i>
							   <span>旅游列表</span>
						   </a>
						   </dd>
						   <dd <?php echo module_display('article&tourtype',$power,$admininfo['level_id']); ?>>
						   <a href="javascript:;"   data-url="article/tourtype.html">
							   <i class="iconfont icon-zhuti" data-icon='icon-zhuti'></i>
							   <span>旅游线路</span>
						   </a>
						   </dd>
					   	<dd <?php echo module_display('article&articlelist',$power,$admininfo['level_id']); ?>>
					    		<a href="javascript:;"   data-url="article/articlelist.html">
					    		   <i class="iconfont icon-wenzhang2" data-icon='icon-wenzhang2'></i>
					    		   <span>文章列表</span>
					    		</a>
					    	</dd>
					   	<dd <?php echo module_display('article&articletype',$power,$admininfo['level_id']); ?>>
					    		<a href="javascript:;"   data-url="article/articletype.html">
					    		   <i class="iconfont icon-zhuti" data-icon='icon-zhuti'></i>
					    		   <span>文章分类</span>
					    		</a>
					    	</dd>
					    	<dd <?php echo module_display('article&commentlist',$power,$admininfo['level_id']); ?>>
					    		<a href="javascript:;" data-url="article/commentlist">
					    		   <i class="iconfont icon-pinglun1" data-icon='icon-pinglun1'></i>
					    		   <span>评论管理</span>
					    		</a>
					    	</dd>
					    	<dd <?php echo module_display('article&adlist',$power,$admininfo['level_id']); ?>>
					    		<a href="javascript:;" data-url="article/adlist">
					    		   <i class="iconfont icon-xinxicaiji" data-icon='icon-xinxicaiji'></i>
					    		   <span>轮播广告</span>
					    		</a>
					    	</dd>
					    	
<!--					    	<dd>
					    		<a href="javascript:;" data-url="set/index">
					    		   <i class="iconfont icon-huishouzhan1" data-icon='icon-huishouzhan1'></i>
					    		   <span>内容回收站</span>
					    		</a>
					    	</dd>-->
					   </dl>
			   </li>
		 <!-- 商品管理-->
                 
                                    <li class="layui-nav-item" <?php echo module_display('goods',$power,$admininfo['level_id']); ?>>
					<a href="javascript:;">
					   <i class="layui-icon">&#xe600;</i>   
					   <span>商品管理</span>
					   <em class="layui-nav-more"></em>
					</a>
					<dl class="layui-nav-child">
                                                <dd <?php echo module_display('goods&classifylist',$power,$admininfo['level_id']); ?>>
                                                        <a href="javascript:;"   data-url="goods/classifylist.html">
                                                                           <i class="iconfont icon-zhuti"  data-icon='icon-zhuti'></i>
                                                                           <span>商品分类</span>
                                                                        </a>
                                                </dd>
                                                <dd <?php echo module_display('goods&goodslist',$power,$admininfo['level_id']); ?>>
                                                        <a href="javascript:;"  data-url="goods/goodslist.html">
                                                                           <i class="iconfont icon-zhuti"  data-icon='icon-zhuti'></i>
                                                                           <span>商品列表</span>
                                                                        </a>
                                                </dd>
                                                <dd <?php echo module_display('goods&lamblist',$power,$admininfo['level_id']); ?>>
                                                        <a href="javascript:;"  data-url="goods/lamblist.html">
                                                                           <i class="iconfont icon-zhuti"  data-icon='icon-zhuti'></i>
                                                                           <span>羊羔列表</span>
                                                                        </a>
                                                </dd>
                                                <dd <?php echo module_display('goods&videotype',$power,$admininfo['level_id']); ?>>
                                                        <a href="javascript:;"  data-url="goods/videotype.html">
                                                                           <i class="iconfont icon-zhuti"  data-icon='icon-zhuti'></i>
                                                                           <span>视频分类</span>
                                                                        </a>
                                                </dd>
                                                <dd <?php echo module_display('goods&lambvideo',$power,$admininfo['level_id']); ?>>
                                                        <a href="javascript:;"  data-url="goods/lambvideo.html">
                                                                           <i class="iconfont icon-zhuti"  data-icon='icon-zhuti'></i>
                                                                           <span>视频列表</span>
                                                                        </a>
                                                </dd>
                                                <dd <?php echo module_display('goods&selllamblist',$power,$admininfo['level_id']); ?>>
                                                        <a href="javascript:;"  data-url="goods/selllamblist.html">
                                                                           <i class="iconfont icon-zhuti"  data-icon='icon-zhuti'></i>
                                                                           <span>买卖羊羔</span>
                                                                        </a>
                                                </dd>
                                         </dl>
                                    </li>
                 <!-- 订单管理 -->
				<li class="layui-nav-item" <?php echo module_display('order',$power,$admininfo['level_id']); ?>>
					<a href="javascript:;">
					   <i class="iconfont icon-zhuti" ></i>
					   <span>订单管理</span>
					   <em class="layui-nav-more"></em>
					</a>
					<dl class="layui-nav-child">
                           <dd <?php echo module_display('order&orderlist',$power,$admininfo['level_id']); ?>>
                           	   <a href="javascript:;" data-url="order/orderlist.html">
					              <i class="iconfont icon-zhuti"  data-icon='icon-zhuti'></i>
					              <span>全部订单</span>
					           </a>
                           </dd>
                           <dd <?php echo module_display('order&orderlist',$power,$admininfo['level_id']); ?>>
                           	   <a href="javascript:;" data-url="order/orderlist.html?status=0">
					              <i class="iconfont icon-zhuti"  data-icon='icon-zhuti'></i>
					              <span>待付款</span>
					           </a>
                           </dd>
                           <dd <?php echo module_display('order&orderlist',$power,$admininfo['level_id']); ?>>
                           	   <a href="javascript:;" data-url="order/orderlist.html?status=1">
					              <i class="iconfont icon-zhuti"  data-icon='icon-zhuti'></i>
					              <span>已付款</span>
					           </a>
                           </dd>
                         <dd>
                           	   <a href="javascript:;" data-url="order/orderlist.html?status=2">
					              <i class="iconfont icon-zhuti"  data-icon='icon-zhuti'></i>
					              <span>待收货</span>
					           </a>
                           </dd>
                           <dd>
                           	   <a href="javascript:;" data-url="order/orderlist.html?status=3">
					              <i class="iconfont icon-zhuti"  data-icon='icon-zhuti'></i>
					              <span>完成</span>
					           </a>
                           </dd>
                           <dd <?php echo module_display('order&orderlist',$power,$admininfo['level_id']); ?>>
                           	   <a href="javascript:;" data-url="order/orderlist.html?status=4">
					              <i class="iconfont icon-zhuti"  data-icon='icon-zhuti'></i>
					              <span>关闭</span>
					           </a>
                           </dd>
                    </dl>
				</li>
				
				<li class="layui-nav-item" <?php echo module_display('capital',$power,$admininfo['level_id']); ?>>
					<a href="javascript:;">
					   <i class="iconfont icon-shengchengbaogao" ></i>
					   <span>资金明细</span>
					   <em class="layui-nav-more"></em>
					</a>
					   <dl class="layui-nav-child">
                           <dd <?php echo module_display('capital&withdrawals',$power,$admininfo['level_id']); ?>>
                           	   <a href="javascript:;" data-url="capital/withdrawals">
					              <i class="iconfont icon-zhuti"  data-icon='icon-zhuti'></i>
					              <span>提现申请</span>
					           </a>
                           </dd>
                           <dd <?php echo module_display('capital&moneylog',$power,$admininfo['level_id']); ?>>
					    		<a href="javascript:;" data-url="capital/moneylog">
					    		   <i class="iconfont icon-database" data-icon='icon-database'></i>
					    		   <span>资金日志</span>
					    		</a>
					    	</dd>
						   <dd <?php echo module_display('capital&withdrawals',$power,$admininfo['level_id']); ?>>
						   <a href="javascript:;" data-url="capital/commission_log">
							   <i class="iconfont icon-shengchengbaogao"  data-icon='icon-shengchengbaogao'></i>
							   <span>佣金明细</span>
						   </a>
						   </dd>
					    	
					   </dl>
				</li>
				<li class="layui-nav-item" <?php echo module_display('tuisong',$power,$admininfo['level_id']); ?>>
					<a href="javascript:;">
					   <i class="iconfont icon-shengchengbaogao" ></i>
					   <span>推送通知</span>
					   <em class="layui-nav-more"></em>
					</a>
					   <dl class="layui-nav-child">
                           <dd <?php echo module_display('tuisong&tongzhi',$power,$admininfo['level_id']); ?>>
                           	   <a href="javascript:;" data-url="tuisong/tongzhi">
					              <i class="iconfont icon-zhuti"  data-icon='icon-zhuti'></i>
					              <span>推送通知</span>
					           </a>
                           </dd>
                           <dd <?php echo module_display('tuisong&touchuan',$power,$admininfo['level_id']); ?>>
					    		<a href="javascript:;" data-url="tuisong/touchuan">
					    		   <i class="iconfont icon-database" data-icon='icon-database'></i>
					    		   <span>透传消息</span>
					    		</a>
					    	</dd>
					    	
					   </dl>
				</li>

				<li class="layui-nav-item" <?php echo module_display('app',$power,$admininfo['level_id']); ?>>
					<a href="javascript:;">
					   <i class="iconfont icon-shengchengbaogao" ></i>
					   <span>APP设置</span>
					   <em class="layui-nav-more"></em>
					</a>
					   <dl class="layui-nav-child">
                           <dd <?php echo module_display('app&banbenguanli',$power,$admininfo['level_id']); ?>>
                           	   <a href="javascript:;" data-url="app/banbenguanli">
					              <i class="iconfont icon-zhuti"  data-icon='icon-zhuti'></i>
					              <span>版本管理</span>
					           </a>
                           </dd>
					   </dl>
				</li>
				
<!--                                <li class="layui-nav-item">
					<a href="javascript:;">
					   <i class="iconfont icon-shengchengbaogao" ></i>
					   <span>网站维护</span>
					   <em class="layui-nav-more"></em>
					</a>
					   <dl class="layui-nav-child">
                           <dd>
                           	   <a href="javascript:;" data-url="maintain/index">
					              <i class="iconfont icon-zhuti"  data-icon='icon-zhuti'></i>
					              <span>网站主题</span>
					           </a>
                           </dd>
                           <dd>
					    		<a href="javascript:;" data-url="maintain/index">
					    		   <i class="iconfont icon-database" data-icon='icon-database'></i>
					    		   <span>数据库管理</span>
					    		</a>
					    	</dd>
					   	    <dd>
					    		<a href="javascript:;" data-url="maintain/index">
					    		   <i class="iconfont icon-shengchengbaogao" data-icon='icon-shengchengbaogao'></i>
					    		   <span>生成页面</span>
					    		</a>
					    	</dd>
					    	<dd>
					    		<a href="javascript:;" data-url="maintain/index">
					    		   <i class="iconfont icon-qingchuhuancun" data-icon='icon-qingchuhuancun'></i>
					    		   <span>更新缓存</span>
					    		</a>
					    	</dd>
					    	
					   </dl>
				</li>-->
                                <!--插件管理-->
				<li class="layui-nav-item" <?php echo module_display('addons',$power,$admininfo['level_id']); ?>>
					<a href="javascript:;">
					   <i class="iconfont icon-zhuti" ></i>
					   <span>插件管理</span>
					   <em class="layui-nav-more"></em>
					</a>
					<dl class="layui-nav-child">
                                            <dd <?php echo module_display('addons&coupon',$power,$admininfo['level_id']); ?>>
                                                    <a href="javascript:;" data-url="addons/coupon.html">
                                                                       <i class="iconfont icon-zhuti"  data-icon='icon-zhuti'></i>
                                                                       <span>优惠券管理</span>
                                                                    </a>
                                            </dd>
                                            <dd <?php echo module_display('addons&prize',$power,$admininfo['level_id']); ?>>
                                                    <a href="javascript:;" data-url="addons/prize.html">
                                                                       <i class="iconfont icon-zhuti"  data-icon='icon-zhuti'></i>
                                                                       <span>抽奖活动</span>
                                                                    </a>
                                            </dd>
                                            <dd <?php echo module_display('addons&lvyou',$power,$admininfo['level_id']); ?>>
                                                    <a href="javascript:;" data-url="addons/lvyou.html">
                                                                       <i class="iconfont icon-zhuti"  data-icon='icon-zhuti'></i>
                                                                       <span>旅游活动</span>
                                                                    </a>
                                            </dd>
                                        </dl>
				</li>
			<!-- 系统设置 -->
			<li class="layui-nav-item" <?php echo module_display('set',$power,$admininfo['level_id']); ?>>
					<a href="javascript:;">
					   <i class="iconfont icon-xitong" ></i>
					   <span>系统设置</span>
					   <em class="layui-nav-more"></em>
					</a>
					    <dl class="layui-nav-child">
					    	<dd <?php echo module_display('set&setting',$power,$admininfo['level_id']); ?>>
					    		<a href="javascript:;" data-url="set/setting">
					    		   <i class="iconfont icon-zhandianpeizhi" data-icon='icon-zhandianpeizhi'></i>
					    		   <span>基本参数设置</span>
					    		</a>
					    	</dd>
                                                
					    	<dd <?php echo module_display('set&alipay',$power,$admininfo['level_id']); ?>>
					    		<a href="javascript:;" data-url="set/alipay">
					    		   <i class="iconfont icon-zhandianguanli1" data-icon='icon-zhandianguanli1'></i>
					    		   <span>支付宝支付设置</span>
					    		</a>
					    	</dd>
					    	<dd <?php echo module_display('set&wxset',$power,$admininfo['level_id']); ?>>
					    		<a href="javascript:;" data-url="set/wxset">
					    		   <i class="iconfont icon-zhandianguanli1" data-icon='icon-zhandianguanli1'></i>
					    		   <span>微信设置</span>
					    		</a>
					    	</dd>
					    	<dd <?php echo module_display('set&menu',$power,$admininfo['level_id']); ?>>
					    		<a href="javascript:;" data-url="set/menu">
					    		   <i class="iconfont icon-zhandianguanli1" data-icon='icon-zhandianguanli1'></i>
					    		   <span>微信菜单设置</span>
					    		</a>
					    	</dd>
					    	<dd <?php echo module_display('set&emailset',$power,$admininfo['level_id']); ?>>
					    		<a href="javascript:;" data-url="set/emailset">
					    		   <i class="iconfont icon-anquanshezhi" data-icon='icon-anquanshezhi'></i>
					    		   <span>邮箱设置</span>
					    		</a>
					    	</dd>
					    	<dd <?php echo module_display('set&smsset',$power,$admininfo['level_id']); ?>>
					    		<a href="javascript:;" data-url="set/smsset">
					    		   <i class="iconfont icon-sms" data-icon='icon-sms'></i>
					    		   <span>短信接口设置</span>
					    		</a>
					    	</dd>
					    	<dd <?php echo module_display('set&adminlog',$power,$admininfo['level_id']); ?>>
					    		<a href="javascript:;" data-url="set/adminlog">
					    		   <i class="iconfont icon-iconfuzhi01" data-icon='icon-iconfuzhi01'></i>
					    		   <span>系统日志管理</span>
					    		</a>
					    	</dd>
					    	<dd <?php echo module_display('set&contractset',$power,$admininfo['level_id']); ?>>
					    		<a href="javascript:;" data-url="set/contractset">
					    		   <i class="iconfont icon-iconfuzhi01" data-icon='icon-iconfuzhi01'></i>
					    		   <span>订购合同设置</span>
					    		</a>
					    	</dd>
							<dd <?php echo module_display('set&contractset',$power,$admininfo['level_id']); ?>>
							<a href="javascript:;" data-url="set/contractset1">
								<i class="iconfont icon-iconfuzhi01" data-icon='iconfont icon-iconfuzhi01'></i>
								<span>赠送合同设置</span>
							</a>
							</dd>
					    	<dd <?php echo module_display('set&sqlselect',$power,$admininfo['level_id']); ?>>
					    		<a href="javascript:;" data-url="set/sqlselect">
					    			<i class='iconfont icon-SQLServershujuku' data-icon='icon-SQLServershujuku'></i>
					    			<span>SQL命令行工具</span>
					    		</a>
					    	</dd>
<!--					    	<dd>
					    		<a href="javascript:;" data-url="set/index">
					    			<i class='iconfont icon-xinxicaiji' data-icon='icon-xinxicaiji'></i>
					    			<span>防采集管理</span>
					    		</a>
					    	</dd>-->
					    </dl>
				</li>
				<!-- 友链设置 -->
<!--				<li class="layui-nav-item">
					<a href="javascript:;" data-url="set/index">
					   <i class="iconfont icon-youqinglianjie"  data-icon='icon-youqinglianjie'></i>
					   <span>友情链接</span>
					</a>
				</li>-->
		</ul>
	    </div>
	</div>

	<!-- 左侧侧边导航结束 -->
	<!-- 右侧主体内容 -->
	<div class="layui-body" id="larry-body" style="bottom: 0;border-left: solid 2px #1AA094;">
		<div class="layui-tab layui-tab-card larry-tab-box" id="larry-tab" lay-filter="demo" lay-allowclose="true">
			<ul class="layui-tab-title">
				<li class="layui-this" id="admin-home"><i class="iconfont icon-diannao1"></i><em>后台首页</em></li>
			</ul>
			<div class="layui-tab-content" style="min-height: 150px; ">
				<div class="layui-tab-item layui-show">
					<iframe class="larry-iframe" data-id='0' src="index/main.html"></iframe>
				</div>
			</div>
		</div>

        
	</div>
	<!-- 底部区域 -->
	
</div>
<!-- 加载js文件-->
	<script type="text/javascript" src="/static/common/layui/layui.js"></script> 
	<script type="text/javascript" src="/static/js/larry.js"></script>
	<script type="text/javascript" src="/static/js/index.js"></script>
<!-- 锁屏 -->
<div class="lock-screen" style="display: none;">
	<div id="locker" class="lock-wrapper">
		<div id="time"></div>
		<div class="lock-box center">
			<img src="/static/images/userimg.jpg" alt="">
			<h1>admin</h1>
			<duv class="form-group col-lg-12">
				<input type="password" placeholder='锁屏状态，请输入密码解锁' id="lock_password" class="form-control lock-input" autofocus name="lock_password">
				<button id="unlock" class="btn btn-lock">解锁</button>
			</duv>
		</div>
	</div>
</div>
<!-- 菜单控件 -->
<!-- <div class="larry-tab-menu">
	<span class="layui-btn larry-test">刷新</span>
</div> -->
<!-- iframe框架刷新操作 -->
<!-- <div id="refresh_iframe" class="layui-btn refresh_iframe">刷新</div> -->
</body>
</html>