const NUMBER_POST = 10;
const profilePage = "profile/profilePage.php";
const viewPostPage = "post/viewPost.php";

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
            let idPreview = post["IdPreview"];
            $.ajax({
                async: false,
                url: "postQuery/getPostInfo.php",
                type: "POST",
                data: {
                    idUser: post["IdUser"],
                    idPreview: idPreview > 0 ? idPreview : -1,
                },
                success: function (response) {
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
            if (pathPostPreview != "") {
                let imgPreview = document.createElement("img");
                imgPreview.setAttribute("src", "../" + pathPostPreview);
                imgPreview.classList = "card-img-top img-fluid";
                divPost.appendChild(imgPreview);
            }

            // appends all elements to diCardCol, after to the others div
            let divCardBody = document.createElement("div");
            divCardBody.classList = "card-body";

            // add date and category
            let pDatePost = document.createElement("p");
            pDatePost.setAttribute("id", "show-date");
            date = post["Date"].substr(0, 10);
            pDatePost.innerHTML = date;
            divCardBody.appendChild(pDatePost);

            let idPostCategory = post["IdCategory"];
            if (idPostCategory != null) {
                // the post has category
                let category = null;
                $.ajax({
                    async: false,
                    url: "postQuery/getCategory.php",
                    type: "POST",
                    data: {
                        idCategory: idPostCategory,
                    },
                    success: function (response) {
                        category = JSON.parse(response);
                    },
                });
                // category info taken
                let spanCategory = document.createElement("span");
                spanCategory.setAttribute("id", "category-badge");
                spanCategory.classList = "badge border rounded-pill text-bg-primary";
                let pCat = document.createElement("p");
                pCat.classList.add("m-0");
                pCat.innerHTML = category["Description"];

                spanCategory.appendChild(pCat);
                divCardBody.appendChild(spanCategory);
            }

            // append div
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

            // append comment number to divcardcol
            let pCommentNumber = document.createElement("p");
            pCommentNumber.classList = "badge bg-secondary ms-4";
            pCommentNumber.innerHTML = post["NumberComment"];
            divCardCol.appendChild(pCommentNumber);

            // append commment icon
            let btnComment = document.createElement("button");
            btnComment.classList = "btn btn-lg border-0";
            let commentIcon = document.createElement("i");
            commentIcon.classList = "bi bi-chat-left-text";
            btnComment.appendChild(commentIcon);
            divCardCol.appendChild(btnComment);

            // append link to viewPost page
            let linkPost = document.createElement("a");
            linkPost.setAttribute("href", "../" + viewPostPage + "?id=" + post["IdPost"]);
            linkPost.classList.add("float-end");
            let linkButton = document.createElement("button");
            linkButton.classList = "btn btn-primary";
            linkButton.innerHTML = "More";
            linkPost.appendChild(linkButton);
            divCardCol.appendChild(linkPost);

            // append post title and description
            let titlePost = document.createElement("h5");
            titlePost.classList.add("card-title");
            titlePost.innerHTML = post["Title"];
            divCardCol.appendChild(titlePost);

            let descriptionPost = document.createElement("p");
            descriptionPost.classList.add("card-text");
            descriptionPost.innerHTML = post["Description"];
            divCardCol.appendChild(descriptionPost);

            // prepare all the elements of the card
            divCardRow.appendChild(divCardCol);
            divCardBody.appendChild(divCardRow);
            divPost.appendChild(divCardBody);

            // append container for the comments
            let divComments = document.createElement("div");
            divComments.classList = "container m-0";

            let comments = null;
            if (post["NumberComment"] > 0) {
                $.ajax({
                    async: false,
                    url: "postQuery/getComments.php",
                    type: "POST",
                    data: {
                        idPost: post["IdPost"],
                    },
                    success: function (response) {
                        comments = JSON.parse(response);
                    }
                });
            }

            // if there are comments append them
            if (comments != null) {
                for (j = 0; j < comments.length && j < 3; j++) {
                    let current = comments[j];
                    let username = null;
                    // get user from comment
                    $.ajax({
                        async: false,
                        url: "postQuery/getSourceComment.php",
                        type: "POST",
                        data: {
                            idUser: current["IdUser"],
                        },
                        success: function (response) {
                            username = response;
                        }
                    });

                    if (username != null) {
                        let pComment = document.createElement("p");
                        pComment.classList = "border border-success rounded text-break p-1";
                        let linkUsername = drawLinkUsernameElement(current["IdUser"], username);
                        pComment.appendChild(linkUsername);
                        pComment.innerHTML += " : " + current["CommentText"];
                        divComments.appendChild(pComment);
                    }
                    
                    // append text area
                    
                }

                divPost.appendChild(divComments);
            }


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
