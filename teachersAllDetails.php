
<!DOCTYPE html>
<html>
<head>
	<title>Teacher's all details</title>
	<link rel="stylesheet" type="text/css" href="assets/css/print.css" media="print">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<style type="text/css">
		h6{
			font-family: Verdana,Geneva,Tahoma, sans-serif;
			text-align: center;
		}
		table{
			font-family: Arial,Helvetica,sans-serif;
			border-collapse: collapse;
			width: 100%;
		}
		td,th{
			border:1px solid #444;
			padding: 8px;
		}
		#print_btn{
			float: right;
			margin-bottom: 20px;
			
		}
	</style>
</head>
<body>
<h6>Teacher's List</h6>
<button onclick="window.print();" id="print_btn" class="btn btn-sm btn-success">Print</button>
<table class="table table-bordered">
	<thead>
		<tr>
			<th>S.No</th>
			<th>Name</th>
			<th>Gender</th>
			<th>Email</th>
			<th>Address</th>
			<th>Contact</th>
			<th>Photo</th>
		</tr>
	</thead>
	<tbody>
		<?php 
			session_start();
			include_once('config.php');
			$i=1;
			$query = "select * from users where role='Teacher'";
			$result = mysqli_query($con,$query);
			while($teacher = mysqli_fetch_assoc($result)){
		?>
		<tr>
			<td><?=$i++;?></td>
			<td><?=$teacher['name'];?></td>
			<td><?=$teacher['gender'];?></td>
			<td><?=$teacher['email'];?></td>
			<td><?=$teacher['address'];?></td>
			<td><?=$teacher['contact'];?></td>
			<td><img src="uploads/images/<?=$teacher['photo'];?>" height="40px" width="40px"></td>
		</tr>
	<?php }?>
	</tbody>
</table>
</body>
</html>