document.addEventListener("DOMContentLoaded", function () {
    if (document.contains( document.getElementById("ok-button"))) {
        document.getElementById("ok-button").addEventListener("click", function () {
            $.ajax({
                async: false,
                url: "includes/createCookie.php",
                type: "POST",
                success: function (response) {
                    console.log(response);
                }
            });
            document.getElementById("cookie-notify").style.display = "none";
        });
    }
});