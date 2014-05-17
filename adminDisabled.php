<?php require_once("web/init.inc.php"); ?>
 
<?php 

  // comprobar si ya está registrado el imei

  $key = $_POST["key"];
  $imei = $_POST["imei"];
  
  if ($key == '' || $key == null) {
      die ("NO key");
  }
  if ($key != $myKey) {
      die ("NO valid key");
  }
    
  $sql = "SELECT imei FROM devices WHERE imei='" . $imei . "'";
  
  $result = mysql_query($sql, $con) or die ("Error: query");
  
  $found = 0;
  while($row = mysql_fetch_array($result))
  {
    $found = 1;                             
  }
  
  if ($found == 0) {
      echo 'Not found';
  }
  else { // actualizar regid
    $sql = "UPDATE devices SET `enabled`=0, `disabledDate` = CURRENT_TIMESTAMP WHERE imei='" . $imei . "'";
    //echo $sql;

    if (!mysql_query($sql,$con))
    {
      // error
      echo 'Error update';
    }    
  
    $sql = "INSERT INTO devices_log(`imei`,`log`) VALUES ('" . $imei . "', 'AdminDisabled')";
    echo $sql;
    echo '<br>';

    if (!mysql_query($sql,$con))
    {
      // error
      echo 'Error insert';
    }    
  
  
  }

?>
