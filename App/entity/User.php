<?php

namespace App\entity;

/**
 * Class represents a user
 */
class User
{
    /**
     * @var integer $id user's id
     */
    private $id;
    /**
     * @var string $email user's email
     */
    private $email;
    /**
     * @var string $login user's login
     */
    private $login;
    /**
     * @var string $password user's password
     */
    private $password;
    /**
     * @var string $role in order to identify user authorization
     */
    private $role;
    

    /**
     * Constructor of user object
     *
     * @param mixed $param
     */
    public function __construct($param)
    {

        $this->setId($param['id']);
        $this->setEmail($param['e_mail']);
        $this->setLogin($param['login']);
        $this->setPassword($param['password']);
        $this->setRole($param['role']);
    }

    /**
     * Setter for id property
     *
     * @param int $id user's Id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * Setter for Email property
     *
     * @param string $email user's Email adress
     */
    public function setEmail(string $email)
    {
        if(is_string($email) || !empty($email))
        {
            $this->email = $email;
        }
    }

    /**
     * Setter for login property
     *
     * @param string $login user's login
     */
    public function setLogin(string $login)
    {
        if(is_string($login) || !empty($login))
        {
        $this->login = $login;
        }
       
    }

    /**
     * Setter for password property
     *
     * @param string $password user's password
     */
    public function setPassword(string $password)
    {
        if(is_string($password) || !empty($password))
        {
        $this->password = $password;
        }
    }

    /**
     * Setter for role property
     *
     * @param string $role user's role
     */
    public function setRole(string $role)
    {
        if(is_string($role) || !empty($role))
        {
        $this->role = $role;
        }
    }

    /**
     * Getter for Id
     *
     * @return int user's Id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Getter for Email
     *
     * @return string Email adresse of the user
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Getter for login
     *
     * @return string user's login
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Getter for password
     *
     * @return string user's password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Getter for role
     *
     * @return string user's role
     */
    public function getRole()
    {
        return $this->role;
    }

}
