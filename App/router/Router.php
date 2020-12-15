<?php

namespace App\router; 

use App\controller\Backend;
use App\controller\Frontend;
use App\controller\Login;
use App\entity\Superglobals;



class Router
{
    private $url;


    public function __construct()

    {
        $explode = explode('?', $_SERVER['REQUEST_URI']); 
        if (isset($explode[0])){
            $this->url = $explode[0];
        }
    }
    
    public function route()
    {
        $superglobals= new Superglobals();
        $superglobalGet=$superglobals->get_GET();

        try {

    // frontend
            if ($this->url == '/' || $this->url == '/home') {
                $controller= new Frontend();
                $controller->home();
            }

            else if ($this->url == '/listPosts') {
                $controller= new Frontend();
                $controller->posts();
            }

            else if ($this->url == '/post') {
                $controller= new Frontend();
                $controller->post($superglobalGet['id']);
               
            }

            else if ($this->url == '/addComment') {
                $controller= new Frontend();
                $controller->addComment();
            }

            else if ($this->url == '/contact') {
                    $controller= new Backend();
                    $controller->sendMail();
            }

            else if ($this->url == '/legalesMentions') {
                $controller= new Frontend();
                $controller->legalesMentions();
            }

    // login
            else if ($this->url == '/login') {
                $controller= new Login();
                $controller->login();
            }

            else if ($this->url == '/connexion') {
                $controller= new Login();
                $controller->connexion();
            }

            else if ($this->url == '/logOut') {
                $controller= new Login();
                $controller->logOut();
            }

    // backend
            else if ($this->url == '/admin') {
                $controller= new Backend();
                $controller->admin();
            }

            else if ($this->url == '/addPostForm') {
                $controller= new Backend();
                $controller->addPostForm();
            }

            else if ($this->url == '/addPost') {
                $controller= new Backend();
                $controller->addPost();
            }

            else if ($this->url == '/modifyPost') {
                
                $controller= new Backend();
                $controller->modifyPostForm($superglobalGet['id']);
            }

            else if ($this->url == '/updatePost') {
                $controller= new Backend();
                $controller->updatePost($superglobalGet['id']);
            }

            else if ($this->url == '/deletePost') {
                $controller= new Backend();
                $controller->deletePost($superglobalGet['id']);
            }

            else if ($this->url == '/deleteComment') {
                $controller= new Backend();
                $controller->deleteComment($superglobalGet['id']);
            }

            else if ($this->url == '/commentsManagerView') {
                $controller= new Backend();
                $controller->adminCommentsList();
            }

            else if ($this->url == '/validateComment') {
                $controller= new Backend();
                $controller->validateComment($superglobalGet['id']);    
            }

            else if ($this->url == '/usersManagerView') {
                $controller= new Backend();
                $controller->usersList();
            }

            else if ($this->url == '/userForm') {
                $controller= new Backend();
                $controller->userForm($superglobalGet['id']); 
            }

            else if ($this->url == '/addUser') {
                $controller= new Login();
                $controller->addUser();
            }

            else if ($this->url == '/updateUser') {
                $controller= new Backend();
                $controller->updateUser();
            }

            else if ($this->url == '/deleteUser') {
                $controller= new Backend();
                $controller->deleteUser($superglobalGet['id']);
            }
        
            else {
                require 'App/views/frontend/404.php';
            }
        }
        catch(\PDOException $e) { 
            echo 'Erreur : ' . $e->getMessage();
        }   
    }     
}