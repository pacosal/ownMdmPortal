<?php require_once("./init.inc.php"); ?>
<?php

$imei = trim($_GET["imei"]);
 

// delete table
  $sql = "DELETE FROM devices WHERE imei='" . $imei . "'";
  //echo $sql;
  if (!mysql_query($sql,$con))
  {
    // error
    die('Error delete');
  }    

  $sql = "DELETE FROM devices_log WHERE imei='" . $imei . "'";
  //echo $sql;
  if (!mysql_query($sql,$con))
  {
    // error
    die('Error delete');
  }    

  header("location: /mdm/web/");

?>