<?php
include('../dbs/connect.php');
if (isset($_POST['delete_recovered_bicycle'])){
$id=$_POST['selector'];
$N = count($id);
for($i=0; $i < $N; $i++)
{
	$result = mysqli_query($conn,"DELETE FROM RecoveredBicycle where serial_number='$id[$i]'");
}
header("location: add_recovered_bicycle.php");
exit();
}
?>