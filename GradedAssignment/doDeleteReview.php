<?php
session_start();

$id = $_SESSION['reviewID'];
$msg = "";

$host = "localhost";
$username = "root";
$password = "";
$database = "c203_moviereviewdb";
$_SESSION['reviewID'] = $id;

$movieId = $_SESSION['movieID'];

$link = mysqli_connect($host, $username, $password, $database);
$query = "DELETE FROM reviews
          WHERE reviewId = $id";
$result = mysqli_query($link, $query) or die(mysqli_error($link));

if ($result) {
    $msg = "Review successfully deleted";
}
else {
    $msg = "Review not deleted";
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
        <title>Delete Review</title>
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
        <div class="infoPage">
            <h2><?php echo $msg?></h2>
            <p class="center"><a href="Reviews.php?id=<?php echo $id ?>">Back</a> to Review</p>
        </div>
    </body>
</html>