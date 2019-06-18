

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<title>品牌列表 - Powered By SHOP++</title>
<meta name="author" content="SHOP++ Team" />
<meta name="copyright" content="SHOP++" />
<link href="../../resources/admin/css/common.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../../resources/admin/js/jquery.js"></script>
<script type="text/javascript" src="../../resources/admin/js/jquery.tools.js"></script>
<script type="text/javascript" src="../../resources/admin/js/jquery.validate.js"></script>
<script type="text/javascript" src="../../resources/admin/editor/kindeditor.js"></script>
<script type="text/javascript" src="../../resources/admin/js/common.js"></script>
<script type="text/javascript" src="../../resources/admin/js/input.js"></script>
<script type="text/javascript">
function submits(){
	document.getElementById("listForm").submit();

}
</script>
<?php
	require_once dirname(dirname(dirname(__FILE__))).'\util\DBUtil.php';
	$dbutil=new DBUtil();
	$count='';
	$sql_count="SELECT COUNT(*) FROM s_brandinfo";
	$res=$dbutil->query_all($sql_count);
	if($msg=mysqli_fetch_array($res)){
			//var_dump($msg);
			$count=$msg['COUNT(*)'];//数据总条数
		}
	$sql="SELECT *FROM s_brandinfo";//查询要显示的数据
	$arr=$dbutil->query_braind($sql);
	//$bId=$_GET['bId'];
	//$sql_emp="select * from s_brandinfo where bId=".$bId;
	if($_POST){
		$value = $_POST['check'];
	echo '你的选择:'.implode(',',$value);
	}
	?>
</head>
<body>
	<div class="breadcrumb">
		<a href="../../index.php">首页</a> &raquo; 品牌列表 <span>(共<?=$count?></span>条记录)</span>
	</div>
	<form id="listForm" action="../../service/delete_Braind.php" method="post">
		<div class="bar">
			<a href="../Braind/addBraind.php" class="iconButton">
				<span class="addIcon">&nbsp;</span>添加
			</a>
			<div class="buttonGroup">
				<a href="javascript:;" onclick="submits()" id="deleteButton" class="iconButton disabled">
					<span class="deleteIcon">&nbsp;</span>删除
				</a>
				<a href="" onclick="location.reload():;" id="refreshButton" class="iconButton">
					<span class="refreshIcon">&nbsp;</span>刷新
				</a>
			</div>
		</div>
		<table id="listTable" class="list">
			<tr>
				<th class="check">
					<input type="checkbox" id="selectAll" />
				</th>
				<th>
					<a href="javascript:;" class="sort" name="name">编号</a>
				</th>
				<th>
					<a href="javascript:;" class="sort" name="logo">名称</a>
				</th>
				<th>
					<a href="javascript:;" class="sort" name="url">介绍</a>
				</th>
				<th>
					<a href="javascript:;" class="sort" name="order">网址</a>
				</th>
				<th>
					<span>操作</span>
				</th>
				
						</tr>
					<?php
					foreach($arr as $s_brandinfo){
						?>
				<tr>
					<td>
						<input type="checkbox" name="check[]" value="<?=$s_brandinfo->bId?>" />
					</td>
					<td>
							<?=$s_brandinfo->bId?>
					</td>
					<td>
							<?=$s_brandinfo->bName?>
					</td>
					<td>
							<?=$s_brandinfo->remark?>
					</td>
					<td>
							<?=$s_brandinfo->bUrl?>
					</td>
					<td>
						<a href="EditBraind.php?bId=<?=$s_brandinfo->bId?>">[编辑]</a>
					</td>
				</tr>
				<?php	}
					?>	
		</table>
	</form>
</body>
</html>

