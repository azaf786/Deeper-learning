<?php

use App\Entity\Products;

require_once '../src/setup.php';


if(!empty($_POST)){

    $formData = [
            'title' => strip_tags($_POST['title']),
            'description' => strip_tags($_POST['description']),
            'price' => strip_tags($_POST['price']),
    ];

    $formProduct = new Products;
    $formProduct->title = $formData['title'];
    $formProduct->description = $formData['description'];
    $formProduct->price = $formData['price'];

    $createProduct = $dbProvider->createProduct($formProduct);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include'template/header_includes.php'?>
    <title>Create Product</title>
</head>
<body>
<?php include'template/navbar_includes.php'?>

<div class="container m-4 d-flex flex-column mx-auto">

    <div class="card p-4">
        <h1 id="createProduct" class="text-center">Create Product</h1>
        <form action="" method="post" class="form-group bg-light p-4 my-2 rounded">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" id="title" aria-describedby="title"
                       placeholder="Enter a product title" maxlength="80" required>
                <small class="form-text text-muted">Product title shouldn't be longer than 80 characters.</small>
            </div>
            <div class="form-floating">
                <label for="description">Description</label>
                <textarea type="text" class="form-control" name="description" id="description" aria-describedby="description"
                          placeholder="Enter product description" required></textarea>
                <small class="form-text text-muted">Please enter as much information as you can about the product.</small>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number"  class="form-control" name="price" id="price" aria-describedby="price"
                       placeholder="Enter a price." required>
                <small class="form-text text-muted">Charge as little as 0.99p or £999.99</small>
            </div>

            <br>
            <button type="submit" class="btn btn-info">Register</button>
        </form>

    </div>
</div>





<?php include'template/footer_includes.php'?>

</body>
</html>
