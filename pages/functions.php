<?php
	function logged_in(){
		return (isset($_SESSION['login'])) ? true : false;
	}
	
	
	function protect_page(){
		if (logged_in()===false ){
			header('location:login.php');
		}
	}

	// function protect_page_index(){
	// 	if (logged_in()===false ){
	// 		header('location:login.php');
	// 	}
	// }

	function protect_page_redirect(){
		if (logged_in()===true ){
			if($_SESSION['level'] =="shopper"){
				header('location: index.php');
			}else if($_SESSION['level'] =="traveller"){
				header('location: index.php');
			}else{
				header('location: index.php');
			}
		}
	}

	function protect_page_shopper(){
		if ($_SESSION['level'] !="shopper"){
			session_destroy();
			header('location: ../login.php');
		}
	}

	function protect_page_traveller(){
		if ($_SESSION['level'] !="traveller"){
			session_destroy();
			header('location: ../login.php');
		}
	}

?>