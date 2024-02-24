let btnLogout = document.getElementById('btn-logout');

btnLogout.addEventListener('click', function () {
    $.ajax({
        url: "../model/utils/logout.php",
        type: "POST",
        success: function (response) {
            window.location.href = "../view/login.html";
        },
    });
});