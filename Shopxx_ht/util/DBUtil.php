<?php
//include 'Reception_logininfo.php';
require_once dirname(dirname(__FILE__)).'\entity\s_userinfo.php';
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
    function admin_logins($s_userinfo){
        $uName=$s_userinfo->uName;
        $uPwd=$s_userinfo->uPwd;
        $dbutil=new DBUtil();
        $con=$dbutil->getCon();
        $sql="SELECT * FROM s_userinfo WHERE uName='".$uName."'and uPwd='".$uPwd."'";
        $res=mysqli_query($con,$sql);
        mysqli_close($con);
        if($res_msg=mysqli_fetch_array($res)){
         	$s_userinfo=new s_userinfo();
			
			$s_userinfo->uName=$res_msg['uName'];
			$s_userinfo->uPwd=$res_msg['uPwd'];
			$s_userinfo->uId=$res_msg['uId'];
			$s_userinfo->uType=$res_msg['uType'];			
			$s_userinfo->uState=$res_msg['uState'];
			$s_userinfo->createTime=$res_msg['createTime'];
			$s_userinfo->remark=$res_msg['remark'];
			return $s_userinfo;
        }else{
            return null;
        }
    }
}
?>