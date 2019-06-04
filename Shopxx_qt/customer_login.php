<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>会员登录</title>
<meta name="author" content="hht" />
<meta name="copyright" content="hht" />
<link href="resources/shop/css/common.css" rel="stylesheet" type="text/css" />
<link href="resources/shop/css/login.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="resources/shop/js/jquery.js"></script>
<script type="text/javascript" src="resources/shop/js/jquery.validate.js"></script>
<script type="text/javascript" src="resources/shop/js/jsbn.js"></script>
<script type="text/javascript" src="resources/shop/js/prng4.js"></script>
<script type="text/javascript" src="resources/shop/js/rng.js"></script>
<script type="text/javascript" src="resources/shop/js/rsa.js"></script>
<script type="text/javascript" src="resources/shop/js/base64.js"></script>
<script type="text/javascript" src="resources/shop/js/common.js"></script>
<script type="text/javascript">
//    $().ready(function() {
//
//	var $loginForm = $("#loginForm");
//	var $username = $("#username");
//	var $password = $("#password");
//	var $captcha = $("#captcha");
//	var $captchaImage = $("#captchaImage");
//	var $isRememberUsername = $("#isRememberUsername");
//	var $submit = $(":submit");
//
//	// 记住用户名
//	if (getCookie("memberUsername") != null) {
//		$isRememberUsername.prop("checked", true);
//		$username.val(getCookie("memberUsername"));
//		$password.focus();
//	} else {
//		$isRememberUsername.prop("checked", false);
//		$username.focus();
//	}
//
//	// 更换验证码
//	$captchaImage.click(function() {
//		$captchaImage.attr("src", "/common/captcha.jhtml?captchaId=41a32969-d94c-4d5f-86a9-e40d055b35ab&timestamp=" + (new Date()).valueOf());
//	});
//
//	// 表单验证、记住用户名
//	$loginForm.validate({
//		rules: {
//			username: "required",
//			password: "required"
//				,captcha: "required"
//		},
//		submitHandler: function(form) {
//			$.ajax({
//				url: "/common/public_key.jhtml",
//				type: "GET",
//				dataType: "json",
//				cache: false,
//				beforeSend: function() {
//					$submit.prop("disabled", true);
//				},
//				success: function(data) {
//					var rsaKey = new RSAKey();
//					rsaKey.setPublic(b64tohex(data.modulus), b64tohex(data.exponent));
//					var enPassword = hex2b64(rsaKey.encrypt($password.val()));
//					$.ajax({
//						url: $loginForm.attr("action"),
//						type: "POST",
//						data: {
//							username: $username.val(),
//							enPassword: enPassword
//								,captchaId: "41a32969-d94c-4d5f-86a9-e40d055b35ab",
//								captcha: $captcha.val()
//						},
//						dataType: "json",
//						cache: false,
//						success: function(message) {
//							if ($isRememberUsername.prop("checked")) {
//								addCookie("memberUsername", $username.val(), {expires: 7 * 24 * 60 * 60});
//							} else {
//								removeCookie("memberUsername");
//							}
//							$submit.prop("disabled", false);
//							if (message.type == "success") {
//									location.href = "/member/index.jhtml";
//							} else {
//								$.message(message);
//									$captcha.val("");
//									$captchaImage.attr("src", "/common/captcha.jhtml?captchaId=41a32969-d94c-4d5f-86a9-e40d055b35ab&timestamp=" + (new Date()).valueOf());
//							}
//						}
//					});
//				}
//			});
//		}
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
				<li id="headerLogin" class="headerLogin">
					<a href="#">登录</a>|
				</li>
						<li>
							<a href="admin.html">管理后台</a>
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
						<a href="demo.shopxx.html">首页</a>
						|
					</li>
					<li>
						<a href="#">时尚女装</a>
						|
					</li>
					<li>
						<a href="#">精品男装</a>
						|
					</li>
					<li>
						<a href="#">精致内衣</a>
						|
					</li>
					<li>
						<a href="#">服饰配件</a>
						|
					</li>
					<li>
						<a href="#">时尚女鞋</a>
						|
					</li>
					<li>
						<a href="">流行男鞋</a>
						|
					</li>
					<li>
						<a href="">童装童鞋</a>
						
					</li>
		</ul>
	</div>
	<div class="span24">
		<div class="tagWrap">
			<ul class="tag">
						<li class="icon" style="background: url(http://storage.shopxx.net/demo-image/3.0/tag/hot.gif) right no-repeat;">
							<a href="product/list.jhtml~tagIds=1.html">热销</a>
						</li>
						<li class="icon" style="background: url(http://storage.shopxx.net/demo-image/3.0/tag/new.gif) right no-repeat;">
							<a href="product/list.jhtml~tagIds=2.html">最新</a>
						</li>
			</ul>
			<div class="hotSearch">
					热门搜索:
						<a href="#">T恤</a>
						<a href="product/search.jhtml~keyword=衬衫.html">衬衫</a>
						<a href="product/search.jhtml~keyword=西服.html">西服</a>
						<a href="product/search.jhtml~keyword=西裤.html">西裤</a>
						<a href="product/search.jhtml~keyword=森马.html">森马</a>
						<a href="#">七匹狼</a>
						<a href="#">梵希蔓</a>
						<a href="product/search.jhtml~keyword=春夏新款.html">春夏新款</a>
						<a href="#">牛仔裤</a>
			</div>
			<div class="search">
				<form id="productSearchForm" action="/product/search.jhtml" method="get">
					<input name="keyword" class="keyword" value="商品搜索" maxlength="30" />
					<button type="submit">搜索</button>
				</form>
			</div>
		</div>
	</div>
</div>	<div class="container login">

    <div class="span12">
<div class="ad">
					<img src="resources/images/ad/login.jpg" width="500" height="330" alt="会员登录" title="会员登录" />
</div>		</div>
    <form action="../Shopxx_qt/service/customer_count.php" method="post">
		<div class="span12 last">
			<div class="wrap">
				<div class="main">
					<div class="title">
						<strong>会员登录</strong>USER LOGIN
					</div>

						<table>
							<tr>
								<th>
										用户名/E-mail:
								</th>
								<td>
									<input type="text" id="username" name="cName" class="text" maxlength="20" />
								</td>
							</tr>
							<tr>
								<th>
									密&nbsp;&nbsp;码:
								</th>
								<td>
									<input type="password" id="password" name="cPwd" class="text" maxlength="20" />
								</td>
							</tr>

							<tr>
								<th>&nbsp;
									
								</th>
								<td>
									<label>
										<input type="checkbox" id="isRememberUsername" name="isRememberUsername" value="true" />记住用户名
									</label>
									<label>
										&nbsp;&nbsp;<a href="#">找回密码</a>
									</label>
								</td>
							</tr>
							<tr>
								<th>&nbsp;
									
								</th>
								<td>
									<input type="submit" class="submit" value="登 录" />
								</td>
							</tr>
							<tr class="register">
								<th>&nbsp;
									
								</th>
								<td>
									<dl>
										<dt>还没有注册账号？</dt>
										<dd>
											立即注册即可体验在线购物！
											<a href="register.php">立即注册</a>
										</dd>
									</dl>
								</td>
							</tr>
						</table>

                    </div>

			</div>

    </div>

</div>
</from>
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
		<div class="copyright">Copyright © 2005-2019 SHOP++商城 版权所有</div>
	</div>
<script charset="utf-8" type="text/javascript" src="http://wpa.b.qq.com/cgi/wpa.php?key=XzkzODAzMTQyM180MzkzMV80MDAwMDA3NDc3Xw"></script></div></body>
</html>
