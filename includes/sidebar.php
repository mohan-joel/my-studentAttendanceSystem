


        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <?php if($_SESSION['ROLE'] == "Admin") { ?>
              <a href="adminProfile.php" class="nav-link">
                <div class="nav-profile-image">
                  <img src="uploads/images/<?=$_SESSION['PHOTO']?>" alt="profile">
                  <span class="login-status online"></span>
                  <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                  <span class="font-weight-bold mb-2"><?php echo $_SESSION['NAME']; ?></span>
                  <span class="text-secondary text-small"><?php echo $_SESSION['ROLE']; ?></span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
              </a>
            <?php }elseif($_SESSION['ROLE']=="Teacher") { ?>
              <a href="teacherProfile.php" class="nav-link">
                <div class="nav-profile-image">
                  <img src="uploads/images/<?=$_SESSION['PHOTO']?>" alt="profile">
                  <span class="login-status online"></span>
                  <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                  <span class="font-weight-bold mb-2"><?php echo $_SESSION['NAME']; ?></span>
                  <span class="text-secondary text-small"><?php echo $_SESSION['ROLE']; ?></span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
              </a>
            <?php } else { ?>
              <a href="studentProfile.php" class="nav-link">
                <div class="nav-profile-image">
                  <img src="uploads/images/<?=$_SESSION['PHOTO']?>" alt="profile">
                  <span class="login-status online"></span>
                  <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                  <span class="font-weight-bold mb-2"><?php echo $_SESSION['NAME']; ?></span>
                  <span class="text-secondary text-small"><?php echo $_SESSION['ROLE']; ?></span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
              </a>
            <?php } ?>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="dashboard.php">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
              </a>
            </li>
            <?php if($_SESSION['ROLE']=="Admin"):?>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic1" aria-expanded="false" aria-controls="ui-basic1">
                <span class="menu-title">Teachers</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-crosshairs-gps menu-icon"></i>
              </a>
              <div class="collapse" id="ui-basic1">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="show-teachers.php">Show Teachers</a></li>
                </ul>
              </div>
              <div class="collapse" id="ui-basic1">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="assign-class-teacher.php">Assign Class Teachers</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic5" aria-expanded="false" aria-controls="ui-basic5">
                <span class="menu-title">Classes</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-crosshairs-gps menu-icon"></i>
              </a>
              <div class="collapse" id="ui-basic5">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="show-classes.php">Show Classes</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic2" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Students</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-crosshairs-gps menu-icon"></i>
              </a>
              <div class="collapse" id="ui-basic2">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="show-students.php">Show Students</a></li>
                </ul>
              </div>
            </li>
            <?php elseif($_SESSION['ROLE']=="Teacher"):?>
              <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic3" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Students</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-crosshairs-gps menu-icon"></i>
              </a>
              <div class="collapse" id="ui-basic3">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="show-students.php">Show Students</a></li>
                </ul>
              </div>
            </li>
             <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic4" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Classes</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-crosshairs-gps menu-icon"></i>
              </a>
              <div class="collapse" id="ui-basic4">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="show-classes.php">Show Classes</a></li>
                </ul>
              </div>
            </li>
             <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic5" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Attendance</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-crosshairs-gps menu-icon"></i>
              </a>
              <div class="collapse" id="ui-basic5">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="take-student-attendance.php">Take Attendance</a></li>
                  <?php 
                      $teacher_name = $_SESSION['NAME'];
                      $query = "select class,section from student_attendance where class_teacher='$teacher_name'";
                      $result = mysqli_query($con,$query);
                      $row = mysqli_fetch_assoc($result);
                      $class = $row['class'];
                      $section = $row['section'];
                  
                  ?>
                  <li class="nav-item"> <a class="nav-link" href="show-attendance.php?class=<?=$class;?>&section=<?=$section;?>">Attendance Report</a></li>
                </ul>
              </div>
            </li>
          <?php endif;?>
         
          </ul>
        </nav>