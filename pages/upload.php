<?php
    include_once 'utilities/cookiesData.php';

    $cookiesData = getCookies();
    $auth = (boolean)$cookiesData[0];

    if(!isset($_COOKIE['token']) || !$auth) {
        echo "<script type=\"text/javascript\">
        window.location.replace('/')
        </script>";
    }
?>

<div class="upload">
    <div class="container upload__wrapper">
        <form method="post" id="submit-upload">
            <div class="action-button d-flex justify-content-between  mt-4 mb-4">
                <a class="btn btn-outline-secondary px-4 py-2" href="/">Batal</a>
                <button type="button" class="btn btn-primary px-4 py-2" id="button-next-upload" data-bs-toggle="modal"
                    data-bs-target="#inputTags" disabled>
                    Lanjut
                </button>
            </div>
            <div class="form-upload">
                <div class="form-upload__wrapper">
                    <div class="message">
                        <h3>Apa yang akan kamu bagikan?</h3>
                        <p>Gambar yang kamu unggah juga digunakan sebagai thumbnail pada feed kamu</p>
                    </div>
                    <div class="title">
                        <input type="text" class="input-form-upload title" id="title-form-upload" name="title" required
                            maxlength="49" placeholder="Masukan Nama Unggahan">
                    </div>
                    <div class="drag-area">
                        <label for="input-image-upload" class="input-area" id="input-upload-area">
                            <div class="input-area__wrapper">
                                <div class="input-area__message">
                                    <p>Seret dan jatuhkan gambar, atau <span>Jelajahi</span></p>
                                    <p id="helper-message">Gambar Maksimal 5MB (png, jpg, jpeg)</p>
                                </div>
                            </div>
                        </label>
                        <input type="file" class="d-none invisible" name="image-form-upload" id="input-image-upload">
                    </div>
                    <div class="desc mt-5">
                        <textarea placeholder="Tulis apapun disini yang berkaitan dengan gambar mu"
                            class="input-form-upload" name="desc" cols="30" rows="10"></textarea>
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
                            Ingin mengunggah gambar tersebut ?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                            <input type="submit" value="Unggah" name="submit" class="btn btn-primary">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modal-upload-alert" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title"></h5>
                <button type="button" class="btn-close btn-post" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="modal-error-upload-message"></p>
            </div>
            <div class="modal-footer" id="modal-confirm-footer">

            </div>

        </div>
    </div>
</div>