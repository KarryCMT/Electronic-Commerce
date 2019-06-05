<?php
	require_once dirname((__FILE__)).'\util\DBUtil.php';
	//include 'DBUtil.php';
	$aid=$_GET["aId"];
	$dbutil=new DButil();
	$sql="select * from s_areainfo where parentId in (select  aId from s_areainfo where aId=".$aid.")";
	$arr=$dbutil->query_add($sql);
	$str="";
	foreach($arr as $areaInfo){
		$str=$str.$areaInfo->aName."-";
	}
	echo $str;

	?>