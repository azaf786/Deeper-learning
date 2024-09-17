<?php

require_once '../src/setup.php';


try {
    $getProducts = $dbProvider->getProducts();
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
    <div class="carousel-cell"><img id="carouselImg" src="uploads/nike.png" alt="nike shoes"></div>
    <div class="carousel-cell"><img id="carouselImg" src="uploads/nike.jpeg" alt="nike shoes"></div>
    <div class="carousel-cell"><img id="carouselImg" src="uploads/jordan-delta-mid-shoe-bp21WR.jpeg" alt="nike shoes"></div>
    <div class="carousel-cell"><img id="carouselImg" src="uploads/air-max-plus-eoi-shoe-7SQL5P.jpeg" alt="nike shoes"></div>
    <div class="carousel-cell"><img id="carouselImg" src="uploads/air-max-plus-shoe-QZHGx0.jpeg" alt="nike shoes"></div>
</div>

    <div id="threeCards" class="row">
        <div class="col-md-4">
            <div  class="card card-1">
                <h3 id="cardText">Next Day Delivery</h3>
                <p id="cardDescriptionText">With your aShoe membership, your products can arrive next day for free. Sign up today to claim free 1 year of next day deliveries. What are you waiting for? Sign up! </p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-2">
                <h3 id="cardText">How are our products made?</h3>
                <p id="cardDescriptionText">Our products are responsibly designed utilising recycled materials from post-consumer and/or post-manufactured waste.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-3">
                <h3 id="cardText">Like being Unique?</h3>
                <p id="cardDescriptionText">Now you can make your shows your very own with a colour palette and premium materials including smooth and rippled leather and a new, matching sidewall selection.</p>
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
                        <p id="cardTrimmedDescription" class="card-text"><?php echo $trimmedDescription; } ?></p>
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
