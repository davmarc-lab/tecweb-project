function searchResult() {
    console.log("Sono lo script js");
    let input = document.getElementById("search-text");
    if (input != null) {
        console.log("Input non è null");
    }
    let key = input.value;
    console.log(key);
    let items = Array.from(document.getElementsByClassName("dropdown-item active"));
    let filters = [];
    items.forEach(e => filters.push(e.getAttribute("value")));
    console.log(filters);
    $.ajax({
        url: "createArrayRes.php",
        type: "POST",
        data: {
            key: key,
            filters: filters
        },
        success: function(response) {
            console.log(response);
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