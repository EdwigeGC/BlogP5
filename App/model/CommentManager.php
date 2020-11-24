<?php

namespace App\model;

use App\model\PDOManager;
use PDO;
use App\entity\Comment;
use Exception;

class CommentManager
{

    public function countComments($postId = null)
    {
        $db = new PDOManager();
        $connexion = $db->getMysqlConnexion();
        $query = $connexion->query('SELECT COUNT(id) FROM comments');
    }

    public function getComments($postId) 
    {
        $db= new PDOManager ();
        $connexion = $db->getMysqlConnexion();
        $comments= $connexion->prepare('SELECT id, author, message, status, DATE_FORMAT(date, \'%d/%m/%Y\') AS comment_date_fr FROM comment WHERE post_id = ? ORDER BY date DESC');
        $comments->execute(array($_GET['id']));

        return $comments->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createComment($param)
    {
        $db= new PDOManager ();
        try {
            $connexion = $db->getMysqlConnexion();
            $datas= $connexion ->prepare('INSERT INTO comment  SET author = :author, message = :message, status = :status, date = NOW(), post_id= :post_id ');
            return $datas->execute($param);
        }
        catch (Exception $e) {
            dump($e);die;
        }  
    }
    public function adminComments(){
        $db= new PDOManager ();
        $connexion = $db->getMysqlConnexion();
        $query= $connexion->query('SELECT id, author, message, DATE_FORMAT(date, \'%d/%m/%Y\') AS comment_date_fr, post_id FROM comment WHERE status= "waiting" ORDER BY date');
        $query->execute();
       
        return $query->fetchAll(PDO::FETCH_ASSOC);

    }

    public function deleteComments($post_id)
    {
        $db= new PDOManager ();
        $connexion = $db->getMysqlConnexion();
        $query = $connexion->prepare('DELETE FROM comment WHERE post_id = ? ');
     
        $query->execute(array($_GET['id']));
    }

    public function deleteComment()
    {
        $db= new PDOManager ();
        $connexion = $db->getMysqlConnexion();
        $query = $connexion->prepare('DELETE FROM comment WHERE id = ? ');
        $query->execute(array($_GET['id']));
    }

    public function publishComment()
    {
        $db= new PDOManager ();
        try {
            $connexion = $db->getMysqlConnexion();
            $datas= $connexion ->prepare('UPDATE comment SET status= "agreed" WHERE id= ?');
            $datas->execute(array($_GET['id']));
        }
        catch (Exception $e) {
            dump($e);die;
        }
    }

}