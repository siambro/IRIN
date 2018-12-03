<?php
session_start();	
include '../functions.php';

if(logged_in()==TRUE){

	if(isset($_POST)){
		$post_id=$_POST['post_id'];
		$user_id=$_SESSION['id'];
		// print_r($shopper_id);
		// exit();
		
		$connection=mysqli_connect("localhost","root","","buyfromabroad");	
		$query="insert into s_post_bid values('', '$post_id', '$user_id', NOW())";
		
		//$new = 'LAST_INSERT_ID()';			
		$result=mysqli_query($connection,$query);
		if( $result ){
			header("location: ../index.php?bid_success");
		}else{
			echo mysqli_error($connection);
		}
		
	}

}			
?>