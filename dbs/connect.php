<?php
$server_name = "localhost";
// $username = "dev";
$username = "root";
$password = "";
$dbs = "Hostel";
// create connection
$conn = new mysqli($server_name, $username, $password, $dbs);
// check connection
if ($conn->connect_error) {
	echo "Connection Failed<br>" . $conn->connect_error;
}
