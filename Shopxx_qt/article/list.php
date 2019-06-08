<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>商城动态</title>
	<meta name="author" content="hht" />
	<meta name="copyright" content="hht" />
		<meta name="keywords" content="商城动态" />
		<meta name="description" content="商城动态" />
<link href="../resources/shop/css/common.css" rel="stylesheet" type="text/css" />
<link href="../resources/shop/css/article.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../resources/shop/js/jquery.js"></script>
<script type="text/javascript" src="../resources/shop/js/common.js"></script>
<script type="text/javascript">
$().ready(function() {

	var $articleSearchForm = $("#articleSearchForm");
	var $keyword = $("#articleSearchForm input");
	var $articleForm = $("#articleForm");
	var $pageNumber = $("#pageNumber");
	var defaultKeyword = "文章搜索";
	
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

	$articleSearchForm.submit(function() {
		if ($.trim($keyword.val()) == "" || $keyword.val() == defaultKeyword) {
			return false;
		}
	});
	
	$articleForm.submit(function() {
		if ($pageNumber.val() == "" || $pageNumber.val() == "1") {
			$pageNumber.prop("disabled", true)
		}
	});
	
	$.pageSkip = function(pageNumber) {
		$pageNumber.val(pageNumber);
		$articleForm.submit();
		return false;
	}

});
</script>
</head>
<body>
<?php 
	require_once dirname(dirname(__FILE__)).'\util\DBUtil.php';
	header("ConTent-type:text/html;charset=utf-8");
	session_start();
	$obj=$_SESSION["name"];
	
?>

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
			<a href="../demo.shopxx.html">
				<img src="../upload/image/logo.gif" alt="SHOP++商城" />
			</a>
		</div>
	</div>
	<div class="span9">
<div class="headerAd">
					<img src="../resources/images/ad/header.jpg" width="320" height="50" alt="正品保障" title="正品保障" />
</div>	</div>
	<div class="span10 last">
		<div class="topNav clearfix">
			<ul>
				<li id="headerLogin" class="headerLogin">
					<a href="http://demo.shopxx.net/login.jhtml"><?=$obj->cName?></a>|
				</li>
				<li id="headerRegister" class="headerRegister">
					<a href="http://demo.shopxx.net/register.jhtml">注册</a>|
				</li>
				<li id="headerUsername" class="headerUsername"></li>
				<li id="headerLogout" class="headerLogout">
					<a href="http://demo.shopxx.net/logout.jhtml">[退出]</a>|
				</li>
						<?php
	                  $DBUtil=new DBUtil();
	                  $sql="SELECT * from s_navigationinfo  LIMIT 0,3";
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
		<div class="cart">
			<a href="http://demo.shopxx.net/cart/list.jhtml">购物车</a>
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
							<a href="../product/list.jhtml~tagIds=1.html">热销</a>
						</li>
						<li class="icon" style="background: url(http://storage.shopxx.net/demo-image/3.0/tag/new.gif) right no-repeat;">
							<a href="../product/list.jhtml~tagIds=2.html">最新</a>
						</li>
			</ul>
			<div class="hotSearch">
					热门搜索:
						<a href="http://demo.shopxx.net/product/search.jhtml?keyword=T%E6%81%A4">T恤</a>
						<a href="../product/search.jhtml~keyword=衬衫.html">衬衫</a>
						<a href="../product/search.jhtml~keyword=西服.html">西服</a>
						<a href="../product/search.jhtml~keyword=西裤.html">西裤</a>
						<a href="../product/search.jhtml~keyword=森马.html">森马</a>
						<a href="http://demo.shopxx.net/product/search.jhtml?keyword=%E4%B8%83%E5%8C%B9%E7%8B%BC">七匹狼</a>
						<a href="http://demo.shopxx.net/product/search.jhtml?keyword=%E6%A2%B5%E5%B8%8C%E8%94%93">梵希蔓</a>
						<a href="../product/search.jhtml~keyword=春夏新款.html">春夏新款</a>
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
</div>	<div class="container articleList">
		<div class="span6">
			<div class="hotArticleCategory">
				<div class="title">热点分类</div>
						<dl>
							<dt>
								<a href="list.html">商城动态</a>
							</dt>
						</dl>
						<dl>
							<dt>
								<a href="list.html">活动促销</a>
							</dt>
						</dl>
						<dl>
							<dt>
								<a href="list.html">购物指南</a>
							</dt>
						</dl>
						<dl>
							<dt>
								<a href="list.html">支付方式</a>
							</dt>
						</dl>
						<dl>
							<dt>
								<a href="list.html">配送方式</a>
							</dt>
						</dl>
						<dl>
							<dt>
								<a href="list.html">售后服务</a>
							</dt>
						</dl>
						<dl class="last">
							<dt>
								<a href="list.html">关于我们</a>
							</dt>
						</dl>
			</div>
			<div class="hotArticle">
				<div class="title">热点文章</div>
				<ul>
							<li>
								<a href="content/articleInfo.html" title="五月靓丽女人节 呵护自己">五月靓丽女人节 呵护自己</a>
							</li>
							<li>
								<a href="content/articleInfo.html" title="中国电商交易额8.1万亿 网购占比提升">中国电商交易额8.1万亿 网购占比</a>
							</li>
							<li>
								<a href="content/articleInfo.html" title="电子商务未来是否需要“移动”">电子商务未来是否需要“移动”</a>
							</li>
							<li>
								<a href="content/articleInfo.html" title="电商变革 电商造节促销欲打翻身仗">电商变革 电商造节促销欲打翻身仗</a>
							</li>
							
				</ul>
			</div>
			<div class="articleSearch">
				<div class="title">文章搜索</div>
				<div class="content">
					<form id="articleSearchForm" action="/article/search.jhtml" method="get">
						<input type="text" name="keyword" value="文章搜索" maxlength="30" />
						<button type="submit">搜&nbsp;&nbsp;索</button>
					</form>
				</div>
			</div>
		</div>
		<div class="span18 last">
			<div class="path">
				<ul>
					<li>
						<a href="../demo.shopxx.html">首页</a>
					</li>
					<li class="last">商城动态</li>
				</ul>
			</div>
			<form id="articleForm" action="/article/list.html" method="get">
				<input type="hidden" id="pageNumber" name="pageNumber" value="1" />
				<div class="result">
						<ul>
								<?php
			                  $DBUtil=new DBUtil();
			                  $sql="select * from s_articleinfo where AtId=1";
			                  $arr= $DBUtil->query_s_articleinfo($sql);
					 
							?>
         
							<ul class="tabContent">
									<?php
          					foreach($arr as $s_articleinfo){
          						?>
							<li>
								<a href="" ><?=$s_articleinfo->ArTitle;?></a>&nbsp;&nbsp;&nbsp;
								<span title=""><?=$s_articleinfo->CrTime;?></span>&nbsp;&nbsp;&nbsp;
								<span title=""><?=$s_articleinfo->AtAuthor;?></span>
						    <p><?=$s_articleinfo->ArContent;?></p>
							</li>
									<?php	
          					}
          					?>
								
						</ul>
				</div>
			</form>
		</div>
	</div>
<div class="container footer">
	<div class="span24">
		<div class="footerAd">
					<img src="../resources/images/ad/footer.jpg" width="950" height="52" alt="我们的优势" title="我们的优势" />
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
