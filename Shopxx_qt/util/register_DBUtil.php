<?php
	require_once dirname(dirname(__FILE__)).'/entity/areainfo.php';
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
	//选择地区
	function register_add($sql){
		$dbutil=new DButil();
		$con=$dbutil->getcon();
		$res=mysqli_query($con, $sql);
		$arr=null;
		while($res_msg=mysqli_fetch_array($res)){
			$areainfo=new areainfo();
			$areainfo->aId=$res_msg['aId'];
			$areainfo->aName=$res_msg['aName'];
			$areainfo->parentId=$res_msg['parentId'];
			$areainfo->remark=$res_msg['remark'];
			$arr[]=$areainfo;
		}
		return $arr;	
	}
	//注册会员
	function add_Member($customer_logininfo){
			$cId=$customer_logininfo->cId;
			$cgId=$customer_logininfo->cgId;
			$cName=$customer_logininfo->cName;
			$cPwd=$customer_logininfo->cPwd;
			$cEmail=$customer_logininfo->cEmail;
			$cSex=$customer_logininfo->cSex;
			$cBirth=$customer_logininfo->cBirth;
			$aId=$customer_logininfo->aId;
			$createTime=$customer_logininfo->createTime;
			$remark=$customer_logininfo->remark;
			$cState=$customer_logininfo->cState;
			$trueName=$customer_logininfo->trueName;
			$cellPhone=$customer_logininfo->cellPhone;
			$telPhone=$customer_logininfo->telPhone;
			$nickName=$customer_logininfo->nickName;
			
			
			
			
			
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$SQL='INSERT INTO s_customerinfo VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)';
			$stm=$con->prepare($SQL);
			$stm->bind_param('iisssssississss',$cName,$cPwd,$cId,$cEmail,$cSex,$cBirth,$trueName,$cellPhone,$telPhone,$nickName,$cState,$createTime,$remark);
			$flag=$stm->execute();
			return $flag;
		}
	
	}
?>