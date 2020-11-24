<?php

namespace App\controller; 

use App\model\PostManager;
use App\model\CommentManager;

class Frontend {



    public function home(){

        $posts = new PostManager;
        $resultat = $posts->getPosts(4);
        require ('App/views/frontend/homeView.phtml');
    }

    public function posts(){
        $posts = new PostManager;
        $resultat = $posts->getPosts(100);
        require ('App/views/frontend/listPostsView.phtml');
    }

    public function postsCategory($category){
        $posts = new PostManager;
        $resultat = $posts->getPostsCategory($_GET['category']);
    
        require ('App/views/frontend/listPostsView.phtml');
    }

    public function post($postId){

        $post= new PostManager;
        $resultat= $post->getPost($_GET['id']);
        $comment= new CommentManager;
        $resultat['comments'] = $comment-> getComments($_GET['id']);
        require ('App/views/frontend/postView.phtml');
    }

    public function addComment(){
        $newComment= new CommentManager;
        $_POST['status'] = "waiting";
        $newComment->createComment($_POST);
        $post_id= $_POST['post_id'];

        $titleAction="Confirmation d'enregistrement";
        $actionConfirmation= "/listPosts";
        $textConfirmation="Votre commentaire a bien été enregistré";
        require ('App/views/backend/confirmationTemplate.phtml');
    }
    
    public function login(){
        require('App/views/frontend/adminConnexionView.phtml');
    }
 
}