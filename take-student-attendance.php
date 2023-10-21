<?php 
	// include database connection file
  require"functions.php";
	include_once('config.php');
	if(!isset($_SESSION['ID'])){
		header("location: login.php");
	}


$name = $_SESSION['NAME'];
$query = "select class,section from assign_class_teacher where teacher_name='$name'";
$result = mysqli_query($con,$query);
$row = mysqli_fetch_assoc($result); 
$class = $row['class'];
$section = $row['section'];
$query1 = "select photo,name from students where class = '$class' and section='$section'";
$result1 = mysqli_query($con,$query1);
$num_std = mysqli_num_rows($result1);

  if(isset($_POST['save'])){
    for($a=0;$a<$num_std;$a++){
      $date = $_POST['date'][$a];
      $class = $_POST['class'][$a];
      $section = $_POST['section'][$a];
      $class_teacher = $_POST['class_teacher'][$a];
      $student_name = $_POST['student_name'][$a];
      $status = $_POST['attendance'][$a];

      $query = "insert into student_attendance (dates,class,section,class_teacher,student_name,status) values ('$date','$class','$section','$class_teacher','$student_name','$status')";
      $result = mysqli_query($con,$query);
    }
    if($result){
        redirect("take-student-attendance.php","Attendance saved successfully!!!");
    }else{
      redirect("take-student-attendance.php","Unable to save student attendance");
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

                   <?php 
                     while($row = mysqli_fetch_assoc($result)){  
                   ?>
                    <h6 class="card-description"> Class:<?php echo $row['class']; ?> </h6>
                    <h6 class="card-description"> Section: <?php echo $row['section']; ?> </h6>
                   <?php } ?>
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>Roll No</th>
                          <th> Photo </th>
                          <th> Student's Name </th>
                          <th> Attendance </th>
                          
                        </tr>
                      </thead>
                      <tbody>

                      <?php 
                        $i= 1;
                         while($row = mysqli_fetch_assoc($result1)){
                       ?>
                       <form accept="" method="post" id="save" >
                        <input type="hidden" style="border:none;" name="date[]" id="date" value="<?php echo "date('Y-m-d')"; ?>">
                        <input type="hidden" name="class[]" id="class" value="<?php echo $class;?>">
                        <input type="hidden" name="section[]" id="section" value="<?php echo $section;?>">
                        <input type="hidden" name="class_teacher[]" id="class_teacher" value="<?php echo $_SESSION['NAME'];?>">
                        <tr>
                          <td><?php echo $i++; ?></td>
                          <td class="py-1">
                            <img src="uploads/images/<?php echo $row['photo']; ?>" alt="image" />
                          </td>
                          <div class="form-group">
                            <td> <input type="text" style="border:none;" class="form-control" name="student_name[]" id="student_name" value="<?=$row['name'];?>"> </td>
                          </div>
                          <td>
                            <div class="form-group">
                              <input type="checkbox" class="form-check-input" name="attendance[]" id="attendance" value="1"><label class="form-check-label" for="flexCheckDefault">
                                      Present
                                    </label>
                            <input type="checkbox" class="form-check-input" name="attendance[]" id="attendance" value="0"><label class="form-check-label" for="flexCheckDefault">
                                      Absent
                                    </label>
                            </div>
                          </td>
                        </tr>
                        
                        
                        <span id="table_row" style="background-color: yellow;"></span>
                      <?php } ?>
                      </tbody>
                    </table>
                    <button type="submit" name="save" class="btn btn-primary" >Save</button>
                    </form>
                  </div>
                  
                </div>
               
              </div>

              

              <div class="row">
               <div class="col-lg-12 grid-margin stretch-card">
                  <div class="card">
                  <div class="card-body">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th>S.No</th>
                            <th>Name of Student</th>
                            <th>Status</th>
                            <th><a href="#" class="btn btn-danger">Delete Selected</a></th>
                          </tr>
                        </thead>
                        <?php 
                              $b=1;
                          ?>
                        <?php 
                        $teacher = $_SESSION['NAME'];
                          $date = date('Y-m-d');
                          $attendQuery = "select id,student_name,status from student_attendance where dates='$date'  and class_teacher='$teacher'";
                          $resultAttend = mysqli_query($con,$attendQuery);
                          while($studAttend = mysqli_fetch_assoc($resultAttend)){
                          $status = $studAttend['status'];
                        ?>
                        <tr>
                          <td><?php echo $b++; ?></td>
                        <td><?php echo $studAttend['student_name'];?></td>
                        <td>
                          <?php 
                              if($status == 1){
                                echo "Present";
                              }else{
                                echo "Absent";
                              }
                          ?>
                        </td>
                        <td><input type="checkbox" name="deleteMultiple"></td>
                        </tr>
                      <?php } ?>
                      </table>
                  </div>
                </div>
              </div>
              <div class="square square-rounded shadow">
                 <?php 
                 $teacher = $_SESSION['NAME'];
                  $date = date('Y-m-d');
                  $attendQuery = "select id,student_name,status from student_attendance where dates='$date' and class_teacher='$teacher' and status=1";
                  $resultAttend = mysqli_query($con,$attendQuery);
                  $numPres = mysqli_num_rows($resultAttend);
                  $attendQuery1 = "select id,student_name,status from student_attendance where dates='$date' and class_teacher='$teacher' and status=0";
                  $resultAttend1 = mysqli_query($con,$attendQuery1);
                  $numAbs = mysqli_num_rows($resultAttend1);
                  $classAndSectionQ = "select class,section from assign_class_teacher where teacher_name='$teacher'";
                  $resultClassAndSection = mysqli_query($con,$classAndSectionQ);
                  $rowClassAndSection = mysqli_fetch_assoc($resultClassAndSection);
                  $class = $rowClassAndSection['class'];
                  $section = $rowClassAndSection['section'];
                  $studentQ = "select name from students where class='$class' and section='$section'";
                  $resultS = mysqli_query($con,$studentQ);
                  $student_num = mysqli_num_rows($resultS);
                  $prePercent = ($numPres/$student_num)*100;
                  $absPercent = ($numAbs/$student_num)*100;
                  ?>
                  <table class="table table-dark table-bordered">
                    <tr>
                      <th>Total Present:</th><td><?php echo $numPres;?></td>
                      <th>Total Absent:</th><td><?php echo $numAbs;?></td>
                    </tr>
                    <tr>
                      <th>Present Percent:</th><td><?php echo round($prePercent,2) ."%";?></td>
                      <th>Absent Percent:</th><td><?php echo round($absPercent,2) ."%";?></td>
                    </tr>
                  </table>
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