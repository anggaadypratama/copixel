const Profile = () => {
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

Profile()