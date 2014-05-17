<?php require("header.inc.php"); ?>

 <!-- body -->

 
<script>


  function ind(imei, gcm, location, enabled, model, enabledDate, disabledDate, dateLocation, ping, name) {
      this.imei = imei;
      this.gcm = gcm;
      this.location = location;
      this.enabled = enabled;
      this.model = model;
      this.enabledDate = enabledDate;
      this.disabledDate = disabledDate;
      this.dateLocation = dateLocation;
      this.ping = ping;      
      this.name = name;
            
  }
  
  function init() {
  
    
    // entrada
    $myData = new Array();    
    
    $.getJSON('getEvents.php', function(data){
    
           literal = '';
           if (data.items != undefined) { // si devuelve error o cero
             literal = data.mes;
             for (i5 = 0; i5 < data.items.length; i5++) {
             
               $imei = data.items[i5].imei; 
               $gcm = data.items[i5].gcm;
               $location = data.items[i5].location;
               $enabled = data.items[i5].enabled;
               $model = data.items[i5].model;
               $enabledDate = data.items[i5].enabledDate;
               $disabledDate = data.items[i5].disabledDate;
               $dateLocation = data.items[i5].dateLocation;
               $ping = data.items[i5].ping;
               $name = data.items[i5].name;

               $myData[$myData.length++] = new ind($imei, $gcm, $location, $enabled, $model, $enabledDate, $disabledDate, $dateLocation, $ping, $name);
               
             }
           }
           else {
           }
           
           $text = '';


           // cabecera
           $text += '<ul class="listado">';
           $text += '<li class="campoSelHeader"></li>';
           $text += '<li class="campoImeiHeader">Imei</li>';
           $text += '<li class="campoImeiHeader">Name</li>';
           $text += '<li class="campoModelHeader">Model</li>';
           
           $text += '<li class="campoLocationHeader">Location</li>';
              
           $text += '<li class="campoEnabledHeader">Admin</li>';               
           $text += '<li class="campoPingHeader">Ping</li>';
           $text += '<li class="campoSelHeader">Log</li>';

           $text += '</ul>';
           

           for (i5 = 0; i5 < $myData.length; i5++) {
    
               $text += '<ul class="listado">';
               $text += '<li class="campoSel">' + '<INPUT TYPE="CHECKBOX" NAME="imeis[]" VALUE="' + $myData[i5].imei + '">' + '</li>';
               $text += '<li class="campoImei">' + $myData[i5].imei + '</li>';
               $text += '<li class="campoImei">' + $myData[i5].name + '</li>';
               $text += '<li class="campoModel">' + $myData[i5].model + '</li>';
               
               if ($myData[i5].location != "") 
                  $text += '<li class="campoLocation"><a class="link" href="' + $myData[i5].location + '" target="_blank">' + $myData[i5].dateLocation + '</a></li>';
               else
                  $text += '<li class="campoLocation">No data</li>';
                  
               if ($myData[i5].enabled) {
                  $text += '<li class="campoEnabled">Enabled: ' + $myData[i5].enabledDate.toString('dd MM yyyy h:mm:ss') +  '</li>';
               }
               else {
                  $text += '<li class="campoEnabled">' + $myData[i5].disabledDate.toString('dd MM yyyy h:mm:ss') +  '</li>';               
               } 
               
               var dHoy = new Date();
               var dPing = new Date($myData[i5].ping);
               var dif = dHoy - dPing;
               if (dif < 86400000) { // 24 horas
                 $text += '<li class="campoPing"><img src="images/green.png" width="10" border="0"> ' + $myData[i5].ping + '</li>';
               } 
               if (dif >= 86400000) { // 24 horas
                 $text += '<li class="campoPing"><img src="images/red.png" width="10" border="0"> ' + $myData[i5].ping + '</li>';
               }                

               $text += '<li class="campoSel"><a class="link" href="/mdm/web/indexLog.php?limit=10&imei=' + $myData[i5].imei + '">Go</a></li>';

               $text += '</ul>';

           }
    
           $('#cuerpo').html($text);  


      }); 
    
      $('input[name="texto"]').prop('disabled',true);
      
      $('select[name="mensaje"]').on('change', function() {
      
        if (this.value == "void") {
          $('input[name="texto"]').prop('disabled',true);
          $('#help').html("");
        }
        if (this.value == "mdm_message") {
          $('#help').html("Send a notification to device. Enter your message below");
          $('input[name="texto"]').prop('disabled',false);
        }
        if (this.value == "mdm_lock") {
          $('#help').html("Will block the screen device");
          $('input[name="texto"]').prop('disabled',true);
        }
        if (this.value == "mdm_ring") {
          $('#help').html("The device will sound like a police car");
          $('input[name="texto"]').prop('disabled',true);
        }
        if (this.value == "mdm_activate") {
          $('#help').html("The device will receive a popup to activate this App if it is not.");
          $('input[name="texto"]').prop('disabled',true);
        }
        if (this.value == "mdm_ping") {
          $('#help').html("The device will answer with a ping to check if is responding (check log)");
          $('input[name="texto"]').prop('disabled',true);
        }
        if (this.value == "mdm_audio") {
          $('#help').html("The device will record a 20 seconds audio and will send it to your mail");
          $('input[name="texto"]').prop('disabled',true);
        }
        if (this.value == "mdm_picture") {
          $('#help').html("The device will take a picture and will send it to your mail");
          $('input[name="texto"]').prop('disabled',true);
        }
        if (this.value == "mdm_video") {
          $('#help').html("The device will take a short video and will send it to your mail (It will wait till Screen is On)");
          $('input[name="texto"]').prop('disabled',true);
        }
        if (this.value == "mdm_location") {
          $('#help').html("The device will anwser with its location at google maps and wifi networks (check log)");
          $('input[name="texto"]').prop('disabled',true);
        }
        if (this.value == "mdm_location_exit") {
          $('#help').html("Send you alerts when the device go out or in the actual device location. Enter the number in meters below, for example 5000, (check log)");
          $('input[name="texto"]').prop('disabled',false);
        }
        if (this.value == "mdm_lockkey") {
          $('#help').html("Will block the screen device with a key. Enter a PIN number below, for example 0000");
          $('input[name="texto"]').prop('disabled',false);
        }
        if (this.value == "mdm_sms") {
          $('#help').html("You must enter the complete number where you want to receive the sms. Perfect for knowing the mobile number of the Imsi inserted in the device");
          $('input[name="texto"]').prop('disabled',false);
        }
        if (this.value == "mdm_wipe") {
          $('#help').html("The device will be completely deleted, only if it is stolen and you can not recover it");
          $('input[name="texto"]').prop('disabled',true);
        }
        if (this.value == "mdm_track") {
          $('#help').html("The device will return location, sound and pictures every 3 minutes for 15 minutes");
          $('input[name="texto"]').prop('disabled',true);
        }
        if (this.value == "mdm_version") {
          $('#help').html("The device will update its model info");
          $('input[name="texto"]').prop('disabled',true);
        }
        if (this.value == "mdm_file") {
          $('#help').html("You must enter the complete path file, for instance /sdcard/file.txt");
          $('input[name="texto"]').prop('disabled',false);
        }      
        
        
      
      });
      

    
 }

  function edit() {

    var checked = $('input[name="imeis[]"]:checked').length;
    if (checked != 1) {
       alert("You have to select one device");
       return;
    }  
    
    var imei = "";
    var l = $('input[name="imeis[]"]').length;
    var array = $('input[name="imeis[]"]');  
    for (i=0; i < l; i++ ) {
      if (array.eq(i).attr('checked') ) {
        imei = array.eq(i).val();
      }
    }
    
    window.location = "/mdm/web/editDevice.php?imei=" + imei; 

  }

  function remove() {

    if (!confirm("Are you sure?")) {
      return;
    }

    var checked = $('input[name="imeis[]"]:checked').length;
    if (checked != 1) {
       alert("You have to select one device");
       return;
    }  
    
    var imei = "";
    var l = $('input[name="imeis[]"]').length;
    var array = $('input[name="imeis[]"]');  
    for (i=0; i < l; i++ ) {
      if (array.eq(i).attr('checked') ) {
        imei = array.eq(i).val();
      }
    }
    
    window.location = "/mdm/web/deleteDevice_do.php?imei=" + imei; 

  }


  function check() {
  
    var atLeastOneIsChecked = $('input[name="imeis[]"]:checked').length > 0;
    if (!atLeastOneIsChecked) {
       return false;
    }  

    if (document.getElementById('mensaje').value == 'void') {
      return false;
    }
  
    if (document.getElementById('mensaje').value == 'mdm_lockkey') {
      var reg = /^[0-9]+$/g;
      var b = reg.test($('#texto').val() ); 
      if (!b)
        return false;
    }
  
    if (document.getElementById('mensaje').value == 'mdm_wipe') {
      var key = prompt("This command will delete the device\n\nPlease enter the word wipe to continue.","");
      if (key != "wipe")
      return false;
    }
    return true;
  
  }  


</script>

<div id="core" class="cajaYSombra">

<div id="add">
<a href="javascript:remove();"><img border="0" title="Delete Device" width="30" src="images/delete.png"></a>
<a href="javascript:edit();"><img border="0" title="Edit Device" width="30" src="images/edit.png"></a>
</div>

<form method="post" onsubmit="return check()" action="/mdm/web/message.php">

  <div id="cuerpo" class="cajaYSombra">
  </div>
  
  <div id="comando">
    <div id="box1" class="cajaYSombra">
      <div id="label1">Command:&nbsp; 
        <SELECT id="mensaje" name="mensaje">
          <OPTION VALUE="void">Select Command
          <OPTION VALUE="mdm_message">Message
          <OPTION VALUE="mdm_lock">Lock
          <OPTION VALUE="mdm_ring">Ring
          <OPTION VALUE="mdm_activate">Enable Admin
          <OPTION VALUE="mdm_ping">Ping
          <OPTION VALUE="mdm_location">Location
          <OPTION VALUE="mdm_location_exit">Location Alarm
          <OPTION VALUE="mdm_lockkey">Lock with Key
          <OPTION VALUE="mdm_version">Force Model Update
          <OPTION VALUE="mdm_audio">Record Audio
          <OPTION VALUE="mdm_picture">Take a picture
          <OPTION VALUE="mdm_video">Take a video
          <OPTION VALUE="mdm_sms">Receive a Sms
          <OPTION VALUE="mdm_track">Track Device
          <OPTION VALUE="mdm_file">Receive a File          
          <OPTION VALUE="mdm_wipe">Wipe (TAKE CARE)
        </SELECT>
        
      </div>
      <div id="help"></div>
      <div id="label2">
        Param: 
        <input id="texto" type="text" name="texto" value="" size="50">
      </div>
  
      <div id="sendButton">
        <INPUT id="emviar"  TYPE="submit" VALUE="Send">
      </div>
    </div>
  </div>
  
</form>

</div>

</div>

</div>

<?php require("footer.inc.php"); ?>
