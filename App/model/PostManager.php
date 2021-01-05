<?php

namespace App\model;

use App\model\PDOManager;
use App\entity\Post;
use PDO;
use Exception;

class PostManager
{
    /**
     * Function used to get posts'list that can be read by everyone
     *
     * @param integer $limit can limit the number of posts on a page
     * @return array|null list of published posts only (list of several Post objects)
     */
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

    /**
     * Function used to get posts'list that can be read by administrator only
     *
     * @return array|null list of Post objects
     */
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

    /**
     * Function used to get a post'details that can be read by everyone
     *
     * @param integer $postId
     * @return object|null new Post object beforehand validated by administrator and identified with its Id number
     */
    public function getPost($postId)
    {
        $database = new PDOManager();
        $connexion = $database->getMysqlConnexion();
        $query = $connexion->prepare('SELECT * FROM post WHERE published= "Publié" AND id = ? ');
        $query->execute(array($postId));
        $value=$query-> fetch();
        return !empty($value) ? new Post($value) : null;   
    }

    /**
     * Function used to get a post'details that can be read by administrator only
     *
     * @param  integer $postId
     * @return object|null new Post object identified with its Id number
     */
    public function getPostAdmin($postId)
    {
        $database = new PDOManager();
        $connexion = $database->getMysqlConnexion();
        $query = $connexion->prepare('SELECT * FROM post WHERE id = ? ');
        $query->execute(array($postId));
        $value=$query-> fetch();
        return !empty($value) ? new Post($value) : null; 
    }

    /**
     * Function used by administrator to add a new post to database
     *
     * @param array $param new post's parameters
     * @return boolean
     */
    public function createPost($param)
    {
        $database = new PDOManager();
        unset($param['id']);
        $connexion = $database->getMysqlConnexion();
        $data = $connexion->prepare('INSERT INTO post (author, title, chapo, content, creation_date, published) VALUES(:author, :title, :chapo, :content, NOW(), :published)');
        return $data->execute($param);        
    }

    /**
     * Function used by administrator to modify a post's details
     *
     * @param mixed $param identified post's parameters
     */
    public function updatePost($param)
    {
        $database = new PDOManager();
        $connexion = $database->getMysqlConnexion();
        $post= new Post($param);
        $post = $connexion->prepare('UPDATE post SET author= :author, title= :title, chapo= :chapo, content= :content, published= :published, modification_date= NOW() WHERE id=:id');
        $post->execute($param);
    }

    /**
     * Function used by administrator to delete a post in database
     *
     * @param integer $postId
     */
    public function deletePost($postId)
    {
        $database = new PDOManager();
        $connexion = $database->getMysqlConnexion();
        $query = $connexion->prepare('DELETE FROM post WHERE id = ? ');
        $query->execute(array($postId));
    }
}
