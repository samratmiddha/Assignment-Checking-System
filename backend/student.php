<?php
require_once('../backend/member.php');
require_once('../backend/iterations.php');

class Student extends Member
{

  public  function __construct($name, $branch, $username, $password, $role, $bypass = false)
  {
    parent::__construct($name, $branch, $username, $password, $role);
    if (!$bypass) {
      require('../backend/setconnection.php');

      $sql =$conn->prepare("INSERT INTO students(name,branch,username,password,role) VALUES (?, ?, ?,?,?);");
      $sql->bind_param("ssssi",$this->name,$this->branch,$this->username,$this->password,$this->role);
      $sql->execute();

      $conn->close();
    }
  }
  public function showassignments($bypass=false)
  {
    if(!$bypass){
    $text = '<table cellspacing="0" ><tr><th>Assignment id</th><th>Assignmentname</th><th>Status</th><th>Open Assignment</th></tr>';
    }
    else{
      $text = '<table cellspacing="0" ><tr><th>Assignment id</th><th>Assignmentname</th><th>Status</th></tr>';
    }

    $sqlforshowassignments = "select  assignments.assignment_id,MAX(assignment_name), MAX(case When(studentusername='".$this->username."' and isapproved='1') then '1' else '0' end )as isdone from assignments left join iterations
     on assignments.assignment_id=iterations.assignment_id where (role=".$this->role." or role=3)  group by assignment_id ;
    ";
    require("../backend/setconnection.php");
    $result = $conn->query($sqlforshowassignments);
    $conn->close();
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $text = $text . "<tr><td>" . $row['assignment_id'] . "</td><td>" . $row['MAX(assignment_name)']."</td>";
        if ($row['isdone'] == 1) {
          $text = $text . "<td class='complete'>complete</td>";
        } else {
          $text = $text . "<td class='notcomplete'> not complete</td>";
        }
        if(!$bypass){
        $text = $text . "<td align='center'><form  method=POST action='../frontend/assignmentpage.php'>
      <input  class='viewbutton' type=submit value=\"View\">
      <input type=hidden value=\"" . $row['assignment_id'] . "\" name='aid'>
      </form></td></tr>";
      }
    }
      $text = $text . "</table>";
      echo $text;
    }
  }
  public function showpendingassignments($bypass=false)
  {
    if(!$bypass){
    $text = '<table cellspacing="0"><tr><th>Assignment id</th><th>Assignmentname</th><th>Status</th><th>Open Assignment</th></tr>';
    }
    else{
      $text = '<table cellspacing="0"><tr><th>Assignment id</th><th>Assignmentname</th><th>Status</th></tr>';
    }
    $sqlforpendingassignments = " select * from(select  assignments.assignment_id,MAX(assignment_name), MAX(case When(studentusername='".$this->username."' and isapproved='1') then '1' else '0' end )as isdone from assignments left join 
    iterations on assignments.assignment_id=iterations.assignment_id where (role=".$this->role." or role=3)  group by assignment_id) as t3 where isdone='0';";

    
    require("../backend/setconnection.php");
    $result = $conn->query($sqlforpendingassignments);
    $conn->close();
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $text = $text . "<tr><td>" . $row['assignment_id'] . "</td><td>" . $row['MAX(assignment_name)'];
        if ($row['isdone'] == 1) {
          $text = $text . "<td class='complete'> complete</td>";
        } else {
          $text = $text . "<td class='notcomplete'> not complete</td>";
        }
        if(!$bypass){
        $text = $text . "<td align='center'><form  method=POST action='../frontend/assignmentpage.php'>
      <input class='viewbutton'  type=submit value=\"View\">
      <input type=hidden value=\"" . $row['assignment_id'] . "\" name='aid'>
      </form></td></tr>";
        }
      }
      $text = $text . "</table>";
      echo $text;
    }
  
  }
  public function submititeration($assignment_id, $link)
  {
    $newiteration = new iteration($this->username, $assignment_id, $link);
  }
  public function showprofile(){
    $TEXT="<h1>PROFILE</h1><br><br>
    <h2>Name</h2>
    <h3>$this->name</h3><br>
    <h2>Branch</h2>
    <h3>$this->branch</h3><br>
    <h2>Year</h2>
    <h3>1</h3><br>
    <h2>Role</h2>
    ";
    if($this->role=="1"){ echo $this->name;
        $TEXT=$TEXT."<h3>Designer</h3><br>";
    }
    else{
        $TEXT=$TEXT."<h3>Developer</h3><br>";
    }
    echo $TEXT;
  }
}
