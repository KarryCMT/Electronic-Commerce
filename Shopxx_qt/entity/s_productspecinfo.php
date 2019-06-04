<?php

class s_productspecinfo{
	    private $psId;
	    private $psName;
	    private $order;
	    private $psVal;
	    private $ptid;
	    private $remark;
	    function __get($property_name){
	
	        if(isset($this->$property_name)){
	
	            return ($this->$property_name);
	        }else{
	            return null;
	        }
	    }
	    function __set($property_name,$value){
	
	        $this->$property_name=$value;
	    }
}
?>