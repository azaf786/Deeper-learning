<!DOCTYPE html>
<html lang="en">
<head>
    <?php include'template/header_includes.php'?>
    <title>Register</title>
</head>
<body>
<?php include'template/navbar_includes.php'?>

<div class="container m-4 d-flex flex-column mx-auto">
    <div class="card p-4">
        <h1 id="registerH1" class="text-center">Register</h1>
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
