<?php

namespace Acme\classes;

use DateTime;
use PDO;

require "../../vendor/autoload.php";

echo "<pre>";

////////////////////////////////////////////////////////////////////////////
// TEST class Bestelling

// Create an instance of PDO (replace with your actual database connection parameters)
$pdo = new PDO('mysql:host=localhost;dbname=kassasysteem', 'AxxcMainDev', 'GbXH85WN6VIOAAZE');

$bestelling = new Bestelling(3, $pdo);

$bestelling->addProducts([3, 4]);
var_dump($bestelling->getBestelling());
$bestelling->delProduct(4);
var_dump($bestelling->getBestelling());

// Providing necessary data for saveBestelling method
$bestellingData = [
    'idtafel' => 3,
    'products' => [3],
    'datetime' => time(),
];

// Fix: Pass the data to the saveBestelling method
echo "nieuwe id: " . $bestelling->saveBestelling($bestellingData);

echo "<br><br>";

////////////////////////////////////////////////////////////////////////////
/// // TEST class Rekening
$rekening = new Rekening();
var_dump($rekening->getBill(3));
