<?php
namespace Acme;
use Acme\model\ProductModel;
require "../vendor/autoload.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Producten Bestellen</title>
    <link rel="stylesheet" type="text/css" href="style/product.css">
</head>
<body>
<form action="bestellingdoorvoeren.php" method="post" class="form-container" id="productForm">
    <?php
    $idTafel = $_GET['idtafel'] ?? false;
    $searchTerm = $_GET['search'] ?? '';
    $productModel = new ProductModel();
    $products = $productModel->getProducts($searchTerm);
    ?>
    <p>Zoeken</p>
    <input type="text" id="search" name="search" value="<?= htmlspecialchars($searchTerm) ?> ">
    <div class="form-columns" id="productList">
        <?php
        if ($idTafel) {
            echo "<input type='hidden' name='idtafel' value='$idTafel'>";
            if (empty($products)) {
                echo "No item";
            } else {
                foreach ($products as $product) {
                    $idproduct = $product->getColumnValue('idproduct');
                    $naam = $product->getColumnValue('naam');
                    $prijs = $product->getColumnValue('prijs');
                    $categorie = $product->getColumnValue('categorie');
                    
                    echo "<div class='form-item' data-name='{$naam}' data-prijs='{$prijs}' data-categorie='{$categorie}'>";
                    echo "<label class='checkbox-label'><input type='checkbox' name='products[]' value='{$idproduct}'> {$naam} {$prijs} €</label>";
                    echo "<label>Aantal: <input type='number' name='product{$idproduct}'></label>";
                    echo "</div>";
                }
            }
        } else {
            http_response_code(404);
            include('error_404.php');
            die();
        }
        ?>
    </div>
    <?php
    if (empty($products)) {
        echo "<button type='button' disabled>Volgende</button>";
    } else {
        echo "<button type='button' onclick='submitForm()'>Volgende</button>";
    }
    ?>
</form>
    <script src='script/search.js'></script>
</body>
</html>