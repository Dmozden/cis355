<?php 
	
	require 'Database.php';
	
	$Emp_Id = null;
	if ( !empty($_GET['Emp_Id'])) {
		$Emp_Id = $_REQUEST['Emp_Id'];
	}
	
	if ( null==$Emp_Id ) {
		header("Location: EmpEmpIndex.php");
	}

	if ( !empty($_POST)) {
		// keep track validation errors
		$Emp_NameError = null;
		$Emp_JobTitleError = null;
		$Emp_PhoneError = null;
		$Emp_EmailError = null;
		
		// keep track post values
		$Emp_Name = $_POST['Emp_Name'];
		$Emp_JobTitle = $_POST['Emp_JobTitle'];
		$Emp_Phone = $_POST['Emp_Phone'];
		$Emp_Email = $_POST['Emp_Email'];
	
		// validate input
		$valid = true;
		if (empty($Emp_Name)) {
			$Emp_NameError = 'Please enter a project name';
			$valid = false;
		}
		
		if (empty($Emp_JobTitle)) {
			$Emp_JobTitleError = 'Please enter a project description';
			$valid = false;
		}
		
		if (empty($Emp_Phone)) {
			$Emp_PhoneError = 'Please enter a project manager';
			$valid = false;
		}
		
		if (empty($Emp_Email)) {
			$Emp_EmailError = 'Please enter the project progress percent';
			$valid = false;
		}
			
		// update data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE Employees SET Emp_Name = ?, Emp_JobTitle = ?, Emp_Phone =?, Emp_Email = ? WHERE Emp_Id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($Emp_Name,$Emp_JobTitle,$Emp_Phone,$Emp_Email,$Emp_Id));
			Database::disconnect();
			header("Location: EmpIndex.php");
		}
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM Employees where Emp_Id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($Emp_Id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$Emp_Name = $data['Emp_Name'];
		$Emp_JobTitleError = $data['Emp_JobTitle'];
		$Emp_Phone = $data['Emp_Phone'];
		$Emp_Email = $data['Emp_Email'];
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
		    			<h3>Update a Project</h3>
		    		</div>
    		
	    			<form class="form-horizontal" action="EmpUpdate.php?Emp_Id=<?php echo $Emp_Id?>" method="post">
					  <div class="control-group <?php echo !empty($Emp_NameError)?'error':'';?>">
                        <label class="control-label">Name</label>
                        <div class="controls">
                            <input name="Emp_Name" type="text" value="<?php echo !empty($Emp_Name)?$Emp_Name:'';?>">
                            <?php if (!empty($Emp_NameError)): ?>
                                <span class="help-inline"><?php echo $Emp_NameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($Emp_JobTitleErrorError)?'error':'';?>">
                        <label class="control-label">Job Title</label>
                        <div class="controls">
                            <input name="Emp_JobTitle" type="text" value="<?php echo !empty($Emp_JobTitle)?$Emp_JobTitle:'';?>">
                            <?php if (!empty($Emp_JobTitleError)): ?>
                                <span class="help-inline"><?php echo $Emp_JobTitleError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($Emp_PhoneError)?'error':'';?>">
                        <label class="control-label">Phone</label>
                        <div class="controls">
                            <input name="Emp_Phone" type="text" value="<?php echo !empty($Emp_Phone)?$Emp_Phone:'';?>">
                            <?php if (!empty($Emp_PhoneError)): ?>
                                <span class="help-inline"><?php echo $Emp_PhoneError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
					  
					  <div class="control-group <?php echo !empty($Emp_EmailError)?'error':'';?>">
                        <label class="control-label">Email</label>
                        <div class="controls">
                            <input name="Emp_Email" type="text" value="<?php echo !empty($Emp_Email)?$Emp_Email:'';?>">
                            <?php if (!empty($Emp_EmailError)): ?>
                                <span class="help-inline"><?php echo $Emp_EmailError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
					   <div class="form-actions">
						  <button type="submit" class="btn btn-success">Update</button>
						  <a class="btn" href="EmpIndex.php">Back</a>
						</div>
					</form>
				</div>
    </div> <!-- /container -->
  </body>
</html>