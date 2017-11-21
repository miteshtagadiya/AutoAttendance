
<!DOCTYPE html>
<html>
<head>


  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AutoAttendance | Dashboard</title>
<?php    
require_once("includeFaculty/requiredCss.php");
?>

<!-- files required for timer -->

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
<script type="text/javascript" src="timerCssJson/TimeCircles.js"></script>
<link rel="stylesheet" href="timerCssJson/TimeCircles.css" />

<!-- ./files required for timer -->

</head>
<body class="hold-transition skin-blue sidebar-mini sidebar-collapse" onLoad="window.scroll(0, 150)">


<div class="wrapper">

<?php
    // top header
    include("includeFaculty/header.php");
    // left navigation
    include("includeFaculty/mainNavigation.php");
$courseId = $_REQUEST['courseList'];
$uName = $_SESSION['username'];
$time= $_REQUEST['time'];
$counttime = ($time)*4;
$iid = $_REQUEST['iid'];
//$runtime= ($time * 60 * 1000)/$counttime ;
$count = $_REQUEST['count'];
$date = date('Y-m-d H:i:s');
    
// var_dump($uName);
// exit(0);

 ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Attendance
        <small>Main panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <div class="row" id="mainDiv">
      <div class="col-sm-4 col-sm-offset-4">
    <div class="col-sm-1">
          </div>
        <!-- <img src="qrCode.jpg" class="img-responsive" alt="*** Unable to Display QR Code *** Please Contact System Administrator" width="500"> -->
          
    
    <!-- QR code -->      
    <?php    
          
    //set it to writable location, a place for temp generated PNG files
    $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;
    
    //html PNG location prefix
    $PNG_WEB_DIR = 'temp/';

    include "phpqrcode/qrlib.php";    
    
    //ofcourse we need rights to create temp dir
    if (!file_exists($PNG_TEMP_DIR))
        mkdir($PNG_TEMP_DIR);
    
    
    $filename = $PNG_TEMP_DIR.'test.png';
    if (isset($_REQUEST['data'])) { 
    
        //it's very important!
        if (trim($_REQUEST['data']) == '')
            die('data cannot be empty! <a href="?">back</a>');
            
        // user data
        $filename = $PNG_TEMP_DIR.'test'.md5($_REQUEST['data'].'|'."H".'|'."10").'.png';
        QRcode::png($_REQUEST['data'], $filename, "H", "10", 2);    
        
    } else {    


      function base64url_encode($data) { 
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '='); 
        }


      $header = ['alg'=>'HS256','typ'=>'JWT'];

      $payloads= ['userName'=> $uname ,'courseId'=> $courseId,'Date'=>date("d/m/Y"),'time'=> date("h:i:s")];

      $header_encoded = base64url_encode(json_encode($header));
      $claims = base64url_encode(json_encode($payloads));

      $key = 'secret';

      $signature = hash_hmac('SHA256',"$header_encoded.$claims",$key,true);
      $signature_encoded = base64url_encode($signature);

//build and return the token
      $token = "$header_encoded.$claims.$signature_encoded";
      //echo $token;
      // $payload = $headers + "." + $claims;
 
      // $signature = base64url_encode(HMACSHA256($payload, $secret));
  
      // $encodedJWT = $payload + "." + $signature;

      // echo $encodedJWT;
      // exit(0);

      $finalQRData = md5($uname . "," . $courseId . "," . date("d/m/Y") . "," .date("h:i:s"));
      // var_dump($finalQRData);
      //exit(0);

        date_default_timezone_set("Asia/Kolkata");
        //echo "The time is " . date("h:i:sa");

        QRcode::png($finalQRData, $filename, "H", "10", 2);    
    
    }    
        
//    display generated file

    ?>
<!-- 
    <form method="post" action="checkpost.php" onload="">
    <input type='hidden' name='token' value='<?php echo "$token";?>'/> 

    </form> -->
    <?php
    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, "https://5979f3e4.ngrok.io/api/saveToken");
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, array('token'=>'$finalQRData','session_id'=>'$iid'));//Setting post data as xml
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($curl);
    curl_close($curl);
    //print($result);
    //exit(0);
    ?>

    <?php


     echo '<img src="'.$PNG_WEB_DIR.basename($filename).'" width="170%" style="margin-left:-35%;" /><hr/>';  
    
          ?>
       
          
          <?php
    //config form
    // echo '<form action="attendance.php" method="post">
        // <b>Data:</b>&nbsp;<input name="data" value="'.(isset($_REQUEST['data'])?htmlspecialchars($_REQUEST['data']):'PHP QR Code :)').'" />&nbsp;';
        
        ?>
          
        
        <!-- <input type="submit" class="btn btn-primary" value="GENERATE"> -->
          
          </form><hr/>
        


          <!-- <img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=http%3A%2F%2Fwww.google.com%2F&choe=UTF-8" title="Link to Google.com" />
          -->
          
          
        <!-- Its the TimeCircles -->
        <div id="CountDownTimer" data-timer="15" style="width: 500px; height: 150px;  margin-left:12%;"></div>
        
        <div class="text-center" style="margin-top:-10%; ">
          <br><br>
       <!--    <button class="btn btn-success startTimer">Start Timer</button>
          <button class="btn btn-danger stopTimer">Stop Timer</button>
        -->   <br>
          <a href="sessionUpdate.php?iid=<?php echo $iid;?>&courseList=<?php echo $courseId; ?>" >
            <button type="button" class="btn btn-success btn-lg"style="margin-top:4%;">Stop Attendance</button>
          </a>
        </div>
      </div>
    </div>

<br><br>
  </div>
    <!-- ./Main Content -->
    <!-- footer -->

<!-- <script src="https://unpkg.com/axios/dist/axios.min.js"></script> -->
  <script src="node_modules/axios/lib/axios.js"></script>
      <script>
          $("#DateCountdown").TimeCircles();
          $("#CountDownTimer").TimeCircles({ time: { Days: { show: false }, Hours: { show: false } }});
          $("#PageOpenTimer").TimeCircles();

          var updateTime = function(){
              var date = $("#date").val();
              var time = $("#time").val();
              var datetime = date + ' ' + time + ':00';
              $("#DateCountdown").data('date', datetime).TimeCircles().start();
          }
          $("#date").change(updateTime).keyup(updateTime);
          $("#time").change(updateTime).keyup(updateTime);

          // Start and stop are methods applied on the public TimeCircles instance
          $(".startTimer").click(function() {
              $("#CountDownTimer").TimeCircles().start();
          });
          $(".stopTimer").click(function() {
              $("#CountDownTimer").TimeCircles().stop();
          });

          // Fade in and fade out are examples of how chaining can be done with TimeCircles
          $(".fadeIn").click(function() {
              $("#PageOpenTimer").fadeIn();
          });
          $(".fadeOut").click(function() {
              $("#PageOpenTimer").fadeOut();
          });

      </script>

    
    
    
    <script>

var setint;        
     var token = "<?php echo $token; ?>";   
 function autoRefresh1()
{
	   // window.location.reload();
     
     var curr_page = window.location.href;
     var time = <?php echo $time; ?>;
     var counttime = <?php echo $counttime; ?>;
     var courseId = <?php echo $courseId; ?>;
     var count = <?php echo $count; ?>;
     var iid = <?php echo $iid; ?>;
     var token = "<?php echo $finalQRData; ?>";
    next_page = "";
    //alert("okkkk");
// If current page has a query string, append action to the end of the query string, else
// create our query string
if(curr_page.indexOf("?") > -1 && count+2 <= counttime) {
    var curr_page1 = window.location.href.split("?")[0];
    count++;
    next_page = curr_page1+"?count="+count+"&time="+time+"&courseList="+courseId+"&iid="+iid;


  var url = 'checkpost.php?token='+ token ;


// <?php
// $curl = curl_init();

// curl_setopt($curl, CURLOPT_URL, "https://3c7fce6a.ngrok.io/api/saveToken");
// curl_setopt($curl, CURLOPT_POST, 1);
// curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($curl, CURLOPT_POSTFIELDS, array('token'=>'token','sessionId'=>'iid'));//Setting post data as xml
// $result = curl_exec($curl);
// curl_close($curl);
// //print($result);
// ?>  
  //myFunction();
    window.location = next_page;
    //alert(next_page);
} else {
    //alert("done");
// <?php
//     $sql2="update attendance_sessions set is_active=0 ,updated_at='$date'";
//     // echo $sql2;
//     // echo $time;
//     // exit(0);

//   if(mysqli_query($con,$sql2))
//   {
// //    echo $sql2;
// //    echo $password1;
// //    echo $password;    
//   header("location: home.php");
//   }

//   else
//     {
//         header('location: home.php');
//     }

// ?>
    
    //axios.post('checkpost.php', {token: token});
    clearInterval(setint);
    window.location.href ="sessionUpdate.php?iid="+iid+"&courseList="+courseId;
    //next_page = curr_page+"?count=0&time="+time+"&courseList="+courseId;
}

// Redirect to next page

     // document.getElementById('mainDiv');
}

// function myFunction() {
//     $.ajax({
//             type : "POST",  //type of method
//             url  : "checkpost.php?token="+ token ,  //your page
//             data : { token : token },// passing the values
//             success: function(res){  
//                                     //do what you want here...
//                     }
//         });
//     }

 setint = setInterval('autoRefresh1()', 13000);
     
 //     setInterval(function(){
 //      $('#mainDiv').load('attendance.php');
 // },5000);
// function UserAction(url) {
//     var xhttp = new XMLHttpRequest();
//     xhttp.open("POST", "",  true);
//     xhttp.setRequestHeader("Content-type", "application/json");
//     xhttp.send();
// }
        
// this will reload page after every 5 secounds; Method II

//<script src="http://code.jquery.com/jquery-latest.js"></script>
<!-- 
<script>
    $(document).ready(function(){
        setInterval(function() {
            $("#latestData").load("getLatestData.php?PNG_WEB_DIR="$PNG_WEB_DIR"&filename="$filename");
        }, 5000);
    });

</script> -->

    <?php require_once("includeFaculty/footer.php"); ?>

    </body>
    </html>
