<?php
session_start();

$id = $_GET['id'];
$host = "localhost";
$username = "root";
$password = "";
$database = "c203_moviereviewdb";
$_SESSION['reviewID'] = $id;

$movieId = $_SESSION['movieID'];
// open connection
$link = mysqli_connect($host, $username, $password, $database);

// create sql query
$queryReviews = "SELECT M.movieId, M.movieTitle, R.reviewId, R.review, R.rating, R.datePosted, U.username, U.userId
    FROM movies M
    INNER JOIN reviews R ON R.movieId = M.movieId
    INNER JOIN users U ON U.userId = R.userId
    WHERE R.reviewId = $id";

// execute sql query
$resultReviews = mysqli_query($link, $queryReviews);

// close connection
mysqli_close($link);

//process the result
$row = mysqli_fetch_array($resultReviews);

if (!empty($row)) {
    $name = $row['username'];
    $comment = $row['review'];
    $movieID = $row['movieId'];
    $rating = $row['rating'];
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
        <title></title>
        <link rel="stylesheet" type="text/css" href="stylesheets/StyleSheet.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            textarea{
                width: 100%;
                height:100px;
            }
        </style>
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
                        <?php if (!isset($_SESSION['username'])) {
                                ?>
                                <a class="nav-link" href="login.php">Login/Register</a>
                                <?php
                            } else {
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

        <form method="post" action="doDeleteReview.php">
            <div class="infoPage">
                <h2>Delete Review</h2>
                <input type="hidden" name="idMovie" value="<?php echo $movieID ?>"/>
                Username:
                <input id="idUsername" type="text" name="username" placeholder="<?php echo $name ?>" class="resizeTextbox" readonly="readonly" >
                <br><br>
                Comments:
                <textarea name="comment" readonly="readonly"><?php echo $comment ?></textarea>
                <br><br>
                Rating:
                <input id="idRating" type="text" name="rating" placeholder="<?php echo $rating ?>" class="resizeTextbox" readonly="readonly">
                <br><br>

                <input type="submit" class="button" value="Delete"/><br>
                <a class="nav-link" href="Reviews.php?id=<?php echo $movieId ?>"><input type="button" class="button" value="Back"/></a>
            </div>
            
        </form>
        

    </body>
</html>
