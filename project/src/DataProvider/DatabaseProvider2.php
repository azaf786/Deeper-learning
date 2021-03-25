<?php


namespace App\DataProvider;


use App\Entity\Products;
use App\Hydrator\EntityHydrator;
use PDO;
use PDOException;

class DatabaseProvider2
{

    private PDO $dbh;

    public function __construct()
    {

        //Database Connection
        $username = $_ENV['DB_USERNAME'];
        $password = $_ENV['DB_PASSWORD'];

        try {
            $this->dbh = new PDO('mysql:dbname=project;host=mysql',
                $username,
                $password
            );
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        catch (PDOException $e){
            die('Error connecting to database: '.$e);
        }
    }

    public function getProduct(int $productId): array
    {
        $stmt = $this->dbh->prepare(
            'SELECT * FROM product WHERE id = :id'
        );
        $stmt->execute([
            'id' => $productId
        ]);

        $allProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $hydrator = new EntityHydrator();
        $productsArray = [];

        foreach ($allProducts as $row) {
            $products = $hydrator->hydrateProducts($row);
            $productsArray[] = $products;
        }

        return $productsArray;
    }

    public function getProducts(): array
    {
        $stmt = $this->dbh->prepare(
            'SELECT * FROM product'
        );
        $stmt->execute([]);

        $allProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $hydrator = new EntityHydrator();
        $productsArray = [];

        foreach ($allProducts as $row) {
            $products = $hydrator->hydrateProducts($row);
            $productsArray[] = $products;
        }

        return $productsArray;
    }

//    public function getProduct(): ?Product
//    {
//
//    }

    public function createProduct(Products $product): array
    {
        $stmt = $this->dbh->prepare(
            'INSERT INTO product (title, description, price)
             values(:title, :description, :price)'
        );
        $stmt->execute([
            'title' => $product->title,
            'description' => $product->description,
            'price' => $product->price
        ]);
        $lastInsertId = $this->dbh->lastInsertId();
        $newProduct = $this->getProducts($lastInsertId);

        return $newProduct;
    }
}