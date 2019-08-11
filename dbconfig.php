<?php
$servername = "bankwalah2704.db.11384994.e02.hostedresource.net";
$username = "bankwalah2704";
$password = "MamaToldMe100%";
$dbname = "bankwalah2704";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
	die("<div class=\"alert alert-danger\">Connection failed: " . $conn->connect_error . "</div>");
}
?>