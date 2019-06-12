<?php
	class s_articletype{
		private $AtId;
		private $ArName;
		private $AtTitle;
		private $AtRemark;
		private $AtImp;
		private $Atorder;
		//指定一个属性  存放的是所有当前类型下面的所有新闻信息
		//不是一个单一数据类型 是一个数组
		private $Arr_article;
		public function __get($property_name) {
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