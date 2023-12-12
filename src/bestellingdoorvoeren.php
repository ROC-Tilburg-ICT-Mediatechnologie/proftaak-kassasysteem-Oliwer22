<?php

use Acme\classes\Bestelling;

require "../vendor/autoload.php";

if ($idTafel = $_POST['idtafel'] ?? false) {

    // Create an instance of the Bestelling class
    $bestelling = new Bestelling($idTafel);

    // TODO: Add selected products to the order
    $selectedProducts = $_POST['products'] ?? [];
    $bestelling->addProducts($selectedProducts);

    // TODO: Save the order to the database
    $bestelling->saveBestelling(); // You need to implement this method in the Bestelling class

    // Redirect to the index page
    header("Location: index.php");
    exit();
} else {
    http_response_code(404);
    include('error_404.php');
    die();
}
