<?php
session_start();
require('../backend/reviewer.php');
$user=unserialize($_SESSION['user']);
$username=test_input($_POST['susername']);
$assignmentid=test_input($_POST['aid']);

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

$suggestions=test_input($_POST['suggestions']);
if(isset($_POST['markasdone'])){
    $isapproved='1';
}
else{
    $isapproved='0';
}
$user->reviewassignment($username,$assignmentid,$isapproved,$suggestions);
header('Location: ../frontend/reviewerdashboard.php');
?>