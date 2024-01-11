if (window.location.hash) {
    var targetId = window.location.hash.substring(1);
    targetId = "div" + targetId;
    console.log("target:" + targetId);
    console.log("\nIstruzione: " + "document.getElementById(" + targetId + ")");
    var targetElement = document.getElementById(targetId);
    console.log(targetElement);
    if (targetElement) {
        console.log("Sono nell'if");
        targetElement.scrollIntoView();
    } else {
        console.log("Non trovato");
    }
}