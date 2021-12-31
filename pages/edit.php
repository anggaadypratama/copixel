<?php
    include_once 'utilities/cookiesData.php';

    $cookiesData = !empty(getCookies()) ? getCookies() : false;
    $auth = (boolean)$cookiesData[0];

    $pid = $_GET['pid'];

    if(!isset($_COOKIE['token']) || !$auth) {
        header('location: /');
        die();
    }

    $db->select('Post','*',"WHERE id_post=$pid");
    $res = $db->sql;
    $resVal = $res->fetch_assoc();
?>

<div class="upload">
    <div class="container upload__wrapper">
        <form method="post" id="submit-edit">
            <input type="hidden" name="pid" value="<?= $pid?>">
            <div class="action-button d-flex justify-content-between  mt-4 mb-4">
                <a class="btn btn-outline-secondary px-4 py-2"
                    href="?p=profile&uid=<?= $resVal['id_users'] ?>">Batal</a>
                <button type="button" class="btn btn-primary px-4 py-2" id="button-next-edit" data-bs-toggle="modal"
                    data-bs-target="#inputTags" disabled>
                    Lanjut
                </button>
            </div>
            <div class="form-upload">
                <div class="form-upload__wrapper">
                    <div class="title">
                        <input type="text" class="input-form-edit title" id="title-form-edit" name="title"
                            maxlength="49" placeholder="Masukan Nama Unggahan" value="<?= $resVal['title'] ?>">
                    </div>
                    <div class="drag-area">
                        <label for="input-image-edit" class="input-area" id="input-edit-area">
                            <div class="image-wrapper-ue">
                                <img src="<?= $resVal['img_post'] ?>" class="image-wrapper-ue__img" id="display-image"
                                    alt="image">
                                <div class="image-wrapper-ue__overlay" id="img-edit-overlay">
                                    <div class="information-wrapper">
                                        <i class="fas fa-image"></i>
                                        <h5>Ganti Gambar</h5>
                                    </div>
                                </div>
                            </div>
                        </label>
                        <input type="file" class="d-none" name="image-edit" id="input-image-edit">
                    </div>
                    <div class="desc mt-5">
                        <?php if(strlen($resVal['description']) > 0){ ?>
                        <textarea placeholder="Tulis apapun disini yang berkaitan dengan gambar mu"
                            class="input-form-edit" name="desc" id="" cols="30"
                            rows="10"><?= $resVal['description'] ?></textarea>
                        <?php }else{ ?>
                        <textarea placeholder="Tulis apapun disini yang berkaitan dengan gambar mu"
                            class="input-form-edit" name="desc" id="" cols="30" rows="10"></textarea>
                        <?php } ?>

                    </div>
                </div>
            </div>


            <div class="modal fade" id="inputTags" data-bs-backdrop="static" data-bs-tokenboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Kamu Yakin</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Ingin mengubah tersebut ?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                            <input type="submit" value="Ubah Postingan" name="submit" class="btn btn-primary">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modal-edit-alert" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="modal-error-edit-message"></p>
            </div>
            <div class="modal-footer" id="modal-confirm-footer">

            </div>
        </div>
    </div>
</div>