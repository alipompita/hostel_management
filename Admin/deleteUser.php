<?php
require "../dbs/connect.php";
if (isset($_GET["delete"])) {
	$id=$_GET["id"];
	if ($conn->query("DELETE FROM Users WHERE id='$id'")) {
		echo "<script>alert('User Deleted')";
		header("location:users.php");
		exit();
	}
	else{
		echo "<script>alert('Failed to delete the user')";
	}
}
?>