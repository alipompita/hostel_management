<?php 
	session_start();
	require "../dbs/connect.php";
	$regNo=$_SESSION["user"];
	$btnValue="allocate";
	// allocate student 
	if (isset($_POST["allocate"])) {
		$regNo=$_POST["regNo"];
		$year=$_POST["year"];
		if($conn->query("INSERT INTO Allocated(reg_no,yearAllocated) VALUES('$regNo',$year)")){
			//send message to room mate
			$dateReceived=date("Y-m-d");
			$tiemReceived=date("h:i:s");
			// send message 
			$conn->query("INSERT INTO Message(reg_no,message,viewed,date_received,time_received,sender) VALUES('$regNo','Your application for accommodation has been successful. You have been allocated','0','$dateReceived','$tiemReceived','No Reply')") or die($conn->error);
		}
		else{
			$conn->error;
		}
	}
	// disallocate student
	if (isset($_POST["disallocate"])) {
		$regNo=$_POST["regNo"];
		$year=$_POST["year"];
		$conn->query("DELETE FROM Allocated WHERE reg_no='$regNo' AND yearAllocated='$year'") or die($conn->error);
	}

	// functions to check for selection priority
	function isDisabled($id){
		require "../dbs/connect.php";
		$result=$conn->query("SELECT * FROM Disability WHERE reg_no='$id'") or die();
		if ($result->num_rows>0) {
			//i s disabled
			//echo "He is disabled";
			return true;
		}
		else{
			return false;
		}

	}
	function alreadyAllocated($id){
		require "../dbs/connect.php";
		$result=$conn->query("SELECT * FROM Allocated WHERE reg_no='$id'") or die();
		if ($result->num_rows>0) {
			//i s already allocated
			return true;
		}
		else{
			return false;
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
		.high{
			color: red;
		}
		.low{
			color: black;
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
					<center><h2>Student Application List</h2></center>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3" style="border: solid black red;">
				<!-- MAIN NAVIGATION -->
				<div class="side-nav" style="border: solid black red;">
					<ul>
					<li><a class="active" href="dashboard.php">Dashboard</a></li>
					<li><a class="active" href="applicationList.php"><strong>Application List</strong></a></li>
					  <li><a class="active" href="allocatedList.php">Allocated List</a></li>
					  <li><a href="roomBookings.php">Room Bookings</a></li>
					  <!-- <li><a href="applicationWindow.php" >Application Window</a></li> -->
					   <!-- <li><a href="roomBookingWindow.php" >Room Bookings Window</a></li> -->
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
				<div class="col-md-9">
					<!-- <h2>Student Application List</h2> -->
					<?php
						$all=$conn->query("SELECT A.*,S.* FROM Application A INNER JOIN Student S ON A.reg_no=S.reg_no /*NOT IN (SELECT AL.reg_no FROM Allocated AL)*/");
						if ($all->num_rows>0) {
							?>
						<table class="table table-bordered" id="myTable">
							<thead>
								<th>Reg No</th>
								<th>Firstname</th>
								<th>Surname</th>
								<th>Gender</th>
								<th>Year</th>
								<th>Allocate</th>
							</thead>
							<tbody>
								<?php
								while ($row=$all->fetch_assoc()) {

									?>
							<form class="" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
									<?php 
										$reg=$row["reg_no"];
										if(alreadyAllocated($reg)){
													$btnValue='disallocate' ;
										}
										if(isDisabled($reg)){
											?>
											<tr class="high">
												<td><?php echo $row["reg_no"]; ?></td>
												<td><?php echo $row["firstname"]; ?></td>
												<td><?php echo $row["surname"]; ?></td>
												<td><?php echo $row["gender"]; ?></td>
												<td><?php echo "Year ".$row["year"]; ?></td>
												<input type="text" name="year" value="<?php echo $row['year']; ?>" hidden>
												<input type="text" name="regNo" value="<?php echo $row['reg_no']; 
											?>" hidden>
												<td><button class="btn btn-info" name="<?php echo $btnValue; ?>" value="<?php
												echo $btnValue; ?>"><i class="glyphicon glyphicon-tick"></i><?php echo $btnValue; ?></button></td>
											</tr>
										<?php
										}
										else{
										?>
										<tr class="low">
											<td><?php echo $row["reg_no"]; ?></td>
												<td><?php echo $row["firstname"]; ?></td>
												<td><?php echo $row["surname"]; ?></td>
												<td><?php echo $row["gender"]; ?></td>
												<td><?php echo "Year ".$row["year"]; ?></td>
												<input type="text" name="year" value="<?php echo $row['year']; ?>" hidden>
												<input type="text" name="regNo" value="<?php echo $row['reg_no']; ?>" hidden>
												<td><button class="btn btn-info" name="<?php echo $btnValue; ?>" value="<?php echo $btnValue; ?>"><i class="glyphicon glyphicon-tick"></i><?php echo $btnValue; ?></button></td>
											</tr>
										<?php
										}
									 ?>
									
									
							</form>
								<?php 
								$btnValue="allocate";
								}
								?>
						</table>
							<?php 
						}
						else{
							echo "<br>";
							echo "No students recently applied for the Accommodation";
						}
					 ?>
				</div>
			</div>
		</section>
	</main>
	<!-- <script>
		$(document).ready(function(){
			$("#myTable").DataTable();
		});
	</script> -->
</body>
</html>