<?php

require_once '../src/setup.php';

use \App\Entity\CheckIn;
use Carbon\carbon;

if (empty(isset($_POST))) {
    echo "Fields empty";
    die();
}
if (!empty($_POST)) {

    $carbon = Carbon::now();

    $checkins = new CheckIn();
    $checkins->name = $_POST['name'];
    $checkins->email = $_POST['email'];
    $checkins->dob = $_POST['dob'];
    $checkins->profilePic = $_POST['profilePic'];
    $checkins->timeposted = $carbon;

    if (move_uploaded_file($_FILES['profilePic']['tmp_name'], "../uploads" . $carbon )) {
        print "Uploaded successfully!";
    } else {
        print "Upload failed!";
    }

    $serializeInputData = serialize($checkins);
    $createFile = file_put_contents($carbon . '.txt', $serializeInputData);
    var_dump($checkins);

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

        .result {
            background-color: #88CC88;
        }

        tr {
            cursor: pointer;
        }

    </style>
</head>
<body>


<form id="formCalculate" name="formCalculate" action="" method="post" class="form-group bg-light p-3 my-2">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" id="name" aria-describedby="name"
               placeholder="Enter your full name">
        <small class="form-text text-muted">No nicknames allowed.</small>
    </div>
    <div class="form-group">
        <label for="dob">Date of birth</label>
        <input type="date" class="form-control" name="dob" id="dob" aria-describedby="dob"
               placeholder="Enter your date of birth">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="email" id="email" aria-describedby="email"
               placeholder="Enter your email address">
        <small class="form-text text-muted">Only use the email you have access to.</small>
    </div>
    <div class="form-group">
        <label for="profilePic">Profile picture</label>
        <input type="file" class="form-control file" name="profilePic" id="profilePic" aria-describedby="profilePic">
        <small class="form-text text-muted">Upload your profile</small>
    </div>
    <br>
    <button type="submit" class="btn btn-primary">Submit</button>


</form>

<div class="form-group rounded p-3 result">
    <label class="p-2" for="result">Result</label>
    <input type="text" class="form-control" name="result" id="result" aria-describedby="result" value="" readonly>
    <small id="result" class="form-text text-muted">Your result will appear here.</small>
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
