function createMessageInput(div, dst) {
    // add text box at the end of the div
    let divUserInput = document.createElement('div');

    let areaMessage = document.createElement('textarea');
    areaMessage.placeholder = "Write your message here...";
    divUserInput.appendChild(areaMessage);

    let sendMessage = document.createElement('button');
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
                        pNewMsg.innerHTML = infoSrc['Username'] + ": " + messageText;
                        div.insertBefore(pNewMsg, divUserInput);

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

    // crates input for sending messages
    createMessageInput(div, dst);
}

function loadMessages(userId) {
    let messagesDiv = document.getElementById('chat-content');
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

                let imgProfile = document.createElement('img');
                imgProfile.setAttribute('src', 'path/to/image');
                imgProfile.setAttribute('alt', 'User Profile Image');
                newChat.appendChild(imgProfile);

                let pText = document.createElement('p');
                pText.innerHTML = "@" + elem['Username'];
                newChat.appendChild(pText);
                newChat.addEventListener('click', function () {
                    loadMessages(elem['IdUser']);
                });
            }
        });

        // get message for this user        --OPTIONAL--


        div.appendChild(newChat);
    });
}

function createEmptyChat(dstId) {
    let newChatSpace = document.getElementById('chat-content');
    newChatSpace.innerHTML = "";

    createMessageInput(newChatSpace, dstId);
}

function printFollowUser(modalBody, followList) {
    let usersList = document.createElement('ul');
    followList.forEach(elem => {
        let listElem = document.createElement('li');
        listElem.innerHTML = elem['Username'];
        usersList.appendChild(listElem);

        // event listener
        listElem.addEventListener('click', function () {
            let modal = document.getElementById('modal-new-chat');
            modal.style.display = "none";

            // set new space
            createEmptyChat(elem['IdUser']);
        });
    });
    modalBody.appendChild(usersList);
}

function createModalSpace(parent, id, title) {
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
                printFollowUser(modalBody, followList);
            }
        },
    });

    return divModal;
}

document.addEventListener('DOMContentLoaded', function () {
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
        let chatModal = createModalSpace(document.body, 'modal-new-chat', "New Chat");
        document.body.appendChild(chatModal);
    });
});