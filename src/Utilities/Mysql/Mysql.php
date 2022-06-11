<?php

namespace PonyExpress\Utilities\Mysql;

use PDO;
use PDOException;

class Mysql
{
    private PDO|null $connection;

    public function __construct()
    {
        try {
            $this->connection = new PDO("mysql:host=127.0.0.1;dbname=PonyExpress", 'root', 'qazQAZ12++');
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $PDOException) {
            echo $PDOException->getMessage().PHP_EOL;
        }
    }

    public function __destruct()
    {
        $this->connection = null;
    }

    public function store(string $number, string $text, string $provider, string $status)
    {
        $stmt = $this->connection->prepare("INSERT INTO Messages (number, text, provider, status) VALUES (:number, :text, :provider, :status)");
        $stmt->bindParam(":number", $number);
        $stmt->bindParam(":text", $text);
        $stmt->bindParam(":provider", $provider);
        $stmt->bindParam(":status", $status);
        $stmt->execute();
    }
}