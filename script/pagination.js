const pagination = () => {
  const queryString = window.location.search;
  const urlParams = new URLSearchParams(queryString);
  const listCard = document.querySelector('.list-card')
  const authOverlay = document.querySelector('.auth-overlay')

  const token = document.cookie.includes('token')

  let pageNumber = 1

  const getParams = (params) => urlParams.get(params)

  const msnry = new Masonry(listCard, {
    percentPosition: true
  });

  const request = async (url, init, cb) => {
      const res = await fetch(url, init)
      const data = await res.text()
      cb(data)
  }

  const stringToHTML = (str) => {
    const dom = document.createElement('div');
    dom.innerHTML = str;
    return dom;
  };

  const getPost = (page, id) => {
    var formData = new FormData();
    formData.append('pages', pageNumber);
    
    console.log(`sedang request page ke ${id}`)
    
    // lisCard.innerHTML = `<div class="d-flex justify-content-center mt-4">
    //             <div class="loader"></div>
    //         </div>`

    request(`process/pagination-${page}.php${id == null ? '' : `?uid=${id}`}`, {
        method: 'POST',
        body: formData
    },(res) => {
        if(res){
          const html = stringToHTML(res)
          for(let el of Array.from(html.children)){
            listCard?.append( el)
            msnry?.appended(el)
          }

          msnry.layout()
        }
    })
    pageNumber++
  }

  const infiniteScroll = (page, id = null) => {
    window.addEventListener('scroll', () => {
        const {
            scrollTop,
            scrollHeight,
            clientHeight
        } = document.documentElement;
        
        // window.scrollY + window.innerHeight >= document.documentElement.scrollHeight
        
      if(scrollTop + clientHeight >= scrollHeight - 5){
        if(token){
          getPost(page, id)
          authOverlay.style.opacity = 0
        }else{
          authOverlay.style.opacity = 1

        }
      }else{
        authOverlay.style.opacity = 0
      }

      if(window.scrollY + window.innerHeight >= document.documentElement.scrollHeight - 100){
        if(token){
          authOverlay.style.display = 'none'
        }else{
          authOverlay.style.display = 'grid'
        }
      }else{
        authOverlay.style.display = 'none'
      }
    }
    );
  }

  const lastUrl = window.location.href.split('/').at(-1)

  if(lastUrl?.length === 0 || lastUrl == '?search=') infiniteScroll('home')
  

  for(var key of urlParams.keys()) {
    if(key == 'p' && getParams('p') == 'profile' && getParams('uid').length > 0){
      infiniteScroll('detail', getParams('uid'))
    }
  }
}

pagination()
