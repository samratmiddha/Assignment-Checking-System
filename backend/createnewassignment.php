<?php
require_once('../backend/assignments.php');
$name=test_input($_POST['aname']);

$date=test_input($_POST['deadline']);

$desc=test_input($_POST['adescription']);

$isfor=test_input($_POST['isfor']);

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }


$assignment1= new assignments($name,$desc,$isfor,$date);

header('Locataion: ../frontend/reviewerdashboard.php');
