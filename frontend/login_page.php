<?php
session_start();
?>
<html>
    <head>
        <link rel="stylesheet" href="../styles/login_page.css">
    </head>
    <body>
        <div id="parent-container">
        <div id="img-container">
            <center>
            <img src='../assets/assignment_512.png'>
            </center>
        </div>
        <div id="form-box-container">
            <div id="form-heading">
<h2>Login</h2>
            </div>
            <div id="formbox">
            <form action="../backend/loginpage.php" method="POST">
                <label for="username">Username :</label>
                <input type="text" name="username" id="username">
                <br>
                <label for="password">Password :</label>
                <input type="password" name="password" id="password">
                <br>
                <input type ="submit" value="Login">
            </form>
           
           
            </div>
            <div id="signinlink">
                <p id="DHA">Don't have a account?
                <a href="./signup_page.php" target="_self">Sign in</a></p>
            </div>
            <div id='error-box'>
                <p class='error1'>
            <?php
            if(isset($_SESSION['error'])){
            echo $_SESSION['error'];
            }
            ?>
            </p>
            </div>
        </div>
        </div>
    </body>
</html>