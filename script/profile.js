import Resizer from 'https://cdn.skypack.dev/react-image-file-resizer';

const ShowImageProfile = () => {
    const input = document.getElementById('img-profile')
    const img = document.getElementById('profile-img')

    input.addEventListener("change", () => {
        const file = input.files[0];
        const fileReader = new FileReader()
        fileReader.readAsDataURL(file);

        fileReader.onload = () => {
            const fileURL = fileReader.result
            img.src = fileURL 
        }
    });
}

const EditProfile = () => {
    const editBtn = document.getElementById('edit-btn');
    const editBtnSubmit = document.getElementById('edit-btn-submit');

    const inputFile = document.getElementById('img-profile')
    const imgOverlay = document.getElementById('img-profile-overlay')

    const inputDesc = document.getElementById('desc-profile')
    const inputName = document.getElementById('name-profile')

    editBtn.onclick = (e) => {
        e.preventDefault()
        inputFile?.toggleAttribute('disabled')
        inputName?.toggleAttribute('disabled')
        inputDesc?.toggleAttribute('disabled')

        imgOverlay?.classList.toggle('disabled')
        editBtnSubmit?.classList.toggle('disabled')
    }
}

const putProfile = () => {
    const editProfileForm = document.getElementById('edit-profile-form')
    const inputDesc = document.getElementById('desc-profile')
    const inputName = document.getElementById('name-profile')
    const inputImg = document.getElementById('img-profile');

    let file

    inputImg.addEventListener('change', function(){
        file =  this.files[0]
    })

    const imageCompression = (imageFile) => new Promise((resolve) => {
        Resizer.imageFileResizer(
            imageFile,
            500,
            500,
            "webp",
            50,
            0,
            (uri) => {
                resolve(uri);
            },
            "file"
        );
    })

    const request = async (url, init, cb) => {
        const res = await fetch(url, init)
        const data = await res.json()
        cb(data)
      }

        editProfileForm.addEventListener('submit',async (e)=>{
            e.preventDefault()

            const image = file && await imageCompression(file)

            const formData = new FormData()
            file && formData.append('img-profile',image)
            formData.append('name', inputName.value)
            formData.append('about', inputDesc.value)

            request("process/edit-profile.php",{
                method: 'POST',
                body: formData
            }, (res) => res.status && location.reload())
        })
}

EditProfile()
ShowImageProfile()
putProfile()