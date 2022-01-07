const pagination = () => {
  const queryString = window.location.search;
  const urlParams = new URLSearchParams(queryString);
  const listCard = document.querySelector('.list-card')
  const loader = document.querySelector('.loader')

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

    request(`process/pagination-${page}.php${id == null ? '' : `?uid=${id}`}`, {
        method: 'POST',
        body: formData
    },(res) => {
        if(![null, undefined].includes(res)){
          const html = stringToHTML(res)
          for(let el of Array.from(html.children)){
            listCard?.append( el)
            msnry?.appended(el)
          }

          loader.style.display = 'none'
          msnry.layout()
        }else{
          loader.style.display = 'block'
        }
        
    })
    pageNumber++
  }

  const infiniteScroll = (page, id = null) => {
    window.addEventListener('scroll', () => 
      window.scrollY + window.innerHeight >= document.documentElement.scrollHeight && getPost(page, id)
    );
  }

  for(var key of urlParams.keys()) {
    if(key == 'search' || [undefined, null].includes(key)){
      infiniteScroll('home')
    }else if(key == 'p' && getParams('p') == 'profile' && getParams('uid').length > 0){
      infiniteScroll('detail', getParams('uid'))
    }
  }
}

pagination()
