

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a id="logo" class="navbar-brand" href="../public/index.php">aShoe</a>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="../public/recentlyAdded.php"><i class="fas fa-fire"></i>Recently Added</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../public/allProducts.php"><i class="fas fa-shoe-prints"></i>All Products</a>
            </li>
        </ul>
        <ul class="navbar-nav  mt-2 mt-lg-0">

            <?php if(!empty($loggedInUser)): ?>
                <div class="dropdown show mr-5">
                    <a class="btn btn-info dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Hello (<strong><?= $loggedInUser->username ?></strong>)
                    </a>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item btn-light" href="../public/createProduct.php">Create Product</a>
                        <a class="dropdown-item btn-light" href="../public/logout.php">Buy from Nike</a>
                    </div>
                </div>

            <?php else: ?>
                <li>
                    <a class="nav-link" href="../public/login.php"><i class="fas fa-sign-in-alt"></i>Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../public/register.php">Register</a>
                </li>
            <?php endif; ?>

        </ul>



        <form class="form-inline my-2 my-lg-0" action="../public/searchProduct.php" method="POST">
            <input class="form-control mr-sm-2" id="search" name="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>



