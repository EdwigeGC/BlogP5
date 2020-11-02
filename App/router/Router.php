<?php

namespace App\router; 

use App\controller\Backend;
use App\controller\Frontend;


class Router
{
    private $url;

    public function __construct()
    {
/*
        $explode = explode('?', $_SERVER['REQUEST_URI']);

        if (isset($explode[0])){
            $this->url = $explode[0];
        } else {

        }
*/
        $this->url = $_SERVER['REQUEST_URI'];
    }
    
    public function route()
    {

        if ($this->url == '/' || $this->url == '/home.phtml') {
            $controller= new Frontend();
            $controller->home();
        }

        else if ($this->url == '/listPosts.phtml') {
            $controller= new Frontend();
            $controller->posts();
        }

        else if ($this->url == '/detailsPost-([0-9]).phtml') {
            echo 'coucou';
            //$controller= new Frontend();
            //$controller->post();
        }

        else if ($this->url == '/login.phtml') {
            $controller= new Backend();
            $controller->login();
        }

        else if ($this->url == '/admin.phtml') {
            $controller= new Backend();
            $controller->admin();
        }

        else if ($this->url == '/addPost.phtml') {
            $controller= new Backend();
            $controller->addPost();
        }

        else if ($this->url == '/deletePost.phtml') {
            $controller= new Backend();
            $controller->deletePost();
        }

        else if ($this->url == '/updatePost.phtml') {
            $controller= new Backend();
            $controller->updatePost();
        }

        else if ($this->url == '/login/check.phtml') {
            $controller= new Backend();
            $controller->checkLogin();
        }

        else 
            echo ('page 404');
    }

}