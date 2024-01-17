function followUser(srcUser, dstUser, path) {
    console.log(path);
    // shouldn't enter in this condition because the button is hidden.
    if (srcUser == dstUser) {
        console.log("Cannot follow yourself!");
        return;
    }

    // follow user
    $.ajax({
        url: path,
        type: "POST",
        data: {
            srcUser: srcUser,
            dstUser: dstUser
        },
        success: function (response) {
            document.getElementById("unfollow-button").classList.remove("d-none");
            document.getElementById("follow-button").classList.add("d-none");
            location.reload();
        },
    });
}

function unfollowUser(srcUser, dstUser, path) {
    // shouldn't enter in this condition because the button is hidden.
    if (srcUser == dstUser) {
        console.log("Cannot follow yourself!");
        return;
    }

    // unfollow user
    $.ajax({
        url: path,
        type: "POST",
        data: {
            srcUser: srcUser,
            dstUser: dstUser
        },
        success: function (response) {
            document.getElementById("unfollow-button").classList.add("d-none");
            document.getElementById("follow-button").classList.remove("d-none");
            location.reload();
        },
    });
}