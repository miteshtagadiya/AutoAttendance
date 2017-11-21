
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AutoAttendance | Dashboard</title>
    
    
<?php
require_once("includeFaculty/requiredCss.php");  
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>


</head>
<body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
<div class="wrapper">

<?php
    // top header
    include("includeFaculty/header.php");
    // left navigation
    include("includeFaculty/mainNavigation.php");
 ?>

<?php

$uname = $_SESSION['username'];
if(!isset($_SESSION['username']) )
{
    
        header("location: index.php");
}
?>
    
    
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Attendance
        <small>Analytics panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Attendance Analytics</li>
      </ol>
    </section>

    <!-- Main content -->
      <form action="pdfdownload.php" method="post" name="upload_excel" enctype="multipart/form-data">
    <div class="form-group" style="margin-left:25%; margin-right:25%;">
      <label>Select Course</label>
      <select class="form-control" name="cid" id="cid" required="true">
          <option>--Select Course--</option>
          <?php
       
                $sql2="select c.id,c.name from courses c ,faculties f,faculty_courses s where f.id=s.faculty_id and s.course_id=c.id and f.email_id='$uname'";
                $results=mysqli_query($con,$sql2);
				while($row=mysqli_fetch_array($results))
                {
          ?>
          <option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
          <?php 
                }
          ?>

      </select>
    </div>
    <div class="col-sm-offset-4 col-sm-4">
    <div class=" text-center" style="margin-top:10px">
      <label>Date range button:</label>

      <div style="margin-top:10px">
      
        <button type="button" name="d_range" class="btn btn-default btn-lg " id="daterange-btn" >
          <span name="date_range">
            <i class="fa fa-calendar"></i> Date Range
          </span>
          <i class="fa fa-caret-down"></i>
        </button>
      
      </div>

    </div>

    </div>
    <div style="margin-top:10%" class="row">
      
      <div class="col-sm-4 text-center" style="margin-left:3% ">
          
    </div>
    <div class="col-sm-3 text-center">
    <button type="button" onclick="generatePDF()" name="Pdf" class="btn btn-info btn-lg">
      <span>
        <i class="fa fa-file-pdf-o"></i> Generate Summarised Report (in pdf)
      </span>
    </button>
  </div>
  </div>
    </form>
    </div>
 

   <!--  </section>  -->
<!-- footer -->


<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- ChartJS 1.0.1 -->
<!-- <script src="plugins/chartjs/Chart.min.js"></script>
<script src="plugins/chartjs/Chart.js"></script> -->

<script>
var date1 = null;
$(function () {
$(  '#daterange-btn').daterangepicker(
    {
      ranges: {
        'Today': [moment(), moment()],
        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month': [moment().startOf('month'), moment().endOf('month')],
        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      },
      startDate: moment().subtract(29, 'days'),
      endDate: moment()
    },
    function (start, end) {
      date1 = start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD');
      $('#daterange-btn span').html(date1);
    }
);
  });
function generatePDF(){
  var cId = document.getElementById('cid');
  var courseId1 = cId.options[cId.selectedIndex].value;
  if(date1!=null){
    window.location.href="pdfdownload.php?date_range=" + date1 + "&courseId=" + courseId1;
  }else{
    alert('please select any date');
  }
}
</script>
<!-- 
<script>
  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------

    // Get context with jQuery - using jQuery's .get() method.
    var areaChartCanvas = $("#areaChart").get(0).getContext("2d");
    // This will get the first returned node in the jQuery collection.
    var areaChart = new Chart(areaChartCanvas);

    var areaChartData = {
      labels: ["January", "February", "March", "April", "May", "June", "July","August"],
      datasets: [
        
        {
          label: "Digital Goods",
          fillColor: "rgba(60,141,188,0.9)",
          strokeColor: "rgba(60,141,188,0.8)",
          pointColor: "#3b8bba",
          pointStrokeColor: "rgba(60,141,188,1)",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(60,141,188,1)",
          data: [28, 48, 40, 19, 86, 27, 90,100]
        }
      ]
    };

    var areaChartOptions = {
      //Boolean - If we should show the scale at all
      showScale: true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines: false,
      //String - Colour of the grid lines
      scaleGridLineColor: "rgba(0,0,0,.05)",
      //Number - Width of the grid lines
      scaleGridLineWidth: 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines: true,
      //Boolean - Whether the line is curved between points
      bezierCurve: true,
      //Number - Tension of the bezier curve between points
      bezierCurveTension: 0.3,
      //Boolean - Whether to show a dot for each point
      pointDot: false,
      //Number - Radius of each point dot in pixels
      pointDotRadius: 4,
      //Number - Pixel width of point dot stroke
      pointDotStrokeWidth: 1,
      //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
      pointHitDetectionRadius: 20,
      //Boolean - Whether to show a stroke for datasets
      datasetStroke: true,
      //Number - Pixel width of dataset stroke
      datasetStrokeWidth: 2,
      //Boolean - Whether to fill the dataset with a color
      datasetFill: true,
      //String - A legend template
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
      //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio: true,
      //Boolean - whether to make the chart responsive to window resizing
      responsive: true
    };

    //Create the line chart
    areaChart.Line(areaChartData, areaChartOptions);



  });
</script> -->

<?php require_once("includeFaculty/footer.php"); ?>


</body>
</html>
