<?php
namespace Database;

use PDO;

abstract class DbConnection
{

    /**
     * PDO instance
     *
     * @var PDO
     */
    private static $pdo;
    

    /**
     * Initialisation of the database
     *
     * @return PDO
     */
    public static function init(): PDO
    {
        $dsn  = 'mysql:dbname='.env("db_name").';charset=utf8;host='.env("db_host");
        $user = env("db_user");
        $password = env("db_password");

        return new PDO($dsn, $user, $password, [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ]);
    }

    /**
     * Get the pdo instance
     *
     * @return PDO
     */
    public static function getPdo(): PDO
    {
        return self::$pdo ?? self::init();
    }
}