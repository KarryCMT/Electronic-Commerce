<?php
header("ConTent-type:text/html;charset=utf-8");
class admin_logininfo{
    private $uName;
    private $uPwd;
    private $uId;
    private $uType;
    private $uState;
    private $createTime;
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