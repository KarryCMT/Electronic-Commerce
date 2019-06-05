<?php
	class s_friendshipuinfo{
		private $fr_id;
		private $fr_Name;
		private $fr_logo;
		private $fr_url;
		private $fr_order;
		private $fr_createDate;	
	
	public function __get($property_name){
		if (isset($this -> $property_name)) {
			return ($this -> $property_name);
		} else {
			return (null);
		}
	}
		public function __set($property_name, $value) {
		$this -> $property_name = $value;
	  }
		
	
	}
	
	
	?>