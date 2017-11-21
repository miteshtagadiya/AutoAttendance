
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AutoAttendance | EditStudents</title>
<?php
require_once("includeFaculty/requiredCss.php");
?>

<style media="screen">

input[type="file"] {
    display: none;
}
.custom-file-upload {
    border: 1px solid #ccc;
    display: inline-block;
    padding: 6px 12px;
    cursor: pointer;
    margin-top: 15%;
}
</style>
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
        <small>Edit Students</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Students</li>
      </ol>
    </section>

    <!-- Main content -->

      <form action="EditStudentInsert.php" name="form1" enctype="multipart/form-data" method="post">
    <!-- select -->
    <div class="form-group" style="margin-left:25%; margin-right:25%; margin-bottom:0px;">
      <label>Select Course</label>
      <select name="cid" class="form-control" required="true">
          <option>--Select Course--</option>
          <?php
//                $sql2="select f.course_id,c.name from course c ,faculty_course f where c.id=f.course_id and f.faculty_id='$uname'";
                $sql2="select c.id,c.name from courses c ,faculties f,faculty_courses s where f.id=s.faculty_id and s.course_id=c.id and f.email_id='$uname'";
                $results=mysqli_query($con,$sql2);
				while($row=mysqli_fetch_array($results))
                {
          ?>
          <option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
          <?php 
                }
          ?>
<!--
          
        <option>Software Engineering</option>
        <option>Data Structures</option>
        <option>Enterprise Computing</option>
-->
      </select>
        
    </div>
      <div style=" margin-left:40%;">
          <label class="custom-file-upload">
        <input type="file" name="file" id="file" required="true" />
        <i class="fa fa-cloud-upload"></i> Custom Upload
      </label>
          <button type="submit" id="submit" name="Import" style="margin-left:10px;" class="btn btn-primary" >Upload</button>
          
      </div>
      </form>


  </div>
  <!-- /.content-wrapper -->
<!-- footer -->

<?php require_once("includeFaculty/footer.php"); ?>

</body>
</html>
