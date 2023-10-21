<?php 
	session_start();
	include_once('config.php');
	$id = $_SESSION['ID'];
	$name = $_POST['name'];
	$email = $_POST['email'];
	$address = $_POST['address'];
	$contact = $_POST['contact'];
	$query = "update users set name='$name', email='$email', address='$address', contact='$contact' where id='$id'";
	$result = mysqli_query($con,$query);
	if($result){
		echo 1;
		session_destroy();
	}else{
		echo 0;
	}
?>