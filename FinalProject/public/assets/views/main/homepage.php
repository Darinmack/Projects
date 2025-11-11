
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="./assets/js/homepage.js"></script>
       
    <title> Recipe Reservoir</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <link href="./assets/styles/homepage.css" rel="stylesheet" />

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
                    <li class="nav-item"><a class="nav-link active" aria-current="page" id="home" href="/">Home</a></li>
                  <!-- <li class="nav-item"><a class="nav-link" href="#">Calender</a></li>-->  
                    <li class="nav-item"><a class="nav-link"  href="/contacts">Contacts</a></li>
                 <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle"  href="/recipes" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Browse Recipes</a>
                        <ul class="dropdown-menu" aria-labelledby= "browse" >
                            <li><a class="dropdown-item"  href="/recipes">Recipes</a></li>
                            <li><a class="dropdown-item"  href="/favorites">Favorites</a></li>
                            <li><a class="dropdown-item"  href="/newRecipes">Add New Recipes</a></li>
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
<div id="top-container"> 
    <center>
<h3 class="spaced-out">FIND. COOK.ENJOY. SHARE.</h3>

 
   </center>
<br>
<h3>Here at recipe reservoir, you can browse countless selections of recipes, whether it be food or desserts; from 
    countless regions and cultures, share with others and even add your own!! 
</h3>
</div>

<br>
<br>

<div id="carouselExampleAutoplaying" class="carousel slide p-3 bd-example" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="./assets/views/main/junk.jpg" class="con" class="d-block w-100" alt="Slide 1">
            <div class="carousel-caption">
                <h5>Featured Food #1</h5>
                <p>Meal Name featured here</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="./assets/views/main/burger.jpg" class="con" class="d-block w-100" alt="Slide 2">
            <div class="carousel-caption">
                <h5>Featured Food #2</h5>
                <p>Meal Name featured here</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="./assets/views/main/meal.jpg" class="con" class="d-block w-100" alt="Slide 3">
            <div class="carousel-caption">
                <h5>Featured Food #3</h5>
                <p>Meal Name featured here </p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="./assets/views/main/health.jpg" class="con" class="d-block w-100" alt="Slide 4">
            <div class="carousel-caption">
                <h5>Feautured Food #4</h5>
                <p>Meal Name featured Here</p>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<br>
<br>

<div class="bottom">
    <h2>Collaborate and Connect with like-minded people!</h2>
    <button class="btn-primary" type="button">Click here to share with others</button>
    <br><br>
    <h3>Click here to create and add your own recipes</h3>
    <button class="btn-primary" type="submit">New Recipes</button>
    <br><br>
    <h4>All your favorites in one place</h4>
    <button class="btn-primary" type="submit">See Favorites</button>
</div>

<br>

<br>
<br>


<h1 class="spaced-out">BECOME A FOOD FORAGER TODAY!!!</h1>







    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

