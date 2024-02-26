function createPost(elem) {
    let post = document.createElement('div');
    post.classList.add("card", "post-card");
    let elems = Array(6);
    // preview
    if (elem['IdPreview'] != null) {
        let imgPreview = document.createElement('img');
        imgPreview.classList.add("card-img-top");
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

    //card-body
    let postBody = document.createElement('div');
    postBody.classList.add("card-body");

    // date
    let dateText = String(elem['Date']).substring(0, 11);
    let pDate = document.createElement('p');
    pDate.classList.add("show-date");
    pDate.innerHTML = dateText;
    postBody.appendChild(pDate);

    // category
    let idCategory = elem['IdCategory'];
    if (idCategory != null) {
        let spanCategory = document.createElement('span');
        spanCategory.classList.add("badge");
        postBody.appendChild(spanCategory);
        $.ajax({
            url: "../model/utils/getCategoryDescription.php",
            method: "POST",
            data: {
                Id: idCategory,
            },
            success: function (response) {
                spanCategory.innerHTML = response;
            }
        });
    }

    // Title
    let title = document.createElement('h5');
    title.classList.add("card-title");
    title.innerHTML = elem['Title'];
    postBody.appendChild(title);

    // Description
    let pDescription = document.createElement('p');
    pDescription.classList.add("card-text");
    pDescription.innerHTML = (String(elem['Description']).substring(0, 200) + (elem['Description'].length > 200 ? " ..." : ""));
    postBody.appendChild(pDescription);

    // ViewPost button
    let choosePost = document.createElement('a');
    choosePost.classList.add("btn", "btn-primary");
    choosePost.innerHTML = "Choose post";
    choosePost.setAttribute("role", "button");
    choosePost.addEventListener("click", function() {
        let id = elem['IdPost'];
        let duration;
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
    postBody.appendChild(choosePost);

    post.appendChild(postBody);

    return post;
}

function drawUserPost(div, user) {
    let posts = null;
    $.ajax({
        async: false,
        url: "../model/sponsor/getUserPostToSponsor.php",
        method: "POST",
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

let durationOption = document.getElementsByName("duration");
let durationOptions = document.getElementsByName("duration");

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
        post.style.display = "none";
    });

    durationOptions.forEach(function (option) {
        option.addEventListener("change", function () {
            let duration = null;
            for (let i = 0; i < durationOptions.length; i++) {
                if (durationOptions[i].checked) {
                    duration = durationOptions[i].value;
                }
            }

            // Se è stata selezionata una durata, mostra i post con un'animazione
            if (duration != null) {
                allPosts.forEach(function (post) {
                    // Utilizza fadeIn() per mostrare il post gradualmente
                    $(post).fadeIn();
                });
            }
        });
    });
});