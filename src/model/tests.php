<?php
// TEST

namespace Acme\model;

use Acme\system\Database;

require "../../vendor/autoload.php";

echo "<pre>";

////////////////////////////////////////////////////////////////////////////
// TEST class Model
$model = new Model(Database::getInstance('../../.env'));
var_dump($model);

echo "<br><br>";

////////////////////////////////////////////////////////////////////////////
/// // TEST class TafelModel
$tm = new TafelModel(Database::getInstance('../../.env'));
$tafels = $tm->get(
    'SELECT * FROM tafel WHERE idtafel > :idtafel',
    ['idtafel' => 1]
);
foreach ($tafels as $tafel) {
    var_dump($tafel->getColumnValue('omschrijving'));
}

echo "<br><br>";

////////////////////////////////////////////////////////////////////////////
// TEST class ProductModel
$pm = new ProductModel(Database::getInstance('../../.env'));

$producten = $pm->getAll();
foreach ($producten as $product) {
    var_dump($product->getColumnValue('naam'));
}

echo "<br><br>";

$product = $pm->getByPrimaryKey(4);
var_dump($product->getColumnValue('naam'));

echo "<br><br>";

$product = $pm->getOne(['naam' => 'Koffie']);
var_dump($product->getColumnValue('naam'));

echo "<br><br>";

$product = $pm->getCount(['naam' => 'Koffie']);
var_dump($product);

echo "<br><br>";

$pm->setColumnValue('prijs', 550);
$pm->setColumnValue('naam', 'IPA');
$id = $pm->save();
var_dump("id: " . $id);
$pm->delete($id);

echo "<br><br>";


////////////////////////////////////////////////////////////////////////////
// TEST class ProductTafelModel
$ptm = new ProductTafelModel(Database::getInstance('../../.env'));
echo "--------------------------------";
$productentafel = $ptm->getBestelling(3);
var_dump($productentafel);