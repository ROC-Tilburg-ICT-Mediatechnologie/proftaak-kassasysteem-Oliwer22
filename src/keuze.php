<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Toevoegen of afrekenen</title>
    <link rel="stylesheet" type="text/css" href="style\mainstyle.css">
</head>
<body>
<?php
$idTafel = $_GET['idtafel'] ?? false;
if ($idTafel) {
    echo "<p>ID Tafel: {$idTafel}</p>";
    
    echo "<div><a href='product.php?idtafel={$idTafel}'>Toevoegen</a></div>";
    echo "<div><a href='rekening.php?idtafel={$idTafel}'>Afrekenen</a></div>
    ";
    
    
} else {
    http_response_code(404);
    include('error_404.php');
    die();
}
?>
</body>
</html>
