<?php
session_start();	
include '../functions.php';

if(logged_in()==TRUE){
	if(isset($_POST)){
		$post_id=$_POST['post_id'];
		$user_id=$_SESSION['id'];
		$comment=$_POST['comment'];
		// print_r($shopper_id);
		// exit();
		
		$connection=mysqli_connect("localhost","root","","buyfromabroad");	
		$query="insert into comments values('', '$comment', '$post_id', '0','$user_id', NOW())";
		
		//$new = 'LAST_INSERT_ID()';			
		$result=mysqli_query($connection,$query);
		if( $result ){
			header("location: ../index.php?comment_success");
		}else{
			echo mysqli_error($connection);
		}
		
	}

}			
?>