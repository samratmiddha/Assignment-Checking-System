<?php
define("servername", "localhost");
define("dbusername", "root");
define("dbpassword", "Samrat@1234");
define("dbname", "php_assignment");

$conn = new mysqli(servername, dbusername, dbpassword,dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>