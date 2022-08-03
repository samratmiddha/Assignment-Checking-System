<?php
session_start();
require_once('../backend/student.php');
require_once('../backend/iterations.php');
$user=unserialize($_SESSION['user']);
$username=$user->username;
$assignmentid=$_POST['aid'];


?>
<html>
    <head>
        <title>assignment</title>
        <link rel='stylesheet' href='../styles/assignmentpage.css'>
    </head>
    <body>
        <div id="child-container2">
            <div id="assignment">
                <div id="assignment-info">
                    <?php
                    $user->getassignmentinfo($assignmentid);
                  ?>
                </div>
                  <div id="submit-assignment">
                    <form method=POST action="../backend/submitassignment.php">
                        <input type="text" name="assignment-link" placeholder="enter your assignment link here">
                        <?php
                        echo "<input type='hidden' name='aid' value='$assignmentid'>"
                        ?>
                        <input type='submit' value='Submit'>
                    </form>
                </div>
            </div>
            <div id="comments">
                
                <h1>Comments</h1>
<hr>
                <?php
        $user->getcomments($assignmentid,$username);
          ?>
            </div>
        </div>
    </body>
</html>