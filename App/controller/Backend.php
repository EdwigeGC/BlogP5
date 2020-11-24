<?php

namespace App\controller;

use App\model\PostManager;
use App\model\CommentManager;
use App\model\UserManager;
use App\entity\Post;

class Backend {

    public function logAdmin(){
        if(!isset($_SESSION['id'])){
            session_start();
        }
        if($_SESSION['role'] != "administrateur"){
            header ('Location: /home');
        }
    }

    public function connexion(){
        $login= $_POST['login'];

        if (!empty($_POST['login']) && !empty($_POST['password']) && isset($_POST['login']) AND isset($_POST['password'])) {
        $user = new UserManager;
        $resultat = $user->session($login);

            if ($resultat['login'] == $_POST['login'] && password_verify($_POST['password'], $resultat['password'])) {
              
                session_start ();
                $_SESSION['id'] = $resultat['id'];
                $_SESSION['login'] = $resultat['login'];
                $_SESSION['password'] = $resultat['password'];
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
                $actionConfirmation= "/connexion";
                $textConfirmation="Erreur d'authentification: login ou mot de passe erroné";
                require('App/views/backend/confirmationTemplate.phtml');
            }
        }

        else {
            $titleAction="Erreur";
            $actionConfirmation= "/connexion";
            $textConfirmation="Erreur lors de l'enregistrement de vos informations. Merci de réitérer l'opération.";
            require('App/views/backend/confirmationTemplate.phtml');
        }
    }  
    
    public function logOut(){
        session_start ();
        session_unset ();
        session_destroy ();
        header ('Location: /home');
    }

    public function admin(){
        
        $this->logAdmin();
        $posts = new PostManager;
        $resultat = $posts->getPostsAdmin();
        require('App/views/backend/admin.phtml');
       
    }

    public function modifyPostForm($postId){
        $this->logAdmin();
        $post= new PostManager;
        $resultat= $post->getPostAdmin($_GET['id']);
        $comment= new CommentManager;
        $resultat['comments'] = $comment-> getComments($_GET['id']);
        $subtitle="Modifier l'article";
        $action='/updatePost';
        require('App/views/backend/postTemplate.phtml');
    }

    public function updatePost(){
        $this->logAdmin();

        $newPost= new PostManager;
        $newPost->updatePost($_POST,$_GET['id']);
        
        $titleAction="Confirmation d'enregistrement";
        $actionConfirmation= "/admin";
        $textConfirmation="Les modifications ont bien été enregistrées";
        require('App/views/backend/confirmationTemplate.phtml');
    }

    public function publishComment(){
        $this->logAdmin();
        $newComment= new CommentManager;
        $newComment->publishComment($_GET['id']);
        header ('Location:/commentsManagerView');
    }

    public function addPostForm(){
        $this->logAdmin();
        $posts = new PostManager;
        $subtitle="Ajouter un article";
        $action='/addPost';
        require('App/views/backend/postTemplate.phtml');
    }

    public function addPost(){
        $this->logAdmin();
        $newPost= new PostManager;
        $newPost->createPost($_POST);
       header ('Location:/admin');
    }

    public function deletePost($postId){
        $this->logAdmin();
        $post= new PostManager;
        $resultat= $post->deletePost($_GET['id']);
        $comment= new CommentManager;
        $resultat['comments'] = $comment->deleteComment($_GET['post_id']);
        
        $titleAction="Confirmation d'enregistrement";
        $actionConfirmation= "/admin";
        $textConfirmation="L'article a bien été supprimé";
        require('App/views/backend/confirmationTemplate.phtml');
    }

    public function adminCommentsList(){
        $this->logAdmin();
        $comments= new CommentManager;
        $resultat= $comments->adminComments();
        require('App/views/backend/commentsManagerView.phtml');
    }

    public function deleteComment(){
        $this->logAdmin();
        $comment= new CommentManager;
        $resultat= $comment->deleteComment($_GET['id']);
        header ('Location:/commentsManagerView');
    }

    public function userForm(){
        if(!isset($_SESSION['id'])){
            session_start();
        }
        if(!empty ($_GET['id']) && $_SESSION['id'] == $_GET['id']){
    
            $user= new UserManager;
            $resultat= $user->getUser($_GET['id']);
            $subtitle="Modifier vos informations";
            $action='/updateUser';
            require('App/views/backend/userFormTemplate.phtml');
        }
       
    }

    public function addUser(){
        $this->logAdmin();
//gestion des erreurs, vérification du formulaire avant ajout
        if (!empty($_POST)){
            $errors=[];
            if (empty($_POST['e_mail']) || !preg_match('/^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/', $_POST['e_mail'])){
                $errors['e_mail'] = "Votre e-mail n'est pas valide";
            }
            else{
                $newUser= new UserManager;
                $resultat= $newUser->checkEmail($_POST['e_mail']);
                if($resultat){
                    $errors['e_mail'] ="Cet E-mail est déjà utilisé pour un autre compte.";
                }
            }
            
            if (empty($_POST['login']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['login'])){
                $errors['login'] = "Votre login n'est pas valide. Merci d'utiliser uniquement des caractères alphanumériques.";
            }    
            else{
                    $newUser= new UserManager;
                    $resultat= $newUser->checkLogin($_POST['login']);
                    if($resultat){
                        $errors['login'] ="Ce login est déjà utilisé pour un autre compte.";
                    }
            }
            if (empty($_POST['password'])) {
                $errors['password'] = "Votre mot de passe n'est pas valide";
            }
            if(!empty($errors)){
                require ('App/views/frontend/adminConnexionView.phtml');
            }
            if(empty($errors)){
                    $_POST['password'] = password_hash($_POST['password'], PASSWORD_BCRYPT);
                    $_POST['role'] = "visiteur";
                    $newUser->createUser($_POST);
                    $titleAction="Confirmation d'enregistrement";
                    $actionConfirmation= "/home";
                    $textConfirmation="Votre compte a bien été créé";
                    require('App/views/backend/confirmationTemplate.phtml');
            }
        }
        else{
            $titleAction="Erreur";
            $actionConfirmation= "/connexion";
            $textConfirmation="Erreur lors de l'enrgistrement de vos informations. Merci de réitérer l'opération.";
            require('App/views/backend/confirmationTemplate.phtml');
        }
    }
       

    public function updateUser(){
        $user= new UserManager;
        $resultat= $user->checkLogin($_POST['login']);
        $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
        
        if (empty($resultat) || $resultat['login'] == $_POST['login']){
           if (!isset($_POST['role'])){
                $_POST['role'] = "visiteur";
                $user->updateUser($_POST,$_GET['id']);
                $titleAction="Confirmation d'enregistrement";
                $actionConfirmation= "/home";
                $textConfirmation="Vos informations ont bien été mises à jour.";
                require('App/views/backend/confirmationTemplate.phtml');
           }
           else {

            $user->updateUser($_POST,$_GET['id']);
            $titleAction="Confirmation d'enregistrement";
            $actionConfirmation= "/admin";
            $textConfirmation="Vos informations ont bien été mises à jour.";
            require('App/views/backend/confirmationTemplate.phtml');

           }
        }

    else {
        // TODO
        echo "Ce login existe déjà, veuillez choisir un autre nom";
        }
        
    }
    
}