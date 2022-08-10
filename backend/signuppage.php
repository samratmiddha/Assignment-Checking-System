<?php
session_start();
require_once('./reviewer.php');
require_once('./student.php');
require('../backend/setconnection.php');
session_unset();
$sql3=$conn->prepare("INSERT INTO loginhistory (sessionid,username) VALUES (?,?);");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = test_input($_POST["name"]);
    $branch = test_input($_POST["branch"]);
    $username= test_input($_POST["username"]);
    $password = test_input($_POST["password"]);
    $role = test_input($_POST["role"]);
    $sql3=$conn->prepare("INSERT INTO loginhistory (sessionid,username) VALUES (?,?);");
    $sql3->bind_param("ss",session_id(),$username);
    $sql3->execute();
    setcookie("tag", session_id(), time() + 30 * 24 * 60 * 60,"/");
  }
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
if($_POST["role"]==0){
    $newreviewer= new Reviewer($name,$branch,$username,$password,$role);
    $_SESSION['user']=serialize($newreviewer);
}
else {
 $newstudent= new Student($name,$branch,$username,$password,$role);
 $_SESSION['user']=serialize($newstudent);
}
$_SESSION['error']="sign up succesfull login in to your dashboard";
header('Location: ../frontend/login_page.php');
?>