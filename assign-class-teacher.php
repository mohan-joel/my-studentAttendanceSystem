<?php 
	
	// include database connection file
	include_once('config.php');
  require "functions.php";
	if(!isset($_SESSION['ID'])){
		header("location: login.php");
	}

  $query = "select name from users where role='Teacher'";
  $result = mysqli_query($con,$query);

  if(isset($_POST['add'])){
    $teacher_name = $con->real_escape_string($_POST['teacher_name']);
    $class = $con->real_escape_string($_POST['class']);
    $section = $con->real_escape_string($_POST['section']);
    $subject = $con->real_escape_string($_POST['subject']);
    $assign = $con->real_escape_string($_POST['assign']);

    $query = "insert into assign_class_teacher (teacher_name,class,section,subject,status) values('$teacher_name','$class','$section','$subject','$assign')";
    $result = mysqli_query($con,$query);
    if($result){
      redirect("assign-class-teacher.php","Class Teacher Assign Successfully!!!");
    }else{
      redirect("assign-class-teacher.php","Unable to assign class teacher");
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
            </div>
            <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Assign Class Teacher</h4>
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
                          <label for="exampleInputUsername1">Teacher's Name</label>
                          <select class="form-control" name="teacher_name" id="teacher_name">
                            <option value="">---Select Teacher---</option>
                            <?php while($row=mysqli_fetch_assoc($result)) { ?>
                            <option value="<?=$row['name'];?>"><?=$row['name'];?></option>

                          <?php } ?>
                          </select>
                          <span id="already_assigned_msg"></span>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputUsername1">Class</label>
                          <select class="form-control" name="class" id="class">
                            <option value="">---Select Class---</option>
                          </select>
                          <span id="already_given_msg"></span>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputUsername1">Section</label>
                          <select class="form-control" name="section" id="section">
                            <option value="">---Select Section---</option>
                          </select>
                          <span id="section_classteacher_msg"></span>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Subject</label>
                          <input type="text" class="form-control" id="subject" name="subject" placeholder="Enter Subject">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputUsername1">Assign</label>
                          <select class="form-control" name="assign" id="assign">
                            <option value="">---Assign Class Teacher---</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                          </select>
                        </div>
                        <button type="submit" class="btn btn-gradient-primary me-2" name="add">Add</button>
                        <button class="btn btn-light">Cancel</button>
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
              $("#class").append(data);
            }
          });
        }
        loadClass();

        $(document).on("change","#class",function(){
          var class_name = $("#class").val();
          $.ajax({
            url:"load-section.php",
            type:"post",
            data:{class_name:class_name},
            success:function(data){
              $("#section").html(data);
            }
          });

        });
      });

      // check whether given teacher is assigned as class teacher or ot
      $(document).ready(function(){
        $("#teacher_name").on("change",function(){
          var teacher_name = $("#teacher_name").val();
          $.ajax({
            url:"already_assigned_classteacher.php",
            type:"post",
            data:{teacher_name:teacher_name},
            success:function(data){
                $("#already_assigned_msg").html(data).css("color","red");
            }
          });
        });
      });


      // check whether given class is given class  teacher or not
       $(document).ready(function(){
        $("#class").on("change",function(){
          var class_name = $("#class").val();
          $.ajax({
            url:"class_given_classteacher.php",
            type:"post",
            data:{class:class_name},
            success:function(data){
                $("#already_given_msg").html(data).css("color","red");
            }
          });
        });
      });

       // check whether given section is given class  teacher or not
       $(document).ready(function(){
        $("#section").on("change",function(){
          var section = $("#section").val();
          $.ajax({
            url:"section_given_classteacher.php",
            type:"post",
            data:{section:section},
            success:function(data){
                $("#section_classteacher_msg").append(data).css("color","red");
            }
          });
        });
      });
    </script>
  </body>
</html>