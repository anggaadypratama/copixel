const pagination = () => {
  const queryString = window.location.search;
  const urlParams = new URLSearchParams(queryString);
  const listCard = document.querySelector('.list-card')

  let i = 1

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

  const infiniteScroll = (page, id = null) => {
    window.addEventListener('scroll', () => {
      if (
        window.scrollY + window.innerHeight >= document.body.offsetHeight - 1000
      ) {
        getPost(page, id);
      }
    });

    const getPost = (page, id) => {
      var formData = new FormData();
      formData.append('pages', i);
  
      request(`process/pagination-${page}.php${id == null ? '' : `?uid=${id}`}`, {
          method: 'POST',
          body: formData
      },(res) => {
  
          const html = stringToHTML(res)


            for(let el of html.children){
              listCard?.append( el)
              msnry?.appended(el)
            }
    
            msnry.layout()
      })
      ++i
    }
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
  