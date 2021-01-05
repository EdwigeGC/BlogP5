<?php

namespace App\model;

use App\model\PDOManager;
use App\entity\Comment;
use PDO;

/**
 * Class for comments management
 */
class CommentManager
{
    /**
     * Function used to collect validated comments thanks to post's id
     *
     * @param int $postId the id of the post linked to comments
     * @return array|null list of validated comments or nothing if there is no comments linked to the post Id
     */
    public function getComments(int $postId)
    {
        $database = new PDOManager();
        $connexion = $database->getMysqlConnexion();
        $comments = $connexion->prepare('SELECT * FROM comment WHERE post_id = ? && status="agreed" ORDER BY date DESC');
        $comments->execute(array($postId));
        $value= $comments->fetchAll(PDO::FETCH_ASSOC);
        if(!empty($value)){
            $list=[];
            foreach($value as $tab){
                $list[]=new Comment($tab);
            }
            return $list;
        }
        else{
            return null;
        }
    }

    /**
     * Function used to add a comment in the database
     *
     * @param mixed $param parameters of a comment
     */
    public function createComment($param)
    {
        $database = new PDOManager();
        $connexion = $database->getMysqlConnexion();
        $comment= $connexion->prepare('INSERT INTO comment  SET author = :author, message = :message, status = :status, date = NOW(), post_id= :post_id ');
        $comment->execute($param);
    }

    /**
     * Function to collect pending comments for administration side in order to validate or delete them
     *
     * @return array|null list of pending comments or nothing if there is no comments with status= "waiting"
     */
    public function adminComments()
    {
        $database = new PDOManager();
        $connexion = $database->getMysqlConnexion();
        $query = $connexion->query('SELECT * FROM comment WHERE status= "waiting" ORDER BY date');
        $query->execute();
        $value= $query->fetchAll(PDO::FETCH_ASSOC);
        if(!empty($value)){
            $list=[];
            foreach($value as $tab){
                $list[]=new Comment($tab);
            }
            return $list;
        }
        else{
            return null;
        }
    }

    /**
     * Function used to delete all the comments linked to a postId from the database.
     *
     * @param int $postId the id of the post linked to comments
     */
    public function deleteComments(int $postId)
    {
        $database = new PDOManager();
        $connexion = $database->getMysqlConnexion();
        $query = $connexion->prepare('DELETE FROM comment WHERE post_id = ? ');
        $query->execute(array($postId));
    }

    /**
     * Function used to delete one comment thanks to its id
     *
     * @param int $commentId the Id of the comment to delete
     */
    public function deleteComment(int $commentId)
    {
        $database = new PDOManager();
        $connexion = $database->getMysqlConnexion();
        $query = $connexion->prepare('DELETE FROM comment WHERE id = ?');
        $query->execute(array($commentId));
    }

    /**
     * Function used to validate and published a pending comment
     *
     * @param int $commentId the Id of the comment to validate
     */
    public function validateComment(int $commentId)
    {
        $database = new PDOManager();
        $connexion = $database->getMysqlConnexion();
        $comment = $connexion->prepare('UPDATE comment SET status= "agreed" WHERE id= ?');
        $comment->execute(array($commentId));
    }
}
