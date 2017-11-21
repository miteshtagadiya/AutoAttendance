<?php
session_start();
require("db_connect.php");
$uname = $_SESSION['username'];

if(isset($_POST['edit_image']))
{
    if (isset($_FILES['image']['tmp_name'])) {

        
        $file=$_FILES['image']['tmp_name'];
        $image= addslashes(file_get_contents($_FILES['image']['tmp_name']));
        $image_name= addslashes($_FILES['image']['name']);
        $path=$images. rand(10000, 990000). '_'. time();
        echo "Path: " . $path . "Name: " . $_FILES["image"]["name"]; 
      
        move_uploaded_file($_FILES["image"]["tmp_name"],"./images/" . $_FILES["image"]["name"]) or die("ERROR");
        
        $image_save =$_FILES["image"]["name"];

        
    }
}
 $query =  "UPDATE faculties SET img_url ='$image_save' WHERE email_id = '$uname'";

$results = mysqli_query($con,$query) or die(mysql_error()); 

header("Location: home.php");     


?>