const profilePage = "../profile/profilePage.php"

$("document").ready(function () {

    let btnComment = document.getElementById("comment-button");
    let areaComment = document.getElementById("comment-text");

    btnComment.setAttribute("aria-disabled", true);
    btnComment.classList.add("disabled");

    // disable comment button when text is empty
    areaComment.addEventListener('input', function () {
        updateInputs(areaComment, btnComment);
    });

    // when clicked post comment
    btnComment.addEventListener('click', function () {
        // get url id param
        const currentUrl = window.location.search;
        const urlParams = new URLSearchParams(currentUrl);
        const idPost = urlParams.get("id");

        // add comment to the database
        let textComment = areaComment.value;
        $.ajax({
            async: false,
            url: "../indexQuery/addComment.php",
            type: "POST",
            data: {
                idPost: idPost,
                textComment: textComment,
            },
        });

        // get user info to append comment to the post
        let user = null;
        $.ajax({
            async: false,
            url: "../indexQuery/getCurrentUser.php",
            type: "POST",
            success: function (response) {
                user = JSON.parse(response);
            },
        });

        // append new comment and clear inputs
        let newCommentElem = createCommentElement(user["IdUser"], user["Username"], textComment);
        appendNewComment(newCommentElem);
        areaComment.value = "";
        updateInputs(areaComment, btnComment);
    });
});

function updateInputs(areaComment, btnComment) {
    if (areaComment.value.length <= 0) {
        btnComment.setAttribute("aria-disabled", true);
        btnComment.classList.add("disabled");
    } else {
        btnComment.setAttribute("aria-disabled", false);
        btnComment.classList.remove("disabled");
    }
}

function createLinkUsernameElement(userId, username) {
    let link = document.createElement("a");
    link.setAttribute("href", profilePage + "?user=" + userId);
    link.innerHTML = "@" + username;
    return link;
}

function createCommentElement(userId, username, text) {
    let pComment = document.createElement("p");
    let linkUsername = createLinkUsernameElement(userId, username);
    pComment.appendChild(linkUsername);
    pComment.innerHTML += " : " + text;
    return pComment;
}

function appendNewComment(commentElem) {
    const parentNode = document.getElementById("comments-area");

    commentElem.classList.add("comment");
    parentNode.insertBefore(commentElem, parentNode.children[0]);
}