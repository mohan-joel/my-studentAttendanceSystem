<?php 
  session_start();
  // include database connection file
  include_once('config.php');
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
        
        <!-- partial -->
        <!-- main dashboard -->
              
<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <?php if (isset($_SESSION['msg'])) { ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                          <strong>Success:</strong><?=$_SESSION['msg'];?>
                          <?php unset($_SESSION['msg']); ?>
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        
                      <?php } ?>
        <div class="col-md-3 border-right">
            <form action="change_teacher_profile_pic.php" method="post" enctype="multipart/form-data">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="uploads/images/<?php echo $_SESSION['PHOTO']; ?>">
                    <div class="form-group">
                        <input type="file" name="photo" class="form-control form-control-sm">
                        <button type="submit" name="submit" class="btn btn-sm btn-success" >Change Photo</button></div>
                    </div>
            </form>
        </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">General Info Settings</h4>
                </div>
                <div class="row mt-3">
                    <span id="general_info_change" style="color: red;"></span>
                    <div class="col-md-12"><label class="labels">Name:</label><input type="text" class="form-control" id="name" placeholder="Enter Name" value="<?=$_SESSION['NAME'];?>"></div>
                    <div class="col-md-12"><label class="labels">Email</label><input type="text" class="form-control" id="email"  placeholder="Enter Email" value="<?=$_SESSION['EMAIL'];?>"></div>
                    <div class="col-md-12"><label class="labels">Address </label><input type="text" class="form-control" id="address" placeholder="Enter Address" value="<?=$_SESSION['ADDRESS'];?>"></div>
                    <div class="col-md-12"><label class="labels">Contact</label><input type="text" class="form-control" id="contact" placeholder="Enter Contact" value="<?=$_SESSION['contact'];?>"></div>
                   <button class="btn btn-sm btn-primary profile-button generalInfoid" type="button" id="generalInfoid">Change General Info</button>
                </div>
                
                
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Password Settings</h4>
                </div>
                <div class="col-md-12"><label class="labels">Current Password</label><input type="password" class="form-control current_password" placeholder="Enter Current Password" id="current_password"></div><span id="check_current_password" style="font-size: 10px;"></span> <br>
                <div class="col-md-12"><label class="labels">New Password</label><input type="password" class="form-control" placeholder="Enter New Password"  id="new_password"></div>
                <div class="col-md-12"><label class="labels">Re-Type New Password</label><input type="password" class="form-control" placeholder="Re-Type New Password"  id="confirm_new_password"></div><span id="confirm_change_msg" style="font-size: 10px;"></span>
                <button class="btn btn-sm btn-danger " type="button" id="change_password">Change Password</button>
            </div>
            <span id="changed_password_msg" style="font-size: 10px;"></span>
        </div>
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

    <!-- change general info of admin -->
    <script type="text/javascript">
        $(document).ready(function(){
            $(document).on("click",".generalInfoid",function(){
                var name = $("#name").val();
                var email = $("#email").val();
                var address = $("#address").val();
                var contact = $("#contact").val();
                $.ajax({
                    url: "edit_admin_general_info.php",
                    type: "post",
                    data:{name:name,email:email,address:address,contact:contact},
                    success:function(data){
                        if(data == 1){
                            $("#general_info_change").html("General Info Changed Successfully").css("color","green");
                        }else{
                            $("#general_info_change").html("Unable to change general info").css("color","red");
                        }
                    }
                });
            });

            // checking entered password matches admin password in database
            $("#current_password").keyup(function(){
                var current_password = $("#current_password").val();
                $.ajax({
                    url:"check_current_password.php",
                    type:"post",
                    data:{current_password:current_password},
                    success:function(data){
                        if(data == 1){
                            $("#check_current_password").html("Current Password is Right").css("color","green");
                        }else{
                            $("#check_current_password").html("Current Password is Wrong").css("color","red");
                        }
                    }
                })
            });


            // checking whether retype new password matches with new password or not
            $("#confirm_new_password").keyup(function(){
                var new_password = $("#new_password").val();
                var confirm_new_password = $("#confirm_new_password").val();
                if(new_password == confirm_new_password){
                    $("#confirm_change_msg").html("New password and Confirm New Password Matches").css("color","green");
                }else{
                    $("#confirm_change_msg").html("New password and Confirm New Password Unmatched").css("color","red");
                }
            });

            // change password by clicking button
            $(document).on("click","#change_password",function(){
                var new_password = $("#new_password").val();
                $.ajax({
                    url:"change_password.php",
                    type: "post",
                    data:{new_password:new_password},
                    success:function(data){
                        if(data == 1){
                            $("#changed_password_msg").html('Password Changed Successfully!!!').css("color","green");
                        }else{
                            $("#changed_password_msg").html('Unable to change password').css("color","red");
                        }
                    }
                });
            });
        });
    </script>
  </body>
</html>