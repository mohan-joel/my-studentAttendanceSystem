<?php 
	session_start();
	include_once('config.php');
	$id = $_SESSION['ID'];
	$new_password = md5($_POST['new_password']);
	$query = "update users set password='$new_password' where id='$id'";
	$result = mysqli_query($con,$query);
	if($result){
		echo 1;
		session_destroy();
	}else{
		echo 0;
	}

?>