<?php
	header("Contment-type:text/html;Charset-UTF-8");
	class Brandinfo(){
		private $bid;
		private $ptid;
		private $bname;
		private $blog;
		private $bintroduce;
		private $burl;
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