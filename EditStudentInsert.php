<?php

require('db_connect.php');
$id=$_POST['cid'];
//echo $id;
 if(isset($_POST["Import"])){
		
		$filename=$_FILES["file"]["tmp_name"];		


		 if($_FILES["file"]["size"] > 0)
		 {
		  	$file = fopen($filename, "r");
	        while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
	         {


	           $sql = "INSERT into course_student (student_id,course_id) values ('".$getData[0]."',$id)";
                   $result = mysqli_query($con, $sql);
				if(!isset($result))
				{
					echo "<script type=\"text/javascript\">
							window.location = \"home.php\"
						  </script>";		
				}
				else {
					  echo "<script type=\"text/javascript\">
						window.location = \"editStudents.php\"
					</script>";
				}
                
	         }
			
	         fclose($file);	
		 }
	}	 


 ?>