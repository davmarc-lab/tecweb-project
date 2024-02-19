function searchResult() {
    let input = document.getElementById("search-text");
    let key = input.value;
    let items = Array.from(document.getElementsByClassName("dropdown-item active"));
    let filters = [];
    items.forEach(e => filters.push(String(e.id).split("-").pop()));
    $.ajax({
        url: "../model/search/createArrayRes.php",
        type: "POST",
        data: {
            key: key,
            filters: filters
        },
        success: function(response) {
            document.getElementById("random-post-container").innerHTML = "";
            document.getElementById("search-post-container").innerHTML = "";
            printPostToTarget(document.getElementById("search-post-container"), response);
        }
    });
}

let input = document.getElementById("search-text");
input.addEventListener('keyup', (e) => {
    if (e.keyCode === 13) {
        searchResult();
    }
});

document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("search-button").addEventListener("click", function (){
        searchResult();
    });
});