<?php
session_start(); //required for every php file

if(empty($_SESSION['userid'])){
	    login();
	}

function login(){
	echo '<form action="demo_form.php" method="POST">';
	echo '<p>username: (email):';
	echo '<input type="text" name="email"><br>';
	echo '<p>Password:';
	echo '<input type="password" name="password"><br>';
	echo '<input type="submit" value="submit">';
	echo '</form>';
};

include 'database.php';
include 'customers.php';
Customers::displayListScreen();
?>