
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AutoAttendance | Dashboard</title>
<?php
require_once("includeFaculty/requiredCss.php");
?>
</head>
<body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
<div class="wrapper">

<?php

    // top header
    require("includeFaculty/header.php");
    // left navigation
    require("includeFaculty/mainNavigation.php");
 ?>

<?php
//echo $_SESSION['username'];
//        echo $_SESSION['faculty_name'];

$uname = $_SESSION['username'];
if(!isset($_SESSION['username']) )
{
    
        header("location: index.php");
}
    echo $uname;
?>    
    
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Attendance
        <small>Main panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->

     
    <!-- select -->
    <div class="form-group" style="margin-left:25%; margin-right:25%;">
     
        
        <label>Select Course</label>
      <form role="form" action="sessionInsert.php?count=0" method="post">  
      <select class="form-control" id="courseList" name="courseList" required="true">
          <option>--Select Course--</option>
          <?php
                $sql2="select c.id,c.name from courses c ,faculties f,faculty_courses s where f.id=s.faculty_id and s.course_id=c.id and f.email_id='$uname'";
                $results=mysqli_query($con,$sql2);
				while($row=mysqli_fetch_array($results))
                {
          ?>
          <option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
          <?php 
                }
          ?>
      </select>
    </div>

    <div class="box-body">
      
        <!-- text input -->
        <div class="form-group" style="margin-left:25%; margin-right:25%;">
          <label>Enter Time (in Minutes)</label>
          <input type="number" class="form-control" placeholder="Enter ..." name="time" id="time" required>
        </div>
    
          </div>

    <center>

      <button type="submit" class="btn btn-primary btn-lg"style=" margin-top:4%;">Start Attendance</button>
    </form>
      </center>

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<!-- footer -->
<?php require_once("includeFaculty/footer.php"); 
?>
    </div>
</body>
</html>