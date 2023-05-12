<?php 
	session_start();
	require "../dbs/connect.php";
	$regNo=$_SESSION["user"];
	if (isset($_POST["activate"])) {
		$openingDate=$_POST["openingDate"];
		$closingDate=$_POST["closingDate"];
		if($conn->query("UPDATE ApplicationPeriod SET status='Open', openingDate='$openingDate', closingDate='$closingDate'")){
			echo "<script>alert('Application Window Activated')</script>";
		}
		else{
			die($conn->error);
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
		      $user=$_SESSION["user"];
		      $results=$conn->query("SELECT * FROM Student WHERE reg_no='$user'") or die($conn->error);
		      $row=$results->fetch_assoc();
		       echo $row["firstname"]. " ".$row["surname"];  ?></a></li>
		      <li><a href="../common/logout.php" style="color: white;"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
		    </ul>
		  </div>
		</nav> 
		<section class="container-fluid">
			<!-- <div class="row">
				<div class="col-md-12">
					
				</div>
			</div> -->
			<div class="row">
				<div class="col-md-3" style="border: solid black red;">
				<!-- MAIN NAVIGATION -->
				<div class="side-nav" style="border: solid black red;">
					<ul>
					<li><a class="active" href="dashboard.php">Dashboard</a></li>
					<li><a class="active" href="applicationList.php">Application List</a></li>
					  <li><a class="active" href="allocatedList.php">Allocated List</a></li>
					  <li><a href="roomBooking.php">Room Bookings</a></li>
					  <li><a href="applicationWindow.php" ><strong>Application Window</strong></a></li>
					   <li><a href="roomBookingWindow.php" >Room Bookings Window</a></li>
					  <li><a href="messages.php"><strong>Messages
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
					  </strong></a></li>
					</ul>
				</div>
				<!-- MAIN NAVIGATION ENDS HERE -->
				</div>
				<div class="col-md-9">
					<br>
					<div class="panel panel-danger">
						<div class="panel-heading"><h3>Activate Application Window</h3></div>
						<div class="panel-body">
							<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
								<div class="form-group">
									<label>From</label>
									<input type="date" name="openingDate" class="form-control">
								</div>
								<div class="form-group">
									<label>To</label>
									<input type="date" name="closingDate" class="form-control">
								</div>
								<br>
								<button name="activate" value="Activate" class="btn btn-danger btn-lg">Activate</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>
	</main>
	<script>
		$(document).ready(function(){
			$("#myTable").DataTable();
		});
	</script>
</body>
</html>