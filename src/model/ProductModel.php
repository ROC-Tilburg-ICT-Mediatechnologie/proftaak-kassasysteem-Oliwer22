<?php

namespace Acme\model;

use Acme\system\Database;

class ProductModel extends Model
{

    protected static string $tableName = "product";
    protected static string $primaryKey = "idproduct";

    public function __construct($env = '../.env')
    {
        parent::__construct(Database::getInstance($env));
    }

    public function getProducts(): array
    {
        return $this->getAll();
    }

    public function getProduct($idProduct): array
    {
        $product = ProductModel::getOne(["idproduct" => $idProduct]);
        return [
            'idproduct' => $idProduct,
            'naam'      => $product->getColumnValue('naam'),
            'prijs'     => (int)$product->getColumnValue('prijs')
        ];
    }
}