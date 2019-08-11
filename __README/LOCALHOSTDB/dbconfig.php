<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bankwalah_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
	die("<div class=\"alert alert-danger\">Connection failed: " . $conn->connect_error . "</div>");
}
?>