<?php

namespace App\model;

use App\entity\PDOManager;
use PDO;
use App\entity\Post;

class PostManager
{

    public function getPosts($limit)
    {
        $db = new PDOManager();
        $connexion = $db->getMysqlConnexion();
        $query = $connexion->query('SELECT id, title,chapo, content, category, file FROM post ORDER BY date DESC LIMIT ' . $limit);
        $query->execute();
       
        return $query->fetchAll(PDO::FETCH_ASSOC);
 
    }

    public function getPost($postId) //selection d'un post grâce à l'id (pour details post et modif post)
    {
        $db= new PDOManager ();
        $connexion = $db->getMysqlConnexion();
        $query = $connexion->prepare('SELECT id, author, chapo, content, DATE_FORMAT(date, "%d/%m/%Y à %Hh%imin%ss") FROM post WHERE id = ? ');
        $query->execute(array($postId));

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createPost()
    {
        ;
    }

    public function updatePost()
    {
        ;
    }

    public function deletePost()
    {
        ;
    }

    
}