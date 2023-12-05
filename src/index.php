<?php

// In composer.json wordt acme-namespace aan src-folder gekoppeld
// Elk php-bestand moet een namespace hebben, geredeneerd vanuit de src-map (acne-namespace)
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
</head>
<body>
<pre>
<?php
    // TODO: alle tafels ophalen uit de database en als hyperlinks laten zien (maak gebruik van class TafelModel)
    // Zoiets als dit:
    // foreach ( ... ) {
    //      echo "<div><a href='keuze.php?idtafel={$idtafel}'>{$omschrijving}')}</div>";
    // }
?>
</body>
</html>
