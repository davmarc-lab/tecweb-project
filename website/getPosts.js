const NUMBER_POST_ON_LOAD = 10;

const profilePage = "profile/profilePage.php";
const viewPostPage = "post/viewPost.php";

const postsContainer = document.getElementById("posts-container");

let counter = 0;

/**
 * This method creates an element taht on click link to post author profile page.
 * 
 * @param {*} userId user id from the database.
 * @param {*} username usaername of the author of the post.
 * @returns 
 */
function drawLinkUsernameElement(userId, username) {
    let link = document.createElement("a");
    link.setAttribute("href", profilePage + "?user=" + userId);
    link.innerHTML = "@" + username;
    return link;
}

function vote(postId, increment) {
    $.ajax({
        async: false,
        url: "indexQuery/incrementLike.php",
        type: "POST",
        data: {
            idPost: postId,
            increment: increment,
        },
    });
}

/* function removeVote(postId) {
    $.ajax({
        async: false,
        url: "indexQuery/incrementLike.php",
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
        url: "indexQuery/incrementLike.php",
        type: "POST",
        data: {
            idPost: postId,
            increment: 1,
        },
    });
} */

function createCommentElement(userId, username, text) {
    let pComment = document.createElement("p");
    pComment.classList = "border border-success rounded text-break p-1";
    let linkUsername = drawLinkUsernameElement(userId, username);
    pComment.appendChild(linkUsername);
    pComment.innerHTML += " : " + text;
    return pComment;
}

let lastPos = 0;

$("document").ready(function () {
    counter = 0;
    counter = appendPostToContainer(NUMBER_POST_ON_LOAD);

    window.addEventListener('scroll', function () {
        let currentPos = this.window.scrollY || this.document.documentElement.scrollTop;
        // everytime it scroll 1000 units refresh the posts
        if (currentPos - lastPos > 1000 && counter < posts.length) {
            // appends new post to the main container
            counter = appendPostToContainer(10);

            // update lastpos
            lastPos = currentPos;
        }
    });
});

let posts = null;
let postInfo = null;

$.ajax({
    async: false,
    url: "indexQuery/getPosts.php",
    type: "POST",
    success: function (response) {
        posts = JSON.parse(response);
    }
});

function appendPostToContainer(numPostToLoad) {

    if (posts != null) {
        let currentCounter = counter;
        // Load the posts in the container
        for (let i = currentCounter; i < numPostToLoad + currentCounter && counter < posts.length; i++) {
            let post = posts[i];

            let divPost = document.createElement("div");
            divPost.classList = "card border-1 rounded mx-auto m-4 p-3 single-post";
            divPost.setAttribute("id", "post-" + post["IdPost"]);

            // Post info query
            let idPreview = post["IdPreview"];
            $.ajax({
                async: false,
                url: "indexQuery/getPostInfo.php",
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
            imgProfile.setAttribute("src", pathImgAuthor);
            imgProfile.setAttribute("height", "30px");
            imgProfile.setAttribute("width", "30px");

            // append profile image to row div
            divProfileImage.appendChild(imgProfile);
            divRow.appendChild(divProfileImage);
            divPost.appendChild(divRow);

            // append user profile page link to row div
            let divUser = document.createElement("div");
            divUser.classList = "col mx-2 pt-1";
            let pUser = document.createElement("p");
            pUser.setAttribute("id", "index-post-user-id");
            pUser.appendChild(drawLinkUsernameElement(author["IdUser"], author["Username"]));
            divUser.appendChild(pUser);
            divRow.appendChild(divUser);

            // add image preview to the post div
            if (pathPostPreview != "") {
                let imgPreview = document.createElement("img");
                imgPreview.setAttribute("src", pathPostPreview);
                imgPreview.classList = "card-img-top img-fluid";
                divPost.appendChild(imgPreview);
            }

            // appends all elements to diCardCol, after to the others div
            let divCardBody = document.createElement("div");
            divCardBody.classList = "card-body";

            // add date and category
            let pDatePost = document.createElement("p");
            pDatePost.setAttribute("id", "show-date");
            date = post["Date"];
            if (date == null) {
                pDatePost.innerHTML = "";
            } else {
                date = date.substr(0, 10);
                pDatePost.innerHTML = date;
            }
            divCardBody.appendChild(pDatePost);

            let idPostCategory = post["IdCategory"];
            if (idPostCategory != null) {
                // the post has category
                let category = null;
                $.ajax({
                    async: false,
                    url: "indexQuery/getCategory.php",
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
                url: "indexQuery/getVoteInfo.php",
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
                    //removeVote(post["IdPost"]);
                    vote(post["IdPost"], -1);
                    increment = -1;
                } else {
                    // like action
                    likeIcon.classList.add("bi-hand-thumbs-up-fill");
                    likeIcon.classList.add("text-primary");
                    likeIcon.classList.remove("bi-hand-thumbs-up");
                    //addVote(post["IdPost"]);
                    vote(post["IdPost"], 1);
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
            linkPost.setAttribute("href", viewPostPage + "?id=" + post["IdPost"]);
            linkPost.classList.add("float-end");
            let linkButton = document.createElement("button");
            linkButton.classList = "btn btn-primary view-post";
            linkButton.innerHTML = "View Post";
            linkPost.appendChild(linkButton);
            divCardCol.appendChild(linkPost);

            // append post title and description
            let titlePost = document.createElement("h5");
            titlePost.classList.add("card-title");
            titlePost.innerHTML = post["Title"];
            divCardCol.appendChild(titlePost);

            let descriptionPost = document.createElement("p");
            descriptionPost.classList.add("card-text");
            let textDescription = post["Description"];
            if (textDescription.length > 200) {
                textDescription = textDescription.substr(0, 200);
                textDescription += "...";
            } 
            descriptionPost.innerHTML = textDescription;
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
                    url: "indexQuery/getComments.php",
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
                for (let j = 0; j < comments.length && j < 3; j++) {
                    let current = comments[j];
                    let username = null;
                    // get user from comment
                    $.ajax({
                        async: false,
                        url: "indexQuery/getSourceComment.php",
                        type: "POST",
                        data: {
                            idUser: current["IdUser"],
                        },
                        success: function (response) {
                            username = response;
                        }
                    });

                    if (username != null) {
                        let newComment = createCommentElement(current["IdUser"], username, current["CommentText"]);
                        divComments.appendChild(newComment);
                    }
                }
            }

            // append user comment div
            let divUserComment = document.createElement("div");
            divUserComment.classList.add("form-group");

            // add input for the user
            let areaComment = document.createElement("textarea");
            areaComment.classList = "form-control textAreaComment";
            areaComment.setAttribute("id", "text-area-comment");
            areaComment.setAttribute("rows", 3);
            areaComment.setAttribute("cols", 20);
            areaComment.setAttribute("placeholder", "Add your comment");
            areaComment.setAttribute("name", "commentText");
            divUserComment.appendChild(areaComment);

            // add submit button
            let btnSendComment = document.createElement("button");
            btnSendComment.classList = "btn btn-primary mt-3 float-end";
            btnSendComment.innerHTML = "Comment";
            btnSendComment.setAttribute("aria-disabled", true);
            btnSendComment.classList.add("disabled");

            // add event listener to comment
            btnSendComment.addEventListener('click', function () {
                // add comment to the database
                let textComment = areaComment.value;
                $.ajax({
                    async: false,
                    url: "indexQuery/addComment.php",
                    type: "POST",
                    data: {
                        idPost: post["IdPost"],
                        textComment: textComment,
                    },
                });

                // update pCommentNumber
                pCommentNumber.innerHTML = Number(pCommentNumber.innerHTML) + 1;

                // update comments
                let currentComments = divComments;
                // get current user info
                let user = null;
                $.ajax({
                    async: false,
                    url: "indexQuery/getCurrentUser.php",
                    type: "POST",
                    success: function (response) {
                        user = JSON.parse(response);
                    },
                });

                divComments.insertBefore(createCommentElement(user["IdUser"], user["Username"], areaComment.value),
                    divComments.children[0]);
                if (divComments.childElementCount > 4) {
                    divComments.removeChild(divComments.children[3]);
                }
                // clear textarea
                areaComment.value = "";
                btnSendComment.setAttribute("aria-disabled", true);
                btnSendComment.classList.add("disabled");
            });

            areaComment.addEventListener('input', function () {
                if (this.value.length <= 0) {
                    btnSendComment.setAttribute("aria-disabled", true);
                    btnSendComment.classList.add("disabled");
                } else {
                    btnSendComment.setAttribute("aria-disabled", false);
                    btnSendComment.classList.remove("disabled");
                }
            });

            divUserComment.appendChild(btnSendComment);
            divComments.appendChild(divUserComment);

            divPost.appendChild(divComments);

            // Last instruction
            postsContainer.appendChild(divPost);
            counter++;
        }
    }

    return counter;
}
