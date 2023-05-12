<?php 
	session_start();
	require "../dbs/connect.php";
	
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
	<script type="text/javascript" src="../bootstrap/js/jquery.js"></script>
	<script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
	<style type="text/css">
		body{
			/*background-image: url("../tempoImage.png");*/
		}
		/* NEW 2nd-Level Dropdown CSS START */
.dropdown-submenu{position: relative;}
.dropdown-submenu .caret{-webkit-transform: rotate(-90deg); transform: rotate(-90deg);}
.dropdown-submenu > .dropdown-menu {top:0; left:100%; margin-top:-6px; margin-left:-1px;}
.dropdown-submenu.open > a:after{border-left-color:#fff;}
.dropdown-submenu.open > .dropdown-menu, .dropdown-submenu.open > .dropdown-menu {display: block;}
.dropdown-submenu .dropdown-menu{margin-bottom: 8px;}
.navbar-default .navbar-nav .open .dropdown-menu .dropdown-submenu ul{background-color: #f6f6f6;}
.navbar-inverse .navbar-nav .open .dropdown-menu .dropdown-submenu ul{background-color:#333;}
.navbar .navbar-nav .open .dropdown-submenu .dropdown-menu > li > a{padding-left: 30px;}
@media screen and (min-width:992px){
    .dropdown-submenu .dropdown-menu{margin-bottom: 2px;}
    .navbar .navbar-nav .open .dropdown-submenu .dropdown-menu > li > a{padding-left: 25px;}
    .navbar-default .navbar-nav .open .dropdown-menu .dropdown-submenu ul{background-color:#fff;}
    .navbar-inverse .navbar-nav .open .dropdown-menu .dropdown-submenu ul{background-color:#fff;}
}
/* NEW 2nd-Level Dropdown CSS END */

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
			<br><br><br><br>
			<nav class="navbar navbar-inverse navbar-fixed-top">
			  <div class="container-fluid">
			    <div class="navbar-header">
			        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-navbar-collapse-1" aria-expanded="false">
			            <span class="sr-only">Toggle navigation</span>
			            <span class="icon-bar"></span>
			            <span class="icon-bar"></span>
			            <span class="icon-bar"></span>
			        </button>
			        <a class="navbar-brand" href="#">Brand</a>
			    </div>
			    <div class="collapse navbar-collapse" id="bs-navbar-collapse-1" style="margin-top: -20px;">
			        <ul class="nav navbar-nav">
			            <li><a href="index.php">Home</a></li>
			            <li class="dropdown">
			                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
			                <ul class="dropdown-menu">
			                     <li><a href="#">Menu Item</a></li>
			                     <li><a href="#">Menu Item</a></li>
			                     <li class="dropdown-submenu">
			                         <a tabindex="-1" href="#" class="dropdown-submenu-toggle">Second Dropdown <b class="caret"></b></a>
			                         <ul class="dropdown-menu">
			                             <li><a href="#">Sub-Menu Item</a></li>
			                             <li><a href="#">Sub-Menu Item</a></li>
			                             <li><a href="#">Sub-Menu Item</a></li>
			                         </ul>
			                     </li>
			                     <li><a href="#">Menu Item</a></li>
			                     <li><a href="#">Menu Item</a></li>
			                 </ul>
			             </li>
			         </ul>
			     </div><!-- /.navbar-collapse -->
			  </div><!-- /container -->
			</nav>

		</section>
	</main>
	<script type="text/javascript">
		// Make Dropdown Submenus possible
		$('.dropdown-submenu a.dropdown-submenu-toggle').on("click", function(e){
		    $('.dropdown-submenu ul').removeAttr('style');
		    $(this).next('ul').toggle();
		    e.stopPropagation();
		    e.preventDefault();
		});
		// Clear Submenu Dropdowns on hidden event
		$('#bs-navbar-collapse-1').on('hidden.bs.dropdown', function () {
		  	$('.navbar-nav .dropdown-submenu ul.dropdown-menu').removeAttr('style');
		});

		   // Make Secondary Dropdown on Click
   $('.dropdown-submenu a.dropdown-submenu-toggle').on("click", function(e){
      $('.dropdown-submenu ul').removeAttr('style');
      $(this).next('ul').toggle();
      e.stopPropagation();
      e.preventDefault();
   });

   // Make Secondary Dropdown on Hover
   $('.dropdown-submenu a.dropdown-submenu-toggle').hover(function(){
      $('.dropdown-submenu ul').removeAttr('style');
      $(this).next('ul').toggle();
   });
 
   // Make Regular Dropdowns work on Hover too
   $('.dropdown a.dropdown-toggle').hover(function(){
      $('.navbar-nav .dropdown').removeClass('open');
      $(this).parent().addClass('open');
   });

   // Clear secondary dropdowns on.Hidden
   $('#bs-navbar-collapse-1').on('hidden.bs.dropdown', function () {
      $('.navbar-nav .dropdown-submenu ul.dropdown-menu').removeAttr('style');
   });


	</script>
</body>
</html>