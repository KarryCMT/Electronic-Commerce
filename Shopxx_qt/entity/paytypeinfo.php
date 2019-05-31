<?php
	class paytypeinfo{
		private $ptId;
		private $ptName;
		private $ptType;
		private $ptLong;
		private $ptIntroduce;
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