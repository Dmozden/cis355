<?php 
	require 'Database.php';

	session_start();
	if(!isset($_SESSION["Emp_Id"])){ // if "user" not set,
	session_destroy();
	header('Location: login.php');     // go to login page
	exit;
	}

	$id = null;
	if ( !empty($_GET['Pro_ID'])) {
		$_GET['EmployeeId'];
		$Employee_Id = $_REQUEST['EmployeeId'];
		$Pro_ID = $_REQUEST['Pro_ID'];
		$_Session["CurrentProjects"] = $Pro_ID;
	}

	 	if ( !empty($_GET['EmployeeId'])) {
		$Employee_Id = $_REQUEST['EmployeeId'];
		}	 
		
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM Projects where Pro_ID = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($_Session["CurrentProjects"]));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		Database::disconnect();	
		
						
			
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
    <div class="form-actions">	
    			<div class="span10 offset1">
    				<div class="row">
		    			<h3>Project View</h3>
		    		</div>
		    		<form class="form-horizontal" action="ProRead.php?Pro_ID=<?php echo $Pro_ID?>" method="post">
	    			<div class="form-horizontal" >
					  <div class="control-group">
					    <label class="control-label">Project Name</label>
					    <div class="controls">
						    <label class="checkbox">
						     	<?php echo $data['Pro_Name'];?>
						    </label>
					    </div>
					  </div>
					  <div class="control-group">
					    <label class="control-label">Project Description</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['Pro_Description'];?>
						    </label>
					    </div>
					  </div>
					  <div class="control-group">
					    <label class="control-label">Project Manager</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['Pro_Manager'];?>
						    </label>
					    </div>
					  </div>
					
					   <div class="control-group">
					    <label class="control-label">Project Progress</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['Pro_Progress'];?>
						    </label>
					    </div>
					  </div>
					  </div>
						  <a class="btn" href="Index.php">Back</a>
						 <!-- /add listbox and button to add an employee to the project. -->
						
	
						
					   </div>
					   </form>
					</div>
				</div>
    </div> <!-- /container -->
	<div class="container">
    
    			<div class="span10 offset1">
    				<div class="row">
		    			<h3>Employees on Project</h3>
		    		</div>
		    		
	    			<table class="table table-striped table-bordered">
                
                  <tbody>
				    <?php
							$pdo = Database::connect();
							$sql = 'SELECT * FROM Employees WHERE Project_Number = ' .$Pro_ID.' ORDER BY Emp_Name ASC';
							echo "<select class='form-control' name='person_id' id='Emp_Id'>";
							foreach ($pdo->query($sql) as $row) {
								$rowThing = $row['Emp_Id'];
								if($row['Emp_Id']==$Employee_Id)
									echo "<option selected value='" . $_Session["CurrentProjects"] . " '> " . $row['Emp_Name'] . "</option>";
								else
									echo "<option value='" . $_Session["CurrentProjects"] . " '> " . $row['Emp_Name'] . "</option>";
							}
							echo "</select>";
							Database::disconnect();
							?>
                  <?php
                 
                  /*   $pdo = Database::connect();
		
					$sql = "SELECT Emp_Id,Emp_Name FROM Employees, Projects WHERE Employees.Project_Number = Projects.Pro_ID AND Pro_ID = ". $_Session["CurrentProjects"] ."";
	
					foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
							echo '<td>'. $row['Emp_Name'] . '</td>';
							echo '<td width=250>';
							echo '<a class="btn" href="EmpRead.php?Emp_Id='.$row['Emp_Id'].'">View</a>';
							echo '&nbsp;';
							echo '<a class="btn btn-danger" href="EmpRemoveProject.php?Emp_Id='.$row['Emp_Id'].'">Remove</a>';
							echo '</td>';
                            echo '</tr>';
                   }
                   Database::disconnect();  */
                  ?>
                  </tbody>
            </table>
			</div>
				</div>

				
    </div> <!-- /container -->
	
  </body>
</html>