<?php
session_start();

$movieID = $_GET['id'];
$host = "localhost";
$username = "root";
$password = "";
$database = "c203_moviereviewdb";

// open connection
$link = mysqli_connect($host, $username, $password, $database);

// create sql query
$queryMovies = "SELECT *
    FROM movies
    WHERE movieId = $movieID;";

// execute sql query
$resultMovies = mysqli_query($link, $queryMovies);

// close connection
mysqli_close($link);

//process the result
while ($row = mysqli_fetch_array($resultMovies)) {
    $arrResult[] = $row;
    $_SESSION['movieID'] = $row['movieId'];
    $_SESSION['movieTitle'] = $row['movieTitle'];
    $genre = $row['movieGenre'];
    $time = $row['runningTime'];
    $director = $row['director'];
    $cast = $row['cast'];
    $synopsis = $row['synopsis'];
    $pic = $row['picture'];
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
        <meta charset="UTF-8">
        <title>Movie Information</title>
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

        <h2>Movie Information</h2>
                <div class="row">
               
                    <div class="col-4">
                        <img src="picture/<?php echo $pic ?>" alt="<?php echo $title ?>" width="90%" height="90%" style="margin-left: 10%; margin-right: 10%">
                    </div>
                    
                    <div class="col-8">
                        <div class="card" style="margin-left:60px; margin-right: 60px; margin-bottom: 30px">
                            <div class="card-body">
                                <h4 class="card-title"><?php echo $_SESSION['movieTitle']; ?></h4>
                                <p class="card-text">
                                    <b>Movie Genre: </b><?php echo $genre ?> <br>
                                    <b>Running time: </b><?php echo $time ?> <br>
                                    <b>Director: </b><?php echo $director ?> <br>
                                    <b>Cast: </b><?php echo $cast ?> <br><br>
                                    <?php echo $synopsis ?> <br>
                                    
                                </p>
                                <a href="Reviews.php?id=<?php echo $movieID ?>" class="btn btn-primary" style="margin-left: 80%">See Reviews</a>
                            </div>
                        </div>
                    </div>
                </div>
        ?>
    </body>
</html>
