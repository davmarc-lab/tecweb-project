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
        pMsg.innerHTML = elem['Content'];
        div.appendChild(pMsg);
    });
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
});