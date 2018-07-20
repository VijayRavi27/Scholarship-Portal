<?php
	session_start();
	require_once('dbconfig/config.php');
	//phpinfo();
?>
<!DOCTYPE html5>
<html>
<head>
<title>Home Page</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div id="main-wrapper">
		<center><h2>Home Page</h2></center>
		<center><h2>Hi, <?php echo $_SESSION['username']; ?></h2></center>
		
		<center>
			<b>
			<form action="enterdetails.php">
			<input type="submit" value="New Application"> <br><br></form>
			<form action="renewal.php">
			<input type="submit" value="Renewal Application"> <br><br></form>
			<form action="editdetails.php">
			<input type="submit" value="Edit Details"> <br><br></form>
			<form action="status.php">
			<input type="submit" value="View Scholarship Status"> <br><br></form>
			</b>
		</center>
		</div>


		<form action="index.php" method="post">
			<div class="inner_container">
				<button class="logout_button" type="submit">Log Out</button>	
			</div>
		</form>
	</div>
</body>
</html>