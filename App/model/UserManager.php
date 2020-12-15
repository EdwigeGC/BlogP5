<?php

namespace App\model; 

use App\model\PDOManager;
use PDO;
use Exception;

class UserManager
{
    public function checkLogin($login)
    {
        $database = new PDOManager();
        $connexion = $database->getMysqlConnexion();
        $query = $connexion->prepare('SELECT * FROM user WHERE login = :login');
        $query->execute(array(
            'login' => $login));
        return $query->fetch();
    }

    public function checkEmail($eMail)
    {
        $database = new PDOManager();
        $connexion = $database->getMysqlConnexion();
        $query = $connexion->prepare('SELECT * FROM user WHERE e_mail = :e_mail') ;
        $query->execute(array(
            'e_mail' => $eMail));
       
        return $query->fetch(); 
    }

    public function getUsers()
    {
        $database = new PDOManager();
        $connexion = $database->getMysqlConnexion();
        $query = $connexion->query('SELECT * FROM user') ;
        $query->execute();
       
        return $query->fetchAll(PDO::FETCH_ASSOC); 
    }

    public function getUser($userId) 
    {
        $database= new PDOManager ();
        $connexion = $database->getMysqlConnexion();
        $query = $connexion->prepare('SELECT * FROM user WHERE id = ?');
        $query->execute(array($userId));

        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function createUser($param)
    {
        $database= new PDOManager ();
        $connexion = $database->getMysqlConnexion();
        $datas= $connexion ->prepare('INSERT INTO user SET e_mail= :e_mail, login= :login, password= :password, role= :role ');
        $datas->execute($param);
    }

    public function updateUser($param)
    {
        $database= new PDOManager ();
        $connexion = $database->getMysqlConnexion();
        $datas= $connexion ->prepare('UPDATE user SET e_mail= :e_mail, password= :password WHERE id=:id');
        $datas->execute($param);
    }

    public function deleteUser($userId)
    {
        $database= new PDOManager ();
        $connexion = $database->getMysqlConnexion();
        $query = $connexion->prepare('DELETE FROM user WHERE id = ? ');
        $query->execute(array($userId));
    }

}