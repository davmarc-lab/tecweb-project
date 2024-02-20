function printProfileToTarget(targetContainer, profiles) {
    profiles = JSON.parse(profiles);
    if (profiles.length == 0) {
        return;
    }
    let externDiv = document.createElement("div");
    externDiv.classList.add('table-responsive', 'overflow-y-auto');
    let table = document.createElement('table');
    table.classList.add('table', 'table-stripped');
    externDiv.appendChild(table);
    let thead = document.createElement("thead");
    table.appendChild(thead);
    let trHedaer = document.createElement("tr");
    let userHeader = createHeader("username", "Username", false);
    trHedaer.appendChild(userHeader);
    let numberPostHeader = createHeader("number-post", "Posts", true);
    trHedaer.appendChild(numberPostHeader);
    let numberFollowerHeader = createHeader("number-followe", "Followers", true);
    trHedaer.appendChild(numberFollowerHeader);
    let followHeader = createHeader("btt-follow", "", false);
    trHedaer.appendChild(followHeader);
    thead.appendChild(trHedaer);
    let tableBody = document.createElement("tbody");
    profiles.forEach(function (profile) {
        let tr = document.createElement("tr");
        tr.appendChild(createTableElement("username", 
            createUsernameLink(profile.Username, profile.IdUser, "profilePage.html"),
            false));
        tr.appendChild(createTableElement("number-post", profile.NumberPost, true, true));
        tr.appendChild(createTableElement("number-follower", profile.NumberFollower, true, true));
        tr.appendChild(createTableElement("btt-follow", createButtonFollow(profile.IdUser), false, false));
        tableBody.appendChild(tr);
    });
    table.appendChild(tableBody);
    targetContainer.appendChild(externDiv);
}

function createHeader(id, text, isMiddle) {
    let header = document.createElement("th");
    header.classList.add("text-center");
    if (isMiddle) {
        header.classList.add('d-none', 'd-md-table-cell');
    }
    header.setAttribute("scope", "col");
    header.setAttribute("id", id);
    header.innerHTML = text;
    return header;
}

function createTableElement(header, content, isMiddle, isText) {
    let td = document.createElement("td");
    td.classList.add('text-center');
    if (isMiddle) {
        td.classList.add('d-none', 'd-md-table-cell');
    }
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
            type: 'GET',
            data: {
                IdSrc: currentId,
                IdDst: idTarget
            },
            success: function (response) {
                if (response != 0) {
                    btn.innerHTML = "Unfollow";
                } else {
                    btn.innerHTML = "Follow";
                }
            }
        });
    }
    return btn;
}