<?php
header("ConTent-type:text/html;charset=utf-8");
class customer_logininfo{
    private $cName;
    private $cPwd;
    private $cId;
    private $cEmail;
    private $cSex;
    private $cBirth;
    private $trueName;
    private $cellPhone;
    private $telPhone;
    private $nickName;
    private $cState;
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