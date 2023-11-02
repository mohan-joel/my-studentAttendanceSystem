<?php
  // Include database connection file
  include_once('config.php');
  session_start();
  if(isset($_SESSION['ID'])){
    header("location: dashboard.php");
    exit();
  }
  
  


  if (isset($_POST['submit'])) {

    $name     = $con->real_escape_string($_POST['name']);
    $gender = $con->real_escape_string($_POST['gender']);
    $email = $con->real_escape_string($_POST['email']);
    $address     = $con->real_escape_string($_POST['address']);
    $contact     = $con->real_escape_string($_POST['contact']);
    $password = $con->real_escape_string($_POST['password']);
    $role     = $con->real_escape_string($_POST['role']);
    $photo     = $con->real_escape_string($_FILES['photo']['name']);
    $filename = $_FILES['photo']['name'];
    $tempname = $_FILES['photo']['tmp_name'];
    $folder = "uploads/images/".$filename;
    move_uploaded_file($tempname, $folder);
    $query  = "INSERT INTO users (name,gender,email,address,contact,password,role,photo) VALUES ('$name','$gender','$email','$address','$contact','$password','$role','$photo')";
    $result = $con->query($query);
    if ($result==true) {
      header("Location:login.php");
      die();
    }else{
      $errorMsg  = "You are not Registred..Please Try again";
    }   
  }
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <title>Online Attendance System -SIGNUP</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  
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
        <form action="" method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" name="name" placeholder="Enter Name" required="">
          </div>
          <div class="form-group">  
            <label for="role">Gender:</label>
            <select class="form-control" name="gender" required="">
              <option value="">Select Gender</option>
              <option value="male">Male</option>
              <option value="female">Female</option>
              
            </select>
          </div>
          <div class="form-group">  
            <label for="username">Email:</label>
            <input type="email" class="form-control" name="email" placeholder="Enter Email" required="">
          </div>
          <div class="form-group">  
            <label for="username">Address:</label>
            <input type="text" class="form-control" name="address" placeholder="Enter Address" required="">
          </div>
          <div class="form-group">  
            <label for="username">Contact No.:</label>
            <input type="text" class="form-control" name="contact" placeholder="Enter Contact No." required="">
          </div>
          <div class="form-group">  
            <label for="password">Password:</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password" required="">
          </div>
          <div class="form-group">  
            <label for="password">Confirm Password:</label>
            <input type="password" class="form-control" name="c_password" id="c_password" placeholder="ReType Password" required="">
            <span id="confirmMsg"></span>
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
            <label for="username">Your Photo:</label>
            <input type="file" class="form-control" name="photo" required="">
          </div>
          <div class="form-group">
            <p>Already have account ?<a href="login.php"> Login</a></p>
            <input type="submit" name="submit" class="btn btn-primary">
          </div>
        </form>
      </div>
  </div>
</div>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
  $(document).ready(function(){
   $("#c_password").keyup(function(){
      var password = $("#password").val();
      var c_password = $("#c_password").val();
      if(password == c_password){
          $("#confirmMsg").html("Password and Confirm Password Matched").css("color","green");
      }else{
        $("#confirmMsg").html("Password and Confirm Password are not matching").css("color","red");
      }
    });
  });
</script>
</body>
</html>