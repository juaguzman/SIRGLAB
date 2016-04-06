<?php
include_once '../../includes/db_connect.php';
include_once '../../includes/functions.php';
include_once '../../includes/accienesFR.php';
include_once '../../includes/reglabor.inc.php';
 
sec_session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Agregar programa</title>
        <link rel="stylesheet" href="../../styles/main.css" />
        <link rel="stylesheet" href="../../styles/monitores_1.css" />
        <link rel="stylesheet" href="../../styles/menu.css" />
        <link rel="stylesheet" href="../../styles/jquery-ui.css" />
         <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
        <script src="/resources/demos/external/jquery.bgiframe-2.1.2.js"></script>
        <script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
        <script>
        $(function() {
    $( "#dialog-message" ).dialog({
      modal: true,
      buttons: {
        Ok: function() {
          $( this ).dialog( "close" );
        }
      }
    });
  });
  </script>
    </head>
    <body>
        <?php if (login_check($mysqli) == true) : ?>
        <?php include './header.php';?>
        <div id="monadd">
            <form class="form-container" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" method="POST">
            <div class="form-title"><h2>Agregar Laboratorio</h2></div><br/>
            <div class="form-title">Nombre  <?php if (!empty($error_msg_lab)) { echo $error_msg_lab;} ?></div>
            <input class="form-field" type="text" value="<?php if (!empty($noml)) { echo $noml;} ?>" name="nomlab" maxlength="45" required />
            <div class="form-title">Descripcion</div>
            <textarea id="txta" class="form-field" name="desc"><?php if (!empty($desc)) { echo $desc;} ?></textarea>     
            <div  class="form-title">Sede  <?php if (!empty($error_msg_sede)) { echo $error_msg_sede;} ?></div>
            <select class="form-field" name="sede" required>
                <option value="Alvernia">Alvernia</option>
                <option value="Palermo">Palermo</option>
            </select>
            <div class="form-title">Cordinador  <?php if (!empty($error_msg_cord)) { echo $error_msg_cord;} ?></div>
              <?php formularios::sellabora()?>         
            <div class="submit-container">
                <input type="hidden" name="rsp" value="agregar" />
                <input class="submit-button" type="submit" value="Agregar"/>
            </div>
                </form>
       </div>  
       <?php else : ?>
            <p>
                <span class="error">No está autorizado para acceder a esta página.</span> Please <a href="../index.php">login</a>.
            </p>
        <?php endif; ?>
           
    </body>
</ht