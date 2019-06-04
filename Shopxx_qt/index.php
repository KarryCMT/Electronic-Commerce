<?php
	require_once dirname(__FILE__).'\util\DBUtil.php';
	header("ConTent-type:text/html;charset=utf-8");
	session_start();
	$obj=$_SESSION["name"];
	
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>SHOP++商城</title>
	<meta name="author" content="hht" />
	<meta name="copyright" content="hht" />
		<meta name="keywords" content="" />
		<meta name="description" content="SHOP++网上商城系统是基于J2EE技术的企业级电子商务平台系统，以其安全稳定、强大易用、高效专业等优势赢得了用户的广泛好评。SHOP++为大、中、小企业提供一个安全、高效、强大的电子商务解决方案，协助企业快速构建、部署和管理其电子商务平台，拓展企业销售渠道，突显电子商务商业价值，致力于推动J2EE技术和电子商务行业的发展而不断努力。" />
<link rel="icon" href="http://demo.shopxx.net/favicon.ico" type="image/x-icon" />
<link href="resources/shop/slider/slider.css" rel="stylesheet" type="text/css" />
<link href="resources/shop/css/common.css" rel="stylesheet" type="text/css" />
<link href="resources/shop/css/index.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="resources/shop/js/jquery.js"></script>
<script type="text/javascript" src="resources/shop/js/jquery.tools.js"></script>
<script type="text/javascript" src="resources/shop/js/jquery.lazyload.js"></script>
<script type="text/javascript" src="resources/shop/slider/slider.js"></script>
<script type="text/javascript" src="resources/shop/js/common.js"></script>
<script type="text/javascript">
//$().ready(function() {
//
//	var $slider = $("#slider");
//	var $newArticleTab = $("#newArticle .tab");
//	var $promotionProductTab = $("#promotionProduct .tab");
//	var $promotionProductInfo = $("#promotionProduct .info");
//	var $hotProductTab = $("#hotProduct .tab");
//	var $newProductTab = $("#newProduct .tab");
//	var $hotProductImage = $("#hotProduct img");
//	var $newProductImage = $("#newProduct img");
//	
//	$slider.nivoSlider({
//		effect: "random",
//		animSpeed: 1000,
//		pauseTime: 6000,
//		controlNav: true,
//		keyboardNav: false,
//		captionOpacity: 0.4
//	});
//	
//	$newArticleTab.tabs("#newArticle .tabContent", {
//		tabs: "li",
//		event: "mouseover",
//		initialIndex: 1
//	});
//	
//	$promotionProductTab.tabs("#promotionProduct .tabContent", {
//		tabs: "li",
//		event: "mouseover"
//	});
//	
//	$hotProductTab.tabs("#hotProduct .tabContent", {
//		tabs: "li",
//		event: "mouseover"
//	});
//	
//	$newProductTab.tabs("#newProduct .tabContent", {
//		tabs: "li",
//		event: "mouseover"
//	});
//	
//	function promotionInfo() {
//		$promotionProductInfo.each(function() {
//			var $this = $(this);
//			var beginDate = $this.attr("beginTimeStamp") != null ? new Date(parseFloat($this.attr("beginTimeStamp"))) : null;
//			var endDate = $this.attr("endTimeStamp") != null ? new Date(parseFloat($this.attr("endTimeStamp"))) : null;
//			if (beginDate == null || beginDate <= new Date()) {
//				if (endDate != null && endDate >= new Date()) {
//					var time = (endDate - new Date()) / 1000;
//					$this.html("剩余时间:<em>" + Math.floor(time / (24 * 3600)) + "<\/em> 天 <em>" + Math.floor((time % (24 * 3600)) / 3600) + "<\/em> 时 <em>" + Math.floor((time % 3600) / 60) + "<\/em> 分");
//				} else if (endDate != null && endDate < new Date()) {
//					$this.html("活动已结束");
//				} else {
//					$this.html("正在进行中...");
//				}
//			}
//		});
//	}
//	
//	promotionInfo();
//	setInterval(promotionInfo, 60 * 1000);
//	
//	$hotProductImage.lazyload({
//		threshold: 100,
//		effect: "fadeIn",
//		skip_invisible: false
//	});
//	
//	$newProductImage.lazyload({
//		threshold: 100,
//		effect: "fadeIn",
//		skip_invisible: false
//	});
//
//});
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
//$().ready(function() {
//
//	var $headerLogin = $("#headerLogin");
//	var $headerRegister = $("#headerRegister");
//	var $headerUsername = $("#headerUsername");
//	var $headerLogout = $("#headerLogout");
//	var $productSearchForm = $("#productSearchForm");
//	var $keyword = $("#productSearchForm input");
//	var defaultKeyword = "商品搜索";
//	
//	var username = getCookie("username");
//	if (username != null) {
//		$headerUsername.text("您好, " + username).show();
//		$headerLogout.show();
//	} else {
//		$headerLogin.show();
//		$headerRegister.show();
//	}
//	
//	$keyword.focus(function() {
//		if ($keyword.val() == defaultKeyword) {
//			$keyword.val("");
//		}
//	});
//	
//	$keyword.blur(function() {
//		if ($keyword.val() == "") {
//			$keyword.val(defaultKeyword);
//		}
//	});
//	
//	$productSearchForm.submit(function() {
//		if ($.trim($keyword.val()) == "" || $keyword.val() == defaultKeyword) {
//			return false;
//		}
//	});
//
//});
</script>
<?php
	require_once dirname(__FILE__)."\util\DBUtil.php";
	$dbutil=new DBUtil();
	$sql_s_articletype="select * from s_articletype ORDER BY Atorder ASC";
	$arr_s_articletype=$dbutil->query_s_articletype($sql_s_articletype);
	?>
<div class="container header">
	<div class="span5">
		<div class="logo">
			<a href="demo.shopxx.html">
				<img src="upload/image/logo.gif" alt="SHOP++商城" />
			</a>
		</div>
	</div>
	<div class="span9">
<div class="headerAd">
					<img src="resources/images/ad/header.jpg" width="320" height="50" alt="正品保障" title="正品保障" />
</div>	</div>
	<div class="span10 last">
		<div class="topNav clearfix">
			<ul>
				<li >
					<a href="customer_login.php"><?=$obj->cName?></a>|
				</li>
				<li id="headerRegister" class="headerRegister">
					<a href="register.html">注册</a>|
				</li>
				<li id="headerUsername" class="headerUsername"></li>
				<li id="headerLogout" class="headerLogout">
					<a href="#">[退出]</a>|
				</li>
						<li>
							<a href="admin.html">管理后台</a>
							|
						</li>
						<li>
							<a href="member/index.html">会员中心</a>
							|
						</li>
						<li>
							<a href="article/list.html">关于我们</a>
							
						</li>
			</ul>
		</div>
		<div class="cart">
			<a href="cart/list.html">购物车</a>
		</div>
			<div class="phone">
				客服热线:
				<strong>400-8888888</strong>
			</div>
	</div>
	<div class="span24">
		<ul class="mainNav">
					<li>
						<a href="demo.shopxx.html">首页</a>
						|
					</li>
					<li>
						<a href="product/list.html">时尚女装</a>
						|
					</li>
					<li>
						<a href="product/list.html">精品男装</a>
						|
					</li>
		
					<li>
						<a href="product/list.html">服饰配件</a>
						|
					</li>
					<li>
						<a href="product/list.html">时尚女鞋</a>
						|
					</li>
					<li>
						<a href="product/list.html">流行男鞋</a>
						|
					</li>
					<li>
						<a href="product/list.html">童装童鞋</a>
						
					</li>
		</ul>
	</div>
	<div class="span24">
		<div class="tagWrap">
			<ul class="tag">
						<li class="icon" style="background: url(http://storage.shopxx.net/demo-image/3.0/tag/hot.gif) right no-repeat;">
							<a href="product/list.html">热销</a>
						</li>
						<li class="icon" style="background: url(http://storage.shopxx.net/demo-image/3.0/tag/new.gif) right no-repeat;">
							<a href="product/list.html">最新</a>
						</li>
			</ul>
			<div class="hotSearch">
					热门搜索:
						<a href="http://demo.shopxx.net/product/search.jhtml?keyword=T%E6%81%A4">T恤</a>
						<a href="product/search.jhtml~keyword=衬衫.html">衬衫</a>
						<a href="product/search.jhtml~keyword=西服.html">西服</a>
						<a href="product/search.jhtml~keyword=西裤.html">西裤</a>
						<a href="product/search.jhtml~keyword=森马.html">森马</a>
						<a href="http://demo.shopxx.net/product/search.jhtml?keyword=%E4%B8%83%E5%8C%B9%E7%8B%BC">七匹狼</a>
						<a href="http://demo.shopxx.net/product/search.jhtml?keyword=%E6%A2%B5%E5%B8%8C%E8%94%93">梵希蔓</a>
						<a href="product/search.jhtml~keyword=春夏新款.html">春夏新款</a>
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
</div>	<div class="container index">
		<div class="span18">
<div id="slider" class="slider">
					<img src="resources/images/ad/index_1.jpg" width="770" height="290" alt="享受这一刻的舒适" title="享受这一刻的舒适" />
				<img src="resources/images/ad/index_2.jpg" width="770" height="290" alt="浪漫时尚季" title="浪漫时尚季" />
				<img src="resources/images/ad/index_3.jpg" width="770" height="290" alt="伊见清新" title="伊见清新" />
</div>		</div>
		<div class="span6 last">
			<div id="newArticle" class="newArticle">
					<ul class="tab">
						<?php
							foreach($arr_s_articletype as $s_articletype){
							?>
							<li>
								<a href="article/list.html" target="_blank"><?=$s_articletype->ArName;?></a>
							</li>
							<?php
							}
						?>
					</ul>
						<?php
							for($i=0;$i<count($arr_s_articletype);$i++){
								$arr_articleinfo=$arr_s_articletype[$i]->Arr_article;
								?>
							<ul class="tabContent">
								<?php
										for($j=0;$j<count($arr_articleinfo);$j++){
										?>
									<li>
										<a href="article/content/articleInfo.html" title="五月靓丽女人节 呵护自己" target="_blank"><?=$arr_articleinfo[$j]->ArTitle;?></a>
									</li>
									<?php
										}
										?>
							</ul>
							<?php
							}
							
							?>
							<ul class="tabContent">
								<li>
										<a href="article/content/articleInfo.html" title="五月靓丽女人节 呵护自己" target="_blank">五月靓丽女人节 呵护自己</a>
									</li>
									<li>
										<a href="article/content/articleInfo.html" title="五月靓丽女人节 呵护自己" target="_blank">五月靓丽女人节 呵护自己</a>
									</li>
							</ul>
							<ul class="tabContent">
								<li>
										<a href="article/content/articleInfo.html" title="五月靓丽女人节 呵护自己" target="_blank">五月靓丽女人节 呵护自己</a>
									</li>
							</ul>
			</div>
<div class="rightAd">
					<img src="resources/images/ad/index_right.jpg" width="230" height="106" alt="春季新品" title="春季新品" />
</div>		</div>
		<div class="span18">
			<div class="hotBrand clearfix">
				<div class="title">
					<a href="http://demo.shopxx.net/brand/list/1.jhtml">所有品牌</a>
					<strong>热门品牌</strong>BRAND
				</div>
				<ul>
							<li>
								<a href="brand/content/brandInfo.html" title="梵希蔓"><img src="resources/images/brand/vimly.gif" alt="梵希蔓" /></a>
							</li>
							<li>
								<a href="brand/content/brandInfo.html" title="伊芙丽"><img src="resources/images/brand/eifini.gif" alt="伊芙丽" /></a>
							</li>
							<li>
								<a href="brand/content/brandInfo.html" title="尚都比拉"><img src="resources/images/brand/sentubila.gif" alt="尚都比拉" /></a>
							</li>
							<li>
								<a href="brand/content/brandInfo.html" title="森马"><img src="resources/images/brand/semir.gif" alt="森马" /></a>
							</li>
							<li>
								<a href="brand/content/brandInfo.html" title="以纯"><img src="resources/images/brand/yishion.gif" alt="以纯" /></a>
							</li>
							<li>
								<a href="brand/content/brandInfo.html" title="李宁"><img src="resources/images/brand/lining.gif" alt="李宁" /></a>
							</li>
							<li>
								<a href="brand/content/brandInfo.html" title="耐克"><img src="resources/images/brand/nike.gif" alt="耐克" /></a>
							</li>
							<li>
								<a href="brand/content/brandInfo.html" title="阿迪达斯"><img src="resources/images/brand/adidas.gif" alt="阿迪达斯" /></a>
							</li>
							<li>
								<a href="brand/content/brandInfo.html" title="Jack Jones"><img src="resources/images/brand/jackjones.gif" alt="Jack Jones" /></a>
							</li>
							<li>
								<a href="brand/content/brandInfo.html" title="七匹狼"><img src="resources/images/brand/septwolves.gif" alt="七匹狼" /></a>
							</li>
							<li>
								<a href="brand/content/brandInfo.html" title="恒源祥"><img src="resources/images/brand/hengyuanxiang.gif" alt="恒源祥" /></a>
							</li>
							<li>
								<a href="brand/content/brandInfo.html" title="圣得西"><img src="resources/images/brand/sundance.gif" alt="圣得西" /></a>
							</li>
							<li>
								<a href="brand/content/brandInfo.html" title="猫人"><img src="resources/images/brand/maoren.gif" alt="猫人" /></a>
							</li>
							<li>
								<a href="brand/content/brandInfo.html" title="北极绒"><img src="resources/images/brand/beijirong.gif" alt="北极绒" /></a>
							</li>
				</ul>
			</div>
			<div class="hotProductCategory">
				<div class="title">
					<a href="http://demo.shopxx.net/product_category.jhtml">所有分类</a>
					<strong>热门分类</strong>CATEGORY
				</div>
				<div class="content">
						<table>
								<tr>
									<th>
										<a href="product/list.html">时尚女装</a>
									</th>
									<td>
											<a href="product/search.html">连衣裙</a>
											<a href="product/list.html">针织衫</a>
											<a href="product/list.html">短外套</a>
											<a href="product/list.html">小西装</a>
											<a href="product/list.html">牛仔裤</a>
											<a href="product/list.html">T恤</a>
											<a href="product/list.html">衬衫</a>
											<a href="product/list.html">风衣</a>
											<a href="product/list.html">卫衣</a>
											<a href="product/list.html">裤子</a>
									</td>
								</tr>
								<tr>
									<th>
										<a href="product/list.html">精品男装</a>
									</th>
									<td>
											<a href="product/list.html">针织衫</a>
											<a href="product/list.html">POLO衫</a>
											<a href="product/list.html">休闲裤</a>
											<a href="product/list.html">牛仔裤</a>
											<a href="product/list.html">T恤</a>
											<a href="product/list.html">衬衫</a>
											<a href="product/list.html">西服</a>
											<a href="product/list.html">西裤</a>
											<a href="product/list.html">风衣</a>
											<a href="product/list.html">卫衣</a>
									</td>
								</tr>
							
								<tr class="last">
									<th>
										<a href="product/list.html">服饰配件</a>
									</th>
									<td>
											<a href="product/list.html">女士腰带</a>
											<a href="product/list.html">男士皮带</a>
											<a href="product/list.html">女士围巾</a>
											<a href="product/list.html">男士围巾</a>
											<a href="product/list.html">帽子</a>
											<a href="product/list.html">手套</a>
											<a href="product/list.html">领带</a>
											<a href="product/list.html">领结</a>
											<a href="product/list.html">发饰</a>
											<a href="product/list.html">袖扣</a>
									</td>
								</tr>
								<tr class="last">
									<th>
										<a href="product/list.html">服饰配件</a>
									</th>
									<td>
											<a href="product/list.html">女士腰带</a>
											<a href="product/list.html">男士皮带</a>
											<a href="product/list.html">女士围巾</a>
											<a href="product/list.html">男士围巾</a>
											<a href="product/list.html">帽子</a>
											<a href="product/list.html">手套</a>
											<a href="product/list.html">领带</a>
											<a href="product/list.html">领结</a>
											<a href="product/list.html">发饰</a>
											<a href="product/list.html">袖扣</a>
									</td>
								</tr>
						</table>
				</div>
			</div>
		</div>
		<div class="span6 last">
			<div id="promotionProduct" class="promotionProduct">
				<ul class="tab">
							<li>
								<a href="product/list.html" target="_blank">双倍积分</a>
							</li>
				</ul>
						<ul class="tabContent">
									<li>
										<span class="info">
										</span>
										<div>
											<img src="resources/images/images_product/a39fce79-fc04-4400-9e0f-47cee57accab-thumbnail.jpg" alt="OSA春装外套女春秋韩版泡泡袖女士小西装短外套W13254" />
											<div>
												<a href="product/content/productInfo.html" title="OSA春装外套女春秋韩版泡泡袖女士小西装短外套W13254" target="_blank">OSA春装外套女春秋韩版泡泡</a>
													<span>
														市场价:
														<del>￥345.60</del>
													</span>
												<span>
													销售价:
													<strong>￥288.00</strong>
												</span>
											</div>
										</div>
									</li>
									<li class="last">
										<span class="info">
										</span>
										<div>
											<img src="resources/images/images_product//f5e39c37-94b2-462e-8e58-8bde3c5f1b8c-thumbnail.jpg" alt="伊芙丽2013春款新款女士西装领一粒扣短款小西装外套女1161024-2" />
											<div>
												<a href="product/content/productInfo.html" title="伊芙丽2013春款新款女士西装领一粒扣短款小西装外套女1161024-2" target="_blank">伊芙丽2013春款新款女士西</a>
													<span>
														市场价:
														<del>￥429.60</del>
													</span>
												<span>
													销售价:
													<strong>￥358.00</strong>
												</span>
											</div>
										</div>
									</li>
						</ul>
			</div>
			<div class="newReview">
				<div class="title">最新评论</div>
				<ul>
							<li>
								<a href="http://demo.shopxx.net/review/content/150.jhtml" title="不错，很好，质量很好。穿着也很合身。" target="_blank">不错，很好，质量很好。穿着也很合</a>
							</li>
							<li>
								<a href="http://demo.shopxx.net/review/content/142.jhtml" title="东西收到了，第一次购买杰克琼斯买的衣服，虽然贵，但是质量很满意，大小合适、面料很舒服、样式很新颖、真的不..." target="_blank">东西收到了，第一次购买杰克琼斯</a>
							</li>
							<li>
								<a href="http://demo.shopxx.net/review/content/137.jhtml" title="整体上还不错,就是颜色没有想象的那么好，面料很舒服，应该穿着会很舒服。" target="_blank">整体上还不错,就是颜色没有想象的</a>
							</li>
							<li>
								<a href="http://demo.shopxx.net/review/content/2.jhtml" title="衣服很漂亮，做工质量都不错，面料很舒适，裁剪很合身。是那种特别淑女特别有范儿的样式。只是希望快递能给力..." target="_blank">衣服很漂亮，做工质量都不错，面</a>
							</li>
							<li>
								<a href="http://demo.shopxx.net/review/content/76.jhtml" title="一拆开就喜欢，衣服包装很好，很精致，同事们看了都说漂亮，衣服的质地也很好，就是物流太不给力了" target="_blank">一拆开就喜欢，衣服包装很好，很</a>
							</li>
				</ul>
			</div>
		</div>
		<div class="span24">
<div class="middleAd">
					<img src="resources/images/ad/index_top.jpg" width="1000" height="120" alt="特卖会专场" title="特卖会专场" />
</div>		</div>
		<div class="span24">
			<div id="hotProduct" class="hotProduct clearfix">
					<div class="title">
						<strong>热门商品</strong>
						<a href="product/list.html" target="_blank"></a>
					</div>
					<ul class="tab">
							<li>
								<a href="product/list.html" target="_blank">时尚女装</a>
							</li>
							<li>
								<a href="product/list.html" target="_blank">精品男装</a>
							</li>
					
					</ul>
					<div class="hotProductAd">
			<img src="resources/images/ad/index_hot_product.jpg" width="260" height="343" alt="热门商品" title="热门商品" />
					</div>
						<ul class="tabContent">
									<li>
										<a href="product/content/productInfo.html" title="尚都比拉2013春夏装新款女装 春款修身女裙 蕾丝雪纺短袖连衣裙子" target="_blank"><img src="upload/image/blank.gif" data-original="http://storage.shopxx.net/demo-image/3.0/201301/2553e635-7aa4-416a-83f4-5288145684a1-thumbnail.jpg" /></a>
									</li>
									<li>
										<a href="product/content/productInfo.html" title="尚都比拉女装2013夏装新款蕾丝连衣裙 韩版修身雪纺打底裙子 春款" target="_blank"><img src="upload/image/blank.gif" data-original="http://storage.shopxx.net/demo-image/3.0/201301/0ff130db-0a1b-4b8d-a918-ed9016317009-thumbnail.jpg" /></a>
									</li>
									<li>
										<a href="product/content/productInfo.html" title="尚都比拉2013夏装新款 韩版优雅甜美淑女装 春款蕾丝雪纺连衣裙子" target="_blank"><img src="upload/image/blank.gif" data-original="http://storage.shopxx.net/demo-image/3.0/201301/51afeef5-f6cb-4936-abea-315cfca0edc0-thumbnail.jpg" /></a>
									</li>
									<li>
										<a href="product/content/productInfo.html" title="梵希蔓2013夏装新款蕾丝连衣裙镂空假两件套连衣裙刺绣短袖连衣裙" target="_blank"><img src="upload/image/blank.gif" data-original="http://storage.shopxx.net/demo-image/3.0/201301/9aafeb39-655a-43f9-97d5-248508deeeed-thumbnail.jpg" /></a>
									</li>
									<li>
										<a href="product/content/productInfo.html" title="梵希蔓2013新款夏装甜美女装连衣裙短袖雪纺蕾丝拼接公主裙百褶裙" target="_blank"><img src="upload/image/blank.gif" data-original="http://storage.shopxx.net/demo-image/3.0/201301/94fd156b-cbdc-40d7-8231-8e26bae2ed9c-thumbnail.jpg" /></a>
									</li>
									<li>
										<a href="product/content/productInfo.html" title="梵希蔓2013夏装淑女连衣裙雪纺刺绣背心裙高腰荷叶边连衣裙高腰" target="_blank"><img src="upload/image/blank.gif" data-original="http://storage.shopxx.net/demo-image/3.0/201301/92a7bf42-6294-44a7-b518-19a77186d380-thumbnail.jpg" /></a>
									</li>
									<li>
										<a href="product/content/productInfo.html" title="维依恋2013夏装新款波西米亚印花雪纺半身裙抹胸连衣裙两穿长裙子" target="_blank"><img src="upload/image/blank.gif" data-original="http://storage.shopxx.net/demo-image/3.0/201301/698a395e-ac95-4f76-a3c9-aa4e5fbc9217-thumbnail.jpg" /></a>
									</li>
									<li>
										<a href="product/content/productInfo.html" title="尚都比拉2013春夏装新款女装 春款淑女两件套 蕾丝雪纺短袖连衣裙" target="_blank"><img src="upload/image/blank.gif" data-original="http://storage.shopxx.net/demo-image/3.0/201301/3dc28bfe-b4a7-4346-89a1-86b87d229faa-thumbnail.jpg" /></a>
									</li>
						</ul>
						<ul class="tabContent">
									<li>
										<a href="product/content/productInfo.html" title="2013春夏柒牌男装正品西服 男立领修身韩版 西服套装 902C141200" target="_blank"><img src="upload/image/blank.gif" data-original="http://storage.shopxx.net/demo-image/3.0/201301/5e5be432-fbee-4bdd-a7bd-a92e01f9bfc4-thumbnail.jpg" /></a>
									</li>
									<li>
										<a href="product/content/productInfohtml" title="Max Toney春装高端暗门襟修身长袖衬衫男 小方领休闲男士衬衣 678" target="_blank"><img src="upload/image/blank.gif" data-original="http://storage.shopxx.net/demo-image/3.0/201301/a8db4410-05e5-4dfa-8217-eb885a104af3-thumbnail.jpg" /></a>
									</li>
									<li>
										<a href="product/content/productInfo.html" title="圣得西 正品男装 经典版白蓝粉色 商务长袖正装衬衫" target="_blank"><img src="upload/image/blank.gif" data-original="http://storage.shopxx.net/demo-image/3.0/201301/c5b1b396-181a-4805-9e68-9b400d71f91e-thumbnail.jpg" /></a>
									</li>
									<li>
										<a href="product/content/productInfo.html" title="Max Toney 春夏男士休闲西服西装 永不起褶休闲小西装外套 男627" target="_blank"><img src="upload/image/blank.gif" data-original="http://storage.shopxx.net/demo-image/3.0/201301/40e34b2d-d240-446e-9874-89969edbe89f-thumbnail.jpg" /></a>
									</li>
									<li>
										<a href="product/content/productInfo.html" title="JackJones杰克琼斯男士纯棉格纹短袖衬衫C212204021" target="_blank"><img src="upload/image/blank.gif" data-original="http://storage.shopxx.net/demo-image/3.0/201301/6f8ae4bf-cbd3-41c7-aa22-0fe81db6add4-thumbnail.jpg" /></a>
									</li>
									<li>
										<a href="product/content/productInfo.html" title="JackJones杰克琼斯男士立领拼接式夹克I212121041" target="_blank"><img src="upload/image/blank.gif" data-original="http://storage.shopxx.net/demo-image/3.0/201301/4107e1ce-5e7c-4941-bc0f-718f35ba14cd-thumbnail.jpg" /></a>
									</li>
									<li>
										<a href="product/content/productInfo.html" title="Max Toney 春装男士休闲西服便西装 时尚修身外套小西装 男 229" target="_blank"><img src="upload/image/blank.gif" data-original="http://storage.shopxx.net/demo-image/3.0/201301/cae1bc6b-0159-4ce0-9a9c-4926df231b4f-thumbnail.jpg" /></a>
									</li>
									<li>
										<a href="product/content/productInfo.html" title="2013春夏柒牌男装官方正品男士休闲印花短袖T恤衫702T506653" target="_blank"><img src="upload/image/blank.gif" data-original="http://storage.shopxx.net/demo-image/3.0/201301/3d835c07-08c5-46d7-912d-adcd41f8c8e6-thumbnail.jpg" /></a>
									</li>
						</ul>
						<ul class="tabContent">
									<li>
										<a href="product/content/productInfo.html" title="婷美正品 四季款魔鬼瘦塑身衣套装瘦腰翘臀B罩杯" target="_blank"><img src="upload/image/blank.gif" data-original="http://storage.shopxx.net/demo-image/3.0/201301/1a3ad7de-7ee9-4530-b89a-46375219beb5-thumbnail.jpg" /></a>
									</li>
									<li>
										<a href="product/content/productInfo.html" title="婷美正品塑身衣收腹 塑身背心 舒适托胸 蕾丝动能燃脂 瘦身美体" target="_blank"><img src="upload/image/blank.gif" data-original="http://storage.shopxx.net/demo-image/3.0/201301/9f164e13-bcaa-48a6-9b35-0ca96629f614-thumbnail.jpg" /></a>
									</li>
									<li>
										<a href="product/content/productInfo.html" title="2013新款夏季家居服女 大码全棉夏装家居睡衣 运动短袖短裤套装" target="_blank"><img src="upload/image/blank.gif" data-original="http://storage.shopxx.net/demo-image/3.0/201301/1c81f492-a3d7-4c06-8658-bc2c76808cd3-thumbnail.jpg" /></a>
									</li>
									<li>
										<a href="product/content/productInfo.html" title="卡绚 情侣家居服套装 春秋纯棉男女睡衣长袖条纹居家服 时" target="_blank"><img src="upload/image/blank.gif" data-original="http://storage.shopxx.net/demo-image/3.0/201301/ea566af4-0cdb-4017-a8c7-27e407794204-thumbnail.jpg" /></a>
									</li>
									<li>
										<a href="product/content/productInfo.html" title="女士夏季短袖睡裙清纯棉质甜美可爱少女睡衣V领条纹连衣裙家居裙" target="_blank"><img src="upload/image/blank.gif" data-original="http://storage.shopxx.net/demo-image/3.0/201301/f1174ca6-6bdf-4d0b-86e6-5455bc8e89ad-thumbnail.jpg" /></a>
									</li>
									<li>
										<a href="product/content/productInfo.html" title="卡绚 男士睡衣春秋条纹纯棉长袖家居服套装大码圆领全棉质居家服" target="_blank"><img src="upload/image/blank.gif" data-original="http://storage.shopxx.net/demo-image/3.0/201301/dea31d42-fa3e-4b69-a631-51ca7c79f032-thumbnail.jpg" /></a>
									</li>
									<li>
										<a href="product/content/productInfo.html" title="婷美正品秋冬保暖衣 轻压塑身衣美体衣保暖内衣 塑身内衣分体套装" target="_blank"><img src="upload/image/blank.gif" data-original="http://storage.shopxx.net/demo-image/3.0/201301/2af8be8a-75b9-41ae-b009-a7c54b685a4e-thumbnail.jpg" /></a>
									</li>
									<li>
										<a href="product/content/productInfo.html" title="婷美塑身内衣正品燃脂塑身衣套装tingmei收腹瘦身衣薄束身衣" target="_blank"><img src="upload/image/blank.gif" data-original="http://storage.shopxx.net/demo-image/3.0/201301/c41d0347-364c-42bb-baeb-25142c1ed167-thumbnail.jpg" /></a>
									</li>
						</ul>
			</div>
		</div>
		<div class="span24">
			<div id="newProduct" class="newProduct clearfix">
					<div class="title">
						<strong>最新商品</strong>
						<a href="product/list..html" target="_blank"></a>
					</div>
					<ul class="tab">
							<li>
								<a href="product/list.html" target="_blank">时尚女装</a>
							</li>
							<li>
								<a href="product/list.html" target="_blank">精品男装</a>
							</li>
						
					</ul>
					<div class="newProductAd">
			<img src="resources/images/ad/index_new_product.jpg" width="260" height="343" alt="最新商品" title="最新商品" />
					</div>
						<ul class="tabContent">
									<li>
										<a href="product/content/productInfo.html" title="唯维欣怡2013春夏季新款韩版大码宽松显瘦女装荷叶边雪纺连衣裙子" target="_blank"><img src="upload/image/blank.gif" data-original="http://storage.shopxx.net/demo-image/3.0/201301/b499fb5e-999f-431b-a375-172ee09e4a3e-thumbnail.jpg" /></a>
									</li>
									<li>
										<a href="product/content/productInfo.html" title="OSA春装外套女春秋韩版泡泡袖女士小西装短外套W13254" target="_blank"><img src="upload/image/blank.gif" data-original="http://storage.shopxx.net/demo-image/3.0/201301/a39fce79-fc04-4400-9e0f-47cee57accab-thumbnail.jpg" /></a>
									</li>
									<li>
										<a href="product/content/productInfo.html" title="梵希蔓 2013夏装新款女装女裙子长款雪纺百褶连衣裙韩版修身裙子" target="_blank"><img src="upload/image/blank.gif" data-original="http://storage.shopxx.net/demo-image/3.0/201301/3999515b-48ba-476e-b810-3ca57f4b9e29-thumbnail.jpg" /></a>
									</li>
									<li>
										<a href="product/content/productInfo.html" title="尚都比拉2013夏装新款 春款修身淑女装 雪纺短袖假两件套连衣裙子" target="_blank"><img src="upload/image/blank.gif" data-original="http://storage.shopxx.net/demo-image/3.0/201301/4a51167a-89d5-4710-aca2-7c76edc355b8-thumbnail.jpg" /></a>
									</li>
									<li>
										<a href="product/content/productInfo.html" title="尚都比拉2013夏装新款 春款甜美淑女装 荷叶袖修身蕾丝雪纺连衣裙" target="_blank"><img src="upload/image/blank.gif" data-original="http://storage.shopxx.net/demo-image/3.0/201301/750a9ce8-8c19-444d-b8cc-f3e7e786ec5d-thumbnail.jpg" /></a>
									</li>
									<li>
										<a href="product/content/productInfo.html" title="维依恋2013夏装新款韩版修身娃娃领女式短袖雪纺衫蕾丝拼接上衣" target="_blank"><img src="upload/image/blank.gif" data-original="http://storage.shopxx.net/demo-image/3.0/201301/aec6d0ae-cad6-4cca-96bb-4bcd25e994cb-thumbnail.jpg" /></a>
									</li>
									<li>
										<a href="product/content/productInfo.html" title="唯维欣怡2013春装新款韩版女装修身网纱长袖衬衣休闲女士白色衬衫" target="_blank"><img src="upload/image/blank.gif" data-original="http://storage.shopxx.net/demo-image/3.0/201301/4652d7ae-3d2c-4692-89ea-0ca81f50eac3-thumbnail.jpg" /></a>
									</li>
									<li>
										<a href="product/content/productInfo.html" title="维依恋春装2013新款七分袖中长款风衣韩版修身双排扣外套春款大衣" target="_blank"><img src="upload/image/blank.gif" data-original="http://storage.shopxx.net/demo-image/3.0/201301/94aa25f9-f3ef-4f7f-8c7c-197cd04b68ea-thumbnail.jpg" /></a>
									</li>
						</ul>
						<ul class="tabContent">
									<li>
										<a href="product/content/productInfo.html" title="JackJones杰克琼斯男士立领拉链机车夹克B212121038" target="_blank"><img src="upload/image/blank.gif" data-original="http://storage.shopxx.net/demo-image/3.0/201301/ca3043f5-dbb0-4a03-9bb6-8274f78b5d7e-thumbnail.jpg" /></a>
									</li>
									<li>
										<a href="product/content/productInfo.html" title="Max Toney 春装时尚休闲多层卷边领莱卡棉T恤 男 长袖T恤 599" target="_blank"><img src="upload/image/blank.gif" data-original="http://storage.shopxx.net/demo-image/3.0/201301/b998f840-91fc-41b6-b73d-70587babf760-thumbnail.jpg" /></a>
									</li>
									<li>
										<a href="product/content/productInfo.html" title="圣得西 正品男装 浅蓝色细格休闲长袖衬衫 经典版" target="_blank"><img src="upload/image/blank.gif" data-original="http://storage.shopxx.net/demo-image/3.0/201301/b04a22f5-267d-4e33-ac58-dda941eeaf84-thumbnail.jpg" /></a>
									</li>
									<li>
										<a href="product/content/productInfo.html" title="2013春夏柒牌男装官方正品男士条纹T恤衫702T563985" target="_blank"><img src="upload/image/blank.gif" data-original="http://storage.shopxx.net/demo-image/3.0/201301/fbb80ec8-a1d3-49de-b83b-79eae4b1ff69-thumbnail.jpg" /></a>
									</li>
									<li>
										<a href="product/content/productInfo.html" title="夏装新品179 与狼共舞短袖T恤 气质拼接 男装正品 翻领修身6614" target="_blank"><img src="upload/image/blank.gif" data-original="http://storage.shopxx.net/demo-image/3.0/201301/7b3c0647-1016-4d13-8b84-4d63818e1179-thumbnail.jpg" /></a>
									</li>
									<li>
										<a href="product/content/productInfo.html" title="JackJones杰克琼斯男纯棉怀旧图案短袖T恤V212201016" target="_blank"><img src="upload/image/blank.gif" data-original="http://storage.shopxx.net/demo-image/3.0/201301/a2ac0816-37e4-477a-b179-e64f71252cf5-thumbnail.jpg" /></a>
									</li>
									<li>
										<a href="product/content/productInfo.html" title="Max Toney奢华春装 单扣高档全羊毛休闲西装西服 男 219" target="_blank"><img src="upload/image/blank.gif" data-original="http://storage.shopxx.net/demo-image/3.0/201301/3c79f82f-f136-48aa-9e81-7e10fbb3de2a-thumbnail.jpg" /></a>
									</li>
									<li>
										<a href="product/content/productInfo.html" title="春装新款159 与狼共舞长袖T恤 男装正品 翻领纯棉条纹体恤衫6534" target="_blank"><img src="upload/image/blank.gif" data-original="http://storage.shopxx.net/demo-image/3.0/201301/bb99deac-0b33-48f1-a3ad-e8310516be07-thumbnail.jpg" /></a>
									</li>
						</ul>
						<ul class="tabContent">
									<li>
										<a href="product/content/productInfo.html" title="婷美正品 四季款魔鬼瘦塑身衣套装瘦腰翘臀B罩杯" target="_blank"><img src="upload/image/blank.gif" data-original="http://storage.shopxx.net/demo-image/3.0/201301/1a3ad7de-7ee9-4530-b89a-46375219beb5-thumbnail.jpg" /></a>
									</li>
									<li>
										<a href="product/content/productInfo.html" title="婷美正品塑身衣收腹 塑身背心 舒适托胸 蕾丝动能燃脂 瘦身美体" target="_blank"><img src="upload/image/blank.gif" data-original="http://storage.shopxx.net/demo-image/3.0/201301/9f164e13-bcaa-48a6-9b35-0ca96629f614-thumbnail.jpg" /></a>
									</li>
									<li>
										<a href="product/content/productInfo.html" title="2013新款夏季家居服女 大码全棉夏装家居睡衣 运动短袖短裤套装" target="_blank"><img src="upload/image/blank.gif" data-original="http://storage.shopxx.net/demo-image/3.0/201301/1c81f492-a3d7-4c06-8658-bc2c76808cd3-thumbnail.jpg" /></a>
									</li>
									
						</ul>
			</div>
		</div>
		<div class="span24">
			<div class="friendLink">
				<dl>
					<dt>合作伙伴</dt>
							
							<dd>
								<a href="http://www.alipay.com/" target="_blank">支付宝</a>
								|
							</dd>
							<dd>
								<a href="http://www.tenpay.com/" target="_blank">财付通</a>
								|
							</dd>
							<dd>
								<a href="http://www.chinapay.com/" target="_blank">银联在线</a>
								|
							</dd>
							<dd>
								<a href="http://www.99bill.com/" target="_blank">快钱支付</a>
								|
							</dd>
							
							
					<dd class="more">
						<a href="http://demo.shopxx.net/friend_link.jhtml">更多</a>
					</dd>
				</dl>
			</div>
		</div>
	</div>
<div class="container footer">
	<div class="span24">
		<div class="footerAd">
					<img src="resources/images/ad/footer.jpg" width="950" height="52" alt="我们的优势" title="我们的优势" />
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
						<a href="friend_link.html">友情链接</a>
						|
					</li>
					<li>
						<a href="#" target="_blank">支付方式</a>
						|
					</li>
					<li>
						<a href="#" target="_blank">配送方式</a>
						|
					</li>

		</ul>
	</div>
	<div class="span24">
		<div class="copyright">Copyright © 20015-2016 SHOPXX 版权所有</div>
	</div>
<script charset="utf-8" type="text/javascript" src="http://wpa.b.qq.com/cgi/wpa.php?key=XzkzODAzMTQyM180MzkzMV80MDAwMDA3NDc3Xw"></script></div></body>
</html>
