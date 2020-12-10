<?php

namespace App\controller;

use App\model\UserManager;

class Login extends AbstractController{

    public function connexion(){
            $superglobalsPost = $this->getSuperglobals()->get_POST();
            if (!empty($superglobalsPost['login']) && !empty($superglobalsPost['password'])) {;
            $user = new UserManager;
            $resultat = $user->checkLogin($superglobalsPost['login']);
                if (isset($resultat['login'], $resultat['password']) && $resultat['login'] == $superglobalsPost['login'] && password_verify($superglobalsPost['password'], $resultat['password'])) {
                    session_start ();
                    $_SESSION['id'] = $resultat['id'];
                    $_SESSION['login'] = $resultat['login'];
                    $_SESSION['role'] = $resultat['role'];
                    if($_SESSION['role'] == "administrateur"){
                        header ('Location:/admin');
                    }
                    else {
                        header ('Location:/home');
                    }
                }
                else{
                    $failed= "Erreur login et/ou mot de passe";
                    require 'App/views/frontend/connexionView.php';
                }
            }

            else {
                $failed= "Tous les champs sont requis";
                require 'App/views/frontend/connexionView.php';
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
                    require 'App/views/frontend/ConnexionView.php';
                }
                if(empty($errors)){
                        $superglobals['password'] = password_hash($superglobals['password'], PASSWORD_BCRYPT);
                        $superglobals['role'] = "visiteur";
                        $newUser->createUser($superglobals);
                        require 'App/views/frontend/ConnexionView.php';
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
        
        public function logOut(){
            session_start ();
            session_unset ();
            session_destroy ();
            header ('Location: /home');
        }
    
}
