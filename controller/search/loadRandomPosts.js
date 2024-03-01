document.addEventListener("DOMContentLoaded", function () {
    let randomPostContainer = document.getElementById("random-post-container");
    $.ajax({
        async: false,
        url: '../model/search/getRandomPosts.php',
        type: 'GET',
        success: function (response) {
            printPostToTarget(randomPostContainer, response);
        }
    })
});