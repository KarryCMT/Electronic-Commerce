<?php
require_once dirname(dirname(__FILE__)).'\entity\s_customerinfo.php';
require_once dirname(dirname(__FILE__)).'\entity\s_areainfo.php';
require_once dirname(dirname(__FILE__)).'\entity\s_articleinfo.php';
require_once dirname(dirname(__FILE__)).'\entity\s_articletype.php';
require_once dirname(dirname(__FILE__)).'\entity\s_brandinfo.php';
require_once dirname(dirname(__FILE__)).'\entity\s_navigationinfo.php';
require_once dirname(dirname(__FILE__)).'\entity\s_prodycttypeinfo.php';
require_once dirname(dirname(__FILE__)).'\entity\s_productinfo.php';
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
			$s_areainfo=new s_areainfo();
			$s_areainfo->aId=$res_msg['aId'];
			$s_areainfo->aName=$res_msg['aName'];
			$s_areainfo->parentId=$res_msg['parentId'];
			$s_areainfo->remark=$res_msg['remark'];
			$arr[]=$s_areainfo;
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
				$s_areainfo=new s_areainfo();
				$s_areainfo->aId=$res_msg['aId'];
				$s_areainfo->aName=$res_msg['aName'];
				$s_areainfo->parentId=$res_msg['parentId'];
				$s_areainfo->remark=$res_msg['remark'];
				$arr[]=$s_areainfo;
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
	//查询主页品牌图片
	function query_brandinfo($sql){
				$DBUtil=new DBUtil();
				$res_brand=$DBUtil->query_all($sql);
				$arr=null;
				while($res_msg=mysqli_fetch_array($res_brand)){
					$s_brandinfo=new s_brandinfo();
					$s_brandinfo->bId=$res_msg['bId'];
					$s_brandinfo->bName=$res_msg['bName'];
					$s_brandinfo->bLog=$res_msg['bLog'];
					$s_brandinfo->bIntroduce=$res_msg['bIntroduce'];
					$s_brandinfo->bUrl=$res_msg['bUrl'];
					$s_brandinfo->remark=$res_msg['remark'];
					
					$arr[]=$s_brandinfo;
				}
				return $arr;	
		 }
	//查询帮助中心  首页  关于我们
	 function query_s_navigationinfo($sql){
		$DBUtil=new DBUtil();
		$con=$DBUtil->getcon();
		$res=mysqli_query($con, $sql);
		$arr=null;
		while($res_msg=mysqli_fetch_array($res)){
			$s_navigationinfo=new s_navigationinfo();
			$s_navigationinfo->nId=$res_msg['nId'];
			$s_navigationinfo->nName=$res_msg['nName'];
			$s_navigationinfo->nUrl=$res_msg['nUrl'];
			$s_navigationinfo->nIsNew=$res_msg['nIsNew'];
			$s_navigationinfo->orders=$res_msg['orders'];
			$arr[]=$s_navigationinfo;
			
		}
		return $arr;
		
	}
	 //查询
	function query_s_prodycttypeinfo($sql){
		$DButil=new DButil();
		$con=$DButil->getcon();
		$res=mysqli_query($con, $sql);
		$arr=null;
		while($res_msg=mysqli_fetch_array($res)){
			$s_prodycttypeinfo=new s_prodycttypeinfo();
			$s_prodycttypeinfo->ptId=$res_msg['ptId'];
			$s_prodycttypeinfo->ptName=$res_msg['ptName'];
			$s_prodycttypeinfo->parentId=$res_msg['parentId'];
			$s_prodycttypeinfo->remark=$res_msg['remark'];
			$arr[]=$s_prodycttypeinfo;		
		}
		return $arr;
		
	}
	//查询热门商品
	function query_s_productinfo($sql){
			$DButil=new DBUtil();
			$con=$DButil->getCon();
			$res=mysqli_query($con, $sql);
			mysqli_close($con);
			$arr=null;
			while($res_product=mysqli_fetch_array($res)){
				$s_productinfo=new s_productinfo();
				$s_productinfo->pId=$res_product['pId'];
				$s_productinfo->ptId=$res_product['ptId'];
				$s_productinfo->bId=$res_product['bId'];
				$s_productinfo->psId=$res_product['psId'];
				$s_productinfo->pName=$res_product['pName'];
				$s_productinfo->pPrice=$res_product['pPrice'];
				$s_productinfo->pAddr=$res_product['pAddr'];
				$s_productinfo->pPhoto=$res_product['pPhoto'];
//			    $s_productinfo->pIntroduct=$res_product['pIntroduct'];
				$s_productinfo->pWeight=$res_product['pWeight'];
				$s_productinfo->pCount=$res_product['pCount'];
				$s_productinfo->pState=$res_product['pState'];
//				$s_productinfo->isHost=$res_product['isHost'];
				$s_productinfo->isNew=$res_product['isNew'];
				$s_productinfo->remark=$res_product['remark'];
				$s_productinfo->createDate=$res_product['createDate'];
				$s_productinfo->costPrice=$res_product['costPrice'];
				$s_productinfo->marketPrice=$res_product['marketPrice'];
				$s_productinfo->VIPPrice=$res_product['VIPPrice'];
				$s_productinfo->pScore=$res_product['pScore'];
				$s_productinfo->num=1;
				$arr[]=$s_productinfo;
				
			}
			return $arr;
		}
	
	
	
	
	}
?>