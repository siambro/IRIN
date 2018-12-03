<?php
session_start();	
include '../functions.php';

	if(isset($_POST['update'])){	
		$id=$_POST['id'];
		
		$phone=$_POST['phone'];
		$edu=$_POST['education'];
		$add1=$_POST['address1'];
		$add2=$_POST['address2'];
		$nid=$_POST['nid'];
		$desc=$_POST['desc'];
		$u_id=$_SESSION['id'];

		
		$con=mysqli_connect("localhost", "root", "" , "buyfromabroad");
		$query="update about_user set phone='$phone', address1='$add1', address2='$add2', education='$edu', description='$desc', nid='$nid' where id='$id'";
		if(mysqli_query($con,$query)){
			header("location: ../profile.php?user_id=$u_id&update_success");
		}else{
			
			echo 'mysqli_error($con)';
		}
	}else{
		mysqli_error($conn);
	}
?>