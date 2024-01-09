function likePost(id) {
    console.log(id);
    $.ajax({
        url: "likePostQuery.php",
        type: "POST",
        data: {
            postId: id
        },
        success: function(response) {
            var idLike = "bttLike" + id;
            var idLikeFill = "bttLikeFill" + id;
            console.log("Success:", response);
            document.getElementById(idLike).classList.add('d-none');
            document.getElementById(idLikeFill).classList.remove('d-none');
        },
    });
}

function dislikePost(id) {
    console.log(id);
    $.ajax({
        url: "dislikePostQuery.php",
        type: "POST",
        data: {
            postId: id
        },
        success: function(response) {
            var idLike = "bttLike" + id;
            var idLikeFill = "bttLikeFill" + id;
            console.log("Success:", response);
            document.getElementById(idLike).classList.remove('d-none');
            document.getElementById(idLikeFill).classList.add('d-none');
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