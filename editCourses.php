
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AutoAttendance | EditCourses</title>
  <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/select2.min.css">
<?php
    
require_once("includeFaculty/requiredCss.php");
?>

<script src="angular.min.js"></script>

</head>
<body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
<div class="wrapper">

<?php
    
    // top header
    require("includeFaculty/header.php");
    // left navigation
    require("includeFaculty/mainNavigation.php");
 ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit
        <small>Courses</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Courses</li>
      </ol>
    </section>
      
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

    <!-- Main content -->
    <form action="addLec.php" name="form1" method="post">
      <div class="col-md-12">
        
      <div class="form-group">
        <label>Multiple</label>
        <select class="form-group select2" name="courses[]" id="select" ng-model="select" multiple="multiple" data-placeholder="Select Courses"  id="dropdown" style="width: 100%;" multiple=multiple required="true">
         
          <?php
//                $sql2="select f.course_id,c.name from course c ,faculty_course f where c.id=f.course_id and f.faculty_id='$uname'";
            
                $sql2="select c.id,c.name from courses c ,faculties f,faculty_courses s where f.id=s.faculty_id and s.course_id=c.id and f.email_id='$uname'";
                $sql3="select c.id, c.name from courses c, faculties f, faculty_courses fc where f.id = fc.faculty_id and c.id not in (select course_id from faculty_courses) group by c.id;";
                $results=mysqli_query($con,$sql2);
                $results1=mysqli_query($con,$sql3);
                
				while($row=mysqli_fetch_array($results))
                {
          ?>
          <option value="<?php echo $row['id']; ?>" data-target="#inputDialog" selected="true"><?php echo $row['name'];?></option>
            
          <?php 
                }
            	while($row=mysqli_fetch_array($results1))
                {
          ?>
          <option value="<?php echo $row['id']; ?>" data-target="#inputDialog"><?php echo $row['name'];?></option>
            
          <?php 
                }
            
          ?>
        </select>
      </div>
        
    </div>
    <div class="text-center">
      <button type="submit" class="btn btn-success btn-lg" style="margin-top:4%;"><i class="fa fa-save" style="margin-right:5%"></i>Save Changes</button>
    
  </div>
        </form>
      
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- footer -->
  
  <!-- jQuery 2.2.3 -->
  
  
  <script>
      $(document).ready(function() {
    $('.select2').select2();
});
  </script>
    <script>
    function fun1()
    {
       // alert("it's ok");
    }
    </script>
  <?php require_once("includeFaculty/footer.php"); ?>
	
  
  <!-- Select2 -->
  <script src="plugins/select2/select2.full.min.js"></script>

  </body>
  </html>
