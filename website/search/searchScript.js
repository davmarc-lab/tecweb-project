function searchResult() {
    console.log("Sono lo script js");
    let input = document.getElementById("searchText");
    if (input != null) {
        console.log("Input non è null");
    }
    let key = input.value;
    console.log(key);
    $.ajax({
        url: "createArrayRes.php",
        type: "POST",
        data: {
            key: key
        },
        success: function(response) {
            location.reload();
        }
    });
}

/* var input = document.getElementById("searchText");

// Execute a function when the user presses a key on the keyboard
input.addEventListener("keypress", function(event) {
  // If the user presses the "Enter" key on the keyboard
  if (event.key === "Enter") {
    // Cancel the default action, if needed
    event.preventDefault();
    // Trigger the button element with a click
    document.getElementById("searchButton").click();
  }
});
 */
function handle(e){
    if(e.keyCode === 13){
        e.preventDefault(); // Ensure it is only this code that runs

        alert("Enter was pressed was presses");
    }
}