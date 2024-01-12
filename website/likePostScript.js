function likePost(idPost, idUser) {
    console.log(idPost + " " + idUser);
    $.ajax({
        url: "likePostQuery.php",
        type: "POST",
        data: {
            postId: idPost,
            userId: idUser,
        },
        success: function(response) {
            var idLike = "bttLike" + idPost;
            var idLikeFill = "bttLikeFill" + idPost;
            console.log("Success:", response);
            console.log("Id: " + idLike);
            document.getElementById(idLike).classList.add('d-none');
            document.getElementById(idLikeFill).classList.remove('d-none');
            location.reload();
        },
    });
}

function dislikePost(idPost, idUser) {
    console.log(idPost);
    $.ajax({
        url: "dislikePostQuery.php",
        type: "POST",
        data: {
            postId: idPost,
            userId: idUser
        },
        success: function(response) {
            var idLike = "bttLike" + idPost;
            var idLikeFill = "bttLikeFill" + idPost;
            console.log("Success:", response);
            document.getElementById(idLike).classList.remove('d-none');
            document.getElementById(idLikeFill).classList.add('d-none');
            location.reload();
        },
    });
}

var lastPos = 0;

window.addEventListener("scroll", function() {
    var currentPos = window.scrollY || document.documentElement.scrollTop;
    if (currentPos > lastPos) {
        console.log("Scroll");
        $.ajax({
            url: "getPost.php",
            type: "POST",
            success: function(ret) {
                document.getElementById("postContainer").innerHTML += ret;
            },
            error: function(err) {
                console.error(err);
            }
        });
        lastPos = currentPos;
    }
});
