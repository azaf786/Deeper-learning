<?php

require_once'db.php';

$productId = 6;
$stmt = $dbh->prepare('DELETE FROM product WHERE id=:productId');
$stmt->execute([
    'productId' => $productId
]);
echo ('Rows deleted: ') . $stmt->rowCount();