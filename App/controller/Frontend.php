<?php

namespace App\controller;

use App\model\PostManager;
use App\model\CommentManager;

class Frontend extends AbstractController
{

    public function home()
    {
        session_start();
        $posts = new PostManager;
        $resultat = $posts->getPosts(4);
        echo $this->getRender()->render('homeView.twig', [
            'resultat' => $resultat,
            'session'=> $this->getSuperglobals()->get_SESSION()
            ]);
        //require 'App/views/frontend/homeView.php';
    }

    public function posts()
    {
        session_start();
        $posts = new PostManager;
        $resultat = $posts->getPosts(100);
        $resultat = $this->prepareListPost($resultat);
        echo $this->getRender()->render('listPostsView.twig', [
            'posts' => $resultat,
            'session' => $this->getSuperglobals()->get_SESSION()
        ]);
        //require 'App/views/frontend/listPostsView.php';
    }

    public function post($postId)
    {
        session_start();
        $post = new PostManager;
        $resultat = $this->dateChoice($post->getPost($postId));
        $comment = new CommentManager;
        $res = $comment->getComments($postId);
        echo $this->getRender()->render('postView.twig', [
            'post' => $resultat, 
            'comments' => $res,
            'session' => $this->getSuperglobals()->get_SESSION()
            ]);
        //require 'App/views/frontend/postView.php';
    }

    public function addComment()
    {
        session_start();
        $superglobalsPost = $this->getSuperglobals()->get_POST();
        $newComment = new CommentManager;
        $superglobalsPost['status'] = "waiting";
        $newComment->createComment($superglobalsPost);
        if (isset($superglobalsPost['post_id'])) {
            $post_id = $superglobalsPost['post_id'];
        }
        $titleAction = "Confirmation d'enregistrement";                       //confirmation message
        $actionConfirmation = "/post?id=" . $post_id;
        $textConfirmation = "Votre commentaire a bien été enregistré";
        echo $this->getRender()->render('confirmationTemplate.twig', [
            'titleAction' => $titleAction,
            'actionConfirmation' => $actionConfirmation,
            'textConfirmation' => $textConfirmation,
            'session' => $this->getSuperglobals()->get_SESSION()
        ]);
        //require 'App/views/backend/confirmationTemplate.php';
    }

    public function legalesMentions()
    {
        echo $this->getRender()->render('legalesMentions.twig');
    }
}
