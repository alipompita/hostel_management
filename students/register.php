<?php 
	session_start();
	require "../dbs/connect.php";
	$firstname=$maidenName=$msg=$surname=$regNo=$dob=$gender=$program="";
	if (isset($_POST["next1"])) {
		$regNo=trim($_POST["regNo"]);
		$firstname=trim($_POST["firstname"]);
		$maidenName=trim($_POST["maidenName"]);
		$surname=trim($_POST["surname"]);
		$gender=trim($_POST["gender"]);
		$dob=trim($_POST["dob"]);
		$program=trim($_POST["program"]);
		$sql="INSERT INTO Student(reg_no,firstname,maiden_name,surname,gender,program,dob) VALUES('$regNo','$firstname','$maidenName','$surname','$gender','$program','$dob')";
		if($conn->query($sql)){
			$_SESSION["regNo"]=$regNo;
			$_SESSION["firstname"]=$firstname;
			$_SESSION["surname"]=$surname;
			header("location:homeOfOrigin.php?complete=1");
			exit();
		}
		else{
			$msg="Registering student failed <br>".$conn->error;
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Accommodation Application System</title>
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/style.css">
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/font-awesome.css">
	<script type="text/javascript" src="../bootstrap/js/jquery.js"></script>
	<script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
	<style type="text/css">
		body{
			background-image: url("../tempoImage.png");
		}
	</style>
</head>
<body>
	<div class="container-fluid">
		<nav class="navbar navbar-default" style="width:100%;margin-left: -12px; background-color: #006699;">
		  <div class="container-fluid">
		    <div class="navbar-header" style="text-align: center;">
		      <a class="navbar-brand" href="#" style="color: white;">Hostel Management System</a>
		    </div>
		  </div>
		</nav>
		<section class="container">
			<div class="row">
				<br>
				<div class="col-md-6 col-md-push-2">
					<div class="panel panel-primary">
						<div class="panel-heading"><h3>Registration Form</h3></div>
						<div class="panel-body">
							<form class="form-group" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
								<h3 class="form-header">Part One: Personal Details</h3>
								<p style="color:red;"><?php echo $msg; ?></p>
								<div class="form-group">
									<input type="text" name="regNo" placeholder="Reg Number..." class="form-control" required>
								</div>
								<div class="form-group">
									<input type="text" name="firstname" placeholder="Firstname..." class="form-control" required>
								</div>
								<div class="form-group">
									<input type="text" name="maidenName" placeholder="Maiden Name..." class="form-control" >
								</div>
								<div class="form-group">
									<input type="text" name="surname" placeholder="Surname..." class="form-control" required>
								</div>
								<div class="form-group">
									<select class="form-control" name="gender">
										<option>Select Gender</option>
										<option value="Male">Male</option>
										<option value="Female">Female</option>
									</select>
								</div>
								<div class="form-group">
									<input type="text" name="program" placeholder="Program of study..." class="form-control" required>
								</div>
								<div class="form-group">
									<label>Date of Birth</label>
									<input type="date" name="dob" placeholder="Date of birth..." class="form-control" required>
								</div>
								<button class="btn btn-primary btn-lg" name="next1">Next</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
</body>
</html>