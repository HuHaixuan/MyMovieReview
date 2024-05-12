<?php
session_start();

$host = "localhost";
$username = "root";
$password = "";
$database = "c203_moviereviewdb";

// open connection
$link = mysqli_connect($host, $username, $password, $database);

// create sql query
$queryMovies = "SELECT movieId, movieTitle, movieGenre, picture
    FROM movies;";

// execute sql query
$resultMovies = mysqli_query($link, $queryMovies);

// close connection
mysqli_close($link);

//process the result
while ($row = mysqli_fetch_array($resultMovies)) {
    $arrResult[] = $row;
}
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Movies</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="stylesheets/StyleSheet.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="HomePage.php">Movie Review</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="mynavbar">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="HomePage.php">Movies</a>
                        </li>
                    </ul>
                    <form class="d-flex">
                        <?php if (!isset($_SESSION['username'])){
                        ?>
                        <a class="nav-link" href="login.php">Login/Register</a>
                        <?php
                        }else {
                            ?>
                        <a class="nav-link" href="logout.php">Logout</a>
                        <?php
                        }
                        ?>
                        <input class="form-control me-2" type="text" placeholder="Search">
                        <button class="btn btn-primary" type="button">Search</button>
                    </form>
                </div>
            </div>
        </nav>

        <br>

        <h2>List of Movies</h2>


        <div class="row">
        <?php
        for ($i = 0; $i < count($arrResult); $i++) {
            $id = $arrResult[$i]['movieId'];
        ?>

            <div class="col-4">
                <div class="card" style="width:280px; height:580px; margin-left:60px; margin-right: 60px; margin-bottom: 30px">
                    <img class="card-img-top" src="picture/<?php echo $arrResult[$i]['picture']?>" alt="<?php echo $arrResult[$i]['movieTitle']?>">
                    <div class="card-body">
                        <h4 class="card-title"><?php echo $arrResult[$i]['movieTitle']?></h4>
                        <p class="card-text"><?php echo $arrResult[$i]['movieGenre']?></p>
                        <a href="movieInfo.php?id=<?php echo $id?>" class="btn btn-primary">See More</a>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
        </div>

    </body>
</html>