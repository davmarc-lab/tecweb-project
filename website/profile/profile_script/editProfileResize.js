document.addEventListener("DOMContentLoaded", function() {
    const url = window.location.href;
    if (url.includes("profilePage.php")) {
        document.getElementById("backButton").hidden = true;
    } else {
        document.getElementById("backButton").hidden = false;
        if (window.innerWidth > 768) {
            window.location.replace("profilePage.php");
        }
    }
});

window.addEventListener("resize", function() {
    if (window.location.href.includes("editProfile.php")) {
        console.log(window.innerWidth);
        if (window.innerWidth > 768) {
            window.location.replace("profilePage.php");
        }
    }
});
