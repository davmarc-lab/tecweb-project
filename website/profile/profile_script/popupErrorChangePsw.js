document.addEventListener("DOMContentLoaded", function() {
    let urlParams = new URLSearchParams(window.location.search);
    let errorParam = urlParams.get("error");
    if (errorParam === "0") {
        document.getElementById("insertOld").hidden = true;
        document.getElementById("insertNew").hidden = false;
    }
    if (errorParam === "1") {
        Swal.fire({
            icon: 'error',
            title: "The password is not correct, please try again",
            text: '',
        });
    }
    if (errorParam === "2") {
        Swal.fire({
            icon: 'error',
            title: "Passwords do not match! Re-enter the old password.",
            text: '',
        });
        document.getElementById("insertOld").hidden = true;
        document.getElementById("insertNew").hidden = false;
    }
});
