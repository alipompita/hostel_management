<?php 
	session_start();
	require "../dbs/connect.php";
	$regNo=$_SESSION["user"];
	
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
		      $results=$conn->query("SELECT * FROM Users WHERE username='$user'") or die($conn->error);
		      $row=$results->fetch_assoc();
		       echo $row["firstname"]. " ".$row["surname"];  ?></a></li>
		      <li><a href="../common/logout.php" style="color: white;"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
		    </ul>
		  </div>
		</nav> 
		<section class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<center><h2>Admin Dashboard</h2></center>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3" style="border: solid black red;">
				<!-- MAIN NAVIGATION -->
				<div class="side-nav" style="border: solid black red;">
					<ul>
					<li><a class="active" href="dashboard.php"><strong>Dashboard</strong></a></li>
					<li><a href="personalDetails.php">Personal Details</a></li>
					<li><a href="users.php">All Users</a></li>
					<!-- <li><a class="active" href="applicationList.php">Application List</a></li>
					  <li><a class="active" href="selectionList.php">Selection List</a></li>
					  <li><a href="roomBooking.php">Room Bookings</a></li> -->
					  <li><a href="applicationWindow.php" >Application Window</a></li>
					   <li><a href="roomBookingWindow.php" >Room Bookings Window</a></li>
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
				<div class="col-md-9">
					<div class="row" style="height: 100%;">
						<br>
						<div class="col-md-5 btn-warning" style="border-radius: 10px; margin-left: 10px;">
							<center><a href="users.php" style="color: white;text-decoration: none;"><h2><br>All Users</h2>
								<h3 style="color: white;">5</h3></a></center>
						</div>
						<!-- room bookings -->
						<div class="col-md-5 btn-primary" style="border-radius: 10px; margin-left: 10px;">
							<center><a href="" style="color: white;text-decoration: none;"><h2><br>Application Period</h2>
								<h3 style="color: red;" id="status">
									<?php 
										$window=$conn->query("SELECT * FROM ApplicationPeriod") or die($conn->error);
										$period=$window->fetch_assoc();
										if ($period["status"]=="Open") {
											echo "<script>
											document.getElementById('status').innerHTML='Open';
											document.getElementById('status').style.color='lightgreen';
											</script>";
										}
										else{
											echo "<script>
											document.getElementById('status').innerHTML='Closed';
											</script>";
										}
									?></h3></a></center>
						</div>
					</div> 
						<!-- row -->
					<div class="row" style="height: 100%;">
						<br>
						<div class="col-md-5 btn-primary" style="border-radius: 10px; margin-left: 10px;">
							<center><a href="" style="color: white;text-decoration: none;"><h2><br>Room Booking Period</h2>
								<h3 style="color: red;" id="bStatus"><?php 
										$window=$conn->query("SELECT * FROM RoomBookingPeriod") or die($conn->error);
										$period=$window->fetch_assoc();
										if ($period["status"]=="Open") {
											echo "<script>
											document.getElementById('bStatus').innerHTML='Open';
											document.getElementById('bStatus').style.color='lightgreen';
											</script>";
										}
										else{
											echo "<script>
											document.getElementById('bStatus').innerHTML='Closed';
											</script>";
										}
									?></h3></a></center>
						</div>
						<div class="col-md-5 btn-danger" style="border-radius: 10px;margin-left: 10px;">
							<center><a href="messages.php" style="color: white;text-decoration: none;"><h2><br>Messages</h2>
								<h3>
									<?php
									$unreadMessages=$conn->query("SELECT COUNT(message) AS noOfUnreadMessages FROM Message WHERE reg_no='$regNo' AND viewed='0'") or die("Messages Could not be viewd<br>".$conn->error);
					  		if (($unreadMessages->num_rows)>=1) {
					  			$unreadMessage=$unreadMessages->fetch_assoc();

					  			echo "<span class='badge' id='note'>".$unreadMessage["noOfUnreadMessages"]."</span>";
					  		}
					  		?>
								</h3></a></center>
						</div>
						
					</div> 
				</div>
			</div>
		</section>
	</main>
</body>
</html>