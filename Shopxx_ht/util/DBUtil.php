<?php
require_once dirname(dirname(__FILE__)).'\entity\s_userinfo.php';
require_once dirname(dirname(__FILE__)).'\entity\s_brandinfo.php';
require_once dirname(dirname(__FILE__)).'\entity\s_prodycttypeinfo.php';
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
		//查询商品品牌
		function query_s_brandinfo($sql){
				$dbutil=new DBUtil();
				$res_band=$bdutil->query_all($sql);
				$arr=null;
				while($res_msg=mysqli_fetch_all($res_brand)){
					$brand->bId=$res_msg['bId'];
					$brand->ptId=$res_msg['ptId'];
					$brand->bName=$res_msg['bName'];
					$brand->bLong=$res_msg['bLong'];
					$brand->bIntroduce=$res_msg['bIntroduce'];
					$brand->bUrl=$res_msg['bUrl'];
					$brand->remark=$res_msg['remark'];
					$arr[]=$brand;
				}
				return $arr;
			}
		//添加商品品牌
		function query_add_s_brandinfo($s_brandinfo){
//				var_dump($brandinfo);
				$bId=$s_brandinfo->bId;
				$ptId=$s_brandinfo->ptId;
				$bName=$s_brandinfo->bName;
				$bLog=$s_brandinfo->bLog;
				$bIntroduce=$s_brandinfo->bIntroduce；
				$bUrl=$s_brandinfo->bUrl;
				$remark=$s_brandinfo->reamrk;
				
				$dbutil=new DBUtil();
				$con=$dbutil->getCon();
				$sql='insert into s_brandinfo values(?,?,?,?,?,?,?)';
				$stm=$con->prepare($sql);
				$stm->bind_param('iisssss',$bId,$ptId,$bName,$bLog,$bIntroduce,$bUrl,$reamrk);
				$flag=$stm->execute();
				return $flag;
			}
		
		function query_add_s_producttypeinfo($sql){
				$dbutil=new DBUtil();
				$res_type=$dbutil->query_all($sql);
				$arr=null;
				while($res_msg=mysqli_fetch_array($res_type)){
					$type->ptId=$res_msg['ptId'];
					$type->ptName=$res_msg['ptName'];
					$type->parentId=$res_msg['parentId'];
					$type->reamrk=$res_msg['reamrk'];
					$arr[]=$type;
				}
				return $arr;
			}
	
	
	
}
?>