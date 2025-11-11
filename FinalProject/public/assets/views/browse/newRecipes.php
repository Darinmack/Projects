<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="./assets/js/newRecipes.js"></script>
    <link href="./assets/styles/newRecipes.css" rel="stylesheet" />
    <title>Recipe Reservoir</title>
    <!-- Bootstrap CSS -->
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
                  <!-- <li class="nav-item"><a class="nav-link" href="#">Calender</a></li>-->  
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
    

    <center>
        <h1>Add NEW Recipes HERE</h1>
    </center>

    <br>
    <br>
<div class="containnew">

    <form  id="new-Rep" action="/newRecipes" method="POST">
        <label for="name" class="info">Name of Recipe/Food</label>
        <input class="crit"   id="name" input type="text"  name="name" placeholder="Enter name here">
<br>
<br>
        <label for="category" class="info">Category</label>
        <input class="crit"  id="category"input type="text" name="category" placeholder="Enter type of food here">
<br>
<br>
        <label for="time" class="info">Cooking Time</label>
        <input class="crit" id="time" input type="text" name="time" placeholder="Enter cook time here">
<br>
<br>
        <label for="servingSize" class="info">Serving Size:</label>
        <input class="crit" id="servingSize" input type="text"  name="servingSize" placeholder="Enter serving size here">

        <br>
        <br>

        <label for="ingredients" class="info" >Ingredients:</label>
        <input class="crit" id="ingredients" input type="text" name="ingredients" placeholder="Enter ingredients here">
<br>
<br>

        <label for="instructions" class="info">Instructions: </label> 
        <input class="crit" id="instructions"  input type="text" name="instructions" placeholder="Enter Instructions here">
       
        <br>
        <br>

        <button type="submit" id="new-rep">Submit HERE</button>

    </form>

<br>
<br>
<br>
 <!-- <div id="new-Recipes-Container"> </div>
-->

</div>


    


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>