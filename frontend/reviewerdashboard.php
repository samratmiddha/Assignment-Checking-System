<?php
session_start();
if(!isset($_SESSION['user'])){
    header('Location: ./login_page.php');
}
require_once('../backend/reviewer.php');
$user=unserialize($_SESSION['user']);

?>
<html>
    <head>
        <link rel='stylesheet' href='../styles/reviewerdashboard.css'>
        <title>reviewer dashboard</title>
    </head>
    <body>
        <div id="parent-container">
            <div id="student_list">
                <div class='studentlistheading'>
                <h2>Students</h2>
                </div>
                <div class='studentlistblocks'>
                <?php
               $user->showstudentlist();
                ?>
                </div>
            </div>
            <div id="assignments">
                <div id='profile'>
                    <div id='welcomingtext'>
                        <p >Welcome
                            <?php
                            echo $user->name;
                            ?>
                            !
                        </p>
                    </div>
                    <div id='addassignmentbutton'>
                    <button onclick="window.location.href='../frontend/newassignmentpage.php'">newassignment</button>
                    <button onclick="window.location.href='../backend/logout.php'">logout</button>
                    </div>
                </div>
                <div id="assignmentstoreview">
                    <h1>Assignment To Review</h1>
                    <?php
                $user->getassignmenttoreview();
                ?>
                </div>
            </div>
        </div>
    </body>
</html>