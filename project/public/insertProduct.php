<?php


use App\Hydrator\EntityHydrator;
use App\Hydrator\Category;

require_once '../src/setup.php';

$categoryInserted = false;
$noCategory = false;
if (!empty($_POST)) {
    try {
        $stmt = $dbh->prepare('INSERT INTO category(catId, catTitle) values(0, :categoryName)');
        $stmt->execute([
            'categoryName' => $_POST['category']
        ]);
        if ($stmt->rowCount() > 0) {
            $categoryInserted = true;
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
try {
    $getCategory = $dbh->prepare('SELECT * FROM category');
    $getCategory->execute();
    $allCategory = $getCategory->fetchAll(PDO::FETCH_ASSOC);

    $hydrator = new EntityHydrator();

    $categoryArray = [];
    foreach ($allCategory as $row) {
        $category = $hydrator->hydrateCategory($row);
        $categoryArray[] = $category;
    }
    $noCategory = true;


} catch (PDOException $e) {
    echo $e->getMessage();
}

try {

    $getSubCategory = $dbh->prepare('
        SELECT c.*, c1.*
        FROM category c
        LEFT JOIN
            category c1 ON c1.parent_id = c.catId
        WHERE c.parent_id = :cat_id
        ORDER BY c.catTitle, c1.catTitle;
');
    $getSubCategory->execute([
        'cat_id' => $category->catId
    ]);
    $allSubCategory = $getSubCategory->fetchAll(PDO::FETCH_ASSOC);

    $hydrator = new EntityHydrator();

    $subCategoryArray = [];
    foreach ($allSubCategory as $row) {
        $subCategory = $hydrator->hydrateCategory($row);
        $subCategoryArray[] = $subCategory;
    }

} catch (PDOException $e) {
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
<div class="container-fluid">


<?php if ($categoryInserted): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Product Inserted Successfully!</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif ?>
<form action="" method="post">
    <div class="form-group">
        <label for="category">Category Name</label>
        <input type="text" class="form-control" name="category" id="category" placeholder="Shoes" required>
    </div>
    <button class="btn btn-info" type="submit">Add Category</button>
</form>
<br>

<?php if ($noCategory): ?>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#Category Id</th>
            <th scope="col">Category</th>
            <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <?php foreach ($categoryArray

            as $categories): ?>
        </tr>

        <tr>
            <td><?= $categories->catId ?></td>
            <td><?= $categories->catTitle ?></td>
            <td>
                <button class="btn btn-danger" type="submit">Delete</button>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

<?php endif ?>
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
