<!DOCTYPE html>
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
                <h3>Employees</h3>
            </div>
            <div class="row">
                <p>
                    <a href="EmpCreate.php" class="btn btn-success">Create</a>
					<a href="Index.php" class="btn btn-primary">Project View</a>
                </p>
				<table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Employee Name</th>
                      <th>Job Title</th>
                      <th>Phone</th>
					  <th>Email</th>
					  <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   include 'Database.php';
                   $pdo = Database::connect();
                   $sql = 'SELECT * FROM Employees ORDER BY Emp_Id DESC';
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['Emp_Name'] . '</td>';
                            echo '<td>'. $row['Emp_JobTitle'] . '</td>';
                            echo '<td>'. $row['Emp_Phone'] . '</td>';
							echo '<td>'. $row['Emp_Email'] . '</td>';
							echo '<td width=250>';
							echo '<a class="btn" href="EmpRead.php?Emp_Id='.$row['Emp_Id'].'">View</a>';
							echo '&nbsp;';
							echo '<a class="btn btn-success" href="EmpUpdate.php?Emp_Id='.$row['Emp_Id'].'">Update</a>';
							echo '&nbsp;';
							echo '<a class="btn btn-danger" href="EmpDelete.php?Emp_Id='.$row['Emp_Id'].'">Delete</a>';
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