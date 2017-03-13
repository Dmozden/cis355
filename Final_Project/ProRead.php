<?php 
	require 'Database.php';
	$id = null;
	if ( !empty($_GET['Pro_ID'])) {
		$Pro_ID = $_REQUEST['Pro_ID'];
	}
	
	if ( null==$Pro_ID) {
		header("Location: Index.php");
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM Projects where Pro_ID = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($Pro_ID));
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
		    			<h3>Read a Project</h3>
		    		</div>
		    		
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
					    <label class="control-label">Project Expected Completion Date</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['Pro_ExpectedCompletionDate'];?>
						    </label>
					    </div>
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
					   <div class="form-actions">
						  <a class="btn" href="Index.php">Back</a>
					   </div>
							 
					</div>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>