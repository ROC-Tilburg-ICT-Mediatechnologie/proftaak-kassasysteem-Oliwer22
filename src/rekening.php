<?php
use Acme\classes\Bestelling;
require "../vendor/autoload.php";
$idTafel = $_GET['idtafel'] ?? false;
if ($idTafel) {
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
        echo "<form action='process_payment.php' method='post'>";
        echo "<input type='hidden' name='idtafel' value='{$idTafel}'>";
        echo "<a href='keuze.php?idtafel={$idTafel}'>Go Back</a>";
        echo "<input type='submit' name='confirmPayment' value='Confirm Payment'>";
        echo "</form>";
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
