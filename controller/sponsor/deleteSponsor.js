document.addEventListener("DOMContentLoaded", function () {
    $.ajax({
        async: false,
        url: '../model/sponsor/removeSponsor.php',
        type: 'POST',
    });
});