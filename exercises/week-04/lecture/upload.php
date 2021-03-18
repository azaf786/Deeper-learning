<?php

require_once '../setup.php';

if (!empty($_POST)) {
    var_dump($_POST);
}

if (!empty($_FILES)) {

    var_dump($_FILES);

    if (!empty($_FILES['profilePic'])) {
        $file = $_FILES['profilePic'];


        if ($file['error'] !== UPLOAD_ERR_OK) {
            echo "File could not be uploaded";
        }

        $targetPath = '../uploads/' . time() . '_' . $file['name'];
        if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
            echo "Not uploaded because of error #" . $_FILES["profilePic"]["error"];
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>File Upload</title>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial=1.0, shrinktofit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" class="form-control">
    </div>
    <div class="form-group">
        <label for="profilePic">Profile Picture</label>
        <input type="file" id="profilePic" name="profilePic" class="form-control-file" multiple>
    </div>
    <button type="submit" class="btn btn-primary">Upload</button>
</form>
</html>
