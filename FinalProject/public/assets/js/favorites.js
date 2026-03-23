document.addEventListener("DOMContentLoaded", function() {
    // Get all navigation links
    var navLinks = document.querySelectorAll('.nav-link');

    // Add click event listener to each navigation link
    navLinks.forEach(function(link) {
        link.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default link behavior
            var href = this.getAttribute('href'); // Get the value of href attribute
            if (href && href !== '#') {
                window.location.href = href; // Redirect to the specified URL
            }
        });
    });
});

const browseLink = document.getElementById("recipes");
const dropdownMenu = document.querySelector(".dropdown-menu");

browseLink.addEventListener("click", function(event) {
    event.preventDefault(); // Prevent default link behavior
    dropdownMenu.classList.toggle("show"); // Toggle the visibility of the dropdown menu
});
document.addEventListener("click", function(event) {
    const target = event.target;
    if (!target.matches("#recipes") && !dropdownMenu.contains(target)) {
        dropdownMenu.classList.remove("show"); // Hide dropdown menu
    }
});