const UploadEdit = () => {
    const dropArea = document.getElementById('input-edit-area'),
        input = document.getElementById('input-image-edit'),
        inputTitle = document.querySelectorAll('.input-form-edit'),
        titleForm = document.getElementById('title-form-edit'),
        buttonNext = document.getElementById('button-next-edit'),
        displayImage = document.getElementById('display-image')
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
        console.log(e.target.value)
        buttonNext.disabled = !(e.target.value);
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
    
                    inputTitle[0].classList.add('active')
                    inputTitle[1].classList.add('active')


                    displayImage.src = fileURL
    
                    dropArea.classList.add('image-exists')
                }
            }else{
                alert("Ukuran Gambar Terlalu besar!");
                dropArea.classList.remove("active");
            }
        }else{
            alert("Ini bukan format gambar!");
            dropArea.classList.remove("active");
        }
    }
}

UploadEdit()