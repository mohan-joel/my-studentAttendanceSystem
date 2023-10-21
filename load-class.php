<?php
	include_once("config.php");

		$query = "select distinct class_name from classes";
		$result = mysqli_query($con,$query);
		$output = "";
		while($row = mysqli_fetch_assoc($result)){
			$output .= "<option  value='{$row['class_name']}'>{$row['class_name']}</option>";
		}

		echo $output;
	

		


?>