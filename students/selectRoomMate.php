<?php 
	session_start();
	require "../dbs/connect.php";
	$regNo=$_SESSION["user"];
	$hostelId=$_SESSION["hostelId"];
	$roomMateId=$msg="";
	if (isset($_POST["next"])) {
		$roomMateId=trim($_POST["roomMateId"]);
		$_SESSION["roomMateId"]=$roomMateId;
		header("location:bookRoom.php");
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
		      <li><a href="logout.php" style="color: white;"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
		    </ul>
		  </div>
		</nav> 
		<section class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<center><h2>Room Booking Application Form</h2></center>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3" style="border: solid black red;">
				<!-- MAIN NAVIGATION -->
				<div class="side-nav" style="border: solid black red;">
					<ul>
					<li><a class="active" href=""><h3 class="menu">MENU</h3></a></li>
					<li><a class="active" href="personalDetails.php">Dashboard</a></li>
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
						<div class="panel-heading"><h3><center>Do you want to have a special room mate??</center></h3></div>
						<div class="panel-body">
							<div style="text-align: center;">
								<button class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal">Yes</button>
							<button style="margin-left: 15px;" onclick="window.location='bookRoom.php?complete=4'" class="btn btn-danger btn-lg">No</button>
							</div>
							<div class="modal fade" role="dialog" id="myModal">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header btn-primary"">
											<button class="close" data-dismiss="modal" type="button">&times;</button>
											<h4>Step 3: Select the Room mate</h4>
										</div>
										<div class="modal-body">
											<form enctype="multipart/form-data" class="form-group" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
												<h3 class="form-header"></h3>
												<p style="color:red;"><?php echo $msg; ?></p>
												<div class="form-group">
													<input type="text" name="roomMateId" id="roomMateId" class="form-control" onkeyup="searchName()">
												</div>
												<div class="form-group">
													 <select name="roomMate" id="roomMate" class="form-control" onchange="setRoomMate()">
													 	<option>Select Room Mate</option>
													 	<?php 
													 		// getting potential room mates
													 	$sql="SELECT S.* FROM Student S INNER JOIN Application A ON S.reg_no=A.reg_no WHERE S.reg_no!='$regNo'";
													 	$results=$conn->query($sql) or die($conn->error);
													 	while ($row=$results->fetch_assoc()) {
													 	?>
													 	<option value="<?php echo $row['reg_no']; ?>">
													 		<table class="table table-all" id="myTable">
													 			<thead>
													 				<th></th>
													 				<th></th>
													 				<th></th>
													 			</thead>
													 			<tbody>
													 				<tr>
													 					<td><?php echo $row["reg_no"]; ?></td>
													 					<td><?php echo $row["firstname"]; ?></td>
													 					<td><?php echo $row["surname"]; ?></td>
													 				</tr>
													 			</tbody>
													 		</table>

													 	</option>
													 	<?php
													 	}
													 	?>
													 </select>
												</div>
										</div>
										<div class="modal-footer">
											<button class="btn btn-danger btn-lg" type="button" data-dismiss="modal">Close</button>
											<button class="btn btn-primary btn-lg" name="next">Next</button>
										</form>
										</div>
									</div>
								</div>
							</div>
							
						</div>
					</div>
				</div>
			</div>
		</section>
	</main>
	<script type="text/javascript" src="../assets/js/custom.js"></script>
</body>
</html>