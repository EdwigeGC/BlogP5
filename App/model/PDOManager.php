<?php

namespace App\model;

class PDOManager
{
    public static function getMysqlConnexion()
    {
            $db = new \PDO('mysql:host=localhost;dbname=EG_blog;', 'root', 'root');
            $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $db->exec("SET NAMES UTF8");
            return $db;
    }
}