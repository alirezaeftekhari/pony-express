<?php

namespace PonyExpress\Utilities\DataBase;

use PDO;
use PDOException;


class UserActions
{
    private PDO|null $connection;

    /**
     * UserActions __construct.
     */
    public function __construct()
    {
        try {
            $this->connection = new PDO("mysql:host=".$_ENV['MYSQL_HOST'].";dbname=".$_ENV['MYSQL_DB'], $_ENV['MYSQL_USER'], $_ENV['MYSQL_PASS']);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $PDOException) {
            echo $PDOException->getMessage().PHP_EOL;
        }
    }

    /**
     * UserActions __destruct.
     */
    public function __destruct()
    {
        $this->connection = null;
    }

    /**
     * UserActions getUserByUserName.
     * @param string $username
     * @return array|bool
     */
    public function getUserByUserName(string $username): array|bool
    {
        $sql = "select * from Users where username = :username";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}