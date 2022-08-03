<?php
require_once('../backend/reviewer.php');


class assignments{
    public $assignment_name;
    public $assignment_desc;
    public $assignment_id;
    public $assignment_isfor;
    public $assignment_lastdate;
    public $assignment_assigndate;


 function __construct($name,$desc,$isfor,$date)
 {
    $currentdate=date("d-m-Y");
    $this->assignment_assigndate=$currentdate;
    $this->assignment_name=$name;
    $this->assignment_desc=$desc;
    $this->assignment_lastdate=$date;
    $this->assignment_isfor=$isfor;

    require('./setconnection.php');

    $sql =$conn->prepare( "INSERT INTO assignments (assignment_name,assignment_description,deadline,role,assign_date)
    VALUES (?, ?, ?,?,?);");
$sql->bind_param("sssis",$this->assignment_name,$this->assignment_desc,$this->assignment_lastdate,$this->assignment_isfor,$this->assignment_assigndate);

  $sql->execute();
  

    $conn->close();

 }
   
}
    ?>