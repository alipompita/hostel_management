<?php 
	session_start();
	require "../dbs/connect.php";
	$regNo=$_SESSION["user"];
	$messageId=$_GET["messageId"];
	$messageComing=$conn->query("SELECT * FROM Message WHERE id=$messageId") or die("Failed to view message".$conn->error);
	$message=$messageComing->fetch_assoc();
	$update=$conn->query("UPDATE Message SET viewed=1 WHERE id=$messageId") or die($conn->error);
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
					<center><h2>Message Body</h2></center>
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
					<div class="panel panel-success">
						<div class="panel-heading"><h4>
								<br>Sender:<?php $sender=$message["sender"];echo $sender; ?>
								<br>Date:<?php echo $message["date_received"]; ?>
								<br>Time:<?php echo $message["time_received"]; ?>
							</h4></div>
						<div class="panel-body">
							
							<p style="border: solid 1px gray; border-radius: 5px; font-size: 12pt; padding: 10px;">
								<?php echo $message["message"];
								?>
								<br><a href="messages.php">Back</a>
								<?php 
								if($message["sender"]!="No Reply"){
									?>
									<center>
										<form method="post" action="comfirmRoomMate.php">
											<input type="text" name="sender" hidden value="<?php echo $sender; ?>">
											<button class="btn btn-primary btn-lg" name="comfirm">Comfirm Request</button>
											<button class="btn btn-danger btn-lg" name="cancel" style="margin-left: 10px;">Cancel Request</button>
										</form>
									</center>
									<?php
								}
								?>
							</p>
							<p>
								
							</p>
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