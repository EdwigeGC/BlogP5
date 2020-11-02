<?php

namespace App\controller;

use PostManager;

class Backend {

    public function login(){
        require('logView.html');
    }

    public function admin(){
        require('App/views/admin.phtml');
    }

    public function updatePost(){
        echo "page pour modifier un post dans l admin";
    }

    public function addPost(){
        echo "page pour ajouter un post dans l admin";
    }

    public function deletePost(){
        echo "page pour supprimer un post dans l admin";
    }

    public function checkLogin(){
        echo "checkLogin";
    }
    
}