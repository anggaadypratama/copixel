

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
            if(file.size/(1024**2) < 5){
                let fileReader = new FileReader()

                fileReader.readAsDataURL(file);
    
                fileReader.onload = () => {
                    let fileURL = fileReader.result
    
                    message.style.display = 'none';
                    inputTitle[0].classList.add('active')
                    inputTitle[1].classList.add('active')
    
    
                    let imgTag = `<img src="${fileURL}" class="input-image" alt="image">`;
                    dropArea.innerHTML = imgTag;
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

const Navbar = () => {
    const imgProfile = document.getElementById('dropdownProfile')
    const overlay = document.getElementById('overlay')

    imgProfile.onclick = () => {
        overlay.classList.toggle('active')
    }

    document.body.addEventListener('click',() =>{
        overlay.classList.remove('active')
    },true)
}

Navbar()
Upload()