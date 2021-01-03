<?php

namespace App\controller;

use App\utilities\Renderer;
use App\utilities\Superglobals;

/**
 * This class is the parent classe which inherits all controllers files
 */
class AbstractController
{
    /**
     * Function which use App/utilities/Superglobals class and allow controllers to collect datas
     *
     * @return object
     */
    public function getSuperglobals()
    {
        return new Superglobals;
    }

    /**
     * Function which use App/utilities/Renderer class and allow controllers to collect views
     *
     * @return object
     */
    public function getRender()
    {
        return new Renderer();
    }
}
