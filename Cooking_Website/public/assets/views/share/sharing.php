<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="./assets/js/sharing.js"></script>
    <link href="./assets/styles/sharing.css" rel="stylesheet" />
    
    <title>Recipe Reservoir</title>
    <!-- Bootstrap CSS -->
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
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
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Browse Recipes</a>
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


    <h1>Share with Others</h1>
    <div class="container">
        
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <div class="col">
              <div class="card" id="face">
              <img src="./assets/views/share/facebook.png" class="" alt="...">
                <div class="card-body">
                  <h5 class="card-title">Facebook</h5>
                  <p class="card-text">Click below to share on Facebook!!</p>
                  <a href="#" class="card-link">Facebook Link</a>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card" id="insta">
                <img src="./assets/views/share/instagram.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">Instagram</h5>
                  <p class="card-text">Click below to share via Instagram!!</p>
                  <a href="#" class="card-link">Instagram</a>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card" id="twitt">
                <img src="./assets/views/share/twitter.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">Twitter</h5>
                  <p class="card-text">Click below to share on Twitter.</p>
                  <a href="#" class="card-link">Twitter</a>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card"  id="tik">
                <img src="./assets/views/share/tiktok.png"  class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">Tiktok</h5>
                  <p class="card-text">Click below to share you recipes on Tiktok.</p>
                  <a href="#" class="card-link">Tiktok</a>
                </div>
              </div>
            </div>
          </div>
<br>
<br>

          
        
   

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>