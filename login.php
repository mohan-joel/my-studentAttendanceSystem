<?php
  
  // Include database connectivity
    
  include_once('config.php');
  session_start();
  
  if (isset($_POST['submit'])) {
      $errorMsg = "";
      $email = $con->real_escape_string($_POST['email']);
      $role = $con->real_escape_string($_POST['role']);
      $password = $con->real_escape_string($_POST['password']);
      
      $query = "select * from users where email='$email' and role='$role' and password='$password'";
      $result = mysqli_query($con,$query);
      $num_rows = mysqli_num_rows($result);
      $row = mysqli_fetch_assoc($result);
      if($num_rows > 0){
        $_SESSION['ID'] = $row['id'];
        $_SESSION['ROLE']=$row['role'];
        $_SESSION['NAME'] = $row['name'];
        $_SESSION['EMAIL'] = $row['email'];
        $_SESSION['ADDRESS'] = $row['address'];
        $_SESSION['contact'] = $row['contact'];
        $_SESSION['PHOTO'] = $row['photo'];
        $_SESSION['SCHOOL'] = $row['school'];
        header("location: dashboard.php");
        
      }
  }
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Online Attendance System -LOGIN</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
<div class="card text-center" style="padding:20px;">
  <h3>Online Attendance System</h3>
</div><br>
<div class="container">
  <div class="row">
    <div class="col-md-3"></div>
      <div class="col-md-6">
        <?php if (isset($errorMsg)) { ?>
          <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo $errorMsg; ?>
          </div>
        <?php } ?>
        <form action="" method="POST">
          <div class="form-group">  
            <label for="email">Email:</label> 
            <input type="email" class="form-control" name="email" placeholder="Enter Email" >
          </div>
          <div class="form-group">  
            <label for="password">Password:</label> 
            <input type="password" class="form-control" name="password" placeholder="Enter Password">
          </div>
          <div class="form-group">  
            <label for="role">Role:</label>
            <select class="form-control" name="role" required="">
              <option value="">Select Role</option>
              <option value="Admin">Admins</option>
              <option value="Teacher">Teachers</option>
              <option value="Student">Students</option>
            </select>
          </div>
          <div class="form-group">
            <p>Not registered yet ?<a href="signup.php"> Register here</a></p>
            <input type="submit" name="submit" class="btn btn-success" value="Login"> 
          </div>
        </form>
      </div>
  </div>
</div>
</body>
</html>