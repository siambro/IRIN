<?php
session_start();	
include '../functions.php';

	if(isset($_POST['signup'])){
		$name=$_POST['name'];
		$email=$_POST['email'];
		$pass=$_POST['pass'];
		$cpass=$_POST['cpass'];
		$type = $_POST['type'];

		// print_r($type);
		// exit();
		if($pass === $cpass){

			$connection=mysqli_connect("localhost","root","","buyfromabroad");	
			$query="insert into user_customer values('', '$name', '$email', '$pass','$type')";
			
			//$new = 'LAST_INSERT_ID()';			
			$result=mysqli_query($connection,$query);
			if( $result ){
				header("location: ../login.php");
			}else{
				echo mysqli_error($connection);
			}

		}else{
			header("location: ../register.php?error");
		}
		
		
		
	}
		
?>