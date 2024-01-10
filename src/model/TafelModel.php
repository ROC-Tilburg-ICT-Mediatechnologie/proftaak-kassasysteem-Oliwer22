<?php

namespace Acme\model;

use Acme\system\Database;
use Dotenv\Dotenv;

class TafelModel extends Model
{

    protected static string $tableName = "tafel";
    protected static string $primaryKey = "idtafel";

    public function __construct($env = '../.env')
    {
        parent::__construct(Database::getInstance($env));
    }

    public function getAllTafels(): array
    {
        $tafels = self::getAll();
        $result = [];

        foreach ($tafels as $tafel) {
            $result[] = [
                'idtafel' => (int)$tafel->getColumnValue('idtafel'),
                'omschrijving' => $tafel->getColumnValue('omschrijving')
            ];
        }

        return $result;
    }

    public function getTafel($idTafel): array
    {
        $tafel = self::getOne(['idtafel' => $idTafel]);
        return [
            'idtafel' => (int)$tafel->getColumnValue('idtafel'),
            'omschrijving' => $tafel->getColumnValue('omschrijving')
        ];
    }
    public function markTableAsPaid($idTafel): void
    {
        require_once __DIR__ . '/../vendor/autoload.php';
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
        $dotenv->load();
    
        $host = $_ENV['DB_HOST'];
        $username = $_ENV['DB_USERNAME'];
        $password = $_ENV['DB_PASSWORD'];
        $database = $_ENV['DB_DATABASE'];
    
        $mysqli = new mysqli($host, $username, $password, $database);
    
        // Check connection
        if ($mysqli->connect_errno) {
            echo "Failed to connect to MySQL: " . $mysqli->connect_error;
            return;
        }
    
        // Prepare and execute the update statement
        $stmt = $mysqli->prepare("UPDATE tafel SET betaald = 1 WHERE id = ?");
        $stmt->bind_param("i", $idTafel);
        $stmt->execute();
    
        // Close the statement and connection
        $stmt->close();
        $mysqli->close();
    }

}
