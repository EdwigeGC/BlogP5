<?php

namespace App\entity;

class Validator {

    private $datas = [],
            $errors =[];

    public function __construct($datas){
        $this->datas = $datas;
    }

    public function check ($name, $rule, $option = false){
        $validator= "validate_$rule";
        $this->$validator($name,$option);

    }

    public function validate_required($name){
        return array_key_exists($name,$this->datas) && $this->datas[$name] != '';
    }

    
}