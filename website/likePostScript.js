function likePost(idPost, idUser) {
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
            document.getElementById(idLike).classList.add('d-none');
            document.getElementById(idLikeFill).classList.remove('d-none');
            $.ajax({
                url: "getVoteNumber.php",
                type: "GET",
                data: {
                    postId: idPost
                },
                success: function(response) {
                    console.log(response);
                    var idVote = "vote_indicator" + idPost;
                    document.getElementById(idVote).textContent = parseInt(response, 10);
                }
            });
        },
    });
}

function dislikePost(idPost, idUser) {
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
            document.getElementById(idLike).classList.remove('d-none');
            document.getElementById(idLikeFill).classList.add('d-none');
            $.ajax({
                url: "getVoteNumber.php",
                type: "GET",
                data: {
                    postId: idPost
                },
                success: function(response) {
                    console.log(response);
                    var idVote = "vote_indicator" + idPost;
                    document.getElementById(idVote).textContent = parseInt(response, 10);
                }
            });
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
