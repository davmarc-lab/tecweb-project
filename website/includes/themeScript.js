function changeTheme() {
    let elem = document.documentElement;
    elem.dataset.bsTheme = elem.dataset.bsTheme == "light" ? "dark" : "light";
    
    document.cookie = "theme=" + elem.dataset.bsTheme + "; expires=Fri, 31 Dec 2100 23:59:59 GMT; path=/";
}

// Controlla se esiste un cookie del tema e imposta il tema in base al cookie
document.addEventListener("DOMContentLoaded", function () {
    let themeCookie = getCookie("theme");
    let switchElem = document.getElementById("switch-theme");
    if (themeCookie) {
        document.documentElement.dataset.bsTheme = themeCookie;
        if (themeCookie == "light") {
            switchElem.checked = false;
        } else {
            switchElem.checked = true;
        }
    }
    document.getElementById("switch-theme").addEventListener("click", function() {
        let theme = getCookie("theme");
        if (theme) {
            if (theme == "light") {
                document.getElementById("theme-icon").innerHTML = "<i class='bi bi-brightness-high-fill'></i>";
            } else {
                document.getElementById("theme-icon").innerHTML = "<i class='bi bi-moon-fill'></i>";
            }
        }
    });
});

// Funzione per ottenere il valore di un cookie
function getCookie(name) {
    let nameEQ = name + "=";
    let ca = document.cookie.split(';');
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}
