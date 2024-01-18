<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Toevoegen of afrekenen</title>
    <link rel="stylesheet" type="text/css" href="style\keuze.css">
</head>
<body>
<?php
use Acme\classes\Bestelling;
require "../vendor/autoload.php";

$idTafel = $_GET['idtafel'] ?? false;
if ($idTafel) {
    echo "<p class='tabel'>Bestellen voor tafel: {$idTafel}</p>";
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=kassasysteem', 'MainDev', 'GbXH85WN6VIOAAZE');
        $bestelling = new Bestelling($idTafel, $pdo);
        $stmt = $pdo->prepare("SELECT idproduct FROM product_tafel WHERE idtafel = ? AND betaald = 0");
        $stmt->execute([$idTafel]);
        $orderDetails = $stmt->fetchAll(PDO::FETCH_COLUMN);
        $itemQuantities = [];
        $itemPrices = [];
        $totalCount = 0;
        $totalPrice = 0.0;
        foreach ($orderDetails as $productId) {
            $productDetails = $bestelling->fetchProductDetails($productId);
            if ($productDetails !== false) {
                $productName = $productDetails['naam'];
                $numericPrice = str_replace(',', '.', $productDetails['prijs']);
                $itemPrice = floatval($numericPrice);
                if (!isset($itemQuantities[$productName])) {
                    $itemQuantities[$productName] = 1;
                    $itemPrices[$productName] = $itemPrice;
                } else {
                    $itemQuantities[$productName]++;
                    $itemPrices[$productName] += $itemPrice;
                }
                $totalCount++;
                $totalPrice += $itemPrice;
            } else {
                echo "<p>Product details not available for ID: {$productId}</p>";
            }
        }
        foreach ($itemQuantities as $productName => $quantity) {
            echo "<p>{$productName} (X: {$quantity}) - {$itemPrices[$productName]} 
            </p>";
        }
        echo "<p>Total Items: {$totalCount}</p>";
        echo "<p>Total Price: {$totalPrice}</p>";
        
        echo "<div><a href='product.php?idtafel={$idTafel}'>Toevoegen</a></div>";
        echo "<div><a href='rekening.php?idtafel={$idTafel}'>Afrekenen</a></div>";
    } catch (\Exception $e) {
        echo "Error fetching order details: " . $e->getMessage();
        die();
    }
} else {
    http_response_code(404);
    include('error_404.php');
    die();
}
?>
</body>
</html>
