const Upload = () => {
    const dropArea = document.getElementById('input-upload-area'),
        input = document.getElementById('input-image-upload'),
        inputTitle = document.querySelectorAll('.input-form-upload'),
        message = document.querySelector('.message'),
        titleForm = document.getElementById('title-form-upload'),
        buttonNext = document.getElementById('button-next-upload'),
        modalUploadAlert = document.getElementById('modal-upload-alert'),
        modalErrorUploadMessage = document.getElementById('modal-error-upload-message')

        const alertModal = new bootstrap.Modal(modalUploadAlert)

    let file

    buttonNext.disabled = !inputTitle[0].value


    input.addEventListener('change', function(){
        file = this.files[0];
        dropArea.classList.add('active')
        showImage()
    })

    dropArea.addEventListener('dragover', (e) => {
        e.preventDefault()
        dropArea.classList.add('active')
    })

    dropArea.addEventListener('dragleave', (e) => {
        e.preventDefault()
        dropArea.classList.remove('active')
    })

    dropArea.addEventListener('drop', (e) => {
        e.preventDefault()
        file = e.dataTransfer.files[0]
        showImage()
    })

    titleForm.addEventListener('keyup', (e) => {
        buttonNext.disabled = !(e.target.value)
    })



    const showImage = () => {
        let fileType = file.type

        let validExtensions = ["image/jpeg", "image/jpg", "image/png"]

        if(validExtensions.includes(fileType)){
            if(file.size/(1024**2) < 5){
                let fileReader = new FileReader()

                fileReader.readAsDataURL(file);
    
                fileReader.onload = () => {
                    let fileURL = fileReader.result
    
                    message.style.display = 'none';
                    inputTitle[0].classList.add('active')
                    inputTitle[1].classList.add('active')

                    let imgTag = `
                    <div class="image-wrapper-ue">
                        <img src="${fileURL}" class="image-wrapper-ue__img" alt="image">
                        <div class="image-wrapper-ue__overlay">
                            <div class="information-wrapper">
                                <i class="fas fa-image"></i>
                                <h5>Ganti Gambar</h5>
                            </div>
                        </div>
                    </div>`;
                    dropArea.innerHTML = imgTag;
                    dropArea.classList.add('image-exists')
                }
            }else{
                alertModal.show()
                modalErrorUploadMessage.innerHTML = `Ukuran gambar terlalu besar, Maksimal adalah 5MB`
                dropArea.classList.remove("active");
            }
        }else{
            alertModal.show()
            modalErrorUploadMessage.innerHTML = `<b>${file.name}</b> Ini bukan format gambar!`
            dropArea.classList.remove("active");
        }
    }
}





Upload()
