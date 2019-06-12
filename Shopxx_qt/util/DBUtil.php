<?php
require_once dirname(dirname(__FILE__)).'\entity\s_customerinfo.php';
require_once dirname(dirname(__FILE__)).'\entity\s_areainfo.php';
require_once dirname(dirname(__FILE__)).'\entity\s_articleinfo.php';
require_once dirname(dirname(__FILE__)).'\entity\s_articletype.php';
require_once dirname(dirname(__FILE__)).'\entity\s_brandinfo.php';
require_once dirname(dirname(__FILE__)).'\entity\s_navigationinfo.php';
require_once dirname(dirname(__FILE__)).'\entity\s_prodycttypeinfo.php';
require_once dirname(dirname(__FILE__)).'\entity\s_productinfo.php';
require_once dirname(dirname(__FILE__)).'\entity\s_productinfo.php';
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
        $DBUtil=new DBUtil();
        $con=$DBUtil->getCon();
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
		$DBUtil=new DButil();
		$con=$DBUtil->getcon();
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
			$DBUtil=new DButil();
			$con=$DBUtil->getcon();
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
		$DBUtil=new DBUtil();
		$con=$DBUtil->getcon();
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
			$s_articletype->Arr_article=$DBUtil->query_s_articleinfo($sql_s_articleinfo);
			//将查询结果添加到数组
			$arr_s_articletype[]=$s_articletype;
		}
		return $arr_s_articletype;
	}
	//查询同类型新闻下面的所有新闻列表
	function query_s_articleinfo($sql){
		$DBUtil=new DBUtil();
		$con=$DBUtil->getcon();
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
		$DBUtil=new DButil();
		$con=$DBUtil->getcon();
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
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
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
		
		
		function delete_s_addcustomer(){
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$SQL='DELETE from s_addcustomer WHERE Aid=?,cid=?,AddCustomer=?,isDef=?';
			$stm=$con->prepare($SQL);
			$stm->bind_param('iisi',$Aid,$cid,$AddCustomer,$isDef);
			$flag=$stm->execute();
			return $flag;
		}
		function delete_s_areainfo(){
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$SQL='DELETE from s_areainfo WHERE aId=?,aName=?,parentId=?,remark=?';
			$stm=$con->prepare($SQL);
			$stm->bind_param('isis',$aId,$aName,$parentId,$remark);
			$flag=$stm->execute();
			return $flag;
		}
		function delete_s_articleinfo(){
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$SQL='DELETE from s_articleinfo WHERE ArId=?,ArTitle=?,ArContent=?,AtId=?,AtAuthor=?,States=?,isTop=?,ArMark=?,CrTime=?';
			$stm=$con->prepare($SQL);
			$stm->bind_param('issisiiis',$ArId,$ArTitle,$ArContent,$AtId,$AtAuthor,$States,$isTop,$ArMark,$CrTime);
			$flag=$stm->execute();
			return $flag;
		}
		function delete_s_articletype(){
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$SQL='DELETE from s_articletype WHERE AtId=?,ArName=?,AtTitle=?,AtImp=?,AtRemark=?,Atorder=?';
			$stm=$con->prepare($SQL);
			$stm->bind_param('issssi',$AtId,$ArName,$AtTitle,$AtImp,$AtRemark,$Atorder);
			$flag=$stm->execute();
			return $flag;
		}
		function delete_s_brandinfo(){
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$SQL='DELETE from s_brandinfo WHERE bId=?,ptId=?,bName=?,bLong=?,bIntroduce=?,bUrl=?,remark=?';
			$stm=$con->prepare($SQL);
			$stm->bind_param('iisssss',$bId,$ptId,$bName,$bLong,$bIntroduce,$bUrl,$remark);
			$flag=$stm->execute();
			return $flag;
		}
		function delete_s_cancelinfo(){
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$SQL='DELETE from s_cancelinfo WHERE cId=?,oId=?,cState=?,cMemo=?,createTime=?,remark=?';
			$stm=$con->prepare($SQL);
			$stm->bind_param('iiisss',$cId,$oId,$cState,$cMemo,$createTime,$remark);
			$flag=$stm->execute();
			return $flag;
		}
		function delete_s_customergradeinfo(){
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$SQL='DELETE from s_customergradeinfo WHERE cgId=?,cgName=?,cgIntronduce=?,remark=?,ShoMoney=?,OffNum=?,isDef=?';
			$stm=$con->prepare($SQL);
			$stm->bind_param('isssiii',$cgId,$cgName,$cgIntronduce,$remark,$ShoMoney,$OffNum,$isDef);
			$flag=$stm->execute();
			return $flag;
		}
		function delete_s_customerinfo(){
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$SQL='DELETE from s_customerinfo WHERE cId=?,cgId=?,cName=?,cPwd=?,cEmail=?,cSex=?,cBrith=?,aId=?,aId=?,createTime=?,remark=?,cState=?,trueName=?,cellPhone=?,telPhone=?,nickName=?';
			$stm=$con->prepare($SQL);
			$stm->bind_param('iisssssississs',$cId,$cgId,$cName,$cPwd,$cEmail,$cSex,$cBrith,$aId,$createTime,$remark,$cState,$trueName,$cellPhone,$telPhone,$nickName);
			$flag=$stm->execute();
			return $flag;
		}
		function delete_s_expresstypeinfo(){
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$SQL='DELETE from s_expresstypeinfo WHERE etId=?,etName=?,Fweight=?,fPrice=?,cWeight=?,etIntroduce=?,remark=?';
			$stm=$con->prepare($SQL);
			$stm->bind_param('isiiiiss',$etId,$etName,$Fweight,$fPrice,$cWeight,$etIntroduce,$remark);
			$flag=$stm->execute();
			return $flag;
		}
		function delete_s_friendshipinfo(){
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$SQL='DELETE from s_friendshipinfo WHERE fr_Id=?,fr_Name=?,fr_logo=?,fr_url=?,fr_order=?,fr_createDate=?';
			$stm=$con->prepare($SQL);
			$stm->bind_param('isssis',$fr_Id,$fr_Name,$fr_logo,$fr_url,$fr_order,$fr_createDate);
			$flag=$stm->execute();
			return $flag;
		}
		function delete_s_gatheringinfo(){
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$SQL='DELETE from s_gatheringinfo WHERE gId=?,cId=?,oId=?,gMoney=?,memo=?,createTime=?,remark=?';
			$stm=$con->prepare($SQL);
			$stm->bind_param('iiiisss',$gId,$cId,$oId,$gMoney,$memo,$createTime,$remark);
			$flag=$stm->execute();
			return $flag;
		}
		function delete_s_navigationinfo(){
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$SQL='DELETE from s_gatheringinfo WHERE nId=?,nName=?,nUrl=?,nPosition=?,nIsNew=?,orders=?';
			$stm=$con->prepare($SQL);
			$stm->bind_param('issiii',$nId,$nName,$nUrl,$nPosition,$nIsNew,$orders);
			$flag=$stm->execute();
			return $flag;
		}
		function delete_s_noticeinfo(){
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$SQL='DELETE from s_noticeinfo WHERE nId=?,uId=?,nTitle=?,nContent=?,createTime=?,remark=?';
			$stm=$con->prepare($SQL);
			$stm->bind_param('iissss',$nId,$uId,$nTitle,$nContent,$createTime,$remark);
			$flag=$stm->execute();
			return $flag;
		}
		function delete_s_orderinfo(){
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$SQL='DELETE from s_orderinfo WHERE oId=?,etId=?,aId=?,cId=?,ptId=?,pId=?,eFee=?,paFee=?,totalAmount=?,pSum=?,msg=?,oState=?,createTime=?,remark=?';
			$stm=$con->prepare($SQL);
			$stm->bind_param('iiiiiiiiiisiss',$oId,$etId,$aId,$cId,$ptId,$pId,$eFee,$paFee,$totalAmount,$pSum,$msg,$oState,$createTime,$remark);
			$flag=$stm->execute();
			return $flag;
		}
		function delete_s_paytypeinfo(){
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$SQL='DELETE from s_paytypeinfo WHERE ptId=?,ptName=?,ptType=?,ptLog=?,ptIntroduce=?,remark=?';
			$stm=$con->prepare($SQL);
			$stm->bind_param('isisss',$ptId,$ptName,$ptType,$ptLog,$ptIntroduce,$remark);
			$flag=$stm->execute();
			return $flag;
		}
		function delete_s_position(){
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$SQL='DELETE from s_position WHERE  pid=?,pName=?';
			$stm=$con->prepare($SQL);
			$stm->bind_param('is',$pid,$pName);
			$flag=$stm->execute();
			return $flag;
		}
		function delete_s_proattvalue(){
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$SQL='DELETE from s_position WHERE PAId=?,proId=?,AttValue=?,ProRemark=?,attId=?';
			$stm=$con->prepare($SQL);
			$stm->bind_param('iissi',$PAId,$proId,$AttValue,$ProRemark,$attId);
			$flag=$stm->execute();
			return $flag;
		}
		function delete_s_productevaluationinfo(){
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$SQL='DELETE from s_productevaluationinfo WHERE peId=?,pId=?,cId=?,peContent=?,peState=?,createTime,remark';
			$stm=$con->prepare($SQL);
			$stm->bind_param('iiisiss',$peId,$pId,$cId,$peContent,$peState,$createTime,$remark);
			$flag=$stm->execute();
			return $flag;
		}
		function delete_s_productimglist(){
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$SQL='DELETE from s_productimglist WHERE ImgId=?,ImgUrl=?,ProId=?,ImgOrder=?,ImgTitle=?';
			$stm=$con->prepare($SQL);
			$stm->bind_param('iiisiss',$peId,$pId,$cId,$peContent,$peState,$createTime,$remark);
			$flag=$stm->execute();
			return $flag;
		}
		function delete_s_productinfo(){
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$SQL='DELETE from s_productinfo WHERE pId=?,ptId=?,bId=?,psId=?,pName=?,pPrice=?,pAddr=?,pPhoto=?,pIntroduce=?,pWeight=?,pCount=?,pState=?,isHot=?,isNew=?,remark=?,createDate=?,cosPrice=?,marketPrice=?,VIPPrice=?,pScore=?';
			$stm=$con->prepare($SQL);
			$stm->bind_param('iiiisisssiiiiissiiis',$pId,$ptId,$bId,$psId,$pName,$pPrice,$pAddr,$pPhoto,$pIntroduce,$pWeight,$pCount,$pState,$isHot,$isNew,$remark,$createDate,$cosPrice,$marketPrice,$VIPPrice,$pScore);
			$flag=$stm->execute();
			return $flag;
		}
		function delete_s_productspecinfo(){
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$SQL='DELETE from s_productspecinfo WHERE psId=?,psName=?,order=?,psVal=?,remark=?,ptid=?';
			$stm=$con->prepare($SQL);
			$stm->bind_param('isissi',$psId,$psName,$order,$psVal,$remark,$ptid);
			$flag=$stm->execute();
			return $flag;
		}
		function delete_s_producttypeinfo(){
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$SQL='DELETE from s_producttypeinfo WHERE ptId=?,ptName=?,parentId=?,remark=?';
			$stm=$con->prepare($SQL);
			$stm->bind_param('isis',$ptId,$ptName,$parentId,$remark);
			$flag=$stm->execute();
			return $flag;
		}
		function delete_s_protypeattribute(){
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$SQL='DELETE from s_protypeattribute WHERE attId=?,typeId=?,attName=?';
			$stm=$con->prepare($SQL);
			$stm->bind_param('iis',$attId,$typeId,$attName);
			$flag=$stm->execute();
			return $flag;
		}
		function delete_s_receiveaddrinfo(){
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$SQL='DELETE from s_receiveaddrinfo WHERE raId=?,aId=?,raName=?,addr=?,phone=?,mobile=?,zipCode=?,isDefault=?,remark=?';
			$stm=$con->prepare($SQL);
			$stm->bind_param('iisssssis',$raId,$aId,$raName,$addr,$phone,$mobile,$zipCode,$isDefault,$remark);
			$flag=$stm->execute();
			return $flag;
		}
		function delete_s_refundinfo(){
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$SQL='DELETE from s_refundinfo WHERE rfId=?,oId=?,totalAmount=?,cId=?,operator=?,memo=?,createTime=?,remark=?';
			$stm=$con->prepare($SQL);
			$stm->bind_param('iiiissss',$rfId,$oId,$totalAmount,$cId,$operator,$memo,$createTime,$remark);
			$flag=$stm->execute();
			return $flag;
		}
		function delete_s_sendinfo(){
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$SQL='DELETE from s_sendinfo WHERE sId=?,oId=?,express=?,number=?,createTime=?,remark=?';
			$stm=$con->prepare($SQL);
			$stm->bind_param('iissss',$sId,$oId,$express,$number,$createTime,$remark);
			$flag=$stm->execute();
			return $flag;
		}
		function delete_s_userinfo(){
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$SQL='DELETE from s_userinfo WHERE uId?,uName=?,upwd=?,uType=?,uState=?,cerateTime=?,remark=?';
			$stm=$con->prepare($SQL);
			$stm->bind_param('issiiss',$uId,$uName,$upwd,$uType,$uState,$cerateTime,$remark);
			$flag=$stm->execute();
			return $flag;
		}
		
		
		//更新修改
		function update_s_addcustomer(){
			$aid=$s_addcustomer->Aid;
			$cid=$s_addcustomer->cid;
			$AddCustomer=$s_addcustomer->AddCustomer;
			$isDef=$s_addcustomer->isDef;
			//获取连接对象
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$SQL='update s_addcustomer set Aid=?,cid=?,AddCustomer=?,isDef=?';
			$stm=$con->prepare($SQL);
			$stm->bind_param('iisi',$Aid,$cid,$AddCustomer,$isDef);
			$flag=$stm->execute();
			return $flag;
	}
		function update_s_areainfo(){
			$aId=$s_areainfo->aId;
			$aName=$s_areainfo->aName;
			$parentId=$s_areainfo->parentId;
			$remark=$s_areainfo->remark;
					
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$SQL='update s_areainfo set aId=?,aName=?,parentId=?,remark=?';
			$stm=$con->prepare($SQL);
			$stm->bind_param('isis',$aId,$aName,$parentId,$remark);
			$flag=$stm->execute();
			return $flag;
	}
		function update_s_articleinfo(){
			$ArId=$s_articleinfo->ArId;
			$ArTitle=$s_articleinfo->ArTitle;
			$ArContent=$s_articleinfo->ArContent;
			$AtId=$s_articleinfo->AtId;
			$AtAuthor=$s_articleinfo->AtAuthor;
			$States=$s_articleinfo->States;
			$isTop=$s_articleinfo->isTop;
			$ArMark=$s_articleinfo->ArMark;
			$CrTime=$s_articleinfo->CrTime;
			
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$SQL='update s_articleinfo set ArId=?,ArTitle=?,ArContent=?,AtId=?,AtAuthor=?,States=?,isTop=?,ArMark=?,CrTime=?';
			$stm=$con->prepare($SQL);
			$stm->bind_param('issisiiis',$ArId,$ArTitle,$ArContent,$AtId,$AtAuthor,$States,$isTop,$ArMark,$CrTime);
			$flag=$stm->execute();
			return $flag;
		}
		function update_s_articletype(){
			$AtId=$s_articletype->AtId;
			$ArName=$s_articletype->ArName;
			$AtTitle=$s_articletype->AtTitle;
			$AtImp=$s_articletype->AtImp;
			$AtRemark=$s_articletype->AtRemark;
			$Atorder=$s_articletype->Atorder;
			
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$SQL='update s_articletype set AtId=?,ArName=?,AtTitle=?,AtImp=?,AtRemark=?,Atorder=?';
			$stm=$con->prepare($SQL);
			$stm->bind_param('issssi',$AtId,$ArName,$AtTitle,$AtImp,$AtRemark,$Atorder);
			$flag=$stm->execute();
			return $flag;
		}
		function update_s_brandinfo(){
			$bId=$s_brandinfo->bId;
			$ptId=$s_brandinfo->ptId;
			$bName=$s_brandinfo->bName;
			$bLong=$s_brandinfo->bLong;
			$bIntroduce=$s_brandinfo->bIntroduce;
			$bUrl=$s_brandinfo->bUrl;
			$remark=$s_brandinfo->remark;
			
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$SQL='update s_brandinfo set bId=?,ptId=?,bName=?,bLong=?,bIntroduce=?,bUrl=?,remark=?';
			$stm=$con->prepare($SQL);
			$stm->bind_param('iisssss',$bId,$ptId,$bName,$bLong,$bIntroduce,$bUrl,$remark);
			$flag=$stm->execute();
			return $flag;
		}
		function update_s_cancelinfo(){
			$cId=$s_cancelinfo->cId;
			$oId=$s_cancelinfo->oId;
			$cState=$s_cancelinfo->cState;
			$cState=$s_cancelinfo->cMemo;
			$createTime=$s_cancelinfo->createTime;
			$remark=$s_cancelinfo->remark;
			
            $DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$SQL='update s_cancelinfo set cId=?,oId=?,cState=?,cMemo=?,createTime=?,remark=?';
			$stm=$con->prepare($SQL);
			$stm->bind_param('iiisss',$cId,$oId,$cState,$cMemo,$createTime,$remark);
			$flag=$stm->execute();
			return $flag;
		}
		function update_s_customergradeinfo(){
			$cgId=$s_customergradeinfo->cgId;
			$cgName=$s_customergradeinfo->cgName;
			$cgIntroduce=$s_customergradeinfo->cgIntronduce;
			$remark=$s_customergradeinfo->remark;
			$ShoMoney=$s_customergradeinfo->ShoMoney;
			$OffNum=$s_customergradeinfo->OffNum;
			$isDef=$s_customergradeinfo->isDef;
			
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$SQL='update s_customergradeinfo set cgId=?,cgName=?,cgIntronduce=?,remark=?,ShoMoney=?,OffNum=?,isDef=?';
			$stm=$con->prepare($SQL);
			$stm->bind_param('isssiii',$cgId,$cgName,$cgIntronduce,$remark,$ShoMoney,$OffNum,$isDef);
			$flag=$stm->execute();
			return $flag;
		}
		function update_s_customerinfo(){
			$cId=$s_customerinfo->cId;
			$cgId=$s_customerinfo->cgId;
			$cName=$s_customerinfo->cName;
			$cPwd=$s_customerinfo->cPwd;
			$cEmail=$s_customerinfo->cEmail;
			$cSex=$s_customerinfo->cSex;
			$cBirth=$s_customerinfo->cBrith;
			$aId=$s_customerinfo->aId;
			$createTime=$s_customerinfo->createTime;
			$remark=$s_customerinfo->remark;
			$cState=$s_customerinfo->cState;
			$trueName=$s_customerinfo->trueName;
			$cellPhone=$s_customerinfo->cellPhone;
			$telPhone=$s_customerinfo->telPhone;
			$nickName=$s_customerinfo->nickName;
			
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$SQL='update s_customerinfo set cId=?,cgId=?,cName=?,cPwd=?,cEmail=?,cSex=?,cBrith=?,aId=?,aId=?,createTime=?,remark=?,cState=?,trueName=?,cellPhone=?,telPhone=?,nickName=?';
			$stm=$con->prepare($SQL);
			$stm->bind_param('iisssssississs',$cId,$cgId,$cName,$cPwd,$cEmail,$cSex,$cBrith,$aId,$createTime,$remark,$cState,$trueName,$cellPhone,$telPhone,$nickName);
			$flag=$stm->execute();
			return $flag;
		}
		function update_s_expresstypeinfo(){
			$etId=$s_expresstypeinfo->etId;
			$etName=$s_expresstypeinfo->etName;
			$fWeight=$s_expresstypeinfo->Fweight;
			$fPrice=$s_expresstypeinfo->fPrice;
			$cWeight=$s_expresstypeinfo->cWeight;
			$etIntroduce=$s_expresstypeinfo->etIntroduce;
			$remark=$s_expresstypeinfo->remark;
			
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$SQL='update s_expresstypeinfo set etId=?,etName=?,Fweight=?,fPrice=?,cWeight=?,etIntroduce=?,remark=?';
			$stm=$con->prepare($SQL);
			$stm->bind_param('isiiiiss',$etId,$etName,$Fweight,$fPrice,$cWeight,$etIntroduce,$remark);
			$flag=$stm->execute();
			return $flag;
		}
		function update_s_friendshipinfo(){
			$fr_Id=$s_friendshipinfo->fr_Id;
			$fr_Name=$s_friendshipinfo->fr_Name;
			$fr_logo=$s_friendshipinfo->fr_logo;
			$fr_url=$s_friendshipinfo->fr_url;
			$fr_orer=$s_friendshipinfo->fr_order;
			$fr_createDate=$s_friendshipinfo->fr_createDate;
			
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$SQL='update s_friendshipinfo set fr_Id=?,fr_Name=?,fr_logo=?,fr_url=?,fr_order=?,fr_createDate=?';
			$stm=$con->prepare($SQL);
			$stm->bind_param('isssis',$fr_Id,$fr_Name,$fr_logo,$fr_url,$fr_order,$fr_createDate);
			$flag=$stm->execute();
			return $flag;	
		}
		function update_s_gatheringinfo(){
			$gId=$s_gatheringinfo->gId;
			$cId=$s_gatheringinfo->cId;
			$oId=$s_gatheringinfo->oId;
			$gMoney=$s_gatheringinfo->gMoney;
			$memo=$s_gatheringinfo->memo;
			$createTime=$s_gatheringinfo->createTime;
			$remark=$s_gatheringinfo->remark;
			
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$SQL='update s_gatheringinfo set gId=?,cId=?,oId=?,gMoney=?,memo=?,createTime=?,remark=?';
			$stm=$con->prepare($SQL);
			$stm->bind_param('iiiisss',$gId,$cId,$oId,$gMoney,$memo,$createTime,$remark);
			$flag=$stm->execute();
			return $flag;	
		}
		function update_s_navigationinfo(){
			$nId=$s_navigationinfo->nId;
			$nName=$s_navigationinfo->nName;
			$nUrl=$s_navigationinfo->nUrl;
			$nPosition=$s_navigationinfo->nPosition;
			$nIsNew=$s_navigationinfo->nIsNew;
			$orders=$s_navigationinfo->orders;
			
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$SQL='update s_navigationinfo set nId=?,nName=?,nUrl=?,nPosition=?,nIsNew=?,orders=?';
			$stm=$con->prepare($SQL);
			$stm->bind_param('issiii',$nId,$nName,$nUrl,$nPosition,$nIsNew,$orders);
			$flag=$stm->execute();
			return $flag;	
		}
		function update_s_noticeinfo(){
			$nId=$s_noticeinfo->nId;
			$uId=$s_noticeinfo->uId;
			$nTitle=$s_noticeinfo->nTitle;
			$nContent=$s_noticeinfo->nContent;
			$createTime=$s_noticeinfo->createTime;
			$remark=$s_noticeinfo->remark;
			
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$SQL='update s_navigationinfo set nId=?,uId=?,nTitle=?,nContent=?,createTime=?,remark=?';
			$stm=$con->prepare($SQL);
			$stm->bind_param('iissss',$nId,$uId,$nTitle,$nContent,$createTime,$remark);
			$flag=$stm->execute();
			return $flag;
		}
		function update_s_orderinfo(){
			$oId=$s_orderinfo->oId;
			$etId=$s_orderinfo->etId;
			$aId=$s_orderinfo->aId;
			$cId=$s_orderinfo->cId;
			$ptId=$s_orderinfo->ptId;
			$pId=$s_orderinfo->pId;
			$eFee=$s_orderinfo->eFee;
			$paFee=$s_orderinfo->paFee;
			$totalAmount=$s_orderinfo->totalAmount;
			$pSum=$s_orderinfo->pSum;
			$msg=$s_orderinfo->msg;
			$oState=$s_orderinfo->oState;
			$createTime=$s_orderinfo->createTime;
			$remark=$s_orderinfo->remark;
			
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$SQL='update s_orderinfo set oId=?,etId=?,aId=?,cId=?,ptId=?,pId=?,eFee=?,paFee=?,totalAmount=?,pSum=?,msg=?,oState=?,createTime=?,remark=?';
			$stm=$con->prepare($SQL);
			$stm->bind_param('iiiiiiiiiisiss',$oId,$etId,$aId,$cId,$ptId,$pId,$eFee,$paFee,$totalAmount,$pSum,$msg,$oState,$createTime,$remark);
			$flag=$stm->execute();
			return $flag;
		}
		function update_s_paytypeinfo(){
			$ptId=$s_paytypeinfo->ptId;
			$ptName=$s_paytypeinfo->ptName;
			$ptType=$s_paytypeinfo->ptType;
			$ptLog=$s_paytypeinfo->ptLog;
			$ptIntroduce=$s_paytypeinfo->ptIntroduce;
			$remark=$s_paytypeinfo->remark;
			
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$SQL='update s_paytypeinfo set ptId=?,ptName=?,ptType=?,ptLog=?,ptIntroduce=?,remark=?';
			$stm=$con->prepare($SQL);
			$stm->bind_param('isisss',$ptId,$ptName,$ptType,$ptLog,$ptIntroduce,$remark);
			$flag=$stm->execute();
			return $flag;
		}
		function update_s_position(){
			$pid=$s_position->pid;
			$pName=$s_position->pName;
			
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$SQL='update s_position set pid=?,pName=?';
			$stm=$con->prepare($SQL);
			$stm->bind_param('is',$pid,$pName);
			$flag=$stm->execute();
			return $flag;
		}
		function update_s_proattvalue(){
			$PAId=$s_proattvalue->PAId;
			$proId=$s_proattvalue->proId;
			$AttValue=$s_proattvalue->AttValue;
			$ProRemark=$s_proattvalue->ProRemark;
			$attId=$s_proattvalue->attId;
			
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$SQL='update s_proattvalue set PAId=?,proId=?,AttValue=?,ProRemark=?,attId=?';
			$stm=$con->prepare($SQL);
			$stm->bind_param('iissi',$PAId,$proId,$AttValue,$ProRemark,$attId);
			$flag=$stm->execute();
			return $flag;
		}
		function update_s_productevaluationinfo(){
			$peId=$s_productevaluationinfo->peId;
			$pId=$s_productevaluationinfo->pId;
			$cId=$s_productevaluationinfo->cId;
			$peContent=$s_productevaluationinfo->peContent;
			$peState=$s_productevaluationinfo->peState;
			$createTime=$s_productevaluationinfo->createTime;
			$remark=$s_productevaluationinfo->remark;
			
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$SQL='update s_productevaluationinfo set peId=?,pId=?,cId=?,peContent=?,peState=?,createTime,remark';
			$stm=$con->prepare($SQL);
			$stm->bind_param('iiisiss',$peId,$pId,$cId,$peContent,$peState,$createTime,$remark);
			$flag=$stm->execute();
			return $flag;
		}
		function update_s_productimglist(){
			$ImgId=$s_productimglist->ImgId;
			$ImgUrl=$s_productimglist->ImgUrl;
			$ProId=$s_productimglist->ProId;
			$ImgOrder=$s_productimglist->ImgOrder;
			$ImgTitle=$s_productimglist->ImgTitle;
			
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$SQL='update s_productimglist set ImgId=?,ImgUrl=?,ProId=?,ImgOrder=?,ImgTitle=?';
			$stm=$con->prepare($SQL);
			$stm->bind_param('isiis',$ImgId,$ImgUrl,$ProId,$ImgOrder,$ImgTitle);
			$flag=$stm->execute();
			return $flag;
		}
		function update_s_productinfo(){
			$pId=$s_productinfo->pId;
			$ptId=$s_productinfo->ptId;
			$bId=$s_productinfo->bId;
			$psId=$s_productinfo->psId;
			$pName=$s_productinfo->pName;
			$pPrice=$s_productinfo->pPrice;
			$pAddr=$s_productinfo->pAddr;
			$pPhoto=$s_productinfo->pPhoto;
			$pIntroduce=$s_productinfo->pIntroduce;
			$pWeight=$s_productinfo->pWeight;
			$pCount=$s_productinfo->pCount;
			$pState=$s_productinfo->pState;
			$idHot=$s_productinfo->isHot;
			$isNew=$s_productinfo->isNew;
			$remark=$s_productinfo->remark;
			$createDate=$s_productinfo->createDate;
			$cosPrice=$s_productinfo->cosPrice;
			$marketPrice=$s_productinfo->marketPrice;
			$VIPPrice=$s_productinfo->VIPPrice;
			$pScore=$s_productinfo->pScore;
			
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$SQL='update s_productinfo set pId=?,ptId=?,bId=?,psId=?,pName=?,pPrice=?,pAddr=?,pPhoto=?,pIntroduce=?,pWeight=?,pCount=?,pState=?,isHot=?,isNew=?,remark=?,createDate=?,cosPrice=?,marketPrice=?,VIPPrice=?,pScore=?';
			$stm=$con->prepare($SQL);
			$stm->bind_param('iiiisisssiiiiissiiis',$pId,$ptId,$bId,$psId,$pName,$pPrice,$pAddr,$pPhoto,$pIntroduce,$pWeight,$pCount,$pState,$isHot,$isNew,$remark,$createDate,$cosPrice,$marketPrice,$VIPPrice,$pScore);
			$flag=$stm->execute();
			return $flag;
		}
		function update_s_productspecinfo(){
			$psId=$s_productspecinfo->psId;
			$psName=$s_productspecinfo->psName;
			$order=$s_productspecinfo->order;
			$psVal=$s_productspecinfo->psVal;
			$remark=$s_productspecinfo->remark;
			$ptid=$s_productspecinfo->ptid;
			
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$SQL='update s_productspecinfo set psId=?,psName=?,order=?,psVal=?,remark=?,ptid=?';
			$stm=$con->prepare($SQL);
			$stm->bind_param('isissi',$psId,$psName,$order,$psVal,$remark,$ptid);
			$flag=$stm->execute();
			return $flag;
			
		}
		function update_s_producttypeinfo(){
			$ptId=$s_producttypeinfo->ptId;
			$ptName=$s_producttypeinfo->ptName;
			$parentId=$s_producttypeinfo->parentId;
			$remark=$s_producttypeinfo->remark;
			
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$SQL='update s_producttypeinfo set ptId=?,ptName=?,parentId=?,remark=?';
			$stm=$con->prepare($SQL);
			$stm->bind_param('isis',$ptId,$ptName,$parentId,$remark);
			$flag=$stm->execute();
			return $flag;
		}
		function update_s_protypeattribute(){
			$attId=$s_protypeattribute->attId;
			$typeId=$s_protypeattribute->typeId;
			$attName=$s_protypeattribute->attName;
			
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$SQL='update s_protypeattribute set attId=?,typeId=?,attName=?';
			$stm=$con->prepare($SQL);
			$stm->bind_param('iis',$attId,$typeId,$attName);
			$flag=$stm->execute();
			return $flag;
		}
		function update_s_receiveaddrinfo(){
			$raId=$s_receiveaddrinfo->raId;
			$aId=$s_receiveaddrinfo->aId;
			$raName=$s_receiveaddrinfo->raName;
			$addr=$s_receiveaddrinfo->addr;
			$phone=$s_receiveaddrinfo->phone;
			$mobile=$s_receiveaddrinfo->mobile;
			$zipCode=$s_receiveaddrinfo->zipCode;
			$isDefault=$s_receiveaddrinfo->isDefault;
			$remark=$s_receiveaddrinfo->remark;
			
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$SQL='update s_receiveaddrinfo set raId=?,aId=?,raName=?,addr=?,phone=?,mobile=?,zipCode=?,isDefault=?,remark=?';
			$stm=$con->prepare($SQL);
			$stm->bind_param('iisssssis',$raId,$aId,$raName,$addr,$phone,$mobile,$zipCode,$isDefault,$remark);
			$flag=$stm->execute();
			return $flag;
			
		}
		function update_s_refundinfo(){
			$rfId=$s_refundinfo->rfId;
			$oId=$s_refundinfo->oId;
			$totalAmount=$s_refundinfo->totalAmount;
			$cId=$s_refundinfo->cId;
			$operator=$s_refundinfo->operator;
			$memo=$s_refundinfo->memo;
			$createTime=$s_refundinfo->createTime;
			$remark=$s_refundinfo->remark;
			
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$SQL='update s_refundinfo set rfId=?,oId=?,totalAmount=?,cId=?,operator=?,memo=?,createTime=?,remark=?';
			$stm=$con->prepare($SQL);
			$stm->bind_param('iiiissss',$rfId,$oId,$totalAmount,$cId,$operator,$memo,$createTime,$remark);
			$flag=$stm->execute();
			return $flag;
		}
		function update_s_sendinfo(){
			$sId=$s_sendinfo->sId;
			$oId=$s_sendinfo->oId;
			$express=$s_sendinfo->express;
			$number=$s_sendinfo->number;
			$createTime=$s_sendinfo->createTime;
			$remark=$s_sendinfo->remark;
			
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$SQL='update s_sendinfo set sId=?,oId=?,express=?,number=?,createTime=?,remark=?';
			$stm=$con->prepare($SQL);
			$stm->bind_param('iissss',$sId,$oId,$express,$number,$createTime,$remark);
			$flag=$stm->execute();
			return $flag;
		}
		function update_s_userinfo(){
			$uId=$s_userinfo->uId;
			$uName=$s_userinfo->uName;
			$uPwd=$s_userinfo->upwd;
			$uType=$s_userinfo->uType;
			$uState=$s_userinfo->uState;
			$createTime=$s_userinfo->cerateTime;
			$remark=$s_userinfo->remark;
			
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$SQL='update s_userinfo set uId?,uName=?,upwd=?,uType=?,uState=?,cerateTime=?,remark=?';
			$stm=$con->prepare($SQL);
			$stm->bind_param('issiiss',$uId,$uName,$upwd,$uType,$uState,$cerateTime,$remark);
			$flag=$stm->execute();
			return $flag;
		}
		
		 function query_s_addcustomer($s_addcustomer){
		 	$Aid=$s_addcustomer->Aid;
			$cid=$s_addcustomer->cid;
			$AddCustomer=$s_addcustomer->AddCustomer;
			$isDef=$s_addcustomer->isDef;
			
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$sql='INSERT INTO s_addcustomer(Aid,cid,AddCustomer,isDef) VALUE(?,?,?,?)';
			$stm->bind_param('iisi',$Aid,$cid,$AddCustomer,$isDef);
			$flag=$stm->execute();
			return $flag;
		 }
		 function query_s_areainfo($s_areainfo){
		 	$aId=$s_areainfo->aId;
			$aName=$s_areainfo->aName;
			$parentId=$s_areainfo->parentId;
			$remark=$s_areainfo->remark;
			
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$sql='INSERT INTO s_areainfo(aId,aName,parentId,remark) VALUE(?,?,?,?)';
			$stm->bind_param('isis',$aId,$aName,$parentId,$remark);
			$flag=$stm->execute();
			return $flag;
		 }
//		 function query_s_areainfo($s_areainfo){
//		 	$ArId=$s_areainfo->ArId;
//			$ArTitle=$s_areainfo->ArTitle;
//			$ArContent=$s_areainfo->ArContent;
//			$AtId=$s_areainfo->AtId;
//			$AtAuthor=$s_areainfo->AtAuthor;
//			$States=$s_areainfo->States;
//			$isTop=$s_areainfo->isTop;
//			$ArMark=$s_areainfo->ArMark;
//			$CrTime=$s_areainfo->CrTime;
//			
//			$DBUtil=new DBUtil();
//			$con=$DBUtil->getCon();
//			$sql='INSERT INTO s_areainfo(ArId,ArTitle,ArContent,AtId,AtAuthor,States,isTop,ArMark,CrTime) VALUE(?,?,?,?,?,?,?,?,?)';
//			$stm->bind_param('issisiiis',$ArId,$ArTitle,$ArContent,$AtId,$AtAuthor,$States,$isTop,$ArMark,$CrTime);
//			$flag=$stm->execute();
//			return $flag;
//		 }
//		 function query_s_articletype($s_articletype){
//		 	$AtId=$s_articletype->AtId;
//			$ArName=$s_articletype->ArName;
//			$AtTitle=$s_articletype->AtTitle;
//			$AtImp=$s_articletype->AtImp;
//			$AtRemark=$s_articletype->AtRemark;
//			$Atorder=$s_articletype->Atorder;
//			
//			$DBUtil=new DBUtil();
//			$con=$DBUtil->getCon();
//			$sql='INSERT INTO s_articletype(AtId,ArName,AtTitle,AtImp,AtRemark,Atorder) VALUE(?,?,?,?,?,?)';
//			$stm->bind_param('issssi',$AtId,$ArName,$AtTitle,$AtImp,$AtRemark,$Atorder);
//			$flag=$stm->execute();
//			return $flag;
//		 }
		 
		 function query_s_brandinfo($s_brandinfo){
		 	$bId=$s_brandinfo->bId;
			$ptId=$s_brandinfo->ptId;
			$bName=$s_brandinfo->bName;
			$bLog=$s_brandinfo->bLog;
			$bIntroduce=$s_brandinfo->bIntroduce;
			$bUrl=$s_brandinfo->bUrl;
			$remark=$s_brandinfo->remark;
			
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$sql='INSERT INTO s_brandinfo(bId,ptId,bName,bLog,bIntroduce,bUrl,remark) VALUE(?,?,?,?,?,?,?)';
			$stm->bind_param('iisssss',$bId,$ptId,$bName,$bLog,$bIntroduce,$bUrl,$remark);
			$flag=$stm->execute();
			return $flag;
		 }
		  function query_s_cancelinfo($s_cancelinfo){
		 	$cId=$s_cancelinfo->cId;
			$oId=$s_cancelinfo->oId;
			$cState=$s_cancelinfo->cState;
			$cMemo=$s_cancelinfo->cMemo;
			$createTime=$s_cancelinfo->createTime;
			$remark=$s_cancelinfo->remark;
			
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$sql='INSERT INTO s_areainfo(oId,ctId,cState,cMemo,createTime,remark) VALUE(?,?,?,?,?,?)';
			$stm->bind_param('iiisss',$oId,$ctId,$cState,$cMemo,$createTime,$remark);
			$flag=$stm->execute();
			return $flag;
		 }
		  
		  function query_s_customergradeinfo($s_customergradeinfo){
		 	$cgId=$s_customergradeinfo->cgId;
			$cgName=$s_customergradeinfo->cgName;
			$cgIntroduce=$s_customergradeinfo->cgIntroduce;
			$remark=$s_customergradeinfo->remark;
			$ShoMoney=$s_customergradeinfo->ShoMoney;
			$OffNum=$s_customergradeinfo->OffNum;
			$isDef=$s_customergradeinfo->isDef;
			
			
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$sql='INSERT INTO s_customergradeinfo(cgId,cgName,cgIntroduce,remark,ShoMoney,OffNum,isDef) VALUE(?,?,?,?,?,?,?)';
			$stm->bind_param('issssii',$cgId,$cgName,$cgIntroduce,$remark,$ShoMoney,$OffNum,$isDef);
			$flag=$stm->execute();
			return $flag;
		 }
		    function query_s_customerinfo($s_customerinfo){
		 	$cId=$s_customerinfo->cId;
			$cgId=$s_customerinfo->cgId;
			$cName=$s_customerinfo->cName;
			$cPwd=$s_customerinfo->cPwd;
			$cEmail=$s_customerinfo->cEmail;
			$cSex=$s_customerinfo->cSex;
			$cBirth=$s_customerinfo->cBirth;
			$aId=$s_customerinfo->aId;
			$createTime=$s_customerinfo->createTime;
			$remark=$s_customerinfo->remark;
			$cState=$s_customerinfo->cState;
			$trueName=$s_customerinfo->trueName;
			$cellPhone=$s_customerinfo->cellPhone;
			$tellPhone=$s_customerinfo->tellPhone;
			$nickName=$s_customerinfo->nickName;
			
			
			
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$sql='INSERT INTO s_customerinfo(cId,cgId,cName,cPwd,cEmail,cSex,cBirth,aId,createTime,remark,cState,trueName,cellPhone,tellPhone,nickName) VALUE(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
			$stm->bind_param('iisssssississss',$cId,$cgId,$cName,$cPwd,$cEmail,$cSex,$cBirth,$aId,$createTime,$remark,$cState,$trueName,$cellPhone,$tellPhone,$nickName);
			$flag=$stm->execute();
			return $flag;
		 }
		
//		  function query_s_customergradeinfo($s_customergradeinfo){
//		 	$etId=$s_customergradeinfo->etId;
//			$etName=$s_customergradeinfo->cgName;
//			$fWeight=$s_customergradeinfo->fWeight;
//			$fPrice=$s_customergradeinfo->fPrice;
//			$cWeight=$s_customergradeinfo->cWeight;
//			$cPrice=$s_customergradeinfo->cPrice;
//			$etIntroduce=$s_customergradeinfo->etIntroduce;
//			$remark=$s_customergradeinfo->remark;
//			
//			
//			$DBUtil=new DBUtil();
//			$con=$DBUtil->getCon();
//			$sql='INSERT INTO s_customergradeinfo(etId,etName,fWeight,fPrice,cWeight,cPrice,etIntroduce,remark) VALUE(?,?,?,?,?,?,?,?)';
//			$stm->bind_param('isssssss',$etId,$etName,$fWeight,$fPrice,$cWeight,$cPrice,$etIntroduce,$remark);
//			$flag=$stm->execute();
//			return $flag;
//		 }
		  function query_s_friendshipinfo($s_friendshipinfo){
		 	$fr_Id=$s_friendshipinfo->fr_Id;
			$fr_Name=$s_friendshipinfo->fr_Name;
			$fr_logo=$s_friendshipinfo->fr_logo;
			$fr_url=$s_friendshipinfo->fr_url;
			$fr_order=$s_friendshipinfo->fr_order;
			$fr_createDate=$s_friendshipinfo->fr_createDate;
			
			
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$sql='INSERT INTO s_friendshipinfo(fr_Id,fr_Name,fr_logo,fr_url,fr_order,fr_createDate) VALUE(?,?,?,?,?,?)';
			$stm->bind_param('isssis',$fr_Name,$fr_logo,$fr_url,$fr_order,$fr_createDate);
			$flag=$stm->execute();
			return $flag;
			
			
		 }
		  function query_s_gatheringinfo($s_gatheringinfo){
		 	$gId=$s_gatheringinfo->gId;
			$cId=$s_gatheringinfo->cId;
			$oId=$s_gatheringinfo->oId;
			$gMoney=$s_gatheringinfo->gMoney;
			$memo=$s_gatheringinfo->memo;
			$createTime=$s_gatheringinfo->createTime;
			$remark=$s_gatheringinfo->remark;
			
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$sql='INSERT INTO s_gatheringinfo(gId,cId,oId,gMoney,memo,createTime,remark) VALUE(?,?,?,?,?,?,?)';
			$stm->bind_param('iiissss',$gId,$cId,$oId,$gMoney,$memo,$createTime,$remark);
			$flag=$stm->execute();
			return $flag;
			
			
		 }
		  
//		  function query_s_navigationinfo($s_navigationinfo){
//		 	$nId=$s_navigationinfo->nId;
//			$nUrl=$s_navigationinfo->nUrl;
//			$nName=$s_navigationinfo->nName;
//			$nPosition=$s_navigationinfo->nPosition;
//			$nIsNew=$s_navigationinfo->nIsNew;
//			$orders=$s_navigationinfo->orders;
//				
//			$DBUtil=new DBUtil();
//			$con=$DBUtil->getCon();
//			$sql='INSERT INTO s_navigationinfo(nId,nUrl,nName,nPosition,nIsNew,orders) VALUE(?,?,?,?,?,?)';
//			$stm->bind_param('issiii',$nId,$nUrl,$nName,$nPosition,$nIsNew,$orders);
//			$flag=$stm->execute();
//			return $flag;
//			
//			
//		 }
		  
		    function query_s_noticeinfo($s_noticeinfo){
		 	$nId=$s_noticeinfo->gId;
			$uId=$s_noticeinfo->cId;
			$nTitle=$s_noticeinfo->oId;
			$nContent=$s_noticeinfo->gMoney;
			$createTime=$s_noticeinfo->createTime;
			$remark=$s_noticeinfo->remark;
			
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$sql='INSERT INTO s_noticeinfo(nId,uId,nTitle,nContent,createTime,remark) VALUE(?,?,?,?,?,?)';
			$stm->bind_param('iissss',$nId,$uId,$nTitle,$nContent,$createTime,$remark);
			$flag=$stm->execute();
			return $flag;
			
			
		 }
			function query_s_orderinfo($s_orderinfo){
		 	$oId=$s_orderinfo->oId;
			$etId=$s_orderinfo->etId;
			$aId=$s_orderinfo->aId;
			$cId=$s_orderinfo->cId;
			$ptId=$s_orderinfo->ptId;
			$pId=$s_orderinfo->pId;
			$eFee=$s_orderinfo->eFee;
			$paFee=$s_orderinfo->paFee;
			$totalAmount=$s_orderinfo->total;
			$pSum=$s_orderinfo->pSum;
			$msg=$s_orderinfo->msg;
			$oState=$s_orderinfo->oState;
			$createTime=$s_orderinfo->createTime;
			$remark=$s_orderinfo->remark;
			
		
			
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$sql='INSERT INTO s_orderinfo(oId,etId,aId,cId,ptId,pId,eFee,paFee,totalAmount,pSum,msg,oState,createTime,remark) VALUE(?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
			$stm->bind_param('iiiiiisssisiss',$oId,$etId,$aId,$cId,$ptId,$pId,$eFee,$paFee,$totalAmount,$pSum,$msg,$oState,$createTime,$remark);
			$flag=$stm->execute();
			return $flag;
			
			
		 }
		    function query_s_paytypeinfo($s_paytypeinfo){
		 	$ptId=$s_paytypeinfo->ptId;
			$ptName=$s_paytypeinfo->ptName;
			$ptType=$s_paytypeinfo->ptType;
			$ptLog=$s_paytypeinfo->ptLog;
			$ptIntroduce=$s_paytypeinfo->ptIntroduce;
			$remark=$s_paytypeinfo->remark;
			
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$sql='INSERT INTO s_paytypeinfo(ptId,ptName,ptType,ptLog,ptIntroduce,remark) VALUE(?,?,?,?,?,?)';
			$stm->bind_param('isisss',$ptId,$ptName,$ptType,$ptLog,$ptIntroduce,$remark);
			$flag=$stm->execute();
			return $flag;
			
			
		 }
		    function query_s_position($s_position){
		 	$pid=$s_position->pid;
			$pName=$s_position->pName;
			
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$sql='INSERT INTO s_position(pid,pName,) VALUE(?,?)';
			$stm->bind_param('is',$pid,$pName);
			$flag=$stm->execute();
			return $flag;
			
			
			
		 }
		   
		   function query_s_proattvalue($s_proattvalue){
		 	$PAId=$s_proattvalue->PAId;
			$proId=$s_proattvalue->proId;
			$AttValue=$s_proattvalue->AttValue;
			$ProRemark=$s_proattvalue->ProRemark;
			$attId=$s_proattvalue->attId;
			
			
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$sql='INSERT INTO s_proattvalue(PAId,proId,AttValue,ProRemark,attId) VALUE(?,?,?,?,?)';
			$stm->bind_param('iissi',$PAId,$proId,$AttValue,$ProRemark,$attId);
			$flag=$stm->execute();
			return $flag;
			
			
			
		 }
		    function query_s_productevaluationinfo($s_productevaluationinfo){
		 	$peId=$s_productevaluationinfo->peId;
			$pId=$s_productevaluationinfo->pId;
			$cId=$s_productevaluationinfo->cId;
			$peContent=$s_productevaluationinfo->peContent;
			$peState=$s_productevaluationinfo->peState;
			$createTime=$s_productevaluationinfo->createTime;
			$remark=$s_productevaluationinfo->remark;
			
			
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$sql='INSERT INTO s_productevaluationinfo(peId,pId,cId,peContent,peState,createTime,remark) VALUE(?,?,?,?,?,?,?)';
			$stm->bind_param('iiisiss',$peId,$pId,$cId,$peContent,$peState,$createTime,$remark);
			$flag=$stm->execute();
			return $flag;
		 }
			function query_s_productimglist($s_productimglist){
		 	$ImgId=$s_productimglist->ImgId;
		    $ImgUrl=$s_productimglist->ImgUrl;
			$ProId=$s_productimglist->ProId;
			$ImgOrder=$s_productimglist->ImgOrder;
			$ImgTitle=$s_productimglist->ImgTitle; 
			
			
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$sql='INSERT INTO s_productimglist(ImgId,ImgUrl,ProId,ImgOrder,ImgTitle) VALUE(?,?,?,?,?)';
			$stm->bind_param('isiis',$ImgId,$ImgUrl,$ProId,$ImgOrder,$ImgTitle);
			$flag=$stm->execute();
			return $flag;
		 } 
//			function query_s_productinfo($s_productinfo){
//		 	$pId=$s_productinfo->pId;
//			$ptId=$s_productinfo->ptId;
//			$bId=$s_productinfo->bId;
//			$psId=$s_productinfo->psId;
//			$pName=$s_productinfo->pName;
//			$pPrice=$s_productinfo->pPrice;
//			$pAddr=$s_productinfo->pAddr;
//			$pPhoto=$s_productinfo->pPhoto;
//			$pIntroduce=$s_productinfo->pIntroduce;
//			$pWeight=$s_productinfo->pWeight;
//			$pCount=$s_productinfo->pCount;
//			$pState=$s_productinfo->pState;
//			$isHot=$s_productinfo->isHot;
//			$isNew=$s_productinfo->isNew;
//			$remark=$s_productinfo->remark;
//			$createDate=$s_productinfo->createDate;
//			$costPrice=$s_productinfo->costPrice;
//			$marketPrice=$s_productinfo->marketPrice;
//			$VIPPrice=$s_productinfo->VIPPrice;
//			$pScore=$s_productinfo->pScore;
//			
//			
//			
//			$DBUtil=new DBUtil();
//			$con=$DBUtil->getCon();
//			$sql='INSERT INTO s_productinfo(pId,ptId,bId,psId,pName,pPrice,pAddr,pPhoto,pIntroduce,pWeight,pCount,pState,isHot,isNew,remark,createDate,costPrice,marketPrice,VIPPrice,pScore) VALUE(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
//			$stm->bind_param('iiiisissssiiiisssssi',$pId,$ptId,$bId,$psId,$pName,$pPrice,$pAddr,$pPhoto,$pIntroduce,$pWeight,$pCount,$pState,$isHot,$isNew,$remark,$createDate,$costPrice,$marketPrice,$VIPPrice,$pScore);
//			$flag=$stm->execute();
//			return $flag;
//		 }  
		    function query_s_productspecinfo($s_productspecinfo){
		 	$psId=$s_productspecinfo->psId;
			$psName=$s_productspecinfo->psName;
			$order=$s_productspecinfo->order;
			$psVal=$s_productspecinfo->psVal;
			$remark=$s_productspecinfo->remark;
			$ptid=$s_productspecinfo->ptid;
			
			
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$sql='INSERT INTO s_productspecinfo(psId,psName,order,psVal,remark,ptid) VALUE(?,?,?,?,?,?)';
			$stm->bind_param('isissi',$psId,$psName,$order,$psVal,$remark,$ptid);
			$flag=$stm->execute();
			return $flag;
		 }
			function query_s_producttypeinfo($s_producttypeinfo){
		 	$ptId=$s_producttypeinfo->ptId;
			$ptName=$s_producttypeinfo->ptName;
			$parentId=$s_producttypeinfo->parentId;
			$remark=$s_producttypeinfo->remark;
			
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$sql='INSERT INTO s_producttypeinfo(ptId,ptName,parentId,remark) VALUE(?,?,?,?)';
			$stm->bind_param('isis',$psId,$psName,$order,$psVal,$remark,$ptid);
			$flag=$stm->execute();
			return $flag;
		 } 
//			function query_s_producttypeinfo($s_producttypeinfo){
//		 	$ptId=$s_producttypeinfo->ptId;
//			$ptName=$s_producttypeinfo->ptName;
//			$parentId=$s_producttypeinfo->parentId;
//			$remark=$s_producttypeinfo->remark;
//			
//			$DBUtil=new DBUtil();
//			$con=$DBUtil->getCon();
//			$sql='INSERT INTO s_producttypeinfo(ptId,ptName,parentId,remark) VALUE(?,?,?,?)';
//			$stm->bind_param('isis',$psId,$psName,$order,$psVal,$remark,$ptid);
//			$flag=$stm->execute();
//			return $flag;
//		 }
			function query_s_protypeattribute($s_protypeattribute){
		 	$attId=$s_protypeattribute->attId;
			$typeID=$s_protypeattribute->typeID;
		    $attName=$s_protypeattribute->attName;
			
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$sql='INSERT INTO s_protypeattribute(attId,typeID,attName) VALUE(?,?,?)';
			$stm->bind_param('iis',$attId,$typeID,$attName);
			$flag=$stm->execute();
			return $flag;
		 }
		    function query_s_receiveaddrinfo($s_receiveaddrinfo){
		 	$raId=$s_receiveaddrinfo->raId;
			$aId=$s_receiveaddrinfo->aId;
			$raName=$s_receiveaddrinfo->raName;
			$addr=$s_receiveaddrinfo->addr;
			$phone=$s_receiveaddrinfo->phone;
			$mobile=$s_receiveaddrinfo->mobile;
			$zipCode=$s_receiveaddrinfo->zipCode;
			$isDefaule=$s_receiveaddrinfo->isDefaule;
			$remark=$s_receiveaddrinfo->remark;
			
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$sql='INSERT INTO s_receiveaddrinfo(raId,aId,raName,addr,phone,mobile,zipCode,isDefaule,remark) VALUE(?,?,?,?,?,?,?,?,?)';
			$stm->bind_param('iisssssis',$raId,$aId,$raName,$addr,$phone,$mobile,$zipCode,$isDefaule,$remark);
			$flag=$stm->execute();
			return $flag;
		 }
			function query_s_refundinfo($s_refundinfo){
		 	$rfId=$s_refundinfo->rfId;
		    $oId=$s_refundinfo->oId;
			$totalAmount=$s_refundinfo->totalAmount;
			$cId=$s_refundinfo->cId;
			$operator=$s_refundinfo->operator;
			$memo=$s_refundinfo->memo;
			$createTime=$s_refundinfo->createTime;
			$remark=$s_refundinfo->remark;
			
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$sql='INSERT INTO s_refundinfo(raId,oId,totalAmount,cId,operator,memo,createTime,remark) VALUE(?,?,?,?,?,?,?,?)';
			$stm->bind_param('iisissss',$raId,$oId,$totalAmount,$cId,$operator,$memo,$createTime,$remark);
			$flag=$stm->execute();
			return $flag;
		 }
			function query_s_sendinfo($s_sendinfo){
		 	$sId=$s_sendinfo->sId;
			$oId=$s_sendinfo->oId;
			$express=$s_sendinfo->express;
			$number=$s_sendinfo->number;
			$createTime=$s_sendinfo->createTime;
			$remark=$s_sendinfo->remark;
			
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$sql='INSERT INTO s_sendinfo(sId,oId,express,number,createTime,remark) VALUE(?,?,?,?,?,?)';
			$stm->bind_param('iissss',$express,$number,$createTime,$remark);
			$flag=$stm->execute();
			return $flag;
		 }
			function query_s_userinfo($s_userinfo){
		 	$uId=$s_userinfo->uId;
			$uName=$s_userinfo->uName;
			$uPwd=$s_userinfo->uPwd;
			$uType=$s_userinfo->uType;
			$uState=$s_userinfo->uState;
			$createTime=$s_userinfo->createTime;
			$remark=$s_userinfo->remark;
			
			$DBUtil=new DBUtil();
			$con=$DBUtil->getCon();
			$sql='INSERT INTO s_userinfo(uId,uName,uPwd,uType,uState,createTime,remark) VALUE(?,?,?,?,?,?,?)';
			$stm->bind_param('issiiss',$uId,$uName,$uPwd,$uType,$uState,$createTime,$remark);
			$flag=$stm->execute();
			return $flag;
		 }

		
	
	
	
	}
?>