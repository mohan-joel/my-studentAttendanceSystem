<?php
	include_once('config.php');
	require "functions.php";
	$id = $_GET['id'];
	$query = "delete from classes where id='$id'";
	$result = mysqli_query($con,$query);
	if($result){
		redirect("show-classes.php","Class Deleted Successfully");
	}else{
		redirect("show-classes.php","Unable to delete class");
	}

?>