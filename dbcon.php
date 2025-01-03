<?php
define("HOSTNAME","localhost");
define("USERNAME","root");
define("PASSWORD","");
define("DATABASE","lunchbox");

$connection=mysqli_connect(HOSTNAME , USERNAME ,PASSWORD  , DATABASE);

if(!$connection){
    die("connection failed due to".mysqli_connect_error());

}else{
    // echo "connection Done";
}
?>