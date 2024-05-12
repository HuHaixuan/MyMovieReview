<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "c203_moviereviewdb";

$link = mysqli_connect($host, $username, $password, $database);

$regName = $_POST['name'];
$regUsername = $_POST['username'];
$regDob = $_POST['dob'];
$regEmail = $_POST['email'];
$regPw = $_POST['password'];
$message = "";
$checkEmail = FALSE;

$query = "INSERT INTO users
          (username, password, name, dob, email) 
          VALUES 
          ('$regUsername', SHA1('$regPw'), '$regName', '$regDob', '$regEmail')";

$queryCheck = "SELECT email FROM users;";

$check = mysqli_query($link, $queryCheck);

while ($row = mysqli_fetch_array($check)) {
    $arrUsername[] = $row;
}

for ($i = 0; $i < count($arrUsername); $i++){
    if ($regUsername == $arrUsername[$i]['username']){
        $message = "The username " . $regUsername ." is already exists.<br>";
        $checkEmail = true;
        break;
    }
}
if ($checkEmail == false){
    $status = mysqli_query($link, $query);
        if ($status) {
            $message = "<p>Your new account has been successfully created. ";
        }else {
            $message = "account creation failed";
        }
    }


mysqli_close($link);
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
        <title>Register</title>
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
                        <a class="nav-link" href="login.php">Login/Register</a>
                        <input class="form-control me-2" type="text" placeholder="Search">
                        <button class="btn btn-primary" type="button">Search</button>
                    </form>
                </div>
            </div>
        </nav>
        
        <br>

        <div class="infoPage">
            <h2><?php echo $message?></h2>
            <p class="center">Go to <a href="login.php">Login</a>.</p>
        </div>
    </body>
</html>
