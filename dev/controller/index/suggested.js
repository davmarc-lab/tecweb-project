function getProfileInfo(profileId) {
    let profile = null;
    $.ajax({
        async: false,
        url: "../model/utils/profileInfo.php",
        type: "POST",
        data: {
            id: profileId
        },
        success: function(response) {
            profile = JSON.parse(response);
        }
    });
    return profile;
}

document.addEventListener('DOMContentLoaded', function() {
    let profiles = null;
    $.ajax({
        async: false,
        url: "../model/index/suggestedProfile.php",
        type: "POST",
        success: function(response) {
            profiles = JSON.parse(response);
        }
    });
    if (profiles != null) {
        let suggestedList = document.getElementById('list-profiles');
        for (let i = 0; i < profiles.length; i++) {
            let info = getProfileInfo(profiles[i]['IdUser']);
            let listElem = document.createElement('li');
            let image = document.createElement('img');
            image.classList.add("profile-icon");
            image.setAttribute('src', '../' + info['FilePath']);
            image.setAttribute('alt', info['Username'] + ' profile image');
            let link = document.createElement('a');
            link.setAttribute('href', '../view/profile.html?user=' + info['IdUser']);
            link.innerHTML = '@ ' + info['Username'];
            listElem.appendChild(image);
            listElem.appendChild(link);
            
            suggestedList.appendChild(listElem);
        }
    }
});
