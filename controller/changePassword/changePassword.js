// update user last seen
updateLastSeen();

document.addEventListener("DOMContentLoaded", function () {
    $(document).keypress(
        function (event) {
            if (event.which == '13') {
                event.preventDefault();
            }
        });
    
    document.getElementById("submit-old").addEventListener("click", function (event) {
        event.preventDefault();
        let oldPassword = document.getElementById("input-old-password").value;
        $.ajax({
            async: false,
            url: '../model/changePassword/verifyOldPassword.php',
            type: 'POST',
            data: {
                oldPassword: oldPassword
            },
            success: function (response) {
                if (response == 'ok') {
                    window.location.href = 'changePassword.html?error=0';
                } else {
                    window.location.href = 'changePassword.html?error=1';
                }
            }
        });
    });

    document.getElementById("submit").addEventListener("click", function (event) {
        event.preventDefault();
        let firstPwd = document.getElementById("input-new-password").value; 
        let secondPwd = document.getElementById("input-repeat-password").value; 
        $.ajax({
            async: false,
            url: '../model/changePassword/setNewPassword.php',
            type: 'POST',
            data: {
                newPassword: firstPwd,
                repeatPassword: secondPwd
            },
            success: function (response) {
                if (response == 'ok') {
                    window.location.href = 'profile.html';
                } else {
                    window.location.href = 'changePassword.html?error=2';
                }
            }
        });
    });
});

