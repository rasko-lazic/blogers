<?php

namespace Core;

use PDO;

class Database {

    private static $instance = null;

    public $pdo;

    private function __construct()
    {

        $config = parse_ini_file('config.ini');

        $name = $config['db_name'];
        $host = $config['db_host'];
        $user = $config['db_user'];
        $password = $config['db_password'];

        $dsn = "mysql:host=$host;dbname=$name;charset=utf8mb4";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_ORACLE_NULLS => PDO::NULL_EMPTY_STRING,
            PDO::ATTR_EMULATE_PREPARES => false,
            // Necessary to avoid false negatives if update hasn't actually changed data,
            // but it has matched with a valid row in database
            PDO::MYSQL_ATTR_FOUND_ROWS => true
        ];
        try {
            $this->pdo = new PDO($dsn, $user, $password, $options);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new Database();
        }

        return self::$instance->pdo;
    }
}