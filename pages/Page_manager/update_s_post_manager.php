<?php
session_start();	
include '../functions.php';

	if(isset($_POST['s_update'])){	
		
		$id=$_POST['id'];
		
		$title=$_POST['title'];
		$items=$_POST['item'];
		$desc=$_POST['desc'];
		$country=$_POST['countries'];
		
		$shopper_id = $_SESSION['id'];

		
		$con=mysqli_connect("localhost", "root", "" , "buyfromabroad");
		$query="update shopper_post set title='$title', items='$items', description='$desc', choose_country='$country', c_id='$shopper_id', timestamp=NOW() where id='$id'";
		if(mysqli_query($con,$query)){
			header("location: ../profile.php?user_id=$shopper_id&update_s_post_success");
		}else{
			echo mysqli_error($con);
		}
	}else{
		mysqli_error($con);
	}
?>