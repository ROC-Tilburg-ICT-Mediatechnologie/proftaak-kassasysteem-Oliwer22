<?php

namespace Acme\classes;

use Acme\model\ProductTafelModel;
use DateTime;

class Bestelling
{
    private int $idTafel;
    private array $products; // array van idproduct type int
    private bool $paid;
    private int $dateTime;

    public function __construct(int $idTafel)
    {
        $this->idTafel = $idTafel;
        $this->products = array();
        $this->dateTime = (new DateTime)->getTimestamp();
    }

    /**
     * @param array $products array van idproducts
     */
    public function addProducts(array $products): void
    {
        foreach ($products as $product) {
            $this->products[] = $product;
        }
    }

    public function delProduct(int $idProduct): void
    {
        if (($key = array_search($idProduct, $this->products)) !== false) {
            unset($this->products[$key]);
        }
    }

    public function saveBestelling($env = '../.env'): int
    {
        $bm = new ProductTafelModel($env);
        return $bm->saveBestelling($this->getBestelling());
    }

    public function getBestelling(): array
    {
        return [
            'idtafel'  => $this->idTafel,  // int
            "products" => $this->products, //array van idproducts
            "datetime" => $this->dateTime  // int
        ];
    }

}