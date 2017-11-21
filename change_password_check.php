<?php
    require('db_connect.php');
    

    
    
    $password1=$_POST['confirm_password'];
	$password=md5($_POST['confirm_password']);

    session_start();
    $username=$_SESSION['username'];
    //echo $username;
	$sql2="update faculties set password='$password' where email_id='$username'";
    //echo $sql2;
	
	if(mysqli_query($con,$sql2))
	{
//    echo $sql2;
//    echo $password1;
//    echo $password;    
	header('location: index.php');
	}

	else
    {
        header('location: change_pass.php');
        
    }
?>