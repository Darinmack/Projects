
let currentPage =1;
let ingredientsPerPage =8;

$(document).ready(function () {
    $('#getIngredientsBtn').on('click', function () {
        fetchIngredients();
    });

    $('#loadMoreBtn').on('click', function () {
        currentPage++;
        displayIngredients();
    });

  

    function fetchIngredients() {
        $.ajax({
            url: 'https://www.themealdb.com/api/json/v1/1/list.php?i=list',
            type: 'GET',
            success: function (data) {
                allIngredients = data.meals;
                displayIngredients();
            },
            error: function (xhr, status, error) {
                console.error('Error fetching ingredients:', error);
            }
        });
    }

    function displayIngredients() {
        const startIndex = (currentPage - 1) * ingredientsPerPage;
        const endIndex = startIndex + ingredientsPerPage;
        const currentIngredients = allIngredients.slice(startIndex, endIndex);

        const ingredientsContainer = $('#ingredientsContainer');
        ingredientsContainer.empty();

        const row = $('<div class="row"></div>');
        ingredientsContainer.append(row);

        currentIngredients.forEach(ingredient => {
            const col = $('<div class="col-md-3 mb-3"></div>');

            const card = $('<div class="card"></div>');

            const cardBody = $('<div class="card-body"></div>');

            const img = $('<img class="card-img-top">').attr('src', `https://www.themealdb.com/images/ingredients/${ingredient.strIngredient}.png`).attr('alt', ingredient.strIngredient);

            const title = $('<h5 class="card-title"></h5>').text(ingredient.strIngredient);

            cardBody.append(img);
            cardBody.append(title);
            card.append(cardBody);
            col.append(card);
            row.append(col);
        });

        if (endIndex < allIngredients.length) {
            $('#loadMoreBtn').show();
        } else {
            $('#loadMoreBtn').hide();
        }
    }
});

        document.addEventListener("DOMContentLoaded", function() {
            // Get all navigation links
            var navLinks = document.querySelectorAll('.nav-link');
    
            
            navLinks.forEach(function(link) {
                link.addEventListener('click', function(event) {
                    event.preventDefault(); 
                    var href = this.getAttribute('href'); 
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