<?php
session_start();
require "dbs/connect.php";
$username = $password = $msg = "";
if (isset($_POST["login"])) {
	$username = $_POST['username'];
	$password = $_POST["password"];
	$password = md5($password);
	$result = $conn->query("SELECT * FROM Users WHERE username='$username' AND password='$password'") or die($conn->error);
	if ($result->num_rows > 0) {
		$_SESSION["user"] = $username;
		$row = $result->fetch_assoc();

		// var_dump($row);
		if ($row["role"] == "Student") {
			header("location:students/dashboard.php");
			exit();
		}
		if ($row["role"] == "Supervisor") {
			header("location:Supervisor/dashboard.php");
			exit();
		}
		if ($row["role"] == "Admin") {
			header("location:Admin/dashboard.php");
			exit();
		}
	} else {
		$msg = "Invalid Usename or Password";
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Hostel Management System</title>
	<!-- <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css"> -->
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/font-awesome.css">
	<script type="text/javascript" src="bootstrap/js/jquery.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
	<style type="text/css">
		body {
			background-image: url("images/poly-building.jpg");
			background-repeat: no-repeat;
			background-size: 100%;
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
					<li><a href="students/register.php" style="color: white;"><span class="glyphicon glyphicon"></span> Register</a></li>
					<li><a href="index.php" style="color: white;"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
				</ul>
			</div>
		</nav>
		<section class="container">
			<div class="row">
				<div class="col-md-4 col-md-push-4">
					<br>
					<br><br><br><br>
					<div class="panel panel-warning">
						<div class="">
							<h3></h3>
						</div>
						<div class="panel-body">
							<form class="form-group" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
								<p style="color:red;"><?php echo $msg; ?></p>
								<div class="form-group">
									<input type="text" name="username" placeholder="Username..." class="form-control" required>
								</div>
								<div class="form-group">
									<input type="password" name="password" placeholder="Password..." class="form-control" required>
								</div>
								<button class="btn btn-primary" name="login">Login</button>
								<p></p>
								<!-- <p style="text-align: center;">Or</p> -->
								<!-- <p style=""><a href="students/resetPassword.php">Forgot Password??</a></p> -->
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>
	</main>
</body>

</html>