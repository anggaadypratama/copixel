<?php
        include_once 'utilities/cookiesData.php';

        $cookiesData = getCookies();
        $auth = (boolean)$cookiesData[0];

        $pid = $_GET['pid'];

        $commentFrom = <<<SQL
            	Comment.id_comment,
                Comment.body,
                Comment.timestamp,
                Users.id_users,
                Users.name,
                Users.img_profile
        SQL;

        $commentJoin = <<<SQL
            INNER JOIN Users ON Comment.id_users = Users.id_users 
            WHERE Comment.id_post = $pid
            ORDER BY Comment.timestamp DESC
        SQL;

        $db->select('Comment',$commentFrom, $commentJoin);
        $res = $db->sql;
?>


<div class="list-comment <?= $auth ? 'mt-4' : ''  ?>">
    <?php 
    $i = 0;
    while($row = $res->fetch_assoc()){
        $idComment = $row['id_comment'];

        $imgProfile = base64_encode($row['img_profile']);


        $date = date('H:i ~ d M Y', strtotime($row['timestamp']));

        echo <<<STR
            <div class="comment-section">
                <img class="comment-section__img" src="data:image/webp;base64,$imgProfile" loading="lazy" alt="{$row['name']}">
                <div class="comment-section__body">
                    <div class="comment-header">
                        <a href="?p=profile&uid={$row['id_users']}">{$row['name']}</a>

        STR;

        echo ($row['id_users'] === $cookiesData[1]) ? 
            <<<STR
                <div class="dropdown">
                    <button class="btn btn-light" type="button" id="dropdown-comment-$i" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-ellipsis-h"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-comment-$i">
                        <li>
                            <button type="button" class="dropdown-item danger" data-bs-toggle="modal" data-bs-target="#verifyDeleteComment">
                                Delete
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="modal fade" id="verifyDeleteComment" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Hapus Komentar</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Apakah kamu yakin ingin menghapus komentar?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-ligth" data-bs-dismiss="modal">Batal</button>
                            <a type="button" class="btn bg-danger text-white" href="process/delete-comment.php?cid=$idComment&pid=$pid">Delete</a>
                        </div>
                        </div>
                    </div>
                </div>
            STR
            : "";

            

        echo <<<STR
                    </div>
                    <p class="comment-body">{$row['body']}</p>
                    <p class="comment-date">{$date}</p>
                </div>
            </div>
        STR;

        $i++;
    } ?>

</div>