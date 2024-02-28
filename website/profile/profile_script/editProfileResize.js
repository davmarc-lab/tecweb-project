const WIDTH_MAX = 992;

$('document').ready(function () {
    const url = window.location.href;
    if (url.includes("profilePage.php")) {
        let backbutton = document.getElementById("edit-back-button");
        if (backbutton != null) {
            backbutton.hidden = true;
        }
    } else {
        if (window.innerWidth > WIDTH_MAX) {
            window.location.replace("profilePage.php");
        }
        document.getElementById("edit-back-button").hidden = false;
    }
});

window.addEventListener("resize", function() {
    if (window.location.href.includes("editProfile.php")) {
        if (window.innerWidth > WIDTH_MAX) {
            window.location.replace("profilePage.php");
        }
    }
});
