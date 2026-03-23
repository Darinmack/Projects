/*

// let Meals = 10;

$(document).ready(function () {
    $('#browseRecipesBtn').on('click', function () {
        loadCategories();
    });

    $('#categoryBtn').on('click', '.categoryBtn', function () {
        const categoryName = $(this).text();
        displayMeals(categoryName);
    });
    
    $('#mealName').on('click', '.mealBtn', function () {
        const mealId = $(this).data('meal');
        displayMealName(mealId);
    });

    // Define mealsContainer globally
    const mealsContainer = $('#mealsContainer');


    function loadCategories() {
        $.ajax({
            url: 'https://www.themealdb.com/api/json/v1/1/categories.php',
            type: 'GET',
            success: function (data) {
                const categories = data.categories;
                const categoriesContainer = $('#categoriesContainer');
                categoriesContainer.empty();

                categories.forEach(category => {
                    const categoryName = category.strCategory;
                    const categoryBtn = $('<button></button>').addClass('categoryBtn').text(categoryName);
                    categoriesContainer.append(categoryBtn);
                });
            },
            error: function (xhr, status, error) {
                console.error('Error fetching categories', error);
            }
        });
    }

    function displayMeals(categoryName) {
      //  const mealsContainer = $('#mealsContainer');
        mealsContainer.empty(); // Clear the categories container before displaying new categories
    
        $.ajax({
            url: `https://www.themealdb.com/api/json/v1/1/filter.php?c=${categoryName}`,
            type: 'GET',
            success: function (mealData) {
                const meals = mealData.meals;
               // const mealsContainer = $('<div></div>').addClass('meals-container');
                if (meals) {
                    meals.forEach(meal => {
                        const categoryBtn = $('<button></button>').addClass('categoryBtn').data('meal', meal.idMeal).text(meal.strMeal);
                        mealsContainer.append(categoryBtn);
                    });
                } else {
                    mealsContainer.append('<p>No meals found for this category.</p>');
                }
                categoriesContainer.append(mealsContainer);
            },
            error: function (xhr, status, error) {
                console.error(`Error fetching meals for ${categoryName}`, error);
            }
        });
    }
  

    function displayMealDetails(mealId) {
        const mealDetailsContainer = $('#mealDetailsContainer');
        mealDetailsContainer.empty();

        $.ajax({
            url: 'https://www.themealdb.com/api/json/v1/1/lookup.php?i=' + mealId,
            type: 'GET',
            success: function (data) {
                const meal = data.meals[0];
                if (meal) {
                    const mealDetails = `
                        <h3>${meal.strMeal}</h3>
                        <img src="${meal.strMealThumb}" alt="${meal.strMeal}" />
                        <p>${meal.strInstructions}</p>
                    `;
                    mealDetailsContainer.html(mealDetails);
                } else {
                    mealDetailsContainer.html('<p>Meal details not found.</p>');
                }
            },
            error: function (xhr, status, error) {
                console.error('Error fetching meal details', error);
            }
        });
    }

});

*/

$(document).ready(function () {
    $('#browseRecipesBtn').on('click', function () {
        loadCategories();
    });

    $(document).on('click', '.categoryBtn', function () {
        const categoryName = $(this).text();
        displayMeals(categoryName);
    });


    $(document).on('click', '.mealBtn', function () {
        const mealId = $(this).data('meal');
        displayMealDetails(mealId);
    });

    function loadCategories() {
        $.ajax({
            url: 'https://www.themealdb.com/api/json/v1/1/categories.php',
            type: 'GET',
            success: function (data) {
                const categories = data.categories;
                const categoriesContainer = $('#categoriesContainer');
                categoriesContainer.empty();

                categories.forEach(category => {
                    const categoryName = category.strCategory;
                    const categoryBtn = $('<button></button>').addClass('categoryBtn').text(categoryName);
                    categoriesContainer.append(categoryBtn);
                });
            },
            error: function (xhr, status, error) {
                console.error('Error fetching categories', error);
            }
        });
    }

    function displayMeals(categoryName) {
        const mealsContainer = $('#mealsContainer');
        mealsContainer.empty();

        $.ajax({
            url: `https://www.themealdb.com/api/json/v1/1/filter.php?c=${categoryName}`,
            type: 'GET',
            success: function (mealData) {
                const meals = mealData.meals;

                if (meals) {
                    const limitedMeals = meals.slice(0,15);
                   limitedMeals.forEach(meal => {
                        const mealBtn = $('<button></button>').addClass('mealBtn').data('meal', meal.idMeal).text(meal.strMeal);
                        mealsContainer.append(mealBtn);
                    });
                } else {
                    mealsContainer.append('<p>No meals found for this category.</p>');
                }
            },
            error: function (xhr, status, error) {
                console.error(`Error fetching meals for ${categoryName}`, error);
            }
        });
    }


    function displayMealDetails(mealId) {
        $.ajax({
            url: `https://www.themealdb.com/api/json/v1/1/lookup.php?i=${mealId}`,
            type: 'GET',
            success: function (mealDetails) {
                const meal = mealDetails.meals[0];
                const mealDetailsContainer = $('#mealDetailsContainer');
                mealDetailsContainer.empty();
    
                // Create elements to display meal details
                const mealName = $('<h2></h2>').text(meal.strMeal);
                const mealImage = $('<img>').attr('src', meal.strMealThumb).addClass('meal-image').css('max-width', '300px');
                const instructions = $('<p></p>').text(meal.strInstructions).addClass('meal-instructions').css('padding', '30px');
    
                // Create element to display ingredients
                const ingredientsTitle = $('<h3></h3>').text('Ingredients');
                const ingredientsList = $('<ul></ul>');
    
                // Loop through the ingredients and append them to the list
                for (let i = 1; i <= 20; i++) {
                    const ingredient = meal[`strIngredient${i}`];
                    const measure = meal[`strMeasure${i}`];
                    if (ingredient) {
                        const listItem = $('<li></li>').text(`${measure} ${ingredient}`);
                        ingredientsList.append(listItem);
                    } else {
                        // If there are no more ingredients, exit the loop
                        break;
                    }
                }
    
                // Append all elements to mealDetailsContainer
                mealDetailsContainer.append(mealName, mealImage, instructions, ingredientsTitle, ingredientsList);
            },
            error: function (xhr, status, error) {
                console.error(`Error fetching meal details for ${mealId}`, error);
            }
        });
    }
});



document.addEventListener("DOMContentLoaded", function() {
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
});



document.addEventListener("DOMContentLoaded", function() {
    // Get all navigation links
    var navLinks = document.querySelectorAll('.nav-link');

    // Add click event listener to each navigation link
    navLinks.forEach(function(link) {
        link.addEventListener('click', function(event) {
          //  event.preventDefault(); // Prevent default link behavior
            var href = this.getAttribute('href'); // Get the value of href attribute
            if (href && href !== '#') {
                window.location.href = href; // Redirect to the specified URL
            }
        });
    });
});
