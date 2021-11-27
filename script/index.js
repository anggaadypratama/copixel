

const Upload = () => {
    const dropArea = document.getElementById('input-upload-area'),
        input = document.getElementById('input-image-upload'),
        inputTitle = document.querySelectorAll('.input-form-upload'),
        message = document.querySelector('.message'),
        titleForm = document.getElementById('title-form-upload'),
        buttonNext = document.getElementById('button-next-upload')
    let file

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
        buttonNext.disabled = !(e.target.value);
    })

    const showImage = () => {
        let fileType = file.type
        let validExtensions = ["image/jpeg", "image/jpg", "image/png"]

        if(validExtensions.includes(fileType)){
            let fileReader = new FileReader()

            fileReader.readAsDataURL(file);

            fileReader.onload = () => {
                let fileURL = fileReader.result

                message.style.display = 'none';
                inputTitle[0].classList.add('active')
                inputTitle[1].classList.add('active')

                

                let imgTag = `<img src="${fileURL}" alt="image" width="700px" height="440px">`;
                dropArea.innerHTML = imgTag;
                dropArea.classList.add('image-exists')
            }


        }else{
            alert("This is not an Image File!");
            dropArea.classList.remove("active");
            dragText.textContent = "Drag & Drop to Upload File";
        }
    }
}

Upload()