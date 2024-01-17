function likePost(idPost, idUser) {
    $.ajax({
        url: "likePostQuery.php",
        type: "POST",
        data: {
            postId: idPost,
            userId: idUser,
        },
        success: function (response) {
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
                success: function (response) {
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
        success: function (response) {
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
                success: function (response) {
                    console.log(response);
                    var idVote = "vote_indicator" + idPost;
                    document.getElementById(idVote).textContent = parseInt(response, 10);
                }
            });
        },
    });
}

let counter = 0;

/* document.addEventListener("DOMDocumentLoaded", function () {
    document.querySelectorAll(".textAreaComment").forEach(function (x) {
        x.addEventListener("change", function () {
            console.log(x);
            if (x.value.length !== 0) {
                localStorage.setItem(counter.toString(), x.value);
                console.log(localStorage.getItem(counter.toString()));
                console.log(counter.toString());
            }
        });
        counter++;
    });
});
 */

let lastPos = 0;

/* window.addEventListener("scroll", function () {
    let currentPos = window.scrollY || document.documentElement.scrollTop;
    counter = 0;
    document.querySelectorAll(".textAreaComment").forEach(function (x) {
        x.addEventListener("change", function () {
            console.log(x);
            if (x.value.length !== 0 && localStorage.getItem(counter.toString()) === null) {
                localStorage.setItem(counter.toString(), x.value);
                console.log(localStorage.getItem(counter.toString()));
                console.log(counter.toString());
            }
        });
        counter++;
    });
    console.log("Valore di counter: " + counter);
    let i = counter;
    document.querySelectorAll(".textAreaComment").forEach(function (x) {
        x.textContent = localStorage.getItem(i.toString());
        i--;
    });
    /* for (let i = counter; i >= 0; i--) {
        console.log("I vale: " + i);
        console.log(localStorage.getItem(i.toString()));

    } 
    if (currentPos > lastPos) {
        console.log("Scroll");
        $.ajax({
            url: "getPost.php",
            type: "POST",
            success: function (ret) {
                document.getElementById("postContainer").innerHTML += ret;
            },
            error: function (err) {
                console.error(err);
            }
        });
        lastPos = currentPos;
    }
});
 */