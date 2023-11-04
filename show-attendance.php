<?php 
    session_start();
	include('config.php');
	if(!isset($_SESSION['ID'])){
		header("location: login.php");
	}
	$query = "select * from student_attendance";
	$result = mysqli_query($con,$query);
	$num = mysqli_num_rows($result);
    $class=$_GET['class'];
    $section=$_GET['section'];
	$std_query = "select name from students where class='$class' and section='$section'";
	$std_res = mysqli_query($con,$std_query);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Test</title>
	<style>
		body{
			margin: 0;
			padding: 0;
		}
		.container{
			padding: 10px;
		}
		
	</style>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="assets/css/print.css" media="print">
</head>
<body>
<div class="container">
	<h1 style="text-align: center;"><?php echo $_SESSION['SCHOOL']; ?></h1>
	<table border="1" style="border-collapse: collapse;">
	<tr>
		<th>Student Name</th>
		<b>Class:</b><?=$class;?><br>
		<b>Section:</b><?=$section;?>
		<?php 
			$query_date ="select distinct dates from student_attendance";
			$result_date = mysqli_query($con,$query_date);
			while($row_d = mysqli_fetch_assoc($result_date)){
				$date = $row_d['dates'];
				$month = date('F',strtotime($date));
				$year =date('Y',strtotime($date));
				$day = date('D',strtotime($date));
		 ?>

		<th><?=$day;?></th>
	<?php  } ?>
	

	<th>Total Present</th>
	<th>Total Absent</th>
	</tr>

<?php 
	$query_name = "select name from students where class='$class' and section='$section'";
	$result_name=mysqli_query($con,$query_name);
	while($row_n = mysqli_fetch_assoc($result_name)){
		$name = $row_n['name'];
?>

	<tr>
		<td><?=$name?></td>
		<?php 
			$query_status ="select status  from student_attendance where student_name='$name'";
			$result_status = mysqli_query($con,$query_status);
			while($row_status = mysqli_fetch_assoc($result_status)){
				$status = $row_status['status'];
		 ?>
		<td>
			<?php
			 	if($status=="Present"){
			 		echo "P";
			 	}else{
			 		echo "A";
			 	}
			 ?>	
		</td>
	<?php  } ?>

	<?php
		$query_countP = "select status from student_attendance where status='Present' and student_name='$name'";
		$result_countP = mysqli_query($con,$query_countP);
		$query_countA = "select status from student_attendance where status='Absent' and student_name='$name'";
		$result_countA = mysqli_query($con,$query_countA);
		$numP = mysqli_num_rows($result_countP);
		$numA = mysqli_num_rows($result_countA);

	 ?>



	<td><?=$numP?></td>
	<td><?=$numA?></td>
	</tr>
	<?php  } ?>
</table>

<div class="container">
<button type="submit" onclick="window.print()" class="btn btn-sm btn-warning" id="print_btn">Print</button>
<a href="take-student-attendance.php" class="btn btn-sm btn-success" id="print_btn">Go Back</a>
</div>
</div>
</body>
</html>