<?php

namespace App\controller; 

use App\model\PostManager;


class Frontend {



    public function home(){

        $posts = new PostManager;
        $resultat = $posts->getPosts(4);
        require ('App/views/home.phtml');
    }

    public function posts(){
        $posts = new PostManager;
        $resultat = $posts->getPosts(10);
        require ('App/views/listPosts.phtml');
    }

    public function post($postId){

        $post= new PostManager;
        $resultat= $post->getPost($postId);
        var_dump ($postId);die;
        require ('App/views/detailsPost.phtml');


    }
    
}