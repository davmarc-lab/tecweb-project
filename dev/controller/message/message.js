function createMessageInput(div, dst) {
    // remove the old input if exist
    let oldInput = document.getElementById('input-area');
    if (oldInput != null) {
        div.removeChild(oldInput);
    }

    // add text box at the end of the div
    let divUserInput = document.createElement('div');
    divUserInput.setAttribute('id', 'input-area');

    let areaMessage = document.createElement('textarea');
    areaMessage.setAttribute('rows', '3');
    areaMessage.placeholder = "Write your message here...";
    divUserInput.appendChild(areaMessage);

    let sendMessage = document.createElement('button');
    sendMessage.classList.add('btn', 'btn-primary');
    sendMessage.innerHTML = "Send";
    sendMessage.disabled = areaMessage.value == "";
    divUserInput.appendChild(sendMessage);

    // event listeners
    areaMessage.addEventListener('input', function () {
        sendMessage.disabled = this.value == "";
    });

    sendMessage.addEventListener('click', function () {
        // insert into database the new message
        let messageText = areaMessage.value;

        $.ajax({
            url: "../model/message/sendMessage.php",
            method: "POST",
            data: {
                message: messageText,
                dst: dst,
            },
            success: function (srcId) {
                $.ajax({
                    url: "../model/utils/profileInfo.php",
                    method: "POST",
                    data: {
                        id: srcId,
                    },
                    success: function (response) {
                        let infoSrc = JSON.parse(response);
                        let pNewMsg = document.createElement('p');
                        pNewMsg.classList.add('message-src');
                        pNewMsg.innerHTML = infoSrc['Username'] + ": " + messageText;
                        let divMessages = document.getElementById('chat-messages');
                        divMessages.appendChild(pNewMsg);

                        // clear text area
                        areaMessage.value = "";
                        sendMessage.disabled = true;
                    },
                });
            }
        });
    });

    div.appendChild(divUserInput);
}

function printAllMessages(div, messages, dst) {
    // take the current user
    let src = null;
    $.ajax({
        async: false,
        url: "../model/utils/loggedUser.php",
        method: "POST",
        success: function (response) {
            src = response;
        }
    });

    // clear the div
    div.innerHTML = "";

    // write all messages
    messages.forEach(elem => {
        let pMsg = document.createElement('p');
        if (elem['IdSrc'] == src) {
            pMsg.classList.add('message-src');
        } else {
            pMsg.classList.add('message-dst');
        }
        // get source info
        let user = null;
        $.ajax({
            async: false,
            url: "../model/utils/profileInfo.php",
            method: "POST",
            data: {
                id: elem['IdSrc'],
            },
            success: function (response) {
                user = JSON.parse(response);
            }
        });
        if (user != null) {
            pMsg.innerHTML = user['Username'] + ": " + elem['Content'];
            div.appendChild(pMsg);
        }
    });

    // creates input for sending messages
    let newChatSpace = document.getElementById('chat-content');
    createMessageInput(newChatSpace, dst);
}

function loadMessages(userId) {
    let messagesDiv = document.getElementById('chat-messages');
    let messages = null;
    $.ajax({
        url: "../model/message/getMessages.php",
        method: "POST",
        data: {
            dstUser: userId,
        },
        success: function (response) {
            if (response != "") {
                messages = JSON.parse(response);
                printAllMessages(messagesDiv, messages, userId);
            }
        },
    });
}

function printAllChats(div, chats) {
    chats.forEach(element => {
        let newChat = document.createElement('li');
        // get username from this id
        $.ajax({
            url: "../model/utils/profileInfo.php",
            method: "POST",
            data: {
                id: element['IdUser'],
            },
            success: function (response) {
                let elem = JSON.parse(response);

                // get media information
                let profileImg = null;
                let imgProfile = document.createElement('img');
                $.ajax({
                    url: "../model/utils/getMediaFromId.php",
                    type: "POST",
                    data: {
                        id: elem['IdMedia'],
                    },
                    success: function (response) {
                        profileImg = JSON.parse(response);
                        imgProfile.setAttribute('src', '../' + profileImg['FilePath']);
                    }
                });

                imgProfile.setAttribute('alt', 'User Profile Image');
                imgProfile.classList.add('profile-icon');
                newChat.appendChild(imgProfile);

                let pText = document.createElement('p');
                pText.innerHTML = "@" + elem['Username'];
                newChat.appendChild(pText);
                drawMobileLayout(newChat);
                newChat.addEventListener('click', function () {
                    loadMessages(elem['IdUser']);
                });
            }
        });

        div.appendChild(newChat);
    });
}

function createEmptyChat(dstId) {
    let newChatSpace = document.getElementById('chat-messages');
    newChatSpace.innerHTML = "";

    // append new chat to chat list
    let newListItem = document.createElement('li');
    // get username from this id
    $.ajax({
        url: "../model/utils/profileInfo.php",
        method: "POST",
        data: {
            id: dstId,
        },
        success: function (response) {
            let elem = JSON.parse(response);

            // get media information
            let profileImg = null;
            let imgProfile = document.createElement('img');
            $.ajax({
                url: "../model/utils/getMediaFromId.php",
                type: "POST",
                data: {
                    id: elem['IdMedia'],
                },
                success: function (response) {
                    profileImg = JSON.parse(response);
                    imgProfile.setAttribute('src', '../' + profileImg['FilePath']);
                }
            });

            imgProfile.setAttribute('alt', 'User Profile Image');
            imgProfile.classList.add('profile-icon');
            newListItem.appendChild(imgProfile);

            let pText = document.createElement('p');
            pText.innerHTML = "@" + elem['Username'];
            newListItem.appendChild(pText);
            drawMobileLayout(newListItem);
            newListItem.addEventListener('click', function () {
                loadMessages(elem['IdUser']);
            });
        }
    });

    let allChat = document.getElementById('list-chat');
    allChat.insertBefore(newListItem, allChat.children[0]);

    // event listener
    newListItem.addEventListener('click', function () {
        newChatSpace.innerHTML = "";
        createMessageInput(document.getElementById('chat-content'), dstId)
    });
}

function printFollowUser(modalBody, followList) {
    let usersList = document.createElement('ul');
    followList.forEach(elem => {
        let listElem = document.createElement('li');
        listElem.innerHTML = elem['Username'];
        usersList.appendChild(listElem);

        // event listener
        drawMobileLayout(listElem);
        listElem.addEventListener('click', function () {
            let modal = document.getElementById('modal-new-chat');
            modal.style.display = "none";

            // set new space
            createEmptyChat(elem['IdUser']);
        });
    });
    modalBody.appendChild(usersList);
}

function createModalSpace(parent, id, title, chats) {
    let divModal = document.createElement('div');
    divModal.setAttribute('id', id);
    divModal.style.display = "block";
    divModal.classList.add('modal');

    let divContent = document.createElement('div');
    divContent.classList.add('modal-content');

    let modalHeader = document.createElement('div');
    modalHeader.classList.add('modal-header');
    divContent.appendChild(modalHeader);

    let modalBody = document.createElement('div');
    modalBody.classList.add('modal-body');
    divContent.appendChild(modalBody);

    let span = document.createElement('span');
    span.classList.add('close');
    span.innerHTML = "&times;";
    modalHeader.appendChild(span);

    let pTitle = document.createElement('h2');
    pTitle.innerHTML = title;
    modalHeader.appendChild(pTitle);

    divModal.appendChild(divContent);

    // actions
    span.addEventListener('click', function () {
        divModal.style.display = "none";
        parent.removeChild(divModal);
    });

    window.addEventListener('click', function (event) {
        if (event.target == divModal) {
            divModal.style.display = "none";
            parent.removeChild(divModal);
        }
    });

    // content
    let followList = null;
    $.ajax({
        url: "../model/profile/getFollow.php",
        method: "POST",
        success: function (response) {
            if (response != "") {
                followList = JSON.parse(response);
                followList = followList.filter(elem => !(chats.map(elem => elem['IdUser']).includes(elem['IdUser'])));
                printFollowUser(modalBody, followList);
            }
        },
    });

    return divModal;
}

function drawMobileLayout (item) {
    // get aside and main panels
    let asidePanel = document.getElementById("chat-users");
    let mainPanel = document.querySelector("main");
    /* event listener if the screen has max width of 992 pixels */
    if (window.innerWidth <= 992) {
        item.addEventListener('click', function () {
            asidePanel.style.display = "none";
            mainPanel.style.display = "block";
        })
    }
}

document.addEventListener('DOMContentLoaded', function () {
    $("#navbar-space").load("../view/navbar.html");
    let listChat = document.getElementById('list-chat');
    let chats = null;
    $.ajax({
        url: "../model/message/getChatList.php",
        method: "POST",
        success: function (response) {
            if (response != "") {
                chats = JSON.parse(response);
                printAllChats(listChat, chats);
            }
        },
    });

    let btnNewChat = document.getElementById('btn-new-chat');
    btnNewChat.addEventListener('click', function () {
        let oldModal = document.getElementById('modal-new-chat');
        if (oldModal != null) {
            document.body.removeChild(oldModal);
        }
        let chatModal = createModalSpace(document.body, 'modal-new-chat', "New Chat", chats);
        document.body.appendChild(chatModal);
    });

});