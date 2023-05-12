<?php
	$today=date("Y-m-d");
	$result=$conn->query("SELECT * FROM RoomBookingPeriod") or die($conn->error);
	$row=$result->fetch_assoc();
	$dueDate=$row["closingDate"];
	// echo "Today: $today<br>";
	// echo "Due: $dueDate<br>";
	if($today>$dueDate){
		// deactivate
		$conn->query("UPDATE RoomBookingPeriod SET status='Closed'") or die("Auto room booking period deactivation failed".$conn->error);
	}
	// else{
	// 	$conn->query("UPDATE RoomBookingPeriod SET status='Open'") or die("Auto room booking period deactivation failed".$conn->error);
	// }
?>