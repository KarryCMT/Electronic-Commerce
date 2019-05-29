<?php
session_start();
header("ConTent-type:text/html;charset=utf-8");
//include 'DBUtil.php';
require_once dirname(dirname(__FILE__)).'\util\customer_DBUtil.php';
$cName=$_POST['cName'];
$cPwd=$_POST['cPwd'];

$customer_logininfo=new customer_logininfo();
$customer_logininfo->cName=$cName;
$customer_logininfo->cPwd=$cPwd;

	$dbutil=new DBUtil();
	$customer_logininfo=$dbutil->customer_logins($customer_logininfo);
	$flge=$dbutil->customer_logins($customer_logininfo);
if($flge){
    echo "<script>alert('登录成功')</script>";
    echo "<script>window.location.href='../index.php';</script>";
    $_SESSION["name"]=$customer_logininfo;
}else{
    echo "<script>alert('登录失败')</script>";
    //echo "<script>window.location.href='../customer_login.php';</script>";
}

?>