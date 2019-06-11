<?php
	require_once dirname(dirname(dirname(__FILE__))).'\util\DBUtil.php';
	
	header("ConTent-type:text/html;charset=utf-8");
	session_start();
	$obj=$_SESSION["name"];
	
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>QIPILANG - Powered By SHOP++</title>
	<meta name="author" content="SHOP++ Team" />
	<meta name="copyright" content="SHOP++" />
		<meta name="keywords" content="QIPILANG" />
		<meta name="description" content="QIPILANG" />
<link href="../../resources/shop/css/common.css" rel="stylesheet" type="text/css" />
<link href="../../resources/shop/css/product.css" rel="stylesheet" type="text/css" />
<link href="../../resources/shop/css/brand.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../../resources/shop/js/jquery.js"></script>
<script type="text/javascript" src="../../resources/shop/js/common.js"></script>
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
$().ready(function() {

	var $headerLogin = $("#headerLogin");
	var $headerRegister = $("#headerRegister");
	var $headerUsername = $("#headerUsername");
	var $headerLogout = $("#headerLogout");
	var $productSearchForm = $("#productSearchForm");
	var $keyword = $("#productSearchForm input");
	var defaultKeyword = "商品搜索";
	
	var username = getCookie("username");
	if (username != null) {
		$headerUsername.text("您好, " + username).show();
		$headerLogout.show();
	} else {
		$headerLogin.show();
		$headerRegister.show();
	}
	
	$keyword.focus(function() {
		if ($keyword.val() == defaultKeyword) {
			$keyword.val("");
		}
	});
	
	$keyword.blur(function() {
		if ($keyword.val() == "") {
			$keyword.val(defaultKeyword);
		}
	});
	
	$productSearchForm.submit(function() {
		if ($.trim($keyword.val()) == "" || $keyword.val() == defaultKeyword) {
			return false;
		}
	});

});
</script>
<div class="container header">
	<div class="span5">
		<div class="logo">
			<a href="../../demo.shopxx.html">
				<img src="../../upload/image/logo.gif" alt="SHOP++商城" />
			</a>
		</div>
	</div>
	<div class="span9">
<div class="headerAd">
					<img src="../../resources/images/ad/header.jpg" width="320" height="50" alt="正品保障" title="正品保障" />
</div>	</div>
	<div class="span10 last">
		<div class="topNav clearfix">
			<ul>
				<li id="headerLogin" class="headerLogin">
					<a href="customer_login.php"><?=$obj->cName?></a>
					
				</li>
				<li id="headerRegister" class="headerRegister">
					<a href="#">注册</a>|
				</li>
				<li id="headerUsername" class="headerUsername"></li>
				<li id="headerLogout" class="headerLogout">
					<a href="#">[退出]</a>|
				</li>
						<li>
							<a href="../../admin.html">管理后台</a>
							|
						</li>
						<li>
							<a href="#">会员中心</a>
							|
						</li>
						<li>
							<a href="#">关于我们</a>
							
						</li>
			</ul>
		</div>
		<div class="cart">
			<a href="#">购物车</a>
		</div>
			<div class="phone">
				客服热线:
				<strong>400-8888888</strong>
			</div>
	</div>
	<div class="span24">
		<ul class="mainNav">
					<li>
						<a href="#">首页</a>
						|
					</li>
					<li>
						<a href="http://demo.shopxx.net/product/list/1.jhtml">时尚女装</a>
						|
					</li>
					<li>
						<a href="http://demo.shopxx.net/product/list/2.jhtml">精品男装</a>
						|
					</li>
					<li>
						<a href="http://demo.shopxx.net/product/list/3.jhtml">精致内衣</a>
						|
					</li>
					<li>
						<a href="http://demo.shopxx.net/product/list/4.jhtml">服饰配件</a>
						|
					</li>
					<li>
						<a href="http://demo.shopxx.net/product/list/5.jhtml">时尚女鞋</a>
						|
					</li>
					<li>
						<a href="http://demo.shopxx.net/product/list/6.jhtml">流行男鞋</a>
						|
					</li>
					<li>
						<a href="http://demo.shopxx.net/product/list/9.jhtml">童装童鞋</a>
						
					</li>
		</ul>
	</div>
	<div class="span24">
		<div class="tagWrap">
			<ul class="tag">
						<li class="icon" style="background: url(http://storage.shopxx.net/demo-image/3.0/tag/hot.gif) right no-repeat;">
							<a href="../../product/list.jhtml~tagIds=1.html">热销</a>
						</li>
						<li class="icon" style="background: url(http://storage.shopxx.net/demo-image/3.0/tag/new.gif) right no-repeat;">
							<a href="../../product/list.jhtml~tagIds=2.html">最新</a>
						</li>
			</ul>
			<div class="hotSearch">
					热门搜索:
						<a href="http://demo.shopxx.net/product/search.jhtml?keyword=T%E6%81%A4">T恤</a>
						<a href="../../product/search.jhtml~keyword=衬衫.html">衬衫</a>
						<a href="../../product/search.jhtml~keyword=西服.html">西服</a>
						<a href="../../product/search.jhtml~keyword=西裤.html">西裤</a>
						<a href="../../product/search.jhtml~keyword=森马.html">森马</a>
						<a href="http://demo.shopxx.net/product/search.jhtml?keyword=%E4%B8%83%E5%8C%B9%E7%8B%BC">七匹狼</a>
						<a href="http://demo.shopxx.net/product/search.jhtml?keyword=%E6%A2%B5%E5%B8%8C%E8%94%93">梵希蔓</a>
						<a href="../../product/search.jhtml~keyword=春夏新款.html">春夏新款</a>
						<a href="http://demo.shopxx.net/product/search.jhtml?keyword=%E7%89%9B%E4%BB%94%E8%A3%A4">牛仔裤</a>
			</div>
			<div class="search">
				<form id="productSearchForm" action="/product/search.jhtml" method="get">
					<input name="keyword" class="keyword" value="商品搜索" maxlength="30" />
					<button type="submit">搜索</button>
				</form>
			</div>
		</div>
	</div>
</div>	<div class="container brandContent">
		<div class="span6">
			<div class="hotProductCategory">
						<dl>
							<dt>
								<a href="http://demo.shopxx.net/product/list/1.jhtml">时尚女装</a>
							</dt>
									<dd>
										<a href="http://demo.shopxx.net/product/list/11.jhtml">连衣裙</a>
									</dd>
									<dd>
										<a href="http://demo.shopxx.net/product/list/12.jhtml">针织衫</a>
									</dd>
									<dd>
										<a href="http://demo.shopxx.net/product/list/13.jhtml">短外套</a>
									</dd>
									<dd>
										<a href="http://demo.shopxx.net/product/list/14.jhtml">小西装</a>
									</dd>
						</dl>
						<dl>
							<dt>
								<a href="http://demo.shopxx.net/product/list/2.jhtml">精品男装</a>
							</dt>
									<dd>
										<a href="http://demo.shopxx.net/product/list/21.jhtml">针织衫</a>
									</dd>
									<dd>
										<a href="http://demo.shopxx.net/product/list/22.jhtml">POLO衫</a>
									</dd>
									<dd>
										<a href="http://demo.shopxx.net/product/list/23.jhtml">休闲裤</a>
									</dd>
									<dd>
										<a href="http://demo.shopxx.net/product/list/24.jhtml">牛仔裤</a>
									</dd>
						</dl>
						<dl>
							<dt>
								<a href="http://demo.shopxx.net/product/list/3.jhtml">精致内衣</a>
							</dt>
									<dd>
										<a href="http://demo.shopxx.net/product/list/31.jhtml">女式内裤</a>
									</dd>
									<dd>
										<a href="http://demo.shopxx.net/product/list/32.jhtml">男式内裤</a>
									</dd>
									<dd>
										<a href="http://demo.shopxx.net/product/list/33.jhtml">保暖内衣</a>
									</dd>
									<dd>
										<a href="http://demo.shopxx.net/product/list/34.jhtml">塑身衣</a>
									</dd>
						</dl>
						<dl>
							<dt>
								<a href="http://demo.shopxx.net/product/list/4.jhtml">服饰配件</a>
							</dt>
									<dd>
										<a href="http://demo.shopxx.net/product/list/41.jhtml">女士腰带</a>
									</dd>
									<dd>
										<a href="http://demo.shopxx.net/product/list/42.jhtml">男士皮带</a>
									</dd>
									<dd>
										<a href="http://demo.shopxx.net/product/list/43.jhtml">女士围巾</a>
									</dd>
									<dd>
										<a href="http://demo.shopxx.net/product/list/44.jhtml">男士围巾</a>
									</dd>
						</dl>
						<dl>
							<dt>
								<a href="http://demo.shopxx.net/product/list/5.jhtml">时尚女鞋</a>
							</dt>
									<dd>
										<a href="http://demo.shopxx.net/product/list/51.jhtml">高帮鞋</a>
									</dd>
									<dd>
										<a href="http://demo.shopxx.net/product/list/52.jhtml">雪地靴</a>
									</dd>
									<dd>
										<a href="http://demo.shopxx.net/product/list/53.jhtml">中筒靴</a>
									</dd>
									<dd>
										<a href="http://demo.shopxx.net/product/list/54.jhtml">单鞋</a>
									</dd>
						</dl>
						<dl>
							<dt>
								<a href="http://demo.shopxx.net/product/list/6.jhtml">流行男鞋</a>
							</dt>
									<dd>
										<a href="http://demo.shopxx.net/product/list/59.jhtml">低帮鞋</a>
									</dd>
									<dd>
										<a href="http://demo.shopxx.net/product/list/60.jhtml">高帮鞋</a>
									</dd>
									<dd>
										<a href="http://demo.shopxx.net/product/list/61.jhtml">休闲鞋</a>
									</dd>
									<dd>
										<a href="http://demo.shopxx.net/product/list/62.jhtml">正装鞋</a>
									</dd>
						</dl>
						<dl>
							<dt>
								<a href="http://demo.shopxx.net/product/list/7.jhtml">潮流女包</a>
							</dt>
									<dd>
										<a href="http://demo.shopxx.net/product/list/63.jhtml">单肩包</a>
									</dd>
									<dd>
										<a href="http://demo.shopxx.net/product/list/64.jhtml">双肩包</a>
									</dd>
									<dd>
										<a href="http://demo.shopxx.net/product/list/65.jhtml">手提包</a>
									</dd>
									<dd>
										<a href="http://demo.shopxx.net/product/list/66.jhtml">手拿包</a>
									</dd>
						</dl>
						<dl>
							<dt>
								<a href="http://demo.shopxx.net/product/list/8.jhtml">精品男包</a>
							</dt>
									<dd>
										<a href="http://demo.shopxx.net/product/list/67.jhtml">单肩男</a>
									</dd>
									<dd>
										<a href="http://demo.shopxx.net/product/list/68.jhtml">双肩包</a>
									</dd>
									<dd>
										<a href="http://demo.shopxx.net/product/list/69.jhtml">手提包</a>
									</dd>
									<dd>
										<a href="http://demo.shopxx.net/product/list/70.jhtml">手拿包</a>
									</dd>
						</dl>
						<dl>
							<dt>
								<a href="http://demo.shopxx.net/product/list/9.jhtml">童装童鞋</a>
							</dt>
									<dd>
										<a href="http://demo.shopxx.net/product/list/71.jhtml">运动鞋</a>
									</dd>
									<dd>
										<a href="http://demo.shopxx.net/product/list/72.jhtml">牛仔裤</a>
									</dd>
									<dd>
										<a href="http://demo.shopxx.net/product/list/73.jhtml">套装</a>
									</dd>
									<dd>
										<a href="http://demo.shopxx.net/product/list/74.jhtml">裤子</a>
									</dd>
						</dl>
						<dl class="last">
							<dt>
								<a href="http://demo.shopxx.net/product/list/10.jhtml">时尚饰品</a>
							</dt>
									<dd>
										<a href="http://demo.shopxx.net/product/list/75.jhtml">项链</a>
									</dd>
									<dd>
										<a href="http://demo.shopxx.net/product/list/76.jhtml">手链</a>
									</dd>
									<dd>
										<a href="http://demo.shopxx.net/product/list/77.jhtml">戒指</a>
									</dd>
									<dd>
										<a href="http://demo.shopxx.net/product/list/78.jhtml">耳饰</a>
									</dd>
						</dl>
			</div>
			<div class="hotProduct">
				<div class="title">热销商品</div>
				<ul>
							<li>
								<a href="../../product/content/201306/300.html" title="尚都比拉女装2013夏装新款蕾丝连衣裙 韩版修身雪纺打底裙子 春款">尚都比拉女装2013夏装新款蕾丝连</a>
								<div>销售价: <strong>￥298.00元</strong></div>
								<div>月销量: <em>0</em></div>
							</li>
							<li>
								<a href="../../product/content/201306/109.html" title="2013春夏柒牌男装正品西服 男立领修身韩版 西服套装 902C141200">2013春夏柒牌男装正品西服 男立领</a>
									<div>
										<div>评分: </div>
										<div class="score8"></div>
										<div>4.0</div>
									</div>
								<div>销售价: <strong>￥899.00元</strong></div>
								<div>月销量: <em>0</em></div>
							</li>
							<li>
								<a href="../../product/content/201306/242.html" title="婷美正品秋冬保暖衣 轻压塑身衣美体衣保暖内衣 塑身内衣分体套装">婷美正品秋冬保暖衣 轻压塑身衣美</a>
								<div>销售价: <strong>￥658.00元</strong></div>
								<div>月销量: <em>0</em></div>
							</li>
							<li>
								<a href="../../product/content/201306/298.html" title="尚都比拉2013夏装新款淑女装 春款森女系 碎花修身短袖蕾丝连衣裙">尚都比拉2013夏装新款淑女装 春款</a>
									<div>
										<div>评分: </div>
										<div class="score8"></div>
										<div>4.0</div>
									</div>
								<div>销售价: <strong>￥289.00元</strong></div>
								<div>月销量: <em>0</em></div>
							</li>
							<li>
								<a href="../../product/content/201306/122.html" title="OSA春装外套女春秋韩版泡泡袖女士小西装短外套W13254">OSA春装外套女春秋韩版泡泡袖女士</a>
									<div>
										<div>评分: </div>
										<div class="score8"></div>
										<div>4.0</div>
									</div>
								<div>销售价: <strong>￥288.00元</strong></div>
								<div>月销量: <em>0</em></div>
							</li>
							<li class="last">
								<a href="../../product/content/201306/96.html" title="梵希蔓2013新款夏装甜美女装连衣裙短袖雪纺蕾丝拼接公主裙百褶裙">梵希蔓2013新款夏装甜美女装连衣</a>
								<div>销售价: <strong>￥268.00元</strong></div>
								<div>月销量: <em>0</em></div>
							</li>
				</ul>
			</div>
		</div>
		<div class="span18 last">
			<div class="path">
				<ul>
					<li>
						<a href="../../demo.shopxx.html">首页</a>
					</li>
					<li>
						<a href="http://demo.shopxx.net/brand/list/1.jhtml">品牌</a>
					</li>
				</ul>
			</div>
			<div class="top">
					<img src="../../resources/images/brand/septwolves.gif" alt="QIPILANG" />
				<strong>QIPILANG</strong>
					官方网站: <a href="http://www.QIPILANG.com/" target="_blank">http://www.QIPILANG.com</a>
			</div>
			<div class="introduction">
				<div class="title">
					<strong>介绍</strong>
					<span>&nbsp;</span>
				</div>
				Jack &amp; Jones是针对年龄在18岁到30岁之间的喜欢穿着随意、流行和时尚的男士们设计的。Jack &amp; Jones的设计迎合了国际大都市男士的生活品位，他们喜欢一种独特、轮廓鲜明而朴实的风格，同时采用高品质、时兴和新颖的面料制作的服装。<br />
Jack &amp; Jones品牌诞生于1975年，以其简洁纯粹的风格吸引全球追求时尚男性的目光，代表了欧洲时尚潮流的男装品牌，同时也是都市风格服装的典范品牌。<br />
Jack &amp; Jones是时尚男装里非常流行的品牌，与女装的ONLY、VERO MODA和男装SELECTED同属丹麦的BESTSELLER公司。他们经营各种男装，有休闲，正装等，还有各种配饰。<br />
杰克琼斯(Jack &amp; Jones) 男装是设计给机敏，明智，受过良好教育，热衷社会活动的都市轻熟男。穿着杰克琼斯(Jack &amp; Jones) 的男人是对现代服装有着自己独特的感受，同时关注国际时装市场趋势的现代人。<br />
			</div>
		</div>
	</div>
<div class="container footer">
	<div class="span24">
		<div class="footerAd">
					<img src="../../../storage.shopxx.net/demo-image/3.0/ad/footer.jpg" width="950" height="52" alt="我们的优势" title="我们的优势" />
</div>	</div>
	<div class="span24">
		<ul class="bottomNav">
					<li>
						<a href="#">关于我们</a>
						|
					</li>
					<li>
						<a href="#">联系我们</a>
						|
					</li>
					<li>
						<a href="#">诚聘英才</a>
						|
					</li>
					<li>
						<a href="#">法律声明</a>
						|
					</li>
					<li>
						<a href="http://demo.shopxx.net/friend_link.jhtml">友情链接</a>
						|
					</li>
					<li>
						<a href="http://demo.shopxx.net/article/list/4.jhtml" target="_blank">支付方式</a>
						|
					</li>
					<li>
						<a href="http://demo.shopxx.net/article/list/5.jhtml" target="_blank">配送方式</a>
						|
					</li>
					<li>
						<a href="http://www.shopxx.net/">SHOP++官网</a>
						|
					</li>
					<li>
						<a href="http://bbs.shopxx.net/">SHOP++论坛</a>
						
					</li>
		</ul>
	</div>
	<div class="span24">
		<div class="copyright">Copyright © 2005-2013 SHOP++商城 版权所有</div>
	</div>
<script charset="utf-8" type="text/javascript" src="http://wpa.b.qq.com/cgi/wpa.php?key=XzkzODAzMTQyM180MzkzMV80MDAwMDA3NDc3Xw"></script></div></body>
</html>
