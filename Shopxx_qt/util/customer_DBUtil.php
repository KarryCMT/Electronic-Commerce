<?php
//include 'Reception_logininfo.php';
require_once dirname(dirname(__FILE__)).'\entity\customer_logininfo.php';
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
    function customer_logins($customer_logininfo){
        $cName=$customer_logininfo->cName;
        $cPwd=$customer_logininfo->cPwd;
        $dbutil=new DBUtil();
        $con=$dbutil->getCon();
        $sql="SELECT * FROM s_customerinfo WHERE cName='".$cName."'and cPwd='".$cPwd."'";
        $res=mysqli_query($con,$sql);
        mysqli_close($con);
        if($res_msg=mysqli_fetch_array($res)){
         	$customer_logininfo=new customer_logininfo();
			
			$customer_logininfo->cName=$res_msg['cName'];
			$customer_logininfo->cPwd=$res_msg['cPwd'];
			$customer_logininfo->cId=$res_msg['cId'];
			$customer_logininfo->cEmail=$res_msg['cEmail'];
			$customer_logininfo->cSex=$res_msg['cSex'];
			$customer_logininfo->cBirth=$res_msg['cBirth'];
			$customer_logininfo->trueName=$res_msg['trueName'];
			$customer_logininfo->cellPhone=$res_msg['cellPhone'];
			$customer_logininfo->telPhone=$res_msg['telPhone'];
			$customer_logininfo->nickName=$res_msg['nickName'];
			$customer_logininfo->cState=$res_msg['cState'];
			$customer_logininfo->createTime=$res_msg['createTime'];
			$customer_logininfo->remark=$res_msg['remark'];
			return $customer_logininfo;
        }else{
            return null;
        }
    }
}
?>