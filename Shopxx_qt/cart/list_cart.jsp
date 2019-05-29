<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>购物车</title>
<meta name="author" content="hht" />
<meta name="copyright" content="hht" />
<link href="../resources/shop/css/common.css" rel="stylesheet" type="text/css" />
<link href="../resources/shop/css/cart.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../resources/shop/js/jquery.js"></script>
<script type="text/javascript" src="../resources/shop/js/common.js"></script>
<script type="text/javascript">
function deletes(type,pid){
		var r=confirm("是否删除？");
		if(r==true){
			window.location.href="list_cart.jsp?type="+type+"&pids="+pid;
		}

}
function clears(type,pid){
		var r=confirm("是否清空？");
		if(r==true){
			window.location.href="list_cart.jsp?type="+type+"&pids="+pid;
		}

}



$().ready(function() {

	var $quantity = $("input[name='quantity']");
	var $increase = $("span.increase");
	var $decrease = $("span.decrease");
	var $delete = $("a.delete");
	var $giftItems = $("#giftItems");
	var $promotion = $("#promotion");
	var $effectivePoint = $("#effectivePoint");
	var $effectivePrice = $("#effectivePrice");
	var $clear = $("#clear");
	var $submit = $("#submit");
	var timeouts = {};
	
	// 初始数量
	$quantity.each(function() {
		var $this = $(this);
		$this.data("value", $this.val());
	});
	
	// 数量
	$quantity.keypress(function(event) {
		var key = event.keyCode ? event.keyCode : event.which;
		if ((key >= 48 && key <= 57) || key==8) {
			return true;
		} else {
			return false;
		}
	});
	
	// 增加数量
	$increase.click(function() {
		var $quantity = $(this).parent().siblings("input");
		var quantity = $quantity.val();
		if (/^\d*[1-9]\d*$/.test(quantity)) {
			$quantity.val(parseInt(quantity) + 1);
		} else {
			$quantity.val(1);
		}
		edit($quantity);
	});
	
	// 减少数量
	$decrease.click(function() {
		var $quantity = $(this).parent().siblings("input");
		var quantity = $quantity.val();
		if (/^\d*[1-9]\d*$/.test(quantity) && parseInt(quantity) > 1) {
			$quantity.val(parseInt(quantity) - 1);
		} else {
			$quantity.val(1);
		}
		edit($quantity);
	});
	
	// 编辑数量
	$quantity.bind("input propertychange change", function(event) {
		if (event.type != "propertychange" || event.originalEvent.propertyName == "value") {
			edit($(this));
		}
	});
	
	// 编辑数量
	function edit($quantity) {
		var quantity = $quantity.val();
		if (/^\d*[1-9]\d*$/.test(quantity)) {
			var $tr = $quantity.closest("tr");
			var id = $tr.find("input[name='id']").val();
			clearTimeout(timeouts[id]);
			timeouts[id] = setTimeout(function() {
				$.ajax({
					url: "edit.jhtml",
					type: "POST",
					data: {id: id, quantity: quantity},
					dataType: "json",
					cache: false,
					beforeSend: function() {
						$submit.prop("disabled", true);
					},
					success: function(data) {
						if (data.message.type == "success") {
							$quantity.data("value", quantity);
							$tr.find("span.subtotal").text(currency(data.subtotal, true));
							if (data.giftItems != null && data.giftItems.length > 0) {
								$giftItems.html('<dt>赠品:<\/dt>');
								$.each(data.giftItems, function(i, giftItem) { 
									$giftItems.append('<dd><a href="' + giftItem.gift.path + '" title="' + giftItem.gift.fullName + '" target="_blank">' + giftItem.gift.fullName.substring(0, 50) + ' * ' + giftItem.quantity + '<\/a><\/dd>');
								});
								$giftItems.show();
							} else {
								$giftItems.hide();
							}
							if (data.promotions != null && data.promotions.length > 0) {
								var promotionName = "";
								$.each(data.promotions, function(i, promotion) { 
									promotionName += promotion.name + " ";
								});
								$promotion.text(promotionName);
							} else {
								$promotion.empty();
							}
							if (!data.isLowStock) {
								$tr.find("span.lowStock").remove();
							}
							$effectivePoint.text(data.effectivePoint);
							$effectivePrice.text(currency(data.effectivePrice, true, true));
						} else if (data.message.type == "warn") {
							$.message(data.message);
							$quantity.val($quantity.data("value"));
						} else if (data.message.type == "error") {
							$.message(data.message);
							$quantity.val($quantity.data("value"));
							setTimeout(function() {
								location.reload(true);
							}, 3000);
						}
					},
					complete: function() {
						$submit.prop("disabled", false);
					}
				});
			}, 500);
		} else {
			$quantity.val($quantity.data("value"));
		}
	}

	// 删除
	
	
	
	// 提交
	$submit.click(function() {
		if (!$.checkLogin()) {
			$.redirectLogin("/cart/list.jhtml", "必须登录后才能提交订单");
			return false;
		}
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
<div class="container header">
	<div class="span5">
		<div class="logo">
			<a href="../../index.html">
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
					<li>
							<a href=" ">aaa</a>
							|
					</li>
				 <li id="headerLogout" class="headerLogout">
					<a href="#">[退出]</a>|
				</li>
			</ul>
		</div>
		<div class="cart">
			<a href="list.jhtml.html">购物车</a>
		</div>
			<div class="phone">
				客服热线:
				<strong>400-8888888</strong>
			</div>
	</div>
	<div class="span24">
		<ul class="mainNav">
						<li>
						<a href="<%=arr_center.get(i).getnUrl() %>">aaa</a>
						|
					</li>
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
				<form id="productSearchForm" action="../product/search.html" method="get">
					<input name="keyword" class="keyword" value="商品搜索" maxlength="30" />
					<button type="submit">搜索</button>
				</form>
			</div>
		</div>
	</div>
</div>	<div class="container cart">
		<div class="span24">
			<div class="step step1">
				<ul>
					<li class="current">查看购物车</li>
					<li>订单信息</li>
					<li>完成订单</li>
				</ul>
			</div>
				<table>
					<tr>
						<th>图片</th>
						<th>商品</th>
						<th>价格</th>
						<th>数量</th>
						<th>小计</th>
						<th>操作</th>
					</tr>
						<tr>
							<td width="60">
								<input type="hidden" name="id" value="18427" />
								<img src="../../upload/image/<%=pdi_car.getpPhoto() %>" alt="" />
							</td>
							<td>
								<a href=" " title="aaa" target="_blank">aaa</a>
							</td>
							<td>
								￥aaa
							</td>
							<td class="quantity" width="60">
								<input type="text" name="quantity" value="1" maxlength="4" onpaste="return false;" />
								<div>
									<span class="increase">&nbsp;</span>
									<span class="decrease">&nbsp;</span>
								</div>
							</td>
							<td width="140">
								<span class="subtotal">￥aaa</span>
							</td>
							<td>
								<a href="#" onclick="deletes(1,a)" class="delete">删除</a>
							</td>
						</tr>
						<tr>
							<td align="center" colspan="6">购物车空空如也</td>
						</tr>
				</table>
				<dl id="giftItems" class="hidden">
				</dl>
				<div class="total">
					<em id="promotion">
					</em>
								<em>
								登录后确认是否享有优惠
								</em>
					赠送积分: <em id="effectivePoint">899</em>
					商品金额: <strong id="effectivePrice">￥aaa元</strong>
				</div>
				<div class="bottom">
					<a href="#" onclick="clears(2,1)" id="clear" class="clear">清空购物车</a>
					<a href="info_order_2.html" id="submit1" class="submit">提交订单</a>
				</div>
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
						<a href="<%=arr_bottom.get(i).getnUrl() %>">aaa</a>
						|
					</li>
		</ul>
	</div>
	<div class="span24">
		<div class="copyright">Copyright © 2005-2013 SHOP++商城 版权所有</div>
	</div>
<script charset="utf-8" type="text/javascript" src="http://wpa.b.qq.com/cgi/wpa.php?key=XzkzODAzMTQyM180MzkzMV80MDAwMDA3NDc3Xw"></script></div></body>
</html>

