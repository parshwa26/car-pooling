<?php
session_start();
if(isset($_SESSION['adminusername']))
{
	if(isset($_SESSION['$regid']))
	{
		unset($_SESSION['$regid']);
	}
//include_once("toptemplate3.php");
include("../connection.php"); 
 
/*
}
else
	header("location:../index.html");
	*/
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="pl" xml:lang="pl">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Admin Page</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="web/css/style.css" rel="stylesheet" type="text/css"  media="all" />	
<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="web/css/responsiveslides.css">
<script src="web/js/jquery.min.js"></script>
<script src="web/js/responsiveslides.min.js"></script>
		  <script>
		    // You can also use "$(window).load(function() {"
			    $(function () {
			      // Slideshow 1
			      $("#slider1").responsiveSlides({
			        maxwidth: 2500,
			        speed: 600
			      });
			});
		  </script>
 </head>
<link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/navi.css" media="screen" />
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript">
$(function(){
	$(".box .h_title").not(this).next("ul").hide("normal");
	$(".box .h_title").not(this).next("#home").show("normal");
	$(".box").children(".h_title").click( function() { $(this).next("ul").slideToggle(); });
});
</script>
</head>
<body>

    <body>
		<!---start-header---->
			<div class="header">
				<div class="wrap">
				<div class="logo">
					<!--<a href="index.html"><img src="carshare.png" title="logo" /></a>-->
					<p><font color="#CCCCCC" size="+4">Car Pooling</p></font>
				</div>
				<div class="top-nav">
					<ul>
						<li><a href="home.php"><font size="+1">Home</font></a></li>
						<!--<li><a href="../homepage.php"><font size="+1">login</font></a></li>-->
						<li><a href="../simple signup/signup.php"><font size="+1">Signup</font></a></li>
						<li><a href="infoaboutus.php"><font size="+1">About Us</font></a></li>
						<li><a href="contactus.php"><font size="+1">Contact Us</font></a></li>
						<li><a href="../logout.php"><font size="+1">Logout</font></a></li>
					</ul>
				</div>
				<div class="clear"> </div>
			</div>
		</div>
</body>
	</div>
	<div class="wrap">
	
	<div id="header">
	
		<div id="top">
		
	<div id="content">			
			<div class="clear"></div>
			
				<div class="full_w">
					<div class="h_title"><p style="background-image:url(img/323a45-2880x1800.png);"><font color="#FFFFFF" size="+3">Registration</font></p></div>
					<div class="boxinfo">
		<!--<div align="right">	<a href="../main login/logout.php">Log out</a></div>-->
		<!--<h3 ><font color="#00CC00" size="+5">Welcome To Admin Registration Page</font></h3>-->
		<ul><br />
		<li><a href="report1.php"><font  size="+2">View Report</font></a></li><br />
		<li><font color="#0099FF" size="+2"><a href="state.php">Add State</a></li><br />
		<li><a href="city.php">Add City</a></li><br />
		<li><a href="area.php">Add Area</a></li><br />
		<li><a href="company.php">Add Vehicle company</a></li><br />
		<li><a href="model.php">Add Vehilce Model</a></li></font></ul>
	</font>
	</div>
	</div>
			
				<br />
				<p style="background-image:url(img/323a45-2880x1800.png);"><font color="#FFFFFF" size="+3">All User Information</font></p>
				<?php
				include_once("connection.php");
				$sql="select * from signup_details order by reg_id desc";
				$result=mysql_query($sql); 
				?>
				<table style="padding-right:1px;" width="779">
					<thead>
						<tr>
							<th scope="col" background="../simple signup/img/323a45-2880x1800.png">Srno.</th>
							<th scope="col" background="../simple signup/img/323a45-2880x1800.png">First name</th>
							<th scope="col" background="../simple signup/img/323a45-2880x1800.png">Last name</th>
							<th scope="col" background="../simple signup/img/323a45-2880x1800.png">Contact no.</th>
							<th scope="col" background="../simple signup/img/323a45-2880x1800.png">Gender</th>
							<th scope="col" background="../simple signup/img/323a45-2880x1800.png" style="width: 65px;">Email-id</th>
<th scope="col" background="../simple signup/img/323a45-2880x1800.png" style="width: 65px;">Password</th>
<th scope="col" background="../simple signup/img/323a45-2880x1800.png" style="width: 65px;">Update</th>
<th scope="col" background="../simple signup/img/323a45-2880x1800.png" style="width: 65px;">Delete</th>
						</tr>
					</thead>
					
					<tbody>
						<?php
								$Srno=1;
								while($row=mysql_fetch_array($result))
								{
								
				$sql1="select * from login where reg_id=$row[0]";
				$result1=mysql_query($sql1);
								$row1=mysql_fetch_array($result1);
								echo "<tr>";
								echo "<td>".$Srno."</td>";
								//echo "<td>".$row[0]."</td>";
								echo "<td>".$row[1]."</td>";
								echo "<td>".$row[2]."</td>";
								echo "<td>".$row[3]."</td>";
								echo "<td>".$row[4]."</td>";
								//echo "<td>".$row[5]."</td>";
								echo "<td>".$row1[1]."</td>";
								echo "<td>".$row1[2]."</td>";
		echo "<td><a class='table-icon edit' title='Edit' href='basicupdate.php?id=".$row[0]."'></a></td>";
		echo "<td ><a class='table-icon delete' title='Delete' href='basicdelete.php?did=".$row[0]."'></a></td>";
								echo "</tr>";
								$Srno++;
								}


						?>
			
	</div>
</div>

</body>
</html>
<?php
}
else
	header("location:../index.html");
?>