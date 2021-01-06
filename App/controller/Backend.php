<?php

namespace App\controller;

use App\model\PostManager;
use App\model\CommentManager;
use App\model\UserManager;
use App\utilities\ContactConfiguration;
use App\entity\User;

/**
 * Groups all the functions used in backend side
 */
class Backend extends AbstractController
{

    /**
     * Function which authorize access to administration functions to administrator only
     *
     */
    public function adminAccess()
    {
        session_start();
        $superglobals = $this->getSuperglobals()->get_SESSION();
        if (isset($superglobals['id']) && $superglobals['role'] == "administrateur") {
            return true;
        }
        else {
            header('Location:/forbidden');
        }
    }

    /**
     * Administration page: display list of all the posts created
     * 
     */
    public function admin()
    {
        if ($this->adminAccess()){
            $posts = new PostManager;
            $postsList = $posts->getPostsAdmin();
            echo $this->getRender()->render('admin.twig', [
                'posts' => $postsList,
                'session' => $this->getSuperglobals()->get_SESSION()
            ]);
        }
    }

    // Posts functions

    /**
     * Display the form to edit a post
     *
     * @param int $postId
     */
    public function updatePostForm(int $postId)
    {
        if($this->adminAccess()){
            $post = new PostManager;
            $resultat = $post->getPostAdmin($postId);
            $comment = new CommentManager;
            $commentList = $comment->getComments($postId);
            $commentAgreed = [];
            foreach ($commentList as $key => $value) {
                if ($commentList[$key]['status'] === 'agreed') {
                    $commentAgreed[] = $value;
                }
            }
            $subtitle = "Modifier l'article";
            $action = '/updatePost';
            echo $this->getRender()->render('postTemplate.twig', [
                'post' => $resultat,
                'comments' => $commentAgreed,
                'subtitle' => $subtitle,
                'action' => $action,
                'session' => $this->getSuperglobals()->get_SESSION()
            ]);
        }
    }

    /**
     * Function used to save post's changes required by the administrator
     *
     */
    public function updatePost()
    {
        if ($this->adminAccess()){
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
        }
    }

    /**
     * Display the form to add a post
     *
     */
    public function addPostForm()
    {
        if ($this->adminAccess()){
            $posts = new PostManager;
            $subtitle = "Ajouter un article";
            $action = '/addPost';
            echo $this->getRender()->render('postTemplate.twig', [
                'posts' => $posts,
                'subtitle' => $subtitle,
                'action' => $action,
                'session' => $this->getSuperglobals()->get_SESSION()
            ]);
        }
    }

    /**
     * Function used to save new post recorded by the administrator
     *
     */
    public function addPost()
    {
        if ($this->adminAccess()){
            $superglobals = $this->getSuperglobals()->get_POST();
            if (!empty($superglobals) && isset($superglobals)) {
                $newPost = new PostManager;
                $isCreated = $newPost->createPost($superglobals);
                $subtitle = "Ajouter un article";
                if ($isCreated) {
                    $success = "L'article a bien été ajouté";
                    echo $this->getRender()->render('postTemplate.twig', [
                        'message' => $success,
                        'subtitle' => $subtitle,
                        'class' => 'alert-success'
                    ]);
                } else {
                    $error = "Erreur";
                    echo $this->getRender()->render('postTemplate.twig', [
                        'message' => $error,
                        'subtitle' => $subtitle,
                        'class' => 'alert-danger'
                    ]);
                }
            }
        }
    }

    /**
     * Function used to delete a post
     *
     * @param int $postId
     */
    public function deletePost(int $postId)
    {
        if ($this->adminAccess()){
            $post = new PostManager;
            $post->deletePost($postId);
            $comment = new CommentManager;
            $comment->deleteComments($postId);
            header('Location:/admin');
        }
    }

    // Comments functions

    /**
     * Display comments list to validate/delete by administrator before publishing them
     *
     */
    public function adminCommentsList()
    {
        if ($this->adminAccess()){
            $comments = new CommentManager;
            $resultat = $comments->adminComments();
            echo $this->getRender()->render('commentsManagerView.twig', [
                'resultat' => $resultat,
                'session' => $this->getSuperglobals()->get_SESSION()
            ]);
        }
    }

    /**
     * Function used to agreed a comment's post
     *
     * @param int $commentId
     */
    public function validateComment(int $commentId)
    {
        if ($this->adminAccess()){
            $newComment = new CommentManager;
            $newComment->validateComment($commentId);
            header('Location:/commentsManagerView');
        }
    }

    /**
     * Function used to delete a comment
     *
     * @param integer $commentId
     */
    public function deleteComment(int $commentId)
    {
        if ($this->adminAccess()){
            $comment = new CommentManager;
            $comment->deleteComment($commentId);
            header('Location:/commentsManagerView');
        }
    }

    // Users functions   

    /**
     * Display the list of all users account.
     *
     */
    public function usersList()
    {
        if ($this->adminAccess()){
            $posts = new UserManager;
            $resultat = $posts->getUsers();
            echo $this->getRender()->render('usersManagerView.twig', [
                'resultat' => $resultat,
                'session' => $this->getSuperglobals()->get_SESSION()
            ]);
        }
    }

    /**
     * Display the form to edit user's information. Each one can access to his own information.
     *
     * @param int $userId
     */
    public function userForm(int $userId)
    {
        session_start();
        $superglobals = $this->getSuperglobals()->get_SESSION();
        if (!empty($userId) && $superglobals['id'] == $userId) {
            $user = new UserManager;
            $resultat = $user->getUser($userId);
            if ($superglobals['role'] == 'administrateur'){
                $template='templateBackend.twig';
            }
            else if ($superglobals['role'] == 'visiteur'){
                $template='templateFrontend.twig';
            }
            echo $this->getRender()->render('userAccountView.twig', [
                'template'=> $template,
                'resultat' => $resultat,
                'session' => $superglobals
            ]);
        }
    }

    /**
     * Function used to save user's information change
     *
     */
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
            if ($resultat->getEmail() != $superglobalsPost['email']) {
                $resultatEmail = $user->checkEmail($superglobalsPost['email']);
                if (!empty($resultatEmail)) {
                    $errors['email']='Email déjà utilisé';
                    $titleAction = "Erreur";
                    $textConfirmation = "L'E-mail modifé est déjà utilisé par un autre compte";
                    $actionConfirmation = "/userForm?id=" . $superglobalsSession['id'];
                }
            }
            if ($resultat->getPassword() != $superglobalsPost['password']) {
                $superglobalsPost['password'] = password_hash($superglobalsPost['password'], PASSWORD_BCRYPT);;
            }
            if (empty($errors)) {
                $superglobals['password'] = password_hash($superglobalsPost['password'], PASSWORD_BCRYPT);
                $superglobals['role'] = "visiteur";
                $user->updateUser($superglobalsPost, $superglobalsSession['id']);
                $titleAction = "Confirmation d'enregistrement";
                $textConfirmation = "Vos informations ont bien été mises à jour.";
                if ($superglobalsSession['role'] == "administrateur") {
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
            }
        }
}

    /**
     * Function used to delete a user account
     *
     * @param int $userId
     */
    public function deleteUser(int $userId)
    {
        if ($this->adminAccess()){
            $user = new UserManager;
            $resultat = $user->deleteUser($userId);
            header('Location:/usersManagerView');
        }
    }

    // Contact form functions

    /**
     * Function used to get datas from the contact form
     *
     */
    public function sendMail()
    {
        $superglobals = $this->getSuperglobals()->get_POST();
        $mail = new ContactConfiguration;
        $mail->sendMail(
            htmlentities($superglobals['name']),
            htmlentities($superglobals['email']),
            htmlentities($superglobals['message'])
        );
        header('Location:/home');
    }

    /**
     * Function used to redirect browser to 404 page when requested file is not found 
     */
    public function errorPage()
    {
        echo $this->getRender()->render('404.twig');
    }

    public function forbidden()
    {
        echo $this->getRender()->render('403.twig');
    }
}
