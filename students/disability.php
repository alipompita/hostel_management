<?php 
	session_start();
	if(!isset($_SESSION['regNo'])){
		header("location:register.php");
		exit();
	}
	require "../dbs/connect.php";
	$filename=$regNo=$msg="";
	if (isset($_POST["next"])) {
		// getting file attachment details
		$targetDirectory="../uploads/";
		$filename=$_FILES["evidence"]["name"];
		$targetFile=$targetDirectory.basename($_FILES["evidence"]["name"]);
		$fileSize=$_FILES["evidence"]["size"];
		$fileType=pathinfo($targetFile,PATHINFO_EXTENSION);
		$uploadOk=1;
		$name=$_POST["name"];
		$regNo=$_SESSION["regNo"];
		$sql="INSERT INTO Disability(reg_no,name,filename) VALUES('$regNo','$name','$filename')";
		if($conn->query($sql)){
			// file uploading to the server
			//file should be less than 10mb
			if($fileSize>500000)
				$uploadOk=0;
			// check if the file already exists
			if(file_exists($targetFile))
				$uploadOk=0;
			// pdf only
			if($fileType!="pdf")
				$uploadOk=0;
			// check if the file has no errors then upload it if it does not have errors
			if ($uploadOk==0) {
				echo "<script>alert('This file cannot be uploaded because it has errors.Please check the file for errors')</script>";
				// delete the filename from the database
				 $conn->query("DELETE FROM Disability WHERE reg_no='$regNo'");
				header("location:disability.php?complete=3");
				exit();
			}
			else{
				// upload the file
				if(move_uploaded_file($_FILES["evidence"]["tmp_name"], $targetFile)){
					header("location:createPassword.php");
					exit();
				}
				else{
					echo "<script>alert('Failed to upload the file attachment')</script>";
					echo $_FILES["evidence"]["error"];
					// delete the filename from the database
				 	//$conn->query("DELETE FROM Disability WHERE reg_no='$regNo'");
					header("location:createPassword.php?complete=4");
					exit();
				}
			}
			// file upload ends here 
		}
		else{
			$msg="Recording disability details failed <br>".$conn->error;
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
						<div class="panel-heading"><h3>Do you have any disability??</h3></div>
						<div class="panel-body">
							<div style="text-align: center;">
								<button class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal">Yes</button>
							<button style="margin-left: 15px;" onclick="window.location='createPassword.php?complete=4'" class="btn btn-danger btn-lg">No</button>
							</div>
							<div class="modal fade" role="dialog" id="myModal">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button class="close" data-dismiss="modal" type="button">&times;</button>
											<h4>Part Four: Add Disability</h4>
										</div>
										<div class="modal-body">
											<form enctype="multipart/form-data" class="form-group" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
												<h3 class="form-header"></h3>
												<p style="color:red;"><?php echo $msg; ?></p>
												<div class="form-group">
													<label>Type of the Disability</label>
													<input type="text" name="name" placeholder="Disability..." class="form-control" required>
												</div>
												<div class="form-group">
													<label>Attach File of evidence</label>
													<input type="file" name="evidence" class="form-control" required>
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
	</div>
</body>
</html>