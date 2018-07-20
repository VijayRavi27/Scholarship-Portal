<?php
	session_start();
	require_once('dbconfig/config.php');
?>
<!DOCTYPE html5>
<html>
<head><title> Enter Details </title></head>
<body>
	<label>USERNAME:</label>
	<b><?php echo $_SESSION['username']; ?></b><br><br>
	<form method="post"  action="enterdetails.php" style="font-family:Trebuchet MS;">
<fieldset><legend style="font-size: 150%; font-family:Trebuchet MS">Personal Details</legend>

<label>First Name:</label>
<input type="text" name="firstname" placeholder="first name" required>     
<label>Last Name:</label>
<input type="text" name="lastname" placeholder="last name" required><br><br>
<label>Email id:</label>
<input type="email" name="email" placeholder="email id" required> <br><br>
<label>Father's Name:</label>
<input type="text" name="fathername" placeholder="Father's Name" required>
<label>Mother's Name:</label>
<input type="text" name="mothername" placeholder="Mother's Name" required> <br><br> 
<label>Annual Income:</label>
<input type="number" name="income" placeholder="Annual Income" required> <br><br> 
<label>Date Of Birth:</label>
<input type="text" name="dob" placeholder="YYYY-MM-DD" required>
<label>Age:</label>
<input type="number" step="0.01" name="age" placeholder="Age" required> <br><br>
<label>Mobile number:</label>
<input type="tel" name="mobileno" placeholder="mobile number" required> <br> <br>
<label>Address:</label>
<input type="text" name="address" placeholder="Address" required> <br><br> 

</fieldset>
<br><br>

<fieldset><legend style="font-size: 150%; font-family:Trebuchet MS">Academic Details</legend>
<label>College Name:</label>
<input type="text" name="college" placeholder="College Name" required><br><br>
<label>Course:</label>
<input type="text" name="course" placeholder="BE/ME/BSc/MSc" required><br><br>
<label>Department:</label>
<input type="text" name="dept" placeholder="dept" required><br><br>
<label>Year Of Joining:</label>
<input type="number" name="yearofjoining" placeholder="year of joining" required>
<label>Year Of leaving:</label>
<input type="number" name="yearofleaving" placeholder="year of leaving" required><br><br>
<label>Current Year:</label>
<input type="number" name="currentyear" placeholder="current year" required><br><br>
<label>Estimated Expenses for current year:</label>
<input type="number" name="estimate" placeholder="estimated expenses" required> <br><br>
<label> No. of Arrears:</label>
<input type="number" name="arrears" placeholder="Arrears" required><br><br>
<b>Note: First year students can enter class 12 (or equivalent) percentage/10 for CGPA</b><br> 
<label>CGPA:</label>
<input type="number" name="cgpa" placeholder="CGPA"  step="0.01" required><br><br>
</fieldset>

<br><br>
<fieldset><legend style="font-size: 150%; font-family:Trebuchet MS">Bank Account Details</legend>

<label>Account Number:</label>
<input type="number" name="accno" placeholder="Account Number" required><br><br>
<label>Account Holder's Name:</label>
<input type="text" name="name" placeholder="Account Holder's Name" required><br><br>
<label>Bank's Name:</label>
<input type="text" name="bank" placeholder="Bank's Name" required>
<label>Bank Branch:</label>
<input type="text" name="branch" placeholder="branch" required><br><br>
<label>IFSC Code:</label>
<input type="text" name="IFSC" placeholder="IFSC" required>
<br><br>
</fieldset>
<br><br>
<center>
	<input type="reset" name="reset" value="Reset" style="font-size: 140%;">
	<button type="submit" name="save" style="font-size: 140%;">Save</button>
</center>
<br>
</form>
<?php
	$username=$_SESSION['username'];
	if(isset($_POST['save']))
	{
		$firstname=$_POST['firstname'];
		$lastname=$_POST['lastname'];
		$email=$_POST['email'];
		$fathername=$_POST['fathername'];
		$mothername=$_POST['mothername'];
		$income=$_POST['income'];
		$dob=$_POST['dob'];
		$age=$_POST['age'];
		$mobileno=$_POST['mobileno'];
		$address=$_POST['address'];
		$college=$_POST['college'];
		$course=$_POST['course'];
		$dept=$_POST['dept'];
		$yearofleaving=$_POST['yearofleaving'];
		$yearofjoining=$_POST['yearofjoining'];
		$currentyear=$_POST['currentyear'];
		$estimate=$_POST['estimate'];
		$arrears=$_POST['arrears'];
		$cgpa=$_POST['cgpa'];
		$accno=$_POST['accno'];
		$name=$_POST['name'];
		$bank=$_POST['bank'];
		$branch=$_POST['branch'];
		$IFSC=$_POST['IFSC'];

		$query1 = "insert into personaldetails(username, firstname, lastname, email, fathername, mothername, dob,	age, mobileno, address) values('$username','$firstname','$lastname','$email','$fathername','$mothername','$dob','$age','$mobileno','$address')";
		$query1_run = mysqli_query($con,$query1);

		$query2 = "insert into academicdetails(username, college, course, dept, yearofjoining, yearofleaving, currentyear, arrears, cgpa) values('$username','$college', '$course','$dept','$yearofjoining','$yearofleaving','$currentyear','$arrears','$cgpa')";
		$query2_run = mysqli_query($con,$query2);

		$query3 = "insert into bankdetails(username, accno, name, bank, branch, IFSC) values('$username','$accno','$name','$bank','$branch','$IFSC')";
		$query3_run = mysqli_query($con,$query3);

		$query4 = "insert into scholarshipdetails(username, estimate, income) values('$username','$estimate', '$income')";
		$query4_run = mysqli_query($con,$query4);

		if($query1_run && $query2_run && $query3_run && $query4_run)
		{
				echo '<script type="text/javascript"> alert("Details successfully Saved..")</script>';
		}
		else
		{
			if(!$query1_run)
			{
				echo '<script type="text/javascript"> alert("Cannot enter Personal Details..")</script>';
			}
		
			if(!$query2_run)
			{
				echo '<script type="text/javascript"> alert("Cannot enter Academic Details..")</script>';
			}
			if(!$query3_run)
			{
				echo '<script type="text/javascript"> alert("Cannot enter Bank Details..")</script>';
			}

			if(!$query4_run)
			{
				echo '<script type="text/javascript"> alert("Cannot enter Scholarship Details..")</script>';
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

	$amount=0;
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