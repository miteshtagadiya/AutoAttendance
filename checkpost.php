<?php

$token = $_POST['token'];

echo $token;
echo $_POST['field2'];
echo $_POST['field3'];
?>

 <?php
// //
// // A very simple PHP example that sends a HTTP POST to a remote site
// //

//  $ch = curl_init();

//  curl_setopt($ch, CURLOPT_URL,"checkpost.php");
//  curl_setopt($ch, CURLOPT_POST, 1);
//  curl_setopt($ch, CURLOPT_POSTFIELDS,"token='token'");

// // in real life you should use something like:
//  curl_setopt($ch, CURLOPT_POSTFIELDS ,(array('postvar1' => 'value1')));

// // // receive server response ...
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// $server_output = curl_exec ($ch);

// //print_r($server_output);exit;
// echo "hii";
// curl_close ($ch);

// // // further processing ....
// // if ($server_output == "OK") { echo "string"; } else {  }

?>
