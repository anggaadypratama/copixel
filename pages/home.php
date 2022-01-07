<?php
    include_once 'utilities/cookiesData.php';

    $cookiesData = getCookies();
    $auth = isset($cookiesData) ? (boolean)$cookiesData[0] : false;

    $db = new DB();

    $from = <<<SQL
        Post.id_post,
        Post.title,
        Post.img_post,
        Post.description,
        Post.created_time,
        Post.id_users,
        Post.views,
        Users.name,
        Users.img_profile
SQL;

    $search = isset($_GET['search']) ? $_GET['search'] : '';

    $conditionalMessage = isset($search) && !empty($search) ?
                            "Berikut hasil pencarian dari <br>'<span>$search</span>'" :
                            "Temukan Gambar Favoritmu";

    if(isset($search)){
        $Join = <<<STR
            INNER JOIN Users
            ON Post.id_users = Users.id_users
            WHERE Post.title
            LIKE "%$search%"
            ORDER BY Post.created_time DESC
            LIMIT 10
STR;
    }else{
        $Join = <<<SQL
            INNER JOIN Users
            ON Post.id_users = Users.id_users
            ORDER BY Post.created_time DESC
            LIMIT 10
SQL;
    }

    $db->select('Post',$from, $Join);
    $res = $db->sql;
?>

<div class="home">
    <?php if(!$auth){
        echo <<<STR
            <div class="container mt-4">
                <div class="banner">
                    <div class="banner__wrapper">
                        <div class="desc">
                            <p>Temukan Gambar Dan Bagikan Gambarmu Disini</p>
                            <a href="?p=auth&s=register" class="btn btn-primary px-5 py-3 mt-4">Daftar</a>
                        </div>
                        <img loading="lazy" src="image/people.webp" alt="orang">
                    </div>
                </div>
            </div>
STR;
    }else{
        echo <<<STR
        <div class="container mt-4">
            <div class="message-wrapper">
                <div class="text-center mt-5 mb-5 conditional-message home">$conditionalMessage</div>
            </div>
        </div>
STR;
    }?>

    <div class="content">
        <div class="container-sm mt-4 mb-4">
            <div class="row gx-4 list-card" data-masonry='{"percentPosition": true }'>

                <?php
                        while($row = $res->fetch_assoc()){
                            $name = ucwords($row['name']);

                            $imgPost = base64_encode($row['img_post']);
                            $imgProfile = base64_encode($row['img_profile']);
                            
                            echo <<<STR
                            <div class="col-lg-4 col-xl-3 col-12 col-md-6 my-2 mb-4">
                                <div class="card">
                                    <a href="/?p=detail-post&pid={$row['id_post']}" class="image-wrapper">
                                        <div class="image-overlay">
                                            <div class="mx-3">
                                                <p>{$row['title']}</p>
                                            </div>
                                        </div>
                                        <img loading="lazy" class="image-card" loading=”lazy” src="data:image/webp;base64,$imgPost" alt="">
                                    </a>
                                    <div class="post-info mt-3">
                                        <a href="/?p=profile&uid={$row['id_users']}" class="account">
                                            <img loading="lazy"
                                                loading=”lazy”
                                                src="data:image/webp;base64,$imgProfile" 
                                                alt=""
                                                height="24"
                                                width="24"
                                                style="object-fit: cover; border-radius: 50%"
                                            >
                                            <p>{$name}</p>
                                        </a>
                                            <div>
                                                <div class="label">
                                                    <i class="fas fa-eye"></i>
                                                    <span>{$row['views']}</span>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
STR;
                        }
                    ?>

            </div>
            <div class="d-flex justify-content-center">
                <div class="loader"></div>
            </div>
            <div class="auth-overlay">
                <div class="auth-overlay__message">
                    <h1>Daftar untuk bisa melihat lebih banyak unggahan</h1>
                    <a href="?p=auth&s=register" class="btn btn-primary">Daftar</a>
                </div>
            </div>
        </div>
    </div>
</div>