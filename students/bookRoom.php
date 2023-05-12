<?php 
	session_start();
	if (!isset($_SESSION["user"])) {
		header("location:../index.php");
		exit();
		
	}
	require "../dbs/connect.php";
	$regNo=$_SESSION["user"];
	$hostelId=$_SESSION["hostelId"];
	$roomNumber=$_SESSION["roomId"];
	$roomMateSet=false;
	if(isset($_SESSION["roomMateId"])){
		$roomMate=$_SESSION["roomMateId"];
		$roomMateSet=true;
	}
	$msg="";
	//getting the name of the one booking the room
	$results=$conn->query("SELECT * FROM Student WHERE reg_no='$regNo'") or die($conn->error);
	$row=$results->fetch_assoc();
	$firstname=$row["firstname"];
	$surname=$row["surname"];

	// get hostel name
	$hostelNames=$conn->query("SELECT hostel_name FROM HostelTbl WHERE hostel_id='$hostelId'");
	$hostelName=$hostelNames->fetch_assoc();
	$hostel_name=$hostelName["hostel_name"];

	// getting room name 
	$roomNames=$conn->query("SELECT room_name FROM Room WHERE room_id='$roomNumber'");
	$roomName=$roomNames->fetch_assoc();
	$room_name=$roomName["room_name"];

	// room mate selected
	if (isset($_POST["submit"]) && isset($_SESSION["roomMateId"])) {
		$sql="INSERT INTO RoomBookings(studentId,roomId,hostelId) VALUES('$regNo','$roomNumber','hostelId')";
		if ($conn->query($sql)) {
			//send message to room mate
			$dateReceived=date("Y-m-d");
			$tiemReceived=date("h:i:s");
			//notify room mate
			$conn->query("INSERT INTO Message(reg_no,message,viewed,date_received,time_received,sender) VALUES('$roomMate','$firstname $surname wants to share the same room with you. Hostel Name: $hostel_name, Room Number: $room_name . Click the button below to comfirm. Note that you can comfirm within 24 hours period','0','$dateReceived','$tiemReceived','$regNo')") or die($conn->error);
			// send message 
			$conn->query("INSERT INTO Message(reg_no,message,viewed,date_received,time_received,sender) VALUES('$regNo','You have successfully booked a room','0','$dateReceived','$tiemReceived','No Reply')") or die($conn->error);
			header("location:dashboard.php");
			exit();
		}
		else{
			$msg=$conn->error;
		}
		
	}
	// room mate not selected
	if (isset($_POST["submit"])) {
		$sql="INSERT INTO RoomBookings(studentId,roomId,hostelId) VALUES('$regNo','$roomNumber','hostelId')";
		if ($conn->query($sql)) {
			//send message to room mate
			$dateReceived=date("Y-m-d");
			$tiemReceived=date("h:i:s");
			// send message 
			$conn->query("INSERT INTO Message(reg_no,message,viewed,date_received,time_received,sender) VALUES('$regNo','You have successfully booked a room','0','$dateReceived','$tiemReceived','No Reply')") or die($conn->error);
			header("location:dashboard.php");
			exit();
		}
		else{
			$msg=$conn->error;
		}
		
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Accommodation Application System</title>
	<!-- <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css"> -->
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/style.css">
	<script type="text/javascript" src="../bootstrap/js/jquery.js"></script>
	<script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../assets/js/jquery.dataTables.js"></script>
  	<script type="text/javascript" src="../assets/js/dataTables.bootstrap.js"></script>
	<style type="text/css">
		body{
			/*background-image: url("../tempoImage.png");*/
		}
	</style>
</head>
<body>
	<main class="container-fluid">
		 <nav class="navbar navbar-inverse" style="width:100%;margin-left: -12px; background-color: #006699;">
		  <div class="container-fluid">
		    <div class="navbar-header">
		      <a class="navbar-brand" href="#" style="color: white;">Hostel Management System</a>
		    </div>
		    <!-- <ul class="nav navbar-nav">
		      <li class="active"><a href="#">Home</a></li>
		      <li><a href="#">Page 1</a></li>
		      <li><a href="#">Page 2</a></li>
		    </ul> -->
		    <ul class="nav navbar-nav navbar-right">
		      <li><a href="students/register.php" style="color: white;"><span class="glyphicon glyphicon-user"></span> <?php
		       echo $row["firstname"]. " ".$row["surname"];  ?></a></li>
		      <li><a href="logout.php" style="color: white;"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
		    </ul>
		  </div>
		</nav> 
		<section class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<center><h2>Room Booking Form</h2></center>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3" style="border: solid black red;">
				<!-- MAIN NAVIGATION -->
				<div class="side-nav" style="border: solid black red;">
					<ul>
					<li><a class="active" href="dashboard.php">Dashboard</a></li>
					  <li><a  href="personalDetails.php"><strong>Personal Details</strong></a>
					  	<!-- <ul class="multi-level">
					  		<li><a>Personal Details</a></li>
					  		<li><a>Home of origin</li>
					  	</ul> -->
					  </li>
					  <li><a href="application.php">Hostel Application</a></li>
					  <li><a href="roomBooking.php" >Room Booking</a></li>
					  <li><a href="messages.php">Messages					  	
					  	<?php
					  		$unreadMessages=$conn->query("SELECT COUNT(message) AS noOfUnreadMessages FROM Message WHERE reg_no='$regNo' AND viewed='0'") or die("Messages Could not be viewd<br>".$conn->error);
					  		if (($unreadMessages->num_rows)>=1) {
					  			$unreadMessage=$unreadMessages->fetch_assoc();
					  			echo "<span class='badge' id='note'>".$unreadMessage["noOfUnreadMessages"]."</span>";
					  		}
					  		else{
					  			echo "<script>
					  			document.getElementById('note').style.display='none';
					  			</script>";
					  		}

					  		

					  	 ?>
					  </a></li>
					</ul>
				</div>
				<!-- MAIN NAVIGATION ENDS HERE -->
				</div>
				<br>
				<div class="col-md-8">
					<div class="panel panel-warning">
						
					</div>
					<div class="panel panel-primary">
						<div class="panel-heading"><h3><center>Confirm Room Booking</center></h3></div>
						<div class="panel-body">
							<form class="form-group" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
								<p style="color:red;"><?php echo $msg; ?></p>
								<table class="table table-bordered">
									<tr>
										<td>Your Fullname</td>
										<td><?php 
										// $names=$conn->query("SELECT firstname,surname FROM Student WHERE reg_no='$regNo'");
										// $name=$names->fetch_assoc();
										echo $firstname." ".$surname; 
										?></td>
									</tr>
									<tr>
										<td>Hostel Name</td>
										<td><?php 
										echo $hostel_name; 
										?></td>
									</tr>
									<tr>
										<td>Room Number</td>
										<td><?php 
										echo $room_name;
										?></td>
									</tr>
									<tr>
										<td>Room Mate</td>
										 <td><?php 
										 	if ($roomMateSet==true) {
										 		$names=$conn->query("SELECT firstname,surname FROM Student WHERE reg_no='$roomMate'");
												$name=$names->fetch_assoc();
												echo $name["firstname"]." ".$name["surname"];
										 	}
										 	else
										 		echo "No room mate selected";
										  ?></td>
									</tr>
								</table>
								<div class="form-group">
									<input onclick ="enableComfirm()" type="checkbox" id="comfirmc" > I agree to terms and conditions <a href="termsAndConditions.php">terms and condtions</a>
								</div>
								<button class="btn btn-primary btn-lg" name="submit" id="comfirm" >Submit</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>
	</main>
	<script type="text/javascript" src="../assets/js/custom.js"></script>
</body>
</html>