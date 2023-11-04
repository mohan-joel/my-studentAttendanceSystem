<?php 
include('config.php');
include('functions.php');

if(!isset($_SESSION['ID'])){
  header("location: login.php");
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
                </span> Dashboard  <?php echo $_SESSION['ROLE']; ?>
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
            <?php if(isset($_SESSION['NAME']) && $_SESSION['ROLE']=="Teacher"){ ?>
            <div class="row">
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-danger card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <?php 
                        $username = $_SESSION['NAME'];
                        $gQuery =  "select gender from users where name='$username'";
                        $gresult = mysqli_query($con,$gQuery);
                        $getGender = mysqli_fetch_assoc($gresult);
                        $gen = $getGender['gender'];
                    ?>
                    <font  style="color: black; font-weight: bold; font-size: 12px;">Respected,<br><?php echo $_SESSION['NAME'];?> <?php if($gen == "male"){ echo "Sir"; }else{ echo "Mam"; }?> </font>
                    <?php 
                       $name = $_SESSION['NAME'];
                      $query = "select * from assign_class_teacher where teacher_name ='$name'";
                      $result = mysqli_query($con,$query);
                      $resultRow = mysqli_fetch_assoc($result);
                    ?>

                    <?php  if($resultRow == null) { ?>
                      <h6 style="color: red;">You are not assign as class teacher till now</h6>
                    <?php }else{ ?>
                   <hr style="color: black;width: 50px solid;">
                    <?php 
                      $name = $_SESSION['NAME'];
                      $query = "select * from assign_class_teacher where teacher_name ='$name'";
                      $result = mysqli_query($con,$query);
                      while($row=mysqli_fetch_assoc($result)){
                    ?>
                    <font style="color: blue;font-size: 12px;">You are class teacher of Class <?=$row['class'];?> <?php echo "'".$row['section']."'";?></font> 
                  <?php }?>
                   <hr style="color: black;width: 50px solid;">
                 <?php } ?>
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                      <?php
                      $sql = "select class,section from assign_class_teacher where teacher_name='$name'";
                      $result = mysqli_query($con,$sql);
                      $row = mysqli_fetch_assoc($result);
                      ?>
                      <?php if($row == null) {?>
                        <u style="color: black;"><font style="font-weight: bold; font-size: 15px;">Total Students in your class</font></u>
                        <h6 style="color: red;">You are not assigned as class teacher till now</h6>
                        <?php } else{ ?>
                    <?php
                      $sql = "select class,section from assign_class_teacher where teacher_name='$name'";
                      $result = mysqli_query($con,$sql);
                      while($row = mysqli_fetch_assoc($result)){
                        $cla = $row['class'];
                        $sec = $row['section'];
                      }
                      $sql1 = "select name from students where class='$cla' and section='$sec'";
                      $result1 = mysqli_query($con,$sql1);
                      $num_stu = mysqli_num_rows($result1);
                      $sqlb = "select name from students where class='$cla' and section='$sec' and gender='boy'";
                      $resb = mysqli_query($con,$sqlb);
                      $num_boys = mysqli_num_rows($resb);
                      $num_girls = $num_stu - $num_boys;
                     ?>
                    <h6 style="color: black; font-size: 12px;">Total Students: <?=$num_stu?>
                    </h6><hr style="color: black;width: 50px solid;">
                    <ul style="color: purple;">
                      <li style="font-size: 12px;">Number of boys:<?php echo $num_boys; ?></li>
                      <li style="font-size: 12px;">Number of girls:<?php echo $num_girls; ?></li>
                    </ul>
                  <?php } ?>
                     <hr style="color: black;width: 50px solid;">
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <u style="color: black; font-size: 13px; font-weight: bold;">Today's Attendance</u>
                    <?php 
                      $date = date('Y-m-d');
                      $teacher = $_SESSION['NAME'];
                      $query = "select class,section from assign_class_teacher where teacher_name='$teacher'";
                      $result = mysqli_query($con,$query);
                      $res = mysqli_fetch_assoc($result);
                    ?>

                    <?php 
                      if($res == null){
                    ?>
                    <ul style="color: red; font-size: 12px;">
                      <li>You are not assigned as class teacher till now.</li>
                    </ul>
                  <?php } else { ?>

                      <?php 
                      $date = date('Y-m-d');
                      $teacher = $_SESSION['NAME'];
                      $query = "select class,section from assign_class_teacher where teacher_name='$teacher'";
                      $result = mysqli_query($con,$query);
                      $res = mysqli_fetch_assoc($result);
                      $class = $res['class'];
                      $section = $res['section'];
                      $sql = "select student_name from student_attendance where class='$class' and section='$section' and dates='$date' and status=1";
                      $ress = mysqli_query($con,$sql);
                      $numPres = mysqli_num_rows($ress);
                      $sql1 = "select student_name from student_attendance where class='$class' and section='$section' and dates='$date' and status=0";
                      $resss = mysqli_query($con,$sql1);
                      $numAbs = mysqli_num_rows($resss);
                    ?>
                    <ul>
                      <li style="color: purple;font-size: 12px;">Present Student: <?=$numPres?></li>
                      <li style="color: purple;font-size: 12px;">Absent Student: <?=$numAbs?></li>
                    </ul>
                  <?php } ?>
                    <hr style="color: black;width: 50px solid;">
                    <u style="color: black;font-size: 10px; font-weight: bold;">List of Absent Students</u>

                    <?php 
                         $date = date('Y-m-d');
                      $teacher = $_SESSION['NAME'];
                      $query = "select class,section from assign_class_teacher where teacher_name='$teacher'";
                      $result = mysqli_query($con,$query);
                      $res = mysqli_fetch_assoc($result);
                      ?>
                      <?php if($res == null) { ?>
                        <ul style="color: red; font-size: 12px;">
                          <li>You are not assigned as class teacher till now</li>
                        </ul>
                      <?php }else { ?>
                    <ul style="color: brownfont; font-size: 10px;">
                      <?php 
                         $date = date('Y-m-d');
                      $teacher = $_SESSION['NAME'];
                      $query = "select class,section from assign_class_teacher where teacher_name='$teacher'";
                      $result = mysqli_query($con,$query);
                      $res = mysqli_fetch_assoc($result);
                      $class = $res['class'];
                      $section = $res['section'];
                      $sql = "select student_name from student_attendance where class='$class' and section='$section' and dates='$date' and status=1";
                      $ress = mysqli_query($con,$sql);
                      $numPres = mysqli_num_rows($ress);
                      $sql1 = "select student_name from student_attendance where class='$class' and section='$section' and dates='$date' and status=0";
                      $resss = mysqli_query($con,$sql1);
                      $numAbs = mysqli_num_rows($resss);
                      while($AbStd = mysqli_fetch_assoc($resss)){
                      ?>
                      <li><?=$AbStd['student_name'];?></li>
                      <?php } ?>
                    </ul>
                  <?php } ?>
                    <hr style="color: black;width: 50px solid;">
                  </div>
                </div>
              </div>
            </div>
              <?php }else{ ?>
                <div class="row">
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-danger card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3" style="color: purple;font-size: 12px;">Respected, </h4><h5 style="color: black; font-size: 12px;"><?php echo $_SESSION['NAME']; ?></h5>
                    <hr style="color: black;width: 50px solid;">
                     <?php 
                      $queryTeacher = "select name from users where role='Teacher'";
                      $resTeacher = mysqli_query($con,$queryTeacher);
                      $num_Teachers = mysqli_num_rows($resTeacher);
                    ?>
                    <h6 class="mb-5" style="color: blue; font-size: 12px;">Total Teachers: <?=$num_Teachers;?></h6> 
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <?php 
                      $queryStudent = "select name from students";
                      $resStudent = mysqli_query($con,$queryStudent);
                      $num_Student = mysqli_num_rows($resStudent);
                      $queryBoys = "select name from students where gender='boy'";
                      $resBoys = mysqli_query($con,$queryBoys);
                      $totalBoys = mysqli_num_rows($resBoys);
                      $totalGirls = $num_Student - $totalBoys;
                    ?>
                    <h6 style="color: black; font-size: 12px;" class="card-title">Total Students: <?=$num_Student;?> 
                    </h6>
                    <hr style="color: black;width: 50px solid;">
                    <ul>
                      <li><h6 style="color: purple; font-size: 12px;">Boys:<?=$totalBoys;?></h6></li>
                      <li><h6 style="color: teal; font-size: 12px;">Girls:<?=$totalGirls;?></h6></li>
                    </ul> 
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h6 style="font-size: 12px; color: black;">Today's Overall Attendance
                    </h6>
                    <hr style="color: black;width: 50px solid;">
                    <?php
                    $date = date('Y-m-d');
                      $totalPresentQuery = "select student_name from student_attendance where dates='$date' and status = 1";
                      $resTotalPresent = mysqli_query($con,$totalPresentQuery);
                      $numTotalPresent = mysqli_num_rows($resTotalPresent);
                      $totalAbsentQuery = "select student_name from student_attendance where dates='$date' and  status = 0";
                      $resTotalAbsent = mysqli_query($con,$totalAbsentQuery);
                      $numTotalAbsent = mysqli_num_rows($resTotalAbsent);
                      $totalAttendQ = "select name from students";
                      $resultAttend = mysqli_query($con,$totalAttendQ);
                      $wholeTotalStudent = mysqli_num_rows($resultAttend);
                      $wholePresentPercent = ($numTotalPresent/$wholeTotalStudent)*100;
                      $wholeAbsentPercent = ($numTotalAbsent/$wholeTotalStudent)*100;
                     ?>
                    <h6 style="font-size: 12px; color: purple;">Total Present: <?=$numTotalPresent;?> </h6>
                    <h6 style="font-size: 12px; color: purple;">Total Absent: <?=$numTotalAbsent;?></h6>
                    <h6 style="font-size: 12px; color: purple;"> Present Percent: <?php echo  round($wholePresentPercent,2) ."%";?> </h6>
                    <h6 style="font-size: 12px; color: purple;">Absent Percent: <?php echo round($wholeAbsentPercent,2) ."%";?></h6>
                  </div>
                </div>
              </div>
              <table class="table table-dark">
                <thead>
                  <tr>
                    <th>S.No.</th>
                    <th>Class</th>
                    <th>Section</th>
                    <th>Name of Class Teacher</th>
                    <th>Total Number of Students</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $c=1;
                      $queryCS = "select class_name,section_name from classes";
                      $resultCS = mysqli_query($con,$queryCS);
                      while($CS = mysqli_fetch_assoc($resultCS)){
                        $class = $CS['class_name'];
                        $section = $CS['section_name'];
                        $CTQuery = "select teacher_name from assign_class_teacher where class='$class' and section='$section'";
                        $resultCT = mysqli_query($con,$CTQuery);
                        while($classTeacher = mysqli_fetch_assoc($resultCT)){
                          $numSECQ = "select name from students where class='$class' and section='$section'";
                          $resultSECQ = mysqli_query($con,$numSECQ);
                          $num_students_in_each_class = mysqli_num_rows($resultSECQ);
                    ?>
                  <tr>
                    <td><?=$c++;?></td>
                    <td><?=$class;?></td>
                    <td><?=$section;?></td>
                    <td><?=$classTeacher['teacher_name'];?></td>
                    <td><?=$num_students_in_each_class?></td>
                  </tr>
                  <?php }?>
                  <?php }?>
                </tbody>
              </table>
              </div>
            <?php }?>
           
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