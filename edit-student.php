<?php 
  session_start();
  // include database connection file
  include_once('config.php');
  require "functions.php";
  if(!isset($_SESSION['ID'])){
    header("location: login.php");
  }

  $id = $_GET['id'];
  if(isset($_POST['update'])){
    $name = $con->real_escape_string($_POST['name']);
    $class_name = $con->real_escape_string($_POST['class_name']);
    $section_name = $con->real_escape_string($_POST['section_name']);
    $address = $con->real_escape_string($_POST['address']);
    $contact = $con->real_escape_string($_POST['contact']);
    $father_name = $con->real_escape_string($_POST['father_name']);
    $father_contact = $con->real_escape_string($_POST['father_contact']);
    $mother_name = $con->real_escape_string($_POST['mother_name']);
    $mother_contact = $con->real_escape_string($_POST['mother_contact']);

    $query = "update students set name='$name',class='$class_name',section='$section_name',address='$address',contact='$contact',father_name='$father_name',father_contact='$father_contact',mother_name='$mother_name',mother_contact='$mother_contact' where id='$id'";
    $result = mysqli_query($con,$query);

    if($result){
      redirect("show-students.php","Student Updated Successfully!!!");
    }else{
      redirect("show-students.php","Unable to Update Student");
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
                      <h4 class="card-title">Edit Students</h4>
                      <?php if (isset($_SESSION['msg'])) { ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                          <strong>Success:</strong><?=$_SESSION['msg'];?>
                          <?php unset($_SESSION['msg']); ?>
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        
                      <?php } ?>


                      <?php 

                        $query = "select * from students where id='$id'";
                        $result = mysqli_query($con,$query);
                        while($student = mysqli_fetch_assoc($result)) { ?>
                      <p class="card-description">  </p>
                      <form class="forms-sample"  method="post" enctype="multipart/form-data">
                        <div class="form-group">
                          <label for="exampleInputUsername1">Name</label>
                          <input type="text" class="form-control" id="name" name="name" value="<?=$student['name'];?>">
                        </div>
                        <div class="form-group">  
                          <label for="role">Class:</label>
                          <select class="form-control" name="class_name" id="class_name" required="" >
                            <option value="">---Select Class---</option>
                          </select>
                        </div>
                        <div class="form-group">  
                          <label for="role">Section:</label>
                          <select class="form-control" name="section_name" id="section_name" required="">
                            <option value="">---Select Section---</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Address</label>
                          <input type="text" class="form-control" id="address" name="address" value="<?=$student['address'];?>">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Contact</label>
                          <input type="text" class="form-control" id="contact" name="contact" value="<?=$student['contact'];?>" >
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Father's Name</label>
                          <input type="text" class="form-control" id="father_name" name="father_name" value="<?=$student['father_name'];?>" >
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Father's Contact</label>
                          <input type="text" class="form-control" id="father_contact" name="father_contact" value="<?=$student['father_contact'];?>" >
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Mother's Name</label>
                          <input type="text" class="form-control" id="mother_name" name="mother_name" value="<?=$student['mother_name'];?>" >
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Mother's Contact</label>
                          <input type="text" class="form-control" id="mother_contact" name="mother_contact" value="<?=$student['mother_contact'];?>">
                        </div>

                      <?php } ?>
                        <button type="submit" class="btn btn-gradient-primary me-2" name="update">Update</button>
                        
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

    <script>
      $(document).ready(function(){
        function loadClass(){
          $.ajax({
            url:"load-class.php",
            type:"post",
            success:function(data){
              $("#class_name").append(data);
            }
          });
        }
        loadClass();

        $(document).on("change","#class_name",function(){
          var class_name = $("#class_name").val();
          $.ajax({
            url:"load-section.php",
            type:"post",
            data:{class_name:class_name},
            success:function(data){
              $("#section_name").html(data);
            }
          });

        });
      });
    </script>
  </body>
</html>