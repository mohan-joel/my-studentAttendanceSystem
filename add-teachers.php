<?php 
	// include database connection file
	include_once('config.php');
  require "functions.php";
	if(!isset($_SESSION['ID'])){
		header("location: login.php");
	}

      if (isset($_POST['add'])) {

        $name     = $con->real_escape_string($_POST['name']);
        $gender = $con->real_escape_string($_POST['gender']);
        $email = $con->real_escape_string($_POST['email']);
        $address     = $con->real_escape_string($_POST['address']);
        $contact     = $con->real_escape_string($_POST['contact']);
        $password = $con->real_escape_string(md5($_POST['password']));
        $role     = $con->real_escape_string($_POST['role']);
        $photo     = $con->real_escape_string($_FILES['photo']['name']);
        $filename = $_FILES['photo']['name'];
        $tempname = $_FILES['photo']['tmp_name'];
        $folder = "uploads/images/".$filename;
        move_uploaded_file($tempname, $folder);
        $query  = "INSERT INTO users (name,email,gender,address,contact,password,role,photo) VALUES ('$name','$gender','$email','$address','$contact','$password','$role','$photo')";
        $result = $con->query($query);
        if ($result==true) {
          redirect("add-teachers.php","New Teacher Added Successfully!!!");
          die();
        }else{
          redirect("add-teachers.php","Unable to add new teacher!!!");
        }   
      }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Online Attendance System -DASHBOARD</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/images/favicon.ico" />
  </head>
  <body>
    <div class="container-scroller">
    
      <!-- partial:partials/_navbar.html -->
      <?php require "includes/navbar.php"; ?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <?php require "includes/sidebar.php"; ?>
        <!-- partial -->
        <!-- main dashboard -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> Dashboard
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Today: <?php echo date('Y-m-d l'); ?><br>
                    Time: <?php echo date('h:i a');?>
                    <hr style="color: black;width: 50px solid;">
                  </li>
                </ul>
              </nav>
            </div>
            <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Add New Teachers</h4>
                      <?php if (isset($_SESSION['msg'])) { ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                          <strong>Success:</strong><?=$_SESSION['msg'];?>
                          <?php unset($_SESSION['msg']); ?>
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        
                      <?php } ?>

                      <p class="card-description">  </p>
                      <form class="forms-sample"  method="post" enctype="multipart/form-data">
                        <div class="form-group">
                          <label for="exampleInputUsername1">Name</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" name="name" placeholder="Teacher's Name">
                        </div>
                        <div class="form-group">
                          <label for="gender">Gender</label>
                          <select name="gender" id="" class="form-control">
                            <option value="">Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Email address</label>
                          <input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="Teacher's Email">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Address</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="address" placeholder="Teacher's Address">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Contact</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" name="contact" placeholder="Teacher's Contact">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Password</label>
                          <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputConfirmPassword1">Confirm Password</label>
                          <input type="password" class="form-control" name="c_password" id="exampleInputConfirmPassword1" placeholder="Retype Password">
                        </div>
                        <div class="form-group">  
                          <label for="role">Role:</label>
                          <select class="form-control" name="role" required="">
                            <option value="Teacher">Teacher</option>
                          </select>
                        </div>
                        <div class="form-group">  
                          <label for="username">Teacher's Photo:</label>
                          <input type="file" class="form-control" name="photo" required="">
                        </div>
                        <button type="submit" class="btn btn-gradient-primary me-2" name="add">Add</button>
                        
                      </form>
                    </div>
                  </div>
                </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <?php require"includes/footer.php"; ?>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/vendors/chart.js/Chart.min.js"></script>
    <script src="assets/js/jquery.cookie.js" type="text/javascript"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- End custom js for this page -->
  </body>
</html>