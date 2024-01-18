document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".btn-following").forEach(function (btt) {
        btt.addEventListener("click", function () {
            let bttId = btt.id;
            let dst = bttId.replace("dstuser-", "");
            let userId = 0;
            if (btt.textContent === "Follow") {
                $.ajax({
                    async: false,
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
                    async: false,
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