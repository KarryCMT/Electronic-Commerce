<?php
	class s_brandinfo{
		private $bId;
		private $ptId;
		private $bName;
		private $bLog;
		private $bIntroduce;
		private $bUrl;
		private $remark;
	
	public function __get($property_name){
		if (isset($this -> $property_name)) {
			return ($this -> $property_name);
		} else {
			return (null);
		}
	}
	public	 function __set($property_name, $value) {
		$this -> $property_name = $value;
	  }
	
}
	
	
	?>