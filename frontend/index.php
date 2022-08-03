<?php
session_start();
require_once('../backend/student.php');
require_once('../backend/reviewer.php');
if(isset($_SESSION['user'])){
    $user1=unserialize($_SESSION['user']);
    print_r($user1);
    echo $user1->role;
   if($user1->role=='0')
header('Location: ../frontend/reviewerdashboard.php');
else{
header('Location: ../frontend/studentdashboard.php');
}
}
else{
    if(isset($_COOKIE['tag'])){
        require('../backend/setconnection.php');
        $sqlforlogindirect="SELECT * FROM loginhistory WHERE sessionid=".$_COOKIE['tag'];
        $result=$conn->query($sqlforlogindirect);
        $row=$result->fetch_assoc();
        $username=$row['username'];
        require('../backend/setconnection.php');
        $sql1="select * from reviewers where username='$username'";
$sql2="select * from students where username='$username'";
$result= $conn->query($sql1);
$result2=$conn->query($sql2);


if($result->num_rows==1)
{
    $row=$result->fetch_assoc();
    $sreviewer= new Reviewer($row["name"],$row["branch"],$row["username"],$row["password"],$row["role"],true);
$_SESSION['user']=serialize($sreviewer);
header('Location: ../frontend/reviewerdashboard.php');
    }
    else{
    $row=$result2->fetch_assoc();
    $sstudent= new Student($row["name"],$row["branch"],$row["username"],$row["password"],$row["role"],true);
    $_SESSION['user']=serialize($sstudent);
    header('Location: ../frontend/studentdashboard.php');
    }
}
else{
    header('Location: ../frontend/login_page.php');
}
}
?>