<?php 
	
	require 'Database.php';
	
	session_start();
	if(!isset($_SESSION["Emp_Id"])){ // if "user" not set,
		session_destroy();
		header('Location: login.php');     // go to login page
		exit;
	}
	
	$Emp_Id = null;
	if ( !empty($_GET['Emp_Id'])) {
		$Emp_Id = $_REQUEST['Emp_Id'];
	}
	
	if ( null==$Emp_Id ) {
		echo "no empId";
		echo exit();
		//header("Location: EmpIndex.php");
	}

	if ( !empty($_POST)) {
		// keep track validation errors
		$Emp_NameError = null;
		$Emp_JobTitleError = null;
		$Emp_PhoneError = null;
		$Emp_EmailError = null;
		$Project_Number = null;
		
		// initialize $_FILES variables
		$fileName = $_FILES['userfile']['name'];
		$tmpName  = $_FILES['userfile']['tmp_name'];
		$fileSize = $_FILES['userfile']['size'];
		$fileType = $_FILES['userfile']['type'];
		$content = file_get_contents($tmpName);
		
	/* 		echo $Emp_Id;
			echo $fileName;
			echo $fileSize;
			echo $fileType;
			echo $content;
			exit(); */
			
		// keep track post values
		$Emp_Name = $_POST['Emp_Name'];
		$Emp_JobTitle = $_POST['Emp_JobTitle'];
		$Emp_Phone = $_POST['Emp_Phone'];
		$Emp_Email = $_POST['Emp_Email'];
		$Project_Number = $_POST['Project_Number'];
	
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
		if (empty($Project_Number)) {
			$Project_NumberError = 'Please enter the project number';
			$valid = false;
		}
			
		// restrict file types for upload
		$types = array('image/jpeg','image/gif','image/png');
		if($filesize > 0) {
			if(in_array($_FILES['userfile']['type'], $types)) {
			}
			else {
				$filename = null;
				$filetype = null;
				$filesize = null;
				$filecontent = null;
				$pictureError = 'improper file type';
				$valid=false;
				}
		}	
			
			
		// update data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE Employees SET Emp_Name = ?, Emp_JobTitle = ?, Emp_Phone =?, Emp_Email = ?, Project_Number = ?, filename = ?, filesize = ?,filecontent = ?  WHERE Emp_Id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($Emp_Name,$Emp_JobTitle,$Emp_Phone,$Emp_Email,$Project_Number,$fileName,$fileSize,$content,$Emp_Id));
		
			
		
			//picture stuff
/* 			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO Pictures (Employee_Id,filename,filesize,filecontent) values(?, ?, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($Emp_Id,$fileName,$fileSize,$content));
			Database::disconnect();
			header("Location: EmpIndex.php"); */
		}
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM Employees where Emp_Id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($Emp_Id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$Emp_Name = $data['Emp_Name'];
		$Emp_JobTitle = $data['Emp_JobTitle'];
		$Emp_Phone = $data['Emp_Phone'];
		$Emp_Email = $data['Emp_Email'];
		$Project_Number = $data['Project_Number'];
		
		
		//display picture
		
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
    		
	    			<form class="form-horizontal" action="EmpUpdate.php?Emp_Id=<?php echo $Emp_Id?>" method="post" enctype="multipart/form-data">
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
					  <div class="control-group <?php echo !empty($Project_NumberError)?'error':'';?>">
                        <label class="control-label">Project Number</label>
                        <div class="controls">
                            <input name="Project_Number" type="text" value="<?php echo !empty($Project_Number)?$Project_number:'';?>">
                            <?php if (!empty($Project_NumberError)): ?>
                                <span class="help-inline"><?php echo $Project_NumberError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
					  
					  <div class="control-group <?php echo !empty($pictureError)?'error':'';?>">
							<label class="control-label">Picture</label>
								<div class="controls">
							<input type="hidden" name="MAX_FILE_SIZE" value="16000000">
							<input name="userfile" type="file" id="userfile">
						
							</div>
						</div>
					  
					    
						  <button type="submit" class="btn btn-success">Update</button>
						
							<div>
							<a class="btn" href="EmpIndex.php">Back</a>
							</div>
					
					</div>
						
					</form>
				</div>
    </div> <!-- /container -->
  </body>
</html>