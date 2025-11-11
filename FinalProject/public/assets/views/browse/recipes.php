
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="./assets/js/recipes.js"></script>
    
    <title>Recipe Reservoir</title>
    <!-- Bootstrap CSS -->
    <link href="./assets/styles/recipes.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Recipe Reservoir</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="/">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="/contacts">Contacts</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Browse Recipes</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="/recipes">Recipes</a></li>
                            <li><a class="dropdown-item" href="/favorites">Favorites</a></li>
                         
                            <li><a class="dropdown-item" href="/newRecipes">Add New Recipes</a></li>
                        </ul>
                    </li>
                   
                 <li class="nav-item"><a class="nav-link" href="/ingredients">Ingredients</a></li>
                           
                    
                    <li class="nav-item"><a class="nav-link" href="/sharing">Share with Others</a></li>
                </ul>
            </div>
        </div>
    </nav>


    <div id="background-container">
                    <div class="top-back">
<center>
    <h1 id="fin">Find the Right recipe for you. Search the vast collection below</h1>
</center>
    <br>
    <br>
<form class="centered-form">
    <div class="search-container">
    <input  id="sea" type="text"  placeholder="Search recipes">
    </div>

<button id="btn" type="button">SEARCH</button>
</form>
    </div>
<br>
 <div id="bottom-recipe"> 
<h2 id="view" >Click here to view all recipes<h2> 
<button id="browseRecipesBtn" >Browse All recipes</button>
<br>
<br>
<div id="categoriesContainer" > </div>

<br>
<br>

<div id="mealsContainer"></div>

<br>
<br>

<div id="mealDetailsContainer"></div>
<br>

 </div>

</div>
<!--
<center>
<h2>CLick here to save to youur favorites!!!<h2>
    <button>SAVE TO FAVORITES</button>
</center>

-->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>