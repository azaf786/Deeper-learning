<?php
class Product{
    public $title = 'Macbook Pro ';
    public $isInStock = false;
    public $reviews = ['Exceptional', 'A lot faster than windows'];
}

$product = new Product();
var_dump($product);

?>

<body>
<h1><?= $product->title ?></h1>
<p>
    <?php if ($product->isInStock): ?>
    Product is in stock
    <?php else: ?>
    Product is not in stock
    <?php endif; ?>
</p>

<h2>
    <ul>
        <?php foreach ($product->reviews as $review): ?>
        <li><?= $review; ?></li>
        <?php endforeach?>
    </ul>
</h2>
</body>
