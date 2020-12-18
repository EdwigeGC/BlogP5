<?php

namespace App\controller;

use App\entity\Renderer;
use App\entity\Superglobals;

class AbstractController
{
    public function getSuperglobals()
    {
        return new Superglobals;
    }

    //to simplify the display of dates
    public function prepareListPost($list)
    {
        foreach ($list as $index => $post) {

            $list[$index] = $this->dateChoice($post);
        }
        return $list;
    }

    public function dateChoice($post)
    {
        $post['date'] = null;
        if (isset($post['modification_date_fr'])) {

            $post['date'] = $post['modification_date_fr'];
        } else {
            $post['date'] = $post['creation_date_fr'];
        }
        unset($post['creation_date_fr']);
        unset($post['modification_date_fr']);
        return $post;
    }

    public function getRender() {
        return new Renderer();
    }
}
