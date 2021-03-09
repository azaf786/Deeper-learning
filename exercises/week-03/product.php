<?php
class Product {
    public $title;
}

if(!empty($_POST)){
    $product = new Product();
    $product->title = $_POST['title'];

    $serializedProduct = serialize($product);
    file_put_contents('products.txt', $serializedProduct);


    $message = 'Product created. <br>';
    
    $productFromFile = file_get_contents('products.txt');
    $unserializedProduct = unserialize($productFromFile);
    $message .= $unserializedProduct->title;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Create Product</title>
</head>
<body>
    <h2>New Product</h2>
    <?php if (isset($message)): ?>
    New product: <?= $message?>
    <?php endif; ?>
    <form action="" method="post">
        <div>
            <label for="title">Title:</label>
            <input type="text" name="title" id="title">
        </div>

        <button type="submit">Create Product</button>
    </form>
</body>
</html>
