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
	
	}
?>