let btnLogout = document.getElementById('btn-logout');

updateLastSeen();

btnLogout.addEventListener('click', function () {
    updateLastSeen(1);
    $.ajax({
        url: "../model/utils/logout.php",
        type: "POST",
        success: function (response) {
            window.location.href = "../view/login.html";
        },
    });
});