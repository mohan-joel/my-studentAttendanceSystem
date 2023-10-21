<?php 
	session_start();
	include_once('config.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Attendance Report</title>
</head>
<body>
	<table style="border-collapse: collapse;" border="1">
		<thead>
			<tr>
				<th>Student's Name</th>
				<?php 
					$teacher=$_SESSION['NAME'];
					$query = "select distinct dates from student_attendance where class_teacher='$teacher' ";
					$result = mysqli_query($con,$query);
					while($row = mysqli_fetch_assoc($result)){
				?>
				<th><?=$row['dates'];?></th>
			<?php } ?>
				
				<th>Total Present Days</th>
			</tr>
		</thead>
		<tbody>
			<?php 
					$teacher=$_SESSION['NAME'];
					$query = "select student_name,status from student_attendance where class_teacher='$teacher' ";
					$result = mysqli_query($con,$query);
					while($row = mysqli_fetch_assoc($result)){
				?>
			<tr>
				<td><?=$row['student_name'];?></td>
				<?php 
					$teacher=$_SESSION['NAME'];
					$query = "select distinct dates from student_attendance where class_teacher='$teacher' ";
					$result = mysqli_query($con,$query);
					while($row = mysqli_fetch_assoc($result)){
						$date = $row['dates'];
						$queryS = "select status from student_attendance where dates='$date'";
						$resultS = mysqli_query($con,$queryS);
						while($status = mysqli_fetch_assoc($resultS)){
				?>
				<td><?php if($status['status']==1){echo "P";}else{echo "A";}?></td>
			<?php }  ?>
			</tr>
			<?php } }?>
		</tbody>
	</table>
</body>
</html>