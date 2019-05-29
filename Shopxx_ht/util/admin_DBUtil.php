<?php
//include 'Reception_logininfo.php';
require_once dirname(dirname(__FILE__)).'\entity\admin_logininfo.php';
class DBUtil{

    function getCon(){
        $server='localhost';
        $username='root';
        $pwd='123456';
        $db='shopdb';
        $con=new mysqli($server,$username,$pwd,$db);
        mysqli_set_charset($con, "utf8");
        return $con;
    }
    function admin_logins($admin_logininfo){
        $uName=$admin_logininfo->uName;
        $uPwd=$admin_logininfo->uPwd;
        $dbutil=new DBUtil();
        $con=$dbutil->getCon();
        $sql="SELECT * FROM s_userinfo WHERE uName='".$uName."'and uPwd='".$uPwd."'";
        $res=mysqli_query($con,$sql);
        mysqli_close($con);
        if($res_msg=mysqli_fetch_array($res)){
         	$admin_logininfo=new admin_logininfo();
			
			$admin_logininfo->uName=$res_msg['uName'];
			$admin_logininfo->uPwd=$res_msg['uPwd'];
			$admin_logininfo->uId=$res_msg['uId'];
			$admin_logininfo->uType=$res_msg['uType'];			
			$admin_logininfo->uState=$res_msg['uState'];
			$admin_logininfo->createTime=$res_msg['createTime'];
			$admin_logininfo->remark=$res_msg['remark'];
			return $admin_logininfo;
        }else{
            return null;
        }
    }
}
?>