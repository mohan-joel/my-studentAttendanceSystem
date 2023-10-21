<?php 
	session_start();
	include_once('config.php');
	$id = $_SESSION['ID'];
	$enter_password = md5($_POST['current_password']);
	$query ="select password from users where id='$id'";
	$result = mysqli_query($con,$query);
	$row = mysqli_fetch_assoc($result);
	$real_password = $row['password'];
	$output = "";
	if($enter_password == $real_password){
		echo 1;
	}else{
		echo 0;
	}

?>