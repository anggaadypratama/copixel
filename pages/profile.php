<?php
    include_once 'utilities/cookiesData.php';

    $cookiesData = getCookies();
    $auth = isset($cookiesData) ? (boolean)$cookiesData[0] : false;

    $db = new DB();
                    
    $uid = $_GET['uid'];

?>


<div class="profile">
    <div class="container-md">
        <div class="identity border-bottom">
            <?php include "components/edit-profile.php"; ?>
        </div>
        <div class="content mt-4">
            <div class="row list-card" data-masonry='{"percentPosition": true }'>
                <?php


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
                        WHERE Post.id_users = $uid
                        ORDER BY Post.created_time DESC
                        LIMIT 10
                    SQL;
                    
                    $db->select('Post',$from,$Join);
                    $res = $db->sql;
                    
                    if($res->num_rows < 1){
                        echo "Gak Ada Gambar";
                    }else{
                        $i=0;
                        while($row = $res->fetch_assoc()){
                            $header = <<<STR
                                <div class="col-lg-4 col-xl-3 col-12 col-md-6 my-2 mb-3">
                                    <div class="card">
STR;



                            $img = base64_encode($row['img_post']);

                            if($auth && $uid === $cookiesData[1]){
                                $titleModal = $row['title'];
                                $idModal = $row['id_post'];

                                $header .= <<<STR
                                    <div class="image-option">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-detail" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu mt-1 dropdown-menu-end shadow">
                                                <li><a href="?p=edit&pid=$idModal" class="dropdown-item">Edit</a></li>
                                                <li><button type="button" class="dropdown-item danger" data-bs-toggle="modal" data-bs-target="#deleteModal-$i">Delete</button></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="deleteModal-$i" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Hapus Postingan</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah kamu yakin ingin menghapus postingan <b>'$titleModal</b>'
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                <a href="process/delete-post.php?pid=$idModal&uid=$cookiesData[1]" class="btn btn-primary">Hapus</a>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
STR;
                            }

                            $header .= <<<STR
                                        <a href="/copixel?p=detail-post&pid={$row['id_post']}" class="image-wrapper">
                                            <div class="image-overlay">
                                    
                                                <div class="mx-3">
                                                    <p>{$row['title']}</p>
                                                </div>
                                            </div>
                                            <img loading="lazy" class="image-card" loading=???lazy??? src="data:image/webp;base64,$img" alt="">
                                        </a>
                                    </div>
                                </div>
STR;

                            echo $header;
                            
                            $i+=1;
                        }
                    }
                ?>
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