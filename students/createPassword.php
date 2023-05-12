<?php 
	session_start();
	if(!isset($_SESSION['regNo'])){
		header("location:register.php");
		exit();
	}
	require "../dbs/connect.php";
	$username=$pass1=$msg=$pass2="";
	$regNo=$_SESSION["regNo"];
	$firstname=$_SESSION["firstname"];
	$surname=$_SESSION["surname"];
	if (isset($_POST["finish"])) {
		$username=trim($_POST["username"]);
		$pass1=trim($_POST["pass1"]);
		$pass2=trim($_POST["pass2"]);
		// check if the passwords match
		if ($pass2==$pass1) {
			// Encript password
			$pass1=md5($pass1);
			$sql="INSERT INTO Users(username,password,firstname,surname,role) VALUES('$regNo','$pass1','$firstname','$surname','Student')";
			if($conn->query($sql)){
				header("location:../index.php");
				exit();
			}
			else{
				$msg="Password not created, tyr again <br>".$conn->error;
			}
			}
			else{
				$msg="Passwords not match";
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
								<h3 class="form-header">Finish: Create Password</h3>
								<p style="color:red;"><?php echo $msg; ?></p>
								<div class="form-group">
									<label>Username</label>
									<input type="text" name="username" value="<?php echo $_SESSION['regNo']; ?>" class="form-control" required>
								</div>
								<div class="form-group">
									<input type="password" name="pass1" placeholder="Create Password..." class="form-control" required minlength="8">
								</div>
								<div class="form-group">
									<input type="password" name="pass2" placeholder="Comfirm Password..." class="form-control" >
								</div>
								<button class="btn btn-primary btn-lg" name="finish">Finish</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
</body>
</html>