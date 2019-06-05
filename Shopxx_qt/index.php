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
$().ready(function() {

	var $slider = $("#slider");
	var $newArticleTab = $("#newArticle .tab");
	var $promotionProductTab = $("#promotionProduct .tab");
	var $promotionProductInfo = $("#promotionProduct .info");
	var $hotProductTab = $("#hotProduct .tab");
	var $newProductTab = $("#newProduct .tab");
	var $hotProductImage = $("#hotProduct img");
	var $newProductImage = $("#newProduct img");
	
	$slider.nivoSlider({
		effect: "random",
		animSpeed: 1000,
		pauseTime: 6000,
		controlNav: true,
		keyboardNav: false,
		captionOpacity: 0.4
	});
	
	$newArticleTab.tabs("#newArticle .tabContent", {
		tabs: "li",
		event: "mouseover",
		initialIndex: 1
	});
	
	$promotionProductTab.tabs("#promotionProduct .tabContent", {
		tabs: "li",
		event: "mouseover"
	});
	
	$hotProductTab.tabs("#hotProduct .tabContent", {
		tabs: "li",
		event: "mouseover"
	});
	
	$newProductTab.tabs("#newProduct .tabContent", {
		tabs: "li",
		event: "mouseover"
	});
	
	function promotionInfo() {
		$promotionProductInfo.each(function() {
			var $this = $(this);
			var beginDate = $this.attr("beginTimeStamp") != null ? new Date(parseFloat($this.attr("beginTimeStamp"))) : null;
			var endDate = $this.attr("endTimeStamp") != null ? new Date(parseFloat($this.attr("endTimeStamp"))) : null;
			if (beginDate == null || beginDate <= new Date()) {
				if (endDate != null && endDate >= new Date()) {
					var time = (endDate - new Date()) / 1000;
					$this.html("剩余时间:<em>" + Math.floor(time / (24 * 3600)) + "<\/em> 天 <em>" + Math.floor((time % (24 * 3600)) / 3600) + "<\/em> 时 <em>" + Math.floor((time % 3600) / 60) + "<\/em> 分");
				} else if (endDate != null && endDate < new Date()) {
					$this.html("活动已结束");
				} else {
					$this.html("正在进行中...");
				}
			}
		});
	}
	
	promotionInfo();
	setInterval(promotionInfo, 60 * 1000);
	
	$hotProductImage.lazyload({
		threshold: 100,
		effect: "fadeIn",
		skip_invisible: false
	});
	
	$newProductImage.lazyload({
		threshold: 100,
		effect: "fadeIn",
		skip_invisible: false
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
				<?php
	                  $DBUtil=new DBUtil();
	                  $sql="SELECT * from s_navigationinfo  LIMIT 0,3";
	                  $arr= $DBUtil->query_s_navigationinfo($sql);
//					  var_dump($arr);
				?>
				<?php
									foreach($arr as $s_navigationinfo){
          	?>
							<li>
								<a href="" ><?=$s_navigationinfo->nName;?></a>|
							</li>
									<?php	
          	}
          	?>
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
			<?php
	                  $DBUtil=new DBUtil();
	                  $sql="SELECT * from s_navigationinfo  LIMIT 3,5";
	                  $arr= $DBUtil->query_s_navigationinfo($sql);
				?>
				<?php
									foreach($arr as $s_navigationinfo){
          	?>
							<li>
								<a href="" ><?=$s_navigationinfo->nName;?></a>|
							</li>
									<?php	
          	}
          	?>
					
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
						<?php
	                  $DBUtil=new DBUtil();
	                  $sql_b="select * from s_brandinfo";
	                  $arr= $DBUtil->query_brandinfo($sql_b);
?>
				<?php
					foreach($arr as $brandinfo){
					?>
				<ul>
							<li>
								<a href="../Shopxx_qt/brand/list.php?bId=<?=$brandinfo->bId;?>" title="<?=$brandinfo->bName;?>"><img src="<?=$brandinfo->bLog;?>" alt="<?=$brandinfo->bName;?>" /></a>
							</li>
							<?php
					}
					?>
							
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
										<?php
					                    $DBUtil=new DBUtil();
					                    $sql="SELECT * from s_navigationinfo  LIMIT 4,1";
					                    $arr= $DBUtil->query_s_navigationinfo($sql);
									    ?>
									    <?php
									        foreach($arr as $s_navigationinfo){
          							    ?>
										<a href="" ><?=$s_navigationinfo->nName;?></a>
										
									</th>
										<?php	
          								}
          								?>
									<td>
										<?php
							            $DBUtil=new DBUtil();
							            $sql="SELECT * from s_producttypeinfo where parentId=3";
							            $arr= $DBUtil->query_s_prodycttypeinfo($sql);
										?>
										<?php
										foreach($arr as $s_prodycttypeinfo){
		          						?>
										<a href="product/list.html"><?=$s_prodycttypeinfo->ptName;?></a>
										<?php	
		          						}
		        						?>	
									</td>
									</tr>
									<tr>
									<th>
										<?php
					                    $DBUtil=new DBUtil();
					                    $sql="SELECT * from s_navigationinfo  LIMIT 5,1";
					                    $arr= $DBUtil->query_s_navigationinfo($sql);
									    ?>
									    <?php
									        foreach($arr as $s_navigationinfo){
          							    ?>
										<a href="" ><?=$s_navigationinfo->nName;?></a>
										
									</th>
										<?php	
          								}
          								?>
									<td>
											<?php
							            $DBUtil=new DBUtil();
							            $sql="SELECT * from s_producttypeinfo where parentId=2";
							            $arr= $DBUtil->query_s_prodycttypeinfo($sql);
										?>
										<?php
										foreach($arr as $s_prodycttypeinfo){
		          						?>
										<a href="product/list.html"><?=$s_prodycttypeinfo->ptName;?></a>
										<?php	
		          						}
		        						?>	
									</td>
								</tr>
							
								<tr class="last">
									<th>
										<?php
					                    $DBUtil=new DBUtil();
					                    $sql="SELECT * from s_navigationinfo  LIMIT 6,1";
					                    $arr= $DBUtil->query_s_navigationinfo($sql);
									    ?>
									    <?php
									        foreach($arr as $s_navigationinfo){
          							    ?>
										<a href="" ><?=$s_navigationinfo->nName;?></a>
									</th>
									<?php	
          								}
          								?>
									<td>
											<?php
							            $DBUtil=new DBUtil();
							            $sql="SELECT * from s_producttypeinfo where parentId=0";
							            $arr= $DBUtil->query_s_prodycttypeinfo($sql);
										?>
										<?php
										foreach($arr as $s_prodycttypeinfo){
		          						?>
										<a href="product/list.html"><?=$s_prodycttypeinfo->ptName;?></a>
										<?php	
		          						}
		        						?>	
									</td>
								</tr>
								<tr class="last">
									<th>
										<?php
					                    $DBUtil=new DBUtil();
					                    $sql="SELECT * from s_navigationinfo  LIMIT 6,1";
					                    $arr= $DBUtil->query_s_navigationinfo($sql);
									    ?>
									    <?php
									        foreach($arr as $s_navigationinfo){
          							    ?>
										<a href="" ><?=$s_navigationinfo->nName;?></a>
									</th>
									<?php	
          								}
          								?>
									<td>
											<?php
							            $DBUtil=new DBUtil();
							            $sql="SELECT * from s_producttypeinfo where parentId=0";
							            $arr= $DBUtil->query_s_prodycttypeinfo($sql);
										?>
										<?php
										foreach($arr as $s_prodycttypeinfo){
		          						?>
										<a href="product/list.html"><?=$s_prodycttypeinfo->ptName;?></a>
										<?php	
		          						}
		        						?>	
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
								<a href="product/list.html" target="_blank">手机数码</a>
							</li>
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
					<?php
	                         $DBUtil=new DBUtil();
	                          $sql="select * from s_productinfo";
	                            $arr=$DBUtil->query_s_productinfo($sql);
                           ?>
				                      <?php
				                       	for($i=0;$i<16;$i+=4){
					                     if($i%4==0){
						                ?>
						<ul class="tabContent">
							 <?php
					                    }
					                         ?>
									<li>
										<a href="product\content\carproductinfo.php" ><img  src="<?=$arr[$i]->pPhoto;?>" title="<?=$arr[$i]->remark;?>"/></a>
									</li>
									<li>
										<a href="product\content\carproductinfos.php" ><img   src="<?=$arr[$i+1]->pPhoto;?>" title="<?=$arr[$i+1]->remark;?>"/></a>
									</li>
									<li>
										<a href="product\content\carproductinfos.php" ><img   src="<?=$arr[$i+2]->pPhoto;?>" title="<?=$arr[$i+2]->remark;?>"/></a>
									</li>
									<li>
										<a href="product\content\carproductinfos.php" ><img   src="<?=$arr[$i+3]->pPhoto;?>" title="<?=$arr[$i+3]->remark;?>"/></a>
									</li>
									<li>
										<a href="product\content\carproductinfossss.php" ><img  src="<?=$arr[$i+4]->pPhoto;?>" title="<?=$arr[$i+4]->remark;?>"/></a>
									</li>
									<li>
										<a href="product\content\carproductinfosssss.php" ><img   src="<?=$arr[$i+5]->pPhoto;?>" title="<?=$arr[$i+5]->remark;?>"/></a>
									</li>
									<li>
										<a href="product\content\carproductinfossssss.php" ><img   src="<?=$arr[$i+6]->pPhoto;?>" title="<?=$arr[$i+6]->remark;?>"/></a>
									</li>
									<li>
										<a href="product\content\carproductinfossssss.php" ><img   src="<?=$arr[$i+7]->pPhoto;?>" title="<?=$arr[$i+7]->remark;?>"/></a>
									</li>
									
						</ul>
						<ul class="tabContent">
									<li>
										<a href="product\content\carproductinfo.php" ><img  src="<?=$arr[$i]->pPhoto;?>" title="<?=$arr[$i]->remark;?>"/></a>
									</li>
									<li>
										<a href="product/content/productInfohtml" title="Max Toney春装高端暗门襟修身长袖衬衫男 小方领休闲男士衬衣 678" target="_blank"><img src="upload/image/NIKE.jpg" data-original="http://storage.shopxx.net/demo-image/3.0/201301/a8db4410-05e5-4dfa-8217-eb885a104af3-thumbnail.jpg" /></a>
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
						<?php
					if($i%4==0){
						?>
						</ul>
						<?php
					}
				}
				?>
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
						 <?php
				                       	for($i=0;$i<16;$i+=4){
					                     if($i%4==0){
						                ?>
						                <ul class="tabContent">
						                 <?php
					                    }
					                         ?>
									<li>
										<a href="product\content\carproductinfo.php" ><img  src="<?=$arr[$i]->pPhoto;?>" title="<?=$arr[$i]->remark;?>"/></a>
									</li>
									<li>
										<a href="product\content\carproductinfos.php" ><img   src="<?=$arr[$i+1]->pPhoto;?>" title="<?=$arr[$i+1]->remark;?>"/></a>
									</li>
									<li>
										<a href="product\content\carproductinfoss.php" ><img   src="<?=$arr[$i+2]->pPhoto;?>" title="<?=$arr[$i+2]->remark;?>"/></a>
									</li>
									<li>
										<a href="product\content\carproductinfosss.php" ><img   src="<?=$arr[$i+3]->pPhoto;?>" title="<?=$arr[$i+3]->remark;?>"/></a>
									</li>
									<li>
										<a href="product\content\carproductinfossss.php" ><img  src="<?=$arr[$i]->pPhoto;?>" title="<?=$arr[$i]->remark;?>"/></a>
									</li>
									<li>
										<a href="product\content\carproductinfosssss.php" ><img   src="<?=$arr[$i+1]->pPhoto;?>" title="<?=$arr[$i+1]->remark;?>"/></a>
									</li>
									<li>
										<a href="product\content\carproductinfossssss.php" ><img   src="<?=$arr[$i+2]->pPhoto;?>" title="<?=$arr[$i+2]->remark;?>"/></a>
									</li>
									<li>
										<a href="product\content\carproductinfosssssss.php" ><img   src="<?=$arr[$i+3]->pPhoto;?>" title="<?=$arr[$i+3]->remark;?>"/></a>
									</li>
									
				
						<?php
					if($i%4==0){
						?>
						</ul>
						<?php
					}
				}
				?>
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
						<?php
	                  $DBUtil=new DBUtil();
	                  $sql="SELECT * from s_navigationinfo  LIMIT 8,14";
	                  $arr= $DBUtil->query_s_navigationinfo($sql);
						?>
						<?php
									foreach($arr as $s_navigationinfo){
          				?>
							<li>
								<a href="" ><?=$s_navigationinfo->nName;?></a>|
							</li>
									<?php	
          				}
          				?>
					</li>					

		</ul>
	</div>
	<div class="span24">
		<div class="copyright">Copyright © 20015-2019 SHOPXX 版权所有</div>
	</div>
<script charset="utf-8" type="text/javascript" src="http://wpa.b.qq.com/cgi/wpa.php?key=XzkzODAzMTQyM180MzkzMV80MDAwMDA3NDc3Xw"></script></div></body>
</html>