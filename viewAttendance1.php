<?php

$courseId = $_POST['courseId'];
$date = $_POST['datepicker'];
$newDate = date("Y-m-d", strtotime($date));
$query = "SELECT * from student_attendances where course_id = $courseId and created_at = '$newDate' and is_present=1 order by student_id";
//echo($query);


?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AutoAttendance | ViewAttendance</title>
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

$query1 = "SELECT name from courses where id = $courseId";
$result1 = mysqli_query($con,$query1);
$row1 = mysqli_fetch_array($result1);


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
        <small>View Attendance</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">View Attendance</li>
      </ol>
    </section>

    <div class="form-group" style="margin-left:25%; margin-right:25%; margin-bottom:-15px;">
    <h3 class="content-header">
      <label><?php echo $row1['name']; ?> - Attendance on <?php echo $date; ?></label>
      </h3>
      <label> Student IDs Present: </label>
      <table>
        
      <?php
      		$results = mysqli_query($con, $query);
			
			while($row=mysqli_fetch_array($results))
                {
                	$studentId = $row['student_id'];
                ?>
        <tr>	
        <td>
        <input type="checkbox" value= "<?php echo $row['student_id']; ?>" name="attendees[]" <?php if ($row['is_present'] == 1) {echo "checked = checked";} ?>" disabled=true>
        
        <?php echo $row['student_id']; ?>
        </td>
        </tr>
        <?php
       	}
      ?>
        <tr>

        </tr>

        </table>

</div>
</div>
</div>

<?php require_once("includeFaculty/footer.php"); ?>

</body>
</html>