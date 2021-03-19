<?php

if(!isset($_GET['id'])){
    die('Missing ID!');
}

class Product
{
    public int $id;
    public string $title;

    /** @var array CheckIn[] */
    public array $checkIns;
}

class CheckIn
{
    public int $id;
    public int $product_id;
    public string $name;
    public int $rating;
    public string $review;
    public string $posted;
}


$username = 'root';
$password = 'root';

$db = new PDO('mysql:dbname=project;host=mysql',
    $username, $password
);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//Product
$stmt = $db->prepare('SELECT * FROM product WHERE id=:id');
$stmt->execute([
   'id' => $_GET['id']
]);
$product = $stmt->fetchObject(Product::class);


//Checkin
$stmt = $db->prepare('SELECT * FROM checkin WHERE product_id = :product_id');
$stmt->execute([
   'product_id' => $product->id
]);
$product->checkIns = $stmt->fetchAll(PDO::FETCH_CLASS, CheckIn::class);


var_dump($product);