$("document").ready(function () {

    // Create category script
    let createButton = document.getElementById("create-ctg-btn");
    let elem = document.getElementById("category-search");

    // Disable create category button at start
    if (typeof elem.value === "string" && elem.value.length === 0) {
        createButton.setAttribute("aria-disabled", true);
        createButton.classList.add("disabled");
    }

    // Take te badge span
    let categoryBadge = document.getElementById("category-badge");
    let categoryDescription = document.getElementById("category-description");

    // Add event listener for the input search
    $(elem).on('input', function () {
        // Enable create button if text not empty
        if (typeof elem.value === "string" && elem.value.length === 0) {
            createButton.setAttribute("aria-disabled", true);
            createButton.classList.add("disabled");
        } else {
            createButton.setAttribute("aria-disabled", false);
            createButton.classList.remove("disabled");
        }

        // Filter category list
        let searchTerm = $(this).val().toLowerCase();
        $('.dropdown-item').each(function () {
            let text = $(this).text().toLowerCase();
            $(this).toggle(text.includes(searchTerm));
        });
    });

    // Add event listener to handle dropdown item selection
    let dropdownItems = document.querySelectorAll('.dropdown-item');
    let value = document.getElementById("selected-category");

    dropdownItems.forEach(function (item) {
        item.addEventListener('click', function () {
            // Remove 'active' class from all items
            dropdownItems.forEach(function (item) {
                item.classList.remove('active');
            });

            // Set 'active' class for the clicked item
            this.classList.add('active');

            // Set the value of the hidden input
            let selectedValue = String(this.id).split("-").pop();
            value.setAttribute("value", selectedValue);

            // Set the badge value
            categoryBadge.classList.remove("d-none");
            categoryDescription.innerHTML = this.innerHTML;
        });
    });

    // Add listener on create category button to upload the new category to the db after clicking post
    $(createButton).on('click', function () {
        $.ajax({
            url: "../model/newPost/createCategory.php",
            type: "POST",
            data: {
                description: elem.value,
            },
            success: function (response) {
                //the category badge now has to be visible
                categoryDescription.innerHTML = elem.value;
                value.setAttribute("id", response);
            }
        });
    });

    // Add listener on reset button to reset the category
    let resetButton = document.getElementById("reset");
    $(resetButton).on('click', function () {
        //the category badge now has to be not visible
        categoryDescription.innerHTML = "";
    })
});
