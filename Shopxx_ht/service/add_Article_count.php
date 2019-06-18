<?php
	header("ConTent-type:text/html;charset=utf-8");
	require_once dirname(dirname(__FILE__)).'\util\DBUtil.php';
	$ArId=$_POST['ArId']; 
	$ArTitle=$_POST['ArTitle'];
	$ArContent=$_POST['ArContent'];
	$AtId=$_POST['AtId'];
	$AtAuthor=$_POST['AtAuthor'];
	$States=$_POST['States'];
	$isTop=$_POST['isTop'];
	$ArMark=$_POST['ArMark'];
	$CrTime=$_POST['CrTime'];
	$s_articleinfo=new s_articleinfo();
	$s_articleinfo->ArId=$ArId;
	$s_articleinfo->ArTitle=$ArTitle;
	$s_articleinfo->ArContent=$ArContent;
	$s_articleinfo->AtId=$AtId;
	$s_articleinfo->AtAuthor=$AtAuthor;
	$s_articleinfo->States=$States;
	$s_articleinfo->isTop=$isTop;
	$s_articleinfo->ArMark=$ArMark;
	$s_articleinfo->CrTime=$CrTime;
	$dbutil=new DBUtil();
	$flge=$dbutil->add_articl($s_articleinfo);
	if($flge){
		echo "<script>alert('添加成功')</script>";
		echo "<script>window.location.href='../admin/Manager/add_Article.php';</script>";
	}else{
		echo "<script>alert('添加失败')</script>";
		echo "<script>window.location.href='../admin/Manager/add_Article.php';</script>";
	}
?>