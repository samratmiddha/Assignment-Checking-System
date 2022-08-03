<?php
session_start();
if(!isset($_SESSION['user'])){
    header('Location: ./login_page.php');
}
require_once("../backend/student.php")
?>
<html>
    <head>
        <link rel='stylesheet' href='../styles/studentdashboard.css'>
        <title>student dashboard</title>
    </head>
    <body>
        <div id="parent_container">
        <div id="profile">
        <?php
        $user=unserialize($_SESSION['user']);
       $user->showprofile();
       
         ?>
         <div id='logout-button-container'>
         <button  id='logout-button' onclick="window.location.href='../backend/logout.php'">Logout</button>
         </div>
        </div>
        <div id="assignments">
        <div id="pendingassignments">
            <h1>Pending Assignments</h1>
                <?php
                $user->showpendingassignments();
                ?>
            </div>
            <div id="allasssignments">
                <h1>All Assignments</h1>
            <?php
            $user->showassignments();
            ?>
            </div>
          
        </div>
        </div>
        
    </body>
</html>