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
$queryReviews = "SELECT M.movieId, M.movieTitle,R.reviewId, R.review, R.rating, R.datePosted, U.username, U.userId
    FROM movies M
    INNER JOIN reviews R ON R.movieId = M.movieId
    INNER JOIN users U ON U.userId = R.userId
    WHERE R.movieId = $movieID
    ORDER BY R.datePosted DESC;";


// execute sql query
$resultReviews = mysqli_query($link, $queryReviews);

// close connection
mysqli_close($link);

//process the result
while ($row = mysqli_fetch_array($resultReviews)) {
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
        <meta charset="UTF-8">
        <title>Reviews</title>
        <link rel="stylesheet" type="text/css" href="stylesheets/StyleSheet.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
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

        <h2>Reviews for <?php echo $_SESSION['movieTitle']; ?></h2>

        <p class="center"><a href="addReview.php?id=<?php echo $movieID?>">Add new Review</a></p>

        <?php
        if (!empty($arrResult)){ 
        for ($i = 0; $i < count($arrResult); $i++) {
                ?>
                <div class="card" style="margin-left:10%; margin-right:10%; margin-bottom: 30px">
                    <div class="card-body bg-light text-dark">
                        <h4 class="card-title">
                            <?php echo $arrResult[$i]['username'] ?><p style="float:right">Rating: <?php echo $arrResult[$i]['rating'] ?>
                        </h4>
                        <p class="card-text">
                            <?php echo $arrResult[$i]['review'] ?>
                        <p style="text-align: right;"><?php echo $arrResult[$i]['datePosted'] ?><br>
                            <?php if (isset($_SESSION['username'])){
                            if ($arrResult[$i]['username'] == $_SESSION['username'] ) {?>
                            <a href="editReview.php?id=<?php echo $arrResult[$i]['reviewId']?>"><i class="material-icons">mode_edit</i></a>
                            <a href="deleteReview.php?id=<?php echo $arrResult[$i]['reviewId']?>"><i class="material-icons">delete</i></a>
                            <?php
                            }
                            }
                            ?>
                        </p>
                    </div>
                </div>
                <?php
            }
        }else{}
        ?>
    </tbody>
</table>
<p class="center"><a href="homePage.php">Back</a> to movies list page.</p>

</body>
</html>
