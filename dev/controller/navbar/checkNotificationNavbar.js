document.addEventListener("DOMContentLoaded", function () {
    function checkNotification() {
        let bellWhite = document.getElementById("bell-white");
        let bellRed = document.getElementById("bell-red");
        //let bell = document.getElementById("bell-icon");
        $.ajax({
            async: false,
            url: '../model/navbar/checkNotificationNavbar.php',
            type: 'POST',
            success: function (response) {
                console.log(response);
                if (response == 0) {
                    /* bell.removeAttribute("fill");
                    bell.setAttribute("fill", "currentColor"); */
                    /* bellWhite.hidden = false;
                    bellRed.hidden = true; */
                    bellWhite.style.display = "block";
                    bellRed.style.display = "none";
                } else {
                    /* bell.removeAttribute("fill");
                    bell.setAttribute("fill", "red"); */
                    //bell.hidden = true;
                    bellWhite.style.display = "none";
                    bellRed.style.display = "block";
                }
            }
        });
    }
    checkNotification();
    setInterval(checkNotification, 4000);
});