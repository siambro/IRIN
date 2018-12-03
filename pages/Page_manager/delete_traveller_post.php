<?php
session_start();	
include '../functions.php';

if(logged_in()==TRUE){
	// if(isset($_POST['post'])){
		$u_id=$_GET['post_id'];
		$id=$_SESSION['id'];

		// print_r($u_id) ;
		// exit();
		
		$connection=mysqli_connect("localhost","root","","buyfromabroad");	
		$query="delete from traveller_post where id='$u_id'";
		//$new = 'LAST_INSERT_ID()';			
		$result=mysqli_query($connection,$query);
		if( $result ){
			header("location: ../profile.php?user_id=$id&del_success");
		}else{
			echo mysqli_error($connection);
		}
		
	// }

}			
?>