<?php 
	session_start();
	 function redirect($slug,$message)
	{
		$redirectTo = "http://localhost/student_attendance/".$slug;
		$_SESSION['msg'] = $message;
		header("location: $redirectTo");
		exit(0);
	}

?>