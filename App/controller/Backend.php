<?php

namespace App\controller;

use App\model\PostManager;
use App\model\CommentManager;
use App\model\UserManager;


class Backend extends AbstractController{

    public function adminAccess(){

        session_start();
        $superglobals = $this->getSuperglobals()->get_SESSION();
        if(empty($superglobals['id']) && $superglobals['role'] !== "administrateur"){
        header ('Location: /home');
        }
    }

    public function connexion(){
        $superglobalsPost = $this->getSuperglobals()->get_POST();
        if (!empty($superglobalsPost['login']) && !empty($superglobalsPost['password'])) {
        $user = new UserManager;
        $resultat = $user->checkLogin($superglobalsPost['login']);
            if (isset($resultat['login'], $resultat['password']) && $resultat['login'] == $superglobalsPost['login'] && password_verify($superglobalsPost['password'], $resultat['password'])) {
                session_start ();
                $_SESSION['id'] = $resultat['id'];
                $_SESSION['login'] = $resultat['login'];
                $_SESSION['role'] = $resultat['role'];
                if($resultat['role'] == "administrateur"){
                    header ('Location:/admin');
                }
                else {
                    header ('Location:/home');
                }
            }
            else{
       
                $titleAction="Erreur";
                $actionConfirmation= "/login";
                $textConfirmation="Erreur d'authentification: login ou mot de passe erroné";
                require 'App/views/backend/confirmationTemplate.php';
            }
        }
        else {
            $titleAction="Erreur";
            $actionConfirmation= "/login";
            $textConfirmation="Erreur lors de l'enregistrement de vos informations. Merci de réitérer l'opération.";
            require 'App/views/backend/confirmationTemplate.php';
        }
    }  
    
    public function logOut(){
        session_start ();
        session_unset ();
        session_destroy ();
        header ('Location: /home');
    }

    public function admin(){
        
        $this->adminAccess();
        $posts = new PostManager;
        $resultat = $posts->getPostsAdmin();
        require 'App/views/backend/admin.php';
       
    }

    public function modifyPostForm($postId){
        $this->adminAccess();
        $post= new PostManager;
        $resultat= $post->getPostAdmin($postId);
        $comment= new CommentManager;
        $resultat['comments'] = $comment-> getComments($postId);
        $subtitle="Modifier l'article";
        $action='/updatePost';
        require 'App/views/backend/postTemplate.php';
    }

    public function updatePost($superglobals){
        $this->adminAccess();
        $superglobals= $this->getSuperglobals()->get_POST();
        $newPost= new PostManager;
        $newPost->updatePost($superglobals);
    //message de confirmation
        $titleAction="Confirmation d'enregistrement";
        $actionConfirmation= "/admin";
        $textConfirmation="Les modifications ont bien été enregistrées";
        require 'App/views/backend/confirmationTemplate.php';
    }

    public function publishComment($commentId){
        $this->adminAccess();
        $newComment= new CommentManager;
        $newComment->publishComment($commentId);
        header ('Location:/commentsManagerView');
    }

    public function addPostForm(){
        $this->adminAccess();
        $posts = new PostManager;
        $subtitle="Ajouter un article";
        $action='/addPost';
        require 'App/views/backend/postTemplate.php';
    }

    public function addPost(){
        $this->adminAccess();
        $superglobals= $this->getSuperglobals()->get_POST();
        $newPost= new PostManager;
        $newPost->createPost($superglobals);
        header ('Location:/admin');
    }

    public function deletePost($postId){
        $this->adminAccess();
        $post= new PostManager;
        $resultat= $post->deletePost($postId);
        $comment= new CommentManager;
        $resultat['comments'] = $comment->deleteComment($postId);
        //message de confirmation
        $titleAction="Confirmation d'enregistrement";
        $actionConfirmation= "/admin";
        $textConfirmation="L'article a bien été supprimé";
        require 'App/views/backend/confirmationTemplate.php';
    }

    public function adminCommentsList(){
        $this->adminAccess();
        $comments= new CommentManager;
        $resultat= $comments->adminComments();
        require 'App/views/backend/commentsManagerView.php';
    }

    public function deleteComment($commentId){
        $this->adminAccess();
        $comment= new CommentManager;
        $resultat= $comment->deleteComment($commentId);
        header ('Location:/commentsManagerView');
    }

    public function userForm($userId){
        session_start();
        $superglobals= $this->getSuperglobals()->get_SESSION();
        if(!empty ($userId) && $superglobals['id'] == $userId){
            $user= new UserManager;
            $resultat= $user->getUser($userId);
            $subtitle="Modifier vos informations";
            $action='/updateUser';
            require 'App/views/backend/userFormTemplate.php';
        }
    }

    public function addUser(){
        $superglobals= $this->getSuperglobals()->get_POST();
    //gestion des erreurs, vérification du formulaire avant ajout
        if (!empty($superglobals)){
            $errors=[];
            if (empty($superglobals['e_mail']) || !preg_match('/^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/', $superglobals['e_mail'])){
                $errors['e_mail'] = "Votre e-mail n'est pas valide";
            }
            else{
                $newUser= new UserManager;
                $resultat= $newUser->checkEmail($superglobals['e_mail']);
                if($resultat){
                    $errors['e_mail'] ="Cet E-mail est déjà utilisé pour un autre compte.";
                }
            }
            
            if (empty($superglobals['login']) || !preg_match('/^[a-zA-Z0-9_]+$/', $superglobals['login'])){
                $errors['login'] = "Votre login n'est pas valide. Merci d'utiliser uniquement des caractères alphanumériques.";
            }    
            else{
                    $newUser= new UserManager;
                    $resultat= $newUser->checkLogin($superglobals['login']);
                    if($resultat){
                        $errors['login'] ="Ce login est déjà utilisé pour un autre compte.";
                    }
            }
            if (empty($superglobals['password'])) {
                $errors['password'] = "Votre mot de passe n'est pas valide";
            }
            if(!empty($errors)){
                require 'App/views/frontend/adminConnexionView.php';
            }
            if(empty($errors)){
                    $superglobals['password'] = password_hash($superglobals['password'], PASSWORD_BCRYPT);
                    $superglobals['role'] = "visiteur";
                    $newUser->createUser($superglobals);
                    $titleAction="Confirmation d'enregistrement";
                    $actionConfirmation= "/home";
                    $textConfirmation="Votre compte a bien été créé";
                    require 'App/views/backend/confirmationTemplate.php';
            }
        }
        else{
            //message d'erreur
            $titleAction="Erreur";
            $actionConfirmation= "/connexion";
            $textConfirmation="Erreur lors de l'enrgistrement de vos informations. Merci de réitérer l'opération.";
            require 'App/views/backend/confirmationTemplate.php';
        }
    }
       

    public function updateUser(){
        $superglobalsPost= $this->getSuperglobals()->get_POST();
        $superglobalsGet= $this->getSuperglobals()->get_GET();
        $user= new UserManager;
        $resultat= $user->checkLogin($superglobalsPost['login']);
        
        if (empty($resultat) || $resultat['login'] == $superglobalsPost['login']){
           if (!isset($superglobalsPost['role'])){
                $superglobalsPost['role'] = "visiteur";
                $user->updateUser($superglobalsPost,$superglobalsGet['id']);
                //message de confirmation
                $titleAction="Confirmation d'enregistrement";
                $actionConfirmation= "/home";
                $textConfirmation="Vos informations ont bien été mises à jour.";
                require 'App/views/backend/confirmationTemplate.php';
           }
           else {

            $user->updateUser($superglobalsPost,$superglobalsGet['id']);
            $titleAction="Confirmation d'enregistrement";
            $actionConfirmation= "/admin";
            $textConfirmation="Vos informations ont bien été mises à jour.";
            require 'App/views/backend/confirmationTemplate.php';

           }
        }

    else {
        $titleAction="Confirmation d'enregistrement";
        $actionConfirmation= "/admin";
        $textConfirmation="Vos informations ont bien été mises à jour.";
        require 'App/views/backend/confirmationTemplate.php';

        }
        
    }
    
}