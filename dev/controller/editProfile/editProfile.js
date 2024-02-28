// updates user last seen
updateLastSeen();

document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("submit").addEventListener("click", function (event) {
        event.preventDefault();
        let formData = new FormData(document.getElementById("edit-profile-form"));

        $.ajax({
            async: false,
            url: '../model/editProfile/editProfile.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function () {
                $.ajax({
                    async: false,
                    url: '../model/utils/loggedUser.php',
                    type: 'POST',
                    success: function (response) {
                        printInfo(response);
                    }
                });
            }
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    let currentId;
    $.ajax({
        async: false,
        url: '../model/utils/loggedUser.php',
        type: 'POST',
        success: function (response) {
            printInfo(response);
        }
    });

});

function printInfo(id) {
    $.ajax({
        async: false,
        url: '../model/utils/getAllInfo.php',
        type: 'POST',
        data: {
            id: id
        },
        success: function (response) {
            response = JSON.parse(response);
            document.getElementById("input-name").setAttribute("value", response.Name);
            document.getElementById("input-surname").setAttribute("value", response.Surname);
            document.getElementById("input-username").setAttribute("value", response.Username);
            document.getElementById("input-email").setAttribute("value", response.Email);
            document.getElementById("input-description").innerHTML = response.Description;
            document.getElementById("input-image").setAttribute("value", "");
        }
    });
}
