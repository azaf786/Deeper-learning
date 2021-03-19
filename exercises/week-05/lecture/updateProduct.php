<?php

require_once'db.php';

$productId = 6;
$productTitle = 'Updated Product';

$stmt = $dbh->prepare('UPDATE product SET  title = :title WHERE id= :productId ');
$stmt->execute([
    'title' => $productTitle,
    'productId' => $productId
]);
echo ('Rows updated: ') . $stmt->rowCount();