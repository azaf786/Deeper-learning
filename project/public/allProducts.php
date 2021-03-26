<?php

require_once '../src/setup.php';


try {
    $getProducts = $dbProvider->getAllProducts();
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
