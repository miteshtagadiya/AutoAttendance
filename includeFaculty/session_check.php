<?php
$fname = $_SERVER["PHP_SELF"];

//echo $_SESSION['fname'];


if(!isset($_SESSION['username']) )
{
    
        header('location: index.php');
}
    

?>