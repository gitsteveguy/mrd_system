<?php
// Create connection
$conn = new mysqli('localhost','root','','ironboyi_mrd');

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";
?>