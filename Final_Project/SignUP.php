<?php 
	require 'Database.php';
	if ( !empty($_POST)) {
		// keep track validation errors
		$Emp_IdError = null;
		$Emp_NameError = null;
		$Emp_PasswordError = null;
		// keep track post values
		$Emp_Id = $_POST['Emp_Id'];
		$Emp_Name = $_POST['Emp_Name'];
		$Emp_Password = $_POST['Emp_Password'];
		// validate input
		$valid = true;
		if (empty($Emp_Name)) {
			$Emp_NameError = 'Please enter an Employee name';
			$valid = false;
		}
		if (empty($Emp_Password)) {
			$Emp_PasswordError = 'Please enter an Employee Password';
			$valid = false;
		}
		// insert data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO Employees (Emp_Name,Emp_Password) values(?,?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($Emp_Name,$Emp_Password));
			Database::disconnect();
			header("Location: EmpIndex.php");
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
                        <h3>Create a Employee</h3>
                    </div>
             
                    <form class="form-horizontal" action="SignUP.php" method="post">
                      <div class="control-group <?php echo !empty($Emp_NameError)?'error':'';?>">
                        <label class="control-label">Employee Name</label>
                        <div class="controls">
                            <input name="Emp_Name" type="text"  value="<?php echo !empty($Emp_Name)?$Emp_Name:'';?>">
                            <?php if (!empty($Emp_NameError)): ?>
                                <span class="help-inline"><?php echo $Emp_NameError;?></span>
                            <?php endif; ?>
                        </div>
             
					  <div class="control-group <?php echo !empty($Emp_PasswordError)?'error':'';?>">
                        <label class="control-label">Password</label>
                        <div class="controls">
                            <input name="Emp_Password" type="text" value="<?php echo !empty($Emp_Password)?$Emp_Password:'';?>">
                            <?php if (!empty($Emp_PasswordError)): ?>
                                <span class="help-inline"><?php echo $Emp_PasswordError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
					  
  				      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Create</button>
                          <a class="btn" href="login.php">Back</a>
                        </div>
                    </form>
                </div>
    </div> <!-- /container -->
  </body>
</html>