<?php
session_start();
header("ConTent-type:text/html;charset=utf-8");
require_once dirname(dirname(__FILE__)).'\util\DBUtil.php';
$cName=$_POST['cName'];
$cPwd=$_POST['cPwd'];

$s_customerinfo=new s_customerinfo();
$s_customerinfo->cName=$cName;
$s_customerinfo->cPwd=$cPwd;

	$dbutil=new DBUtil();
	$s_customerinfo=$dbutil->customer_logins($s_customerinfo);
	$flge=$dbutil->customer_logins($s_customerinfo);
if($flge){
    echo "<script>alert('登录成功')</script>";
    echo "<script>window.location.href='../index.php';</script>";
    $_SESSION["name"]=$s_customerinfo;
}else{
    echo "<script>alert('登录失败')</script>";
    echo "<script>window.location.href='../customer_login.php';</script>";
}

?>