<?php 
	include_once('config.php');
	require "functions.php";
	$id = $_GET['id'];
	$query = "delete from users where id='$id'";
	$result = mysqli_query($con,$query);
	if($result){
		redirect("show-teachers.php","Teacher's data deleted Successfully!!!");
	}else{
		redirect("show-teachers.php","Unable to delete teacher's data");
	}

?>