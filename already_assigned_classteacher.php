<?php 
	include_once("config.php");
	$teacher_name = $_POST['teacher_name'];
	$query = "select teacher_name from assign_class_teacher";
	$result = mysqli_query($con,$query);
	while($row = mysqli_fetch_assoc($result)){
		$name = $row['teacher_name'];
		if($name == $teacher_name){
			echo "This teacher is already assigned as class teacher.";
		}
	}
	




?>