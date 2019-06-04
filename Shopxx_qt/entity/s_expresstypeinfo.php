<?php
	class s_expresstypeinfo{
		private $etId;
		private $etName;
		private $fWeight;
		private $fPrice;
		private $cWeight;
		private $cPrice;
		private $etIntroduce;
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