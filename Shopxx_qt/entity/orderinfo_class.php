<?php
	class orderinfo{
		private $oId;
		private $etId;
		private $aId;
		private $cId;
		private $ptId;
		private $pId;
		private $eFee;
		private $paFee;
		private $totalAmount;
		private $pSum;
		private $msg;
		private $oState;
		private $cerateTime;
		private $remark;
	
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
	}
	?>