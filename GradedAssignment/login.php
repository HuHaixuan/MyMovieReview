<?php
$rememberUsername = "";
$check = "";

if (isset($_COOKIE['rememberUsername'])){
    $rememberUsername = $_COOKIE['rememberUsername'];
    $check = "checked";
}else {
   $rememberUsername = "";
   $check = "";
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
        <title>Login</title>
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
                        <a class="nav-link" href="login.php">Login/Register</a>
                        <input class="form-control me-2" type="text" placeholder="Search">
                        <button class="btn btn-primary" type="button">Search</button>
                    </form>
                </div>
            </div>
        </nav>
        
        <H2>Login</H2>

        <form method="post" action="doLogin.php">
            
            <p class="infoPage">
                <label for="idUsername">Username:</label><br>
                
                <input id="idUsername" type="text" name="username" placeholder="enter username" class="resizeTextbox" value="<?php echo $rememberUsername; ?>" required><br><br>
                <label for="pw">Password:</label><br>
                <input id="pw" type="password" name="password" placeholder="enter password" class="resizeTextbox" required><br><br>
                <input type="checkbox" name="remember" <?php echo $check ?>> Remember Me
                <input type="submit" class="button" value="Login"/>

            </p>
        </form>
        <p class="center"> Not a member yet? <a href="register.html">Register</a> now!</p>
    </body>
</html>
