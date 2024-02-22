function createPost(elem) {
    let post = document.createElement('div');
    let elems = Array(6);
    // preview
    if (elem['IdPreview'] != null) {
        let imgPreview = document.createElement('img');
        $.ajax({
            async: false,
            url: "../model/utils/getMediaFromId.php",
            method: "POST",
            data: {
                id: elem['IdPreview'],
            },
            success: function (response) {
                let img = JSON.parse(response);
                imgPreview.setAttribute('src', '../' + img['FilePath']);
            }
        });
        post.appendChild(imgPreview);
    }

    // date
    let dateText = elem['Date'];
    let pDate = document.createElement('p');
    pDate.innerHTML = dateText;
    post.appendChild(pDate);

    // category
    let idCategory = elem['IdCategory'];
    let pCategory = document.createElement('p');
    post.appendChild(pCategory);
    $.ajax({
        url: "../model/utils/getCategoryDescription.php",
        method: "POST",
        data: {
            Id: idCategory,
        },
        success: function (response) {
            pCategory.innerHTML = response;
        }
    });

    // Title
    let title = document.createElement('h2');
    title.innerHTML = elem['Title'];
    post.appendChild(title);

    // Description
    let pDescription = document.createElement('p');
    pDescription.innerHTML = (String(elem['Description']).substring(0, 200) + (elem['Description'].length > 200 ? " ..." : ""));
    post.appendChild(pDescription);

    // ViewPost button
    let linkPost = document.createElement('a');
    linkPost.setAttribute('href', "../view/post.html?id=" + elem['IdPost']);
    linkPost.innerHTML = "View Post";
    post.appendChild(linkPost);

    return post;
}

function drawUserPost(div, user) {
    let posts = null;
    $.ajax({
        async: false,
        url: "../model/profile/getUserPost.php",
        method: "POST",
        data: {
            id: user['IdUser'],
        },
        success: function (response) {
            if (response != "") {
                posts = JSON.parse(response);
            }
        }
    });

    if (posts != null) {
        posts.forEach(element => {
            div.appendChild(createPost(element));
        });
    }
}

document.addEventListener("DOMContentLoaded", function () {
    let user;
    let currentId;
    $.ajax({
        async: false,
        url: '../model/utils/loggedUser.php',
        type: 'POST',
        success: function (response) {
            currentId = response;
        }
    });
    $.ajax({
        async: false,
        url: "../model/utils/getAllInfo.php",
        method: "POST",
        data: {
            id: currentId,
        },
        success: function (response) {
            user = JSON.parse(response);
        }
    });

    drawUserPost(document.getElementById("post-container"), user);

    let allPosts = Array.from(document.getElementById("post-container").children);

    allPosts.forEach(function (post) {
        post.addEventListener("click", function() {
            let id = post.querySelectorAll('a')[0].href.split('=')[1];
            let duration;
            let durationOption = document.getElementsByName("duration");
            for (let i = 0; i < durationOption.length; i++) {
                if (durationOption[i].checked) {
                    duration = durationOption[i].value;
                }
            }
            if (duration != null) {
                $.ajax({
                    async: false,
                    url: '../model/sponsor/addSponsor.php',
                    type: 'POST',
                    data: {
                        id: id,
                        duration: duration
                    },
                    success: function (res) {
                        window.location.href = "profile.html";
                    }
                });
            }
        });
    });

});