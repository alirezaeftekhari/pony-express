<?php

namespace PonyExpress\Utilities\Mysql;

use PDO;
use PDOException;

class Mysql
{
    private PDO|null $connection;

    public function __construct()
    {
        $host = $_ENV['MYSQL_HOST'];
        $db = $_ENV['MYSQL_DB'];
        $user = $_ENV['MYSQL_USER'];
        $pass = $_ENV['MYSQL_PASS'];

        try {
            $this->connection = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
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

    public function read(string $sql, mixed $number, mixed $text, mixed $provider, mixed $status): array
    {
        $stmt = $this->connection->prepare($sql);

        if (isset($number) and $number !== 'undefined')
            $stmt->bindParam(":number", $number);
        if (isset($text) and $text !== 'undefined')
            $stmt->bindParam(":text", $text);
        if (isset($provider) and $provider !== 'undefined')
            $stmt->bindParam(":provider", $provider);
        if (isset($status) and $status !== 'undefined')
            $stmt->bindParam(":status", $status);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}