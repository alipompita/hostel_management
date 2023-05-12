<?php 
	session_start();
	require "../dbs/connect.php";
	$id="";
	if (isset($_GET["id"])) {
		$id=$_GET["id"];
	}
	$regNo=$_SESSION["user"];
	$messages=$conn->query("SELECT * FROM Message WHERE reg_no='$regNo' ORDER BY id DESC")or die($conn->error);
	$users=$conn->query("SELECT * FROM Users WHERE id=$id") or die($conn->error);
	$user=$users->fetch_assoc();
	echo "$user";
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
					<center><h2>User Details</h2></center>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3" style="border: solid black red;">
				<!-- MAIN NAVIGATION -->
				<div class="side-nav" style="border: solid black red;">
					<ul>
					<li><a class="active" href="dashboard.php">Dashboard</a></li>
					  <li><a href="users.php">All Users</a></li>
					<!-- <li><a class="active" href="applicationList.php">Application List</a></li>
					  <li><a class="active" href="selectionList.php">Selection List</a></li>
					  <li><a href="roomBooking.php">Room Bookings</a></li> -->
					  <li><a href="applicationWindow.php" >Application Window</a></li>
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
				<br>
				<div class="col-md-8">
					<div class="panel panel-primary">
						<!-- <div class="panel-heading"><h3></h3></div> -->
						<div class="panel-body">
							<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);  ?>">
								<div class="form-group">
									<label>Username</label>
									<input type="text" name="username" value="<?php echo $user["username"]; ?>" >
								</div>
								<div class="form-group">
									<label>Firstname</label>
									<input type="text" name="firstname" value="<?php echo $user['firstname']; ?>" class="form-control">
								</div>
								<div class="form-group">
									<label>Surname</label>
									<input type="text" name="surname" value="<?php echo $user['surname']; ?>" class="form-control">
								</div>
								<div class="form-group">
									<label>Role</label>
									<input type="text" name="username" value="<?php echo $user['username']; ?>" class="form-control">
								</div>
							</form>
						</div>
					</div>
				</div>
			</d0iv>
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