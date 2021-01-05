<?php

namespace App\model;

use App\model\PDOManager;
use App\entity\User;
use PDO;
use Exception;

/**
 * Class for users management
 */
class UserManager
{
    /**
     * Function used to check if user exists with this login in database
     *
     * @param string $login login to check
     * @return array user's value if login exists in database or nothing if it doesn't exist
     */
    public function checkLogin(string $login)
    {
        $database = new PDOManager();
        $connexion = $database->getMysqlConnexion();
        $query = $connexion->prepare('SELECT * FROM user WHERE login = :login');
        $query->execute(array(
            'login' => $login
        ));
        return $query->fetch();
    }

    /**
     * Function used to check if user exists with this Email in database
     *
     * @param string $eMail Email to check
     * @return array user's value if login exists in database or nothing if it doesn't exist
     */
    public function checkEmail(string $eMail)
    {
        $database = new PDOManager();
        $connexion = $database->getMysqlConnexion();
        $query = $connexion->prepare('SELECT * FROM user WHERE e_mail = :email');
        $query->execute(array(
            'email' => $eMail
        ));
        return $query->fetch();
    }

    /**
     * Function used to get the list of all the users
     *
     * @return array list of users and their values
     */
    public function getUsers()
    {
        $database = new PDOManager();
        $connexion = $database->getMysqlConnexion();
        $query = $connexion->query('SELECT * FROM user');
        $query->execute();
        $value= $query->fetchAll(PDO::FETCH_ASSOC);
        if(!empty($value)){
            $list=[];
            foreach($value as $tab){
                $list[]=new User($tab);
            }
            return $list;
        }
    }

    /**
     * Function used to get values of one user
     *
     * @param integer $userId id of this user
     * @return object|null list of user's values
     */
    public function getUser(int $userId)
    {
        $database = new PDOManager();
        $connexion = $database->getMysqlConnexion();
        $query = $connexion->prepare('SELECT * FROM user WHERE id = ?');
        $query->execute(array($userId));
        $value=$query-> fetch();
        return !empty($value) ? new User($value) : null;   
    }
    /**
     * Function used to add a user in database
     *
     * @param mixed $param parameter of the user
     */
    public function createUser($param)
    {
        $database = new PDOManager();
        $connexion = $database->getMysqlConnexion();
        $datas = $connexion->prepare('INSERT INTO user SET e_mail= :e_mail, login= :login, password= :password, role= :role ');
        $datas->execute($param);
    }

    /**
     * Function used to record changes of user's values
     *
     * @param mixed $param parameters of the user
     */
    public function updateUser($param)
    {
        $database = new PDOManager();
        $connexion = $database->getMysqlConnexion();
        $datas = $connexion->prepare('UPDATE user SET e_mail= :email, password= :password WHERE id=:id');
        $datas->execute($param);
    }

    /**
     * Function used to delete a user from the database
     *
     * @param integer $userId Id of this user
     */
    public function deleteUser(int $userId)
    {
        $database = new PDOManager();
        $connexion = $database->getMysqlConnexion();
        $query = $connexion->prepare('DELETE FROM user WHERE id = ? ');
        $query->execute(array($userId));
    }
}
