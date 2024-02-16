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
                console.log(response);
                if (response == "success") {
                    window.location.href = "../view/index.html";
                } else if (response == "error1") {
                    window.location.href = "../view/login.html?error=1";
                } else if (response == "error2") {
                    window.location.href = "../view/login.html?error=2";
                }
            },
        });
    });
});