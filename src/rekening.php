<?php

use Acme\classes\Bestelling;

require "../vendor/autoload.php";

if ($idTafel = $_POST['idtafel'] ?? false) {
    $selectedProducts = $_POST['products'] ?? [];

    // Create an instance of the Bestelling class
    $bestelling = new Bestelling($idTafel);

    // Add selected products to the order
    $bestelling->addProducts($selectedProducts);

    // Save the order to the database
    $bestelling->saveBestelling();

} else {
    http_response_code(404);
    include('error_404.php');
    die();
}

header("Location: index.php");
