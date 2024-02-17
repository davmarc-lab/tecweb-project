document.addEventListener("DOMContentLoaded", function () {
    let categoriesMenu = document.getElementById("categories-menu");
    $.ajax({
        async: false,
        url: '../model/newPost/getCategories.php',
        type: 'GET',
        dataType: 'json',
        success: function (categories) {
            categories.forEach(function (category) {
                let tmpA = document.createElement("a");
                tmpA.classList.add('dropdown-item', 'btn-primary', 'rounded', 'my-1');
                tmpA.setAttribute("role", "button");
                let categoryId = category.IdCategory;
                tmpA.setAttribute("id", "cat-" + categoryId);
                tmpA.innerHTML = category.Description;
                categoriesMenu.append(tmpA);
            });
        }, 
        error: function (error) {
            console.log(error);
        }
    });
});