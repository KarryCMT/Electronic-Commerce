<?php
	require_once dirname(dirname(__FILE__)).'\util\DBUtil.php';
	header("ConTent-type:text/html;charset=utf-8");
	session_start();
	$obj=$_SESSION["name"];
	
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>订单信</title>
<meta name="author" content="hht" />
<meta name="copyright" content="hht" />
<link href="../resources/shop/css/common.css" rel="stylesheet" type="text/css" />
<link href="../resources/shop/css/order.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../resources/shop/js/jquery.js"></script>
<script type="text/javascript" src="../resources/shop/js/jquery.lSelect.js"></script>
<script type="text/javascript" src="../resources/shop/js/jquery.validate.js"></script>
<script type="text/javascript" src="../resources/shop/js/common.js"></script>
<script type="text/javascript">
$().ready(function() {

	var $dialogOverlay = $("#dialogOverlay");
	var $receiverForm = $("#receiverForm");
	var $receiver = $("#receiver ul");
	var $otherReceiverButton = $("#otherReceiverButton");
	var $newReceiverButton = $("#newReceiverButton");
	var $newReceiver = $("#newReceiver");
	var $areaId = $("#areaId");
	var $newReceiverSubmit = $("#newReceiverSubmit");
	var $newReceiverCancelButton = $("#newReceiverCancelButton");
	var $orderForm = $("#orderForm");
	var $receiverId = $("#receiverId");
	var $paymentMethodId = $("#paymentMethod :radio");
	var $shippingMethodId = $("#shippingMethod :radio");
	var $isInvoice = $("#isInvoice");
	var $invoiceTitleTr = $("#invoiceTitleTr");
	var $invoiceTitle = $("#invoiceTitle");
	var $code = $("#code");
	var $couponCode = $("#couponCode");
	var $couponName = $("#couponName");
	var $couponButton = $("#couponButton");
	var $useBalance = $("#useBalance");
	var $freight = $("#freight");
	var $promotionDiscount = $("#promotionDiscount");
	var $couponDiscount = $("#couponDiscount");
	var $tax = $("#tax");
	var $amountPayable = $("#amountPayable");
	var $submit = $("#submit");
	var shippingMethodIds = {};
	
shippingMethodIds["1"] = [ "1", "2" ]; shippingMethodIds["2"] = [ "1", "2" ]; shippingMethodIds["3"] = [ "2" ];	
	
	// 地区选择
	$areaId.lSelect({
		url: "/common/area.jhtml"
	});
	
	// 收货地址
	$("#receiver li").live("click", function() {
		var $this = $(this);
		$receiverId.val($this.attr("receiverId"));
		$("#receiver li").removeClass("selected");
		$this.addClass("selected");
			if ($.trim($invoiceTitle.val()) == "") {
				$invoiceTitle.val($this.find("strong").text());
			}
	});
	
	// 其它收货地址
	$otherReceiverButton.click(function() {
		$otherReceiverButton.hide();
		$newReceiverButton.show();
		$("#receiver li").show();
	});
	
	// 新收货地址
	$newReceiverButton.click(function() {
		$dialogOverlay.show();
		$newReceiver.show();
	});
	
	// 新收货地址取消
	$newReceiverCancelButton.click(function() {
		if ($receiverId.val() == "") {
			$.message("warn", "必须新增一个收货地址");
			return false;
		}
		$dialogOverlay.hide();
		$newReceiver.hide();
	});
	
	// 计算
	function calculate() {
		$.ajax({
			url: "calculate.jhtml",
			type: "POST",
			data: $orderForm.serialize(),
			dataType: "json",
			cache: false,
			success: function(data) {
				if (data.message.type == "success") {
					$freight.text(currency(data.freight, true));
					if (data.promotionDiscount > 0) {
						$promotionDiscount.text(currency(data.promotionDiscount, true));
						$promotionDiscount.parent().show();
					} else {
						$promotionDiscount.parent().hide();
					}
					if (data.couponDiscount > 0) {
						$couponDiscount.text(currency(data.couponDiscount, true));
						$couponDiscount.parent().show();
					} else {
						$couponDiscount.parent().hide();
					}
					if (data.tax > 0) {
						$tax.text(currency(data.tax, true));
						$tax.parent().show();
					} else {
						$tax.parent().hide();
					}
					$amountPayable.text(currency(data.amountPayable, true, true));
				} else {
					$.message(data.message);
					setTimeout(function() {
						location.reload(true);
					}, 3000);
				}
			}
		});
	}
	
	// 支付方式
	$paymentMethodId.click(function() {
		var $this = $(this);
		if ($this.prop("disabled")) {
			return false;
		}
		$this.closest("dd").addClass("selected").siblings().removeClass("selected");
		var paymentMethodId = $this.val();
		$shippingMethodId.each(function() {
			var $this = $(this);
			if ($.inArray($this.val(), shippingMethodIds[paymentMethodId]) >= 0) {
				$this.prop("disabled", false);
			} else {
				$this.prop("disabled", true).prop("checked", false).closest("dd").removeClass("selected");
			}
		});
		calculate();
	});
	
	// 配送方式
	$shippingMethodId.click(function() {
		var $this = $(this);
		if ($this.prop("disabled")) {
			return false;
		}
		$this.closest("dd").addClass("selected").siblings().removeClass("selected");
		calculate();
	});
	
	// 开据发票
	$isInvoice.click(function() {
		$invoiceTitleTr.toggle();
		calculate();
	});
	
	// 优惠券
	$couponButton.click(function() {
		if ($code.val() == "") {
			if ($.trim($couponCode.val()) == "") {
				return false;
			}
			$.ajax({
				url: "coupon_info.jhtml",
				type: "POST",
				data: {code : $couponCode.val()},
				dataType: "json",
				cache: false,
				beforeSend: function() {
					$couponButton.prop("disabled", true);
				},
				success: function(data) {
					if (data.message.type == "success") {
						$code.val($couponCode.val());
						$couponCode.hide();
						$couponName.text(data.couponName).show();
						$couponButton.text("取 消");
						calculate();
					} else {
						$.message(data.message);
					}
				},
				complete: function() {
					$couponButton.prop("disabled", false);
				}
			});
		} else {
			$code.val("");
			$couponCode.show();
			$couponName.hide();
			$couponButton.text("确 认");
			calculate();
		}
	});
	
	// 使用余额
	$useBalance.click(function() {
		calculate();
	});
	
	// 订单提交
	$submit.click(function() {
		var $checkedPaymentMethodId = $paymentMethodId.filter(":checked");
		var $checkedShippingMethodId = $shippingMethodId.filter(":checked");
		if ($checkedPaymentMethodId.size() == 0) {
			$.message("warn", "请选择支付方式");
			return false;
		}
		if ($checkedShippingMethodId.size() == 0) {
			$.message("warn", "请选择配送方式");
			return false;
		}
			if ($isInvoice.prop("checked") && $.trim($invoiceTitle.val()) == "") {
				$.message("warn", "请填写发票抬头");
				return false;
			}
		$.ajax({
			url: "create.jhtml",
			type: "POST",
			data: $orderForm.serialize(),
			dataType: "json",
			cache: false,
			beforeSend: function() {
				$submit.prop("disabled", true);
			},
			success: function(message) {
				if (message.type == "success") {
					location.href = "payment.jhtml?sn=" + message.content;
				} else {
					$.message(message);
					setTimeout(function() {
						location.reload(true);
					}, 3000);
				}
			},
			complete: function() {
				$submit.prop("disabled", false);
			}
		});
	});
	
	// 表单验证
	$receiverForm.validate({
		rules: {
			consignee: "required",
			areaId: "required",
			address: "required",
			zipCode: "required",
			phone: "required"
		},
		submitHandler: function(form) {
			$.ajax({
				url: "/member/order/save_receiver.jhtml",
				type: "POST",
				data: $receiverForm.serialize(),
				dataType: "json",
				cache: false,
				beforeSend: function() {
					$newReceiverSubmit.prop("disabled", true);
				},
				success: function(data) {
					if (data.message.type == "success") {
						$receiverId.val(data.receiver.id);
						$("#receiver li").removeClass("selected");
						$receiver.append('<li class="selected" receiverId="' + data.receiver.id + '"><div><strong>' + data.receiver.consignee + '<\/strong> 收<\/div><div><span>' + data.receiver.areaName + data.receiver.address + '<\/span><\/div><div>' + data.receiver.phone + '<\/div><\/li>');
						$dialogOverlay.hide();
						$newReceiver.hide();
							if ($.trim($invoiceTitle.val()) == "") {
								$invoiceTitle.val(data.receiver.consignee);
							}
					} else {
						$.message(data.message);
					}
				},
				complete: function() {
					$newReceiverSubmit.prop("disabled", false);
				}
			});
		}
	});
	
});
</script>
</head>
<body>
	<div id="dialogOverlay" class="dialogOverlay"></div>
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
					<a href="../register.php">注册</a>|
				</li>
				<li id="headerUsername" class="headerUsername"></li>
				<li id="headerLogout" class="headerLogout">
					<a href="http://demo.shopxx.net/logout.jhtml">[退出]</a>|
				</li>
						<li>
							<a href="../admin.html">管理后台</a>
							|
						</li>
						<li>
							<a href="http://demo.shopxx.net/member/index.jhtml">会员中心</a>
							|
						</li>
						<li>
							<a href="http://demo.shopxx.net/article/list/7.jhtml">关于我们</a>
							
						</li>
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
					<li>
						<a href="../demo.shopxx.html">首页</a>
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
							<a href="../product/list.jhtml~tagIds=1.html">热销</a>
						</li>
						<li class="icon" style="background: url(http://storage.shopxx.net/demo-image/3.0/tag/new.gif) right no-repeat;">
							<a href="../product/list.jhtml~tagIds=2.html">最新</a>
						</li>
			</ul>
			<div class="hotSearch">
					热门搜索:
						<a href="">T恤</a>
						<a href="">衬衫</a>
						<a href="">西服</a>
						<a href="">西裤</a>
						<a href="">森马</a>
						<a href="">七匹狼</a>
						<a href="">梵希蔓</a>
						<a href="">春夏新款</a>
						<a href="">牛仔裤</a>
			</div>
			<div class="search">
				<form id="productSearchForm" action="/product/search.jhtml" method="get">
					<input name="keyword" class="keyword" value="商品搜索" maxlength="30" />
					<button type="submit">搜索</button>
				</form>
			</div>
		</div>
	</div>
</div>	<div class="container order">
		<div class="span24">
			<div class="step step2">
				<ul>
					<li>订单信息</li>
					<li class="current">查看购物车</li>
					<li>完成订单</li>
				</ul>
			</div>
			<div class="info">
				<form id="receiverForm" action="save_receiver.jhtml" method="post">
					<div id="receiver" class="receiver clearfix">
						<div class="title">收货地址</div>
						<ul>
								<li class="selected" receiverId="2890">
									<div>
										<strong>大家好</strong> 收
									</div>
									<div>
										<span>北京市东城区才是真的好</span>
									</div>
									<div>
										11
									</div>
								</li>
						</ul>
						<p>
							<a href="javascript:;" id="newReceiverButton" class="button">使用新地址</a>
						</p>
					</div>
					<table id="newReceiver" class="newReceiver hidden">
						<tr>
							<th width="100">
								<span class="requiredField">*</span>收货人:
							</th>
							<td>
								<input type="text" id="consignee" name="consignee" class="text" maxlength="200" />
							</td>
						</tr>
						<tr>
							<th>
								<span class="requiredField">*</span>地区:
							</th>
							<td>
								<span class="fieldSet">
									<input type="hidden" id="areaId" name="areaId" />
								</span>
							</td>
						</tr>
						<tr>
							<th>
								<span class="requiredField">*</span>地址:
							</th>
							<td>
								<input type="text" id="address" name="address" class="text" maxlength="200" />
							</td>
						</tr>
						<tr>
							<th>
								<span class="requiredField">*</span>邮编:
							</th>
							<td>
								<input type="text" id="zipCode" name="zipCode" class="text" maxlength="200" />
							</td>
						</tr>
						<tr>
							<th>
								<span class="requiredField">*</span>手机/电话:
							</th>
							<td>
								<input type="text" id="phone" name="phone" class="text" maxlength="200" />
							</td>
						</tr>
						<tr>
							<th>
								默认:
							</th>
							<td>
								<input type="checkbox" name="isDefault" value="true" />
								<input type="hidden" name="_isDefault" value="false" />
							</td>
						</tr>
						<tr>
							<th>&nbsp;
								
							</th>
							<td>
								<input type="submit" id="newReceiverSubmit" class="button" value="确&nbsp;&nbsp;定" />
								<input type="button" id="newReceiverCancelButton" class="button" value="取&nbsp;&nbsp;消" />
							</td>
						</tr>
					</table>
				</form>
				<form id="orderForm" action="create.jhtml" method="post">
					<input type="hidden" id="receiverId" name="receiverId" value="2890" />
					<input type="hidden" name="cartToken" value="7b25f70968cbb2ae8c2524ed1ea6cac9" />
					<dl id="paymentMethod" class="select">
						<dt>支付方式</dt>
							<dd>
								<label for="paymentMethod_1">
									<input type="radio" id="paymentMethod_1" name="paymentMethodId" value="1" />
									<span>
											<em style="border-right: none; background: url(http://storage.shopxx.net/demo-image/3.0/payment_method/online.gif) center no-repeat;">&nbsp;</em>
										<strong>网上支付</strong>
									</span>
									<span>支持支付宝、财付通、以及大多数网上银行支付</span>
								</label>
							</dd>
							<dd>
								<label for="paymentMethod_2">
									<input type="radio" id="paymentMethod_2" name="paymentMethodId" value="2" />
									<span>
											<em style="border-right: none; background: url(http://storage.shopxx.net/demo-image/3.0/payment_method/remittance.gif) center no-repeat;">&nbsp;</em>
										<strong>银行汇款</strong>
									</span>
									<span>支持工行、建行、农行汇款支付，收款时间一般为汇款后的1-2个工作日</span>
								</label>
							</dd>
							<dd>
								<label for="paymentMethod_3">
									<input type="radio" id="paymentMethod_3" name="paymentMethodId" value="3" />
									<span>
											<em style="border-right: none; background: url(http://storage.shopxx.net/demo-image/3.0/payment_method/cash_on_delivery.gif) center no-repeat;">&nbsp;</em>
										<strong>货到付款</strong>
									</span>
									<span>由快递公司送货上门，您签收后直接将货款交付给快递员</span>
								</label>
							</dd>
					</dl>
					<dl id="shippingMethod" class="select">
						<dt>配送方式</dt>
							<dd>
								<label for="shippingMethod_1">
									<input type="radio" id="shippingMethod_1" name="shippingMethodId" value="1" />
									<span>
											<em style="border-right: none; background: url(http://storage.shopxx.net/demo-image/3.0/shipping_method/normal.gif) center no-repeat;">&nbsp;</em>
										<strong>普通快递</strong>
									</span>
									<span>系统将根据您的收货地址自动匹配快递公司进行配送，享受免运费服务</span>
								</label>
							</dd>
							<dd>
								<label for="shippingMethod_2">
									<input type="radio" id="shippingMethod_2" name="shippingMethodId" value="2" />
									<span>
											<em style="border-right: none; background: url(http://storage.shopxx.net/demo-image/3.0/shipping_method/shunfeng.gif) center no-repeat;">&nbsp;</em>
										<strong>顺丰速递</strong>
									</span>
									<span>需支付10元配送费用，不享受免运费服务</span>
								</label>
							</dd>
					</dl>
						<table>
							<tr>
								<th colspan="2">发票信息</th>
							</tr>
							<tr>
								<td width="100">
									开据发票:
								</td>
								<td>
									<label for="isInvoice">
										<input type="checkbox" id="isInvoice" name="isInvoice" value="true" />
										(发票税金: 6%)
									</label>
								</td>
							</tr>
							<tr id="invoiceTitleTr" class="hidden">
								<td width="100">
									发票抬头:
								</td>
								<td>
									<input type="text" id="invoiceTitle" name="invoiceTitle" class="text" value="大家好" maxlength="200" />
								</td>
							</tr>
						</table>
					<table class="product">
						<tr>
							<th width="60">图片</th>
							<th>商品</th>
							<th>价格</th>
							<th>数量</th>
							<th>小计</th>
						</tr>
							<tr>
								<td>
									<img src="../resources/images/images_product/2553e635-7aa4-416a-83f4-5288145684a1-thumbnail.jpg" alt="尚都比拉2013春夏装新款女装 春款修身女裙 蕾丝雪纺短袖连衣裙子" />
								</td>
								<td>
									<a href="../product/content/productInfo.html" title="尚都比拉2013春夏装新款女装 春款修身女裙 蕾丝雪纺短袖连衣裙子[粉红色 S]" target="_blank">尚都比拉2013春夏装新款女装 春款修身女裙 蕾丝雪纺短...</a>
								</td>
								<td>
										￥266.00
								</td>
								<td>
									1
								</td>
								<td>
										￥266.00
								</td>
							</tr>
							<tr>
								<td>
									<img src="../resources/images/images_product/40e34b2d-d240-446e-9874-89969edbe89f-thumbnail.jpg" alt="Max Toney 春夏男士休闲西服西装 永不起褶休闲小西装外套 男627" />
								</td>
								<td>
									<a href="../product/content/productInfo.html" title="Max Toney 春夏男士休闲西服西装 永不起褶休闲小西装外套 男627[黑色 M]" target="_blank">Max Toney 春夏男士休闲西服西装 永不起褶休闲小西装外...</a>
								</td>
								<td>
										￥422.00
								</td>
								<td>
									1
								</td>
								<td>
										￥422.00
								</td>
							</tr>
					</table>
					<div class="span12">
						<dl class="memo">
							<dt>附&nbsp;&nbsp;&nbsp;言:</dt>
							<dd>
								<input type="text" name="memo" maxlength="200" />
							</dd>
						</dl>
						<dl class="coupon">
							<dt>优惠券:</dt>
							<dd>
								<input type="hidden" id="code" name="code" maxlength="200" />
								<input type="text" id="couponCode" maxlength="200" />
								<span id="couponName">&nbsp;</span>
								<button type="button" id="couponButton">确 认</button>
							</dd>
						</dl>
					</div>
					<div class="span12 last">
						<ul class="statistic">
							<li>
								<span>
									运费: <em id="freight">￥0.00</em>
								</span>
									<span class="hidden">
										税金: <em id="tax">￥0.00</em>
									</span>
								<span>
									积分: <em>688</em>
								</span>
							</li>
							<li>
								<span class="hidden">
									促销折扣: <em id="promotionDiscount">￥0.00</em>
								</span>
								<span class="hidden">
									优惠券折扣: <em id="couponDiscount">￥0.00</em>
								</span>
							</li>
							<li>
								<span>
									应付金额: <strong id="amountPayable">￥688.00元</strong>
								</span>
							</li>
						</ul>
					</div>
					<div class="span24">
						<div class="bottom">
							<a href="list.html" class="back">返回购物车</a>
							<a href="payment.html" id="submit1" class="submit">提交订单</a>
						</div>
					</div>
				</form>
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
