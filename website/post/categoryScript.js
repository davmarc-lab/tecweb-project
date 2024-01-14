// Add event listener for the input search
$("document").ready(function () {
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
            value.setAttribute("value", this.getAttribute("value"));

        });
    });

    function createPost() {
        var postForm = document.getElementById("postForm");
        if (postForm.checkValidity()) {
            var postContent = document.getElementById("postContent").value;

            // Get the selected category
            var dropdownItems = document.querySelectorAll('.dropdown-item');
            var selectedCategory = '';

            dropdownItems.forEach(function (item) {
                if (item.classList.contains('active')) {
                    selectedCategory = item.getAttribute('value');
                }
            });

            // Display post content and category
            document.getElementById("postDisplay").innerText = postContent;
            document.getElementById("selectedCategory").innerText = selectedCategory;
        } else {
            alert("Please fill in all the required fields.");
        }
    }

});
