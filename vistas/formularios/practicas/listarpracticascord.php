<!DOCTYPE html>
<?php
include_once '../../../includes/db_connect.php';
include_once '../../../includes/functions.php';
include_once '../../../includes/accienesFR.php';
 
sec_session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Inicio de sesión segura: Página protegida</title>
        <link rel="stylesheet" href="../../../styles/main.css" />
        <link rel="stylesheet" href="../../../styles/menu.css" />
        <link rel="stylesheet" href="../../../styles/tabla.css" />
        <link rel="stylesheet" href="../../../styles/monitores_1.css" />
        <link rel="stylesheet" href="../../../styles/jquery-ui.css" />
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
    <?php if(isset($_REQUEST['msj'])){
        $msj = $_REQUEST['msj'];
     echo "$msj";
    }?>
    <body>
        <?php if (login_check($mysqli) == true) : ?>
        <?php include './header.php';?>
        <br/>
        
        <div class="CSSTableGenerator" >
        <?php
        $idl = $_SESSION['user_id'];
        formularios::listatodpractlab($idl);
        ?>  
        </div>
        <?php else : ?>
            <p>
                <span class="error">No está autorizado para acceder a esta página.</span> Please <a href="../../../index.php">login</a>.
            </p>
        <?php endif; ?>
           
    </body>
</html>