const NotificationType = Object.freeze({
    LIKE: Symbol('Like'),
    FOLLOWER: Symbol('Follower'),
    COMMENT: Symbol('Comment')
});

function drawLinkUsernameElement(userId, username) {
    let link = document.createElement("a");
    link.setAttribute("href", "../" + profilePage + "?user=" + userId);
    link.innerHTML = "@" + username;
    return link;
}

function drawNotifications(div, notif) {
    let divNotif = document.createElement('p');
    
    if (notif['IsRead'] == 0) {
        divNotif.classList.add('notif-to-read');
    }

    let svg = document.createElement('svg');
    svg.setAttribute('xmlns', 'http://www.w3.org/2000/svg');
    svg.setAttribute('width', 16);
    svg.setAttribute('height', 16);
    svg.setAttribute('fill', 'currentColor');
    svg.setAttribute('viewBox', '0 0 16 16');

    // choose icon
    let iconType = notif['Type'];
    switch (iconType) {
        case NotificationType.LIKE.description:
            break;
        case NotificationType.FOLLOWER.description:
            break;
        case NotificationType.COMMENT.description:
            break;
        default:
            break;
    }

    let textNotif = document.createElement('a');
    let target = null;
    $.ajax({
        async: false,
        url: "../model/notification/getTarget.php",
        method: "POST",
        data: {
            type: notif['Type'],
            target: notif['IdTarget'],
        },
        success: function (response) {
            target = JSON.parse(response)['Target'];
        }
    });

    if (iconType == NotificationType.LIKE.description || iconType == NotificationType.COMMENT.description) {
        // post notification
        textNotif.href = "../view/post.html?id=" + target;
    } else {
        // user notification
        textNotif.href = "../view/profile.html?user=" + target;
    }
    textNotif.innerHTML = "@" + notif['Description'];

    divNotif.appendChild(textNotif);
    div.appendChild(divNotif);
}

function printTitle2(div, string) {
    let text = document.createElement('h3');
    text.innerHTML = string;
    div.appendChild(text);
}

document.addEventListener('DOMContentLoaded', function () {
    $('#navbar-space').load('../view/navbar.html');
    let divNotif = document.getElementById('notif-space');

    $.ajax({
        url: "../model/notification/getNotifications.php",
        method: "POST",
        success: function (response) {
            // draw all notification
            if (response == "") {
                // no notifications
            } else {
                let notif = JSON.parse(response);
                let newNotifCount = 0;
                notif.forEach(element => {
                    if (!element['IsRead']) {
                        newNotifCount++;
                    }
                });

                let string = "You have " + newNotifCount + " new notification" + (newNotifCount > 1 ? "s." : ".");
                printTitle2(divNotif, string);

                notif.forEach(element => {
                    drawNotifications(divNotif, element);
                });
            }
        }
    });

    // update all non read notifications
    $.ajax({
        url: "../model/notification/updateSeen.php",
        method: "POST",
    });
});