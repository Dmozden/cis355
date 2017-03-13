<?php
session_start();
$email = $_POST['email'];
$password = $_POST['password'];
$loginApproved = false;
//find the record with the email address
include 'database.php';
$pdo = Database::connect();
$sql = 'SELECT * FROM customers WHERE email = "' . $email . '"';
foreach ($pdo->query($sql) as $row){
	if (0 == strcmp(trim($row['password']), trim($password))) {
		$loginApproved = true;
		$_SESSION['userid'] = $row['id'];
	}
}
Database::disconnect();
//confirm password equals password in the database
echo $_SESSION['userid'];
header("Location: tutorialoo.php");
?>
