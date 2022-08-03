<?php

class Member
{
public $name;
public $branch;
public $username;
protected $password;
public $role;

 public function __construct($name,$branch,$username,$password,$role){
    $this->name=$name;
    $this->branch=$branch;
    $this->username=$username;
    $this->password= password_hash($password, PASSWORD_DEFAULT);
    $this->role=$role;
 }

 public function getassignmentinfo($assignmentid){
    $sqlforassignmentinfo="select * from assignments 
    where assignment_id='$assignmentid';
    ";
    require('../backend/setconnection.php');
    $result=$conn->query($sqlforassignmentinfo);
    $conn->close();
    $row=$result->fetch_assoc();
    echo "<p id='assignmentname'>".$row['assignment_name']."</p><br><br>";
    echo "<p class='deadlineheading'>Deadline :</p>";
    echo "<p id='deadline'>".$row['deadline']."</p><br>";
    echo"<div id='assignmentdesc'><br><p class='descriptionheading'>Description :</p><br><br>";
    echo $row['assignment_description'];
    echo "</div>";
 }

 public function getcomments($assignmentid,$susername){

$sqlforcomment="select suggestions,reviwedby from iterations where
assignment_id='$assignmentid' and studentusername='$susername' and suggestions is not null;";
require('../backend/setconnection.php');
$result2=$conn->query($sqlforcomment);
$conn->close();
if($result2->num_rows>0){
  while($row2=$result2->fetch_assoc()){
      echo "<p class='cusername'>".$row2['reviwedby']."</p><br><p class='comment'>   ".$row2['suggestions']."</p><br>";
  }
}
 }

}
?>