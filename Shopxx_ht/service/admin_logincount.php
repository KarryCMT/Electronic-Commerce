<?php
header("ConTent-type:text/html;charset=utf-8");
session_start();
//include 'DBUtil.php';
require_once dirname(dirname(__FILE__)).'\util\admin_DBUtil.php';
$uName=$_POST['uName'];
$uPwd=$_POST['uPwd'];

$admin_logininfo=new admin_logininfo();
$admin_logininfo->uName=$uName;
$admin_logininfo->uPwd=$uPwd;

	$dbutil=new DBUtil();
	//$admin_logininfo=$dbutil->admin_logins($admin_logininfo);
	$flge=$dbutil->admin_logins($admin_logininfo);
if($flge){
    echo "<script>alert('登录成功')</script>";
    echo "<script>window.location.href='../index.php';</script>";
    $_SESSION["user"]=$admin_logininfo;
	var_dump($_SESSION["user"]);
}else{
    echo "<script>alert('登录失败')</script>";
    //echo "<script>window.location.href='../admin_login.php';</script>";
}

?>