<?php
require_once dirname(dirname(__FILE__)).'\entity\s_customerinfo.php';
require_once dirname(dirname(__FILE__)).'\entity\s_areainfo.php';
require_once dirname(dirname(__FILE__)).'\entity\s_articleinfo.php';
require_once dirname(dirname(__FILE__)).'\entity\s_articletype.php';
class DBUtil{
	//连接数据库
    function getCon(){
        $server='localhost';
        $username='root';
        $pwd='123456';
        $db='shopdb';
        $con=new mysqli($server,$username,$pwd,$db);
        mysqli_set_charset($con, "utf8");
        return $con;
    }
	//会员登录
    function customer_logins($s_customerinfo){
        $cName=$s_customerinfo->cName;
        $cPwd=$s_customerinfo->cPwd;
        $dbutil=new DBUtil();
        $con=$dbutil->getCon();
        $sql="SELECT * FROM s_customerinfo WHERE cName='".$cName."'and cPwd='".$cPwd."'";
        $res=mysqli_query($con,$sql);
        mysqli_close($con);
        if($res_msg=mysqli_fetch_array($res)){
         	$s_customerinfo=new s_customerinfo();			
			$s_customerinfo->cName=$res_msg['cName'];
			$s_customerinfo->cgId=$res_msg['cgId'];
			$s_customerinfo->cPwd=$res_msg['cPwd'];
			$s_customerinfo->cId=$res_msg['cId'];
			$s_customerinfo->cEmail=$res_msg['cEmail'];
			$s_customerinfo->cSex=$res_msg['cSex'];
			$s_customerinfo->aId=$res_msg['aId'];
			$s_customerinfo->cBirth=$res_msg['cBirth'];
			$s_customerinfo->trueName=$res_msg['trueName'];
			$s_customerinfo->cellPhone=$res_msg['cellPhone'];
			$s_customerinfo->telPhone=$res_msg['telPhone'];
			$s_customerinfo->nickName=$res_msg['nickName'];
			$s_customerinfo->cState=$res_msg['cState'];
			$s_customerinfo->createTime=$res_msg['createTime'];
			$s_customerinfo->remark=$res_msg['remark'];
			return $s_customerinfo;
        }else{
            return null;
        }
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
	 function add_customer($customer_logininfo){//前台注册信息存入数据库
			$cId=$customer_logininfo->cId;
			$cgId=$customer_logininfo->cgId;
			$cName=$customer_logininfo->cName;
			$cPwd=$customer_logininfo->cPwd;
			$cEmail=$customer_logininfo->cEmail;
			$cSex=$customer_logininfo->cSex;
			$cBirth=$customer_logininfo->cBirth;
			$aId=$customer_logininfo->aId;
//			$createTime=$customerinfo->$createTime;
//			$remark=$customerinfo->$remark;
//			$cState=$customerinfo->$cState;
//			$trueName=$customerinfo->$trueName;
//			$cellPhone=$customerinfo->$cellPhone;
//			$nickName=$customerinfo->$nickName;
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$sql='INSERT INTO s_customerinfo(cId,cgId,cName,cPwd,cEmail,cSex,cBirth,aId) VALUES (?,?,?,?,?,?,?,?)';
			$stm=$con->prepare($sql);
			$stm->bind_param('iisssssi',$cId,$cgId,$cName,$cPwd,$cEmail,$cSex,$cBirth,$aId);
			$flag=$stm->execute();
			return $flag;
		
		
		}
	 	function query_all($sql){
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$res=mysqli_query($con, $sql);
			mysqli_close($con);
			return $res;
			
		}
	 		 		  
	  // 地址信息表查询函数 
		function query_add($sql){
			$DButil=new DButil();
			$con=$DButil->getcon();
			$res=mysqli_query($con, $sql);
			$arr=null;
			while($res_msg=mysqli_fetch_array($res)){
				$areaInfo=new areaInfo();
				$areaInfo->aId=$res_msg['aId'];
				$areaInfo->aName=$res_msg['aName'];
				$areaInfo->parentId=$res_msg['parentId'];
				$areaInfo->remark=$res_msg['remark'];
				$arr[]=$areaInfo;
			}
			return $arr;
			
		}
		//查询新闻类型
	function query_s_articletype($sql){
		$dbutil=new DBUtil();
		$con=$dbutil->getcon();
		$res=mysqli_query($con, $sql);
		$arr_s_articletype=null;
		while($res_msg=mysqli_fetch_array($res)){
			$s_articletype=new s_articletype();
			$s_articletype->AtId=$res_msg['AtId'];
			$s_articletype->ArName=$res_msg['ArName'];
			$s_articletype->AtTitle=$res_msg['AtTitle'];
			$s_articletype->AtRemark=$res_msg['AtRemark'];
			$s_articletype->AtImp=$res_msg['AtImp'];
			$s_articletype->Atorder=$res_msg['Atorder'];
			//创建SQL语句;
			$sql_s_articleinfo="select * from s_articleinfo where AtId=".$s_articletype->AtId;
			//查询当前类型的所有新闻内容并且赋值给 新闻类型对象的Arr_article属性;
			$s_articletype->Arr_article=$dbutil->query_s_articleinfo($sql_s_articleinfo);
			//将查询结果添加到数组
			$arr_s_articletype[]=$s_articletype;
		}
		return $arr_s_articletype;
	}
	//查询同类型新闻下面的所有新闻列表
	function query_s_articleinfo($sql){
		$dbutil=new DBUtil();
		$con=$dbutil->getcon();
		$res=mysqli_query($con, $sql);
		$arr_s_articleinfo=null;
		while($res_msg=mysqli_fetch_array($res)){
			$s_articleinfo=new s_articleinfo();
			$s_articleinfo->ArId=$res_msg['ArId'];
			$s_articleinfo->ArTitle=$res_msg['ArTitle'];
			$s_articleinfo->ArContent=$res_msg['ArContent'];
			$s_articleinfo->AtId=$res_msg['AtId'];
			$s_articleinfo->AtAuthor=$res_msg['AtAuthor'];
			$s_articleinfo->States=$res_msg['States'];
			$s_articleinfo->isTop=$res_msg['isTop'];
			$s_articleinfo->ArMark=$res_msg['ArMark'];
			$s_articleinfo->CrTime=$res_msg['CrTime'];
			$arr_s_articleinfo[]=$s_articleinfo;
		}
		return $arr_s_articleinfo;
	}









}
?>