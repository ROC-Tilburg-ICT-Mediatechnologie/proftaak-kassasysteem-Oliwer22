<?php
namespace Acme;
use Acme\model\TafelModel;
require "../vendor/autoload.php";
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kiezen tafel</title>
    <link rel="stylesheet" type="text/css" href="style/indexstyle.css">
</head>
<body>
<?php
    $tafelModel = new TafelModel();
    $alleTafels = $tafelModel->getAllTafels();
    echo '<p class="title">Kies een Tafel voor een bestelling</p>';
    foreach ($alleTafels as $tafel) {
        $idTafel = $tafel['idtafel'];
        $omschrijving = $tafel['omschrijving'];
        echo "<div><a class='tafelnr' href='keuze.php?idtafel={$idTafel}'>Tafel NR. {$omschrijving}</a></div>";
    }
?>
</body>
</html>
