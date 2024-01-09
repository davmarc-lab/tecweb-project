function showHide() {
    var inputBlock = document.getElementById("loginPassword");
    if (inputBlock.type === "password") {
        inputBlock.type = "text";
    } else {
        inputBlock.type = "password";
    }
}