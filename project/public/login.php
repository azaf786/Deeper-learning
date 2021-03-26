<?php

require_once '../src/setup.php';

if(isset($_POST['email'], $_POST['password'])){
    $user = $dbProvider->getUserByEmail($_POST['email']);

    if($user && password_verify($_POST['password'], $user->password)){
        $_SESSION['loginId'] = $user->id;
        header('Location: index.php');
        exit;
    }
    else{
        $errorMessage = 'Incorrect email or password.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include'template/header_includes.php'?>
    <title>Login</title>
</head>
<body>
<?php include'template/navbar_includes.php'?>

<?php if (isset($errorMessage)): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong> Incorrect details!</strong> Please try again or if you are a new user <a href="register.php">register here.</a>

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif ?>

<div class="container m-4 d-flex flex-column mx-auto">

    <div class="card p-4">
        <h1 id="loginH1" class="text-center bannerText">Login</h1>
        <form action="" method="post" autocomplete="off" class="form-group bg-light p-4 my-2 rounded">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email" aria-describedby="email"
                       placeholder="Enter your email address" value="<?= $_POST['email'] ?? '' ?>" required>
                <small class="form-text text-muted">Welcome back. We are excited to show you your personalised deals.</small>
            </div>
            <div class="form-group">
                <label for="b">Password</label>
                <input type="password" class="form-control" name="password" id="password" aria-describedby="password"
                       minlength="8" placeholder="Enter your password." required>
                <small class="form-text text-muted">Hint: password needs to be 8 characters long.</small>
            </div>

            <br>
            <button type="submit" class="btn btn-info">Login</button>

        </form>



    </div>
</div>





<?php include'template/footer_includes.php'?>

</body>
</html>
