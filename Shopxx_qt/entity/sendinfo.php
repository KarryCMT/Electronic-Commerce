<?php 
	class sendinfo{
		private $sId;
		private $oId;
		private $express;
		private $number;
		private $createTime;
		private $remark;
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