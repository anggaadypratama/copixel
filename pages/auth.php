<?php
    $pages = !empty($_GET['s']) ?
                    $_GET['s'] :
                    header('location:?p=auth&s=login');
?>

<div class="row">
    <div class="col-3 d-lg-block d-none">
        <div class="right-section">
            <div class="right-section__wrapper">
                <h1 class="welcome-title">Welcome <?= ($pages == 'login') ? 'Back' : '' ?></h1>
                <p class="welcome-desc">To keep connected with us
                    <?= ($pages == 'login') ? 'please login' : 'you can register' ?> with your personal info</p>
                <a class="btn btn-light mt-4 py-3" href="?p=auth&s=<?= ($pages == 'login') ? 'register' : 'login'?>">
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
                    <form>
                        <div class="row">
                            <?php 
                            if($pages == "register"){
                                ?>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="exampleInputName1" class="form-label">Name</label>
                                    <input type="text" class="form-control form-control-lg" id="exampleInputName1"
                                        aria-describedby="nameHelp">
                                </div>
                            </div>
                            <?php
                            }
                        ?>

                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                                    <input type="email" class="form-control form-control-lg" id="exampleInputEmail1"
                                        aria-describedby="emailHelp">
                                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.
                                    </div>
                                </div>
                            </div>
                            <div class="col-<?= ($pages == 'login') ? '12' : '6' ?> ">
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Password</label>
                                    <input type="password" class="form-control form-control-lg"
                                        id="exampleInputPassword1">
                                </div>
                            </div>
                            <?php
                                if($pages == 'register'){
                                    ?>

                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="exampleInputRetypePassword1" class="form-label">Retype Password</label>
                                    <input type="password" class="form-control form-control-lg"
                                        id="exampleInputRetypePassword1">
                                </div>
                            </div>
                            <?php
                                }
                            ?>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary px-5 py-3 mt-3">
                                <?= ($pages == 'login') ? 'Login' : 'Register' ?></button>
                            <a class="redirect-auth btn"
                                href="?p=auth&s=<?= ($pages == 'login') ? 'register' : 'login'?>">
                                <?= ($pages == 'login') ? 'Register' : 'Login' ?>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>