<?php
use Acme\classes\Bestelling;
require "../vendor/autoload.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idTafel = $_POST['idtafel'] ?? false;
    if ($idTafel) {
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=kassasysteem', 'MainDev', 'GbXH85WN6VIOAAZE');
            $bestelling = new Bestelling($idTafel, $pdo);

            // Update betaald column to 1 for the given idtafel
            $stmt = $pdo->prepare("UPDATE product_tafel SET betaald = 1 WHERE idtafel = ?");
            $stmt->execute([$idTafel]);

            echo "Payment confirmed successfully!";
        } catch (\Exception $e) {
            echo "Error processing payment: " . $e->getMessage();
        }
    } else {
        http_response_code(404);
        include('error_404.php');
        die();
    }
} else {
    http_response_code(405); // Method Not Allowed
    echo "Invalid request method";
}
?>
