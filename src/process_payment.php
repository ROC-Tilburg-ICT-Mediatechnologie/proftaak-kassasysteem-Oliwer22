<?php
use Acme\classes\Bestelling;
require "../vendor/autoload.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idTafel = $_POST['idtafel'] ?? false;
    if ($idTafel) {
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=kassasysteem', 'MainDev', 'GbXH85WN6VIOAAZE');
            $bestelling = new Bestelling($idTafel, $pdo);
            $stmt = $pdo->prepare("UPDATE product_tafel SET betaald = 1 WHERE idtafel = ?");
            $stmt->execute([$idTafel]);
            echo "Payment confirmed! Bedankt voor uw bestelling. En tot snel!. Wacht&nbsp;<span id='countdown'>5</span>&nbsp;seconden.";
        } catch (\Exception $e) {
            echo "Error processing payment: " . $e->getMessage();
        }
    } else {
        http_response_code(404);
        include('error_404.php');
        die();
    }
} else {
    http_response_code(405); 
    echo "Invalid request method";
}
?>
<link rel="stylesheet" type="text/css" href="style/paydone.css">
<script>
    var countdown = 5;
    var countdownElement = document.getElementById('countdown');
    function updateCountdown() {
        countdownElement.textContent = countdown;
        countdown--;
        if (countdown < 0) {
            window.location.href = 'index.php'; 
        } else {
            setTimeout(updateCountdown, 1000);
        }
    }
    setTimeout(updateCountdown, 1000);
</script>
