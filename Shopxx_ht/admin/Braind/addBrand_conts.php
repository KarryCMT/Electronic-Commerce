<?php

	//添加品牌
	header("ConTent-type:text/html;charset=utf-8");
	require_once dirname(dirname(dirname(__FILE__))).'\util\dbutil.php';
	$bId=$_POST['bId'];
	$ptId=$_POST['ptId'];
	$bName=$_POST['bName'];
	//$blog=$_POST['blog'];
	$bIntroduce=$_POST['bIntroduce'];
	$bUrl=$_POST['bUrl'];
	$remark=$_POST['remark'];
	$s_brandinfo=new s_brandinfo();
	$blog="resources/images/friend_link/".$bId.".jpg";
	$s_brandinfo->bId=$bId;
	$s_brandinfo->ptId=$ptId;
	$s_brandinfo->bName=$bName;
	$s_brandinfo->blog=$blog;
	$s_brandinfo->bIntroduce=$bIntroduce;
	$s_brandinfo->bUrl=$bUrl;
	$s_brandinfo->remark=$remark;
	$blog=$_FILES['blog'];
	$file_name=dirname(dirname(dirname(__FILE__)))."\\Shopxx_qt\\resources\\images\\brand\\".$bId.".jpg";
	if(move_uploaded_file($blog['tmp_name'], $file_name)){
	}else{
		echo "图片上传失败";
	}
	$dbutil=new dbutil();
	$flge=$dbutil->braind($s_brandinfo);
	if($flge){
		echo "<script>alert('添加成功')</script>";
		//echo "<script>window.location.href='../admin/Braind/addBraind.php';</script>";
		
	}else{
		echo "<script>alert('添加失败')</script>";
		//echo "<script>window.location.href='../admin/Braind/addBraind.php';</script>";
		
	}
	
	
	?>