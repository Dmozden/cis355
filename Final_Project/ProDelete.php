<?php 
	require 'Database.php';
	$Pro_ID = 0;
	
	if ( !empty($_GET['Pro_ID'])) {
		$Pro_ID = $_REQUEST['Pro_ID'];
	}
	
	if ( !empty($_POST)) {
		// keep track post values
		$Pro_ID = $_POST['Pro_ID'];
		
		// delete data
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DELETE FROM Projects WHERE Pro_ID = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($Pro_ID));
		Database::disconnect();
		header("Location: Index.php");
		
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
		    			<h3>Delete a Project</h3>
		    		</div>    		
	    			<form class="form-horizontal" action="ProDelete.php" method="post">
	    			  <input type="hidden" name="Pro_ID" value="<?php echo $Pro_ID;?>"/>
					  <p class="alert alert-error">Are you sure to delete ?</p>
					  <div class="form-actions">
						  <button type="submit" class="btn btn-danger">Yes</button>
						  <a class="btn" href="Index.php">No</a>
						</div>
					</form>
				</div>	
    </div> <!-- /container -->
  </body>
</html>