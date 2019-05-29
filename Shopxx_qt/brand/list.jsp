<%@ page language="java" import="java.util.*" pageEncoding="UTF-8"%>
<%@page import="com.lc.vo.NavigationInfo"%>
<%@page import="com.lc.dao.imp.ManagerMentDaoImp"%>
<%@page import="com.lc.vo.ProductTypeInfo"%>
<%@page import="com.lc.dao.imp.ProductTypeDaoImp"%>
<%@page import="com.lc.vo.ArticleTypeinfo"%>
<%@page import="com.lc.vo.ArticleInfo"%>
<%@page import="com.lc.dao.imp.BrandDaoImp"%>
<%@page import="com.lc.vo.BrandInfo"%>
<%@page import="com.lc.vo.ProductInfo"%>
<%@page import="com.lc.dao.imp.ProductDaoImp"%>
<%
String path = request.getContextPath();
String basePath = request.getScheme()+"://"+request.getServerName()+":"+request.getServerPort()+path+"/";
ArrayList<ArrayList<NavigationInfo>> arr=new ManagerMentDaoImp().getOneArr();
ArrayList<NavigationInfo> arr_top=arr.get(0);
ArrayList<NavigationInfo> arr_center=arr.get(1);
ArrayList<NavigationInfo> arr_bottom=arr.get(2);
ProductTypeDaoImp pdi=new ProductTypeDaoImp();
HashMap<String,HashSet<ProductTypeInfo>> hm_type =pdi.getType();
ArrayList<ArticleTypeinfo>  arr_art=new ManagerMentDaoImp().getAllArticType();
ArrayList<ArticleInfo> arr_ar=new ManagerMentDaoImp().getAllArticleInfo();
BrandDaoImp bdi=new BrandDaoImp();
ArrayList<BrandInfo> arr_brand=bdi.getBrand();
 %>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>SHOP++商城 - Powered By SHOP++</title>
	<meta name="author" content="SHOP++ Team" />
	<meta name="copyright" content="SHOP++" />
		<meta name="keywords" content="SHOP++商城" />
		<meta name="description" content="SHOP++商城" />
<link href="../resources/shop/css/common.css" rel="stylesheet" type="text/css" />
<link href="../resources/shop/css/product.css" rel="stylesheet" type="text/css" />
<link href="../resources/shop/css/brand.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../resources/shop/js/jquery.js"></script>
<script type="text/javascript" src="../resources/shop/js/jquery.lazyload.js"></script>
<script type="text/javascript" src="../resources/shop/js/common.js"></script>
<script type="text/javascript">
$().ready(function() {

	var $logo = $("#list img");

	$logo.lazyload({
		threshold: 100,
		effect: "fadeIn"
	});
	
});
</script>
</head>
<body><!-- Copyright � 2005. Spidersoft Ltd -->
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
				<%
					for(int i=0;i<arr_top.size();i++){
					%>
					<li>
							<a href="../<%=arr_top.get(i).getnUrl() %>"><%=arr_top.get(i).getnName() %></a>
							|
						</li>
					<%
					}
				 %>
				 <li id="headerLogout" class="headerLogout">
					<a href="#">[退出]</a>|
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
					<%
					for(int i=0;i<arr_center.size();i++){
					%>
						<li>
						<a href="<%=arr_center.get(i).getnUrl() %>"><%=arr_center.get(i).getnName() %></a>
						|
					</li>
					<%
					}
				 %>
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
</div>	<div class="container brandList">
		<div class="span6">
			<div class="hotProductCategory">
							<%
								Set<String> hs=hm_type.keySet();
								Iterator it=hs.iterator();
								while(it.hasNext()){
									String s=(String)it.next();
									%>
									<dl>
							<dt>
								<a href="#"><%=s.substring(0,s.indexOf("_")) %></a>
							</dt>
									<%
									HashSet<ProductTypeInfo> hs_pt=hm_type.get(s);
									Iterator it_pt=hs_pt.iterator();
									while(it_pt.hasNext()){
										ProductTypeInfo pti=(ProductTypeInfo)it_pt.next();
									%>
									<dd>
										<a href="../product/search.jsp?ptid=<%=pti.getTypeId() %>"><%=pti.getTypeName() %></a>
									</dd>
									<%
	
									}
									%>
									</dl>
									<%
								}
									%>
			</div>
			<div class="hotProduct">
				<div class="title">热销商品</div>
				<ul>
							<li>
								<a href="../product/content/201306/279.html" title="尚都比拉2013春夏装新款女装 春款修身女裙 蕾丝雪纺短袖连衣裙子">尚都比拉2013春夏装新款女装 春款</a>
									<div>
										<div>评分: </div>
										<div class="score8"></div>
										<div>4.0</div>
									</div>
								<div>销售价: <strong>￥266.00元</strong></div>
								<div>月销量: <em>0</em></div>
							</li>
							<li>
								<a href="../product/content/201306/300.html" title="尚都比拉女装2013夏装新款蕾丝连衣裙 韩版修身雪纺打底裙子 春款">尚都比拉女装2013夏装新款蕾丝连</a>
								<div>销售价: <strong>￥298.00元</strong></div>
								<div>月销量: <em>0</em></div>
							</li>
							<li>
								<a href="../product/content/201306/122.html" title="OSA春装外套女春秋韩版泡泡袖女士小西装短外套W13254">OSA春装外套女春秋韩版泡泡袖女士</a>
									<div>
										<div>评分: </div>
										<div class="score8"></div>
										<div>4.0</div>
									</div>
								<div>销售价: <strong>￥288.00元</strong></div>
								<div>月销量: <em>0</em></div>
							</li>
							<li>
								<a href="../product/content/201306/241.html" title="婷美正品 四季款魔鬼瘦塑身衣套装瘦腰翘臀B罩杯">婷美正品 四季款魔鬼瘦塑身衣套装</a>
								<div>销售价: <strong>￥328.00元</strong></div>
								<div>月销量: <em>0</em></div>
							</li>
							<li>
								<a href="../product/content/201306/109.html" title="2013春夏柒牌男装正品西服 男立领修身韩版 西服套装 902C141200">2013春夏柒牌男装正品西服 男立领</a>
									<div>
										<div>评分: </div>
										<div class="score8"></div>
										<div>4.0</div>
									</div>
								<div>销售价: <strong>￥899.00元</strong></div>
								<div>月销量: <em>0</em></div>
							</li>
							<li>
								<a href="../product/content/201306/242.html" title="婷美正品秋冬保暖衣 轻压塑身衣美体衣保暖内衣 塑身内衣分体套装">婷美正品秋冬保暖衣 轻压塑身衣美</a>
								<div>销售价: <strong>￥658.00元</strong></div>
								<div>月销量: <em>0</em></div>
							</li>
							<li>
								<a href="../product/content/201306/298.html" title="尚都比拉2013夏装新款淑女装 春款森女系 碎花修身短袖蕾丝连衣裙">尚都比拉2013夏装新款淑女装 春款</a>
									<div>
										<div>评分: </div>
										<div class="score8"></div>
										<div>4.0</div>
									</div>
								<div>销售价: <strong>￥289.00元</strong></div>
								<div>月销量: <em>0</em></div>
							</li>
							<li>
								<a href="../product/content/201306/96.html" title="梵希蔓2013新款夏装甜美女装连衣裙短袖雪纺蕾丝拼接公主裙百褶裙">梵希蔓2013新款夏装甜美女装连衣</a>
								<div>销售价: <strong>￥268.00元</strong></div>
								<div>月销量: <em>0</em></div>
							</li>
							<li>
								<a href="../product/content/201306/246.html" title="维依恋2013夏装新款波西米亚印花雪纺半身裙抹胸连衣裙两穿长裙子">维依恋2013夏装新款波西米亚印花</a>
									<div>
										<div>评分: </div>
										<div class="score10"></div>
										<div>5.0</div>
									</div>
								<div>销售价: <strong>￥199.00元</strong></div>
								<div>月销量: <em>0</em></div>
							</li>
							<li class="last">
								<a href="../product/content/201306/221.html" title="2013新款夏季家居服女 大码全棉夏装家居睡衣 运动短袖短裤套装">2013新款夏季家居服女 大码全棉夏</a>
								<div>销售价: <strong>￥121.00元</strong></div>
								<div>月销量: <em>0</em></div>
							</li>
				</ul>
			</div>
		</div>
		<div class="span18 last">
			<div class="path">
				<ul>
					<li>
						<a href="../demo.shopxx.html">首页</a>
					</li>
					<li class="last">品牌</li>
				</ul>
			</div>
			<div id="list" class="list clearfix">
					<ul>
							<%
								for(int i=0;i<arr_brand.size();i++){
								BrandInfo bd=arr_brand.get(i);
								%>
								<li>
									<a href="content/brandInfo.jsp?bid=<%=bd.getBid() %>">
										<img src="<%=bd.getbLog() %>" />
										<span title="<%=bd.getbName() %>"><%=bd.getbName() %></span>
									</a>
								</li>
								<%
								}
							
							 %>
					
					</ul>
			</div>
		</div>
	</div>
<div class="container footer">
	<div class="span24">
		<div class="footerAd">
					<img src="../../storage.shopxx.net/demo-image/3.0/ad/footer.jpg" width="950" height="52" alt="我们的优势" title="我们的优势" />
</div>	</div>
	<div class="span24">
		<ul class="bottomNav">
						<%
					for(int i=0;i<arr_bottom.size();i++){
					%>
					<li>
						<a href="<%=arr_bottom.get(i).getnUrl() %>"><%=arr_bottom.get(i).getnName() %></a>
						|
					</li>
					
					<%
					}
				
				 %>
		</ul>
	</div>
	<div class="span24">
		<div class="copyright">Copyright © 2005-2013 SHOP++商城 版权所有</div>
	</div>
<script charset="utf-8" type="text/javascript" src="http://wpa.b.qq.com/cgi/wpa.php?key=XzkzODAzMTQyM180MzkzMV80MDAwMDA3NDc3Xw"></script></div></body>
</html>

