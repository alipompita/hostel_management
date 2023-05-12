<?php
require "../dbs/connect.php";
function getHostelName($value='')
{
	# code...
}
function getFirstname($regNo){
	require "../dbs/connect.php";
	$fname="";
	$results=$conn->query("SELECT firstname FROM Student WHERE reg_no='$regNo'") or die($conn->error);
	$row=$results->fetch_assoc();
	$fname=$row["firstname"];
	$conn->close();
	return $fname;
}
function getSurname($regNo){
	require "../dbs/connect.php";
	$sname="";
	$results=$conn->query("SELECT surname FROM Student WHERE reg_no='$regNo'") or die($conn->error);
	$row=$results->fetch_assoc();
	$sname=$row["surname"];
	$conn->close();
	return $sname;
}
?>