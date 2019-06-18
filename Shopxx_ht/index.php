<?php
	require_once dirname(__FILE__).'\util\DBUtil.php';
	header("ConTent-type:text/html;charset=utf-8");
	session_start();
	$obj=$_SESSION["user"];
	?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>管理中心</title>
<meta name="author" content="hht" />
<meta name="copyright" content="hht" />
<link href="resources/admin/css/common.css" rel="stylesheet" type="text/css" />
<link href="resources/admin/css/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="resources/admin/js/jquery.js"></script>
<style type="text/css">
*{
	font: 12px tahoma, Arial, Verdana, sans-serif;
}
html, body {
	width: 100%;
	height: 100%;
	overflow: hidden;
}
</style>
<script type="text/javascript">
$().ready(function() {

	var $nav = $("#nav a:not(:last)");
	var $menu = $("#menu dl");
	var $menuItem = $("#menu a");
	
	$nav.click(function() {
		var $this = $(this);
		$nav.removeClass("current");
		$this.addClass("current");
		var $currentMenu = $($this.attr("href"));
		$menu.hide();
		$currentMenu.show();
		return false;
	});
	
	$menuItem.click(function() {
		var $this = $(this);
		$menuItem.removeClass("current");
		$this.addClass("current");
	});

});
</script>
</head>
<body>


<!-- Copyright � 2005. Spidersoft Ltd -->
<style>
A.applink:hover {border: 2px dotted #DCE6F4;padding:2px;background-color:#ffff00;color:green;text-decoration:none}
A.applink       {border: 2px dotted #DCE6F4;padding:2px;color:#2F5BFF;background:transparent;text-decoration:none}
A.info          {color:#2F5BFF;background:transparent;text-decoration:none}
A.info:hover    {color:green;background:transparent;text-decoration:underline}
</style>


	<script type="text/javascript">
		if (self != top) {
			top.location = self.location;
		};
	</script>
	<table class="main">
		<tr>
			<th class="logo">
				<a href="main.jhtml.html">
					<img src="resources/admin/images/22.gif" alt="SHOP++" />
				</a>
			</th>
			<th>
				<div id="nav" class="nav">
					<ul>
								<li>
									<a href="#product">商品</a>
								</li>
								<li>
									<a href="#order">订单</a>
								</li>
								<li>
									<a href="#member">会员</a>
								</li>
								<li>
									<a href="#content">内容</a>
								</li>
			
								<li>
									<a href="#statistics">统计</a>
								</li>
								<li>
									<a href="#system">系统</a>
								</li>
						<li>
							<a href="../Shopxx_qt/index.php" target="_blank">首页</a>
						</li>
					</ul>
				</div>
				<div class="link">
					<a href="#" target="_blank">官方网站</a>|
					<a href="#" target="_blank">交流论坛</a>|
					<a href="#" target="_blank">关于我们</a>
				</div>
				<div class="link">
					<strong><?=$obj->uName?></strong>
					您好!
					<a href="#" target="iframe">[账号设置]</a>
					<a href="admin.php" target="_top">[注销]</a>
				</div>
			</th>
		</tr>
		<tr>
			<td id="menu" class="menu">
				<dl id="product" class="default">
					<dt>商品管理</dt>
						<dd>
							<a href="admin/Braind/EditBraind.php" target="iframe">商品管理</a>
						</dd>
						<dd>
							<a href="admin/paytype/list.html" target="iframe">商品分类</a>
						</dd>
				
						<dd>
							<a href="admin/paytype/list.html" target="iframe">规格管理</a>
						</dd>	
						<dd>
							<a href="admin/Braind/list_Braind.php" target="iframe">品牌管理</a>
						</dd>
				</dl>
				<dl id="order">
					<dt>订单管理</dt>
						<dd>
							<a href="admin/paytype/list.html" target="iframe">订单管理</a>
						</dd>
						<dd>
							<a href="admin/paytype/list.html" target="iframe">退货管理</a>
						</dd>

				</dl>
				<dl id="member">
					<dt>会员管理</dt>
						<dd>
							<a href="admin/paytype/list.html" target="iframe">会员管理</a>
						</dd>
						<dd>
							<a href="admin/paytype/list.html" target="iframe">会员等级</a>
						</dd>

						<dd>
							<a href="admin/paytype/list.html" target="iframe">评论管理</a>
						</dd>
						<dd>
							<a href="admin/paytype/list.html" target="iframe">收货地址管理</a>
						</dd>


				</dl>
				<dl id="content">
					<dt>内容管理</dt>
						<dd>
							<a href="admin/paytype/list.html" target="iframe">导航管理</a>
						</dd>
						<dd>
							<a href="admin/paytype/list.html" target="iframe">文章管理</a>
						</dd>
						<dd>
							<a href="admin/paytype/list.html" target="iframe">文章分类</a>
						</dd>
						
						<dd>
							<a href="admin/paytype/list.html" target="iframe">友情链接</a>
						</dd>
						<dd>
							<a href="admin/paytype/list.html" target="iframe">公告管理</a>
						</dd>
				</dl>
				
			<!--	<dl id="statistics">
					<dt>统计报表</dt>
			
						<dd>
							<a href="admin/paytype/list.html" target="iframe">销售统计</a>
						</dd>
						<dd>
							<a href="admin/paytype/list.html" target="iframe">销售排行</a>
						</dd>
						<dd>
							<a href="admin/paytype/list.html" target="iframe">消费排行</a>
						</dd>
				
				</dl>-->
				<dl id="system">
					<dt>系统设置</dt>
						<dd>
							<a href="admin/paytype/list.html" target="iframe">系统设置</a>
						</dd>
						<dd>
							<a href="admin/paytype/list.html" target="iframe">地区管理</a>
						</dd>
						<dd>
							<a href="admin/paytype/list.html" target="iframe">支付方式</a>
						</dd>
						<dd>
							<a href="admin/paytype/list.html" target="iframe">管理员</a>
						</dd>	
				</dl>
			</td>
			<td>
				<iframe id="iframe" name="iframe" src="main.html" frameborder="0"></iframe>
			</td>
		</tr>
	</table>
</body>
</html>
