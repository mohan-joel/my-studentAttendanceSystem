<?php 
	include_once("config.php");
	$query = "select section_name from classes where class_name = {$_POST['class_name']}";
	$result = mysqli_query($con,$query);
	$output = "";
	while($row = mysqli_fetch_assoc($result)){
		$output .= "<option value='{$row['section_name']}'>{$row['section_name']}</option>";
	}

	echo $output;


?>