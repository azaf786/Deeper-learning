<?php

require_once'db.php';

$newProductTitle = 'Macbook pro 13 inch';
$stmt = $dbh->prepare('INSERT INTO product(title) values (:title)');
$stmt->execute([
    'title' => $newProductTitle
]);
echo 'Rows affected: '. $stmt->rowCount();