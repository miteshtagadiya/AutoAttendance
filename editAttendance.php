
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AutoAttendance | EditAttendance</title>
<?php
    
require_once("includeFaculty/requiredCss.php");
?>

<!-- bootstrap datepicker -->
<link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
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
//session_start();

//echo $_SESSION['username'];
//        echo $_SESSION['faculty_name'];

$uname = $_SESSION['username'];
if(!isset($_SESSION['username']) )
{
    
        header("location: index.php");
}
?>    

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Attendance
        <small>Edit Attendance</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Attendance</li>
      </ol>
    </section>

    <!-- Main content -->

    <!-- select -->
    <form method="post" action="getAttendance.php">
    <div class="form-group" style="margin-left:25%; margin-right:25%; margin-bottom:-15px;">
      <label>Select Course</label>
      <select class="form-control" id="courseId" name="courseId" required="true">
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
      
        <div class="form-group "style=" margin-top:10px;">
        <label>Date:</label>

          
        <div class="input-group date" style="margin-right:30%">
          <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
          </div>
          <input type="text" class="form-control pull-right" id="datepicker" name="datepicker" required="true" required="true">
        </div>
        <br><br>
        <button type="submit" class="btn btn-lg btn-success"><i class="fa fa-history" style="margin-right:5%"></i>Get Attendance</button>
        <!-- /.input group -->
      </div>
      <!-- /.form group -->
      </div></form>
    

    <!-- Date -->

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<!-- footer -->

<script>
  $(function () {
    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    });
  });
</script>

<?php require_once("includeFaculty/footer.php"); ?>

</body>
</html>
