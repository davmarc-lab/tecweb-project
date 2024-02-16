document.addEventListener('DOMContentLoaded', function () {
    $.ajax({
        url: "../model/utils/lastSeen.php",
        method: "POST",
        data: {
            delete: -1,
        }
    });
});