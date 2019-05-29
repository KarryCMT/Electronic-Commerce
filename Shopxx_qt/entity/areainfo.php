<?php
	header("Contment-type:text/html;Charset-UTF-8");
	class areainfo{
		private	$Area_id;
		private $Area_name;
		private $Area_parentid;
		private $Area_remark;
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