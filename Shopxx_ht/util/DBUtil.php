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
    function Admin_logins($admin_logininfo){
        $uName=$admin_logininfo->uName;
        $uPwd=$admin_logininfo->uPwd;
        $dbutil=new DBUtil();
        $con=$dbutil->getCon();
        $sql="SELECT * FROM s_userinfo WHERE uName='".$uName."'and uPwd='".$uPwd."'";
		
        $res=mysqli_query($con,$sql);
        mysqli_close($con);
        if($res_msg=mysqli_fetch_array($res)){
            return TRUE;
        }else{
            return FALSE;
        }
    }
}
?>