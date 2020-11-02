<?php

namespace App\entity;

class PDOManager
{
    public static function getMysqlConnexion()
    {

        try {
            $db = new \PDO('mysql:host=localhost;dbname=EG_blog;', 'root', 'root');
            $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $db->exec("SET NAMES UTF8");
       } catch (\PDOException $e) {
            echo (new \PDOException($e->getMessage(), (int)$e->getCode()));
       }
        return $db;
    }
}