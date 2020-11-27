<?php

namespace App\controller; 

use App\entity\Superglobals;

class AbstractController{

    //public function Error($param)`

    public function checkSession(){
        
    }
       
    public function getSuperglobals(){
        return new Superglobals;
    }

}