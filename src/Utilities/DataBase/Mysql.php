<?php

namespace PonyExpress\Utilities\DataBase;

use PDO;
use PDOException;

class Mysql
{
    private PDO|null $connection;

    public function __construct()
    {
        try {
            $this->connection = new PDO("mysql:host=".$_ENV['MYSQL_HOST'].";dbname=".$_ENV['MYSQL_DB'], $_ENV['MYSQL_USER'], $_ENV['MYSQL_PASS']);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $PDOException) {
            echo $PDOException->getMessage().PHP_EOL;
        }
    }

    public function __destruct()
    {
        $this->connection = null;
    }
}