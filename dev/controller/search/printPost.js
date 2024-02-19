function printPostToTarget (targetContainer, posts) {
    posts = JSON.parse(posts);
    let index = 0;
    let rowContainer;
    posts.forEach(function (post) {
        let previewPath;
        let empty = false;
        if (post.IdPreview != null) {
            $.ajax({
                async: false,
                url: '../model/utils/getMediaFromId.php',
                type: 'POST',
                data: {
                    id: post.IdPreview
                },
                success: function (response) {
                    response = JSON.parse(response);
                    previewPath = "../" + response.FilePath;
                }
            });
        } else {
            empty = true;
        }
        if (index == 0) {
            rowContainer = createRowContainer();
            targetContainer.appendChild(rowContainer);
        }
        let userInfo;
        $.ajax({
            async: false,
            url: '../model/utils/profileInfo.php',
            type: 'POST',
            data: {
                id: post.IdUser
            },
            success: function (response) {
                response = JSON.parse(response);
                userInfo = response;
            }
        });
        let postDiv = createPostDiv();
        rowContainer.appendChild(postDiv);
        let card = document.createElement("div");
        card.classList.add('card');
        postDiv.appendChild(card);
        let pUsername = createUsernameLink(userInfo.Username, userInfo.IdUser, "profilePage.html");
        card.appendChild(pUsername);
        if (!empty) {
            let imagePreview = document.createElement("img");
            imagePreview.setAttribute("src", previewPath);
            imagePreview.classList.add('card-img-top', 'p-1');
            imagePreview.setAttribute("alt", "Post preview");
            card.appendChild(imagePreview);
        }
        let cardBody = createCardBody();
        card.appendChild(cardBody);
        let dateP = createDate(post.Date);
        cardBody.appendChild(dateP);
        if (post.IdCategory != null) {
            $.ajax({
                async: false,
                url: '../model/search/getCategoryDescription.php',
                type: 'POST',
                data: {
                    Id: post.IdCategory
                },
                success: function (response) {
                    cardBody.appendChild(createCategory(response));
                }
            })
        }
        let postTitle = createPostTitle(post.Title);
        cardBody.appendChild(postTitle);
        let postDescription = createPostDescription(post.Description);
        cardBody.appendChild(postDescription);
        let viewButton = createViewPostButton(post.IdPost);
        cardBody.appendChild(viewButton);
        index = (index + 1)%3;
    });
}

function createRowContainer () {
    let row = document.createElement("div");
    row.classList.add('row', 'mt-5', 'd-flex', 'justify-content-center', 'align-items-center', 'text-center');
    return row;
}

function createPostDiv () {
    let postDiv = document.createElement("div");
    postDiv.classList.add('col-md-4', 'col-12', 'mx-auto', 'my-5', 'd-flex', 'justify-content-center');
    return postDiv;
}

function createUsernameLink(username, userId, targetLink) {
    let p = document.createElement("p");
    p.classList.add('m-1');
    let a = document.createElement("a");
    a.setAttribute("href", targetLink + "?user=" + userId);
    a.innerHTML = "@" + username;
    p.appendChild(a);
    return p;
}

function createCardBody() {
    let card = document.createElement("div");
    card.classList.add('card-body');
    return card;
}

function createDate(date) {
    let p = document.createElement("p");
    p.classList.add('show-date');
    p.innerText = String(date).substring(0, 11);
    return p;
}

function createCategory(category) {
    let p = document.createElement("p");
    //span.classList.add('badge', 'border', 'rounded-pill', 'mb-2');
    p.innerText = category;
    return p;
}

function createPostTitle(postTitle) {
    let title = document.createElement("h1");
    title.classList.add('card-title', 'mt-2');
    title.innerHTML = postTitle;
    return title;
}

function createPostDescription(postDescription) {
    let p = document.createElement("p");
    p.classList.add('card-text');
    p.innerText = String(postDescription).substring(0, 101);
    if (String(postDescription).length > 100) {
        p.innerText += "...";
    }
    return p;
}

function createViewPostButton(postId) {
    let a = document.createElement("a");
    a.setAttribute("href", "viewPost.html?id=" + postId);
    a.setAttribute("role", "button");
    a.classList.add('btn', 'btn-primary', 'view-post');
    a.innerHTML = "View post";
    return a;
}