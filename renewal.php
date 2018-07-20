<?php
	session_start();
	require_once('dbconfig/config.php');
?>
<!DOCTYPE html5>
<html>
<head><title> Renewal </title></head>
<body>
	<label>USERNAME:</label>
	<b><?php echo $_SESSION['username']; ?></b><br><br>

	<form method="post"  action="renewal.php" style="font-family:Trebuchet MS;">
	<fieldset><legend style="font-size: 150%; font-family:Trebuchet MS">Academic Details</legend>
	
	<label>Current Year:</label>
	<input type="number" name="currentyear" placeholder="current year" required>
	<label> No. of Arrears:</label>
	<input type="number" name="arrears" placeholder="Arrears" required><br><br>
	<label>CGPA:</label>
	<input type="number" name="cgpa" placeholder="CGPA"  step="0.01" required><br><br>
	<label>Annual Income:</label>
	<input type="number" name="income" placeholder="Annual Income" required> <br><br> 
	<label>Estimated Expenses for current year:</label>
	<input type="number" name="estimate" placeholder="estimated expenses" required> <br><br>
	</fieldset>
	<br>
	<center>
		<input type="reset" name="Reset" value="Reset" style="font-size: 140%;">
		<button type="submit" name="save" style="font-size: 140%;">Save</button>
	</center>
	<br>
	</form>

	<?php
	$username=$_SESSION['username'];
	if(isset($_POST['save']))
	{
		$currentyear=$_POST['currentyear'];
		$arrears=$_POST['arrears'];
		$cgpa=$_POST['cgpa'];
		$income=$_POST['income'];
		$estimate=$_POST['estimate'];

		$query1 = "update academicdetails set currentyear=$currentyear, arrears=$arrears, cgpa=$cgpa where username='$username'";
		$query1_run = mysqli_query($con,$query1);
		$query2 = "update scholarshipdetails set estimate=$estimate, income=$income where username='$username'";
		$query2_run = mysqli_query($con,$query2);


		if($query1_run && $query2_run)
		{
				echo '<script type="text/javascript"> alert("Details successfully Saved..")</script>';
		}

		 else
		 {
		 	if(!$query1_run)
		 	{
				echo '<script type="text/javascript"> alert("Cannot enter Academic Details..")</script>';
		 	}
		 	if(!$query2_run)
		 	{
				echo '<script type="text/javascript"> alert("Cannot enter income and estimate..")</script>';
		 	}
		 
		 }

	
	$query5="select estimate,income from scholarshipdetails where username='$username'";
	$query5_run=mysqli_query($con,$query5);
	
	while($row = mysqli_fetch_array($query5_run))
	{
		$estimate=$row['estimate'];
		$income=$row['income'];
	}

	$query6="select arrears,cgpa from academicdetails where username='$username'";
	$query6_run=mysqli_query($con,$query6);
	
	while($row = mysqli_fetch_array($query6_run))
	{
		$arrears=$row['arrears'];
		$cgpa=$row['cgpa'];
	}

	
	if($income< 150000 && $arrears == 0 && $cgpa >= 7.0 )
	{
		$amount=$estimate-($income/4);
		$status="approved";
		$query7="update scholarshipdetails set amount=$amount,status='$status' where username='$username'";
		$query7_run=mysqli_query($con,$query7);
	}
	
	else
	{
		$status="not eligible";
		$amount=0;
		$query8="update scholarshipdetails set amount=$amount,status='$status' where username='$username'";
		$query8_run=mysqli_query($con,$query8);

	}
	}
?>
<form action="homepage.php">
			<center>
				<input type="submit" value="Go to Home" style="font-size: 150%; font-family:Trebuchet MS"> <br><br>
			</center>
</form>

</body>
</html>