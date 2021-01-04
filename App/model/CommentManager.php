<?php

namespace App\model;

use App\model\PDOManager;
use App\entity\Comment;
use PDO;

class CommentManager
{
    public function getComments($postId)
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

    public function createComment($param)
    {
        $database = new PDOManager();
        $connexion = $database->getMysqlConnexion();
        $datas = $connexion->prepare('INSERT INTO comment  SET author = :author, message = :message, status = :status, date = NOW(), post_id= :post_id ');
        $datas->execute($param);
    }

    public function adminComments()
    {
        $database = new PDOManager();
        $connexion = $database->getMysqlConnexion();
        $query = $connexion->query('SELECT id, author, message, DATE_FORMAT(date, \'%d/%m/%Y\') AS comment_date_fr, post_id FROM comment WHERE status= "waiting" ORDER BY date');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteComments($postId)
    {
        $database = new PDOManager();
        $connexion = $database->getMysqlConnexion();
        $query = $connexion->prepare('DELETE FROM comment WHERE post_id = ? ');
        $query->execute(array($postId));
    }

    public function deleteComment($commentId)
    {
        $database = new PDOManager();
        $connexion = $database->getMysqlConnexion();
        $query = $connexion->prepare('DELETE FROM comment WHERE id = ?');
        $query->execute(array($commentId));
    }

    public function validateComment($commentId)
    {
        $database = new PDOManager();
        $connexion = $database->getMysqlConnexion();
        $comment = $connexion->prepare('UPDATE comment SET status= "agreed" WHERE id= ?');
        $comment->execute(array($commentId));
    }
}
