<?php
session_start();
if(!isset($_SESSION['user'])){
    header('Location: ./login_page.php');
}
require_once('../backend/reviewer.php');

$user=unserialize($_SESSION['user']);

$rusername=$user->username;
$susername=$_POST['studentusername'];
$assignmentid=$_POST['assignmentid'];


?>
<html>
    <head>
        <title>iteration</title>
        <link rel='stylesheet' href='../styles/iterationpage.css'>
    </head>
    <body>
<div id="parent-container">
<div id="left-part">
    <div id="submission">
        <p class='linkheading'>Submitted link : </p>
        <p class='link'>
            
            <?php
            echo $_POST['link'];
            ?>
</p>
    </div>
    <div id="assignment">
    <?php
$user->getassignmentinfo($assignmentid);
    ?>
    </div>
</div>
<div id="right-part">
<div id="suggestiondiv">
    <h2>Comments</h2>
    <?php
         $user->getcomments($assignmentid,$susername);
          ?>
   
</div>
<div id="iterate">
   <h2>ITERATE</h2>
        <?php

        echo "
        <textarea id='suggestions' name='suggestions' form='iterateinput' placeholder='enter your comments here'></textarea><br><br>
        <form method='POST' id='iterateinput' action='../backend/iterate.php'>
        <input type='hidden' name='aid' value='$assignmentid'>
        <input type='hidden' name='susername' value='$susername'>
        <input type='checkbox'  id='markasdone' name='markasdone' value='1'>
        <label for='markasdone'>Mark as done</label><br><br>
        <div id='button-container'>
        <input type='submit' value='iterate'>
        </div>
        </form>"
        ;

       
        ?>

</div>
</div>
</div>
    </body>

</html>