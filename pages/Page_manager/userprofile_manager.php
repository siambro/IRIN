<?php
session_start();	
include '../functions.php';

if(logged_in()==TRUE){
	if(isset($_POST['post'])){

		$phone=$_POST['phone'];
		$edu=$_POST['education'];
		$add1=$_POST['address1'];
		$add2=$_POST['address2'];
		$nid=$_POST['nid'];
		$desc=$_POST['desc'];
		$u_id=$_SESSION['id'];

		
		// print_r($traveller_id) ;
		// exit();
		
		$connection=mysqli_connect("localhost","root","","buyfromabroad");	
		$query="insert into about_user values('', '$phone','$add1', '$add2', '$edu', '$desc', '$nid', '$u_id')";
		
		//$new = 'LAST_INSERT_ID()';			
		$result=mysqli_query($connection,$query);
		if( $result ){
			header("location: ../profile.php?user_id=$u_id&success");
		}else{
			echo mysqli_error($connection);
		}
		
	}

}			
?>