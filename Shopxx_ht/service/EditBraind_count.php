<?php
	header("ConTent-type:text/html;charset=utf-8");
	require_once dirname(dirname(__FILE__)).'\util\DBUtil.php';
	$bName=$_POST['bName'];
	$blog=$_POST['blog'];
	$bIntroduce=$_POST['bIntroduce'];
	$bUrl=$_POST['bUrl'];
	$remark=$_POST['remark'];
	$ptId=$_POST['ptId'];
	$bId=$_POST['bId'];
	$s_brandinfo=new s_brandinfo();
	$s_brandinfo->bName=$bName;
	$s_brandinfo->blog=$blog;
	$s_brandinfo->bIntroduce=$bIntroduce;
	$s_brandinfo->bUrl=$bUrl;
	$s_brandinfo->ptId=$ptId;
	$s_brandinfo->remark=$remark;
	$s_brandinfo->bId=$bId;
	$dbutil=new DBUtil();
	$flge=$dbutil->update_Braind($s_brandinfo);
	if($flge){
		echo "<script>alert('修改成功')</script>";
		echo "<script>window.location.href='../admin/Braind/list_Braind.php';</script>";
	}else{
		echo "<script>alert('修改失败')</script>";
		echo "<script>window.location.href='../admin/Braind/list_Braind.php';</script>";
	}