<?php
namespace Acme;
use Acme\model\ProductModel;
require "../vendor/autoload.php";
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="bestellingdoorvoeren.php" method="post">

    <?php
    $idTafel = $_GET['idtafel'] ?? false;
    if ($idTafel) {
        echo "<input type='hidden' name='idtafel' value='$idTafel'>";
        $productModel = new ProductModel();
        $products = $productModel->getProducts();
        foreach ($products as $product) {
            $idproduct = $product->getColumnValue('idproduct');
            $naam = $product->getColumnValue('naam');
            echo "<div>";
            echo "<label><input type='checkbox' name='products[]' value='{$idproduct}'> {$naam} </label>";
            
            echo "<label>Aantal: <input type='number' name='product{$idproduct}'></label>";
            echo "</div>";
        }
        echo "<button>Volgende</button>";
    } else {
        http_response_code(404);
        include('error_404.php');
        die();
    }
    ?>
</form>
</body>
</html>
<link rel="stylesheet" type="text/css" href="style\mainstyle.css">

  