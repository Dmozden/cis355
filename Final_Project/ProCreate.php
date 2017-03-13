<?php 
	
	require 'Database.php';

	if ( !empty($_POST)) {
		// keep track validation errors
		$Pro_NameError = null;
		$Pro_DescriptionError = null;
		$Pro_ManagerError = null;
		$Pro_ExpectedCompletionDateError = null;
		$Pro_ProgressError = null;
		
		// keep track post values
		$Pro_Name = $_POST['Pro_Name'];
		$Pro_Description = $_POST['Pro_Description'];
		$Pro_Manager = $_POST['Pro_Manager'];
		$Pro_ExpectedCompletionDate = $_POST['Pro_ExpectedCompletionDate'];
		$Pro_Progress = $_POST['Pro_Progress'];
		// validate input
		$valid = true;
		if (empty($Pro_Name)) {
			$Pro_NameError = 'Please enter a project name';
			$valid = false;
		}
		
		if (empty($Pro_Description)) {
			$Pro_DescriptionError = 'Please enter a project description';
			$valid = false;
		}
		
		if (empty($Pro_Manager)) {
			$Pro_ManagerError = 'Please enter a project manager';
			$valid = false;
		}
		
		if (empty($Pro_ExpectedCompletionDate)) {
			$Pro_ExpectedCompletionDateError = 'Please enter a project expected completion date';
			$valid = false;
		}
		
	//	if (empty($Pro_Progress)) {
	//		$Pro_ProgressError = 'Please enter the project progress percent';
	//		$valid = false;
	//	}
		
		// insert data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO Projects (Pro_Name,Pro_Description,Pro_Manager,Pro_ExpectedCompletionDate,Pro_Progress) values(?,?,?,?,?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($Pro_Name,$Pro_Description,$Pro_Manager,$Pro_ExpectedCompletionDate,$Pro_Progress));
			Database::disconnect();
			header("Location: Index.php");
		}
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
                        <h3>Create a Project</h3>
                    </div>
             
                    <form class="form-horizontal" action="ProCreate.php" method="post">
                      <div class="control-group <?php echo !empty($Pro_NameError)?'error':'';?>">
                        <label class="control-label">Project Name</label>
                        <div class="controls">
                            <input name="Pro_Name" type="text"  value="<?php echo !empty($Pro_Name)?$Pro_Name:'';?>">
                            <?php if (!empty($Pro_NameError)): ?>
                                <span class="help-inline"><?php echo $Pro_NameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($Pro_DescriptionError)?'error':'';?>">
                        <label class="control-label">Project Description</label>
                        <div class="controls">
                            <input name="Pro_Description" type="text" value="<?php echo !empty($Pro_Description)?$Pro_Description:'';?>">
                            <?php if (!empty($Pro_DescriptionError)): ?>
                                <span class="help-inline"><?php echo $Pro_DescriptionError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($Pro_ManagerError)?'error':'';?>">
                        <label class="control-label">Project Manager</label>
                        <div class="controls">
                            <input name="Pro_Manager" type="text" value="<?php echo !empty($Pro_Manager)?$Pro_Manager:'';?>">
                            <?php if (!empty($Pro_ManagerError)): ?>
                                <span class="help-inline"><?php echo $Pro_ManagerError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
					  
					   <div class="control-group <?php echo !empty($Pro_ExpectedCompletionDateError)?'error':'';?>">
                        <label class="control-label">Project Expected Completion Date</label>
                        <div class="controls">
                            <input name="Pro_ExpectedCompletionDate" type="text" value="<?php echo !empty($Pro_ExpectedCompletionDate)?$Pro_ExpectedCompletionDate:'';?>">
                            <?php if (!empty($Pro_ExpectedCompletionDateError)): ?>
                                <span class="help-inline"><?php echo $Pro_ExpectedCompletionDateError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
  				   <div class="control-group <?php echo !empty($Pro_ProgressError)?'error':'';?>">
                        <label class="control-label">Project Progress</label>
                        <div class="controls">
                            <input name="Pro_Progress" type="text" value="<?php echo !empty($Pro_Progress)?$Pro_Progress:'';?>">
                            <?php if (!empty($Pro_ProgressError)): ?>
                                <span class="help-inline"><?php echo $Pro_ProgressError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Create</button>
                          <a class="btn" href="Index.php">Back</a>
                        </div>
                    </form>
                </div>
    </div> <!-- /container -->
  </body>
</html>