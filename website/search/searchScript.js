function searchResult() {
    let input = document.getElementById("search-text");
    let key = input.value;
    let items = Array.from(document.getElementsByClassName("dropdown-item active"));
    let filters = [];
    items.forEach(e => filters.push(e.getAttribute("value")));
    $.ajax({
        url: "createArrayRes.php",
        type: "POST",
        data: {
            key: key,
            filters: filters
        },
        success: function(response) {
            location.reload();
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
    document.querySelectorAll(".btn-search").forEach(function (btt) {
        btt.addEventListener("click", function () {
            searchResult();
        });
    });
});