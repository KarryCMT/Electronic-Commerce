<?php
   class receiveaddrinfo{
	private $raId;
	private $aId;
	private $raName;
	private $addr;
	private $phone;
	private $mobile;
	private $zipCode;
	private $isDefault;
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