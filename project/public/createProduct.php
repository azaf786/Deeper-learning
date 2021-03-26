<?php

use App\Entity\Products;

require_once '../src/setup.php';

$productInserted = false;
if(!empty($_POST)){
    $filename = $_FILES['filePath']['name'];
    $destination = 'uploads/' . $filename;
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    $file = $_FILES['filePath']['tmp_name'];
    $size = $_FILES['filePath']['size'];

    if (in_array($extension, ['zip', 'pdf', 'docx', 'gif'])) {
        echo "You file extension must be .png, .jpeg or .jpg";
    } elseif ($_FILES['filePath']['size'] > 1000000) {
        echo "File too large!";
    } else {
        if (move_uploaded_file($file, $destination)) {

            $formData = [
                'title' => strip_tags($_POST['title']),
                'description' => strip_tags($_POST['description']),
                'price' => strip_tags($_POST['price']),
                'filePath' => $destination
            ];

            $formProduct = new Products();
            $formProduct->title = $formData['title'];
            $formProduct->description = $formData['description'];
            $formProduct->price = $formData['price'];
            $formProduct->filePath = $formData['filePath'];

            $getProducts = $dbProvider->createProduct($formProduct);

            $productInserted = true;



        } else {
            echo "Failed to upload file.";
        }
    }

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include'template/header_includes.php'?>
    <title>Create Product</title>
</head>
<body>
<?php
    include'template/navbar_includes.php';
?>
<?php if($productInserted): ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Congratulations!</strong> Your product was inserted successfully.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<?php endif; ?>
<div class="container m-4 d-flex flex-column mx-auto">

    <div class="card p-4">
        <h1 id="createProduct" class="text-center">Create Product</h1>
        <form action="" method="post" class="form-group bg-light p-4 my-2 rounded" enctype="multipart/form-data">
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
                <input type="number" step="0.01" class="form-control" name="price" id="price" aria-describedby="price"
                       placeholder="Enter a price." required>
                <small class="form-text text-muted">Charge as little as 0.99p or £999.99</small>
            </div>
            <div class="form-group">
                <label class="form-label" for="filePath">Upload a picture</label>
                <input type="file" class="form-control" name="filePath" id="filePath" />
                <small class="form-text text-muted">Supported formats (.png .jpeg .jpg)</small>
            </div>

            <br>
            <button type="submit" class="btn btn-info">Insert product</button>
        </form>

    </div>
</div>





<?php include'template/footer_includes.php'?>

</body>
</html>
