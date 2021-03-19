<?php

require_once'db.php';

$productInserted = false;

if(!empty($_POST)){

    $productTitle = $_POST['title'];

    $stmt = $dbh->prepare('INSERT into product(title) values(:title)');

    $stmt->execute([
       'title' => $productTitle
    ]);

    if($stmt->rowCount() > 0){
        $productInserted = true;
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial=1.0, shrinktofit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
        body {
            width: 70%;
            margin: 0 auto;
        }

    </style>
</head>
<body>

<form action="" method="post" class="form-group bg-light p-3 my-2">
    <?php if($productInserted): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Product Inserted Successfully!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif ?>
    <div class="form-group">

        <label for="title">Product Title</label>
        <input type="text" class="form-control" name="title" id="title" aria-describedby="Title"
               placeholder="Enter a product title" required>
        <small class="form-text text-muted">This is usually the product name..</small>
    </div>
    <br>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>





<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>

</body>
</html>
