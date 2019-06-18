<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>修改品牌</title>
<meta name="author" content="hht" />
<meta name="copyright" content="hht" />
<link href="../../resources/admin/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../../resources/admin/js/jquery.js"></script>
<script type="text/javascript" src="../../resources/admin/js/jquery.tools.js"></script>
<script type="text/javascript" src="../../resources/admin/js/jquery.validate.js"></script>
<script type="text/javascript" src="../../resources/admin/editor/kindeditor.js"></script>
<script type="text/javascript" src="../../resources/admin/js/common.js"></script>
<script type="text/javascript" src="../../resources/admin/js/input.js"></script>
<script type="text/javascript" src="../../resources/admin/ckeditor/ckeditor.js"></script>
<style type="text/css">
	.specificationSelect {
		height: 100px;
		padding: 5px;
		overflow-y: scroll;
		border: 1px solid #cccccc;
	}
	
	.specificationSelect li {
		float: left;
		min-width: 150px;
		_width: 200px;
	}
</style>
</head>
<body>
<?php
	require_once dirname(dirname(dirname(__FILE__))).'\util\DBUtil.php';
	$dbutil=new DBUtil();
	//获取列表页面传过来的bId;
	$bId=$_GET['bId'];
	var_dump($bId);
	$sql_update="select * from s_brandinfo where bId=".$bId;
	$s_brandinfo=$dbutil->get_one_Braind($sql_update);
	//通过bid查询ptid；
	$sql_ptId="select ptId from s_brandinfo where bId=".$bId;
	$res_ptId=$dbutil->query($sql_ptId);
	//通过ptid获取ptname；
	if($msg_ptId=mysqli_fetch_array($res_ptId)){
		$ptId=$msg_ptId['ptId'];
	}
	//组合框选中的内容
	$sql_one="SELECT ptId,ptName FROM s_producttypeinfo where ptId=".$ptId;
	$res_one=$dbtil->query($sql_one);
	//组合框中所有的内容
	$sql_s_producttypeinfo="SELECT ptId,ptName FROM s_producttypeinfo";
	$res_type=$dbutil->query($sql_s_producttypeinfo);
	?>
<!-- Copyright � 2005. Spidersoft Ltd -->
<style>
A.applink:hover {border: 2px dotted #DCE6F4;padding:2px;background-color:#ffff00;color:green;text-decoration:none}
A.applink       {border: 2px dotted #DCE6F4;padding:2px;color:#2F5BFF;background:transparent;text-decoration:none}
A.info          {color:#2F5BFF;background:transparent;text-decoration:none}
A.info:hover    {color:green;background:transparent;text-decoration:underline}
</style>
	<div class="path">
		<a href="http://demo.shopxx.net/admin/common/index.jhtml">首页</a> &raquo; 添加商品</div>
	<form id="inputForm" action="/Shopxx_ht/service/EditBraind_count.php" method="post">
		<table class="input">
			<tr>
					<input type="hidden" name="bId" class="text" value="<?=$bId?>" />				
			</tr>
			<tr>
				<th>
					<span class="requiredField">*</span>名称:				
				</th>
				<td>
					<input type="text" name="bName" class="text" value="<?=$s_brandinfo->bName?>" />				
				</td>
			</tr>
			
			
			<tr>
				<th>
					商品分类:
				</th>
				<td>
					<select id="productCategoryId" name="ptId"  >
					<?php
						if($msg_one=mysqli_fetch_array($res_one))
							?>
						<option value="<?=$msg_one['ptId']?>"><?=$msg_one['ptName']?></option>
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
					<textarea name="bIntroduce"  id="introduce"   style="display:none"><?=$s_brandinfo->bIntroduce?></textarea>
					<script type="text/javascript">CKEDITOR.replace('content');</script>
					</td>
			</tr>
			<tr>
				<th>
					官网:				
					</th>
				<td>
					<input type="text" name="bUrl" class="text" value="<?=$s_brandinfo->bUrl?>" />				</td>
			</tr>
			<tr>
				<th>
					备注:				
					</th>
				<td>
					<input type="text" name="remark" value="value="<?=$s_brandinfo->remark?>"" class="text" maxlength="200" />				</td>
			</tr>
				<tr>
				<th>
					LOGO:				
					</th>
				<td>
					<input type="file" name="blog" class="text" maxlength="200" value="<?=$s_brandinfo->blog?>" />
					<input type="hidden" name="bid" value="hid" />
					</td>
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
