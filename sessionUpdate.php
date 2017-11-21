<?php
    //sleep(15);
    require('db_connect.php');
    session_start();
    //$courseId = $_REQUEST['courseList'];
    //$time= $_REQUEST['time'];
    $id = $_REQUEST['courseList'];
    $iid= $_REQUEST['iid'];
    //$count = $_REQUEST['count'];
    $date = date('Y-m-d H:i:s');
    

	$sql2="update attendance_sessions set is_active=0 ,updated_at='$date' where course_id=$id and id=$iid";
    
    if(mysqli_query($con,$sql2))
	{

	header("location: home.php");

	}

	else
    {
        header('location: home.php');
    }
?>