<?php 
	// include database connection file
  require"functions.php";
	include_once('config.php');
	if(!isset($_SESSION['ID'])){
		header("location: login.php");
	}

  $teacher_name = $_SESSION['NAME'];
  $query = "select class, section from assign_class_teacher where teacher_name ='$teacher_name'";
  $result = mysqli_query($con,$query);
  $row = mysqli_fetch_assoc($result);
  $class=$row['class'];
  $section = $row['section'];
  $studentQuery = "select name,photo from students where class='$class' and section='$section'";
  $studentResult = mysqli_query($con,$studentQuery);
  $numStudent = mysqli_num_rows($studentResult);


  

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
                    <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                  </li>
                </ul>
              </nav>
            </div>
            <div class="row">
               <div class="col-lg-12 grid-margin stretch-card">
              
                  <div class="card">
                  <div class="card-body">
                    <?php if (isset($_SESSION['msg'])) { ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                          <strong>Success:</strong><?=$_SESSION['msg'];?>
                          <?php unset($_SESSION['msg']); ?>
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        
                      <?php } ?>
                    <h4 class="card-title float-end">Date: <input type="date" style="border:none;"  value="<?php echo date('Y-m-d'); ?>"></h4>

                  
                    <h6 class="card-description"> Class:<?=$class;?></h6>
                    <h6 class="card-description"> Section:<?=$section;?> </h6>
          
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>Roll No</th>
                          <th> Photo </th>
                          <th> Student's Name </th>
                          <th> Attendance (Tick for all present) <input type="checkbox" id="select-all"> </th>
                          
                        </tr>
                      </thead>
                      <tbody>

                      <?php 
                          if(isset($_POST['save'])){
                            for($i=0; $i < $numStudent; $i++){
                              $date = $_POST['date'][$i];
                              $class = $_POST['class'][$i];
                              $section = $_POST['section'][$i];
                              $class_teacher = $_POST['class_teacher'][$i];
                              $student_name = $_POST['student_name'][$i];
                              $status = isset($_POST['status'][$i]) ? "Present" : "Absent";
                              
                              $attendanceQuery = "insert into student_attendance (dates,class,section,class_teacher,student_name,status) values ('$date','$class','$section','$class_teacher','$student_name','$status')";
                              $attendanceResult = mysqli_query($con,$attendanceQuery);

                              if($attendanceResult == 1){
                                echo "<script>alert('Attendance taken successfully');</script>";
                                echo "<script>window.open('take-student-attendance.php','_self')";
                              }else{
                                echo "<script>alert('Unable to take attendance');</script>";
                                echo "<script>window.open('take-student-attendance.php','_self')";
                              }
                            }
                         }
                         
                      
                      ?>

                       <form accept="" method="post" id="save" >
                        <?php 
                        $i=1;
                          $studentQuery = "select name,photo from students where class='$class' and section='$section'";
                          $studentResult = mysqli_query($con,$studentQuery);
                          while($row = mysqli_fetch_assoc($studentResult)){
                          $studentName = $row['name'];
                          $studentPhoto = $row['photo'];
                          $date = date("Y-m-d");
                        ?>

                        <input type="hidden" style="border:none;" name="date[]" id="date" value="<?=$date;?>">
                        <input type="hidden" name="class[]" id="class" value="<?=$class;?>">
                        <input type="hidden" name="section[]" id="section" value="<?=$section;?>">
                        <input type="hidden" name="class_teacher[]" id="class_teacher" value="<?=$teacher_name;?>" >
                        <tr>
                          <td><?=$i++;?></td>
                          <td class="py-1">
                            <img src="uploads/images/<?=$studentPhoto;?>" alt="image" />
                          </td>
                          <div class="form-group">
                            <td> <input type="text" style="border:none;" class="form-control" name="student_name[]" id="student_name" value="<?=$studentName;?>"> </td>
                          </div>
                          <td>
                            <div class="form-group">
                              <input type="checkbox" class="form-check-input checkbox" name="status[]" id="attendance" value="Present"><label class="form-check-label" for="flexCheckDefault">
                                      Present
                                    </label>
                                   
                            </div>
                          </td>
                        </tr>
                        <?php } ?>
                        <span id="table_row" style="background-color: yellow;"></span>
                      </tbody>
                    </table>
                    <button type="submit" name="save" class="btn btn-primary" >Save</button>
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
      $(document).ready(function(){
          $("#select-all").click(function(){
              $(".checkbox").prop("checked",$(this).prop('checked'));
          });


          $(".checkbox").click(function(){
              if($(".checkbox:checked").length == $(".checkbox").length){
                $("#select-all").prop('checked',true);
              }else{
                $("#select-all").prop('checked',false);
              }
          });
      });
    </script>
  </body>
</html>