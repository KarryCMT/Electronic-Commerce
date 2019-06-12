<?php
class s_articleinfo {
	private $ArId;
	private $ArTitle;
	private $ArContent;
	private $AtId;
	private $AtAuthor;
	private $States;
	private $isTop;
	private $ArMark;
	private $CrTime;
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
