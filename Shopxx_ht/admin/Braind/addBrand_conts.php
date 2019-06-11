<html>
	<head>
		<title></title>
		<meta charset="utf-8" />
	</head>
	<body>
		<?php
			require_once dirname(dirname(dirname(__FILE__)))."\util\DBUtil.php";
			$bId=$_POST['bId'];
			$ptId=$_POST['ptId'];
			$bName=$_POST['bName'];			
			$bLog=$_POST['bLog'];
			$bIntroduce=$_POST['bIntroduce'];
			$bUrl=$_POST['bUrl'];
			$remark=$_POST['remark'];
			$s_brandinfo=new s_brandinfo();
			$s_brandinfo->bId=$bId;
			$s_brandinfo->bName=$bName;
			$arr_file=$_FILES['bLog'];
			$bLog="resources/images/brand/".$bId.".jpg";
			$s_brandinfo->bLog=$bLog;
			$s_brandinfo->bUrl=$bUrl;
			$s_brandinfo->ptId=$ptId;
			$s_brandinfo->bIntroduce=$bIntroduce;
			$s_brandinfo->remark=$remark;
			$bLog=$_FILES['bLog'];
			$file_name=dirname(dirname(dirname(__FILE__)))."\\Shopxx_qt\\resources\\images\\brand\\".$bId."jpg";
			if(move_uploaded_file($bLog['tmp_anem'], $file_name)){
				echo"<br/>";
				echo"上传成功<br/>";
			}else{
				echo"上传失败<br/>";
			}
			$dbutil=new DBUtil();
			$falg=$dbutil->query_add_s_brandinfo($s_brandinfo);
			if($falg){
				echo"<script>alert('添加成功！');windoe.location.herf='../admin/Braind/addBraind.php';</script>";
			}else{
				echo"<script>alert('添加失败！');windoe.location.herf='../admin/Braind/addBraind.php';</script>";
			}
			
			?>
	</body>
</html>