<?php require_once("init.inc.php"); ?>
<?php

$select = "";

foreach ($_POST["imeis"] as $value) {
  $select = $select . "'" . $value . "',";
}
$select = substr($select, 0, strlen($select)-1);

$sql = "SELECT gcm FROM devices WHERE imei in(" . $select . ")";

$result = mysql_query($sql, $con) or die ("Error: query");

$gcms = array();

$found = 0;
while($row = mysql_fetch_array($result))
{                                                                       
  $found = 1;
  array_push($gcms, $row['gcm']);
}


if ($found == 0) {
  echo 'No devices';
}
else {
  $apiKey = "AIzaSyCKF3p0Jhs3q2WmmFKPnVWWW9khWSmWMU4";   // do not change at all
  
  // Message to be sent
  $message = $_POST["mensaje"];

  $texto = $_POST["texto"]; // parametro adicional del mensaje

  if ($message == "mdm_message") {
    $message = $message . " " . $texto; // mensaje
  }

  if ($message == "mdm_sms") {
    $message = $message . " " . $texto; // sms number
  }

  if ($message == "mdm_location_exit") {
    $message = $message . " " . $texto; // metros
  }

  if ($message == "mdm_lockkey") {
    $message = $message . " " . $texto; // key
  }

  if ($message == "mdm_audio") {
    $message = $message . " " . $myMail; // mail
  }
  
  if ($message == "mdm_picture") {
    $message = $message . " " . $myMail; // mail
  }
  
  if ($message == "mdm_video") {
    $message = $message . " " . $myMail; // mail
  }  

  if ($message == "mdm_track") {
    $message = $message . " " . $myMail; // mail
  }
  
  if ($message == "mdm_file") {
    $message = $message . " " . $myMail . "-" . $texto; // path file
  }  

  // Set POST variables
  $url = 'http://android.googleapis.com/gcm/send';
  
  $fields = array(
                  'registration_ids'  => $gcms,
                  'data'              => array( "message" => $message ),
                  );
  
  $headers = array( 
                      'Authorization: key=' . $apiKey,
                      'Content-Type: application/json'
                  );
  
  // Open connection
  $ch = curl_init();
  
  $timeout = 5; // set to zero for no timeout 
  
  // Set the url, number of POST vars, POST data
  curl_setopt( $ch, CURLOPT_URL, $url );
  
  curl_setopt( $ch, CURLOPT_POST, true );
  curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
  curl_setopt($ch, CURLOPT_VERBOSE, TRUE);
  curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout); 
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  
  curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields ) );
  
  
  // Execute post
  $result = curl_exec($ch);
  
  // Close connection
  curl_close($ch);
  
  $obj = json_decode($result);
  
  header("location: /mdm/web/index.php?sucess=" . $obj->{'success'} . "&failure=" . $obj->{'failure'} ) ;  
}

?>
