<?php

    require_once '../src/setup.php';
?>
<?php
    include'template/header_includes.php';
    include'template/navbar_includes.php';
    if (!isset($_SESSION['logIn'])):

?>
    <div class="alert alert-danger fade show" role="alert">
        <strong>You have been kicked out!</strong>
        <p>You broke our trust <i class="fas fa-heart-broken"></i></p>
    </div>
        <div class="error-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 ">
                        <div class="error-text">
                            <div class="im-sheep">
                                <div class="top">
                                    <div class="body"></div>
                                    <div class="head">
                                        <div class="im-eye one"></div>
                                        <div class="im-eye two"></div>
                                        <div class="im-ear one"></div>
                                        <div class="im-ear two"></div>
                                    </div>
                                </div>
                                <div class="im-legs">
                                    <div class="im-leg"></div>
                                    <div class="im-leg"></div>
                                    <div class="im-leg"></div>
                                    <div class="im-leg"></div>
                                </div>
                            </div>
                            <h4>Loyalty is rare nowadays right!?</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="alert alert-dark fade show" role="alert">
            <em>Don't worry.</em>
            <strong>We will give you another chance! <i class="far fa-smile-wink"></i></strong>
            <p><a href="login.php" class="btn btn-dark btn-round">Login here!</a></p>
        </div>


<?php
    endif;
include'template/footer_includes.php';
?>

