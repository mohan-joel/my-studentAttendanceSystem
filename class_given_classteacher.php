<?php
	include_once("config.php");
	$class_name = $_POST['class'];
	$query = "select class_name from classes where class_name='$class_name'";
	$result = mysqli_query($con,$query);
	$total_sections = mysqli_num_rows($result);
	$query1 = "select class from assign_class_teacher where class='$class_name'";
	$result1 = mysqli_query($con,$query1);
	$num = mysqli_num_rows($result1);
	$assigned = $total_sections -$num;
	if($assigned == 0){
		echo "Class teacher is assigned in all sections of this class.";
	}else{
		echo $assigned." sections of this class are remaining to assign class teachers";
	}


 ?>