function changeTheme() {
    var elem = document.documentElement;
    elem.dataset.bsTheme = elem.dataset.bsTheme == "light" ? "dark" : "light";
    
    document.cookie = "theme=" + elem.dataset.bsTheme + "; expires=Fri, 31 Dec 2100 23:59:59 GMT; path=/";
}

// Controlla se esiste un cookie del tema e imposta il tema in base al cookie
document.addEventListener("DOMContentLoaded", function () {
    var themeCookie = getCookie("theme");
    var switchElem = document.getElementById("switchTheme");
    if (themeCookie) {
        document.documentElement.dataset.bsTheme = themeCookie;
        if (themeCookie == "light") {
            switchElem.checked = false;
        } else {
            switchElem.checked = true;
        }
    }
});

// Funzione per ottenere il valore di un cookie
function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}
