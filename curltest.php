
<?php
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, "https://3c7fce6a.ngrok.io/api/saveToken");
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, array('token'=>'token','session_id'=>'1'));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

//Setting post data as xml
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($curl);

if($result === false)
    {
        echo "Error Number:".curl_errno($curl)."<br>";
        echo "Error String:".curl_error($curl);
    }

curl_close($curl);
var_dump($result);
?>