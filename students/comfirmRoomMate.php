<?php 
	session_start();
	require "../dbs/connect.php";
	include 'functions.php';
	$regNo=$_SESSION["user"];
	$cancelBtnClicked=false;
	$comfirmBtnClicked=false;
	$sender=$_POST["sender"];
	if (isset($_POST["cancel"])) {
		$cancelBtnClicked=true;
	}
	if (isset($_POST["comfirm"])) {
		$comfirmBtnClicked=true;
	}
	if (isset($_POST["comfirmNo"])) {
		// NOTIFY THE SENDER THAT THE REQUEST HAS BEEN REJECTED
		// notify the parties
			$dateReceived=date("Y-m-d");
			$tiemReceived=date("h:i:s");
			// send message to the one requested
			$message="".getFirstname($regNo)." ".getSurname($regNo)." has rejected to be your room mate";
			$conn->query("INSERT INTO Message(reg_no,message,viewed,date_received,time_received,sender) VALUES('$sender','$message','0','$dateReceived','$tiemReceived','No Reply')") or die($conn->error);
			header("location:messages.php");
		exit();
	}
	//room mate comfirmed
	if (isset($_POST["comfirmYes"])) {
		// get room id and hostel id of the
		$accoDetails=$conn->query("SELECT hostelId,roomId FROM RoomBookings WHERE studentId='$sender'") or die($conn->error);
		$roomNumber=$row["roomId"];
		$hostelId=$row["hostelId"];
		// CHECK IF THE ROOM ID IS ALREADY ALLOCATED
		$result=$conn->query("SELECT * FROM RoomBookings WHERE roomId='$roomNumber'")or die("Failed to check if the room is already booked".$conn->error);
		if($result->num_rows>1){
			// room already booked by two
			echo "<script>alert('This room has already been booked by two students')</script>";
			header("refresh: 0");
		}
		else{
			// get room id and hostel id of the
		$accoDetails=$conn->query("SELECT hostelId,roomId FROM RoomBookings WHERE studentId='$sender'") or die($conn->error);
		$row=$accoDetails->fetch_assoc();
		$roomNumber=$row["roomId"];
		$hostelId=$row["hostelId"];
		$sql="INSERT INTO RoomBookings(studentId,roomId,hostelId) VALUES('$regNo','$roomNumber','$hostelId')";
		if ($conn->query($sql)) {
			// notify the parties
			$dateReceived=date("Y-m-d");
			$tiemReceived=date("h:i:s");
			// send message to the one requested
			$message="You are now room mate with ".getFirstname($regNo)." ".getSurname($regNo);
			$conn->query("INSERT INTO Message(reg_no,message,viewed,date_received,time_received,sender) VALUES('$sender','$message','0','$dateReceived','$tiemReceived','No Reply')") or die($conn->error);
			//send message to the one comfirming the request
			// send message 
			$message="You are now room mate with ".getFirstname($sender)." ".getSurname($sender);
			$conn->query("INSERT INTO Message(reg_no,message,viewed,date_received,time_received,sender) VALUES('$regNo','$message','0','$dateReceived','$tiemReceived','No Reply')") or die($conn->error);
			header("location:messages.php");
			exit();
		}
		else{
			echo "Comfirmation Failed<br>".$conn->error;
		}
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
		      <li><a href="logout.php" style="color: white;"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
		    </ul>
		  </div>
		</nav> 
		<section class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<!-- <center><h2>Message Body</h2></center> -->
				</div>
			</div>
			<div class="row">
				<div class="col-md-3" style="border: solid black red;">
				<!-- MAIN NAVIGATION -->
				<div class="side-nav" style="border: solid black red;">
					<ul>
					<li><a class="active" href="personalDetails.php">Dashboard</a></li>
					  <li><a class="active" href="personalDetails.php">Personal Details</a></li>
					  <li><a href="application.php">Hostel Application</a></li>
					  <li><a href="roomBooking.php" >Room Booking</a></li>
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
				<br>
				<div class="col-md-8">
					<?php
					if ($cancelBtnClicked==true) {
					?>
					<div class="panel panel-danger">
						<div class="panel panel-heading"><h3>Cancel Room Mate Request??</h3></div>
						<div class="panel-body">
						    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
							<p style="font-size: 14pt;">
								Are you sure you cancel the request?
								<input type="text" name="sender" value="<?php echo $sender; ?>" hidden>
								<br><button class="btn btn-danger " name="cancelNo">NO </button>
								<button class="btn btn-primary " name="cancelYes">YES</button>
							</p>
						</form>
						</div>
					</div>
					<?php
					}
					if ($comfirmBtnClicked==true) {
					?>
					<div class="panel panel-primary">
						<div class="panel panel-heading"><h3>Comfir Room Mate Request</h3></div>
						<div class="panel-body">
							<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
							<p style="font-size: 14pt;">
								Do you want to comfirm room mate request?
								<input type="text" name="sender" value="<?php echo $sender; ?>" hidden>
								<br><button class="btn btn-danger " name="comfirmNo">NO </button>
								<button class="btn btn-primary " name="comfirmYes">YES</button>
							</p>
						</form>
						</div>
					</div>
					<?php 
					}
					?>
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