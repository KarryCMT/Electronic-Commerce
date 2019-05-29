<?php
session_start();
header("ConTent-type:text/html;charset=utf-8");
//include 'DBUtil.php';
require_once dirname(dirname(__FILE__)).'\util\DBUtil.php';
$uName=$_REQUEST['uName'];
$uPwd=$_REQUEST['uPwd'];

$admin_logininfo=new admin_logininfo();
$admin_logininfo->uName=$uName;
$admin_logininfo->uPwd=$uPwd;

$dbutil=new DBUtil();
$flge=$dbutil->Admin_logins($admin_logininfo);
if($flge){
    echo "<script>alert('登录成功')</script>";
    echo "<script>window.location.href='../index.html';</script>";
    $_SESSION["name"]=$uName;
}else{
    echo "<script>alert('登录失败')</script>";
    //echo "<script>window.location.href='../admin_login.php';</script>";
}

?>