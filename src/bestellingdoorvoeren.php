<?php

use Acme\classes\Bestelling;

require "../vendor/autoload.php";

if ($idTafel = $_POST['idtafel'] ?? false) {
    // Create an instance of the Bestelling class
    $bestelling = new Bestelling($idTafel);

    // Add selected products to the order
    $selectedProducts = $_POST['products'] ?? [];
    $bestelling->addProducts($selectedProducts);

    // Save the order to the database
    $bestelling->saveBestelling();

    // Redirect to the index page
    header("Location: index.php");
    exit();
} else {
    http_response_code(404);
    include('error_404.php');
    die();
}
?>
<link rel="stylesheet" type="text/css" href="style\mainstyle.css">
