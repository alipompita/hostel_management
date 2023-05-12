<?php 
	session_start();
	require "../dbs/connect.php";
	$regNo=$_SESSION["user"];
	//include 'deleteUser.php';

	// ADDING USER DETAILS TO THE DATBASE
	$firstname=$surname=$username=$password=$errorMsg="";
	if (isset($_POST["save"])) {
		$firstname=trim($_POST["firstname"]);
		$surname=trim($_POST["surname"]);
		$username=trim($_POST["username"]);
		$password=trim($_POST["password"]);
		$role=trim($_POST["role"]);
		$password=md5($password);

		$sql="INSERT INTO Users(username,password,firstname,surname,role) VALUES('$username','$password','$firstname','$surname','$role')";
		if($conn->query($sql)){
			// echo "string";
		}
		else{
			echo "<script>alert('Adding user failed')</script>".$conn->error;
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
					<center><h2>All Users</h2></center>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3" style="border: solid black red;">
				<!-- MAIN NAVIGATION -->
				<div class="side-nav" style="border: solid black red;">
					<ul>
					<li><a href="dashboard.php">Dashboard</a></li>
					<li class="active"><a href="users.php"><b>All Users</b></a></li>
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
					<!-- ADD USER MODAL STARTS HERE -->
					<br>
					<div class="modal fade" id="addUserModal" role="dialog">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button class="close" data-dismiss="modal" type="button">&times;</button>
									<h4 class="modal-tiltle">Add New User</h4>
								</div>
								<div class="modal-body">
									<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
										<div class="form-group">
											<label>Firstname</label>
											<input type="text" name="firstname" class="form-control" required>
										</div>
										<div class="form-group">
											<label>Surname</label>
											<input type="text" name="surname" class="form-control" required>
										</div>
										<div class="form-group">
											<label>Username</label>
											<input type="text" name="username" class="form-control" required>
										</div>
										<div class="form-group">
											<label>Role</label>
											<select name="role" class="form-control" required>
												<option>Select Role</option>
												<option value="Admin">Admin</option>
												<option value="Supervisor">Supervisor</option>
												<option value="Student">Student</option>
											</select>
										</div>
										<div class="form-group">
											<label>Password</label>
											<input type="password" name="password" class="form-control" required minlength="8">
										</div>
									
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-danger " data-dismiss="modal">Close</button>
									<button class="btn btn-primary" name="save">Save</button>
								</div>
							</form>
							</div>
						</div>
					</div>
					<!-- ADD USER MODAL ENDS HERE -->
					<!-- USER DETAILS STARTS HERE -->
					<br>
					<div class="panel panel-default">
						<!-- <div class="panel-heading"><h4><i class="glyphicon glyphicon-users"></i>All Users</h4></div> -->
						<div class="panel-body">
							<!-- ADD USER MODAL BUTTON -->
						<button class="btn btn-success btn-lg" type="button" data-toggle="modal" data-target="#addUserModal"><i class="glyphicon glyphicon-plus"></i> AddNew User</button>
						<?php 
							$results=$conn->query("SELECT * FROM Users") or die("Users data could not be found".$conn->error);
						?>
							<table class="table table-all" id="myTable">
								<thead>
									<th>Firstname</th>
									<th>Lastname</th>
									<th>Username</th>
									<th>Role</th>
									<th></th>
									<th></th>
								</thead>
								<tbody>
									<?php 
										while ($row=$results->fetch_assoc()) {
											$id=$row["id"];
											?>
										<tr>
											<td><?php echo $row["firstname"]; ?></td>
											<td><?php echo $row["surname"]; ?></td>
											<td><?php echo $row["username"]; ?></td>
											<td><?php echo $row["role"]; ?></td>
											<!-- <td><a href="editUser.php?id=<?php echo $id; ?>">Edit<i class="glyphicon glyphicon-pencil"></i></a></td> -->
											<td><a href="deleteUser.php?delete=yes&id=<?php echo $id; ?>">Delete<i class="glyphicon glyphicon-trash"></i></a></td>
										</tr>
										<?php
										}
									?>
								</tbody>
							</table>
						</div>
					</div>
					<!-- USER DETAILS ENDS HERE -->
					
				</div>
			</div>
		</section>
	</main>
</body>
</html>