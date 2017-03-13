<?php 
	
	require 'database.php';

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
		
		// insert data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO events (event_date,event_time,event_location,event_description) values(?, ?, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($event_date,$event_time,$event_location,$event_description));
			Database::disconnect();
			header("Location: index.php");
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
		    			<h3>Create a event</h3>
		    		</div>
    		
	    			<form class="form-horizontal" action="create.php" method="post">
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
						  <button type="submit" class="btn btn-success">Create</button>
						  <a class="btn" href="index.php">Back</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>