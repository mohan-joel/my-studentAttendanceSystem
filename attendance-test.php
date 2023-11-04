<?php 
 require"functions.php";
 include_once('config.php');
 if(!isset($_SESSION['ID'])){
     header("location: login.php");
 }

 


if(isset($_POST['submit'])){
$date = $_POST['date'];
$class = $_POST['class'];
$section =$_POST['section'];
$teacher_name = $_POST['teacher_name'];
$student_name = $_POST['student_name'];
$status = $_POST['status'];

$count = count($student_name);
echo $count;

for($i=0; $i < $count ; $i++){
    $date = mysqli_real_escape_string($con,$date[$i]);
    $class = mysqli_real_escape_string($con,$class[$i]);
    $section = mysqli_real_escape_string($con,$section[$i]);
    $teacher_name = mysqli_real_escape_string($con,$teacher_name[$i]);
    $student_name = mysqli_real_escape_string($con,$student_name[$i]);
    $status = mysqli_real_escape_string($con,$status[$i]);

    $query = "insert into  student_attendance (dates,class,section,class_teacher,student_name,status) values ('$date','$class','$section','$teacher_name','$student_name','$status')";
    $result = mysqli_query($con,$query);
    if($result){
        redirect("attendance-test.php",'success');
    }else{
        redirect("attendance-test.php",'unsuccess');
    }
}
   
}



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test</title>
</head>
<body>



<?php if (isset($_SESSION['msg'])) { ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                          <strong>Success:</strong><?=$_SESSION['msg'];?>
                          <?php unset($_SESSION['msg']); ?>
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        
                      <?php } ?>
    
 <form action="" method="post">
    <table>
        <thead>
           <tr>
            <th>Date</th>
                <th>Class</th>
                <th>Section</th>
                <th>Class Teacher</th>
                <th>Student Name</th>
                <th>Attendance</th>
           </tr>
        </thead>
        <tbody>

        <?php 
            $query = "select name from students where class='1' and section='A'";
            $result = mysqli_query($con,$query);
           while( $row = mysqli_fetch_assoc($result)){
        
        ?>
            <tr>
                <td><input type="text" value="2023-11-02" name="date[]"></td>
                <td><input type="text" value="1" name="class[]"></td>
                <td><input type="text" value="A" name="section[]"></td>
                <td><input type="text" value="Saman Raj Baidhya" name="teacher_name[]"></td>
                <td><input type="text" value="<?=$row['name'];?>" name="student_name[]"></td>
                <td><input type="text" name="status[]" value="present"></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
        <input type="submit" value="Submit" name="submit">
    </form>
</body>
</html>