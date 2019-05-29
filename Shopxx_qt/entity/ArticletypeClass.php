<?php
	header("Content-type:text/html;Charset-UTF-8");
	class articletype{
		private $Atid;
		private $ArName;
		private $AtImp;
		private $AtRemark;
		private $Atorder;		
	}
	public function __GET($property_name){
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