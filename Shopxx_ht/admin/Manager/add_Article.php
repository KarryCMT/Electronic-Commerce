<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<title>添加文章 - Powered By SHOP++</title>
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
<script type="text/javascript">
$().ready(function() {

	var $inputForm = $("#inputForm");
	var $content = $("#content");
	
	
	$content.editor();
	
	// 表单验证
	$inputForm.validate({
		rules: {
			title: "required",
			articleCategoryId: "required"
		}
	});

});
</script>
</head>
<?php
	require_once dirname(dirname(dirname(__FILE__))).'\util\DBUtil.php';
	$dbutil=new DBUtil();
	$ArId="";
		$sql_articletype="SELECT AtId,ArName FROM s_articletype";
		$res_type=$dbutil->query($sql_articletype);
		$sql_ArId="SELECT ArId FROM s_articleinfo ORDER BY ArId DESC LIMIT 1";
		$res=$dbutil->query($sql_ArId);
		if($msg=mysqli_fetch_array($res)){
			//var_dump($msg);
			$ArId=$msg['ArId'];
			$ArId+=1;
		}else{
			$ArId='1';
		}
	?>
<body>
	<div class="breadcrumb">
		<a href="   ">首页</a> &raquo; 添加文章
	</div>
	<form id="inputForm" action="  " method="post">
		<table class="input">
			<tr>
				<td>
					<input type="hidden" name="ArId" value="<?=$ArId?>" class="text"  maxlength="200" />
				</td>
			</tr>
			<tr>
				<th>
					<span class="requiredField">*</span>标题:
					<input type="hidden" name="ArTitle" value="2"/>
				</th>
				<td>
					<input type="text" name="title" class="text"  maxlength="200" />
				</td>
			</tr>
			<tr>
				<th>
					<span class="requiredField">*</span>文章分类:
				</th>
				<td>
					<select name="AtId">
						<option >
								--请选择--
						</option>
						<?php
						while($msg_type=mysqli_fetch_array($res_type)){
							?>
							<option value="<?=$msg_type['AtId']?>"><?=$msg_type['ArName']?></option>
						<?php
							}
							?>
					</select>
				</td>
			</tr>
			<tr>
				<th>
					作者:
				</th>
				<td>
					<input type="text" name="AtAuthor" class="text"   maxlength="200" />
				</td>
			</tr>
			<tr>
				<th>
					设置:
				</th>
				<td>
					<label>
						<input type="checkbox"  name="States" value="1" checked="checked" />是否发布
						<input type="hidden" name="States" value="0" />
					</label>
					<label>
						<input type="checkbox" name="isTop" checked="checked"  value="1" />是否置顶
						<input type="hidden" name="isTop" value="0" />
					</label>
				</td>
			</tr>
			<tr>
				<th>
					标签:
				</th>
				<td>
						<label>
							<input type="checkbox" name="ArMark" checked="checked" value="1" />热点
							<input type="hidden" name="ArMark" value="1" />热点
						</label>
						
				</td>
			</tr>
			<tr>
				<th>
					内容:
				</th>
				<td>
					<textarea name="ArContent"  id="content" style="display:none"></textarea>
					<script type="text/javascript">CKEDITOR.replace('content');</script>
				</td>
			</tr>
			<tr>
				<th>
					&nbsp;
				</th>
				<td>
					<input type="submit" class="button" value="确 定" />
					<input type="button" class="button" value="返 回" onclick="history.back(); return false;" />
				</td>
			</tr>
		</table>
	</form>
</body>
</html>

