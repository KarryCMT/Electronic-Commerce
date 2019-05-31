<?php
	class gatheringinfo{
		private $gid;
		private $cid;
		private $oid;
		private $gmoney;
		private $memo;
		private $createTime;
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