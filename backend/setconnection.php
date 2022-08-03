<?php
define("servername", "localhost");
define("dbusername", "root");
define("dbpassword", "password");
define("dbname", "databasename");

$conn = new mysqli(servername, dbusername, dbpassword,dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>