<?php
USE App\Entity\Product;

require_once '../src/setup.php';

$stmt = $dbh->prepare('SELECT * FROM product');
$stmt->execute();
$product = $stmt->fetchAll(PDO::FETCH_CLASS, Product::class);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>All Products </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>



    <div class="card p-2 m-2">
        <h2 class="m-2 bg-light rounded text-center">All Products</h2>
        <div class="mx-auto" style="width: 90%">
            <table class="table table-bordered table-hover rounded text-center">
                <thead class="bg-info">
                <tr>
                    <td>Id</td>
                    <td>Title</td>
                </tr>
                </thead>
                <tbody>

                <?php foreach ($product as $allProducts): ?>
                    <tr>
                        <td><a href="http://localhost/project/public/product.php?productId=<?=$allProducts->id?>"><?= $allProducts->id ?></td>
                        <td><?= $allProducts->title ?></td>
                    </tr>

                <?php endforeach; ?>
                </tbody>
            </table>

        </div>

    </div>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>


</body>
</html>
