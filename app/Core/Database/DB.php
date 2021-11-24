<?php

declare(strict_types=1);


namespace App\Core\Database;


//use PDO;

class DB
{

    protected static $instance;

    protected function __construct()
    {
    }

    public static function getInstance()
    {
        if (empty(self::$instance)) {
            $db_info = array(
                "db_host" => getenv('DB_HOST'),
                "db_port" => "3306",
                "db_user" => getenv('DB_USER'),
                "db_pass" => getenv('DB_PASS'),
                "db_name" => getenv('DB_NAME'),
                "db_charset" => "UTF-8"
            );

            try {
                self::$instance = new \PDO(
                    "mysql:host=" . $db_info['db_host'] . ';port=' . $db_info['db_port'] . ';dbname=' . $db_info['db_name'],
                    $db_info['db_user'],
                    $db_info['db_pass']
                );
                //self::$instance->setAttribute(\PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
                self::$instance->query('SET NAMES utf8');
                self::$instance->query('SET CHARACTER SET utf8');
            } catch (\PDOException $error) {
                echo $error->getMessage();
            }
        }

        return self::$instance;
    }

    public static function setCharsetEncoding()
    {
        if (self::$instance == null) {
            self::connect();
        }

        self::$instance->exec(
            "SET NAMES 'utf8';
			SET character_set_connection=utf8;
			SET character_set_client=utf8;
			SET character_set_results=utf8"
        );
    }

}
