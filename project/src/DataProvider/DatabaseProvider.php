<?php


namespace App\DataProvider;


use App\Entity\Products;
use App\Entity\User;
use App\Hydrator\EntityHydrator;
use PDO;
use PDOException;

class DatabaseProvider
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


    public function getProduct(int $productId): ?Products
    {
        $stmt = $this->dbh->prepare(
            'SELECT * FROM product WHERE id = :id'
        );
        $stmt->execute([
            'id' => $productId
        ]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if(empty($result)){
            return null;
        }

        $hydrator = new EntityHydrator();
        return $hydrator->hydrateProduct($result);
    }

    public function getSearchedProducts(string $searchTerm): array
    {
        $stmt = $this->dbh->prepare('SELECT * FROM product WHERE title LIKE :searchTerm');
        $stmt->execute([
            'searchTerm' => '%' . $searchTerm . '%'
        ]);

        return $stmt->fetchAll(PDO::FETCH_CLASS, Products::class);
    }

//    public function searchProduct(string $searchTerm)
//    {
//        $stmt = $this->dbh->prepare(
//            'SELECT * FROM product WHERE title LIKE :searchTerm ORDER BY title ASC'
//        );
//        $stmt->execute([
//            'searchTerm' => '%' . $searchTerm . '%'
//        ]);
//
//        $suggestions = [];
//
//        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
//        foreach($result as $row){
//
//            $title = $row['title'];
//            $suggestions[] = $title;
//
//        }
//
//        $jsonData = json_encode($suggestions);
//        var_dump($jsonData);
//
//        return $jsonData;

//        $result = $stmt->fetch(PDO::FETCH_ASSOC);
//        if(empty($result)){
//            return null;
//        }
//
//        $hydrator = new EntityHydrator();
//        return $hydrator->hydrateProduct($result);
//    }


    public function getRecommendedProducts(int $productId): array
    {
        $stmt = $this->dbh->prepare(
            'SELECT * FROM product WHERE id NOT LIKE :id
                        ORDER BY RAND()
                        LIMIT 3
        ');
        $stmt->execute([
            'id' => $productId
        ]);


        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $hydrator = new EntityHydrator();
        $recommended = [];

        foreach ($result as $row) {
            $products = $hydrator->hydrateProducts($row);
            $recommended[] = $products;
        }

        return $recommended;
    }

    public function getProducts(): array
    {
        $stmt = $this->dbh->prepare(
            'SELECT * FROM product 
                        ORDER BY RAND()
                        LIMIT 9
        ');
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

    public function getRecentlyAdded(): array
    {
        $stmt = $this->dbh->prepare(
            'SELECT * FROM product 
                        ORDER BY id DESC
        ');
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


    public function getAllProducts(): array
    {
        $stmt = $this->dbh->prepare(
            'SELECT * FROM product 
                        ORDER BY id ASC
        ');
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



    public function createProduct(Products $product): Products
    {
        $stmt = $this->dbh->prepare(
            'INSERT INTO product (title, description, price, filePath)
             values(:title, :description, :price, :filePath)'
        );
        $stmt->execute([
            'title' => $product->title,
            'description' => $product->description,
            'price' => $product->price,
            'filePath' => $product->filePath ?? null
        ]);
        $lastInsertId = $this->dbh->lastInsertId();
        $newProduct = $this->getProduct($lastInsertId);

        return $newProduct;
    }

    public function createUser(User $formUser): User
    {
        $stmt = $this->dbh->prepare(
            'INSERT INTO user (username, email, password)
             values(:username, :email, :password)'
        );
        $stmt->execute([
            'username' => $formUser->username,
            'email' => $formUser->email,
            'password' => $formUser->password,

        ]);
        $lastInsertId = $this->dbh->lastInsertId();
        $newUser = $this->getUser($lastInsertId);

        return $newUser;
    }

    public function getUser(int $lastInsertId): ?User
    {
        $stmt = $this->dbh->prepare(
            'SELECT id, username, email, password from user 
             WHERE id = :id'
        );
        $stmt->execute([
            'id' => $lastInsertId
        ]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if(empty($result)){
            return null;
        }

        $hydrator = new EntityHydrator();
        return $hydrator->hydrateUser($result);
    }

    public function getUserByEmail(string $email)
    {
        $stmt = $this->dbh->prepare(
            'SELECT id, username, email, password from user 
             WHERE email = :email'
        );
        $stmt->execute([
            'email' => $email
        ]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if(empty($result)){
            return null;
        }

        $hydrator = new EntityHydrator();
        return $hydrator->hydrateUser($result);
    }
}