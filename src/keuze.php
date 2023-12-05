<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Toevoegen of afrekenen</title>
</head>
<body>
<?php
$idTafel = $_GET['idtafel'] ?? false;
if ($idTafel) {
    echo "<div><a href='product.php?idtafel={$idTafel}'>toevoegen</a></div>";
    echo "<div><a href='rekening.php?idtafel={$idTafel}'>afrekenen</a></div>";
} else {
    http_response_code(404);
    include('error_404.php');
    die();
}
?>
</body>
</html>