<?php
session_start();
require_once('../backend/reviewer.php');
require_once('../backend/assignments.php');
$user = unserialize($_SESSION['user']);
?>
<html>

<head>
    <title>Create New assignment</title>
    <link rel='stylesheet' href='../styles/newassignment.css'>
</head>

<body>
    <div id='testing'>
        <div id='formnameheading'>
            <h1>Make a new assignment</h1>
            <br>
        </div>
        <form method='POST' action='../backend/createnewassignment.php' id='newassignmentform'>
            <p class='formheadings'>name :</p>
            <input type='text' name='aname' id='aname' placeholder="enter name of assignment"><br><br>
            <p class='formheadings'>assignment deadline in format dd-mm-yy : </p>
            <input type='datetime-local' name='deadline' id='deadline' placeholder="enter last date of submission"><br><br>
            <p class='formheadings'>assignment description :</p><br><br>
            <textarea id='adescription' name='adescription' form='newassignmentform' placeholder="enter the description for assignments"></textarea><br><br>
            <p class='formheadings'>for students :</p><br><br>
            <input type="radio" id="designers" name="isfor" value="1">
            <label for="designers">designers</label><br>
            <input type="radio" id="developers" name="isfor" value="2">
            <label for="developers">developers</label><br>
            <input type="radio" id="both" name="isfor" value="3">
            <label for="both">both</label>
            <div class='button-container'>
                <input type='submit' value='Create'>
            </div>
        </form>

    </div>
</body>

</html>