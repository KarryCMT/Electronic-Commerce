<?php
	header("contment-type:text/html;Charset-UTF-8");
	class Article{
		private $AR_id;
		private $AR_title;
		private $AR_content;
		private $AR_at_id;
		private $AR_at_author;
		private $AR_states;
		private $AR_istop;
		private $AR_remark;
		private $AR_cetile;					
	
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