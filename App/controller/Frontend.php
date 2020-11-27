<?php

namespace App\controller; 

use App\model\PostManager;
use App\model\CommentManager;

class Frontend extends AbstractController{

    public function home(){

        $posts = new PostManager;
        $resultat = $posts->getPosts(4);
        require 'App/views/frontend/homeView.php';
    }

    public function posts(){
        $posts = new PostManager;
        $resultat = $posts->getPosts(100);
        require 'App/views/frontend/listPostsView.php';
    }

    public function post($postId){

        $post= new PostManager;
        $resultat= $post->getPost($postId);
        $comment= new CommentManager;
        $resultat['comments'] = $comment-> getComments($postId);
        require 'App/views/frontend/postView.php';
    }

    public function addComment(){
        $superglobalsPost = $this->getSuperglobals()->get_POST();
        $newComment= new CommentManager;
        $param['status'] = "waiting";
        $newComment->createComment($param);
        if (isset($superglobalsPost['post_id'])){
            $post_id= $superglobalsPost['post_id'];
        }
        //message de confirmation
        $titleAction="Confirmation d'enregistrement";
        $actionConfirmation= "/listPosts";
        $textConfirmation="Votre commentaire a bien été enregistré";
        require 'App/views/backend/confirmationTemplate.php';
    }
    
    public function login(){
        require 'App/views/frontend/adminConnexionView.php';
    }
 
}