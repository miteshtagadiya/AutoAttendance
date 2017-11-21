<?php
//include database configuration file
include 'db_connect.php';

session_start();
$cid=$_POST['cid'];
 if(isset($_POST["Export"])){
		 
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=data.csv');  
      $output = fopen("php://output", "w");  
      fputcsv($output, array('Id', 'Name','Attendance'));  
      $query = "SELECT s.id,s.name,a.is_present from students s,student_attendances a where s.id=a.student_id and a.course_id='$cid'";  
      $result = mysqli_query($con, $query);  
      while($row = mysqli_fetch_assoc($result))  
      {  
           fputcsv($output, $row);  
      }  
      fclose($output);  
 }  
elseif(isset($_POST["Pdf"])){
		 
$sql = "SELECT id, name, program_id, device_id FROM students";
$resultset = mysqli_query($con, $sql);
require('fpdf/fpdf/fpdf.php');
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
while ($field_info = mysqli_fetch_field($resultset)) {
$pdf->Cell(47,12,$field_info->name,1);
}
while($rows = mysqli_fetch_assoc($resultset)) {
$pdf->SetFont('Arial','',12);
$pdf->Ln();
foreach($rows as $column) {
$pdf->Cell(47,12,$column,1);
}
}
$pdf->Output();
 }  


//    // fetch mysql table rows
//    $sql = "select * from students";
//    $result = mysqli_query($con, $sql);
//
//    $fp = fopen('Record.csv', 'w');
//
//    while($row = mysqli_fetch_assoc($result))
//    {
//        fputcsv($fp, $row);
//    }
//    
//    fclose($fp);
//
//    //close the db connection
//    mysqli_close($con);
//
//header('Content-Type: text/csv');
//header('Content-Disposition: attachment; filename="' . $filename . '";');
// 

//get records from database
//$sql = "select * from students";
//  $result = mysqli_query($con, $sql);
//if(mysqli_num_rows($result) > 0){
//    $delimiter = ",";
//    $filename = "members_" . date('Y-m-d') . ".csv";
//    
//    //create a file pointer
//    $f = fopen('Record.csv', 'w');
//    
//    //set column headers
//    $fields = array('ID', 'Name');
//    fputcsv($f, $fields, $delimiter);
//    
//    //output each row of the data, format line as csv and write to file pointer
//    while($row = mysqli_fetch_assoc($result)){
//        $status = ($row['status'] == '1')?'Active':'Inactive';
//        $lineData = array($row['id'], $row['name'],$status);
//        fputcsv($f, $lineData, $delimiter);
//    }
//    
//    //move back to beginning of file
//    fseek($f, 0);
//    
//    //set headers to download file rather than displayed
//    header('Content-Type: text/csv');
//    header('Content-Disposition: attachment; filename="' . $filename . '";');
//    
//    //output all remaining data on a file pointer
//    fpassthru($f);
//}
//exit;

?>