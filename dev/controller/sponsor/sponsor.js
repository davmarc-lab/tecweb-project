document.addEventListener("DOMContentLoaded", function () {
    let user;
    let currentId;
    $.ajax({
        async: false,
        url: '../model/utils/loggedUser.php',
        type: 'POST',
        success: function (response) {
            currentId = response;
        }
    });
    $.ajax({
        async: false,
        url: "../model/utils/getAllInfo.php",
        method: "POST",
        data: {
            id: currentId,
        },
        success: function (response) {
            user = JSON.parse(response);
        }
    });

    drawUserPost(document.getElementById("post-container"), user);

    let allPosts = Array.from(document.getElementById("post-container").children);
    console.log(allPosts);

    allPosts.forEach(function (post) {
        post.addEventListener("click", function() {
            let id = post.querySelectorAll('a')[0].href.split('=')[1];
            
        });
    });

});