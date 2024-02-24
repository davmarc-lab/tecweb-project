document.addEventListener('DOMContentLoaded', function () {
    $('#navbar-space').load('../view/navbar.html');

    document.getElementById("p-explain-private").style.display = "none";

    document.getElementById("private-more-info").addEventListener("click", function () {
        let pExplain = document.getElementById("p-explain-private");
        let pStyle = window.getComputedStyle(pExplain);
        if (pStyle.getPropertyValue("display") === "none") {
            //se non è mostrato
            pExplain.style.display = "";
        } else {
            //se è mostrato
            pExplain.style.display = "none";
        }
    });
});

