<?php
include("db_connect.php");
// var_dump($_POST['attendees']);
// echo $_POST['attendees'];
// exit(0);
$course_id = $_GET['cid'];
$date = $_GET['date'];
$query = "UPDATE student_attendances SET is_present=0 where created_at = '$date' and course_id = $course_id" ;
// echo $query;
// exit(0);
mysqli_query($con,$query) or die(mysqli_error());
// echo $query . "<br>";
// exit(0);
if(isset($_POST['attendees']) && !empty($_POST['attendees']))   
{
	foreach($_POST['attendees'] as $attendees)
    {
    	$updateQuery = "insert into student_attendances (is_present, student_id, course_id, created_at) values (1,$attendees,$course_id,'$date')";
    	// echo $updateQuery . "<br>";
    	mysqli_query($con,$updateQuery) or die(mysqli_error());
    	// echo $updateQuery . "<br>";
    }
}
header("location:editAttendance.php");
// $query = "select student_id from course_student where course_id = $course_id and student_id NOT IN $_POST['attendees']";
 // echo $query;
    

?>