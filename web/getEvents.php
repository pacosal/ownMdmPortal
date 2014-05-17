<?php require_once("init.inc.php"); ?>
<?php
header('Content-type: application/json');
header('Content-Type: text/plain; charset=ISO-8859-1');

$sql = "SELECT imei, name, gcm, location, enabled, model, enabledDate, disabledDate, dateLocation, ping FROM devices"; 
     
//echo $sql;

$result = mysql_query($sql, $con) or die ("Error: problema con query");

if (!$result || mysql_num_rows($result) <= 0)  {
  echo '{'.PHP_EOL;
  echo '"devices": "0",'.PHP_EOL;
  echo '}'.PHP_EOL;   
}
else {

  $found = 0;
  $indice = 0;

  echo '{'.PHP_EOL;
  echo '"devices": "' . mysql_num_rows($result) . '",'.PHP_EOL;
  echo '"items": ['.PHP_EOL;

  while($row = mysql_fetch_array($result))
  {                                                                       
    $found = 1;
    $indice++;                             

    $imei = $row['imei'];
    $gcm = $row['gcm'];
    $location = $row['location'];
    $enabled = $row['enabled'];
    $model = $row['model'];
    $enabledDate = $row['enabledDate'];
    $disabledDate = $row['disabledDate'];
    $dateLocation = $row['dateLocation'];
    $ping = $row['ping'];
    $name = $row['name'];
    
    echo '{';
    echo '"imei": "'. $imei . '",'.PHP_EOL;
    echo '"gcm": "'. $gcm . '",'.PHP_EOL;
    echo '"location": "'. $location . '",'.PHP_EOL;
    echo '"enabled": '. $enabled . ','.PHP_EOL;
    echo '"model": "' .$model . '",'.PHP_EOL;
    echo '"enabledDate": "'. $enabledDate . '",'.PHP_EOL;
    echo '"disabledDate": "'. $disabledDate . '",'.PHP_EOL;
    echo '"dateLocation": "'. $dateLocation . '",'.PHP_EOL;
    echo '"ping": "'. $ping . '",'.PHP_EOL;
    echo '"name": "'. $name . '"'.PHP_EOL;    
    
    if ($indice == mysql_num_rows($result))
      echo '}'.PHP_EOL;
    else
      echo '},'.PHP_EOL;
           
  }
  echo ']'.PHP_EOL;
  echo '}'.PHP_EOL;  


}

?>