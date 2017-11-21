<?php
    require('db_connect.php');
    $username=$_POST['uname'];
    $password1=$_POST['password'];
	$password=md5($_POST['password']);

    session_start();

	$sql2="select * from faculties where email_id='$username' and password='$password'";
	$results=mysqli_query($con,$sql2);
    $counts=mysqli_num_rows($results);
	$row=mysqli_fetch_array($results);
	
    //echo $row['id'];

	if($counts==1)
	{
        
		
		$_SESSION['username']=$row['email_id'];
		$_SESSION['faculty_name']=$row['name'];
        $_SESSION['uid']=$row['id'];
//        
//        echo $_SESSION['username'];
//        echo $_SESSION['faculty_name'];
            if($_POST['rememberme']=='1' || $_POST['rememberme']=='on')
                    {
                    $hour = time() + 3600 * 24 * 30;
                    setcookie('username', $username, $hour);
                         setcookie('password', $password1, $hour);
                    }
        
    header('location: home.php');
	}

	else
    {
        header('location: index.php?value=false');
        
    }
?>