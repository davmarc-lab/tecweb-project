$("document").ready(function () {

    // Take te badge span
    let categoryBadge = document.getElementById("category-badge");
    let categoryDescription = document.getElementById("category-description");

    // Add event listener for the input search
    let elem = document.getElementById("categorySearch");
    $(elem).on('input', function () {
        var searchTerm = $(this).val().toLowerCase();
        $('.dropdown-item').each(function () {
            var text = $(this).text().toLowerCase();
            $(this).toggle(text.includes(searchTerm));
        });
    });

    // Add event listener to handle dropdown item selection
    var dropdownItems = document.querySelectorAll('.dropdown-item');
    dropdownItems.forEach(function (item) {
        item.addEventListener('click', function () {
            // Remove 'active' class from all items
            dropdownItems.forEach(function (item) {
                item.classList.remove('active');
            });

            // Set 'active' class for the clicked item
            this.classList.add('active');
            let value = document.getElementById("selectedCategory");

            // Set the value of the hidden input
            let selectedValue = this.getAttribute("value");
            value.setAttribute("value", selectedValue);

            // Set the badge value
            categoryBadge.classList.remove("d-none");
            categoryDescription.innerHTML = this.innerHTML;
        });
    });
});
