document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("btn-signup").addEventListener("click", function (event) {
        event.preventDefault();
        let formData = new FormData(document.getElementById("signup-form"));
        $.ajax({
            async: false,
            url: "../model/signup/signup.php",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                console.log(response);
                if (response == "success") {
                    window.location.href = "../view/index.html";
                } else if (response == "error1") {
                    printPopup("Passwords do not match, please try again");
                    document.getElementById("signup-password").value = "";
                    document.getElementById("Signup-password-repeat").value = "";
                } else if (response == "error2") {
                    printPopup("Password can\'t be empty");
                } else if (response == "error3") {
                    printPopup("Username can only contain letters, numers and underscore");
                } else if (response == "error4") {
                    printPopup("This username already exists");
                } else if (response == "error5") {
                    printPopup("This email already exists");
                }
            }
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