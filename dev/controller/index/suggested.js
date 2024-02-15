document.addEventListener('DOMContentLoaded', function () {
    $.ajax({
        url: "../model/index/suggestedProfile.php",
        type: "POST",
        success: function (response) {
            console.log(response);
            
        }
    });  
});
