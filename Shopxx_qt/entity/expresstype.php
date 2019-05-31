<?php
	class ExpressTypeInfo{
		private $etid;
		private $etname;
		private $fweight;
		private $fprice;
		private $cweight;
		private $cprice;
		private $etintroduce;
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