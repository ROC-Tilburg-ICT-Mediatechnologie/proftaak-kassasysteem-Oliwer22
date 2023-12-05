<?php

namespace Acme\model;

use Acme\system\Database;

class ProductTafelModel extends Model
{

    protected static string $tableName = "product_tafel";
    protected static string $primaryKey = "idproduct_tafel";

    public function __construct($env = '../.env')
    {
        parent::__construct(Database::getInstance($env));
    }

    /**
     *
     * @param array $bestelling [
     *                          'idtafel'  => int idTafel,
     *                          "products" => array [idproduct, idproduct, ...],
     *                          "datetime" => int dateTime
     *                          ]
     *
     * @return int nieuwe id
     */
    public function saveBestelling(array $bestelling): int
    {
        foreach ($bestelling['products'] as $idProduct) {
            $this->setColumnValue('idtafel', $bestelling['idtafel']);
            $this->setColumnValue('datumtijd', $bestelling['datetime']);
            $this->setColumnValue('betaald', 0);
            $this->setColumnValue('idproduct', $idProduct);
            return $this->save();
        }
        return 0;
    }

    /**
     * @param $idTafel
     *
     * @return array    [
     * 'idTafel'  => int idTafel,
     * "products" => array [idproduct, idproduct, ...],
     * "datumtijd" => int dateTime,
     * "betaald" => int betaald
     * ]
     */
    public function getBestelling($idTafel): array
    {
        $products = $this->getAll(['idtafel' => $idTafel, 'betaald' => 0]);

        $bestelling['idTafel'] = $idTafel;
        $bestelling['datumtijd'] = isset($products[0])
            ? (int)$products[0]->getColumnValue('datumtijd') : 0;
        $bestelling['betaald'] = 0;

        foreach ($products as $product) {
            $idProduct = $product->getColumnValue('idproduct');
            $bestelling['products'][] = $idProduct;
        }
        return $bestelling;
    }
}