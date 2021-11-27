<div class="upload">
    <div class="container upload__wrapper">
        <form method="get" enctype="multipart/form-data">
            <div class="action-button d-flex justify-content-between  mt-4 mb-4">
                <a class="btn btn-outline-secondary px-4 py-2" href="/copixel">Batal</a>
                <button type="button" class="btn btn-primary px-4 py-2" id="button-next-upload" data-bs-toggle="modal"
                    data-bs-target="#inputTags" disabled>
                    Lanjut
                </button>
            </div>
            <div class="form-upload">
                <div class="form-upload__wrapper">
                    <div class="message">
                        <h3>Apa yang sedang kamu kerjakan?</h3>
                        <p>Gambar yang kamu unggah juga digunakan sebagai thumbnail pada feed kamu</p>
                    </div>
                    <div class="title">
                        <input type="text" class="input-form-upload title" id="title-form-upload" name="title"
                            placeholder="Masukan Nama Unggahan">
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
                        <input type="file" class="d-none" name="image" id="input-image-upload">
                    </div>
                    <div class="desc mt-5">
                        <textarea placeholder="Tulis apapun disini yang berkaitan dengan gambar mu"
                            class="input-form-upload" name="desc" id="" cols="30" rows="10"></textarea>
                    </div>
                </div>
            </div>


            <div class="modal fade" id="inputTags" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
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
                            <button type="submit" class="btn btn-primary">Unggah</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>