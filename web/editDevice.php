<?php require_once("./init.inc.php"); ?>
<?php

$imei = $_GET["imei"];
 
?>
<?php require("header.inc.php"); ?>

 <!-- body -->

 
<script>
  
  function init() {
  
  }

</script>

<div id="core" class="cajaYSombra">

<form method="post" action="/mdm/web/editDevice_do.php">

  <div id="comando">
    <div id="box1" class="cajaYSombra">
      <div id="label2">
        Enter device new name: 
        <input id="imei" type="hidden" name="imei" value="<?=$imei?>">
        <input id="name" type="text" name="name" value="<?=$name?>" size="60">
      </div>
  
      <div id="sendButton">
        <INPUT id="send"  class="botonSubmit" TYPE="submit" VALUE="Change">
      </div>
    </div>
  </div>
  
</form>

</div>

</div>

</div>

<?php require("footer.inc.php"); ?>
