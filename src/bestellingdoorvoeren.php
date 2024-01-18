<?php
use Acme\classes\Bestelling;
use Acme\system\Database; 
require "../vendor/autoload.php";
if ($idTafel = $_POST['idtafel'] ?? false) {
    $envPath = '../.env'; 
    $pdo = Database::getInstance($envPath);
    $bestelling = new Bestelling($idTafel, $pdo);
    $products = $_POST['products'] ?? [];
    foreach ($products as $productId) {
        $quantity = $_POST['product' . $productId] ?? 1;
        for ($i = 0; $i < $quantity; $i++) {
            $bestelling->addProduct($productId);
        }
    }
    $bestelling->saveBestelling();

} else {
    http_response_code(404);
    include('error_404.php');
    die();
}
header("Location: index.php");
