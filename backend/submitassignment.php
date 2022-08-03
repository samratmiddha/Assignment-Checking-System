<?php
session_start();
require_once('../backend/student.php');
require_once('../backend/iterations.php');
$assignmentid=$_POST['aid'];
$user=unserialize($_SESSION['user']);
$username=$user->username;
$assignmentlink=$_POST['assignment-link'];
$assignmentid=$_POST['aid'];

$it= new iteration($username,$assignmentid,$assignmentlink);
?>