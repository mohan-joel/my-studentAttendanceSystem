<?php
	include_once("config.php");
	require "functions.php";

	$id = $_GET['id'];
	$query = "delete from students where id='$id'";
	$result = mysqli_query($con,$query);
	if($result){
		redirect("show-students.php","Student deleted Successfully!!!");
	}else{
		redirect("show-students.php","Unable to delete student");
	}



?>