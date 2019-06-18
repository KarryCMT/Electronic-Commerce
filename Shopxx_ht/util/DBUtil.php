<?php
require_once dirname(dirname(__FILE__)).'\entity\s_userinfo.php';
require_once dirname(dirname(__FILE__)).'\entity\s_brandinfo.php';
require_once dirname(dirname(__FILE__)).'\entity\s_prodycttypeinfo.php';
require_once dirname(dirname(__FILE__)).'\entity\s_navigationinfo.php';
require_once dirname(dirname(__FILE__)).'\entity\s_productspecinfo.php';
require_once dirname(dirname(__FILE__)).'\entity\s_orderinfo.php';
require_once dirname(dirname(__FILE__)).'\entity\s_customerinfo.php';
require_once dirname(dirname(__FILE__)).'\entity\s_paytypeinfo.php';
require_once dirname(dirname(__FILE__)).'\entity\s_expresstypeinfo.php';
require_once dirname(dirname(__FILE__)).'\entity\s_customergradeinfo.php';
require_once dirname(dirname(__FILE__)).'\entity\s_receiveaddrinfo.php';
require_once dirname(dirname(__FILE__)).'\entity\s_prodycttypeinfo.php';
require_once dirname(dirname(__FILE__)).'\entity\s_friendshipinfo.php';
require_once dirname(dirname(__FILE__)).'\entity\s_articletype.php';
require_once dirname(dirname(__FILE__)).'\entity\s_articleinfo.php';

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
			function query_all($sql){
					$DBUtil=new DBUtil();
					$con=$DBUtil->getCon();
					$res=mysqli_query($con, $sql);
					mysqli_close($con);
					return $res;		
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
		
		  //添加品牌
		function  braind($s_brandinfo){
				$bId=$s_brandinfo->bId;
				$ptId=$s_brandinfo->ptId;
				$bName=$s_brandinfo->bName;
				$blog=$s_brandinfo->blog;
				$bIntroduce=$s_brandinfo->bIntroduce;
				$bUrl=$s_brandinfo->bUrl;
				$remark=$s_brandinfo->remark;
				$dbutil=new DBUtil();
				$con=$dbutil->getCon();
				$sql="INSERT INTO s_brandinfo VALUES(?,?,?,?,?,?,?)";
				$stm=$con->prepare($sql);
				$stm->bind_param('iisssss',$bId,$ptId,$bName,$blog,$bIntroduce,$bUrl,$remark);
				$flge=$stm->execute();// 当删除的数据不存在时，这里无论如何都返回 true
				return $flge;
		}
		  //添加品牌参数
		function  add_Spec($s_productspecinfo){
				$psId=$s_productspecinfo->psId;
				$psName=$s_productspecinfo->psName;
				$order=$s_productspecinfo->order;
				$psVal=$s_productspecinfo->psVal;
				$remark=$s_productspecinfo->remark;
				$ptid=$s_productspecinfo->ptid;
				$dbutil=new DBUtil();
				$con=$dbutil->getCon();
				$sql="INSERT INTO s_productspecinfo VALUES(?,?,?,?,?,?)";
				$stm=$con->prepare($sql);
				$stm->bind_param('isissi',$psId,$psName,$order,$psVal,$remark,$ptid);
				$flge=$stm->execute();// 当删除的数据不存在时，这里无论如何都返回 true
				return $flge;
		}
		//查询品牌列表
		function  query_braind($sql){
			$arr=NULL;
			$dbutil=new DBUtil();
			$sql="SELECT *FROM s_brandinfo";
			$res=$dbutil->query_all($sql);
			while($msg_bra=mysqli_fetch_array($res)){
				$s_brandinfo=new s_brandinfo();
				$bId=$msg_bra['bId'];
				$bName=$msg_bra['bName'];
				$remark=$msg_bra['remark'];
				$bUrl=$msg_bra['bUrl'];
				$bIntroduce=$msg_bra['bIntroduce'];
				$blog=$msg_bra['bLog'];
				$s_brandinfo->bId=$bId;
				$s_brandinfo->bName=$bName;
				$s_brandinfo->bUrl=$bUrl;
				$s_brandinfo->blog=$blog;
				$s_brandinfo->bIntroduce=$bIntroduce;
				$s_brandinfo->remark=$remark;
				$arr[]=$s_brandinfo;
			}
			return $arr;
		}
		//查询文章列表
		function  query_aricle($sql){
			$arr=NULL;
			$dbutil=new DBUtil();
			$sql="SELECT *FROM s_articleinfo";
			$res=$dbutil->query($sql);
			while($msg_art=mysqli_fetch_array($res)){
				$s_articleinfo=new s_articleinfo();
				$ArId=$msg_art['ArId'];
				$ArTitle=$msg_art['ArTitle'];
				$ArContent=$msg_art['ArContent'];
				$AtId=$msg_art['AtId'];
				$AtAuthor=$msg_art['AtAuthor'];
				$States=$msg_art['States'];
				$isTop=$msg_art['isTop'];
				$ArMark=$msg_art['ArMark'];
				$CrTime=$msg_art['CrTime'];
				$s_articleinfo->ArId=$ArId;
				$s_articleinfo->ArTitle=$ArTitle;
				$s_articleinfo->ArContent=$ArContent;
				$s_articleinfo->AtId=$AtId;
				$s_articleinfo->AtAuthor=$AtAuthor;
				$s_articleinfo->States=$States;
				$s_articleinfo->isTop=$isTop;
				$s_articleinfo->ArMark=$ArMark;
				$s_articleinfo->CrTime=$CrTime;
				$arr[]=$s_articleinfo;
			}
			return $arr;
		}
		//查询文章类型列表
		function  query_aricletype($sql){
			$arr=NULL;
			$dbutil=new DBUtil();
			$sql="SELECT *FROM s_articletype";
			$res=$dbutil->query($sql);
			while($msg_art=mysqli_fetch_array($res)){
				$s_articletypeinfo=new s_articletypeinfo();
				$AtId=$msg_art['AtId'];
				$ArName=$msg_art['ArName'];
				$AtTitle=$msg_art['AtTitle'];
				$AtImp=$msg_art['AtImp'];
				$AtRemark=$msg_art['AtRemark'];
				$Atorder=$msg_art['Atorder'];
				$s_articletypeinfo->AtId=$AtId;
				$s_articletypeinfo->ArName=$ArName;
				$s_articletypeinfo->AtTitle=$AtTitle;
				$s_articletypeinfo->AtImp=$AtImp;
				$s_articletypeinfo->AtRemark=$AtRemark;
				$s_articletypeinfo->Atorder=$Atorder;
				$arr[]=$s_articletypeinfo;
			}
			return $arr;
		}
		//查询友情连接列表
		function  query_Friend($sql){
			$arr=NULL;
			$dbutil=new DBUtil();
			$res=$dbutil->query($sql);
			while($msg_bra=mysqli_fetch_array($res)){
				$s_Friendship=new s_Friendship();
				$fr_Id=$msg_bra['fr_Id'];
				$fr_Name=$msg_bra['fr_Name'];
				$fr_logo=$msg_bra['fr_logo'];
				$fr_url=$msg_bra['fr_url'];
				$fr_order=$msg_bra['fr_order'];
				$fr_createDate=$msg_bra['fr_createDate'];
				$s_Friendship->fr_Id=$fr_Id;
				$s_Friendship->fr_Name=$fr_Name;
				$s_Friendship->fr_logo=$fr_logo;
				$s_Friendship->fr_url=$fr_url;
				$s_Friendship->fr_order=$fr_order;
				$s_Friendship->fr_createDate=$fr_createDate;
				$arr[]=$s_Friendship;
			}
			return $arr;
		}
		//查询导航列表
		function  query_nav($sql){
			$arr=NULL;
			$dbutil=new DBUtil();
			$res=$dbutil->query($sql);
			while($msg_bra=mysqli_fetch_array($res)){
				$s_navigation=new s_navigation();
				$nID=$msg_bra['nId'];
				$nName=$msg_bra['nName'];
				$nUrl=$msg_bra['nUrl'];
				$nPosition=$msg_bra['nPosition'];
				$nIsNew=$msg_bra['nIsNew'];
				$orders=$msg_bra['orders'];
				$s_navigation->nID=$nID;
				$s_navigation->nName=$nName;
				$s_navigation->nUrl=$nUrl;
				$s_navigation->nPosition=$nPosition;
				$s_navigation->nIsNew=$nIsNew;
				$s_navigation->orders=$orders;
				$arr[]=$s_navigation;
			}
			return $arr;
		}
		//查询商品规格列表
		function  query_spec($sql){
			$arr=NULL;
			$dbutil=new DBUtil();
			$sql="SELECT *FROM s_productspecinfo";
			$res=$dbutil->query($sql);
			while($msg_art=mysqli_fetch_array($res)){
				$s_productspecinfo=new s_productspecinfo();
				$psId=$msg_art['psId'];
				$psName=$msg_art['psName'];
				$order=$msg_art['orders'];
				$psVal=$msg_art['psVal'];
				$remark=$msg_art['remark'];
				$ptid=$msg_art['ptid'];
				$s_productspecinfo->psId=$psId;
				$s_productspecinfo->psName=$psName;
				$s_productspecinfo->order=$order;
				$s_productspecinfo->psVal=$psVal;
				$s_productspecinfo->remark=$remark;
				$s_productspecinfo->ptid=$ptid;
				$arr[]=$s_productspecinfo;
			}
			return $arr;
		}
		//查询订单列表
		function  query_orders($sql){
			$arr=NULL;
			$dbutil=new DBUtil();
			$res=$dbutil->query($sql);
			while($msg_art=mysqli_fetch_array($res)){
				$s_orderinfo=new s_orderinfo();
				$oId=$msg_art['oId'];
				$etId=$msg_art['etId'];
				$raId=$msg_art['raId'];
				$cId=$msg_art['cId'];
				$ptId=$msg_art['ptId'];
				$pId=$msg_art['pId'];
				$eFee=$msg_art['eFee'];
				$paFee=$msg_art['paFee'];
				$totalAmount=$msg_art['totalAmount'];
				$msg=$msg_art['msg'];
				$oState=$msg_art['oState'];
				$createTime=$msg_art['createTime'];
				$pSum=$msg_art['pSum'];
				$remark=$msg_art['remark'];
				//查询收货人姓名
				$sql_custoerm="select cgId,cId,cName from s_customerinfo where cId=".$cId;
				$customerInfo=$dbutil->query_costomer($sql_custoerm);
				$s_orderinfo->customerInfo=$customerInfo;
				//查询支付方式
				$sql_paytype="select ptId,ptName from s_paytypeinfo where ptId=".$ptId;
				$paytype=$dbutil->query_paytype($sql_paytype);
				$s_orderinfo->ptName=$paytype;
				//查询配送方式
				$sql_express="select etId,etName from s_expresstypeinfo where etId=".$etId;
				$express=$dbutil->query_express($sql_express);
				$s_orderinfo->etName=$express;
				
				$s_orderinfo->oId=$oId;
				$s_orderinfo->etId=$etId;
				$s_orderinfo->raId=$raId;
				$s_orderinfo->cId=$cId;
				$s_orderinfo->ptId=$ptId;
				$s_orderinfo->pId=$pId;
				$s_orderinfo->eFee=$eFee;
				$s_orderinfo->paFee=$paFee;
				$s_orderinfo->totalAmount=$totalAmount;
				$s_orderinfo->pSum=$pSum;
				$s_orderinfo->msg=$msg;
				$s_orderinfo->oState=$oState;
				$s_orderinfo->createTime=$createTime;
				$s_orderinfo->remark=$remark;
				$arr[]=$s_orderinfo;
			}
			return $arr;
		}
		//查询会员等级
		function  query_vip($sql){
			$arr=NULL;
			$dbutil=new DBUtil();
			$res=$dbutil->query($sql);
			while($msg_bra=mysqli_fetch_array($res)){
				$s_customergradeinfo=new s_customergradeinfo();
				$cgId=$msg_bra['cgId'];
				$cgName=$msg_bra['cgName'];
				$s_customergradeinfo->cgId=$cgId;
				$s_customergradeinfo->cgName=$cgName;
				$arr[]=$s_customergradeinfo;
			}
			return $arr;
		}
		//查询用户customer
		function  query_costomer($sql){
			$arr=NULL;
			$dbutil=new DBUtil();
			$res=$dbutil->query($sql);
			while($msg_art=mysqli_fetch_array($res)){
				$s_customerinfo=new s_customerinfo();
				$cgId=$msg_art['cgId'];
				$cId=$msg_art['cId'];
				$cName=$msg_art['cName'];
				$sql_custoerm="select cgId,cgName from s_customergradeinfo where cgId=".$cgId;
				$gradeInfo_arr=$dbutil->query_vip($sql_custoerm);
				$s_customerinfo->gradeInfo=$gradeInfo_arr[0];
				$s_customerinfo->cgId=$cgId;
				$s_customerinfo->cId=$cId;
				$s_customerinfo->cName=$cName;//用户名
				$arr[]=$s_customerinfo;
			}
			return $arr;
		}
		//查询支付类型
		function  query_paytype($sql){
			$arr=NULL;
			$dbutil=new DBUtil();
			$res=$dbutil->query($sql);
			while($msg_art=mysqli_fetch_array($res)){
				$s_paytypeinfo=new s_paytypeinfo();
				$ptId=$msg_art['ptId'];
				$ptName=$msg_art['ptName'];
				$s_paytypeinfo->ptId=$ptId;
				$s_paytypeinfo->ptName=$ptName;
				$arr[]=$s_paytypeinfo;
			}
			return $arr;
		}
		//查询快递类型
		function  query_express($sql){
			$arr=NULL;
			$dbutil=new DBUtil();
			$res=$dbutil->query($sql);
			while($msg_art=mysqli_fetch_array($res)){
				$s_expresstypeinfo=new s_expresstypeinfo();
				$etId=$msg_art['etId'];
				$etName=$msg_art['etName'];
				$s_expresstypeinfo->etId=$etId;
				$s_expresstypeinfo->etName=$etName;
				$arr[]=$s_expresstypeinfo;
			}
			return $arr;
		}
		//查询商品类型
		function  query_proype($sql){
			$arr=NULL;
			$dbutil=new DBUtil();
			$res=$dbutil->query($sql);
			while($msg_art=mysqli_fetch_array($res)){
				$s_producttypeinfo=new s_producttypeinfo();
				$ptId=$msg_art['ptId'];
				$ptName=$msg_art['ptName'];
				$parentId=$msg_art['parentId'];
				$remark=$msg_art['remark'];
				$s_producttypeinfo->ptId=$ptId;
				$s_producttypeinfo->ptName=$ptName;
				$s_producttypeinfo->parentId=$parentId;
				$s_producttypeinfo->remark=$remark;
				$arr[]=$s_producttypeinfo;
			}
			return $arr;
		}
		
		//删除某些品牌
		function delete_Braind($bId){
			$dbutil=new DBUtil();
			$con=$dbutil->getCon();
			$SQL='DELETE from s_brandinfo WHERE bId=?';
			$stm=$con->prepare($SQL);
			$stm->bind_param('i',$bId);
			$flag=$stm->execute();
			return $flag;
		}
		//删除文章
		function delete_Article($ArId){
			$dbutil=new DBUtil();
			$con=$dbutil->getCon();
			$SQL='DELETE from s_articleinfo WHERE ArId=?';
			$stm=$con->prepare($SQL);
			$stm->bind_param('i',$ArId);
			$flag=$stm->execute();
			return $flag;
		}
		//删除文章列表
		function delete_ArticleType($AtId){
			$dbutil=new DBUtil();
			$con=$dbutil->getCon();
			$SQL='DELETE from s_articletype WHERE AtId=?';
			$stm=$con->prepare($SQL);
			$stm->bind_param('i',$AtId);
			$flag=$stm->execute();
			return $flag;
		}
		//删除导航
		function delete_Navigation($nId){
			$dbutil=new DBUtil();
			$con=$dbutil->getCon();
			$SQL='DELETE from s_navigationinfo WHERE nId=?';
			$stm=$con->prepare($SQL);
			$stm->bind_param('i',$nId);
			$flag=$stm->execute();
			return $flag;
		}
		//删除友情链接
		function delete_Friend($fr_Id){
			$dbutil=new DBUtil();
			$con=$dbutil->getCon();
			$SQL='DELETE from s_friendshipinfo WHERE fr_Id=?';
			$stm=$con->prepare($SQL);
			$stm->bind_param('i',$fr_Id);
			$flag=$stm->execute();
			return $flag;
		}
		//删除商品参数
		function delete_spec($psId){
			$dbutil=new DBUtil();
			$con=$dbutil->getCon();
			$SQL='DELETE from s_productspecinfo WHERE psId=?';
			$stm=$con->prepare($SQL);
			$stm->bind_param('i',$psId);
			$flag=$stm->execute();
			return $flag;
		}
		//删除订单
		function delete_order($oId){
			$dbutil=new DBUtil();
			$con=$dbutil->getCon();
			$SQL='DELETE from s_orderinfo WHERE oId=?';
			$stm=$con->prepare($SQL);
			$stm->bind_param('i',$oId);
			$flag=$stm->execute();
			return $flag;
		}
		//删除商品类型
		function delete_goods($ptId){
			$dbutil=new DBUtil();
			$con=$dbutil->getCon();
			$SQL='DELETE from s_producttypeinfo WHERE ptId=?';
			$stm=$con->prepare($SQL);
			$stm->bind_param('i',$ptId);
			$flag=$stm->execute();
			return $flag;
		}
		//删除退货列表
		function delete_return($rfId){
			$dbutil=new DBUtil();
			$con=$dbutil->getCon();
			$SQL='DELETE from s_refundinfo WHERE rfId=?';
			$stm=$con->prepare($SQL);
			$stm->bind_param('i',$rfId);
			$flag=$stm->execute();
			return $flag;
		}
		//获取商品品牌列表中的某一条数据
		function get_one_Braind($sql){
			$dbutil=new DBUtil();
			$res=$dbutil->query($sql);
			$s_brandinfo=new s_brandinfo();
			if($msg_bra=mysqli_fetch_array($res)){
				$bId=$msg_bra['bId'];
				$bName=$msg_bra['bName'];
				$blog=$msg_bra['bLog'];
				$bIntroduce=$msg_bra['bIntroduce'];
				$bUrl=$msg_bra['bUrl'];
				$ptId=$msg_bra['ptId'];
				$remark=$msg_bra['remark'];
				$s_brandinfo->bId=$bId;
				$s_brandinfo->bName=$bName;
				$s_brandinfo->blog=$blog;
				$s_brandinfo->bIntroduce=$bIntroduce;
				$s_brandinfo->bUrl=$bUrl;
				$s_brandinfo->remark=$remark;
			}
			return $s_brandinfo;
		}
		//获取文章列表中的某一条数据
		function get_one_Article($sql){
			$dbutil=new DBUtil();
			$res=$dbutil->query($sql);
			$s_articleinfo=new s_articleinfo();
			if($msg_bra=mysqli_fetch_array($res)){
				$ArId=$msg_bra['ArId'];
				$ArTitle=$msg_bra['ArTitle'];
				$ArContent=$msg_bra['ArContent'];
				$AtId=$msg_bra['AtId'];
				$AtAuthor=$msg_bra['AtAuthor'];
				$States=$msg_bra['States'];
				$isTop=$msg_bra['isTop'];
				$ArMark=$msg_bra['ArMark'];
				$s_articleinfo->ArId=$ArId;
				$s_articleinfo->ArTitle=$ArTitle;
				$s_articleinfo->ArContent=$ArContent;
				$s_articleinfo->AtId=$AtId;
				$s_articleinfo->AtAuthor=$AtAuthor;
				$s_articleinfo->States=$States;
				$s_articleinfo->isTop=$isTop;
				$s_articleinfo->ArMark=$ArMark;
			}
			return $s_articleinfo;
		}
		//获取文章类型列表的某条数据
		function get_one_ArticleType($sql){
			$until=new DBUtil();
			$res=$until->query($sql);
			$s_articletypeinfo=new s_articletypeinfo();
			if($msg_bra=mysqli_fetch_array($res)){
				$AtId=$msg_bra['AtId'];
				$ArName=$msg_bra['ArName'];
				$AtTitle=$msg_bra['AtTitle'];
				$AtImp=$msg_bra['AtImp'];
				$AtRemark=$msg_bra['AtRemark'];
				$Atorder=$msg_bra['Atorder'];
				$s_articletypeinfo->AtId=$AtId;
				$s_articletypeinfo->ArName=$ArName;
				$s_articletypeinfo->AtTitle=$AtTitle;
				$s_articletypeinfo->AtImp=$AtImp;
				$s_articletypeinfo->AtRemark=$AtRemark;
				$s_articletypeinfo->Atorder=$Atorder;
			}
			return $s_articletypeinfo;
		}
		//获取导航列表的某条数据
		function get_one_Nav($sql){
			$until=new DBUtil();
			$res=$until->query($sql);
			$s_navigation=new s_navigation();
			if($msg_bra=mysqli_fetch_array($res)){
				$nID=$msg_bra['nId'];
				$nName=$msg_bra['nName'];
				$nUrl=$msg_bra['nUrl'];
				$nPosition=$msg_bra['nPosition'];
				$nIsNew=$msg_bra['nIsNew'];
				$orders=$msg_bra['orders'];
				$s_navigation->nID=$nID;
				$s_navigation->nName=$nName;
				$s_navigation->nUrl=$nUrl;
				$s_navigation->nPosition=$nPosition;
				$s_navigation->nIsNew=$nIsNew;
				$s_navigation->orders=$orders;
			}
			return $s_navigation;
		}
		//获取友情链接列表的某条数据
		function get_one_Friend($sql){
			$until=new DBUtil();
			$res=$until->query($sql);
			$s_Friendship=new s_Friendship();
			if($msg_bra=mysqli_fetch_array($res)){
				$fr_Id=$msg_bra['fr_Id'];
				$fr_Name=$msg_bra['fr_Name'];
				$fr_logo=$msg_bra['fr_logo'];
				$fr_url=$msg_bra['fr_url'];
				$fr_order=$msg_bra['fr_order'];
				$s_Friendship->fr_Id=$fr_Id;
				$s_Friendship->fr_Name=$fr_Name;
				$s_Friendship->fr_logo=$fr_logo;
				$s_Friendship->fr_url=$fr_url;
				$s_Friendship->fr_order=$fr_order;
			}
			return $s_Friendship;
		}
		//获取商品参数的某条数据
		function get_one_spec($sql){
			$until=new DBUtil();
			$res=$until->query($sql);
			$s_productspecinfo=new s_productspecinfo();
			if($msg_bra=mysqli_fetch_array($res)){
				$psId=$msg_bra['psId'];
				$psName=$msg_bra['psName'];
				$order=$msg_bra['orders'];
				$psVal=$msg_bra['psVal'];
				$remark=$msg_bra['remark'];
				$ptid=$msg_bra['ptid'];
				$s_productspecinfo->psId=$psId;
				$s_productspecinfo->psName=$psName;
				$s_productspecinfo->order=$order;
				$s_productspecinfo->psVal=$psVal;
				$s_productspecinfo->remark=$remark;
				$s_productspecinfo->ptid=$ptid;
			}
			return $s_productspecinfo;
		}
		//获取订单的某条数据
		function get_one_order($sql){
			$until=new DBUtil();
			$res=$until->query($sql);
			$s_orderinfo=new s_orderinfo();
			if($msg_bra=mysqli_fetch_array($res)){
				$oId=$msg_bra['oId'];
				$etId=$msg_bra['etId'];
				$raId=$msg_bra['raId'];
				$cId=$msg_bra['cId'];
				$ptId=$msg_bra['ptId'];
				$pId=$msg_bra['pId'];
				$eFee=$msg_bra['eFee'];
				$paFee=$msg_bra['paFee'];
				$totalAmount=$msg_bra['totalAmount'];
				$pSum=$msg_bra['pSum'];
				$msg=$msg_bra['msg'];
				$oState=$msg_bra['oState'];
				$createTime=$msg_bra['createTime'];
				$remark=$msg_bra['remark'];
				//查询收货人姓名
				$sql_custoerm="select cgId,cId,cName from s_customerinfo where cId=".$cId;
				$customerInfo=$until->query_costomer($sql_custoerm);
				$s_orderinfo->customerInfo=$customerInfo;
				//查询支付方式
				$sql_paytype="select ptId,ptName from s_paytypeinfo where ptId=".$ptId;
				$paytype=$until->query_paytype($sql_paytype);
				$s_orderinfo->ptName=$paytype;
				//查询配送方式
				$sql_express="select etId,etName from s_expresstypeinfo where etId=".$etId;
				$express=$until->query_express($sql_express);
				$s_orderinfo->etName=$express;
				$s_orderinfo->oId=$oId;
				$s_orderinfo->etId=$etId;
				$s_orderinfo->raId=$raId;
				$s_orderinfo->cId=$cId;
				$s_orderinfo->ptId=$ptId;
				$s_orderinfo->pId=$pId;
				$s_orderinfo->eFee=$eFee;
				$s_orderinfo->paFee=$paFee;
				$s_orderinfo->totalAmount=$totalAmount;
				$s_orderinfo->pSum=$pSum;
				$s_orderinfo->msg=$msg;
				$s_orderinfo->oState=$oState;
				$s_orderinfo->createTime=$createTime;
				$s_orderinfo->remark=$remark;
			}
			return $s_orderinfo;
		}
		//修改品牌内容
		function update_Braind($s_brandinfo){
			$ptId=$s_brandinfo->ptId;		
			$bId=$s_brandinfo->bId;
			$bName=$s_brandinfo->bName;
			$blog=$s_brandinfo->blog;
			$bIntroduce=$s_brandinfo->bIntroduce;
			$bUrl=$s_brandinfo->bUrl;
			$remark=$s_brandinfo->remark;
			$dbutil=new DBUtil();
			$con=$dbutil->getCon();
			$sql="update s_brandinfo set ptId=?,bName=?,blog=?,bIntroduce=?,bUrl=?,remark=? where bId=?";
			$stm=$con->prepare($sql);
			$stm->bind_param('isssssi',$ptId,$bName,$blog,$bIntroduce,$bUrl,$remark,$bId);
			$flge=$stm->execute();
			return $flge;
		}
		//修改文章类型内容
		function update_articleType($s_articletypeinfo){
			$AtId=$s_articletypeinfo->AtId;
			$ArName=$s_articletypeinfo->ArName;
			$AtTitle=$s_articletypeinfo->AtTitle;
			$AtImp=$s_articletypeinfo->AtImp;
			$AtRemark=$s_articletypeinfo->AtRemark;
			$Atorder=$s_articletypeinfo->Atorder;
			$dbutil=new DBUtil();
			$con=$dbutil->getCon();
			$sql="update s_articletype set ArName=?,AtTitle=?,AtImp=?,AtRemark=?,Atorder=? where AtId=?";
			$stm=$con->prepare($sql);
			$stm->bind_param('sssssi',$ArName,$AtTitle,$AtImp,$AtRemark,$Atorder,$AtId);
			$flge=$stm->execute();
			return $flge;
		}
		//修改文章内容
		function update_Article($s_brandinfo){
			$ptId=$s_brandinfo->ptId;		
			$bId=$s_brandinfo->bId;
			$bName=$s_brandinfo->bName;
			$blog=$s_brandinfo->blog;
			$bIntroduce=$s_brandinfo->bIntroduce;
			$bUrl=$s_brandinfo->bUrl;
			$remark=$s_brandinfo->remark;
			$dbutil=new DBUtil();
			$con=$dbutil->getCon();
			$sql="update s_brandinfo set ptId=?,bName=?,blog=?,bIntroduce=?,bUrl=?,remark=? where bId=?";
			$stm=$con->prepare($sql);
			$stm->bind_param('isssssi',$ptId,$bName,$blog,$bIntroduce,$bUrl,$remark,$bId);
			$flge=$stm->execute();
			return $flge;
		}
		//修改导航内容
		function update_Navigation($s_navigation){
			$nID=$s_navigation->nID;		
			$nName=$s_navigation->nName;
			$nUrl=$s_navigation->nUrl;
			$nPosition=$s_navigation->nPosition;
			$nIsNew=$s_navigation->nIsNew;
			$orders=$s_navigation->orders;
			$dbutil=new DBUtil();
			$con=$dbutil->getCon();
			$sql="update s_navigationinfo set nName=?,nUrl=?,nPosition=?,nIsNew=?,orders=? where nId=?";
			$stm=$con->prepare($sql);
			$stm->bind_param('ssiiii',$nName,$nUrl,$nPosition,$nIsNew,$orders,$nID);
			$flge=$stm->execute();
			return $flge;
		}
		//修改商品参数内容
		function update_spec($s_productspecinfo){
			$psId=$s_productspecinfo->psId;		
			$psName=$s_productspecinfo->psName;
			$order=$s_productspecinfo->order;
			$psVal=$s_productspecinfo->psVal;
			$remark=$s_productspecinfo->remark;
			$ptid=$s_productspecinfo->ptid;
			$dbutil=new DBUtil();
			$con=$dbutil->getCon();
			$sql="update s_productspecinfo set psName=?,orders=?,psVal=?,remark=?,ptid=? where psId=?";
			$stm=$con->prepare($sql);
			$stm->bind_param('sissii',$psName,$order,$psVal,$remark,$ptid,$psId);
			$flge=$stm->execute();
			return $flge;
		}
		//修改友情列表内容
		function update_Friend($s_Friendship){
			$fr_Id=$s_Friendship->fr_Id;		
			$fr_Name=$s_Friendship->fr_Name;
			$fr_logo=$s_Friendship->fr_logo;
			$fr_url=$s_Friendship->fr_url;
			$fr_order=$s_Friendship->fr_order;
			$fr_createDate=$s_Friendship->fr_createDate;
			$dbutil=new DBUtil();
			$con=$dbutil->getCon();
			$sql="update s_friendshipinfo set fr_Name=?,fr_logo=?,fr_url=?,fr_order=? where fr_Id=?";
			$stm=$con->prepare($sql);
			$stm->bind_param('sssii',$fr_Name,$fr_logo,$fr_url,$fr_order,$fr_Id);
			$flge=$stm->execute();
			return $flge;
		}
		//修改订单信息
		function update_rece($s_receiveaddrinfoinfo){
			$raId=$s_receiveaddrinfoinfo->raId;		
			$aId=$s_receiveaddrinfoinfo->aId;
			$raName=$s_receiveaddrinfoinfo->raName;
			$addr=$s_receiveaddrinfoinfo->addr;
			$zipCode=$s_receiveaddrinfoinfo->zipCode;
			$mobile=$s_receiveaddrinfoinfo->mobile;
			$remark=$s_receiveaddrinfoinfo->remark;
			$dbutil=new DBUtil();
			$con=$dbutil->getCon();
			$sql="update s_receiveaddrinfo set aId=?,raName=?,addr=?,zipCode=?,mobile=?,remark=? where raId=?";
			$stm=$con->prepare($sql);
			$stm->bind_param('isssssi',$aId,$raName,$addr,$zipCode,$mobile,$remark,$raId);
			$flge=$stm->execute();
			return $flge;
		}
		//添加友情链接
		function  add_Friendship($s_Friendship){
				$fr_Id=$s_Friendship->fr_Id;
				$fr_Name=$s_Friendship->fr_Name;
				$fr_logo=$s_Friendship->fr_logo;
				$fr_url=$s_Friendship->fr_url;
				$fr_order=$s_Friendship->fr_order;
				$fr_createDate=$s_Friendship->fr_createDate;
				$dbutil=new DBUtil();
				$con=$dbutil->getCon();
				$sql="INSERT INTO s_Friendshipinfo VALUES(?,?,?,?,?,?)";
				$stm=$con->prepare($sql);
				$stm->bind_param('isssis',$fr_Id,$fr_Name,$fr_logo,$fr_url,$fr_order,$fr_createDate);
				$flge=$stm->execute();// 当删除的数据不存在时，这里无论如何都返回 true
				return $flge;
		}
		//添加导航
		function  add_Navigation($s_navigation){
				$nID=$s_navigation->nID;
				$nName=$s_navigation->nName;
				$nUrl=$s_navigation->nUrl;
				$nPosition=$s_navigation->nPosition;
				$nIsNew=$s_navigation->nIsNew;
				$orders=$s_navigation->orders;
				$dbutil=new DBUtil();
				$con=$dbutil->getCon();
				$sql="INSERT INTO s_navigationinfo VALUES(?,?,?,?,?,?)";
				$stm=$con->prepare($sql);
				$stm->bind_param('issiii',$nID,$nName,$nUrl,$nPosition,$nIsNew,$orders);
				$flge=$stm->execute();// 当删除的数据不存在时，这里无论如何都返回 true
				return $flge;
		}
		//用户地址
		function  customer_add($sql){
			$arr=NULL;
			$dbutil=new dbutil();
			$res=$dbutil->query($sql);
			while($msg_add=mysqli_fetch_array($res)){
				$s_receiveaddrinfoinfo=new $s_receiveaddrinfoinfo();
				$raId=$msg_add['raId'];
				$raId=$msg_add['raId'];
				$raName=$msg_add['raName'];
				$addr=$msg_add['addr'];
				$phone=$msg_add['phone'];
				$mobile=$msg_add['mobile'];
				$zipCode=$msg_add['zipCode'];
				$isDefault=$msg_add['isDefault'];
				$remark=$msg_add['remark'];
				$s_receiveaddrinfoinfo->raId=$raId;
				$s_receiveaddrinfoinfo->raId=$raId;
				$s_receiveaddrinfoinfo->raName=$raName;
				$s_receiveaddrinfoinfo->addr=$addr;
				$s_receiveaddrinfoinfo->phone=$phone;
				$s_receiveaddrinfoinfo->mobile=$mobile;
				$s_receiveaddrinfoinfo->zipCode=$zipCode;
				$s_receiveaddrinfoinfo->isDefault=$isDefault;
				$s_receiveaddrinfoinfo->remark=$remark;
				$arr[]=$s_receiveaddrinfoinfo;
			}
			return $arr;
		}
		//添加商品类型
		function  add_good($s_producttypeinfo){
				$ptId=$s_producttypeinfo->ptId;
				$ptName=$s_producttypeinfo->ptName;
				$parentId=$s_producttypeinfo->parentId;
				$remark=$s_producttypeinfo->remark;
				$dbutil=new DBUtil();
				$con=$dbutil->getCon();
				$sql="INSERT INTO s_producttypeinfo VALUES(?,?,?,?)";
				$stm=$con->prepare($sql);
				$stm->bind_param('isis',$ptId,$ptName,$parentId,$remark);
				$flge=$stm->execute();
				return $flge;
		}
		
		//用户
		function  customer($sql){
			$arr=NULL;
			$dbutil=new dbutil();
			$res=$dbutil->query($sql);
			while($msg_cus=mysqli_fetch_array($res)){
				$s_customerinfoinfo=new s_customerinfoinfo();
				$cId=$msg_cus['cId'];
				$cgId=$msg_cus['cgId'];
				$cName=$msg_cus['cName'];
				$cPwd=$msg_cus['cPwd'];
				$cEmail=$msg_cus['cEmail'];
				$cSex=$msg_cus['cSex'];
				$cBirth=$msg_cus['cBirth'];
				$raId=$msg_cus['raId'];
				$createTime=$msg_cus['createTime'];
				$remark=$msg_cus['remark'];
				$cState=$msg_cus['cState'];
				$trueName=$msg_cus['trueName'];
				$cellPhone=$msg_cus['cellPhone'];
				$telPhone=$msg_cus['telPhone'];
				$nickName=$msg_cus['nickName'];
				
				$s_customerinfoinfo->cId=$cId;
				$s_customerinfoinfo->cgId=$cgId;
				$s_customerinfoinfo->cName=$cName;
				$s_customerinfoinfo->cPwd=$cPwd;
				$s_customerinfoinfo->cEmail=$cEmail;
				$s_customerinfoinfo->cSex=$cSex;
				$s_customerinfoinfo->cBirth=$cBirth;
				$s_customerinfoinfo->raId=$raId;
				$s_customerinfoinfo->createTime=$createTime;
				$s_customerinfoinfo->remark=$remark;
				$s_customerinfoinfo->cState=$cState;
				$s_customerinfoinfo->trueName=$trueName;
				$s_customerinfoinfo->cellPhone=$cellPhone;
				$s_customerinfoinfo->telPhone=$telPhone;
				$s_customerinfoinfo->nickName=$nickName;
				$arr[]=$s_customerinfoinfo;
			}
			return $arr;
		}

		//用户等级
		function  customer_level($sql){
			$arr=NULL;
			$dbutil=new dbutil();
			$res=$dbutil->query($sql);
			while($msg_lev=mysqli_fetch_array($res)){
				$s_customergradeinfoinfo=new s_customergradeinfoinfo();
				$cgId=$msg_lev['cgId'];
				$cName=$msg_lev['cName'];
				$cgIntroduce=$msg_lev['cgIntroduce'];
				$remark=$msg_lev['remark'];
				$ShoMoney=$msg_lev['ShoMoney'];
				$OffNum=$msg_lev['OffNum'];
				$isDef=$msg_lev['isDef'];
				
				$s_customergradeinfoinfo->cgId=$cgId;
				$s_customergradeinfoinfo->cName=$cName;
				$s_customergradeinfoinfo->cgIntroduce=$cgIntroduce;
				$s_customergradeinfoinfo->remark=$remark;
				$s_customergradeinfoinfo->ShoMoney=$ShoMoney;
				$s_customergradeinfoinfo->OffNum=$OffNum;
				$s_customergradeinfoinfo->isDef=$isDef;
				$arr[]=$s_customergradeinfoinfo;
			}
			return $arr;
		}
	
	
	
}
?>