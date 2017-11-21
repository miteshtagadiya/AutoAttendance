<?php
$uname = $_SESSION['username'];
//if(!isset($_SESSION['username']) )
//{
//    
//        header("location: index.php");
//}


	$sql2="select * from faculties where email_id='$uname'";
	$results=mysqli_query($con,$sql2);
	$row=mysqli_fetch_array($results);
	

?>
?>

<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="images/<?php echo $row['img_url']; ?>" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo $row['name']; ?></p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="header">MAIN NAVIGATION</li>
      <li class="active treeview">
        <a href="#">
          <i class="fa fa-dashboard"></i> <span>Attendance</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="editAttendance.php"><i class="fa fa-circle-o"></i> Edit Attendance</a></li>
          <li><a href="viewAttendance.php"><i class="fa fa-circle-o"></i> View Attendance</a></li>
        </ul>
      </li>
      <!--
      <li>
        <a href="pages/calendar.html">
          <i class="fa fa-calendar"></i> <span>Calendar</span>
          <span class="pull-right-container">
            <small class="label pull-right bg-red">3</small>
            <small class="label pull-right bg-blue">17</small>
          </span>
        </a>
      </li>
    -->
      <li>
        <a href="editStudents.php">
          <i class="fa fa-users"></i> <span>Edit Students</span>
        </a>
      </li>
      <li>
        <a href="editCourses.php">
          <i class="fa fa-book"></i> <span>Edit Courses</span>
        </a>
      </li>
      <li>
        <a href="analytics.php">
          <i class="fa fa-bar-chart"></i> <span>Attendance Analytics</span>
        </a>
      </li>

    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
