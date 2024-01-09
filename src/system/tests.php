<?php

namespace Acme\system;

use PDO;
use PDOStatement;

class Database
{
    private static $instance;
    private $pdo;

    private function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public static function getInstance(PDO $pdo): Database
    {
        if (!self::$instance) {
            self::$instance = new self($pdo);
        }

        return self::$instance;
    }

    public function getPreparedStatement(string $query): PDOStatement
    {
        return $this->pdo->prepare($query);
    }
}

// ...

// Use environment variables for database connection
$dbHost = $_ENV['DB_HOST'];
$dbPort = $_ENV['DB_PORT'];
$dbName = $_ENV['DB_DATABASE'];
$dbUser = $_ENV['DB_USERNAME'];
$dbPass = $_ENV['DB_PASSWORD'];

// Create an instance of PDO using environment variables
$pdo = new PDO("mysql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPass);

// Create an instance of the Database class
$db = Database::getInstance($pdo);

// Example usage of getPreparedStatement method
$prep = $db->getPreparedStatement('SELECT * FROM tafel WHERE idtafel = :idtafel');
$prep->execute(array(':idtafel' => 3));
var_dump($prep->fetchAll());

echo "<br><br>";
