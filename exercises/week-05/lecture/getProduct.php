<?php

require_once'db.php';

$productId = 6;
$stmt = $dbh->prepare('SELECT * FROM product WHERE id=:productId');
$stmt->execute([
    'productId' => $productId
]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

var_dump($product);