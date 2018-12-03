<?php
session_start();	
include '../functions.php';

if(logged_in()==TRUE){
	if(isset($_POST['post'])){
		$title=$_POST['title'];
		$item=$_POST['item'];
		$desc=$_POST['desc'];
		$country=$_POST['countries'];
		$shopper_id = $_SESSION['id'];

		// print_r($shopper_id);
		// exit();
		
		$connection=mysqli_connect("localhost","root","","buyfromabroad");	
		$query="insert into shopper_post values('', '$title', '$item', '$desc','$country', '$shopper_id', '0', NOW())";
		
		//$new = 'LAST_INSERT_ID()';			
		$result=mysqli_query($connection,$query);
		if( $result ){
			header("location: ../index.php?success");
		}else{
			echo mysqli_error($connection);
		}
		
	}

}			
?>