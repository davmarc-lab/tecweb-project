document.addEventListener('DOMContentLoaded', function () {
    $.ajax({
        url: "../model/login/isLogged.php",
        type: "POST",
        success: function (response) {
            if (response) {
                // user is logged
                console.log(response);
            } else {
                window.location.href = "../view/login/login.html";
            }
        }
    });
});
