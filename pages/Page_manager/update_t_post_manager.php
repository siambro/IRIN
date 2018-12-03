<?php
session_start();	
include '../functions.php';

	if(isset($_POST['update'])){	
		$id=$_POST['id'];
		
		$title=$_POST['title'];
		$desc=$_POST['desc'];
		$country=$_POST['countries'];
		$going_date=$_POST['datetimes'];

		$traveller_id = $_SESSION['id'];

		
		$con=mysqli_connect("localhost", "root", "" , "buyfromabroad");
		$query="update traveller_post set title='$title', description='$desc', going_country='$country', going_date='$going_date', t_id='$traveller_id', timestamp=NOW() where id='$id'";
		if(mysqli_query($con,$query)){
			header("location: ../profile.php?user_id=$traveller_id&update_post_success");
		}else{
			echo mysqli_error($con);
		}
	}else{
		mysqli_error($con);
	}
?>