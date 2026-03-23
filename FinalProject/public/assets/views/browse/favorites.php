
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="./assets/js/favorites.js"></script>
    <link href="./assets/styles/favorites.css" rel="stylesheet" />
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

    <br>
    <br>

    <center> 

        <h2>All your Favorites in one spot!!! </h2>

    </center>

<br>
<br>
<div class="container">
    <div class="row">
<div id="left-col" class="col-2" > 
    <div id="sidebar">
        
    <div class="fav-control">
    
    <h1 id="fav" class="title">Favorites</h1>
    </div>
<br>
<div id="search" role="search">
<form id="sum-search" action="/search/" >

<input type="text" name="search" size="25" placeholder="Search Favorites" class="searchbox" id="name" >
<br>
<br>
<button type="submit" > Search </button>
</form>    
</div>
<br>
<br>
<nav id="menu">
<ul class="nav-leveltwo" id="favorites/types" >

<li id="big"><a href="www.google.com">Big meals</a></li>
<li><a href="www.google.com">Small Meals</a></li>
<li><a href="www.google.com">Snacks</a></li>
<li><a href="www.google.com">Desserts</a></li>
</ul>
</nav>

</div>

    </div>

   
    <div id="right-col" class="col-7">
        <div class="container-2"> 

    <h2 id="add">No Favorites Added Yet</h2>
    <br>
    <br>
    
</div>
</div>




</div>
</div>
    


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>