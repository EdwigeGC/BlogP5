<?php

namespace App\controller;

use App\model\PostManager;
use App\model\CommentManager;
use App\model\UserManager;
use App\model\ContactManager;

class Backend extends AbstractController
{

    public function adminAccess()
    {                                                       //admin access only authorized for "administrateur" role
        session_start();
        $superglobals = $this->getSuperglobals()->get_SESSION();

        if (empty($superglobals['id']) || $superglobals['role'] != "administrateur") {
            header('Location: /home');
        }
    }

    public function admin()
    {
        $this->adminAccess();
        $posts = new PostManager;
        $postsList = $posts->getPostsAdmin();
        $postsList = $this->prepareListPost($postsList);
        echo $this->getRender()->render('admin.twig', [
            'posts' => $postsList,
            'session' => $this->getSuperglobals()->get_SESSION()
        ]);
        //require 'App/views/backend/admin.php';
    }

    // Posts functions
    public function updatePostForm($postId)
    {
        $this->adminAccess();
        $post = new PostManager;
        $resultat = $post->getPostAdmin($postId);
        $comment = new CommentManager;
        $commentList = $comment->getComments($postId);
        $resultat['comment'] = [];
        foreach ($commentList as $key => $value) {
            if ($commentList[$key]['status'] === 'agreed') {
                $resultat['comment'][] = $value;
            }
        }
        $subtitle = "Modifier l'article";
        $action = '/updatePost';
        echo $this->getRender()->render('postTemplate.twig', [
            'post' => $resultat,
            'comments' => $resultat['comment'],
            'subtitle' => $subtitle,
            'action' => $action,
        ]);
        //require 'App/views/backend/postTemplate.php';
    }

    public function updatePost($superglobals)
    {
        $this->adminAccess();
        $superglobals = $this->getSuperglobals()->get_POST();
        $newPost = new PostManager;
        $newPost->updatePost($superglobals);
        $titleAction = "Confirmation d'enregistrement";                            //confirmation message
        $actionConfirmation = "/admin";
        $textConfirmation = "Les modifications ont bien été enregistrées";
        echo $this->getRender()->render('confirmationTemplate.twig', [
            'titleAction' => $titleAction,
            'actionConfirmation' => $actionConfirmation,
            'textConfirmation' => $textConfirmation
        ]);
        //require 'App/views/backend/confirmationTemplate.php';
    }

    public function addPostForm()
    {
        $this->adminAccess();
        $posts = new PostManager;
        $subtitle = "Ajouter un article";
        $action = '/addPost';
        echo $this->getRender()->render('postTemplate.twig', [
            'posts' => $posts,
            'subtitle' => $subtitle,
            'action' => $action
        ]);
        //require 'App/views/backend/postTemplate.php';
    }

    public function addPost()
    {
        $this->adminAccess();
        $superglobals = $this->getSuperglobals()->get_POST();
        if (!empty($superglobals) && isset($superglobals)) {
            $newPost = new PostManager;
            $newPost->createPost($superglobals);
            $subtitle = "Ajouter un article";
            $success = "L'artcle a bien été ajouté";
            echo $this->getRender()->render('postTemplate.twig', [
                'success' => $success,
                'subtitle' => $subtitle
            ]);
        }
    }

    public function deletePost($postId)
    {
        $this->adminAccess();
        $post = new PostManager;
        $post->deletePost($postId);
        $comment = new CommentManager;
        $comment->deleteComments($postId);
        header('Location:/admin');
        //require 'App/views/backend/confirmationTemplate.php';
    }

    // Comments functions
    public function adminCommentsList()
    {
        $this->adminAccess();
        $comments = new CommentManager;
        $resultat = $comments->adminComments();
        echo $this->getRender()->render('commentsManagerView.twig', [
            'resultat' => $resultat,
            'session' => $this->getSuperglobals()->get_SESSION()
        ]);
        //require 'App/views/backend/commentsManagerView.php';
    }

    public function validateComment($commentId)
    {
        $this->adminAccess();
        $newComment = new CommentManager;
        $newComment->validateComment($commentId);
        header('Location:/commentsManagerView');
    }

    public function deleteComment($commentId)
    {
        $this->adminAccess();
        $comment = new CommentManager;
        $comment->deleteComment($commentId);
        header('Location:/commentsManagerView');
    }

    // Users functions   
    public function usersList()
    {
        $this->adminAccess();
        $posts = new UserManager;
        $resultat = $posts->getUsers();
        echo $this->getRender()->render('usersManagerView.twig', [
            'resultat' => $resultat,
            'session' => $this->getSuperglobals()->get_SESSION()
        ]);
        //require 'App/views/backend/usersManagerView.php';
    }

    public function userForm($userId)
    {
        session_start();
        $superglobals = $this->getSuperglobals()->get_SESSION();
        if (!empty($userId) && $superglobals['id'] == $userId) {
            $user = new UserManager;
            $resultat = $user->getUser($userId);
            echo $this->getRender()->render('userAccountView.twig', [
                'resultat' => $resultat,
                'session' => $superglobals
            ]);
            //require 'App/views/backend/userAccountView.php';
        }
    }

    public function updateUser()
    {
        session_start();
        $superglobalsPost = $this->getSuperglobals()->get_POST();
        $superglobalsSession = $this->getSuperglobals()->get_SESSION();
        $errors = [];
        $superglobalsPost['id'] = $superglobalsSession['id'];

        if (isset($superglobalsPost) && !empty($superglobalsPost)) {
            $user = new UserManager;
            $resultat = $user->getUser($superglobalsSession['id']);
            if ($resultat['e_mail'] != $superglobalsPost['e_mail']) {
                $resultatEmail = $user->checkEmail($superglobalsPost['e_mail']);
                if ($resultatEmail) {
                    $titleAction = "Erreur";
                    $textConfirmation = "Le mot de passe modifé est déjà pris";
                    $actionConfirmation = "/userForm?id=" . $superglobalsSession['id'];
                    //require 'App/views/backend/confirmationTemplate.php';
                }
            }
            if ($resultat['password'] != $superglobalsPost['password']) {
                $superglobalsPost['password'] = password_hash($superglobalsPost['password'], PASSWORD_BCRYPT);;
            }
            if (empty($errors)) {
                $superglobals['password'] = password_hash($superglobalsPost['password'], PASSWORD_BCRYPT);
                $superglobals['role'] = "visiteur";
                $user->updateUser($superglobalsPost, $superglobalsSession['id']);
                $titleAction = "Confirmation d'enregistrement";
                $textConfirmation = "Vos informations ont bien été mises à jour.";
                if ($superglobalsSession['role'] = "administrateur") {
                    $actionConfirmation = "/admin";
                } else {
                    $actionConfirmation = "/home";
                }
                echo $this->getRender()->render('confirmationTemplate.twig', [
                    'titleAction' => $titleAction,
                    'actionConfirmation' => $actionConfirmation,
                    'textConfirmation' => $textConfirmation,
                    'session' => $superglobalsSession
                ]);
                //require 'App/views/backend/confirmationTemplate.php';
            } else {
                $titleAction = "Erreur";
                $actionConfirmation = "/home";
                $textConfirmation = "Problème lors de la mise à jour de vos informations.";
                echo $this->getRender()->render('confirmationTemplate.twig', [
                    'titleAction' => $titleAction,
                    'actionConfirmation' => $actionConfirmation,
                    'textConfirmation' => $textConfirmation,
                    'session' => $superglobalsSession
                ]);
                //require 'App/views/backend/confirmationTemplate.php';
            }
        }
    }

    public function deleteUser($userId)
    {
        $this->adminAccess();
        $user = new UserManager;
        $resultat = $user->deleteUser($userId);
        header('Location:/usersManagerView');
    }

    public function sendMail()
    {
        $superglobals = $this->getSuperglobals()->get_POST();
        $mail = new ContactManager;
        $mail->sendMail(
            htmlentities($superglobals['name']),
            htmlentities($superglobals['email']),
            htmlentities($superglobals['message'])
        );
        header('Location:/home');
    }

    public function errorPage()
    {
        echo $this->getRender()->render('404.twig');
    }
}
