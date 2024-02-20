function loadProfileInfo(userId) {
    let userInfo = null;
    $.ajax({
        async: false,
        url: "../model/profile/getUserData.php",
        method: "POST",
        data: {
            id: userId,
        },
        success: function (response) {
            userInfo = JSON.parse(response);
        }
    });
    return userInfo;
}

function drawProfileInfo(user, isSame) {
    let divProfile = document.getElementById('profile-info');
    if (isSame) {
        // create edit button
        let button = document.createElement('button');
        let after = divProfile.children[1];
        button.innerHTML = "Edit";
        divProfile.insertBefore(button, after);
    }

    // apend all user info in a list
    const elems = Array(user['Username'], user['Name'] + " " + user['Surname'], user['Description'] == null ? "" : user['Description']);
    const list = document.getElementById('list-info');
    elems.forEach(elem => {
        if (elem.length > 0) {
            let listElem = document.createElement('li');
            listElem.innerHTML = elem;
            list.appendChild(listElem);
        }
    });
}

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
    let categoryText = elem['sakjdgjqasdjgsa'];

    // Title

    // Description

    // ViewPost button

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

document.addEventListener('DOMContentLoaded', function () {
    // $('#navbar-space').load('../view/navbar.html');

    let user = null;
    // flag to tell if logged user is loading profile page or another one is doing it
    let isSame = false;
    $.ajax({
        url: "../model/utils/loggedUser.php",
        method: "POST",
        success: function (response) {
            let logged = response;

            const currentUrl = window.location.search;
            const urlParams = new URLSearchParams(currentUrl);
            const idUser = urlParams.get("user");

            $.ajax({
                async: false,
                url: "../model/utils/profileInfo.php",
                method: "POST",
                data: {
                    id: idUser == null ? logged : idUser,
                },
                success: function (res) {
                    user = JSON.parse(res);
                }
            });
            isSame = idUser != null ? (Number(logged) == Number(idUser)) : true;
            document.getElementsByTagName('title')[0].innerHTML = "NFA - " + user['Username'];

            user = loadProfileInfo(user['IdUser']);
            drawProfileInfo(user, isSame);

            let divPosts = document.getElementById('profile-post');
            drawUserPost(divPosts, user);
        }
    });
});
