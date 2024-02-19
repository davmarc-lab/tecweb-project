function drawNotifications(div, notif) {
    let divNotif = document.createElement('p');
    let textNotif = document.createElement('a');
    textNotif.innerHTML = notif['IdUser'] + ": " + notif['Description'];

    divNotif.appendChild(textNotif);
    div.appendChild(divNotif);
}

function printTitle2(div, string) {
    let text = document.createElement('h2');
    text.innerHTML = string;
    div.appendChild(text);
}

document.addEventListener('DOMContentLoaded', function () {
    updateLastSeen(1);

    // $('#navbar-space').load('../view/navbar.html');
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
    })
});