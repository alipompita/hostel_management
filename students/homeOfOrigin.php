<?php 
	session_start();
	if(!isset($_SESSION['regNo'])){
		header("location:register.php");
		exit();
	}
	require "../dbs/connect.php";
	$village=$ta=$msg=$district="";
	if (isset($_POST["next"])) {
		$village=trim($_POST["village"]);
		$ta=trim($_POST["ta"]);
		$district=trim($_POST["district"]);
		$regNo=$_SESSION["regNo"];
		$sql="INSERT INTO Home(reg_no,village,ta,district) VALUES('$regNo','$village','$ta','$district')";
		if($conn->query($sql)){
			header("location:currentResidence.php?complete=2");
			exit();
		}
		else{
			$msg="Recording home of origin details failed <br>".$conn->error;
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
								<h3 class="form-header">Part Two: Home of Origin Details</h3>
								<p style="color:red;"><?php echo $msg; ?></p>
								<div class="form-group">
									<input type="text" name="vilage" placeholder="Village..." class="form-control" required>
								</div>
								<div class="form-group">
									<input type="text" name="ta" placeholder="Tradional Authority (T.A)..." class="form-control" required>
								</div>
								<div class="form-group">
									<input type="text" name="district" placeholder="District..." class="form-control" >
								</div>
								<button class="btn btn-primary btn-lg" name="next">Next</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
</body>
</html>