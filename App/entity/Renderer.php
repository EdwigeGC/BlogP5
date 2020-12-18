<?php

namespace App\entity;

class Renderer {

    private $renderer;
    private $path; 

    public function addPath(string $namespace, ?string $path): void {
        $this->path[$namespace] = $path;
    }

    public function render(string $view, $param = []) {
        $loader = new \Twig\Loader\FilesystemLoader(['App/views/backend', 'App/views/frontend', 'App/views/templates']);
        $twig = new \Twig\Environment($loader, [
            'cache' => false,
        ]);
        dump('TWIG MARCHE');
        return $twig->render($view, $param);
    }
}