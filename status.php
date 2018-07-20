<?php
	session_start();
	require_once('dbconfig/config.php');

?>
<!DOCTYPE html5>
<html>
<head><title> Scholarship Status </title></head>
<body>
	<label>USERNAME:</label>
	<b><?php echo $_SESSION['username']; ?></b><br>
	

	<?php
	$username=$_SESSION['username'];

	$query1="select amount,status from scholarshipdetails where username='$username'";
	$query1_result=mysqli_query($con,$query1);

	while($row = mysqli_fetch_array($query1_result)){

	?>
	<form method="post"  action="status.php" style="font-family:Trebuchet MS;">
	<fieldset><legend style="font-size: 150%; font-family:Trebuchet MS">Scholarship Status</legend>

		<label>Amount Sanctioned:</label>
		<input type="number" name="amount" value="<?php echo $row['amount']; ?>"> <br><br>

		<label>Status:</label>
		<input type="text" name="status" value="<?php echo $row['status']; ?>"> <br> <br>
		<center>
		</center>
	<br>
	</fieldset>

	</form>

	<?php
	}
	?>
	
	<br>
	<form action="homepage.php">
			<center>
				<input type="submit" value="Go to Home" style="font-size: 150%; font-family:Trebuchet MS"> <br><br>
			</center>
	</form>

</body>
</html>