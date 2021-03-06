<?php 
	
	require 'database.php';

	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	
	if ( null==$id ) {
		header("Location: index.php");
	}
	
	if ( !empty($_POST)) {
		// keep track validation errors
		$event_dateError = null;
		$event_timeError = null;
		$event_locationError = null;
		$event_descriptionError = null;
		
		// keep track post values
		$event_date = $_POST['event_date'];
		$event_time = $_POST['event_time'];
		$event_location = $_POST['event_location'];
		$event_description = $_POST['event_description'];
		
		// validate input
		$valid = true;
		if (empty($event_date)) {
			$event_dateError = 'Please enter event date';
			$valid = false;
		}
		
		if (empty($event_time)) {
			$event_timeError = 'Please enter Event time';
			$valid = false;
		}
		
		if (empty($event_location)) {
			$event_locationError = 'Please enter event location';
			$valid = false;
		}
		
		if (empty($event_description)) {
			$event_descriptionError = 'Please enter event description';
			$valid = false;
		}
		
		// update data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE events set event_date = ?, event_time = ?, event_location = ?, event_description = ? WHERE id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($event_date,$event_time,$event_location,$event_description,$id));
			Database::disconnect();
			header("Location: index.php");
		}
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM events where id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$event_date = $data['event_date'];
		$event_time = $data['event_time'];
		$event_location = $data['event_location'];
		$event_description = $data['event_description'];
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
		    			<h3>Update a Customer</h3>
		    		</div>
    		
	    			<form class="form-horizontal" action="update.php?id=<?php echo $id?>" method="post">
					  <div class="control-group <?php echo !empty($event_dateError)?'error':'';?>">
					    <label class="control-label">Event Date</label>
					    <div class="controls">
					      	<input name="event_date" type="text"  placeholder="event_date" value="<?php echo !empty($event_date)?$event_date:'';?>">
					      	<?php if (!empty($event_dateError)): ?>
					      		<span class="help-inline"><?php echo $event_dateError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($event_timeError)?'error':'';?>">
					    <label class="control-label">Event time</label>
					    <div class="controls">
					      	<input name="event_time" type="text" placeholder="event_time" value="<?php echo !empty($event_time)?$event_time:'';?>">
					      	<?php if (!empty($event_timeError)): ?>
					      		<span class="help-inline"><?php echo $event_timeError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($event_locationError)?'error':'';?>">
					    <label class="control-label">event Location</label>
					    <div class="controls">
					      	<input name="event_location" type="text"  placeholder="event_location" value="<?php echo !empty($event_location)?$event_location:'';?>">
					      	<?php if (!empty($event_locationError)): ?>
					      		<span class="help-inline"><?php echo $event_locationError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($event_descriptionError)?'error':'';?>">
					    <label class="control-label">event description</label>
					    <div class="controls">
					      	<input name="event_description" type="text"  placeholder="event_description" value="<?php echo !empty($event_description)?$event_description:'';?>">
					      	<?php if (!empty($event_descriptionError)): ?>
					      		<span class="help-inline"><?php echo $event_descriptionError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Update</button>
						  <a class="btn" href="index.php">Back</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>