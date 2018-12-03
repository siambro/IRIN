<?php
session_start();	
include '../functions.php';

		$postid=$_GET['post_id'];
		$bidderid=$_GET['bidder_id'];
		
		$shopper_id = $_SESSION['id'];

		
		$con=mysqli_connect("localhost", "root", "" , "buyfromabroad");
		$query="update shopper_post set bidder_id='$bidderid' where id='$postid'";
		if(mysqli_query($con,$query)){
			header("location: ../profile.php?user_id=$shopper_id&confirm_bidder_success");
		}else{
			echo mysqli_error($con);
		}

?>