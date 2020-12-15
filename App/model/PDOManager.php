<?php

namespace App\model;

class PDOManager
{
    public static function getMysqlConnexion()
    {
        $database = new \PDO('mysql:host=localhost;dbname=EG_blog;', 'root', 'root');
        $database->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $database->exec("SET NAMES UTF8");
        return $database;
    }
}
