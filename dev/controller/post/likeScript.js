document.addEventListener("DOMContentLoaded", function () {
    const urlParams = new URLSearchParams(window.location.search);
    const idPost = urlParams.get("id");
    let btnLike = document.getElementById('post-like');
    let status = btnLike.children[0];

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
            } else {
                // not liked post yet
                status.classList.add('unliked');
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
    } else {
        icon.classList.remove("liked");
        icon.classList.add("unliked");
    }
}