<?php

namespace App\model;

use App\model\PDOManager;
use App\entity\Post;
use PDO;
use Exception;

class PostManager
{
    public function getPosts($limit)
    {
        $database = new PDOManager();
        $connexion = $database->getMysqlConnexion();
        $query = $connexion->query('SELECT * FROM post WHERE published= "Publié" ORDER BY creation_date DESC LIMIT ' . $limit);
        $query->execute();
        $value = $query-> fetchAll(PDO::FETCH_ASSOC);
        if(!empty($value)){
            $list=[];
            foreach($value as $tab){
                $list[]=new Post($tab);
            }
            return $list;
        }
        else{
            return null;
        }
    }

    public function getPostsAdmin()
    {
        $database = new PDOManager();
        $connexion = $database->getMysqlConnexion();
        $query = $connexion->query('SELECT * FROM post ORDER BY creation_date DESC');
        $query->execute();
        $value= $query->fetchAll(PDO::FETCH_ASSOC);
        if(!empty($value)){
            $list=[];
            foreach($value as $tab){
                $list[]=new Post($tab);
            }
            return $list;
        }
        else{
            return null;
        }
    }

    public function getPost($postId)
    {
        $database = new PDOManager();
        $connexion = $database->getMysqlConnexion();
        $query = $connexion->prepare('SELECT * FROM post WHERE published= "Publié" AND id = ? ');
        $query->execute(array($postId));
        $value=$query-> fetch();
        return !empty($value) ? new Post($value) : null;   
    }

    public function getPostAdmin($postId)
    {
        $database = new PDOManager();
        $connexion = $database->getMysqlConnexion();
        $query = $connexion->prepare('SELECT * FROM post WHERE id = ? ');
        $query->execute(array($postId));
        $value=$query-> fetch();
        return !empty($value) ? new Post($value) : null; 
    }

    public function createPost($param)
    {
        $database = new PDOManager();
        unset($param['id']);
        $connexion = $database->getMysqlConnexion();
        $post= new Post($param);
        $post = $connexion->prepare('INSERT INTO post (author, title, chapo, content, creation_date, published) VALUES(:author, :title, :chapo, :content, NOW(), :published)');
        $post->execute($param);
    }

    public function updatePost($param)
    {
        $database = new PDOManager();
        $connexion = $database->getMysqlConnexion();
        $post= new Post($param);
        $post = $connexion->prepare('UPDATE post SET author= :author, title= :title, chapo= :chapo, content= :content, published= :published, modification_date= NOW() WHERE id=:id');
        $post->execute($param);
    }

    public function deletePost($postId)
    {
        $database = new PDOManager();
        $connexion = $database->getMysqlConnexion();
        $query = $connexion->prepare('DELETE FROM post WHERE id = ? ');
        $query->execute(array($postId));
    }
}
