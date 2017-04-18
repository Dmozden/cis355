<!DOCTYPE html>
<?php
	session_start();
	if(!isset($_SESSION["Emp_Id"])){ // if "user" not set,
	session_destroy();
	header('Location: login.php');     // go to login page
	exit;
	}
?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
 
<body>
				
    <div class="container">
		<div class="row">
	
		</div>
            <div class="row">
                <h3>Projects</h3>
            </div>
            <div class="row">
                <p>
                    <a href="ProCreate.php" class="btn btn-success">Create</a>
					<a href="EmpIndex.php" class="btn btn-primary">Employee View</a>
						<a href="upload.php" class="btn btn-primary">Upload Picture</a>
                </p>
				<table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Project Name</th>
                      <th>Project Description</th>
                      <th>Project Manager</th>
					  <th>Project Progress</th>
					  <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   include 'Database.php';
                   $pdo = Database::connect();
                   $sql = 'SELECT * FROM Projects ORDER BY Pro_ID DESC';
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['Pro_Name'] . '</td>';
                            echo '<td>'. $row['Pro_Description'] . '</td>';
                            echo '<td>'. $row['Pro_Manager'] . '</td>';
							echo '<td>'. $row['Pro_Progress'] . '</td>';
							echo '<td width=250>';
							echo '<a class="btn" href="ProRead.php?Pro_ID='.$row['Pro_ID'].'">View</a>';
							echo '&nbsp;';
							echo '<a class="btn btn-success" href="ProUpdate.php?Pro_ID='.$row['Pro_ID'].'">Update</a>';
							echo '&nbsp;';
							echo '<a class="btn btn-danger" href="ProDelete.php?Pro_ID='.$row['Pro_ID'].'">Delete</a>';
							echo '</td>';
                            echo '</tr>';
                   }
                   Database::disconnect();
                  ?>
				 
                  </tbody>
            </table>
        </div>
    </div> <!-- /container -->
  </body>
</html>