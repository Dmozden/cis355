<?php
require 'Database.php';
	session_start();
	if(!isset($_SESSION["Emp_Id"])){ // if "user" not set,
	session_destroy();
	header('Location: login.php');     // go to login page
	exit;
	}
	$pdo = Database::connect();
	if($_GET['id']) 
		$sql = "SELECT * from Employees WHERE Emp_Id=" . $_GET['id']; 
	else
		$sql = "SELECT * from Employees";
	$arr = array();
	foreach ($pdo->query($sql) as $row) {
		array_push($arr, $row['Emp_Name']);
	}
	Database::disconnect();
	echo '{"names":' . json_encode($arr) . '}';
?>
				