import { createAvatar } from 'https://cdn.skypack.dev/@dicebear/avatars';
import * as style from 'https://cdn.skypack.dev/@dicebear/micah';

let svg = createAvatar(style,{
    flip: true,
    backgroundColor: "#6A54C0",
    scale: 90,
    translateY: 5
});

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

form?.addEventListener('submit', (e) => {
  e.preventDefault()

  const formData = new FormData()
  for(let row of form){
    formData.append(row.name, row.value)
  }

  formData.append('img-url', `${btoa(svg)}`)

  request(`process/${sectionParams}.php`,{
    method: 'POST',
    body: formData
  },(res) => {
    if(sectionParams === 'login'){
      switch(res.status){
        case 'email_salah': responseAlert({message : 'Email yang dimasukan salah!'})
        case 'password_salah':  responseAlert({message :'Password yang dimasukan salah!'})
        default:
          location.reload()
          authAlert.classList.add('d-none')
      }
    }else{
      switch(res.status){
        case 'email_exists': responseAlert({message :'Email sudah ada!'})
        case 'pass_not_match':  responseAlert({message :'Password tidak sama!'})
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