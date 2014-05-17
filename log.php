<?php require_once("web/init.inc.php"); ?>
 
<?php 
 
  // comprobar si ya está registrado el imei

  $key = $_POST["key"];
  $imei = $_POST["imei"];
  $message = $_POST["message"]; 

  if ($key == '' || $key == null) {
      die ("NO key");
  }
  if ($key != $myKey) {
      die ("NO valid key");
  }
  
  if ($message == '' || $message == null) {
      echo 'NO data';
  }
  else {

    $sql = "SELECT imei FROM devices WHERE imei='" . $imei . "'";
    
    echo $sql;
    echo '<br>';
    
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
      $sql = "INSERT INTO devices_log(`imei`,`log`) VALUES ('" . $imei . "', '" . $message . "')";
      echo $sql;
      echo '<br>';
  
      if (!mysql_query($sql,$con))
      {
        // error
        echo 'Error insert';
      }    
    
    }
  }

?>
 
