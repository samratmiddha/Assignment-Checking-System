<?php
require_once('../backend/member.php');

class Reviewer extends Member
{

  public  function __construct($name, $branch, $username, $password, $role, $bypass = false)
  {
    parent::__construct($name, $branch, $username, $password, $role);
    if (!$bypass) {
      require('./setconnection.php');

      $sql =$conn->prepare("INSERT INTO reviewers (name,branch,username,password)
VALUES (?, ?,?,?);");
      $sql->bind_param("ssss",$this->name,$this->branch,$this->username,$this->password);
      $sql->execute();

      $conn->close();
    }
  }
  public function reviewassignment($studentusername, $assignment_id, $isapproved, $suggestions)
  {
    require("../backend/setconnection.php");
    $sql2 =$conn->prepare("update iterations
set isapproved=?,suggestions=?,reviwedby=?
where studentusername='$studentusername' and assignment_id='$assignment_id' and reviwedby is null;");

$sql2->bind_param("iss",$isapproved,$suggestions,$this->username);
    $conn->close();
  }

  public function getassignmenttoreview()
  {
    require('../backend/setconnection.php');
    $sql3 = "select * from iterations where reviwedby is null;";
    $result = $conn->query($sql3);
    $conn->close();
    if ($result->num_rows > 0) {
      $text = "<table><tr><th>assignment id</th><th>studentusernamename</th><th>date of submission</th><th>iterate</th></tr>";
      while ($row = $result->fetch_assoc()) {
        $text = $text . "<tr><td>" . $row['assignment_id'] . "</td><td>" . $row['studentusername'] . "</td><td>" . $row['dateofiteration'] . "</td><td>" . "
    <form method='POST' action='../frontend/iterationpage.php'>
    <input type='hidden' name='studentusername' value='" . $row['studentusername'] . "'>
    <input type='hidden' name='assignmentid' value='" . $row['assignment_id'] . "'>
    <input type='hidden' name='link' value='" . $row['link'] . "'>
    <input  class='iteratebutton' type='submit' value='iterate'>
    </form>
    </td>
    </tr>
    ";
      }
      $text = $text . "</table>";
      echo $text;
    } else {
      echo "nothing to review";
    }
  }

  public function createstudentobject($susername){
    require('../backend/setconnection.php');
    $sqlforstudent="select * from students where username='$susername'";
    $result=$conn->query($sqlforstudent);
    $row=$result->fetch_assoc();
    $current_student = new Student($row['name'],$row['branch'],$row['username'],$row['password'],$row['role'],true);
    return $current_student;
  }


  public function showstudentprofile($susername){
    require('../backend/setconnection.php');
    
    $sqlforstudent="select * from students where username='$susername'";
    $result=$conn->query($sqlforstudent);
    $row=$result->fetch_assoc();
    
    $student=new Student($row['name'],$row['branch'],$row['username'],$row['password'],$row['role'],true);

    $TEXT="<h1>PROFILE</h1><br><br>
      <h2>Name</h2>
      <h3>$student->name</h3><br>
      <h2>Branch</h2>
      <h3>$student->branch</h3><br>
      <h2>Year</h2>
      <h3>1</h3><br>
      <h2>Role</h2>
    ";

    if($student->role=="1"){ 
        $TEXT=$TEXT."<h3>Designer</h3><br>";
    }
    else{
        $TEXT=$TEXT."<h3>Developer</h3><br>";
    }
    echo $TEXT;
  }

  public function showstudentlist(){
    require('../backend/setconnection.php');

    $sqlforstudentlist='select name,username,role,branch from students;';
    $result=$conn->query($sqlforstudentlist);
    while($row=$result->fetch_assoc()){
        $sname=$row['name'];
        $susername=$row['username'];
        $sbranch=$row['branch'];
        if($row['role']==1){
            $srole='designer';
        }
        else{
            $srole='developer';
        }
        echo "
        <div class='student_object' onclick='window.location.href=\"../frontend/studentfromreviewer.php?username=$susername\"'>
        <p class='profile_headings'>name :</p><p class='profile_values'>$sname</p><br>
        <p class='profile_headings'>role :</p><p class='profile_values'> $srole</p><br>
        <p class='profile_headings'>branch :</p><p class='profile_values'> $sbranch</p><br>
        </div>
        ";
    }
  }
}
