<?php
session_start();
require('./setconnection.php');
require_once('./reviewer.php');
require_once('./student.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username= test_input($_POST["username"]);
    $password = test_input($_POST["password"]);
  }

  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

$sql1="select * from reviewers where username='$username'";
$sql2="select * from students where username='$username'";
$result= $conn->query($sql1);
$result2=$conn->query($sql2);

$sql3=$conn->prepare("INSERT INTO loginhistory (sessionid,username) VALUES (?,?);");

if($result->num_rows==1)
{
  $row=$result->fetch_assoc();
  $test1 = password_verify($password, $row["password"]);
if($test1)
{
$sreviewer= new Reviewer($row["name"],$row["branch"],$row["username"],$row["password"],$row["role"],true);
$_SESSION['user']=serialize($sreviewer);
$sql3->bind_param("ss",session_id(),$username);
$sql3->execute();
setcookie("tag", session_id(), time() + 30 * 24 * 60 * 60,"/");
header('Location: ../frontend/reviewerdashboard.php');

}
else
{
  $_SESSION['error']='incorrect password';
  header('Location: ../frontend/login_page.php');
}
}
else if ($result2->num_rows==1) 
{
  $row=$result2->fetch_assoc();
  $test1 = password_verify($password, $row["password"]);
if($test1)
{
  $sstudent= new Student($row["name"],$row["branch"],$row["username"],$row["password"],$row["role"],true);
  $_SESSION['user']=serialize($sstudent);
  $sql3->bind_param("ss",session_id(),$username);
$sql3->execute();
setcookie("tag", session_id(), time() + 30 * 24 * 60 * 60,"/");


  header('Location: ../frontend/studentdashboard.php');
}
else{
  $_SESSION['error']='incorrect password';
  header('Location: ../frontend/login_page.php');
}

}
else{
  $_SESSION['error']='incorrect username';
  header('Location: ../frontend/login_page.php');
}
?>