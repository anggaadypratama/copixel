const CommentPost = () =>{
    const tx = document.getElementsByTagName("textarea");
    for (let i = 1; i < tx.length; i++) {
        tx[i].setAttribute("style", "height:" + (tx[i].scrollHeight) + "px;overflow-y:hidden;");
        tx[i].addEventListener("input", OnInput, false);
    }

    for (let e of tx) {
        e.setAttribute("style", "height:" + (e.scrollHeight) + "px;overflow-y:hidden;");
        e.addEventListener("input", OnInput, false);
        console.log(e)
    }

    console.log(tx[0])

    function OnInput() {
    this.style.height = "auto";
    this.style.height = (this.scrollHeight) + "px";
    }
}

CommentPost();