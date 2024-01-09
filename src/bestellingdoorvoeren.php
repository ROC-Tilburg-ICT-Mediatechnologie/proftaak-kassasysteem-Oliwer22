<?php

use Acme\classes\Bestelling;
use Acme\system\Database; // Assuming you have a Database class

require "../vendor/autoload.php";

if ($idTafel = $_POST['idtafel'] ?? false) {
    $envPath = '../.env'; // Set the path to your .env file
    $pdo = Database::getInstance($envPath);
    $bestelling = new Bestelling($idTafel, $pdo);

    // Haal de geselecteerde producten op uit het formulier
    $products = $_POST['products'] ?? [];

    // Voeg de geselecteerde producten toe aan de bestelling
    foreach ($products as $productId) {
        $quantity = $_POST['product' . $productId] ?? 1;
        for ($i = 0; $i < $quantity; $i++) {
            $bestelling->addProduct($productId);
        }
    }

    // Sla de bestelling op in de database
    $bestelling->saveBestelling();

} else {
    http_response_code(404);
    include('error_404.php');
    die();
}

header("Location: index.php");
