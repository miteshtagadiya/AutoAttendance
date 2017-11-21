<!DOCTYPE html>
<html>
<head>
    <script type="text/javascript">
//    function allnumeric(inputtxt)  
//   {  
//      var numbers = /^[0-9]+$/;  
//       var pattern = /^\d{9}$/;
//      if(inputtxt.value.match(numbers) && pattern.test(pattern))  
//      {  
//     
//      }  
//      else  
//      {  
//      alert('Wrong Input');  
//      //document.form1.text1.focus();  
//      return false;  
//      }  
//   }
    </script>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AutoAttendance | Log in</title>

  <?php
    
    if(isset($_GET['value']))
    {
        $val = $_GET['value'];
        if($val == 'false')
        {
            echo "<script> alert('Wrong username or password..')</script>";
        }
    }
	require_once("includeFaculty/requiredCss.php");
  ?>
    <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="index.php"><b>Auto</b> Attendance</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form action="login_check.php" name="form1" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="User Name" name="uname" value="<?php if(isset($_COOKIE['username'])) { echo $_COOKIE['username']; }?>" required="true">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password" value="<?php if(isset($_COOKIE['password'])) { echo $_COOKIE['password']; } ?>" required="true">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" name="rememberme" value="on" id="rememberme"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat" >Sign In</button>
        </div>
        <!-- /.col     onclick="allLetter(document.form1.uname)"-->
      </div>
    </form>



    <a href="#">I forgot my password</a><br>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>

<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
