import { createAvatar } from 'https://cdn.skypack.dev/@dicebear/avatars';
import * as style from 'https://cdn.skypack.dev/@dicebear/micah';
import Resizer from 'https://cdn.skypack.dev/react-image-file-resizer';
import { svgToPngBase64 } from 'https://cdn.skypack.dev/svg-to-png-browser';


let svg = createAvatar(style,{
    flip: true,
    backgroundColor: "#6A54C0",
    scale: 90,
    translateY: 5
});

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

function dataURLtoFile(dataurl, filename) {
 
  var arr = dataurl.split(','),
      mime = arr[0].match(/:(.*?);/)[1],
      bstr = atob(arr[1]), 
      n = bstr.length, 
      u8arr = new Uint8Array(n);
      
  while(n--){
      u8arr[n] = bstr.charCodeAt(n);
  }
  
  return new File([u8arr], filename, {type:mime});
}

const form = document.forms['auth']
const authAlert = document.getElementById('auth-alert');

const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
const sectionParams = urlParams.get('s')

const responseAlert = ({status = false, message}) => {
  if(status){
    authAlert.classList.remove('alert-danger')
    authAlert.classList.add('alert-success')
  }else{
    authAlert.classList.remove('alert-success')
    authAlert.classList.add('alert-danger')
  }

  authAlert.innerHTML = message
  authAlert.classList.remove('d-none')
}

const request = async (url, init, cb) => {
  const res = await fetch(url, init)
  const data = await res.json()
  cb(data)
}

form.addEventListener('submit', async (e) => {
  e.preventDefault()

  const pngBase64 = await svgToPngBase64(svg);
  const imageFile = dataURLtoFile(pngBase64, 'profile-image.png')
  const image = await imageCompression(imageFile)

  console.log(image)

  const formData = new FormData()
  for(let row of form){
    formData.append(row.name, row.value)
  }

  formData.append('img-url', image, 'profile-image.webp')

  request(`process/${sectionParams}.php`,{
    method: 'POST',
    body: formData
  },(res) => {
    console.log(res.status)
    if(sectionParams === 'login'){
      switch(res.status){
        case 'email_salah': 
          responseAlert({message : 'Email yang dimasukan salah!'})
          break;
        case 'password_salah':  
          responseAlert({message :'Password yang dimasukan salah!'})
          break;
        default:
          location.reload()
          authAlert.classList.add('d-none')
      }
    }else{
      switch(res.status){
        case 'email_exists': 
          responseAlert({message :'Email sudah ada!'})
          break;
        case 'pass_not_match':  
          responseAlert({message :'Password tidak sama!'})
          break;
        default:
          responseAlert({message :'Daftar berhasil, Mohon Tunggu!!!', status: true})
          request(`process/login.php`,{
            method: 'POST',
            body: formData
          },(res) => {
            if(res.status === 'success'){
              location.reload()
              authAlert.classList.add('d-none')
            }
          })
      }
    }
  })

})