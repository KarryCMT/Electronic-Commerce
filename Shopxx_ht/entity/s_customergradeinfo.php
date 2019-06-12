<?php
	class s_customergradeinfo{
		private $cgId;
		private $cgName;
		private $cgIntroduce;
		private $remark;
		private $ShoMoney;
		private $OffNum;
		private $isDef;
		
		function __get($property_name){
			if(isset($this->$property_name)){
				return($this->$property_name);
			}else{
				return null;
			}
		}
		
		function __set($property_name,$value){
			$this->$property_name=$value;
		}
	}
	
	?>