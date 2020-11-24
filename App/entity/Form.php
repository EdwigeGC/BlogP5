<?php

namespace App\entity; 


class Form
{
  private $type,
          $name,
          $label,
          $data =[];


  public function __construct($data=[]){
    $this->data =$data;
  }

  public function input($type, $name, $label){
    $this->input ($type,$name, $label);
}

  public function text($name,$label){
    return $this->input('text', $name,$label);
  }

  public function email($name,$label){
    return $this->input('email', $name,$label);
  }

  public function textarea($name,$label){
    return $this->input('textarea', $name,$label);
}

  //GETTER
  
  function getType(){
    return $this->_type;
  }

  function getName(){
    return $this->_name;
  }

  function getLabel(){
    return $this->_label;
  }

  
  //SETTER
  public function setType()
  {
    if ($this->textarea);
  }
}