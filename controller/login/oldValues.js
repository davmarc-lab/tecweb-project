$('document').ready(function () {
    let username = "";
    $.ajax({
        async: false,
        url: "../model/login/oldValues.php",
        type: "POST",
        success: function (response) {
            username = response;
        }
    });
    let inputUsername = document.getElementById("login-email");
    inputUsername.setAttribute('value', username);
});
