<?php

namespace App\model;

use App\model\PDOManager;
use PDO;
use App\entity\Post;
use Exception;

class PostManager
{
    public function getPosts($limit)
    {
        $db = new PDOManager();
        $connexion = $db->getMysqlConnexion();
        $query = $connexion->query('SELECT id, title, chapo, content, file, DATE_FORMAT(creation_date, \'%d/%m/%Y\') AS creation_date_fr, DATE_FORMAT(modification_date, \'%d/%m/%Y\') AS modification_date_fr FROM post WHERE published= 1 ORDER BY creation_date DESC LIMIT ' . $limit) ;
        $query->execute();
       
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getPostsAdmin()
    {
        $db = new PDOManager();
        $connexion = $db->getMysqlConnexion();
        $query = $connexion->query('SELECT id, title, chapo, content, file, DATE_FORMAT(creation_date, \'%d/%m/%Y\') AS creation_date_fr, DATE_FORMAT(modification_date, \'%d/%m/%Y\') AS modification_date_fr FROM post WHERE published= 1 ORDER BY creation_date DESC') ;
        $query->execute();
       
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPost($postId) 
    {
        $db= new PDOManager ();
        $connexion = $db->getMysqlConnexion();
        $query = $connexion->prepare('SELECT id, title, chapo, content, author, file, DATE_FORMAT(creation_date, \'%d/%m/%Y\') AS creation_date_fr, DATE_FORMAT(modification_date, \'%d/%m/%Y\') AS modification_date_fr FROM post WHERE published= 1 AND id = ? ');
        $query->execute(array($_GET['id']));

        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getPostAdmin($postId) 
    {
        $db= new PDOManager ();
        $connexion = $db->getMysqlConnexion();
        $query = $connexion->prepare('SELECT id, title, chapo, content, author, file, published, DATE_FORMAT(creation_date, \'%d/%m/%Y\') AS creation_date_fr, DATE_FORMAT(modification_date, \'%d/%m/%Y\') AS modification_date_fr FROM post WHERE id = ? ');
        $query->execute(array($_GET['id']));

        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function createPost($param)
    {
        $db= new PDOManager ();
        try {
            unset($param['id']);
            $connexion = $db->getMysqlConnexion();
            $datas= $connexion ->prepare('INSERT INTO post (author, title, chapo, content, creation_date, published) VALUES(:author, :title, :chapo, :content, NOW(), :published)');
            $datas->execute($param);
        }
        catch (Exception $e) {
            dump($e);die;
        }  
    }

    public function updatePost($param)
    {
        $db= new PDOManager ();
        try {
            $connexion = $db->getMysqlConnexion();
            $datas= $connexion ->prepare('UPDATE post SET author= :author, title= :title, chapo= :chapo, content= :content, published= :published, modification_date= NOW() WHERE id=:id');
            $datas->execute($param);
        }
        catch (Exception $e) {
            dump($e);die;
        }
    }

    public function deletePost()
    {
        $db= new PDOManager ();
        $connexion = $db->getMysqlConnexion();
        $query = $connexion->prepare('DELETE FROM post WHERE id = ? ');
        $query->execute(array($_GET['id']));
    }

    
    
}