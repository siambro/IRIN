<?php
session_start();	
include '../functions.php';

if(logged_in()==TRUE){
	if(isset($_POST['post'])){
		$title=$_POST['title'];
		$desc=$_POST['desc'];
		$country=$_POST['countries'];
		$going_date=$_POST['datetimes'];

		$traveller_id = $_SESSION['id'];

		// print_r($traveller_id) ;
		// exit();
		
		$connection=mysqli_connect("localhost","root","","buyfromabroad");	
		$query="insert into traveller_post values('', '$title', '$desc','$country','$going_date', '$traveller_id', NOW())";
		
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