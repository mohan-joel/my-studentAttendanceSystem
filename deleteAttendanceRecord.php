<?php
	include_once("config.php");
	include("functions.php");
	$id = $_GET['id'];
	$query = "delete from student_attendance where id='$id'";
	$result = mysqli_query($con,$query);
	if($result){
		redirect("take-student-attendance.php","Attendance Row deleted Successfully");
	}

 ?>