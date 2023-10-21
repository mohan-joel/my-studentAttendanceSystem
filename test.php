<?php 
	include('config.php');
	$query = "select * from date_table";
	$result = mysqli_query($con,$query);
	$num = mysqli_num_rows($result);
	$std_query = "select name from students where class='5' and section='Sun'";
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
	<link rel="stylesheet" type="text/css" href="assets/css/print.css" media="print">
</head>
<body>
<div class="container">
	<h1 style="text-align: center;">Attendance Record</h1>
	<table border="1" style="border-collapse: collapse;">
	<tr>
		<th>Student Name</th>
		<b>Class:</b>5<br>
		<b>Section:</b>Sun
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
	<th>Mon</th>
	<th>Tue</th>
	<th>Wed</th>
	<th>Thu</th>
	<th>Fri</th>
	<th>Sun</th>
	<th>Mon</th>
	<th>Tue</th>
	<th>Wed</th>
	<th>Thu</th>
	<th>Fri</th>
	<th>Sun</th>
	<th>Mon</th>
	<th>Tue</th>
	<th>Wed</th>
	<th>Thu</th>
	<th>Fri</th>
	<th>Sun</th>
	<th>Mon</th>
	<th>Tue</th>
	<th>Wed</th>
	<th>Thu</th>
	<th>Fri</th>

	<th>Total Present</th>
	<th>Total Absent</th>
	</tr>

<?php 
	$query_name = "select name from students where class='5' and section='Sun'";
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
			 	if($status==1){
			 		echo "P";
			 	}else{
			 		echo "A";
			 	}
			 ?>	
		</td>
	<?php  } ?>

	<?php
		$query_countP = "select status from student_attendance where status='1' and student_name='$name'";
		$result_countP = mysqli_query($con,$query_countP);
		$query_countA = "select status from student_attendance where status='0' and student_name='$name'";
		$result_countA = mysqli_query($con,$query_countA);
		$numP = mysqli_num_rows($result_countP);
		$numA = mysqli_num_rows($result_countA);

	 ?>

	 <td>P</td>
	<td>P</td>
	<td>P</td>
	<td>P</td>
	<td>P</td>
	<td>P</td>
	<td>P</td>
	<td>P</td>
	<td>P</td>
	<td>P</td>
	<td>P</td>
	<td>P</td>
	<td>P</td>
	<td>P</td>
	<td>P</td>
	<td>P</td>
	<td>P</td>
	<td>P</td>
	<td>P</td>
	<td>P</td>
	<td>P</td>
	<td>P</td>
	<td>P</td>

	<td><?=$numP?></td>
	<td><?=$numA?></td>
	</tr>
	<?php  } ?>
</table>

<button type="submit" onclick="window.print()" id="print_btn">Print</button>
</div>
</body>
</html>