document.addEventListener("DOMContentLoaded", function() {
    const url = window.location.href;
    if (url.includes("profilePage.php")) {
        document.getElementById("back-button").hidden = true;
    } else {
        document.getElementById("back-button").hidden = false;
        if (window.innerWidth > 768) {
            window.location.replace("profilePage.php");
        }
    }
});

window.addEventListener("resize", function() {
    if (window.location.href.includes("editProfile.php")) {
        if (window.innerWidth > 768) {
            window.location.replace("profilePage.php");
        }
    }
});
