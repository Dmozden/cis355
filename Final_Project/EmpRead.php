<?php 
	require 'Database.php';
	$id = null;
	if ( !empty($_GET['Emp_Id'])) {
		$Emp_Id = $_REQUEST['Emp_Id'];
	}
	
	if ( null==$Emp_Id) {
		header("Location: EmpIndex.php");
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM Employees where Emp_Id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($Emp_Id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		Database::disconnect();
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
		    			<h3>Read a Employee</h3>
		    		</div>
		    		
	    			<div class="form-horizontal" >
					  <div class="control-group">
					    <label class="control-label">Employee Name</label>
					    <div class="controls">
						    <label class="checkbox">
						     	<?php echo $data['Emp_Name'];?>
						    </label>
					    </div>
					  </div>
					  <div class="control-group">
					    <label class="control-label">Job Title</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['Emp_JobTitle'];?>
						    </label>
					    </div>
					  </div>
					  <div class="control-group">
					    <label class="control-label">Phone</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['Emp_Phone'];?>
						    </label>
					    </div>
					  </div>
					   <div class="control-group">
					    <label class="control-label">Email</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['Emp_Email'];?>
						    </label>
					    </div>
					  </div>
					   </div>
					   
					   <div class="form-actions">
						  <a class="btn" href="EmpIndex.php">Back</a>
					   </div>
							 
					</div>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>