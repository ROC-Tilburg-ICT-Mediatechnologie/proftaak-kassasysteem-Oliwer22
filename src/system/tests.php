<?php
// TEST

namespace Acme\system;

require "../../vendor/autoload.php";

echo "<pre>";

////////////////////////////////////////////////////////////////////////////
// TEST class DotEnv
$envDirectoryPath = __DIR__ . '/../..'; // Assuming .env is in the parent directory

$env = new DotEnv($envDirectoryPath);
$env->load();
var_dump($_ENV);

echo "<br><br>";

////////////////////////////////////////////////////////////////////////////
// TEST class Database
$db = Database::getInstance($envDirectoryPath);
$prep = $db->getPreparedStatement(
    'SELECT * FROM tafel WHERE idtafel = :idtafel'
);
$prep->execute(array(':idtafel' => 3));
var_dump($prep->fetchAll());

echo "<br><br>";
