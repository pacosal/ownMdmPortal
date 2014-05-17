<?php require_once("web/init.inc.php"); ?>
 
<?php 
 
  // comprobar si ya está registrado el imei

  $key = $_POST["key"];
  $imei = $_POST["imei"];
  $model = $_POST["version"]; 

  if ($key == '' || $key == null) {
      die ("NO key");
  }
  if ($key != $myKey) {
      die ("NO valid key");
  }

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
  }
  else { // actualizar regid
    $sql = "UPDATE devices SET `model`='" . $model . "' WHERE imei='" . $imei . "'";
    echo $sql;
    echo '<br>';

    if (!mysql_query($sql,$con))
    {
      // error
      echo 'Error update';
    }    
  
  }

?>
