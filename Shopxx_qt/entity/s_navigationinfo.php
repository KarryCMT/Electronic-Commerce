<?php
	class s_navigationinfo{
		private $nId;
		private $nName;
		private $nUrl;
		private $nPosition;
		private $nIsNew;
		private $orders;	
	
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