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
        inputFile.toggleAttribute('disabled')
        inputName.toggleAttribute('disabled')
        inputDesc.toggleAttribute('disabled')
        imgOverlay.classList.toggle('disabled')
        editBtnSubmit.classList.toggle('disabled')
    }
}

EditProfile()
ShowImageProfile()