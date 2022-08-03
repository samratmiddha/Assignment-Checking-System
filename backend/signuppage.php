<?php
session_start();
require_once('./reviewer.php');
require_once('./student.php');
session_unset();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = test_input($_POST["name"]);
    $branch = test_input($_POST["branch"]);
    $username= test_input($_POST["username"]);
    $password = test_input($_POST["password"]);
    $role = test_input($_POST["role"]);
  }
echo $_POST["role"];
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