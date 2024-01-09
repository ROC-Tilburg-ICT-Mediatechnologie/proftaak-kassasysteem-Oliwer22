<?php

namespace Acme\classes;
use Dotenv\Dotenv;
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
        // Replace this with your actual logic to fetch the product price from the database
        // Example: querying the ProductTafelModel to get the price
        $productModel = new ProductTafelModel(); // Replace with your actual ProductTafelModel class
        $product = $productModel->getProductById($productId);

        return $product['price'] ?? 0.0;
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
        // Replace this with your actual database connection parameters for products
        $productPdo = new PDO('mysql:host=localhost;dbname=kassasysteem', 'AxxcMainDev', 'GbXH85WN6VIOAAZE');
    
        // Replace this with your actual database query to fetch product details
        $productQuery = "SELECT naam, prijs FROM product WHERE id = ?";
        $productStmt = $productPdo->prepare($productQuery);
        $productStmt->bindParam(1, $productId, PDO::PARAM_INT);
        $productStmt->execute();
    
        // Fetch the result as an associative array
        $productDetails = $productStmt->fetch(PDO::FETCH_ASSOC);
    
        if ($productDetails === false) {
            return false;
        }
    
        // Replace this with your actual database connection parameters for orders
        $orderPdo = new PDO('mysql:host=localhost;dbname=kassasysteem', 'AxxcMainDev', 'GbXH85WN6VIOAAZE');
    
        // Replace this with your actual database query to fetch order details
        $orderQuery = "SELECT * FROM product WHERE idproduct = ?";
        $orderStmt = $orderPdo->prepare($orderQuery);
        $orderStmt->bindParam(1, $productId, PDO::PARAM_INT);
        $orderStmt->execute();
    
        // Fetch the result as an associative array
        $orderDetails = $orderStmt->fetch(PDO::FETCH_ASSOC);
    
        if ($orderDetails === false) {
            return false;
        }
    
        // Combine product and order details and return
        return [
            'product' => $productDetails,
            'order' => $orderDetails,
        ];
    }
    
    
    
}
