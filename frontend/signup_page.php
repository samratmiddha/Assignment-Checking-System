<html>
    <head>
        <link rel="stylesheet" href="../styles/signup_page.css">
    </head>
    <body>
        <div id="parent-container">
        <div id="img-container">
        <img src='../assets/assignment_512.png'>
        </div>
        <div id="form-box-container">
            <div id="form-heading">
<h2>Sign up</h2>
            </div>
            <div id="formbox">
            <form action="../backend/signuppage.php" method="post">
                <label for="username">Username: </label>
                <input type="text" name="username" id="username"><br>
                <label for="password">Password: </label>
                <input type="text" name="password" id="password"><br>
                <label for="name">Name:     </label>
                <input type="text" name="name" id="name"><br>
                <label for="branch">Branch:  </label>
                <input type="text" name="branch" id="branch"><br>
                <label for="role">Role: </label>
                <select id="role" name="role">
                    <option value="0">Reviewer</option>
                    <option value="1">Designer</option>
                    <option value="2">Developer</option>
                </select>
<br>
                <input type ="submit" value="Sign Up">
            </form>
            
            </div>
            <div id="signinlink">
                <p id="DHA">Already have a account?
                <a href="./login_page.php" target="_self">Log in</a></p>
            </div>
        </div>
        </div>
    </body>
</html>