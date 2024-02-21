function printProfileToTarget(targetContainer, profiles) {
    profiles = JSON.parse(profiles);
    if (profiles.length == 0) {
        return;
    }
    let externDiv = document.createElement("div");
    externDiv.classList.add('table-responsive');
    let table = document.createElement('table');
    table.classList.add('table', 'table-striped');
    externDiv.appendChild(table);
    let thead = document.createElement("thead");
    table.appendChild(thead);
    let trHedaer = document.createElement("tr");
    let userHeader = createHeader("username", "Username");
    trHedaer.appendChild(userHeader);
    let numberPostHeader = createHeader("number-post", "Posts");
    trHedaer.appendChild(numberPostHeader);
    let numberFollowerHeader = createHeader("number-follower", "Followers");
    trHedaer.appendChild(numberFollowerHeader);
    let followHeader = createHeader("btt-follow", "");
    trHedaer.appendChild(followHeader);
    thead.appendChild(trHedaer);
    let tableBody = document.createElement("tbody");
    profiles.forEach(function (profile) {
        let tr = document.createElement("tr");
        tr.appendChild(createTableElement("username", 
            createUsernameLink(profile.Username, profile.IdUser, "profilePage.html"),
            false));
        tr.appendChild(createTableElement("number-post", profile.NumberPost, true));
        tr.appendChild(createTableElement("number-follower", profile.NumberFollower, true));
        tr.appendChild(createTableElement("btt-follow", createButtonFollow(profile.IdUser), false));
        tableBody.appendChild(tr);
    });
    table.appendChild(tableBody);
    targetContainer.appendChild(externDiv);
}

function createHeader(id, text) {
    let header = document.createElement("th");
    header.setAttribute("scope", "col");
    header.setAttribute("id", id);
    header.innerHTML = text;
    return header;
}

function createTableElement(header, content, isText) {
    let td = document.createElement("td");
    td.setAttribute("headers", header);
    if (isText) {
        td.innerHTML = content;
    } else {
        td.appendChild(content);
    }
    return td;
}

function createButtonFollow(idTarget) {
    let currentId;
    let btn = document.createElement("a");
    $.ajax({
        async: false,
        url: '../model/utils/loggedUser.php',
        type: 'POST',
        success: function (response) {
            currentId = response;
        }
    });

    if (idTarget != currentId) {
        btn.setAttribute("id", "dstuser-" + idTarget);
        btn.setAttribute("role", "button");
        btn.classList.add('btn', 'btn-following');
        $.ajax({
            async: false,
            url: '../model/utils/checkFollow.php',
            type: 'POST',
            data: {
                IdDst: idTarget
            },
            success: function (response) {
                console.log(response);
                if (response != 0) {
                    btn.innerHTML = "Unfollow";
                } else {
                    btn.innerHTML = "Follow";
                }
                addFollowListener(btn, idTarget);
            }
        });
    }
    return btn;
}

function addFollowListener(target, dstUser) {
    target.addEventListener("click", function () {
        console.log(target.innerHTML);
        if (target.innerHTML == "Unfollow") {
            //unfollow query
            console.log("Eseguo unfollow");
            $.ajax({
                async: false,
                url: '../model/utils/unfollowUserQuery.php',
                type: 'POST',
                data: {
                    dstUser: dstUser
                },
                success: function () {
                    target.innerHTML = "Follow";
                }
            })
        } else {
            //follow query
            console.log("Eseguo follow");
            $.ajax({
                async: false,
                url: '../model/utils/followUserQuery.php',
                type: 'POST',
                data: {
                    dstUser: dstUser
                },
                success: function () {
                    target.innerHTML = "Unfollow";
                }
            })
        }
    });
}