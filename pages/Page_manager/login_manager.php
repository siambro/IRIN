<?php
	session_start();
	$connection = mysqli_connect("localhost", "root", "", "buyfromabroad");
	
	if(isset($_POST['login'])){
		
		$email = mysqli_real_escape_string($connection, $_POST['email']);
		$password = mysqli_real_escape_string($connection, $_POST['password']);
		// $level = mysqli_real_escape_string($connection, $_POST['level']);
		
		$query2= "select * from user_customer where email = '".$email."' and password = '" .$password. "'";
		$query1= "select * from user_admin where email = '".$email."' and password = '" .$password. "'";
		
		$result2 = mysqli_query($connection, $query2);
		$result1 = mysqli_query($connection, $query1);

		if(mysqli_num_rows($result2)>0){

			$row=mysqli_fetch_array($result2,MYSQLI_ASSOC);
			$id = $row['id'];
			$name = $row['name'];
			$level = $row['level'];

			$_SESSION['login'] = true;

			$_SESSION['id'] = $id;
			$_SESSION['email'] = $email;
			$_SESSION['name'] = $name;
			
			$_SESSION['level'] = $level;
			
			header('location: ../index.php');


		}else if(mysqli_num_rows($result1)>0){
			$row=mysqli_fetch_array($result1,MYSQLI_ASSOC);
			$name = $row['name'];
			$level = $row['level'];

			$_SESSION['login'] = true;
			$_SESSION['email'] = $email;
			$_SESSION['name'] = $name;
			$_SESSION['level'] = $level;

			header('location: ../index.php');
		}else{
			header('location: ../login.php?error');
		}
		
	}
	
?>