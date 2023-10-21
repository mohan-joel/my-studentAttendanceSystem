<?php 
	include_once("config.php");
	$section = $_POST['section'];
	$query = "select * from assign_class_teacher";
	$result = mysqli_query($con,$query);
	while($row = mysqli_fetch_assoc($result)){
		$section_name = $row['section'];
	}
	if($section == $section_name){
			echo "This section already given class teacher";
		}else{
			echo "You can assign class teacher for this section";
		}

?>