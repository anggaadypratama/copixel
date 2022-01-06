<?php
    include 'utilities/cookiesData.php';

    $cookiesData = getCookies();
    $auth = isset($cookiesData) ? (boolean)$cookiesData[0] : false;

    if(isset($_COOKIE['token']) && $auth) {
                echo "<script type=\"text/javascript\">
        window.location.replace('/copixel')
        </script>";
        
    }

    $pages = !empty($_GET['s']) ?
                        ($_GET['s'] === 'login' || $_GET['s'] === 'register') ?
                            $_GET['s'] : header('location:/copixel?p=error') :
                    header('location: /copixel?p=auth&s=login');
?>

<div class="row">
    <div class="col-3 d-lg-block d-none">
        <div class="right-section">
            <div class="right-section__wrapper">
                <h1 class="welcome-title">Welcome <?= ($pages == 'login') ? 'Back' : '' ?></h1>
                <p class="welcome-desc">To keep connected with us
                    <?= ($pages == 'login') ? 'please login' : 'you can register' ?> with your personal info</p>
                <a class="btn btn-light mt-4 py-3"
                    href="/copixel?p=auth&s=<?= ($pages == 'login') ? 'register' : 'login'?>">
                    <?= ($pages == 'login') ? 'Register' : 'Login' ?>
                </a>
            </div>
        </div>
    </div>
    <div class="col-lg-9 col-md-12">
        <div class="container">
            <div class="left-section">
                <div class="left-section__wrapper">
                    <h1 class="mb-5 title-page"><?= $pages?></h1>
                    <form name="auth" method="post">
                        <div class="row">
                            <?php 
                            if($pages == "register"){
                                ?>
                            <input type="hidden" name="img-url" id="img-url">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="exampleInputName1" class="form-label">Name</label>
                                    <input type="text" class="form-control form-control-lg" name="name" required
                                        id="exampleInputName1" aria-describedby="nameHelp">
                                </div>
                            </div>
                            <?php
                            }
                        ?>

                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                                    <input type="email" class="form-control form-control-lg" name="email" required
                                        id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>
                            </div>
                            <div class="col-lg-<?= ($pages == 'login') ? '12' : '6' ?> col-12">
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Password</label>
                                    <input type="password" class="form-control form-control-lg" name="password" required
                                        id="exampleInputPassword1">
                                </div>
                            </div>
                            <?php
                                if($pages == 'register'){
                                    ?>

                            <div class="col-lg-6 col-12">
                                <div class="mb-3">
                                    <label for="exampleInputRetypePassword1" class="form-label">Retype
                                        Password</label>
                                    <input type="password" class="form-control form-control-lg" name="r_password"
                                        required id="exampleInputRetypePassword1">
                                </div>
                            </div>
                            <?php
                                }
                            ?>
                        </div>
                        <div class="alert alert-danger d-none" role="alert" id="auth-alert">
                        </div>
                        <div class="d-flex justify-content-between">
                            <input value="<?= ($pages == 'login') ? 'Login' : 'Register' ?>" name="submit" type="submit"
                                class="btn btn-primary px-5 py-3 mt-3">
                            <a class="redirect-auth btn"
                                href="/copixel?p=auth&s=<?= ($pages == 'login') ? 'register' : 'login'?>">
                                <?= ($pages == 'login') ? 'Register' : 'Login' ?>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>