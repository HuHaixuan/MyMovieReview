<?php
session_start();
$id = $_SESSION['movieID'];

$host = "localhost";
$username = "root";
$password = "";
$database = "c203_moviereviewdb";
$check = FALSE;

// open connection
$link = mysqli_connect($host, $username, $password, $database);

// create sql query
$queryReviews = "SELECT M.movieId, M.movieTitle, R.reviewId, R.review, R.rating, R.datePosted, U.username, U.userId
    FROM movies M
    INNER JOIN reviews R ON R.movieId = M.movieId
    INNER JOIN users U ON U.userId = R.userId
    WHERE M.movieId = $id;";

$resultReviews = mysqli_query($link, $queryReviews);
$row = mysqli_fetch_array($resultReviews);

if (isset($_SESSION['username'])) {
    $userID = $_SESSION['userID'];
    $queryCheck = "SELECT userId
    From reviews
    WHERE movieId = $id AND userId =$userID;";

    $resultCheck = mysqli_query($link, $queryCheck);
    $rowCheck = mysqli_fetch_array($resultCheck);
}

mysqli_close($link);

if (!empty($row)) {
    $name = $row['username'];
    $comment = $row['review'];
    $movieID = $row['movieId'];
    $reviewId = $row['reviewId'];

    if (!empty($rowCheck['userId'])) {
        $check = TRUE;
    }
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
        <title>Add Review</title>
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
        <?php if (isset($_SESSION['username'])) {
            ?>
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
            <?php if ($check == FALSE) {
                ?>
                <form method="post" action="doAddReview.php">
                    <div class="infoPage">
                        <h2>Add Review for <?php echo $_SESSION['movieTitle'] ?></h2>
                        Username:
                        <input id="idUsername" type="text" name="username" placeholder=<?php echo $_SESSION['username'] ?> class="resizeTextbox" readonly="readonly" style="background-color: gainsboro">
                        <br><br>
                        Comments:
                        <textarea name="comment" placeholder="Enter comment" required=""></textarea>
                        <br><br>
                        Rating:
                        <select name="rating" required style="width:100%">
                            <option value='1'>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5" selected >5</option>
                        </select><br><br>

                        <input type="submit" class="button" value="Add"/>
                    </div>
                </form>
                <?php
            } else {
                ?>
                <br>
                <div class="infoPage">
                    <h2>You have already posted a review</h2>
                    <p class="center"><a href="editReview.php?id=<?php echo $reviewId ?>">Edit</a> review.</p>
                </div>
                <?php
            }
        } else {

            if (!isset($_SESSION['username'])) {
                header("location: login.php"); // auto redirect to login.php
            }
        }
        ?>

    </body>
</html>

