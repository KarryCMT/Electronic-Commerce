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
<%@page import="com.lc.vo.proImgListInfo"%>
<%@page import="com.lc.dao.imp.ProAttValueDaoImp"%>
<%@page import="com.lc.vo.ProTypeAttributeInfo"%>
<%@page import="com.lc.dao.imp.EvaluationDaoImp"%>
<%@page import="com.lc.vo.ProductEvaluationInfo"%>
<%
String path = request.getContextPath();
String basePath = request.getScheme()+"://"+request.getServerName()+":"+request.getServerPort()+path+"/";
ProductDaoImp pdi=new ProductDaoImp();
int pid=0;
if(request.getParameter("pid")!=null){
	pid=Integer.parseInt(request.getParameter("pid"));
}
ProductInfo pInfo=pdi.getOnePro(pid);
ArrayList<ArrayList<NavigationInfo>> arr=new ManagerMentDaoImp().getOneArr();
ArrayList<NavigationInfo> arr_top=arr.get(0);
ArrayList<NavigationInfo> arr_center=arr.get(1);
ArrayList<NavigationInfo> arr_bottom=arr.get(2);
ProductTypeDaoImp ptdi=new ProductTypeDaoImp();
HashMap<String,HashSet<ProductTypeInfo>> hm_type =ptdi.getType();
ProAttValueDaoImp pavdi=new ProAttValueDaoImp();
ArrayList<ProTypeAttributeInfo> arr_att=pavdi.getProAtt(pid);
EvaluationDaoImp edi=new EvaluationDaoImp();
ArrayList<ProductEvaluationInfo> arr_pei=edi.getEvaluation(pid);
%>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title><%=pInfo.getpName() %></title>
	<meta name="author" content="hht" />
	<meta name="copyright" content="hht" />
		<meta name="keywords" content="<%=pInfo.getpName() %>" />
		<meta name="description" content="<%=pInfo.getpName() %>" />
<link href="../../resources/shop/css/common.css" rel="stylesheet" type="text/css" />
<link href="../../resources/shop/css/product.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../../resources/shop/js/jquery.js"></script>
<script type="text/javascript" src="../../resources/shop/js/jquery.tools.js"></script>
<script type="text/javascript" src="../../resources/shop/js/jquery.jqzoom.js"></script>
<script type="text/javascript" src="../../resources/shop/js/jquery.validate.js"></script>
<script type="text/javascript" src="../../resources/shop/js/common.js"></script>
<script type="text/javascript">
function submit(){
	document.getElementById("formCar").submit();
}

$().ready(function() {

	var $historyProduct = $("#historyProduct ul");
	var $clearHistoryProduct = $("#clearHistoryProduct");
	var $zoom = $("#zoom");
	var $scrollable = $("#scrollable");
	var $thumbnail = $("#scrollable a");
	var $specification = $("#specification dl");
	var $specificationTitle = $("#specification div");
	var $specificationValue = $("#specification a");
	var $productNotifyForm = $("#productNotifyForm");
	var $productNotify = $("#productNotify");
	var $productNotifyEmail = $("#productNotify input");
	var $addProductNotify = $("#addProductNotify");
	var $quantity = $("#quantity");
	var $increase = $("#increase");
	var $decrease = $("#decrease");
	var $addCart = $("#addCart");
	var $addFavorite = $("#addFavorite");
	var $window = $(window);
	var $bar = $("#bar ul");
	var $introductionTab = $("#introductionTab");
	var $parameterTab = $("#parameterTab");
	var $reviewTab = $("#reviewTab");
	var $consultationTab = $("#consultationTab");
	var $introduction = $("#introduction");
	var $parameter = $("#parameter");
	var $review = $("#review");
	var $addReview = $("#addReview");
	var $consultation = $("#consultation");
	var $addConsultation = $("#addConsultation");
	var barTop = $bar.offset().top;
	var productMap = {};
productMap[1] = { path: null, specificationValues: [ "10", "44" ] }; productMap[177] = { path: "177.html", specificationValues: [ "10", "45" ] }; productMap[176] = { path: "176.html", specificationValues: [ "10", "46" ] }; productMap[175] = { path: "175.html", specificationValues: [ "10", "47" ] };	
	// 锁定规格值
	lockSpecificationValue();
	
	// 商品图片放大镜
	$zoom.jqzoom({
		zoomWidth: 368,
		zoomHeight: 368,
		title: false,
		showPreload: false,
		preloadImages: false
	});
	
	// 商品缩略图滚动
	$scrollable.scrollable();
	
	$thumbnail.hover(function() {
		var $this = $(this);
		if ($this.hasClass("current")) {
			return false;
		} else {
			$thumbnail.removeClass("current");
			$this.addClass("current").click();
		}
	});
	
	// 规格值选择
	$specificationValue.click(function() {
		var $this = $(this);
		if ($this.hasClass("locked")) {
			return false;
		}
		$this.toggleClass("selected").parent().siblings().children("a").removeClass("selected");
		var selectedIds = new Array();
		$specificationValue.filter(".selected").each(function(i) {
			selectedIds[i] = $(this).attr("val");
		});
		var locked = true;
/*		$.each(productMap, function(i, product) {
			if (product.specificationValues.length == selectedIds.length && contains(product.specificationValues, selectedIds)) {
				if (product.path != null) {
					location.href = "" + product.path;
					locked = false;
				}
				return false;
			}
		});*/
		if (locked) {
			//lockSpecificationValue();
		}
		$specificationTitle.hide();
		return false;
	});
	
	// 锁定规格值
	function lockSpecificationValue() {
		var selectedIds = new Array();
		$specificationValue.filter(".selected").each(function(i) {
			selectedIds[i] = $(this).attr("val");
		});
		$specification.each(function() {
			var $this = $(this);
			var selectedId = $this.find("a.selected").attr("val");
			var otherIds = $.grep(selectedIds, function(n, i) {
				return n != selectedId;
			});
			$this.find("a").each(function() {
				var $this = $(this);
				otherIds.push($this.attr("val"));
				var locked = true;
				$.each(productMap, function(i, product) {
					if (contains(product.specificationValues, otherIds)) {
						locked = false;
						return false;
					}
				});
				if (locked) {
					$this.addClass("locked");
				} else {
					$this.removeClass("locked");
				}
				otherIds.pop();
			});
		});
	}
	
	// 判断是否包含
	function contains(array, values) {
		var contains = true;
		for(i in values) {
			if ($.inArray(values[i], array) < 0) {
				contains = false;
				break;
			}
		}
		return contains;
	}
	
	
	// 购买数量
	$quantity.keypress(function(event) {
		var key = event.keyCode ? event.keyCode : event.which;
		if ((key >= 48 && key <= 57) || key==8) {
			return true;
		} else {
			return false;
		}
	});
	
	// 增加购买数量
	$increase.click(function() {
		var quantity = $quantity.val();
		if (/^\d*[1-9]\d*$/.test(quantity)) {
			$quantity.val(parseInt(quantity) + 1);
		} else {
			$quantity.val(1);
		}
	});
	
	// 减少购买数量
	$decrease.click(function() {
		var quantity = $quantity.val();
		if (/^\d*[1-9]\d*$/.test(quantity) && parseInt(quantity) > 1) {
			$quantity.val(parseInt(quantity) - 1);
		} else {
			$quantity.val(1);
		}
	});
	
	// 加入购物车
	$addCart.click(function() {
			var specificationValueIds = new Array();
			$specificationValue.filter(".selected").each(function(i) {
				specificationValueIds[i] = $(this).attr("val");
			});
			if (specificationValueIds.length != 2) {
				$specificationTitle.show();
				return false;
			}
		var quantity = $quantity.val();
		if (/^\d*[1-9]\d*$/.test(quantity) && parseInt(quantity) > 0) {
			$.ajax({
				url: "/cart/add.jhtml",
				type: "POST",
				data: {id: 1, quantity: quantity},
				dataType: "json",
				cache: false,
				success: function(message) {
					$.message(message);
				}
			});
		} else {
			$.message("warn", "购买数量必须为正整数");
		}
	});
	

	
	
		// 发表商品评论
		$addReview.click(function() {
			if ($.checkLogin()) {
				return true;
			} else {
				$.redirectLogin("/review/add/1.jhtml", "必须登录后才能发表商品评论");
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
			<a href="../../index.jsp">
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
				<%
					for(int i=0;i<arr_top.size();i++){
					%>
					<li>
							<a href="../../<%=arr_top.get(i).getnUrl() %>"><%=arr_top.get(i).getnName() %></a>
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
			<a href="../../cart/list_cart.jsp">购物车</a>
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
							<a href="../../list.jhtml~tagIds=1.html">热销</a>
						</li>
						<li class="icon" style="background: url(http://storage.shopxx.net/demo-image/3.0/tag/new.gif) right no-repeat;">
							<a href="../../list.jhtml~tagIds=2.html">最新</a>
						</li>
			</ul>
			<div class="hotSearch">
					热门搜索:
						<a href="http://demo.shopxx.net/product/search.jhtml?keyword=T%E6%81%A4">T恤</a>
						<a href="../../search.jhtml~keyword=衬衫.html">衬衫</a>
						<a href="../../search.jhtml~keyword=西服.html">西服</a>
						<a href="../../search.jhtml~keyword=西裤.html">西裤</a>
						<a href="../../search.jhtml~keyword=森马.html">森马</a>
						<a href="http://demo.shopxx.net/product/search.jhtml?keyword=%E4%B8%83%E5%8C%B9%E7%8B%BC">七匹狼</a>
						<a href="http://demo.shopxx.net/product/search.jhtml?keyword=%E6%A2%B5%E5%B8%8C%E8%94%93">梵希蔓</a>
						<a href="../../search.jhtml~keyword=春夏新款.html">春夏新款</a>
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
</div>	<div class="container productContent">
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
										<a href="../search.jsp?ptid=<%=pti.getTypeId() %>"><%=pti.getTypeName() %></a>
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
								<a href="279.html" title="尚都比拉2013春夏装新款女装 春款修身女裙 蕾丝雪纺短袖连衣裙子">尚都比拉2013春夏装新款女装 春款</a>
									<div>
										<div>评分: </div>
										<div class="score8"></div>
										<div>4.0</div>
									</div>
								<div>销售价: <strong>￥266.00元</strong></div>
								<div>月销量: <em>0</em></div>
							</li>
							<li>
								<a href="298.html" title="尚都比拉2013夏装新款淑女装 春款森女系 碎花修身短袖蕾丝连衣裙">尚都比拉2013夏装新款淑女装 春款</a>
									<div>
										<div>评分: </div>
										<div class="score8"></div>
										<div>4.0</div>
									</div>
								<div>销售价: <strong>￥289.00元</strong></div>
								<div>月销量: <em>0</em></div>
							</li>
							<li>
								<a href="300.html" title="尚都比拉女装2013夏装新款蕾丝连衣裙 韩版修身雪纺打底裙子 春款">尚都比拉女装2013夏装新款蕾丝连</a>
								<div>销售价: <strong>￥298.00元</strong></div>
								<div>月销量: <em>0</em></div>
							</li>
							<li>
								<a href="267.html" title="唯维欣怡2013春夏季新款韩版大码宽松显瘦女装荷叶边雪纺连衣裙子">唯维欣怡2013春夏季新款韩版大码</a>
								<div>销售价: <strong>￥206.00元</strong></div>
								<div>月销量: <em>0</em></div>
							</li>
							<li>
								<a href="290.html" title="尚都比拉2013夏装新款 韩版优雅甜美淑女装 春款蕾丝雪纺连衣裙子">尚都比拉2013夏装新款 韩版优雅甜</a>
									<div>
										<div>评分: </div>
										<div class="score10"></div>
										<div>5.0</div>
									</div>
								<div>销售价: <strong>￥299.00元</strong></div>
								<div>月销量: <em>0</em></div>
							</li>
							<li class="last">
								<a href="30.html" title="梵希蔓 2013夏装新款女装女裙子长款雪纺百褶连衣裙韩版修身裙子">梵希蔓 2013夏装新款女装女裙子长</a>
									<div>
										<div>评分: </div>
										<div class="score10"></div>
										<div>5.0</div>
									</div>
								<div>销售价: <strong>￥308.00元</strong></div>
								<div>月销量: <em>0</em></div>
							</li>
				</ul>
			</div>
			<div id="historyProduct" class="historyProduct">
				<div class="title">最近浏览过的</div>
				<ul></ul>
				<a href="javascript:;" id="clearHistoryProduct" class="clearHistoryProduct">清除历史记录</a>
			</div>
		</div>
		<div class="span18 last">
			<div class="path">
				<ul>
					<li>
						<a href="../../demo.shopxx.html">首页</a>
					</li>
							<li>
								<a href="http://demo.shopxx.net/product/list/1.jhtml"><%=pInfo.getType().getTypeName() %></a>
							</li>
				</ul>
			</div>
			<div class="productImage">
					<a id="zoom" href="../../../upload/image/<%=pInfo.getArr_img().get(0).getImgUrl()%>" rel="gallery">
						<img class="medium" src="../../../upload/image/<%=pInfo.getArr_img().get(0).getImgUrl() %>" />
					</a>
				<a href="javascript:;" class="prev"></a>
				<div id="scrollable" class="scrollable">
					<div class="items">
							<%
								ArrayList<proImgListInfo> arr_img=pInfo.getArr_img();
								for(int i=0;i<arr_img.size();i++){
								%>
								<a class="current" href="javascript:;" rel="{gallery: 'gallery', smallimage: '../../../upload/image/<%=arr_img.get(i).getImgUrl() %>', largeimage: '../../../upload/image/<%=arr_img.get(i).getImgUrl() %>'}"><img src="../../../upload/image/<%=arr_img.get(i).getImgUrl() %>" title="" /></a>
								<%
								}
							 %>
								
								
					</div>
				</div>
				<a href="javascript:;" class="next"></a>
			</div>
			<div class="name"><%=pInfo.getpName() %></div>
			<div class="sn">
				<div>编号: <%=pInfo.getPid() %></div>
					<div>评分:</div>
					<div class="score<%=((pInfo.getpScore()%100)/10) %>"></div>
					<div><%=((pInfo.getpScore()%100)/10/2) %> (评分数: 5)</div>
			</div>
			<div class="info">
				<dl>
					<dt>销售价:</dt>
					<dd>
						<strong>￥<%=pInfo.getpPrice() %></strong>
							市场价:
							<del>￥<%=pInfo.getMarketPrice() %></del>
					</dd>
				</dl>
					<dl>
						<dt>赠送积分:</dt>
						<dd>
							<span><%=pInfo.getpScore() %></span>
						</dd>
					</dl>
			</div>
			<form id="formCar" action="/Shopxx_qt/servlet/AddCarServlet" method="get">
				<div class="action">
						<div id="specification" class="specification clearfix">
							<div class="title">请选择商品规格</div>
								<dl>
									<dt>
										<span title="颜色">颜色:</span>
									</dt>
											<dd>
												<a href="javascript:;" class="image selected" val="10">
												<img src="../../resources/images/specification/6.gif" alt="灰色" title="灰色" />
												<span title="点击取消选择">&nbsp;</span></a>
											</dd>
													<dd>
												<a href="javascript:;" class="image" val="10">
												<img src="../../resources/images/specification/8.gif" alt="黑色" title="黑色" />
												<span title="点击取消选择">&nbsp;</span></a>
											</dd>
													<dd>
												<a href="javascript:;" class="image" val="10">
												<img src="../../resources/images/specification/15.gif" alt="白色" title="白色" />
												<span title="点击取消选择">&nbsp;</span></a>
											</dd>
								</dl>
								<dl>
									<dt>
										<span title="尺码">尺码:</span>
									</dt>
									<dd>&nbsp;
											</dd>
									<%
										if(pInfo.getSpec().getValue()!=null){
											String[] arr_val=pInfo.getSpec().getValue().split("_");
											for(int i=0;i<arr_val.length;i++){
											%>
											<dd>
												<a href="javascript:;" class="text" val="45"><%=arr_val[i] %><span title="点击取消选择">&nbsp;</span></a>
											</dd>
											<%
												
											}
										
										}else
										{
										
										%>
											<dd>
												<a href="javascript:;" class="text" val="46">S<span title="点击取消选择">&nbsp;</span></a>
											</dd>
											<dd>
												<a href="javascript:;" class="text" val="47">M<span title="点击取消选择">&nbsp;</span></a>
											</dd>
											<dd>
												<a href="javascript:;" class="text" val="46">L<span title="点击取消选择">&nbsp;</span></a>
											</dd>
											<dd>
												<a href="javascript:;" class="text" val="47">XL<span title="点击取消选择">&nbsp;</span></a>
											</dd>
										<%
										}
									 %>
											
										
								</dl>
						</div>
						<dl class="quantity">
							<dt>购买数量:</dt>
							<dd>
							<input type="hidden" name="pid" value="<%=pInfo.getPid()%>" />
								<input type="text" id="quantity" name="quantity" value="1" maxlength="4" onpaste="return false;" />
								<div>
									<span id="increase" class="increase">&nbsp;</span>
									<span id="decrease" class="decrease">&nbsp;</span>
								</div>
							</dd>
							<dd>
								件
							</dd>
						</dl>
					<div class="buy">
							<input type="button"  onclick="submit()" id="addCart"  class="addCart" value="加入购物车" />
						<a href="javascript:;" id="addFavorite">收藏商品</a>
					</div>
				</div>
				</form>
			<div id="bar" class="bar">
				<ul>
						<li id="introductionTab">
							<a href="#introduction">商品介绍</a>
						</li>
						<li id="parameterTab">
							<a href="#parameter">商品参数</a>
						</li>
						<li id="reviewTab">
							<a href="#review">商品评论</a>
						</li>
				
				</ul>
			</div>
				<div id="introduction" name="introduction" class="introduction">
					<div class="title">
						<strong>商品介绍</strong>
					</div>
					<div>
					<%
								ArrayList<proImgListInfo> arr_img1=pInfo.getArr_img();
								for(int i=0;i<arr_img1.size();i++){
								%>
						<img src="../../../upload/image/<%=arr_img1.get(i).getImgUrl() %>" /> 
						
						<%
						}
						 %>
<p>&nbsp;
	
</p>
					</div>
				</div>
				<div id="parameter" name="parameter" class="parameter">
					<div class="title">
						<strong>商品参数</strong>
					</div>
					<table>
							<tr>
								<th class="group" colspan="2">基本参数</th>
							</tr>
							<%
								for(int i=0;i<arr_att.size();i++){
								ProTypeAttributeInfo ptai=arr_att.get(i);
								%>
								<tr>
										<th><%=ptai.getAttName()%></th>
										<td><%=ptai.getPv().getAttValue()%></td>
								</tr>
								<%
								}
							
							 %>
					</table>
				</div>
				<div id="review" name="review" class="review">
					<div class="title">商品评论</div>
					<div class="content clearfix">
							<div class="score">
								<strong>5.0</strong>
								<div>
									<div class="score10"></div>
									<div>评分数: 5</div>
								</div>
							</div>
							<div class="graph">
								<span style="width: 100.0%">
									<em>5.0</em>
								</span>
								<div>&nbsp;</div>
								<ul>
									<li>非常不满</li>
									<li>不满意</li>
									<li>一般</li>
									<li>满意</li>
									<li>非常满意</li>
								</ul>
							</div>
							<div class="handle">
								<a href="http://demo.shopxx.net/review/add/1.jhtml" id="addReview">发表商品评论</a>
							</div>
									<table>
									<%
										for(int i=0;i<arr_pei.size();i++){
										ProductEvaluationInfo pe=arr_pei.get(i);
										%>
										<tr>
												<th>
													<%=pe.getPeContent() %>
													<div class="score10"></div>
												</th>
												<td>
														<%=pe.getCu().getcName() %>
													<span title="<%=pe.getCreatetime() %>"><%=pe.getCreatetime().substring(0,11)%></span>
												</td>
											</tr>
										
										<%
										}
									
									 %>
									</table>
									<p>
										<a href="http://demo.shopxx.net/review/content/1.jhtml">[查看所有评论]</a>
									</p>
					</div>
				</div>
				<div id="consultation" name="consultation" class="consultation">
			
		</div>
	</div>
<div class="container footer">
	<div class="span24">
		<div class="footerAd">
					<img src="../../resources/images/ad/footer.jpg" width="950" height="52" alt="我们的优势" title="我们的优势" />
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

