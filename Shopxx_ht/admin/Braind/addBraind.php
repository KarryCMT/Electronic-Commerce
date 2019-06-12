
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>添加商品品牌</title>
<meta name="author" content="SHOP++ Team" />
<meta name="copyright" content="SHOP++" />
<link href="../../resources/admin/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../../resources/admin/js/jquery.js"></script>
<script type="text/javascript" src="../../resources/admin/js/jquery.tools.js"></script>
<script type="text/javascript" src="../../resources/admin/js/jquery.validate.js"></script>
<script type="text/javascript" src="../../resources/admin/editor/kindeditor.js"></script>
<script type="text/javascript" src="../../resources/admin/js/common.js"></script>
<script type="text/javascript" src="../../resources/admin/js/input.js"></script>
<script type="text/javascript" src="../../resources/admin/ckeditor/ckeditor.js"></script>
<style type="text/css">
.shippingMethods label {
	width: 150px;
	display: block;
	float: left;
	padding-right: 6px;
}
</style>
</head>
<body>

<!-- Copyright � 2005. Spidersoft Ltd -->
<style>
A.applink:hover {border: 2px dotted #DCE6F4;padding:2px;background-color:#ffff00;color:green;text-decoration:none}
A.applink       {border: 2px dotted #DCE6F4;padding:2px;color:#2F5BFF;background:transparent;text-decoration:none}
A.info          {color:#2F5BFF;background:transparent;text-decoration:none}
A.info:hover    {color:green;background:transparent;text-decoration:underline}
</style>
 <?php
	require_once dirname(dirname(dirname(__FILE__))).'\util\DBUtil.php';
	$dbutil=new DBUtil();
	$bId="";
		$sql="SELECT ptId,ptName FROM s_producttypeinfo";
		var_dump($sql);
		$res_type=$dbutil->query($sql);
		
		$sql_bId="SELECT bId FROM s_brandinfo ORDER BY bId DESC LIMIT 1";
		$res=$dbutil->query($sql_bId);
		if($msg=mysqli_fetch_array($res)){
			
			$bId=$msg['bId'];
			$bId+=1;
		}else{
			$bId='1';
		}
	?>
	<div class="path">
		<a href="http://demo.shopxx.net/admin/common/index.jhtml">首页</a> &raquo; 添加商品品牌</div>
	<form id="inputForm" action="/Shopxx_ht/admin/Braind/addBrand_conts.php" method="post" enctype="multipart/form-data">
		<table class="input">
			<tr>
				<td>
					<input type="hidden" name="bId" value="<?=$bId;?>" class="text" maxlength="200" />				
				</td>
			</tr>
			<tr>
				<th>
					<span class="requiredField">*</span>名称:				</th>
				<td>
					<input type="text" name="bName" class="text" maxlength="200" />				</td>
			</tr>
			
			
			<tr>
				<th>
					商品分类:
				</th>
				<td>
					<select id="productCategoryId" name="ptId"  >
				
							<option>-----请选择-----</option>
							<?php
							while($msg_type=mysqli_fetch_array($res_type)){
							?>
							<option value="<?=$msg_type['ptId']?>"><?=$msg_type['ptName']?></option>
							<?php
							}
							?>
							
					</select>
				</td>
			</tr>
			
			
			<tr>
				<th>
					描述:				
					</th>
				<td>
				<textarea name="bIntroduce"  id="content" style="display:none"></textarea>
					<script type="text/javascript">CKEDITOR.replace('content');</script>
					</td>
			</tr>
			<tr>
				<th>
					官网:				
					</th>
				<td>
					<input type="text" name="bUrl" class="text" maxlength="200" />				</td>
			</tr>
			<tr>
				<th>
					备注:				
					</th>
				<td>
					<input type="text" name="remark" class="text" maxlength="200" />				</td>
			</tr>
				<tr>
				<th>
					LOGO:				
					</th>
				<td>
					<input type="file" name="bLog" class="text" maxlength="200" />				</td>
			</tr>
			<tr>
				<th>&nbsp;				</th>
				<td>
					<input type="submit" class="button" value="确&nbsp;&nbsp;定" />
					<input type="button" class="button" value="返&nbsp;&nbsp;回" onclick="location.href='list.jhtml'" />				</td>
			</tr>
		</table>
	</form>
</body>
</html>
