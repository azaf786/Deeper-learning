<?php

USE App\Entity\Product;
USE App\Entity\CheckIn;
use App\Hydrator\EntityHydrator;

require_once '../src/setup.php';

$productId = $_GET['productId'];
$stmt = $dbh->prepare('
    SELECT p.id AS product_id, p.title,
    c.id, c.name, c.rating, c.review, c.posted,
    (
        SELECT AVG(checkin.rating) FROM checkin WHERE product_id = p.id
    ) AS averageRating
    FROM product p
    LEFT JOIN checkin c on c.product_id = p.id
    WHERE p.id = :id
');

//Product
$stmt->execute([
    'id' => $productId
]);
$productandcheckinsdata = $stmt->fetchAll(PDO::FETCH_ASSOC);



$hydrator = new EntityHydrator();
$product = $hydrator->hydrateProductWithCheckIns($productandcheckinsdata);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Product Detail</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body class="p-4">
    <div class="card p-4">
        <div class="row">
            <div class="col-md-6 col-sm-12 text-center p-4">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="rounded d-block w-100" src="https://via.placeholder.com/400x350" alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="rounded d-block w-100" src="https://via.placeholder.com/400x350" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img class="rounded d-block w-100" src="https://via.placeholder.com/400x350" alt="Third slide">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <h1 class="card-title"><?= $product->title ?></h1>
                <p class="card-text">Nike look to the past to redefine their future - these men's Air Max 97 trainers from Nike are your go-to for statement style. Inspired by the sleek look of high-speed Japanese bullet trains, a full-length Air unit takes the Swoosh's on-point impact protection next level. Arriving in a black colourway, the sneaks feature a leather and textile upper for a premium look with breathable qualities. The lower part of the upper features repeating, tonal Nike wording to add an extra dynamic to the already standout look. With the famed Waffle pattern outsole for grippy traction, the sneaks are finished with the iconic Swoosh to the sides in red.
                    <br>
                    Care & Material
                    Leather & Textile Upper/Synthetic Sole
                    <br>
                    <em>Colour:</em> Black
                    <br>
                    <em>Product Code:</em> 1200161/077390</p>

                <a href="#" class="btn btn-info">Add to Basket</a>
                <a href="#" class="btn btn-warning">Add to Wishlist</a>
                <a href="#" class="btn btn-success">Checkout</a>
            </div>
        </div>

        <div class="card p-2 m-2">

            <div class="form-group mx-auto">
                <div class="d-inline p-2 bg-light text-white text-center text-dark rounded">Average Rating</div>
                <div class="d-inline p-2 bg-light text-white mb-4 rounded text-center text-dark"><?= $product->averageRating?></div>
            </div>

            <h2 class="m-2 p-4 text-center">Recent Checkins</h2>
            <div class="mx-auto" style="width: 90%">
                <table class="table table-bordered table-hover" >
                    <thead>
                        <tr>
                            <td class="bg-light">Id</td>
                            <td class="bg-light">Name</td>
                            <td class="bg-light">Rating</td>
                        </tr>
                    </thead>
                        <?php foreach($product->getCheckIns() as $checkin): ?>
                        <tr>
                    <tbody>
                            <td><?= $checkin->id?></td>
                            <td><?= $checkin->name?></td>
                            <td><?= $checkin->rating?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>

            </div>

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
