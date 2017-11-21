<?php

require('db_connect.php');
session_start();

$uname=$_SESSION['username'];
$uid=$_SESSION['uid'];
$course = $_POST['courses'];

$sql1="delete from faculty_courses where faculty_id='$uid'";
$results=mysqli_query($con,$sql1);

foreach($course as $co)
{
    $sql2="insert into faculty_courses (faculty_id,course_id) values ($uid,$co)";
                $results1=mysqli_query($con,$sql2);
                if(isset($results1))
                {
                   header('location: editCourses.php');
                }
                else
                {
                    header('location: editCourses.php');
                }
}


?>