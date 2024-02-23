$("document").ready(function () {

    // Create category script
    let elem = document.getElementById("category-search");

    // Add event listener for the input search
    $(elem).on('input', function () {
        // Filter category list
        let searchTerm = $(this).val().toLowerCase();
        $('.dropdown-item').each(function () {
            let text = $(this).text().toLowerCase();
            $(this).toggle(text.includes(searchTerm));
        });
    });

    // Add event listener to handle dropdown item selection
    let dropdownItems = document.querySelectorAll('.dropdown-item');
    let values = document.getElementById("selected-categories");
    let categoryBadges = document.getElementById("category-badges");
    let i = 0;
    let j = 0;

    dropdownItems.forEach(function (item) {
        item.addEventListener('click', function () {
            this.hidden = true;

            // Set the value of the hidden input
            let selectedValue = String(this.id).split("-").pop();
            values.innerHTML += "<input type='hidden' id='selected-category" + i + "' name='category' />";
            let value = document.getElementById("selected-category" + i);
            value.setAttribute("value", selectedValue);
            i++;

            // Take te badge span
            categoryBadges.innerHTML += 
                "<p class='badge' id='selected-badge" + j  + "'>";
            let categoryDescription = document.getElementById("selected-badge" + j);
            categoryDescription.innerHTML = item.innerHTML;
            j++;
        });
    });

    let resetButton = document.getElementById("reset");
    $(resetButton).on('click', function () {
        categoryBadges.innerHTML = "";
        dropdownItems.forEach(function (item) {
            item.hidden = false;
        });
        location.reload();
    })
});