<?php

namespace App\utilities;

/**
 * Definition of Twig views
 */
class Renderer
{
    /**
     * Views files setup and parameters to be transmitted
     *
     * @param string $view
     * @param array $param
     * @return mixed
     */
    public function render(string $view, $param = [])
    {
        $loader = new \Twig\Loader\FilesystemLoader(
            ['App/views/backend', 'App/views/frontend', 'App/views/templates']);
        $twig = new \Twig\Environment($loader, [
            'cache' => false,
            'debug' => true
        ]);
        return $twig->render($view, $param);
    }
}
