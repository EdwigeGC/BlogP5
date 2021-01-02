<?php

namespace App\controller;

use App\utilities\Renderer;
use App\utilities\Superglobals;

class AbstractController
{
    public function getSuperglobals()
    {
        return new Superglobals;
    }

    public function getRender() {
        return new Renderer();
    }
    
}

