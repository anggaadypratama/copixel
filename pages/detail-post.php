<?php
    include '/utilities/cookiesData.php';

    $cookiesData = getCookiesData();
    $auth = (boolean)$cookiesData[0];
    
    $pid = $_GET['pid'];

    $postSelect = <<<SQL
        Post.id_post,
        Post.title,
        Post.img_post,
        Post.description,
        Post.created_time,
        Post.views,
        Post.id_users,
        Users.name,
        Users.img_profile
    SQL;

    $postJoin = <<<SQL
        INNER JOIN Users
        ON Post.id_users = Users.id_users
        WHERE id_post= $pid
    SQL;

    function getData($con, $tb, $select, $opt = NULL){
        $con->select($tb, $select, $opt);
        $res = $con->sql;

        $val = $res->fetch_assoc();

        return $val;
    }

    $postVal = getData($db,'Post', $postSelect, $postJoin);
    $userVal = $auth && cookiesData[1] ? getData($db, 'Users', '*', "WHERE id_users = $cookiesData[1]"): null;

    $views = (int)$postVal['views'] += 1;

    $db->update('Post',['views' => $views], "id_post=$pid");

    $date = explode(' ', $postVal['created_time']);
?>

<div class="detail-post container">
    <div class="row detail-post__wrapper">
        <div class="col-lg-7 col-12 px-2 px-lg-5">
            <img class="image-post" src="<?= $postVal['img_post'] ?>" alt="image-post">
        </div>
        <div class="col-lg-5 col-12">
            <div class="content ">
                <div class="content__top">
                    <h2><?= $postVal['title'] ?></h2>
                    <p><?= $postVal['description'] ?></p>
                </div>
                <div class="content__bottom border-bottom mt-4 mb-4">
                    <a href="/copixel?p=profile&uid=<?= $postVal['id_users']?>" class="profile">
                        <img class="profile__image" src="<?= $postVal['img_profile']?>" alt="image-profile">
                        <span class="profile__name">
                            <?= ucwords($postVal['name'])?>
                        </span>
                    </a>
                    <div class="date">
                        <p class=" mt-3"><?= date('d M Y', strtotime($date[0])) ?></p>
                    </div>

                </div>
                <?php if($auth && cookiesData[1]){ ?>
                <div class="content__comment-section">
                    <div class="input-comment">
                        <img src="<?= $userVal ? $userVal['img_profile'] : ''?>" class="input-comment__img " alt="">
                        <form action="process/comment.php" method="post" class="input-comment__wrapper">
                            <input type="hidden" name="uid" value="<?= $cookiesData[1] ?>">
                            <input type="hidden" name="pid" value="<?= $pid ?>">
                            <div class="input-comment__section">
                                <textarea class="input-comment__input" id="textarea-comment" name="comment"
                                    maxlength="250" placeholder="Masukan pendapatmu..."></textarea>
                            </div>
                            <div class="input-comment__submit">
                                <label for="comment-submit">
                                    <i class="fas fa-paper-plane"></i>
                                </label>
                                <input type="submit" id="comment-submit" class="comment-submit" name="submit" disabled>
                            </div>
                        </form>
                    </div>
                    <?php }?>

                    <?php include 'components/list-comment.php'; ?>
                </div>

            </div>

        </div>
    </div>
</div>