<?php
session_start();

$usernameMovie = $_POST['username'];
$pwMovie = $_POST['password'];
$login = false;

$host = "localhost";
$username = "root";
$password = "";
$database = "c203_moviereviewdb";

// open connection
$link = mysqli_connect($host, $username, $password, $database);

// create sql query
$queryUsers = "SELECT *
    FROM users
    WHERE username='$usernameMovie'
    AND password = SHA1('$pwMovie')";

// execute sql query
$resultUsers = mysqli_query($link, $queryUsers) or die(mysqli_error($link));

if (mysqli_num_rows($resultUsers) == 1) 
{
    $row = mysqli_fetch_array($resultUsers);
    $_SESSION['userID'] = $row['userId'];
    $_SESSION['username'] = $row['username'];
    $_SESSION['name'] = $row['name'];
    $_SESSION['dob'] = $row['dob'];
    $_SESSION['email'] = $row['email'];
    $login = TRUE;
    if (isset ($_POST['remember'])){
        setcookie("rememberUsername", $usernameMovie, time()+60*60*24*365*10);
    }else{
        setcookie("rememberUsername", "", time()-3600);
    }
} else {
    $login = FALSE;
}

// close connection
mysqli_close($link);

//process the result

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
    </head>
    <body>
        
        <?php
            if ($login == TRUE) {
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
                        <a class="nav-link" href="logout.php">Logout</a>
                        <input class="form-control me-2" type="text" placeholder="Search">
                        <button class="btn btn-primary" type="button">Search</button>
                    </form>
                </div>
            </div>
        </nav>
        
                <p style="text-align: right">Welcome, <b><?php echo $_SESSION['username'] ?></b></p>

                <h2>Welcome</h2>
                <p class="infoPage">

                    <b>Username:</b> <?php echo $_SESSION['username'] ?><br>
                    <b>Name:</b> <?php echo $_SESSION['name'] ?><br>
                    <b>Date of Birth:</b> <?php echo $_SESSION['dob'] ?><br>
                    <b>Email:</b> <?php echo $_SESSION['email'] ?><br>
                    <br>
                <p class="center">Proceed to view <a href="HomePage.php">Movie</a> list.</p>
            </p>
            <?php
            $login = true;
        } else {
            $login = false;
    }

    if ($login == false) {
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
                        <a class="nav-link" href="login.php">Login/Register</a>
                        <input class="form-control me-2" type="text" placeholder="Search">
                        <button class="btn btn-primary" type="button">Search</button>
                    </form>
                </div>
            </div>
        </nav>
            
        <br>
        <div class="infoPage">
            <h2>Login Failed</h2>
            <p class="center">Wrong username or password!<br>
                <a href="login.php">Login</a> again.</p>
        </div>
        <?php
    }
    ?>
</body>
</html>
