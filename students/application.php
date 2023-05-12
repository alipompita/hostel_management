<?php 
	session_start();
	require "../dbs/connect.php";
	$regNo=$_SESSION["user"];
	// CHECK IF THE APPLICATION WINDOW IS ON 
	$today=date("Y-m-d");
	$result=$conn->query("SELECT * FROM ApplicationPeriod") or die($conn->error);
	$row=$result->fetch_assoc();
	// $dueDate=$row["closingDate"];
	$status=$row["status"];
	if($status=="Closed"){
		// send message 
		$dateReceived=date("Y-m-d");
		$tiemReceived=date("h:i:s");
		$conn->query("INSERT INTO Message(reg_no,message,viewed,date_received,time_received,sender) VALUES('$regNo','Sorry application period is not active','0','$dateReceived','$tiemReceived','No Reply')") or die($conn->error);
		echo "<script>alert('Application period is closed')</script>";
		header("refresh: 0; url=dashboard.php");
		exit();
	}
	
	$semester=$yearOfStudy=$msg="";
	if (isset($_POST["submit"])) {
		$semester=$_POST["semester"];
		$yearOfStudy=$_POST["yearOfStudy"];
		if($conn->query("INSERT INTO Application(reg_no,semester,year) VALUES('$regNo','$semester',$yearOfStudy)")){
			//notify the student
			//send message to room mate
			$dateReceived=date("Y-m-d");
			$tiemReceived=date("h:i:s");
			// send message 
			$conn->query("INSERT INTO Message(reg_no,message,viewed,date_received,time_received,sender) VALUES('$regNo','You have successfully applied for Accommodation','0','$dateReceived','$tiemReceived','No Reply')") or die($conn->error);
			echo "<script>
			//var applied=true;
			alert('You have successfully applied for the room');
			
			
			</script>";
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
	<style type="text/css">
		body{
			/*background-image: url("../tempoImage.png");*/
		}
	</style>
</head>
<body onload="disableApplicationForm()">
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
					<center><h2>Accommodation Application Form</h2></center>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3" style="border: solid black red;">
				<!-- MAIN NAVIGATION -->
				<div class="side-nav" style="border: solid black red;">
					<ul> 
					<li><a class="active" href="dashboard.php">Dashboard</a></li>
					  <li><a class="active" href="personalDetails.php">Personal Details</a></li>
					  <li><a href="application.php"><strong>Hostel Application</strong></a></li>
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
				<div class="col-md-6">
					<div class="panel panel-primary">
						<div class="panel-heading"><h3>Please fill this application form</h3></div>
						<div class="panel-body">
							<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
								<p style="color: red;"><?php echo $msg; ?></p>
								<div class="form-group">
									<label>Year of study</label>
									<select name="yearOfStudy" class="form-control" id="yearOfStudy">
										<option value="1">Year 1</option>
										<option value="2">Year 2</option>
										<option value="3">Year 3</option>
										<option value="4">Year 4</option>
										<option value="5">Year 5</option>
									</select>
								</div>
								<div class="form-group">
									<label>Select Semester</label>
									<select name="semester" class="form-control" id="semester">
										<option value="All">Both Semester</option>
										<option value="One">First Semester</option>
										<option value="Two">Second Semester</option>
									</select>
								</div>
								<button class="btn btn-primary" name="submit" id="submit" >Submit</button>
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