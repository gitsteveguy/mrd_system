<?php
// Create connection
$conn = new mysqli('localhost','root','','new_mrd_database');

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";
?>