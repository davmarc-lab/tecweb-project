document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".btn-following").forEach(function (btt) {
        btt.addEventListener("click", function () {
            let bttId = btt.id;
            console.log(bttId);
            let dst = bttId.replace("dstuser-", "");
            console.log(dst);
            let userId = 0;
            if (btt.textContent === "Follow") {
                $.ajax({
                    url: "../profile/followUserQuery.php",
                    type: "POST",
                    data: {
                        dstUser: dst
                    },
                    success: function (response) {
                        btt.innerHTML = "Unfollow";
                    },
                });
            } else {
                $.ajax({
                    url: "../profile/unfollowUserQuery.php",
                    type: "POST",
                    data: {
                        dstUser: dst
                    },
                    success: function (response) {
                        btt.innerHTML = "Follow";
                    },
                });
            }
        });
    });
});