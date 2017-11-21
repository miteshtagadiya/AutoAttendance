
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AutoAttendance | Dashboard</title>
<?php
require_once("includeFaculty/requiredCss.php");
?>

<style media="screen">

/*input[type="file"] {
    display: none;
}*/
.custom-file-upload {
    border: 1px solid #ccc;
    display: inline-block;
    padding: 6px 12px;
    cursor: pointer;
    margin-top: 15%;
}

hr { 
    display: block;
    margin-top: 0.5em;
    margin-bottom: 0.5em;
    margin-left: none;
    margin-right: none;
    border-style: inset;
    border-width: 1px;
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
//echo $_SESSION['username'];
//        echo $_SESSION['faculty_name'];

$uname = $_SESSION['username'];
// var_dump($uname);
// exit(0);

if(!isset($_SESSION['username']) )
{
    
        header("location: index.php");
}
?>    
    

    
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-bottom:-15px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Attendance
        <small>Analytics panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Change Password</li>
      </ol>
    </section>

    <!-- Main content -->
    
      <form action="change_password_check.php" method="post">
    <div class="form-group"  style="margin-left:35%; margin-right:35%;">
    <label>Change Password</label><br><br>
    <label>Old Password</label>
      <input type="password" class="form-control" id="oldPassword" placeholder="Enter Old Password" required="true">
        
        <label>New Password</label>
      <input type="password" class="form-control" id="password" placeholder="Enter New Password" required="true">
        
        <label>Confirm Password</label>
      <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm New Password" required="true"> <span style="font-size:15px;" id='message'></span> 
    </div>
    <div class="col-sm-offset-4 col-sm-4">
    <div class="col-xs-6"> 
          <button type="submit" class="btn btn-primary btn-block btn-flat">Change Password</button>
        </div>

    </div>
      </form>
        
      <form action="change_image.php" method="post"  enctype="multipart/form-data" >

        <div class="form-group" style="margin-left:35%; margin-right:35%;">
        
        <br><br>
        <hr >
          <label>Edit Image </label>
          <br>
          
            <i class="fa fa-cloud-upload"></i>
            Select Image
          <input type="file" name="image" id="image" / required="true">

          <button type="submit" id="edit_image" name="edit_image" style="margin-left:10px;" class="btn btn-primary" >Change Image</button>
</form>
        </div>

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<!-- footer -->
    
<script>
    $('#password, #confirm_password').on('keyup', function () {
  if ($('#password').val() == $('#confirm_password').val()) {
    $('#message').html('Matching').css('color', 'green');
  } else 
    $('#message').html('Not Matching').css('color', 'red');
});
    </script>
    
<?php require_once("includeFaculty/footer.php"); ?>
    </div>
</body>
</html>