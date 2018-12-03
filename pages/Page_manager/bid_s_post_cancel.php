<?php
session_start();	
include '../functions.php';

if(logged_in()==TRUE){

	if(isset($_POST)){

		$post_id=$_POST['post_id'];
		$user_id=$_SESSION['id'];


		$connection=mysqli_connect("localhost","root","","buyfromabroad");	
		$query_s_post_bid="select * 
                          from s_post_bid 
                          where post_id = '".$post_id."'
                          and t_id='".$user_id."'"
                          ;
		$result_bid=mysqli_query($connection,$query_s_post_bid);
		$bid_info=mysqli_fetch_array($result_bid, MYSQLI_ASSOC);
		
		$bid_id = $bid_info['id'];

		// print_r($bid_id);
		// exit();
		
		

		$query="delete from s_post_bid where id='$bid_id'";
		$result=mysqli_query($connection,$query);
		if( $result ){
			header("location: ../index.php?user_id=$user_id&cancel_bid_success");
		}else{
			echo mysqli_error($connection);
		}
		
	}

}			
?>