<?php

session_start(); 
require 'Database.php';
if ( !empty($_POST)) { // if $_POST filled then process the form
	// initialize $_POST variables
	$Emp_Name = $_POST['Emp_Name']; // Emp_Name is Emp_email address
	$Emp_password = $_POST['Emp_password'];	// verify the Emp_Name/Emp_password
		

	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM Employees WHERE Emp_Name = ? AND Emp_password = ? LIMIT 1";
	$q = $pdo->prepare($sql);
	$q->execute(array($Emp_Name,$Emp_password));
	$data = $q->fetch(PDO::FETCH_ASSOC);
	
	if($data) { // if successful login set session variables
		echo "success!";
		$_SESSION['Emp_Id'] = $data['Emp_Id'];
		$sessionEmp_Id = $data['Emp_Id'];
		$_SESSION['Emp_Name'] = $data['Emp_Name'];
		Database::disconnect();
		header("Location: Index.php");
	}
	else { // otherwise go to login error page
		Database::disconnect();
		header("Location: login_error.html");
	}
} 
// if $_POST NOT filled then display login form, below.
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
	
</head>

<body>
    <div class="container">

		<div class="span10 offset1">
		
			<div class="row">
				<!-- <img src="svsu_fr_logo.png" /> -->
			</div>
		
			<div class="row">
				<h3>Login</h3>
			</div>
	
			<form class="form-horizontal" action="login.php" method="post">
								  
				<div class="control-group">
					<label class="control-label">Emp_Name</label>
					<div class="controls">
						<input name="Emp_Name" type="text"  placeholder="gpcorser" required>
					</div>	<!-- end div: class="controls" -->
				</div> <!-- end div class="control-group" -->
				
				<div class="control-group">
					<label class="control-label">Emp_password</label>
					<div class="controls">
						<input name="Emp_password" type="password" placeholder="remember" required>
					</div>	
				</div> 

				<div class="form-actions">
					<button type="submit" class="btn btn-success">Sign In</button>
					&nbsp; &nbsp;
					<a class="btn btn-primary" href="SignUP.php">Sign Up</a> 
				</div>
				
			</form>
			
		</div> <!-- end div: class="span10 offset1" -->
				
    </div> <!-- end div: class="container" -->

  </body>
  
</html>
	
