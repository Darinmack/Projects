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


 



// Wait for the DOM content to load
document.addEventListener('DOMContentLoaded', function() {
    
    const form = document.getElementById('contact-form');
    const collectDataContainer = document.getElementById('collect-data-container');
   // const form = document.querySelector('form');

    // Add an event listener for the form submission
    form.addEventListener('submit', function(event) {
        
        event.preventDefault();

       
        const formData = new FormData(form);

       
        fetch('/contacts', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json()) 
        .then(data => {
           // Append the response data to the container
           const feedbackData = `
                <p><strong>Name:</strong> ${data.name}</p>
                <p><strong>Email:</strong> ${data.email}</p>
                <p><strong>Feedback:</strong> ${data.feedback}</p>
                <hr>
            `;
            collectDataContainer.insertAdjacentHTML('beforeend', feedbackData);

            // Clear the form fields
            form.reset();
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
});

