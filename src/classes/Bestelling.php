<?php

namespace Acme\classes;

use DateTime;
use PDO;

class Bestelling
{
    private $idTafel;
    private $products = [];
    private $dateTime;
    private $pdo;

    public function __construct(int $idTafel, PDO $pdo)
    {
        $this->idTafel = $idTafel;
        $this->dateTime = (new DateTime)->getTimestamp();
        $this->pdo = $pdo;
    }

    public function addProductName(string $productName): void
    {
        $this->productNames[] = $productName;
    }

    public function addProduct($productId): void
    {
        $this->products[] = $productId;
    }

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

    public function saveBestelling(): int
    {
        $sql = "INSERT INTO product_tafel (idtafel, idproduct, datumtijd, betaald) VALUES (:idtafel, :idproduct, :datumtijd, :betaald)";
        $stmt = $this->pdo->prepare($sql);
        
        foreach ($this->products as $product) {
            $stmt->execute([
                ':idtafel' => $this->idTafel,
                ':idproduct' => $product,
                ':datumtijd' => date('Y-m-d H:i:s', $this->dateTime),
                ':betaald' => 0 
            ]);
        }
    
        return count($this->products); // return het aantal producten dat is opgeslagen
    }

    public function getBestelling(): array
    {
        return [
            'idtafel'  => $this->idTafel,
            'products' => $this->products,
            'datetime' => $this->dateTime
        ];
    }
    private function fetchProductPriceFromDatabase($productId): float
    {
        // Use the ProductTafelModel to fetch the product price
        $productModel = new \Acme\model\ProductTafelModel($this->pdo);
        
        $product = $productModel->getProductById($productId);



        return $product['prijs'] ?? 0.0;
    } 
    public function getTotalPrice(): float
    {
        // Fetch prices of selected products from the database and calculate total price
        $totalPrice = 0.0;

        foreach ($this->products as $productId) {
            // Replace the following line with your actual logic to fetch the price from the database
            $price = $this->fetchProductPriceFromDatabase($productId);
            
            $totalPrice += $price;
        }

        return $totalPrice;
    }
    public function fetchProductDetails(int $productId)
    {
    
        // Adjust the SQL query to match your database schema
        $query = "SELECT naam, prijs FROM product WHERE idproduct = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(1, $productId, PDO::PARAM_INT);
        $stmt->execute();
    
        $productDetails = $stmt->fetch(PDO::FETCH_ASSOC);
    
    
        return $productDetails !== false ? $productDetails : false;
    }
    
    
    public function getProductById(int $productId)
    {
        // Implement your logic to fetch product details by ID
        $query = "SELECT naam, prijs FROM product WHERE idproduct = ?";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(1, $productId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
