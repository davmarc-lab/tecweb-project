const NUMBER_POST = 10;
const profilePage = "profile/profilePage.php";

let posts = null;
let postInfo = null;

$.ajax({
    async: false,
    url: "postQuery/getPosts.php",
    type: "POST",
    data: {
        limit: NUMBER_POST,
    },
    success: function (response) {
        posts = JSON.parse(response);
    }
});

/**
 * This method creates an element taht on click link to post author profile page.
 * 
 * @param {*} userId user id from the database.
 * @param {*} username usaername of the author of the post.
 * @returns 
 */
function drawLinkUsernameElement(userId, username) {
    let link = document.createElement("a");
    link.setAttribute("href", "../" + profilePage + "?user=" + userId);
    link.innerHTML = "@" + username;
    return link;
}

function removeVote(postId) {
    $.ajax({
        async: false,
        url: "postQuery/incrementLike.php",
        type: "POST",
        data: {
            idPost: postId,
            increment: -1,
        },
    });
}

function addVote(postId) {
    $.ajax({
        async: false,
        url: "postQuery/incrementLike.php",
        type: "POST",
        data: {
            idPost: postId,
            increment: 1,
        },
    });
}

$("document").ready(function () {
    if (posts != null) {
        // Load the posts in the container
        let postsContainer = document.getElementById("posts-container");
        for (i = 0; i < posts.length; i++) {
            let post = posts[i];

            let divPost = document.createElement("div");
            divPost.classList = "card border-1 rounded mx-auto m-4 p-3 single-post";
            divPost.setAttribute("id", "post-" + post["IdPost"]);

            // Post info query
            $.ajax({
                async: false,
                url: "postQuery/getPostInfo.php",
                type: "POST",
                data: {
                    idUser: post["IdUser"],
                    idPreview: post["IdPreview"],
                },
                success: function (response) {
                    // posts = JSON.parse(response);
                    if (response != null) {
                        postInfo = JSON.parse(response);
                    }
                }
            });

            let author = postInfo[0];
            let pathImgAuthor = postInfo[1]["ProfilePath"];
            let pathPostPreview = postInfo[2]["PreviewPath"];

            let divRow = document.createElement("div");
            divRow.classList = "row";

            // creates profile image div in the row div
            let divProfileImage = document.createElement("div");
            divProfileImage.classList = "col-1";
            let imgProfile = document.createElement("img");
            imgProfile.setAttribute("src", "../" + pathImgAuthor);
            imgProfile.setAttribute("height", "30px");
            imgProfile.setAttribute("width", "30px");

            // append profile image to row div
            divProfileImage.appendChild(imgProfile);
            divRow.appendChild(divProfileImage);
            divPost.appendChild(divRow);

            // append user profile page link to row div
            let divUser = document.createElement("div");
            divUser.classList = "col-3 pt-1";
            let pUser = document.createElement("p");
            pUser.setAttribute("id", "index-post-user-id");
            pUser.appendChild(drawLinkUsernameElement(author["IdUser"], author["Username"]));
            divUser.appendChild(pUser);
            divRow.appendChild(divUser);

            // add image preview to the post div
            let imgPreview = document.createElement("img");
            imgPreview.setAttribute("src", "../" + pathPostPreview);
            imgPreview.classList = "card-img-top img-fluid";
            divPost.appendChild(imgPreview);

            // appends all elements to diCardCol, after to the others div
            let divCardBody = document.createElement("div");
            divCardBody.classList = "card-body";
            let divCardRow = document.createElement("div");
            divCardRow.classList = "row";
            let divCardCol = document.createElement("div");
            divCardCol.classList = "col";

            // like button and counter part
            let pVoteNumber = document.createElement("p");
            pVoteNumber.classList = "badge bg-secondary ms-4";
            pVoteNumber.setAttribute("id", "vote-indicator" + post["IdPost"]);
            pVoteNumber.innerHTML = post["NumberVote"];

            let likeButton = document.createElement("button");
            likeButton.classList = "btn btn-lg border-0";
            let likeIcon = document.createElement("i");
            likeIcon.classList = "bi";

            // query to get like button icon
            let numberVote = post["NumberVote"];
            $.ajax({
                async: false,
                url: "postQuery/getVoteInfo.php",
                type: "POST",
                data: {
                    idPost: post["IdPost"],
                },
                success: function (response) {
                    numberVote = response;
                }
            });
            // put it in a function?
            likeIcon.classList += (numberVote > 0 ?
                (" bi-hand-thumbs-up-fill text-primary") :
                " bi-hand-thumbs-up");
            likeButton.appendChild(likeIcon);

            // event listener for like button
            likeButton.addEventListener('click', function () {
                let increment = 0;
                if (this.children[0].classList.contains("bi-hand-thumbs-up-fill")) {
                    // dislike action
                    likeIcon.classList.remove("bi-hand-thumbs-up-fill");
                    likeIcon.classList.remove("text-primary");
                    likeIcon.classList.add("bi-hand-thumbs-up");
                    removeVote(post["IdPost"]);
                    increment = -1;
                } else {
                    // like action
                    likeIcon.classList.add("bi-hand-thumbs-up-fill");
                    likeIcon.classList.add("text-primary");
                    likeIcon.classList.remove("bi-hand-thumbs-up");
                    addVote(post["IdPost"]);
                    increment = 1;
                }
                // update the like number from the current value
                pVoteNumber.innerHTML = Number(pVoteNumber.innerHTML) + increment;
            });


            // append the vote number and the like button
            divCardCol.appendChild(pVoteNumber);
            divCardCol.appendChild(likeButton);

            // prepare all the elements of the card
            divCardRow.appendChild(divCardCol);
            divCardBody.appendChild(divCardRow);
            divPost.appendChild(divCardBody);

            // let divComment = document.createElement("div");

            // foreach commenti
            // ,...
            // bottone.addEventListener --- comment

            // 

            // Last instruction
            postsContainer.appendChild(divPost);
        }
    }
});

function drawPost(idPost) {

}
