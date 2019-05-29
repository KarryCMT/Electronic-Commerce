<?phppublic function __get($property_name){
		if (isset($this -> $property_name)) {
			return ($this -> $property_name);
		} else {
			return (null);
		}
		public function __set($property_name, $value) {
		$this -> $property_name = $value;
	  }
		
	}
	class noticeinfo{
		private $nId;
		private $uId;
		private $nContent;
		private $createTime;
		private $remark;	
	}
	
	
	?>