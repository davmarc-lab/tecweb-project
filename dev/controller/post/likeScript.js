document.addEventListener("DOMContentLoaded", function () {
    const urlParams = new URLSearchParams(window.location.search);
    const idPost = urlParams.get("id");
    let btnLike = document.getElementById('post-like');
    let status = document.createElement('span');
    status.classList.add('bi');
    btnLike.appendChild(status);

    // set the initial status of the like button
    $.ajax({
        url: "../model/utils/checkLike.php",
        method: "POST",
        data: {
            idPost: idPost,
        },
        success: function(response) {
            if (Number(response)) {
                // already liked post
                status.classList.add('liked');
                status.classList.remove('bi-hand-thumbs-up');
                status.classList.add('bi-hand-thumbs-up-fill');
            } else {
                // not liked post yet
                status.classList.add('unliked');
                status.classList.add('bi-hand-thumbs-up');
                status.classList.remove('bi-hand-thumbs-up-fill');
            }
        }
    });

    // change status of the button
    btnLike.addEventListener("click", function () {
        let icon = this.children[0];
        if (icon != null && icon.classList.contains("unliked")) {
            $.ajax({
                url: "../model/utils/incrementLike.php",
                type: "POST",
                data: {
                    idPost: idPost,
                    increment: 1,
                },
            });
            let current = document.getElementById("like-number").innerHTML;
            document.getElementById("like-number").innerHTML = Number(current) + 1;
        } else if (icon != null) {
            $.ajax({
                url: "../model/utils/incrementLike.php",
                type: "POST",
                data: {
                    idPost: idPost,
                    increment: -1,
                },
            });
            let current = document.getElementById("like-number").innerHTML;
            document.getElementById("like-number").innerHTML = Number(current) - 1;
        }
        updateIcon(icon);
    });
});

function updateIcon(icon) {
    if (icon.classList.contains("unliked")) {
        icon.classList.remove("unliked");
        icon.classList.add("liked");
        icon.classList.remove('bi-hand-thumbs-up');
        icon.classList.add('bi-hand-thumbs-up-fill');
    } else {
        icon.classList.remove("liked");
        icon.classList.add("unliked");
        icon.classList.add('bi-hand-thumbs-up');
        icon.classList.remove('bi-hand-thumbs-up-fill');
    }
}