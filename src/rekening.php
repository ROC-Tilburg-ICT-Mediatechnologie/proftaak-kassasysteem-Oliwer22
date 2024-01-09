<?php

use Acme\classes\Bestelling;

require "../vendor/autoload.php";

// include_once "header.php"; // Comment or remove this line

$idTafel = $_GET['idtafel'] ?? false;

if ($idTafel) {
    try {
        // Create an instance of PDO (replace with your actual database connection parameters)
        $pdo = new PDO('mysql:host=localhost;dbname=kassasysteem', 'AxxcMainDev', 'GbXH85WN6VIOAAZE');

        // Create an instance of the Bestelling class with both required arguments
        $bestelling = new Bestelling($idTafel, $pdo);

        // Get the selected products from the POST data
        $selectedProducts = $_POST['products'] ?? [];

        // Fetch order details
        $orderDetails = $bestelling->getBestelling();

        // Debugging: Output order details
        var_dump($orderDetails);

        // Fetch total price
        $totalPrice = $bestelling->getTotalPrice();

        // Debugging: Output total price
        var_dump($totalPrice);
    } catch (\Exception $e) {
        echo "Error fetching order details: " . $e->getMessage();
        die();
    }

    echo "<h2>Order Details</h2>";

    foreach ($orderDetails['products'] as $productId) {
        $productDetails = $bestelling->fetchProductDetails($productId);

        // Debugging: Output product details
        var_dump($productDetails);

        if ($productDetails !== false) {
            echo "<p>{$productDetails['naam']} - {$productDetails['prijs']}</p>";
        } else {
            echo "<p>Product details not available for ID: {$productId}</p>";
        }
    }

    echo "<p>Total Price: {$totalPrice}</p>";

    echo "<form action='process_payment.php' method='post'>";
    echo "<input type='hidden' name='idtafel' value='{$idTafel}'>";
    echo "<a href='keuze.php?idtafel={$idTafel}'>Go Back</a>";
    echo "<input type='submit' value='Confirm Payment'>";
    echo "</form>";
} else {
    http_response_code(404);
    include('error_404.php');
    die();
}

// include_once "footer.php"; // Comment or remove this line
