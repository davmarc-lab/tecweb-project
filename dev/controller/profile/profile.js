function drawLinkUsernameElement(userId, username) {
    let link = document.createElement("a");
    link.setAttribute("href", "../view/profile.html?user=" + userId);
    link.innerHTML = "@" + username;
    return link;
}

function loadProfileInfo(userId) {
    let userInfo = null;
    $.ajax({
        async: false,
        url: "../model/utils/getAllInfo.php",
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
    let divProfile = document.getElementById('profile-info').getElementsByClassName('row').item(0);
    if (!isSame) {
        // add back button

        let aButton = document.createElement('a');
        aButton.href = "javascript: history.go(-1)";
        aButton.role = "button";
        aButton.id = 'edit-back-button'
        aButton.classList = "btn btn-utility-contrast btn-back";
        aButton.title = "Go back";

        let backIcon = document.createElement('span');
        backIcon.classList = "bi bi-arrow-left";

        aButton.appendChild(backIcon);

        const profileBack = document.querySelector('.profile-back');
        profileBack.appendChild(aButton);

        // create follow button
        let button = document.createElement('a');
        button.setAttribute('role', 'button');
        button.classList.add("btn");
        $.ajax({
            url: "../model/utils/checkFollow.php",
            type: "POST",
            data: {
                IdDst: user['IdUser'],
            },
            success: function (response) {
                button.innerHTML = response == 0 ? "Follow" : "Unfollow";
            }
        });

        button.addEventListener('click', function () {
            let fileBase = "../model/utils/";
            if (button.innerHTML == "Unfollow") {
                // unfollow
                $.ajax({
                    async: false,
                    url: fileBase + "unfollowUserQuery.php",
                    type: "POST",
                    data: {
                        dstUser: user['IdUser'],
                    },
                    success: function (response) {
                        button.innerHTML = "Follow";
                    }
                });
            } else {
                // follow
                $.ajax({
                    async: false,
                    url: fileBase + "followUserQuery.php",
                    type: "POST",
                    data: {
                        dstUser: user['IdUser'],
                    },
                    success: function (response) {
                        button.innerHTML = "Unfollow";
                    }
                });
            }
        });

        divProfile.appendChild(button);
    }

    let img = document.getElementById('profile-image');
    $.ajax({
        url: "../model/utils/getMediaFromId.php",
        method: "POST",
        data: {
            id: user['IdMedia'],
        },
        success: function (response) {
            let image = JSON.parse(response);
            img.setAttribute('src', "../" + image['FilePath']);
        }
    });
    
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

function createPost(elem, isSame) {
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
    let linkPost = document.createElement('a');
    linkPost.classList.add("btn", "btn-primary");
    linkPost.setAttribute('href', "../view/post.html?id=" + elem['IdPost']);
    linkPost.innerHTML = "View Post";
    postBody.appendChild(linkPost);

    // Remove button if isSame == true
    if (isSame) {
        let deleteButton = document.createElement('a');
        deleteButton.role = 'button';
        deleteButton.classList = "btn btn-danger";
        deleteButton.innerHTML = "Remove";
        postBody.appendChild(deleteButton);
        deleteButton.addEventListener("click", function () {
            $.ajax({
                async: false,
                url: '../model/profile/deletePost.php',
                type: 'POST',
                data: {
                    id: elem['IdPost']
                },
                success: function (r) {
                    console.log(r);
                    //location.reload();
                }
            });
        });
    }

    post.appendChild(postBody);

    return post;
}

function drawUserPost(div, user, isSame) {
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
            div.appendChild(createPost(element, isSame));
        });
    }
}

function createModalSpace(parent, id) {
    let divModal = document.createElement('div');
    divModal.setAttribute('id', id);
    divModal.classList.add('modal');

    let divContent = document.createElement('div');
    divContent.classList.add('modal-content');

    let span = document.createElement('span');
    span.classList.add('close');
    span.innerHTML = "&times;";
    divContent.appendChild(span);

    divModal.appendChild(divContent);

    // actions
    span.addEventListener('click', function () {
        divModal.style.display = "none";
        parent.removeChild(divModal);
    });

    window.addEventListener('click', function (event) {
        if (event.target == divModal) {
            divModal.style.display = "none";
            parent.removeChild(divModal);
        }
    });

    return divModal;
}

function setActionButtonState(btn, dst) {
    $.ajax({
        url: "../model/utils/checkFollow.php",
        method: "POST",
        data: {
            IdDst: dst,
        },
        success: function (response) {
            btn.innerHTML = (response > 0 ? "Unfollow" : "Follow");
        }
    });
}

function printUsersModal(div, userList) {
    let table = document.createElement('table');
    table.classList.add("table", "table-striped");

    let tableHead = document.createElement('thead');
    let firstRow = document.createElement('tr');

    let userHeader = document.createElement('th');
    userHeader.setAttribute('id', 'user');
    userHeader.setAttribute('scope', 'col');
    userHeader.innerHTML = "Username";

    let actionHeader = document.createElement('th');
    actionHeader.setAttribute('id', 'action');
    actionHeader.setAttribute('scope', 'col');
    actionHeader.innerHTML = "Action";

    firstRow.appendChild(userHeader);
    firstRow.appendChild(actionHeader);

    tableHead.appendChild(firstRow);
    table.appendChild(tableHead);

    let tableBody = document.createElement('tbody');
    table.appendChild(tableBody);

    userList.forEach(elem => {
        let row = document.createElement('tr');
        let userCell = document.createElement('td');
        userCell.setAttribute('headers', 'user');
        let linkUsername = drawLinkUsernameElement(elem['IdUser'], elem['Username']);
        userCell.appendChild(linkUsername);
        row.appendChild(userCell);

        let actionCell = document.createElement('td');
        actionCell.setAttribute('headers', 'action');

        let btnAction = document.createElement('a');
        btnAction.setAttribute('role', 'button');
        btnAction.classList.add("btn", "btn-following")
        setActionButtonState(btnAction, elem['IdUser']);
        btnAction.addEventListener('click', function () {
            if (this.innerHTML != "") {
                $.ajax({
                    url: "../model/utils/" + (this.innerHTML == "Follow" ? "followUserQuery" : "unfollowUserQuery") + ".php",
                    type: "POST",
                    data: {
                        dstUser: elem['IdUser'],
                    },
                    success: function (response) {
                        setActionButtonState(btnAction, elem['IdUser']);
                    },
                });
            }
        });
        
        actionCell.appendChild(btnAction);
        row.appendChild(actionCell);
        tableBody.appendChild(row);
    });
    
    div.appendChild(table);
}

document.addEventListener('DOMContentLoaded', function () {
    $('#navbar-space').load('../view/navbar.html');

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
            drawUserPost(divPosts, user, isSame);
        }
    });

    document.getElementById('btn-follow').addEventListener('click', function () {
        let divFollow = document.getElementById('profile-follow');
        let followModal = createModalSpace(divFollow, 'modal-follow');
        let modalContent = followModal.children[0];
        $.ajax({
            url: "../model/profile/getFollow.php",
            method: "POST",
            data: {
                user: user['IdUser'],
            },
            success: function (response) {
                let follow = JSON.parse(response);
                if (response != null && follow.length > 0) {
                    let modalTitle = document.createElement('h2');
                    modalTitle.innerHTML = "Following";
                    modalContent.appendChild(modalTitle);
                    printUsersModal(modalContent, JSON.parse(response));
                }
            },
        });

        followModal.style.display = "block";
        divFollow.appendChild(followModal);
    });
    document.getElementById('btn-followers').addEventListener('click', function () {
        let divFollowers = document.getElementById('profile-follow');
        let followerModal = createModalSpace(divFollowers, 'modal-followers');
        let modalContent = followerModal.children[0];
        $.ajax({
            url: "../model/profile/getFollowers.php",
            method: "POST",
            data: {
                user: user['IdUser'],
            },
            success: function (response) {
                let follow = JSON.parse(response);
                if (response != null && follow.length > 0) {
                    let modalTitle = document.createElement('h2');
                    modalTitle.innerHTML = "Followers";
                    modalContent.appendChild(modalTitle);
                    printUsersModal(modalContent, JSON.parse(response));
                }
            },
        });

        followerModal.style.display = "block";
        divFollowers.appendChild(followerModal);
    });
});
