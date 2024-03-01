document.addEventListener("DOMContentLoaded", function () {
    let btnLogin = document.getElementById("bttLogin");
    btnLogin.addEventListener("click", function (event) {
        event.preventDefault();
        let key = document.getElementById("login-email").value;
        let password = document.getElementById("login-password").value;
        $.ajax({
            async: false,
            url: "../model/login/login.php",
            type: "POST",
            data: {
                key: key,
                password: password
            },
            success: function (response) {
                if (response == "success") {
                    window.location.href = "../view/index.html";
                } else if (response == "error1") {
                    printPopup("Invalid username, please try again");
                    document.getElementById("login-email").value = "";
                    document.getElementById("login-password").value = "";
                } else if (response == "error2") {
                    printPopup("Password and username don\'t match, please try again");
                    document.getElementById("login-password").value = "";
                }
            },
        });
    });
});

function printPopup(message) {
    Swal.fire({
        icon: 'error',
        title: message,
        text: '',
    });
}