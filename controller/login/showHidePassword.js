document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("show-password").addEventListener("click", function() {
        let inputBlock = document.getElementById("login-password");
        if (inputBlock.type === "password") {
            inputBlock.type = "text";
        } else {
            inputBlock.type = "password";
        }
    });
});
