<?php
session_start();
//echo $_SESSION['username'];
//        echo $_SESSION['faculty_name'];

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
<header class="main-header">
  <!-- Logo -->
  <a href="home.php" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>A</b>A</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>Auto</b>Attendance</span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>

    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="images/<?php echo $row['img_url']; ?>" class="user-image" alt="User Image">
            <span class="hidden-xs"><?php echo $row['name']; ?></span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              <img src="images/<?php echo $row['img_url']; ?>" class="img-circle" alt="User Image">

              <p>
                Prof. <?php echo $row['name']; ?>
              </p>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-left">
                <a href="change_pass.php" class="btn btn-default btn-flat">Edit Profile</a>
              </div>
              <div class="pull-right">
                <a href="index.php" class="btn btn-default btn-flat">Sign out</a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>
