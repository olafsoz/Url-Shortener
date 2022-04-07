<?php

namespace App;

use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Exception;

class Database
{
    private static $connection = null;

    public static function connection()
    {
        if(self::$connection === null)
        {
            $connectionParams = [
                'dbname' => $_ENV['DBNAME'],
                'user' => $_ENV['USER'],
                'password' => $_ENV['PASSWORD'],
                'host' => $_ENV['HOST'],
                'driver' => $_ENV['DRIVER'],
            ];
            try {
                self::$connection = DriverManager::getConnection($connectionParams);
            } catch (Exception $e) {
                return $e->getMessage();
            }
        }
        return self::$connection;
    }
}