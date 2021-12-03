const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);

const conMessage = document.querySelector('.conditional-message')

const falseStatus = [undefined, null]

urlParams.get('search')?.length === 0 || urlParams.get('search')?.includes(falseStatus) ?
    conMessage?.classList.add('home') :
    conMessage?.classList.remove('home')

// ------------------------------------------------------------------------

const textAreaComment = document.getElementById('textarea-comment')
const submitComment = document.querySelectorAll('.comment-submit')



for(let row of submitComment){
    console.log(row)
    textAreaComment.addEventListener('keyup', (e) => {
        row.disabled = !e.target.value
    })
}
