document.addEventListener("DOMContentLoaded", function() {
    const url = window.location.href;
    if (url.includes("profilePage.php")) {
        document.getElementById("edit-back-button").hidden = true;
    } else {
        if (window.innerWidth > 768) {
            window.location.replace("profilePage.php");
        }
        document.getElementById("edit-back-button").hidden = false;
    }
});

window.addEventListener("resize", function() {
    if (window.location.href.includes("editProfile.php")) {
        if (window.innerWidth > 768) {
            window.location.replace("profilePage.php");
        }
    }
});
