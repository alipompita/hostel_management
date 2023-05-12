<?php 
	session_start();
	require "../dbs/connect.php";
	if (!isset($_SESSION["user"])) {
		header("location:../index.php");
		exit();
		# code...
	}
	$regNo=$_SESSION["user"];
	$firstname=$maidenName=$msg=$surname=$dob=$gender=$program=$oldRegNo="";
	if (isset($_POST["update"])) {
		$regNo=trim($_POST["regNo"]);
		$oldRegNo=trim($_POST["oldRegNo"]);
		$firstname=trim($_POST["firstname"]);
		$maidenName=trim($_POST["maidenName"]);
		$surname=trim($_POST["surname"]);
		$gender=trim($_POST["gender"]);
		$dob=trim($_POST["dob"]);
		$program=trim($_POST["program"]);
		$sql="UPDATE Student SET reg_no='$regNo', firstname='$firstname', maiden_name='$maidenName', surname='$surname', gender='$gender', dob='$dob', program='$program' WHERE reg_no='$oldRegNo'";
		if ($conn->query($sql)) {
			echo "<script>alert('You have updated your personal details')</script>";
		}
		else{
			$msg="Failed to update personal Details<br>".$conn->error;
		}
	}
	$details=$conn->query("SELECT * FROM Student WHERE reg_no='$regNo'") or die($conn->error);
	$detail=$details->fetch_assoc();
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
					<center><h2>Your Profile</h2></center>
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
					<div class="panel panel-primary">
						<div class="panel-heading"><h3>Your Personal Details</h3></div>
						<div class="panel-body">
							<form class="form-group" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
								<p style="color:red;"><?php echo $msg; ?></p>
								<div class="form-group">
									<label>Reg Number</label>
									<input type="text" name="regNo" placeholder="Reg Number..." class="form-control" required value="<?php echo $detail['reg_no']; ?>">
								</div>
								<input type="text" name="oldRegNo" value="<?php echo $detail['reg_no']; ?>" hidden>
								<div class="form-group">
									<label>Firstname</label>
									<input type="text" name="firstname" placeholder="Firstname..." class="form-control" required value="<?php echo $detail['firstname']; ?>">
								</div>
								<div class="form-group">
									<label>Maiden Name</label>
									<input type="text" name="maidenName" placeholder="Maiden Name..." class="form-control" value="<?php echo $detail['maiden_name']; ?>">
								</div>
								<div class="form-group">
									<label>Surname</label>
									<input type="text" name="surname" placeholder="Surname..." class="form-control" required value="<?php echo $detail['surname']; ?>">
								</div>
								<div class="form-group">
									<label>Gender</label>
									<select class="form-control" name="gender" value="<?php echo $detail['gender']; ?>"><?php 
										$gender=$detail['gender'];
										echo "<option value='$gender'>$gender</option>";
										if($gender=="Male")
											$gender="Female";
										else
											$gender="Male";
										echo "<option value='$gender'>$gender</option>";
										?>
									</select>
								</div>
								<div class="form-group">
									<label>Program of study</label>
									<input type="text" name="program" placeholder="Program of study..." class="form-control" required value="<?php echo $detail['program']; ?>">
								</div>
								<div class="form-group">
									<label>Date of Birth</label>
									<input type="date" name="dob" placeholder="Date of birth..." class="form-control" required value="<?php echo $detail['dob']; ?>">
								</div>
								<button class="btn btn-primary btn-lg" name="update">Update</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>
	</main>
	<script type="text/javascript" src="../assets/js/custom.js"></script>
	<script>
    $(document).ready(function(){
      $("#myTable").DataTable();
    });
  </script>
</body>
</html>