function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function isCookieEmpty(cookieName) {
    let username = getCookie(cookieName);
    return username == "";
}

document.addEventListener('DOMContentLoaded', function () {
    let userId = null;
    $.ajax({
        async: false,
        url: "../model/utils/loggedUser.php",
        method: "POST",
        success: function (response) {
            if (response != "") {
                userId = response;
            }
        }
    });
    if (isCookieEmpty("user" + userId)) {
        let div = document.getElementById('cookie-notify');
        // draw cookie-notify
        let text = document.createElement('p');
        let strong = document.createElement('strong');
        strong.innerHTML = "This site uses technical cookies to improve the user experience";
        text.appendChild(strong);
        div.appendChild(text);

        let btnButton = document.createElement('button');
        btnButton.setAttribute('id', 'ok-button');
        btnButton.innerHTML = "OK";

        btnButton.addEventListener('click', function () {
            // sets cookie
            $.ajax({
                async: false,
                url: "../model/index/setUserCookie.php",
                method: "POST"
            });
            // hide cookie div
            document.getElementById('cookie-div').style.display = "none";
        });

        div.appendChild(btnButton);
    } else {
        document.getElementById('cookie-div').style.display = "none";
    }
});