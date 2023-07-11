<?php
$servername = "localhost";
$username = "";
$password = "";

// Create connection
$db = new mysqli('localhost', 'root', '', 'package_title');

// Check connection
if ($db->connect_error) {
  die("Connection failed: " . $db->connect_error);
}
?>