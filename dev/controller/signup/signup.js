document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("btn-signup").addEventListener("click", function (event) {
        event.preventDefault();
        console.log("Premuto signup");
        let name = document.getElementById("signup-name").value;
        let surname = document.getElementById("signup-surname").value;
        let email = document.getElementById("signup-email").value;
        let username = document.getElementById("signup-username").value;
        let image = document.getElementById("signup-image").value;
        let password = document.getElementById("signup-password").value;
        let passwordRepeat = document.getElementById("signup-password-repeat").value;
        $.ajax({
            async: false,
            url: "../model/signup/signup.php",
            type: "POST",
            data: {
                name: name,
                surname: surname,
                email: email,
                username: username,
                password: password,
                passwordRepeat: passwordRepeat
            },
            success: function (response) {
                if (response == "success") {
                    window.location.href = "../view/index.html";
                } else if (response == "error1") {
                    window.location.href = "../view/signup.html?error=1";
                } else if (response == "error2") {
                    window.location.href = "../view/signup.html?error=2";
                } else if (response == "error3") {
                    window.location.href = "../view/signup.html?error=3";
                } else if (response == "error4") {
                    window.location.href = "../view/signup.html?error=4";
                } else if (response == "error5") {
                    window.location.href = "../view/signup.html?error=5";
                }
            }
        });
    });
});