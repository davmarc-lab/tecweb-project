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
            console.log(profile);
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
        for (let i = 0; i < profiles.length; i++) {
            let info = getProfileInfo(profiles[i]['IdUser']);
        }
    }
});
