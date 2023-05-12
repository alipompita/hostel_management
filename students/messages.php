<?php 
	session_start();
	require "../dbs/connect.php";
	$regNo=$_SESSION["user"];
	$messages=$conn->query("SELECT * FROM Message WHERE reg_no='$regNo' ORDER BY id DESC");
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
					<center><h2>All messages</h2></center>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3" style="border: solid black red;">
				<!-- MAIN NAVIGATION -->
				<div class="side-nav" style="border: solid black red;">
					<ul>
					<li><a class="active" href="dashboard.php">Dashboard</a></li>
					  <li><a  href="personalDetails.php">Personal Details</a>
					  	<!-- <ul class="multi-level">
					  		<li><a>Personal Details</a></li>
					  		<li><a>Home of origin</li>
					  	</ul> -->
					  </li>
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
					<div class="panel panel-primary">
						<!-- <div class="panel-heading"><h3></h3></div> -->
						<div class="panel-body">
							<?php 
								if ($messages->num_rows>0) {
									?>
										<form action="deleteMessage.php">
											<button class="btn btn-danger" style="margin-bottom: 3px;"><span class="glyphicon glyphicon-trash"></span></button>
										<br>
										<table class="table " id="myTable">
											<thead>
												<th></th>
												<th>Message</th>
												<th>Date</th>
												<th>Time</th>
											</thead>
											<tbody>
												<?php 
													while ($message=$messages->fetch_assoc()) {
														$id=$message["id"];
														?>
														<tr>
															<td>
																<input type="checkbox" name="message" class="checkbox" name="selector[]" value="<?php echo $id; ?>">
															</td>
															<td>
																<div class="form-group">
																	<a style="color: black; text-decoration: none;" href="viewMessage.php?messageId=<?php echo $id; ?>" ><?php
																	// display in bold unread messages
																	if ($message["viewed"]==0) {
																		echo "<b>".$message["message"]."</b>";
																	}
																	if ($message["viewed"]==1) {
																		echo $message["message"];
																	}

																	 ?></a>
																</div>
															</td>
															<td><?php echo $message["date_received"]; ?></td>
															<td><?php echo $message["time_received"]; ?></td>
														</tr>
													<?php
													}
												?>
											</tbody>
										</table>
									</form>
									<?php
								}
								else{
									echo "You have no messages<br>";
								}
							?>
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