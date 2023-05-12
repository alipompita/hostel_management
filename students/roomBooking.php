<?php 
	session_start();
	require "../dbs/connect.php";
	$regNo=$_SESSION["user"];
	// CHECK IF THE Room Booking WINDOW IS ON 
	$today=date("Y-m-d");
	$result=$conn->query("SELECT * FROM RoomBookingPeriod") or die($conn->error);
	$row=$result->fetch_assoc();
	$status=$row["status"];
	$openingDate=$row["openingDate"];
	// get the application year
	$years=$conn->query("SELECT year FROM Application WHERE reg_no='$regNo'") or die("Failed to get year of application");
	$year=$years->fetch_assoc();
	$y=$year["year"];
	if ($today==$openingDate && $y<5) {
		// send message 
		$dateReceived=date("Y-m-d");
		$tiemReceived=date("h:i:s");
		$conn->query("INSERT INTO Message(reg_no,message,viewed,date_received,time_received,sender) VALUES('$regNo','Sorry you cant book room today. Its for galantas','0','$dateReceived','$tiemReceived','No Reply')") or die($conn->error);
		echo "<script>alert('Sorry You can't book the room today its for galantas only)</script>";
		header("refresh: 0; url=dashboard.php");
		exit();
	}
	// increase the date by 1
	$openingDate=date('Y-m-d',strtotime("$visitingDate +1 day"));
	if ($today==$openingDate && $y<4) {
		// send message 
		$dateReceived=date("Y-m-d");
		$tiemReceived=date("h:i:s");
		$conn->query("INSERT INTO Message(reg_no,message,viewed,date_received,time_received,sender) VALUES('$regNo','Sorry you cant book room today. Its for galantas ndi finale','0','$dateReceived','$tiemReceived','No Reply')") or die($conn->error);
		echo "<script>alert('Sorry You can't book the room today its for galantas only)</script>";
		header("refresh: 0; url=dashboard.php");
		exit();
	}
// increase the date by 1
	$openingDate=date('Y-m-d',strtotime("$visitingDate +2 day"));
	if ($today==$openingDate && $y<3) {
		// send message 
		$dateReceived=date("Y-m-d");
		$tiemReceived=date("h:i:s");
		$conn->query("INSERT INTO Message(reg_no,message,viewed,date_received,time_received,sender) VALUES('$regNo','Sorry you cant book room today. Its for galantas,finales ndi associate','0','$dateReceived','$tiemReceived','No Reply')") or die($conn->error);
		echo "<script>alert('Sorry You can't book the room today its for galantas only)</script>";
		header("refresh: 0; url=dashboard.php");
		exit();
	}

	if($status=="Closed"){
		// send message 
		$dateReceived=date("Y-m-d");
		$tiemReceived=date("h:i:s");
		$conn->query("INSERT INTO Message(reg_no,message,viewed,date_received,time_received,sender) VALUES('$regNo','Sorry room booking period is not active','0','$dateReceived','$tiemReceived','No Reply')") or die($conn->error);
		echo "<script>alert('Room Booking period is closed')</script>";
		header("refresh: 0; url=dashboard.php");
		exit();
	}
	// CHECK IF THE STUDENT HAS BEEN ALLOCATED ROOM 
	$students=$conn->query("SELECT * FROM Allocated WHERE reg_no='$regNo'") or die("Checking student status faild".$conn->error);
	if ($students->num_rows==0) {
		// send message 
		$dateReceived=date("Y-m-d");
		$tiemReceived=date("h:i:s");
		$conn->query("INSERT INTO Message(reg_no,message,viewed,date_received,time_received,sender) VALUES('$regNo','You have not been given a room, therefore you cannot book any room','0','$dateReceived','$tiemReceived','No Reply')") or die($conn->error);
		echo "<script>alert('Not allocated space')</script>";
		header("location:dashboard.php");
		exit();
	}
	$hostel=$msg="";
	if (isset($_POST["next"])) {
		$hostel=trim($_POST["hostel"]);
		$_SESSION["hostelId"]=$hostel;
		header("location:selectRoom.php");
		exit();
		
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
		      $user=$_SESSION["user"];
		      $results=$conn->query("SELECT * FROM Student WHERE reg_no='$user'") or die($conn->error);
		      $row=$results->fetch_assoc();
		       echo $row["firstname"]. " ".$row["surname"];  ?></a></li>
		      <li><a href="../common/logout.php" style="color: white;"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
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
						<div class="panel-heading"><h3>Room Booking</h3></div>
						<div class="panel-body">
							<form class="form-group" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
								<p style="color:red;"><?php echo $msg; ?></p>
								<div class="form-group">
									<h3>Step 1: Hostel Selection</h3>
									<select class="form-control" name="hostel" style="font-size: 14pt;">
										<option>Select Hostel</option>
										<?php
											$hostels=$conn->query("SELECT * FROM HostelTbl") or die("Hostel data not found".$conn->error);
											while ($hostel=$hostels->fetch_assoc()) {
												?>
												<option value="<?php echo $hostel['hostel_id']; ?>"><?php echo $hostel["hostel_name"]; ?></option>
												<?php
											}
										?>
									</select>
								</div>
								<button class="btn btn-primary btn-lg" name="next">Next</button>
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