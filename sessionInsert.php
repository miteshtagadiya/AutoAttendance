<?php
    
    require('db_connect.php');
    session_start();
    $courseId = $_REQUEST['courseList'];
    $time= $_REQUEST['time'];
    $id = $_SESSION['uid'];
    $count = $_REQUEST['count'];
    $date = date('Y-m-d H:i:s');
    

	$sql2="insert into attendance_sessions(course_id,faculty_id,is_active,created_at) values($courseId,$id,1,'$date')";
  
    // echo $sql2;
    // echo $time;
     

	if(mysqli_query($con,$sql2))
	{
        $iid=mysqli_insert_id($con);
//    echo $sql2;
//    echo $password1;
//    echo $password;    
	header("location: attendance.php?count=0&time=$time&courseList=$courseId&iid=$iid");
	}

	else
    {
        header('location: home.php');
    }
?>