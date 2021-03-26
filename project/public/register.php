
<?php

use App\Hydrator\EntityHydrator;
use User\User;

require_once '../src/setup.php';

$register = false;
if(isset($_POST['username'], $_POST['email'], $_POST['password'], $_POST['confirmPass'])){
    if ($_POST['password'] === $_POST['confirmPass']){
        $formUser = [
            'username' => strip_tags($_POST['username']),
            'email' => filter_var($_POST['email']), FILTER_SANITIZE_EMAIL,
            'password' => password_hash($_POST['password'], PASSWORD_DEFAULT)
        ];

        $hydrator = new EntityHydrator();
        $formUser = $hydrator->hydrateUser($formUser);

        $user = $dbProvider->createUser($formUser);
        $register = true;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include'template/header_includes.php'?>
    <title>Register</title>
</head>
<body>
<?php include'template/navbar_includes.php'?>

<?php if($register): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Account Created Successfully!</strong><a href="login.php"> Login here.</a>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>

<div class="container m-4 d-flex flex-column mx-auto">
    <div class="card p-4">
        <h1 id="registerH1" class="text-center bannerText">Register</h1>
        <form action="" method="post" class="form-group bg-light p-4 my-2 rounded">
            <div class="form-group">
                    <label for="username">Username</label>
                <input type="text" class="form-control" name="username" id="username" aria-describedby="username"
                       placeholder="Choose a username" required>
                <small class="form-text text-muted">Username has to be unique.</small>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email" aria-describedby="email"
                       placeholder="Enter your email address" required>
                <small class="form-text text-muted">Only use the email you currently have access to.</small>
            </div>
            <div class="form-group">
                <label for="b">Password</label>
                <input type="password" class="form-control" name="password" id="password" aria-describedby="password"
                       minlength="8" placeholder="Choose a password that is 8 digits long." required>
                <small class="form-text text-muted">8 digit passwords give hackers a hard time.</small>
            </div>
            <div class="form-group">
                <label for="confirmPass">Confirm Password</label>
                <input type="password" class="form-control" name="confirmPass" id="confirmPass" aria-describedby="confirmPass"
                       minlength="8" placeholder="Confirm your password." required>
                <small class="form-text text-muted">This is the same password you entered above.</small>
            </div>

            <br>
            <button type="submit" class="btn btn-info">Register</button>

        </form>



    </div>
</div>

<?php include'template/footer_includes.php'?>

</body>
</html>
