<?php require("header.inc.php"); ?>

 <!-- body -->

<?php 
 
  // comprobar si ya está registrado el imei

$imei = $_GET["imei"];
$limit = $_GET["limit"];   
   
?>
 
<script>


  function ind(imei, log, dateLog) {
      this.imei = imei;
      this.log = log;
      this.dateLog = dateLog;
  }
  
  function init() {
                      
    
    // entrada
    $myData = new Array();    
    
    $.getJSON('getEventsLog.php?limit=<?=$limit?>&imei=<?=$imei?>', function(data){
    
           literal = '';
           if (data.items != undefined) { // si devuelve error o cero
             literal = data.mes;
             for (i5 = 0; i5 < data.items.length; i5++) {
             
               $imei = data.items[i5].imei; 
               $log = data.items[i5].log;
               $dateLog = data.items[i5].dateLog;

               $myData[$myData.length++] = new ind($imei, $log, $dateLog);
               
             }
           }
           else {
           }
           
           $text = '';


           // cabecera
           $text += '<ul class="listadoLog">';
           $text += '<li class="campoDateLogHeader">Date</li>';               
           $text += '<li class="campologHeader">Log</li>';
              

           $text += '</ul>';
           

           for (i5 = 0; i5 < $myData.length; i5++) {
    
               $text += '<ul class="listadoLog">';
               $text += '<li class="campoDateLog">' + $myData[i5].dateLog + '</li>';
               var http = $myData[i5].log;                                 
               if (http.indexOf("http") > -1) {
                  $text += '<li class="campolog"><a class="link" href="' + $myData[i5].log + '" target="_blank"> ' + $myData[i5].log + '</a></li>';
               }
               else {
                  $text += '<li class="campolog">' + $myData[i5].log + '</li>';
               }                                                                   
               $text += '</ul>';

           }
    
           $('#cuerpo').html($text);  

         
    }); 
    
    
 }       

</script>

<div id="core" class="cajaYSombra">

  <div id="cuerpo">
  </div>
  
  <div id="viewAll">
  <a href="indexLog.php?limit=200&imei=<?=$imei?>">View all Log</a>  
  </div>  
  
</div>

</div>

</div>

<?php require("footer.inc.php"); ?>
