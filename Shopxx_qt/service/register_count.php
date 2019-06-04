<?php
	require_once dirname(dirname(__FILE__)).'\util\DBUtil.php';
	header("content-type:text/html;charset=utf-8");
	$cId=$_POST['cId'];
    $cgId=$_POST['cgId'];
    $cName=$_POST['cName'];
    $cPwd=$_POST['cPwd'];
    $cEmail=$_POST['cEmail'];
    $cSex=$_POST['cSex'];
	$cBirth=$_POST['cBirth'];
	$aId=$_POST['aId'];
//	$createTime=$_POST['createTime'];
//  $remark=$_POST['remark'];
//	$cState=$_POST['cState'];
//	$trueName=$_POST['trueName'];
//	$cellPhone=$_POST['cellPhone'];
//	$telPhone=$_POST['telPhone'];
//	$nickName=$_POST['nickName'];
	
	
	
    $customer_logininfo= new customer_logininfo();
	$customer_logininfo->cId=$cId;
	$customer_logininfo->cgId=$cgId;
	$customer_logininfo->cName=$cName;
	$customer_logininfo->cPwd=$cPwd;
    $customer_logininfo->cEmail=$cEmail;
	$customer_logininfo->cSex=$cSex;
	$customer_logininfo->cBirth=$cBirth;
	$customer_logininfo->aId=$aId;
//	$registerInfo->createTime=$createTime;
//	$registerInfo->remark=$remark;
//	$registerInfo->cState=$cState;
//	$registerInfo->trueName=$trueName;
//	$registerInfo->cellPhone=$cellPhone;
//	$registerInfo->telPhone=$telPhone;
//	$registerInfo->nickName=$nickName;
	
	
	$DBUtil=new DBUtil();
	$flag=$DBUtil->add_customer($customer_logininfo);
	if($flag){
		echo "<script>alert('注册成功')</script>";
		echo "<script>window.location.href='./customer_login.php';</script>";
	}
	else{
		echo "<script>alert('注册失败')</script>";
		echo "<script>window.location.href='./register.php';</script>";
		
	}
?>