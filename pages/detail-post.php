<?php
    include '/utilities/cookiesData.php';
    include '/utilities/db.php';

    $cookiesData = getCookiesData();
    $auth = (boolean)$cookiesData[0];

    $db = new DB();
    
    $pid = $_GET['pid'];

    $from = <<<SQL
        Post.id_post,
        Post.title,
        Post.img_post,
        Post.description,
        Post.created_time,
        Post.id_users,
        Users.name,
        Users.img_profile
    SQL;

    $Join = <<<SQL
        INNER JOIN Users
        ON Post.id_users = Users.id_users
        WHERE id_post= $pid
    SQL;

    $db->select('Post',$from,$Join);
    $res = $db->sql;

    $resVal = $res->fetch_assoc();

    $date = explode(' ', $resVal['created_time']);
?>

<div class="detail-post container">
    <div class="row gx-5 mt-5">
        <div class="col-lg-7 col-12">
            <img class="image-post" src="<?= $resVal['img_post'] ?>" alt="image-post">
        </div>
        <div class="col-lg-5 col-12 mt-4">
            <div class="content border-bottom">
                <div class="content__top">
                    <h2><?= $resVal['title'] ?></h2>
                    <p><?= $resVal['description'] ?></p>
                </div>
                <div class="content__bottom mb-2">
                    <a href="/copixel?p=profile&uid=<?= $resVal['id_users']?>" class="profile">
                        <img class="profile__image"
                            src="https://www.anime-planet.com/images/characters/205377.jpg?t=1631194908"
                            alt="image-profile">
                        <span class="profile__name">
                            <?= ucwords($resVal['name'])?>
                        </span>
                    </a>
                    <div class="date">
                        <p class=" mt-3"><?= date('d M Y', strtotime($date[0])) ?></p>
                    </div>

                </div>

            </div>

        </div>
    </div>
</div>