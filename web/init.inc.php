<?php

// this mail must be set to receive data from App
$myMail = "pacosal@gmail.com";

// this key must be set at App settings, change it for your own key
$myKey = "0000";

// bbdd password
$con = mysql_connect("localhost","mdm","mdmpassword");
if (!$con)
  {
  die('Error: Could not connect: ' . mysql_error());
  }

mysql_select_db("mdm", $con);

?>