<?php  
session_start();	
include '../functions.php';

 	$email = $_GET['email'];
	$connect = mysqli_connect("localhost", "root", "", "buyfromabroad"); 
 	$query = "SELECT * FROM user_customer WHERE email = '".$email."'";
 	$result = mysqli_query($connect, $query);
 	if (mysqli_num_rows($result) > 0) {
 		echo "200";
 	}else{
 		echo "404";
 	}

?>