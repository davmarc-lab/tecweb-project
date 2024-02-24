document.addEventListener("DOMContentLoaded", function () {
    console.log("Rimuovo sponsor");
    $.ajax({
        async: false,
        url: '../model/sponsor/removeSponsor.php',
        type: 'POST',
        success: function (response) {
            console.log(response);
        }
    });
});