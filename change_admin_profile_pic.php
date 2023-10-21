<?php 
	require('functions.php');
	include_once('config.php');
	if(isset($_POST['submit'])){
		$id = $_SESSION['ID'];
		$photo = $_FILES['photo']['name'];
		$filename = $_FILES['photo']['name'];
		$tempname = $_FILES['photo']['tmp_name'];
		move_uploaded_file($tempname, 'uploads/images/'.$filename);
		$query = "update users set photo='$photo' where id='$id'";
		$result = mysqli_query($con,$query);
		if($result){
			redirect("adminProfile.php","Admin Profile Images Updated Successfully");
			session_destroy();
		}else{
			redirect("adminProfile.php","Unable to update profile pic");
		}
	}

?>