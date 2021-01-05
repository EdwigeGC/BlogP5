<?php

namespace App\model;

use App\utilities\DatabaseConstant;
/**
 * Connection to database
 */
class PDOManager
{
    /**
     * Connection to MySQL and manage Exceptions
     *
     * @return PDO
     */
    public static function getMysqlConnexion()
    {
        try{
            $database = new \PDO('mysql:host=' .DatabaseConstant::HOST.';dbname='.DatabaseConstant::DBNAME.';', DatabaseConstant::USER , DatabaseConstant::PASS);
            $database->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $database->exec("SET NAMES UTF8");
        } catch (\Exception $e) {
            dump($e);die;
        }
        return $database;
    }
}
