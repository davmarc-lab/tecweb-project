function printAllChats(div, chats) {
    let groups = Array();
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
        async: false,
        url: "../model/message/getChatList.php",
        method: "POST",
        success: function (response) {
            if (response != "") {
                chats = JSON.parse(response);
                printAllChats(listChat, chats);
            }
        },
    });

    // selected chat box
    let userChat = document.getElementById('chat-content');
});