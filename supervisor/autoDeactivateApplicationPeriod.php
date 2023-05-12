<?php
	$today=date("Y-m-d");
	$result=$conn->query("SELECT * FROM ApplicationPeriod") or die($conn->error);
	$row=$result->fetch_assoc();
	$dueDate=$row["closingDate"];
	// echo "Today: $today<br>";
	// echo "Due: $dueDate<br>";
	if($today>$dueDate){
		// deactivate
		$conn->query("UPDATE ApplicationPeriod SET status='Closed'") or die("Auto application period deactivation failed".$conn->error);
	}
	// else{
	// 	$conn->query("UPDATE ApplicationPeriod SET status='Open'") or die("Auto application period deactivation failed".$conn->error);
	// }
?>