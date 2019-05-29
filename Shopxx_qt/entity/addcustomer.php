<?php
header("Content-type: text/html; charset=utf-8");
    class addcustomer{
    	private $Aid;
		private $cid;
		private $AddCustomer;
		private $isDef;	
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