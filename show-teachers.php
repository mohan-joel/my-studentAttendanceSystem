<?php 
	// include database connection file
	include_once('config.php');
  require "functions.php";
	if(!isset($_SESSION['ID'])){
		header("location: login.php");
	}

      if (isset($_POST['add'])) {

        $name     = $con->real_escape_string($_POST['name']);
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
        $query  = "INSERT INTO users (name,email,address,contact,password,role,photo) VALUES ('$name','$email','$address','$contact','$password','$role','$photo')";
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

                   <?php if (isset($_SESSION['msg'])) { ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                          <strong>Success:</strong><?=$_SESSION['msg'];?>
                          <?php unset($_SESSION['msg']); ?>
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        
                      <?php } ?>
                      <h4 class="card-title">Teachers List</h4>
                      <a class="btn btn-primary btn-sm float-end" href="teachersAllDetails.php"> All Details </a>
                      <a class="btn btn-dark btn-sm float-end" href="add-teachers.php">Add Teachers</a>
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th> S.No </th>
                          <th> Teacher's Name </th>
                          <th> Address </th>
                          <th> Contact </th>
                           <th> Actions </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                          $query = "select id, name,email,address,contact from users where role='Teacher'  order by name";
                          $result = mysqli_query($con,$query);
                          $num_rows = mysqli_num_rows($result);
                          $i= 1;
                          while($row = mysqli_fetch_assoc($result))
                          {
                        ?>
                        <tr class="table-info">
                          <td> <?php echo $i++;?> </td>
                          <td><?php echo $row['name']; ?></td>
                          <td><?php echo $row['address']; ?></td>
                          <td> <?php echo $row['contact']; ?> </td>
                          <td><a class="btn btn-sm btn-success"  href="edit-teachers.php?id=<?=$row['id'];?>">Update</a><a class="btn btn-sm btn-danger" href="delete-teacher.php?id=<?=$row['id'];?>">Delete</a></td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
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