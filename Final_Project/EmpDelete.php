<?php 
	require 'Database.php';
	session_start();
	if(!isset($_SESSION["Emp_Id"])){ // if "user" not set,
	session_destroy();
	header('Location: login.php');     // go to login page
	exit;
	}

	$Emp_Id = 0;
	
	if ( !empty($_GET['Emp_Id'])) {
		$Emp_Id = $_REQUEST['Emp_Id'];
	}
	
	if ( !empty($_POST)) {
		// keep track post values
		$Emp_Id = $_POST['Emp_Id'];
		
		// delete data
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DELETE FROM Employees WHERE Emp_Id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($Emp_Id));
		Database::disconnect();
		header("Location: EmpIndex.php");
		
	} 
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
		    			<h3>Delete a Employee</h3>
		    		</div>    		
	    			<form class="form-horizontal" action="EmpDelete.php" method="post">
	    			  <input type="hidden" name="Emp_Id" value="<?php echo $Emp_Id;?>"/>
					  <p class="alert alert-error">Are you sure to delete ?</p>
					  <div class="form-actions">
						  <button type="submit" class="btn btn-danger">Yes</button>
						  <a class="btn" href="EmpIndex.php">No</a>
						</div>
					</form>
				</div>	
    </div> <!-- /container -->
  </body>
</html>