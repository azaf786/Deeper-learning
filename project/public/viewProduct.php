<?php

require_once '../src/setup.php';

$productId = $_GET['productId'];
try {
    $getProduct = $dbProvider->getProduct($productId);
    $getProducts = $dbProvider->getRecommendedProducts($productId);
}
catch (PDOException $e) {
    echo $e->getMessage();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include'template/header_includes.php'?>
    <title>Product Detail</title>

</head>
<body>
<?php include "template/navbar_includes.php"; ?>
<?php include "template/topButtonNav_includes.php"; ?>



<div class="row">
    <div class="col-lg-12">
        <div class="card m-5">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img class="rounded d-block" width="600px" height="600px" src="<?= $getProduct->filePath ?>" alt="Shoe">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class=" rounded bg-light">
                            <h1 id="productTitle" class="p-3 rounded"><?= $getProduct->title ?></h1>
                        </div>
                        <div class="card-body bg-light">
                            <h5 id="dscr" class="card-title">Description</h5>
                            <p id="cardDscr" class="card-text text-dark"><?= $getProduct->description ?></p>

                            <a href="#" class="btn btn-info">Add to Basket</a>
                            <a href="#" class="btn btn-warning">Add to Wishlist</a>
                            <a href="#" class="btn btn-success">Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="jumbotron" class="jumbotron rounded">
    <h1 class="text-center">Recommended Items</h1>
    <p class="text-center">Once these are gone. We promise we won't recommend a thing.</p>
</div>
<section>
    <div class="container mt-4">
        <div class="row">
            <?php foreach($getProducts as $prod): ?>
                <div class="col-md-4 mt-4">
                    <div class="card profile-card-5">
                        <div class="card-img-block">
                            <img id="prodImgs" class="card-img-top" src="<?= $prod->filePath ?>" alt="Product images">
                        </div>
                        <div class="card-body pt-0">
                            <h5 class="card-title"><a href="viewProduct.php?productId=<?=$prod->id?>"><?= $prod->title ?></a></h5>
                            <?php
                            $trimDescription = strip_tags($prod->description);
                            if(strlen($trimDescription) > 200){

                            $cutString = substr($trimDescription, 0 , 200);
                            $endPoint = strrpos($cutString, '...');

                            $trimmedDescription = $endPoint? substr($cutString, 0, $endPoint) : substr($cutString, 0);
                            $trimmedDescription .= '...';

                            ?>
                            <p class="card-text"><?php echo $trimmedDescription; } ?></p>
                            <div class="text-center">
                                <a href="viewProduct.php?productId=<?=$prod->id?>" id="price-btn" class="btn btn-lg text-center">£ <?= $prod->price ?></a>
                            </div>

                        </div>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php include 'template/footer_includes.php' ?>
</body>
</html>
