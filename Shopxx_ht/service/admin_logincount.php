<?php
header("ConTent-type:text/html;charset=utf-8");
session_start();
//include 'DBUtil.php';
require_once dirname(dirname(__FILE__)).'\util\DBUtil.php';
$uName=$_POST['uName'];
$uPwd=$_POST['uPwd'];

$s_userinfo=new s_userinfo();
$s_userinfo->uName=$uName;
$s_userinfo->uPwd=$uPwd;

	$dbutil=new DBUtil();
	//$admin_logininfo=$dbutil->admin_logins($admin_logininfo);
	$flge=$dbutil->admin_logins($s_userinfo);
if($flge){
    echo "<script>alert('登录成功')</script>";
    echo "<script>window.location.href='../index.php';</script>";
    $_SESSION["user"]=$s_userinfo;
}else{
    echo "<script>alert('登录失败')</script>";
    echo "<script>window.location.href='../admin.php';</script>";
}

?>