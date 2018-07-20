<?php
	session_start();
	require_once('dbconfig/config.php');
?>
<!DOCTYPE html5>
<html>
<head><title> Edit Details </title></head>
<body>
	<label>USERNAME:</label>
	<b><?php echo $_SESSION['username']; ?></b><br><br>

	<?php
	$username=$_SESSION['username'];

	$query1="select email,mobileno,address from personaldetails where username='$username'";
	$query1_result=mysqli_query($con,$query1);

	while($row = mysqli_fetch_array($query1_result)){

	?>
	<form method="post"  action="editdetails.php" style="font-family:Trebuchet MS;">
	<fieldset><legend style="font-size: 150%; font-family:Trebuchet MS">Personal Details</legend>

		<label>Email id:</label>
		<input type="email" name="email" value="<?php echo $row['email']; ?>"> <br><br>

		<label>Mobile number:</label>
		<input type="tel" name="mobileno" value="<?php echo $row['mobileno']; ?>"> <br> <br>
		<label>Address:</label>
		<input type="text" name="address" value="<?php echo $row['address']; ?>"> <br><br> 
	
		<center>
		<input type="reset" name="Reset" value="Reset" style="font-size: 140%;">
		<button type="submit" name="save1" style="font-size: 140%;">Save</button>
	</center>
	<br>
	</fieldset>

	</form>
	<?php
	}

	$query2="select accno,name,bank,branch,IFSC from bankdetails where username='$username'";
	$query2_result=mysqli_query($con,$query2);

	while($row = mysqli_fetch_array($query2_result)){

	?>
	<form method="post"  action="editdetails.php" style="font-family:Trebuchet MS;">
	<fieldset><legend style="font-size: 150%; font-family:Trebuchet MS">Bank Details</legend>
	
		<label>Account Number:</label>
		<input type="number" name="accno"  value="<?php echo $row['accno']; ?>"><br><br>
		<label>Account Holder's Name:</label>
		<input type="text" name="name" value="<?php echo $row['name']; ?>"><br><br>
		<label>Bank's Name:</label>
		<input type="text" name="bank" value="<?php echo $row['bank']; ?>">
		<label>Bank Branch:</label>
		<input type="text" name="branch" value="<?php echo $row['branch']; ?>"><br><br>
		<label>IFSC Code:</label>
		<input type="text" name="IFSC" value="<?php echo $row['IFSC']; ?>"><br><br>
		
		<center>
		<input type="reset" name="Reset" value="Reset" style="font-size: 140%;">
		<button type="submit" name="save2" style="font-size: 140%;">Save</button>
	</center>
	<br>
	</fieldset>
	</form>
	<?php
	}
	?>
	
<?php
	$username=$_SESSION['username'];
	if(isset($_POST['save1']))
	{
		$email=$_POST['email'];
		$mobileno=$_POST['mobileno'];
		$address=$_POST['address'];
		

		$query3 = "update personaldetails set email='$email', mobileno=$mobileno, address='$address' where username='$username'";
		$query3_run = mysqli_query($con,$query3);

	
		if($query3_run)
		{
			echo '<script type="text/javascript"> alert("Details successfully Saved..")</script>';
		}

		else
		{
			echo '<script type="text/javascript"> alert("Cannot alter Personal Details..")</script>';
		}
	}
		
	if(isset($_POST['save2']))
	{
		$accno=$_POST['accno'];
		$name=$_POST['name'];
		$bank=$_POST['bank'];
		$branch=$_POST['branch'];
		$IFSC=$_POST['IFSC'];	

		$query4 = "update bankdetails set accno=$accno, name='$name', bank='$bank', branch='$branch', IFSC='$IFSC' where username='$username'";
		$query4_run = mysqli_query($con,$query4);
	

 		if($query4_run)
 		{
 			echo '<script type="text/javascript"> alert("Details successfully Saved..")</script>';
	
 		}
 		else
		{
			echo '<script type="text/javascript"> alert("Cannot alter Bank Details")</script>';
		}
		 
	}
?>

<br>
<form action="homepage.php">
			<center>
				<input type="submit" value="Go to Home" style="font-size: 150%; font-family:Trebuchet MS"> <br><br>
			</center>
</form>
<br>
</body>
</html>
