<?php

$PNG_WEB_DIR = $_GET['PNG_WEB_DIR'];
$filename = $_GET['filename'];

 echo '<img src="'.$PNG_WEB_DIR.basename($filename).'" width="130%" style="margin-left:-10%;" /><hr/>';  

?>