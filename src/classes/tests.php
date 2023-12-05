<?php
// TEST

namespace Acme\model;

use Acme\classes\Bestelling;
use Acme\classes\Rekening;

require "../../vendor/autoload.php";

echo "<pre>";

////////////////////////////////////////////////////////////////////////////
// TEST class Bestelling
$bestelling = new Bestelling(3);

$bestelling->addProducts([3, 4]);
var_dump($bestelling->getBestelling());
$bestelling->delProduct(4);
var_dump($bestelling->getBestelling());
echo "nieuwe id: " . $bestelling->saveBestelling();

echo "<br><br>";

////////////////////////////////////////////////////////////////////////////
/// // TEST class Rekening
$rekening = new Rekening();
var_dump($rekening->getBill(3));
