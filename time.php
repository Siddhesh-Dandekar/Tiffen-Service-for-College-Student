<?php
date_default_timezone_set('Asia/Kolkata');

$h = date("H");  // H: Represents hour in 24-hour format with leading zeros (00 to 23).

if($h>=7 && $h<=10){
    $_SESSION["Stock"] = true;
}
else{
    $_SESSION["Stock"] = true;
}

?>