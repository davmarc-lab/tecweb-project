function searchResult() {
    let input = document.getElementById("search-text");
    let key = input.value;
    let items = Array.from(document.getElementsByClassName("dropdown-item active"));
    let filters = [];
    items.forEach(e => filters.push(String(e.id).split("-").pop()));
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
    document.getElementById("btn-search").addEventListener("click", function (){
        searchResult();
    });
});