function printPostToTarget (targetContainer, posts) {
    /* console.log("sono la funzione separata");
    console.log(posts); */
    posts = JSON.parse(posts);
    let index = 0;
    let rowContainer;
    posts.forEach(function (post) {
        //let newPost = document.createElement()
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
                    previewPath = response.FilePath;
                }
            });
        } else {
            empty = true;
        }
        if (index == 0) {
            rowContainer = createRowContainer();
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
                userInfo = response;
            }
        });
        let postDiv = createPostDiv();
        let card = document.createElement("div");
        card.classList.add('card');
        let pUsername = createUsernameLink();
        
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
    a.setAttribute("href", targetLink + "?user=" + userId + "\\");
    a.innerHTML = "@" + username;
    p.appendChild(a);
}