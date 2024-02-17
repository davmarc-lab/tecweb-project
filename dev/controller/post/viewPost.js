/**
 * Retrieves from the database all post information.
 * 
 * @param {*} idPost 
 * @returns JsonObject containing all post info.
 */
function getPostInfo(idPost) {
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

    return infoPost;
}

function getUserLink(idUser) {
    let username = null;
    $.ajax({
        async: false,
        url: "../model/utils/profileInfo.php",
        method: "POST",
        data: {
            id: idUser,
        },
        success: function (response) {
            username = JSON.parse(response)['Username'];
        }
    });
    return username;
}

/**
 * Creates a link to an user profile from the id given.
 * 
 * @param {*} idUser 
 */
function createLinkUsername(idUser) {
    let link = document.createElement('a');
    link.setAttribute('href', "../view/profile.html?user=" + idUser);
    link.innerHTML = "@ " + getUserLink(idUser);
    document.getElementById('post-author').appendChild(link);
}

/**
 * Draws the post preview if is present
 * 
 * @param {*} infoPost 
 */
function drawPostPreview(infoPost) {
    if (infoPost['IdPreview'] != null) {
        idPreview = infoPost['IdPreview'];

        $.ajax({
            url: "../model/utils/getMediaFromId.php",
            method: "POST",
            data: {
                id: idPreview,
            },
            success: function (response) {
                let preview = JSON.parse(response);
                let tagPreview = document.getElementById('post-preview'); 
                tagPreview.setAttribute('src', '../' + preview['FilePath']);
            }
        });
    }
}

/**
 * Draws the post media clickable link.
 * 
 * @param {*} infoPost 
 */
function drawMediaFile(infoPost) {
    $.ajax({
        url: "../model/utils/getMediaFromId.php",
        method: "POST",
        data: {
            id: infoPost['IdMedia'],
        },
        success: function (response) {
            let media = JSON.parse(response);
            let tagMedia = document.getElementById('post-media'); 
            tagMedia.setAttribute('href', '../' + media['FilePath']);
            tagMedia.innerHTML = media['FileName'];
        }
    });
}

function drawPostComments(infoPost) {
    let postId = infoPost['IdPost'];

    $.ajax({
        url: "../model/post/getAllComments.php",
        method: "POST",
        data: {
            idPost: postId,
        },
        success: function (response) {
            let comments = JSON.parse(response);
            let areaComments = document.getElementById('comments-area');
            comments.forEach(element => {
                let username = getUserLink(element['IdUser']);
                let divComment = document.createElement('div');
                let content = document.createElement('p');
                let link = document.createElement('a');

                link.setAttribute('href', '../view/profile.html?user=' + element['IdUser']);
                link.innerHTML = "@ " + username;
                
                content.appendChild(link);
                content.innerHTML += ": " + element['CommentText'];

                divComment.appendChild(content);

                areaComments.appendChild(divComment);
            });
        }
    });
}

$("document").ready(function () {
    const urlParams = new URLSearchParams(window.location.search);
    const idPost = urlParams.get('id');
    if (idPost == null) {
        window.location.href = "../view/index.html";
    }

    infoPost = getPostInfo(idPost);

    let titleTag = document.getElementsByTagName('title')[0];
    titleTag.innerHTML = "NFA - " + infoPost['Title'];
    
    createLinkUsername(infoPost['IdUser']);
    document.getElementById('post-title').innerHTML = infoPost['Title'];
    document.getElementById('post-description').innerHTML = infoPost['Description'];
    document.getElementById('post-date').innerHTML = String(infoPost['Date']).substring(0, 10);

    drawPostPreview(infoPost);
    drawMediaFile(infoPost);

    drawPostComments(infoPost);
});