<?php


use App\Hydrator\EntityHydrator;

require_once '../src/setup.php';


try {
    $getProducts = $dbProvider->getProducts();
//    $getProducts = $dbh->prepare('
//        SELECT * from product
//        ORDER BY RAND()
//        LIMIT 12;
//');
//    $getProducts->execute();
//    $allProducts = $getProducts->fetchAll(PDO::FETCH_ASSOC);
//
//    $hydrator = new EntityHydrator();
//    $productsArray = [];
//
//    foreach ($allProducts as $row) {
//        $products = $hydrator->hydrateProducts($row);
//        $productsArray[] = $products;
//    }
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

<div class="carousel"
     data-flickity='{ "wrapAround": true }'>
    <div class="carousel-cell"><img src="uploads/nike.png" alt="nike shoes"></div>
    <div class="carousel-cell"><img src="uploads/nike.jpeg" alt="nike shoes"></div>
    <div class="carousel-cell"><img src="uploads/jordan-delta-mid-shoe-bp21WR.jpeg" alt="nike shoes"></div>
    <div class="carousel-cell"><img src="uploads/air-max-plus-eoi-shoe-7SQL5P.jpeg" alt="nike shoes"></div>
    <div class="carousel-cell"><img src="uploads/air-max-plus-shoe-QZHGx0.jpeg" alt="nike shoes"></div>
</div>

    <div id="threeCards" class="row">
        <div class="col-md-4">
            <div id="card" class="card card-1">
                <h3>Next Day Delivery</h3>
                <p>With your aShoe membership, your products can arrive next day for free. Sign up today to claim free 1 year of next day deliveries. What are you waiting for? Sign up! </p>
            </div>
        </div>
        <div class="col-md-4">
            <div id="card" class="card card-2">
                <h3>How are our products made?</h3>
                <p>Our products are responsibly designed utilising recycled materials from post-consumer and/or post-manufactured waste.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div id="card" class="card card-3">
                <h3>Like being Unique?</h3>
                <p>Now you can make your shows your very own with a colour palette and premium materials including smooth and rippled leather and a new, matching sidewall selection.</p>
            </div>
        </div>
    </div>
</div>

<section>
    <div class="container mt-4">
        <div class="row">
            <?php foreach($getProducts as $prod): ?>
            <div class="col-md-4 mt-4">
                <div class="card profile-card-5">
                    <div class="card-img-block">
                        <img id="prodImgs" class="card-img-top" src="uploads/jordan-delta-mid-shoe-bp21WR.jpeg" alt="Card image cap">
                    </div>
                    <div class="card-body pt-0">
                        <h5 class="card-title"><?= $prod->title ?></h5>
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
                            <a href="#" id="price-btn" class="btn btn-lg text-center">£ <?= $prod->price ?></a>
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