document.addEventListener("DOMContentLoaded", function () {
    document.querySelector(".like-btn").addEventListener("click", function () {
        let idPost = String(this.id).split("-").pop();
        let icon = this.children[0];
        if (icon != null && icon.classList.contains("bi-hand-thumbs-up")) {
            $.ajax({
                url: "../indexQuery/incrementLike.php",
                type: "POST",
                data: {
                    idPost: idPost,
                    increment: 1,
                },
            });
            let current = document.getElementById("vote-indicator").innerHTML;
            document.getElementById("vote-indicator").innerHTML = Number(current) + 1;
        } else if (icon != null) {
            $.ajax({
                url: "../indexQuery/incrementLike.php",
                type: "POST",
                data: {
                    idPost: idPost,
                    increment: -1,
                },
            });
            let current = document.getElementById("vote-indicator").innerHTML;
            document.getElementById("vote-indicator").innerHTML = Number(current) - 1;
        }
        updateIcon(icon);
    });
});

function updateIcon(icon) {
    if (icon.classList.contains("bi-hand-thumbs-up")) {
        icon.classList.remove("bi-hand-thumbs-up");
        icon.classList.add("bi-hand-thumbs-up-fill");
    } else {
        icon.classList.remove("bi-hand-thumbs-up-fill");
        icon.classList.add("bi-hand-thumbs-up");
    }
}