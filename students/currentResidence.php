<?php 
	session_start();
	if(!isset($_SESSION['regNo'])){
		header("location:register.php");
		exit();
	}
	require "../dbs/connect.php";
	$place=$street=$msg=$district="";
	if (isset($_POST["next"])) {
		$place=trim($_POST["place"]);
		$street=trim($_POST["street"]);
		$district=trim($_POST["district"]);
		$regNo=$_SESSION["regNo"];
		$sql="INSERT INTO Residence(reg_no,place,street,district) VALUES('$regNo','$place','$street','$district')";
		if($conn->query($sql)){
			header("location:disability.php?complete=3");
			exit();
		}
		else{
			$msg="Recording current residence details failed <br>".$conn->error;
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
								<h3 class="form-header">Part Three: Current Residence Details</h3>
								<p style="color:red;"><?php echo $msg; ?></p>
								<div class="form-group">
									<input type="text" name="place" placeholder="Village/Town..." class="form-control" required>
								</div>
								<div class="form-group">
									<input type="text" name="street" placeholder="T.A/Street..." class="form-control" required>
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