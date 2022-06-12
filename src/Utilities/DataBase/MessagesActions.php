<?php

namespace PonyExpress\Utilities\DataBase;

use PDO;
use PDOException;

class MessagesActions
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

        if (isset($number) and $number !== 'undefined' and !empty($number))
            $stmt->bindParam(":number", $number);
        if (isset($text) and $text !== 'undefined' and !empty($text))
            $stmt->bindParam(":text", $text);
        if (isset($provider) and $provider !== 'undefined' and !empty($provider))
            $stmt->bindParam(":provider", $provider);
        if (isset($status) and $status !== 'undefined' and !empty($status))
            $stmt->bindParam(":status", $status);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}