import Resizer from 'https://cdn.skypack.dev/react-image-file-resizer';

const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);

const modalConfirm = new bootstrap.Modal(document.getElementById('inputTags'))
const modalConfirmBtn = document.getElementById('modal-confirm-footer')

const editValue = {
    dropArea : document.getElementById('input-edit-area'),
    input : document.getElementById('input-image-edit'),
    inputTitle : document.querySelectorAll('.input-form-edit'),
    titleForm : document.getElementById('title-form-edit'),
    buttonNext : document.getElementById('button-next-edit'),
    displayImage : document.getElementById('display-image'),
    modalAlert : document.getElementById('modal-edit-alert'),
    modalMessage : document.getElementById('modal-error-edit-message'),
    modalTitle: document.getElementById('modal-title'),
    modalBtn: document.querySelector('.btn-post'),
    imgOverlay : document.getElementById('img-edit-overlay'),
    submit: document.getElementById('submit-edit')
}

const uploadValue = {
    dropArea : document.getElementById('input-upload-area'),
    input : document.getElementById('input-image-upload'),
    inputTitle : document.querySelectorAll('.input-form-upload'),
    message : document.querySelector('.message'),
    titleForm : document.getElementById('title-form-upload'),
    buttonNext : document.getElementById('button-next-upload'),
    modalAlert : document.getElementById('modal-upload-alert'),
    modalTitle: document.getElementById('modal-title'),
    modalMessage : document.getElementById('modal-error-upload-message'),
    modalBtn: document.querySelector('.btn-post'),
    submit: document.getElementById('submit-upload')
}

const page = urlParams.get('p') === 'upload' ? 'upload' : 'edit'
const value = urlParams.get('p') === 'upload' ? uploadValue : editValue
const uid = urlParams.get('uid')

Post(value, page )

function Post(values, status){
    const {
        dropArea, 
        input, 
        inputTitle,
        titleForm,
        buttonNext,
        displayImage,
        modalAlert,
        modalMessage,
        imgOverlay,
        modalTitle,
        modalBtn,
        message,
        submit
    } = values

    let file

    const imageCompression = (imageFile) => new Promise((resolve) => {
        Resizer.imageFileResizer(
            imageFile,
            2000,
            2000,
            "webp",
            50,
            0,
            (uri) => {
              resolve(uri);
            },
            "file"
          );
    })

    buttonNext.disabled = !inputTitle[0]?.value

    const alertModal = new bootstrap.Modal(modalAlert)

    input.addEventListener('change', function(){
        file = this.files[0];
        dropArea.classList.add('active')

        showImage()
    })

    titleForm.addEventListener('keyup', (e) => {
        buttonNext.disabled = !(e.target.value);
    })

    dropArea.addEventListener('drop',(e) => {
        e.preventDefault()
        file = e.dataTransfer.files[0]


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

    const upload = (fileURL) => {
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
        message.style.display = 'none';
    }

    const showImage = async () => {
        let fileType = file.type
        let validExtensions = ["image/jpeg", "image/jpg", "image/png"]

        if(validExtensions.includes(fileType)){
            if(file.size/(1024**2) < 5){
                let fileReader = new FileReader()

                fileReader.readAsDataURL(file);
    
                fileReader.onload = () => {
                    let fileURL = fileReader.result
    
                    inputTitle[0].classList.add('active')
                    inputTitle[1].classList.add('active')

                    if(status === 'upload'){
                        upload(fileURL)
                    }else{
                        displayImage.src = fileURL
                    }

                    input.value
    
                    dropArea.classList.add('image-exists')
                }
            }else{
                alertModal.show()
                modalTitle.innerHTML = `❌ Error`
                modalMessage.innerHTML = `Ukuran gambar terlalu besar, Maksimal adalah 5MB`
                dropArea.classList.remove("active");
            }
        }else{
            alertModal.show()
            modalTitle.innerHTML = `❌ Error`
            modalMessage.innerHTML = `<b>${file.name}</b> Ini bukan format gambar!`
            dropArea.classList.remove("active");
        }
    }

    const request = async (url, init, cb) => {
        const res = await fetch(url, init)
        const data = await res.json()
        cb(data)
      }

    submit.addEventListener('submit',async (e) =>{
        e.preventDefault()

        const image = file && await imageCompression(file)

        const formData = new FormData()
        formData.append('title', inputTitle[0].value)
        formData.append('desc', inputTitle[1].value)
        file && formData.append(`image-form-${page}`, image)
        formData.append(`pid`, urlParams.get('pid'))

        request(`process/${page}-post.php`,{
            method: 'POST',
            body: formData
        },(res) => {
            if(res.status) {
                modalConfirm.hide()
                alertModal.show()
                modalTitle.innerHTML = `✅ Success`
                modalMessage.innerHTML = `Berhasil meng${page === 'upload'? 'unggah' : 'ubah'} postingan`
                modalConfirmBtn.innerHTML = `<a href="?p=profile&uid=${res.uid}" class="btn btn-primary">Kembali</a>`
                dropArea.classList.remove("active");
                // location.href = `?p=profile&uid=${res.uid}`
            }
        })
    })

    imgOverlay.addEventListener('dragover',(e) =>{
        e.preventDefault()
        imgOverlay.classList.add('active')
    })

    imgOverlay.addEventListener('dragleave',(e) =>{
        e.preventDefault()
        imgOverlay.classList.remove('active')
    })

    imgOverlay.addEventListener('drop',(e) =>{
        e.preventDefault()
        imgOverlay.classList.remove('active')
    })
}


