<?php
require_once("../backend/assignments.php");

class iteration{
    public  $studentusername;
    public  $reviwedby;
    public  $assignment_id;
    public  $isapproved;
    public  $suggestions;
    public  $dateofiteration;
    public  $link;

    public function __construct($username,$assignment_id,$link){
        $this->studentusername=$username;
        $this->assignment_id=$assignment_id;
        $this->dateofiteration=date('d-m-y');
        $this->link=$link;

        require("./setconnection.php");


        $sql =$conn->prepare("INSERT INTO iterations (studentusername,assignment_id,dateofiteration,link)
        VALUES (?,?,?,?);");
        $sql->bind_param("siss",$this->studentusername,$this->assignment_id,$this->dateofiteration,$this->link);
       $sql->execute();

        $conn->close();
    
    }

}
