document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("submit").addEventListener("click", function (event) {
        event.preventDefault();
        let formData = new FormData(document.getElementById("new-post-form"));
        const values = [...formData.entries()];
        console.log(values);
        let category = document.getElementById("selected-badge").innerHTML;
        $.ajax({
            async: false,
            url: '../model/newPost/newPost.php',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                //console.log(response);
                window.location.href = "profile.html";
            }
        });
    });
});