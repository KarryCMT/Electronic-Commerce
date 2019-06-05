<?php

class s_customergradeinfo{
	    private $cgName;
	    private $OffNum;
	    private $isDef;
	    private $cgId;
	    private $ShoMoney;
	   	private $cgIntroduce
	    private $remark;
	  public  function __get($property_name){
	
	        if(isset($this->$property_name)){
	
	            return ($this->$property_name);
	        }else{
	            return null;
	        }
	    }
	 public   function __set($property_name,$value){
	
	        $this->$property_name=$value;
	    }
}
?>