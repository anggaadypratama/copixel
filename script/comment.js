const CommentPost = () =>{
    const tx = document.getElementsByTagName("textarea");

    for (let e of tx) {
        const height = !e.scrollHeight ? 30 : e.scrollHeight
        e.setAttribute("style", "height:" + (height) + "px;overflow-y:hidden;");
        e.addEventListener("input", OnInput, false);
    }

    function OnInput() {
    this.style.height = "auto";
    this.style.height = (this.scrollHeight) + "px";
    }
}

CommentPost();