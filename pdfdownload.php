<?php 

//var_dump($_REQUEST);
require('/fpdf/fpdf/fpdf.php');
require('db_connect.php');

if(isset($_REQUEST['date_range'])){
  		$date = explode(' to ', $_REQUEST['date_range']) ;
  		$course_id = $_REQUEST['courseId'];



class PDF extends FPDF
	{
		function Header()
		{
			if(!empty($_FILES["file"]))
			{
			$uploaddir = "logo/";
			$nm = $_FILES["file"]["name"];
			$random = rand(1,99);
			move_uploaded_file($_FILES["file"]["tmp_name"], $uploaddir.$random.$nm);
			$this->Image($uploaddir.$random.$nm,10,10,20);
			unlink($uploaddir.$random.$nm);
		}
		$this->SetFont('Arial','B',12);
		$this->Ln(1);
		}
		function Footer()
		{
			$this->SetY(-15);
			$this->SetFont('Arial','I',8);
			$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
		}
		function ChapterTitle($num, $label)
		{
			$this->SetFont('Arial','',12);
			$this->SetFillColor(200,220,255);
			$this->Cell(0,6,"$num $label",0,1,'L',true);
			$this->Ln(0);
		}
		function ChapterTitle2($num, $label)
		{
			$this->SetFont('Arial','',12);
			$this->SetFillColor(249,249,249);
			$this->Cell(0,6,"$num $label",0,1,'L',true);
			$this->Ln(0);
		}
	}


$query = "SELECT student_id, count(student_id) as count1 FROM student_attendances WHERE course_id = $course_id AND created_at BETWEEN $date[0] AND $date[1] AND is_present = 1 GROUP BY student_id";

$query1 = "SELECT name from courses where id = $course_id";
$query2 = "SELECT COUNT(*) as count1 from attendance_sessions where created_at BETWEEN $date[0] and $date[1] and course_id = $course_id";
$results2 = mysqli_query($con,$query2);
$results1 = mysqli_query($con,$query1);
$results = mysqli_query($con,$query);

while($row=mysqli_fetch_array($results2))
{
	$count = $row['count1']; // number of lectures that happened
}

while($row=mysqli_fetch_array($results1))
{
	$courseName = $row['name']; // Name of Course
}



		$pdf = new PDF();
		$pdf->AliasNbPages();
		$pdf->AddPage();
		//Heading
		$pdf->SetFont('Times','',20);
		$pdf->SetTextColor(30);
		$pdf->Cell(0,3,$courseName,0,1,'C');
		//Invocie Number
		$pdf->Cell(0,20,'',0,1,'R');
		//$pdf->ChapterTitle('Subject Name ',$courseName);
		$pdf->ChapterTitle('Start Date: ',$date[0]);
		$pdf->ChapterTitle('End Date: ',$date[1]);
		$pdf->ChapterTitle('No. Of Lectures = ',$count);

		//customer Details
		$pdf->SetFont('Times','',15);
		$pdf->SetTextColor(32);
		$pdf->Cell(0,20,'',0,1,'R');
		$pdf->SetFillColor(224,235,255);
		$pdf->SetDrawColor(192,192,192);


		$pdf->Cell(100,10,'Student ID',1,0,'L');
		$pdf->SetFont('Times','',13);
		$pdf->Cell(90,10,'Total Lectures Attended',1,1,'C');
		
		while($row=mysqli_fetch_array($results))
		{
			$pdf->Cell(100,10,$row['student_id'],1,0,'L');
			$pdf->SetFont('Times','',13);
			$pdf->Cell(90,10,$row['count1'],1,0,'C');
		}
		
		$pdf->Output('attendancereport.pdf','D');
}    
