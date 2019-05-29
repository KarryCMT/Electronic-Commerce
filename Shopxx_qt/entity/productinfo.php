<?php
	class productinfo{
		private $pId;
		private $ptId;
		private $bId;
		private $psId;
		private $pName;
		private $pPrice;
		private $pAddr;
		private $pPhoto;
		private $pIntroduce;
		private $pWeight;
		private $pCount;
		private $pState;
		private $isHot;
		private $isNew;
		private $remark;
		private $createDate;
		private $costPrice;
		private $marketPrice;
		private $VIPPrice;
		private $pScore;
	}
	public function __get($property_name){
		if (isset($this -> $property_name)) {
			return ($this -> $property_name);
		} else {
			return (null);
		}
		public function __set($property_name, $value) {
		$this -> $property_name = $value;
	  }
		
	}
	
	?>