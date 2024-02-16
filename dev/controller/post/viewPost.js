document.addEventListener('DOMContentLoaded', function () {
    const urlParams = new URLSearchParams(window.location.search);
    const idPost = urlParams.get('id');
    if (idPost == null) {
        window.location.href = "../view/index.html";
    }

    let infoPost = null;
    $.ajax({
        async: false,
        url: "../model/post/getPostInfo.php",
        method: "POST",
        data: {
            idPost: idPost
        },
        success: function (response) {
            if (response == "error") {
                infoPost = null;
            } else {
                infoPost = JSON.parse(response);
            }
        }
    });
    if (infoPost == null) {
        window.location.href = "../view/index.html";
    }
    let titleTag = document.getElementsByTagName('title')[0];
    titleTag.innerHTML = "NFA - " + infoPost['Title'];
    
});