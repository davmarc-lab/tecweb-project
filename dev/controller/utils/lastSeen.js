function updateLastSeen(remove = -1) {
    $.ajax({
        url: "../model/utils/lastSeen.php",
        method: "POST",
        data: {
            delete: remove,
        }
    });
}