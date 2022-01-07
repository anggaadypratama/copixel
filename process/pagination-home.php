<?php
    include_once '../utilities/cookiesData.php';

    $cookiesData = getCookies();
    $auth = isset($cookiesData) ? (boolean)$cookiesData[0] : false;
    
    $pages = isset($_POST['pages']) ? (int)$_POST['pages'] : 1;

    $dataPerPage= 10;
    $offset = $pages*$dataPerPage;


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
    
    $opt = <<<SQL
            INNER JOIN Users
            ON Post.id_users = Users.id_users
            ORDER BY Post.created_time DESC
            LIMIT $offset, $dataPerPage
SQL;

    $db->select('Post',$from, $opt);
    $res = $db->sql;

    while($row = mysqli_fetch_array($res)){

        $imgPost = base64_encode($row['img_post']);
        $imgProfile = base64_encode($row['img_profile']);
        $name = ucwords($row['name']);

        echo <<<STR
        <div class="col-lg-4 col-xl-3 col-12 col-md-6 my-2 mb-4">
            <div class="card">
                <a href="/copixel?p=detail-post&pid={$row['id_post']}" class="image-wrapper">
                    <div class="image-overlay">
                        <div class="mx-3">
                            <p>{$row['title']}</p>
                        </div>
                    </div>
                    <img class="image-card" loading=”lazy” src="data:image/webp;base64,$imgPost" alt="">
                </a>
                <div class="post-info mt-3">
                    <a href="/copixel?p=profile&uid={$row['id_users']}" class="account">
                        <img
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